<?php

namespace App\Http\Controllers;

use App\BetInvest;
use App\BetQuestion;
use App\Blog;
use App\Deposit;
use App\Event;
use App\Faq;
use App\GatewayCurrency;
use App\HowItWork;
use App\Match;
use App\Slider;
use App\Sport;
use App\Testimonial;
use App\User;
use App\WithdrawMethod;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\File;

class WebsiteController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $data['page_title'] = "Home";
//        $data['sliders'] = Slider::latest()->get();
//        $data['matches'] = Match::with('event')->whereStatus(1)->where('status', '!=' ,2)->where('end_date','>', $now)->orderBy('start_date','asc')->limit(10)->get();

        $data['users'] = User::count();
        $data['totalPrediction'] = BetInvest::count();
        $data['gateway'] = GatewayCurrency::where('status', 1)->get();
        $data['withdraw'] = WithdrawMethod::where('status', 1)->count();

//        $data['howItWork'] = HowItWork::get();
//        $data['testimonials'] = Testimonial::latest()->get();
//        $data['blogs'] = Blog::orderBy('id','desc')->limit(4)->get();
        $countries = Sport::all();
        $data['sports'] = ['كرة القدم', 'كرة السلة', 'كرة الطائرة', 'تنس', 'رياضات اخرى'];
        $date = Carbon::today()->subDays(7);
        $weeklyLeader = BetInvest::with('user')->where('created_at', '>=', $date)->where('status', '!=', 2)->groupBy('user_id')
            ->select('user_id', DB::raw('count(*) as total_predictions'), DB::raw('sum(invest_amount) as investAmount'))
            ->limit(5)
            ->orderBy('investAmount', 'desc')
            ->get();

        $leader = BetInvest::with('user')->where('status', '!=', 2)->groupBy('user_id')
            ->select('user_id', DB::raw('count(*) as total_predictions'), DB::raw('sum(invest_amount) as investAmount'))
            ->orderBy('investAmount', 'desc')
            ->limit(5)
            ->get();

        return view('ui.home1', $data, compact('weeklyLeader', 'leader', 'countries'));
    }

    public function tournament($name = null, $id)
    {
        $now = Carbon::now();
        $tournament = Event::where('id', $id)->where('status', 1)->firstOrFail();
        $data['page_title'] = "$tournament->name";
        $data['matches'] = Match::with('event')->where('event_id', $id)->whereStatus(1)->where('status', '!=', 2)->where('end_date', '>', $now)->orderBy('start_date', 'asc')->limit(10)->get();


        $data['users'] = User::count();
        $data['totalPrediction'] = BetInvest::count();
        $data['gateway'] = GatewayCurrency::where('status', 1)->get();
        $data['withdraw'] = WithdrawMethod::where('status', 1)->count();
        return view('ui.tournament', $data);
    }


    public function about()
    {

        $data['page_title'] = "About Us";
        $data['users'] = User::count();
        $data['totalPrediction'] = BetInvest::count();
        $data['gateway'] = GatewayCurrency::where('status', 1)->get();
        $data['withdraw'] = WithdrawMethod::where('status', 1)->count();
        $data['testimonials'] = Testimonial::latest()->get();
        $data['howItWork'] = HowItWork::get();
        return view('ui.about', $data);
    }

    public function blog()
    {

        $data['page_title'] = "Blog";
        $data['blogs'] = Blog::latest()->paginate(3);
        $data['popular'] = Blog::orderBy('total_read', 'desc')->limit(5)->get();
        return view('ui.blogs', $data);
    }

    public function blogDetails($slug = null, $id)
    {

        $data['page_title'] = "Blog Details";
        $data['popular'] = Blog::orderBy('total_read', 'desc')->limit(5)->get();

        $blog = Blog::findOrFail($id);
        $blog->total_read += 1;
        $blog->save();


        return view('ui.blog-details', $data, compact('blog'));
    }

    public function faq()
    {

        $data['page_title'] = "FAQS";
        $data['faqs'] = Faq::all();
        return view('ui.faqs', $data);
    }

    public function terms()
    {

        $data['page_title'] = "Terms & Conditions";
        return view('ui.terms', $data);
    }

    public function policy()
    {

        $data['page_title'] = "Privacy & Policy";
        return view('ui.policy', $data);
    }

    public function contact()
    {

        $data['page_title'] = "Contact Us";
        return view('ui.contact', $data);
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|max:191',
            'message' => 'required|max:191',
            'subject' => 'required|max:191',
        ]);

        send_contact($request->email, $request->name, $request->subject, $request->message);
        session()->flash('success', 'Send Successfully');
        return back();
    }

    public function cronMatchEnd()
    {
        $now = Carbon::now();
        Match::where('end_date', '<', $now)->where('status', 1)->update(['status' => 2]);
        BetQuestion::where('end_time', '<', $now)->where('status', 1)->update(['status' => 2]);
        $date = Carbon::today()->subDays(1);
        Deposit::where('created_at', '<=', $date)->where('status', 0)->delete();
    }

    public function updateMatches()
    {
        $update_database = function ($start_date, $country_key) {
            $football_api = new \App\Helpers\FootballSoccerApi();
            $all_matches = $football_api->fetchMatches($start_date, Carbon::today()->toDateString(), $country_key);
            foreach ($all_matches as $match) {
                if (strtolower(@$match->match_status) === 'finished') {
                    $match = \App\Match::updateOrCreate([
                        'league_key' => $match->league_id,
                        'country_key' => $match->country_id,
                        'home_logo' => $match->team_home_badge,
                        'away_logo' => $match->team_away_badge,
                        'event_key' => $match->match_id,
                        'event_date' => $match->match_date,
                        'event_time' => $match->match_time,
                        'home_team' => $match->match_hometeam_name,
                        'away_team' => $match->match_awayteam_name,
                        'status' => $match->match_status,
//                        'event_half_time_result' => $match->event_halftime_result,
                        'event_final_result' => $match->match_hometeam_ft_score . '-' . $match->match_awayteam_ft_score,
                    ]);
                }
            }
        };
        $search_database = function ($updatable, $country_key) {
            $country_matches = \App\Match::where('country_key', $country_key)->where('event_date', $updatable->match_date)->get();
            $cash2bets_home_team = GoogleTranslate::trans($updatable->home_team, 'en', 'ar');
            $cash2bets_away_team = GoogleTranslate::trans($updatable->away_team, 'en', 'ar');
            $bets_value = GoogleTranslate::trans($updatable->bet_value, 'en', 'ar');
            foreach ($country_matches as $match) {
                $all_sports_home_team = $match->home_team;
                $all_sports_away_team = $match->away_team;
                similar_text($all_sports_home_team, $cash2bets_home_team, $probability_HH);
                similar_text($all_sports_away_team, $cash2bets_away_team, $probability_WW);
                $results = str_replace(" ", "", $match->event_final_result);
                $results = explode("-", $results);
                if ($probability_HH >= 50 || $probability_WW >= 50) {
                    if ($bets_value === $cash2bets_home_team) {
                        $bet_result = (int)$results[0] > (int)$results[1] ? 1 : -1;
                        $updatable->update([
                            'result' => $bet_result
                        ]);
                    } else if ($bets_value === $cash2bets_away_team) {
                        $bet_result = (int)$results[1] > (int)$results[0] ? 1 : -1;
                        $updatable->update([
                            'result' => $bet_result
                        ]);
                    } else {
                        $bet_result = (int)$results[1] === (int)$results[0] ? 1 : -1;
                        $updatable->update([
                            'result' => $bet_result
                        ]);
                    }
                    $updatable->save();
                    return $bet_result === 1;
                }
            }
        };

        $invoices = \App\Bet::where('result', 0)->groupBy('invoice_id')->get();
        foreach ($invoices as $invoice) {
            $win = true;
            $total_return_amount = 0;
            $to_be_updated = \App\Bet::where('invoice_id', $invoice->invoice_id)->orderBy('country_name')->orderBy('match_date')->get();
            foreach ($to_be_updated as $updatable) {
                $start_date = Carbon::parse(str_replace("/", '-', $updatable->match_date));
                if ($start_date->gt(Carbon::today()->toDate()))
                    continue;
                $start_date = $start_date->toDateString();
                $country_key = \App\Country::where('country_name_ar', 'LIKE', '%' . $updatable->country_name . '%')->first();
                if (!$country_key)
                    continue;
                $country_key = $country_key->country_key;
                $bet_result = $search_database($updatable, $country_key);
                if ($bet_result === null) {
                    $update_database($start_date, $country_key);
                    $bet_result = $search_database($updatable, $country_key);
                }
                $total_return_amount += $updatable->return_amount;
                if ($bet_result === false)
                    $win = false;
            }

            if ($win) {
                $bet_user = User::find($invoice->user_id);
                if ($user) {
                    $bet_user->update([
                        'balance' => $bet_user->balance + $total_return_amount
                    ]);
                    $bet_user->save();
                }
            }
        }
        return;
    }

    public function livesport()
    {
        return view('ui.livesport');
    }


    public function trans()
    {
        // finalise the regular expression, matching the whole line
        $pattern = "/@lang\('(.+?)'\)/m";
        $files = File::allFiles(resource_path('views'));
        $strings=[];
        foreach ($files as $file) {
            $contents=File::get($file->getPathname());
// search, and store all matching occurences in $matches
            if (preg_match_all($pattern, $contents, $matches)) {
                implode("\n", $matches[1]);
            }
            $strings[]=$matches[1];
        }
        $strings = Arr::flatten($strings);
        $langfile = file_get_contents(resource_path('lang/'). 'keywords.json');
        foreach ($strings as $string) {
            $reqKey = trim($string);
            if (!array_key_exists($reqKey, json_decode($langfile, true))) {
                $newArr[$reqKey] = trim($string);
                $itemsss = json_decode($langfile, true);
                $result = array_merge($itemsss, $newArr);
                file_put_contents(resource_path('lang/') . 'keywords.json', json_encode($result));
            }
        }
        $jsonfiles = File::allFiles(resource_path('lang/'));
        foreach ($jsonfiles as $file)
        {
            if ($file->getExtension()=='json') {
                if ($file->getFilename() != 'kewwords.json')
                {
                    $langjson = file_get_contents($file);
                    foreach ($strings as $string) {
                        $reqKey = trim($string);
                        if (!array_key_exists($reqKey, json_decode($langjson, true))) {
                            $newArr[$reqKey] = trim($string);
                            if ($file->getFilename()!='en.json')
                                $newArr[$reqKey] = GoogleTranslate::trans( $newArr[$reqKey], preg_replace("/\\.[^.]*$/", "", $file->getFilename()), 'en');
                            $itemsss = json_decode($langjson, true);

                            $result = array_merge($itemsss, $newArr);
                            file_put_contents(resource_path('lang/') . $file->getFilename(), json_encode($result));
                        }
                    }
                }


            }
        }
        return "Updated all strings successfully";
    }

}
