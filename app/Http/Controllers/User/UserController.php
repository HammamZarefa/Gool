<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Trx;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->id();
        $users = User::where('parent', $user)->get();
        return view('user.users.index', compact('users'));
    }

    public function create()
    {
        return view('user.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|max:255',
            'balance' => 'required',
        ]);
        $parent = auth()->user();
        if ($request->balance > $parent->balance || $parent = auth()->user()->is_admin == 0 || $request->balance < 0) {
            session()->flash('Danger', 'Your balance is not enough');
            return back();
        } else {

            DB::beginTransaction();
            try {
                $user = new User();
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->username = $request->username;
                $user->balance = $request->balance;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->password = Hash::make($request->password);
                $user->parent = auth()->id();
                $user->status=1;
                $user->save();
                if ($request->balance != 0) {
                    auth()->user()->balance -= $request->balance;
                    auth()->user()->save();
                    $trx = New Trx();
                    $trx->user_id = auth()->id();
                    if ($request->balance > 0)
                        $trx->outcome = $request->balance;
                    else
                        $trx->income = $request->balance;
                    $trx->balance = auth()->user()->balance;
                    $trx->date = Now();
                    $trx->trx = 'trx' . auth()->id() . $request->balance . $user->id;
                    $trx->details='شحن رصيد ل '.$user->username;
                    $trx->save();
                    $trxs = New Trx();
                    $trxs->user_id =$user->id;
                    if ($request->balance < 0)
                        $trxs->outcome = $request->balance;
                    else
                        $trxs->income = $request->balance;
                    $trxs->balance = $user->balance;
                    $trxs->date = Now();
                    $trxs->trx = 'trx' .$user->id . $request->balance .auth()->id()  ;
                    $trxs->details='شحن رصيد من '.auth()->user()->username;
                    $trxs->save();
                };
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                session()->flash('danger', 'Error ' . $e->getMessage());
                return redirect(route('user.users'));
            }
            session()->flash('success', 'Created Successfully');
            return redirect(route('user.users'));
        }
    }

    public function edit($id)
    {
        $user = User::findorfail($id);
        if ($user->parent != auth()->id())
            return back()->with('Access Denied');
        else
            return view('user.users.edit', compact('user'));

    }

    public function update($id, Request $request)
    {
        $user = User::findorfail($id);
        $parent = auth()->user();
        if ($parent->id != $user->parent || $parent->balance < $request->added_balance) {
            session()->flash('danger', 'Your balance is not enough');
            return back();
        } else {
            DB::beginTransaction();
            try {
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->balance += $request->added_balance;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->status = $request->status;
                $user->save();
                if ($request->added_balance != 0) {
                    $parent->balance -= $request->added_balance;
                    $parent->save();
                    $trx = New Trx();
                    $trx->user_id = auth()->id();
                    if ($request->added_balance > 0)
                        $trx->outcome = $request->added_balance;
                    else
                        $trx->income = $request->added_balance;
                    $trx->balance = auth()->user()->balance;
                    $trx->date = Now();
                    $trx->trx = 'trx' . auth()->id() . $request->added_balance . $user->id;
                    $trx->details='شحن رصيد ل '.$user->username;
                    $trx->save();
                    $trxs = New Trx();
                    $trxs->user_id =$user->id;
                    if ($request->added_balance < 0)
                        $trxs->outcome = $request->added_balance;
                    else
                        $trxs->income = $request->added_balance;
                    $trxs->balance = $user->balance;
                    $trxs->date = Now();
                    $trxs->trx = 'trx' .$user->id . $request->added_balance .auth()->id()  ;
                    $trxs->details='شحن رصيد من '.auth()->user()->username;
                    $trxs->save();
                };

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
            }
            session()->flash('success', 'Updated Successfully');
            return redirect(route('user.users'));
        }
    }

    public function status($id)
    {
        $user = User::findorfail($id)->where('parent', auth()->id());
        $user->status == 1 ? $user->status = 0 : $user->status = 1;
        session()->flash('success', 'Updated Successfully');
        return back();
    }
}

