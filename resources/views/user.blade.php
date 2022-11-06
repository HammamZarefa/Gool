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

    <link rel="stylesheet" href="{{asset('templates/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/custom.css')}}">
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
                            <span id="logins"
                                  style="display: inline-block;float: right;margin-right: -5px;padding-top: 10px; ">
			                    <a href="{{route('home')}}" class="kmenu"
                                   style="text-decoration:none; color: white;">@lang('My Bets')</a>
                                <a href="{{route('profile-setting')}}" class="kmenu"
                                   style="text-decoration:none; color: white;">@lang('My Account')</a>
                                <a href="{{route('transaction')}}" class="kmenu"
                                   style="text-decoration:none; color: white;">@lang('Reports')</a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                   class="kmenu"
                                   style="text-decoration:none;margin-right: 5px; color: white;background: #B40004;">@lang('Logout')</a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                       class="d-none">
                                                @csrf
                                            </form>
                                {{--<div id="txtLimit" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; color:#FF0; font-size:16px;padding-top: 5px; padding-right:7px">Limits : 0,49</div>--}}
		                    </span>
                            <li><a href="javascript:void(0)"><i class="fa fa-wallet"></i> @lang('Balance')
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

                                <li @if(Request::routeIs('livesport')) class="active" @endif><a
                                            href="{{route('livesport')}}"
                                            class="parent-link">@lang('LIVE SPORTS')</a>
                                </li>
                                <li @if(Request::routeIs('blog')) class="active" @endif><a href=""
                                                                                           class="parent-link">@lang('SLOT')</a>
                                </li>

                                <li @if(Request::routeIs('faq')) class="active" @endif><a href=""
                                                                                          class="parent-link">@lang('TOMBALA')</a>
                                </li>
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
{{--ader Section End  -->--}}
<div id="main" class="row">

    @include('user.user-sidebar')
<div class="content col-md-8" >
@yield('content')
</div>
</div>
{{--@include('partials.footer')--}}
<!-- back to top area start -->
<div class="back-to-top">
    <i class="fas fa-chevron-up"></i>
</div>
<!-- back to top area end -->


<script src="{{asset('templates/js/file.min.js')}}"></script>

@yield('load-js')

@include('partials.notify')
@yield('js')

</body>

</html>
