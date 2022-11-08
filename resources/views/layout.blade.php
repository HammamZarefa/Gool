<!DOCTYPE html>
<html lang="ar" translate="yes">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=1024">
    <title>{{$basic->sitename}} @isset($page_title) | {{@$page_title}} @endif</title>
    <meta name="keywords" content="{{$basic->meta_keywords}}"/>
    <meta name="description" content="{{$basic->meta_description}}"/>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Source+Sans+Pro:400,600,700&amp;display=swap"
          rel="stylesheet">


    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('images/logo/favicon.png')}}" type="image/x-icon">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('templates/css/file.min.css')}}">
@yield('load-css')

@yield('css')
<!-- responsive css -->
    <link rel="stylesheet" href="{{asset('templates/css/responsive.css')}}">
    <!-- jquery js -->
    <script src="{{asset('templates/js/jquery-1.10.2.min.js')}}"></script>
</head>

<body>


<!--  Header Section Start  -->
<div class="header-section home-3">
    <div class="info-area">
        <div class="container">
            <div class="row align-items-center">
                {{--@include('partials.social')--}}
                <div class="col-md-6">
                    <a class="logo-wrapper" href="{{route('site')}}"><img src="{{asset('images/logo/logo.png')}}"
                                                                          alt=""></a>
                </div>
                <div class="col-md-6 ">
                    <ul class="socials text-end">
                       @include('partials.language')
                        @guest()
                            <form id="logins" method="post" action="{{route('login')}}">
                                @csrf
                                <span class='spn1' style="display: inline-block; width:120px"><input
                                            placeholder="UserName" type="text" name="username"></span>
                                <span class='spn2' style="display: inline-block;width: 120px;"><input
                                            placeholder="password" type="password" name="password"></span>
                                <span class='spn3' style="display: inline-block;width: 120px;"><input type="submit"
                                                                                                      class="button"
                                                                                                      value="Login"
                                                                                                      id="giris"></span>
                            </form>
                        @endguest
                        @auth
                            <span id="logins" style="display: inline-block;float: right;margin-right: -5px;padding-top: 10px; ">
			                    <a href="{{route('home')}}" class="kmenu" style="text-decoration:none; color: white;">@lang('My Bets')</a>
                                <a href="{{route('profile-setting')}}" class="kmenu" style="text-decoration:none; color: white;">@lang('My Account')</a>
                                <a href="{{route('transaction')}}" class="kmenu" style="text-decoration:none; color: white;">@lang('Reports')</a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                   class="kmenu" style="text-decoration:none;margin-right: 5px; color: white;background: #B40004;">@lang('Logout')</a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                       class="d-none">
                                                @csrf
                                            </form>
                                {{--<div id="txtLimit" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; color:#FF0; font-size:16px;padding-top: 5px; padding-right:7px">Limits : 0,49</div>--}}
		                    </span>
                            <li class="pt-2"><a href="javascript:void(0)"><i class="fa fa-wallet"></i> @lang('Balance')
                                    : {{number_format(Auth::user()->balance,$basic->decimal)}}</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--  Navbar Area Start  -->
    <div class="nav-area ">
        <div class="main-menu">
            <div class="container">
                <div class="row align-items-center position-relative">
                    {{--<div class="col-lg-3 col-6 ">--}}
                    {{--<a class="logo-wrapper" href="{{route('site')}}"><img src="{{asset('images/logo/logo.png')}}" alt=""></a>--}}
                    {{--</div>--}}
                    <div class="col-lg-12 col-12 position-static">
                        <nav>
                            <ul class="menus" id="mainMenu">
                                <li @if(Request::routeIs('site')) class="active" @endif><a href="{{route('site')}}"
                                                                                           class="parent-link">@lang('SPORTS BETS')</a>
                                </li>

                                <li @if(Request::routeIs('livesport')) class="active" @endif><a href="{{route('livesport')}}"
                                                                                            class="parent-link">@lang('LIVE SPORTS')</a>
                                </li>
                                <li @if(Request::routeIs('blog')) class="active" @endif><a href=""
                                                                                           class="parent-link">@lang('SLOT')</a>
                                </li>

                                <li @if(Request::routeIs('faq')) class="active" @endif><a href=""
                                                                                          class="parent-link">@lang('TOMBALA')</a>
                                </li>
                                {{--<li @if(Request::routeIs('contact')) class="active" @endif><a--}}
                                {{--href="{{route('contact')}}" class="parent-link">@lang('Contact Us')</a></li>--}}


                                {{--@guest--}}
                                {{--<li class="dropdown">--}}
                                {{--<a href="#" class="parent-link">@lang('Account')</a>--}}
                                {{--<ul class="dropdown-lists">--}}
                                {{--<li><a href="{{route('login')}}">@lang('Sign In')</a></li>--}}
                                {{--<li><a href="{{route('register')}}">@lang('Sign Up')</a></li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--@endguest--}}
                                {{--@auth--}}
                                    {{--<li class="dropdown">--}}
                                        {{--<a href="javascript:void(0)" class="parent-link">{{Auth::user()->username}}</a>--}}
                                        {{--<ul class="dropdown-lists">--}}
                                            {{--<li><a href="{{route('home')}}">@lang('Dashboard')</a></li>--}}
                                            {{--<li><a href="{{ route('logout') }}"--}}
                                                   {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">@lang('Logout')</a>--}}
                                            {{--</li>--}}

                                            {{--<form id="logout-form" action="{{ route('logout') }}" method="POST"--}}
                                                  {{--class="d-none">--}}
                                                {{--@csrf--}}
                                            {{--</form>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}
                                {{--@endauth--}}


                            </ul>

                            <div id="mobileMenu"></div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Navbar Area End  -->
</div>
<!--  Header Section End  -->
<style>
    a{
        text-decoration: none;
    }

    .clickable{
        cursor: pointer;
    }

    .float-right{
        float: right;
    }

    .float-left{
        float: left;
    }

    /* .left-panel {
         max-height: 90vh;
         overflow-y: auto;
     }*/

    .left-panel .header{
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .left-panel .sublist-header{
        position: sticky;
        top: 100px;
        z-index: 100;
    }

    /* .matches-table{
         max-height: 90vh;
         overflow-y: auto;
     }*/

    .matches-table .header{
        position: sticky;
        top: 0;
        z-index: 100;
    }
    /*    alaa mhna new edit       */
    /*        .bets-table{
                max-height: 90vh;
                overflow-y: auto;
            }
    */
    .bets-table .header{
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .loading-spinner{
        position: absolute;
        top: 0;
        height: 100%;
        width: 100%;
        left: 0;
        z-index: 99999;
    }

    .input-group-text{
        min-width: 100px;
    }

    .opponent, .bet-info, .sub-opponent{
        cursor: pointer;
    }

    .opponent:hover, .draw:hover{
        color: black;
    }

    .main-container h2, .live-container h2{
        margin-bottom: 0.25rem !important;
    }

    .main-container span, .live-container span{
        font-size: 12px;!important;
        /*color: #fff !important;*/
    }

    .main-container h2::after, .live-container h2::after{
        display: none !important;
    }


    @media  screen and (max-width: 568px) {
        .left-panel .sublist-header{
            top: 50px;
        }

        .mt-sm-3{
            margin-top: 1rem;
        }

        .mt-sm-2{
            margin-top: 0.75rem;
        }

        .matches-table{
            zoom: 0.3;
        }

        .ps-sm-2{
            padding-left: 1.5rem;
        }

        .float-right{
            float: unset !important;
        }

        .float-left{
            float: unset !important;
        }

    }

    .font-sm{
        font-size: 14px;
    }

    .match, .live-match{
        overflow: auto;
        font-size: 11px;
    }

    .bg-primary{
        background-color: #151b29 !important;
    }
    @media  screen and (max-width: 768px) {
        .matches-table{
            zoom: 0.5;
        }
    }

     .check{
         background: linear-gradient(to bottom,#33dd65 0%,#069e32 27%);
     }
    .divmatch{
        margin-bottom: 3px;
    }
    .divmatch span{
        margin-bottom: 3px;
        font-size: 10px!important;
    }

    .bet-details{
        margin-right: -12px;!important;
        margin-left: 10px;!important;
    }
    #betid{
        margin-left: 0!important;
    }

</style>

@yield('content')
{{--@include('partials.footer')--}}
<div class="footer-bottom">
    <p class="font-11 text-black-777 m-0"><a target="_blank" href="https://www.facebook.com/AllSafeMHR">©All Safe</a></p>
</div>
<!-- back to top area start -->
<div class="back-to-top">
    <i class="fas fa-chevron-up"></i>
</div>
<!-- back to top area end -->


<!-- popper js -->
<script src="{{asset('templates/js/file.min.js')}}"></script>

@yield('load-js')

@include('partials.notify')
@yield('js')

{{--<link rel="alternate" hreflang="en" href="https://gool10bets.site">--}}
{{--<link rel="alternate" hreflang="ar" href="https://gool10bets.site">--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
{{--<script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>--}}
<script>
    Weglot.initialize({
        api_key: 'wg_00cb8f77c0699f8adc14dfbfa51436741'
    });
</script>
</body>

</html>
