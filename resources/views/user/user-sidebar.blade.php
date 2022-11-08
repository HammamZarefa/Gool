<div class="col-md-3 padding-top: 50px ">
    <div class="card mt-2">
        <div class="card-body ">
            <div class="user-menu list-group">
                <a href="{{route('profile-setting')}}" class="@if(Request::routeIs('profile-setting')) active @endif list-group-item list-group-item-action">Account Information <i class="mdi mdi-face-profile float-right"></i></a>
                <a href="{{route('password-setting')}}" class="@if(Request::routeIs('password-setting')) active @endif list-group-item list-group-item-action">Change Password<i class="mdi mdi-key float-right"></i></a>
                <a href="{{route('home')}}" class="@if(Request::routeIs('home') || Request::routeIs('invoice_bet')) active @endif list-group-item list-group-item-action ">Sports Bets<i class="mdi mdi-wallet float-right"></i></a>
                <a href="{{route('transaction')}}" class="@if(Request::routeIs('transaction')) active @endif list-group-item list-group-item-action ">Account Movements <i class="mdi mdi-mail float-right"></i></a>
                {{--<a href="{{route('money-transfer')}}" class="@if(Request::routeIs('money-transfer')) active @endif list-group-item list-group-item-action ">Money Transfer <i class="mdi mdi-phone float-right"></i></a>--}}
                {{--<a href="{{route('payment')}}" class="@if(Request::routeIs('payment')) active @endif  list-group-item list-group-item-action">Deposit Money<i class="mdi mdi-stack-exchange float-right"></i></a>--}}
                {{--<a href="{{route('depositLog')}}" class="@if(Request::routeIs('depositLog')) active @endif list-group-item list-group-item-action ">Deposit Log <i class="mdi mdi-stack-exchange float-right"></i></a>--}}
                @if(auth()->user()->is_admin==1)
                   <a href="{{route('user.users')}}" class="@if(Request::routeIs('user.users')) active @endif list-group-item list-group-item-action ">Users <i class="mdi mdi-stack-exchange float-right"></i></a>
                @endif
                {{--<a href="{{route('user.transferSEND',[$user->id])}}" class="@if(Request::routeIs('user.transferSEND')) active @endif list-group-item list-group-item-action">Money Transfer <small class="float-right"> (Send)</small></a>--}}
                {{--<a href="{{route('user.transferRECEIVE',[$user->id])}}" class="@if(Request::routeIs('user.transferRECEIVE')) active @endif  list-group-item list-group-item-action ">Money Transfer <small class="float-right"> (Receive)</small></a>--}}
                {{--<a href="{{route('user.transactionLog',[$user->id])}}" class="@if(Request::routeIs('user.transactionLog')) active @endif  list-group-item list-group-item-action">Transaction <i class="mdi mdi-stack-exchange float-right"></i></a>--}}
                {{--<a href="{{route('user.loginLogs',[$user->id])}}" class="@if(Request::routeIs('user.loginLogs')) active @endif list-group-item list-group-item-action">Login History <i class="mdi mdi-information float-right"></i></a>--}}

            </div>
        </div>
    </div>
</div>
