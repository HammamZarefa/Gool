<style media="screen" type="text/css">
    body
    {
        margin: 0px;
        background-color:#000
    }
    .buttonA {
        color: white;
        float: left;
        font-weight: bold;
        margin-bottom: 5px;
        padding: 15px 0;
        text-align: center;
        text-decoration: none;
        text-shadow: 0 1px 1px black;
        text-transform: uppercase;
        font-family: "Open Sans";
        font-size: 18px;
        border-radius: 2px;
        background: linear-gradient(to bottom, #58a220 0%,#22500f 100%);
        width: 260px;
        cursor: pointer;
        height: 20px;
    }
    .buttonB {
        color: white;
        float: left;
        font-weight: bold;
        margin-bottom: 5px;
        padding: 15px 0;
        text-align: center;
        text-decoration: none;
        text-shadow: 0 1px 1px black;
        text-transform: uppercase;
        font-family: "Open Sans";
        font-size: 18px;
        border-radius: 2px;
        background: linear-gradient(to bottom, #a22020 0%,#500f0f 100%);
        width: 260px;
        cursor: pointer;
        height: 20px;
    }

</style>
<nav id="sidebar-nav">
    <td width="270" valign="top" align="left" style="padding-top:20px">
        <table width="270" border="0" cellspacing="0" cellpadding="0">
            <tbody><tr>
                <td valign="top" align="left">
                    <div id="accordian" style="height:500px">
                        <ul>
                            <li>

                                <div style="float:left; margin-bottom:6px; margin-top:-5px;">
                                    <a href="{{route('profile-setting')}}" class="buttonA">Account Information</a>
                                </div>
                                <div style="float:left; margin-bottom:6px; margin-top:0px;">
                                    <a href="{{route('password-setting')}}" class="buttonA">Change Password</a>
                                </div>
                                <div style="float:left; margin-bottom:6px; margin-top:0px;">
                                    <a href="{{route('home')}}" class="buttonB">Sports Bets</a>
                                </div>
                                <div style="float:left; margin-bottom:6px; margin-top:0px;">
                                    <a href="{{route('transaction')}}" class="buttonA">Account Movements</a>
                                </div>
                                <div style="float:left; margin-bottom:6px; margin-top:0px;">
                                    <a href="{{route('money-transfer')}}" class="buttonA">Money Transfer</a>
                                </div>
                                <div style="float:left; margin-bottom:6px; margin-top:0px;">
                                    <a href="{{route('payment')}}" class="buttonA">Deposit Money</a>
                                </div>
                                <div style="float:left; margin-bottom:6px; margin-top:0px;">
                                    <a href="{{route('depositLog')}}" class="buttonA">Deposit Log</a>
                                </div>
                                <div style="float:left; margin-bottom:6px; margin-top:0px;">
                                    <a href="{{route('user.users')}}" class="buttonA">Users</a>
                                </div>


                            </li>

                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            </tbody></table>
    </td>
</nav>

