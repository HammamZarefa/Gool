<!DOCTYPE html>
<html lang="ar" translate="yes">
<?php $activeTemplateTrue='templates/cash2bets/' ?>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$basic->sitename}} @isset($page_title) | {{@$page_title}} @endif</title>
    <meta name="keywords" content="{{$basic->meta_keywords}}" />
    <meta name="description" content="{{$basic->meta_description}}"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Source+Sans+Pro:400,600,700&amp;display=swap" rel="stylesheet">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('images/logo/favicon.png')}}" type="image/x-icon">
    <!-- bootstrap css -->
    {{--<link rel="stylesheet" href="{{asset('templates/css/file.min.css')}}">--}}
    @yield('load-css')
    @yield('css')
    {{--<!-- responsive css -->--}}
    {{--<link rel="stylesheet" href="{{asset('templates/css/responsive.css')}}">--}}
    {{--<!-- jquery js -->--}}
    {{--<script src="{{asset('templates/js/jquery-1.10.2.min.js')}}"></script>--}}

    <script src="{{asset($activeTemplateTrue.'js/numberFormat154.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'js/jquery-1.6.4.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'js/jquery-ui.js')}}"></script>
    {{--<script src="{{asset($activeTemplateTrue.'js/source/jquery.fancybox.js')}}"></script>--}}
    <script src="{{asset($activeTemplateTrue.'js/bahisgirisi.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'js/jqNewsV2.0.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'js/sliderengine/amazingslider.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'js/sliderengine/initslider-1.js')}}"></script>
    {{--<script src="{{asset($activeTemplateTrue.'js/cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js')}}"></script>--}}
    <script src="{{asset($activeTemplateTrue.'js/BET_Betting.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'js/SpryHTMLPanel.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'js/jquery.blockUI.js')}}"></script>
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/tooltipster.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/BET.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/source/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/reset.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/core.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/accordion.core.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/jquery-ui.css')}}">
    <script src="{{asset($activeTemplateTrue.'js/jquery-ui.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'source/jquery.fancybox.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'js/jquery.vticker.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'js/limitgetir.js')}}"></script>
    <script type="6eed67c099493e1b4f7bf9d9-text/javascript">
		var modal = document.getElementById('myModal');
		var span = document.getElementsByClassName("close")[0];
		var modalok = document.getElementById('myModalok');
	</script>
    <script language="javascript" type="text/javascript">
        var dragapproved=false
        var minrestore=0
        var initialwidth,initialheight
        var ie5=document.all&&document.getElementById
        var ns6=document.getElementById&&!document.all

        function hesapla() {
            document.getElementById("kazanctut").value = document.getElementById("kazanc").value * document.getElementById("tutar").value
            document.getElementById("kazanctut").value = numeral(document.getElementById("kazanctut").value).format('0,0.00')
        }

        function iecompattest(){
            return (!window.opera && document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
        }
    </script>
    <script type="text/javascript">
        ( function( $ ) {
            $( document ).ready(function() {
                $('.fancybox').fancybox();
                $('#cssmenu > ul > li > a').click(function() {
                    $('#cssmenu li').removeClass('active');
                    $(this).closest('li').addClass('active');
                    var checkElement = $(this).next();
                    if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                        $(this).closest('li').removeClass('active');
                        checkElement.slideUp('normal');
                    }
                    if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                        $('#cssmenu ul ul:visible').slideUp('normal');
                        checkElement.slideDown('normal');
                    }
                    if($(this).closest('li').find('ul').children().length == 0) {
                        return true;
                    } else {
                        return false;
                    }
                });
            });
        } )( jQuery );
    </script>
    @stack('style-lib')
    <style type="text/css">
        /* Modal Content */
        .mymodal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 50%;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        .mymodal-header {
            padding: 2px 16px;
            background-color: #000;
            color: white;
        }

        .mymodal-body {padding: 2px 16px;}

        .mymodal-footer {
            padding: 2px 16px;
            background-color: #000;
            color: white;
        }


        @import url(http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);

        @import url(http://fonts.googleapis.com/css?family=Open+Sans:400,600,300);
        @charset "UTF-8";
        /* Base Styles */
        #cssmenu,
        #cssmenu ul,
        #cssmenu li,
        #cssmenu a {
            margin: 0;
            padding: 0;
            border: 0;
            list-style: none;
            font-weight: normal;
            text-decoration: none;
            line-height: 1;
            font-family: 'Open Sans', sans-serif;
            font-size: 14px;
            position: relative;
        }
        #cssmenu {
            width: 100%;
            border-bottom: 4px solid #5b5c53;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }
        #cssmenu a {
            line-height: 1.3;
        }
        #cssmenu > ul > li:first-child {
            background: linear-gradient(to bottom,#995656 15%,#680202 58%);
            -webkit-border-radius: 3px 3px 0 0;
            -moz-border-radius: 3px 3px 0 0;
            border-radius: 3px 3px 0 0;
            color: #FFF;
        }
        #cssmenu > ul > li:first-child > a {
            padding: 15px 10px;
            border: none;
            font-family: 'Ubuntu', sans-serif;
            text-align: center;
            font-size: 18px;
            font-weight: 300;
            color: #FFF;
        }
        #cssmenu > ul > li:first-child > a > span {
            padding: 0;
        }
        #cssmenu > ul > li:first-child:hover {
            background: linear-gradient(to bottom,#995656 15%,#680202 58%);}
        #cssmenu > ul > li {
            background: linear-gradient(to bottom, #205ca2 0%,#0f2d50 100%);
        }
        #cssmenu > ul > li:hover {
            background: linear-gradient(#4a4a4a 0%, #000000 100%);
        }
        #cssmenu > ul > li > a {
            font-size: 14px;
            display: block;
            background: url(images/pattern.png) top left repeat;
            color: #000000;
            border-top: none;
        }
        #cssmenu > ul > li > a > span {
            display: block;
            padding: 12px 10px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
        }
        #cssmenu > ul > li > a:hover {
            text-decoration: none;
        }
        #cssmenu > ul > li.active {
            border-bottom: none;
        }
        #cssmenu > ul > li.has-sub > a span {
            /*background: url(images/icon_plus.png) 96% center no-repeat;*/
        }
        #cssmenu > ul > li.has-sub.active > a span {
            /*background: url(images/icon_minus.png) 96% center no-repeat;*/
        }
        /* Sub menu */
        #cssmenu ul ul {
            display: none;
            background: #fff;
            border-right: 1px solid #a2a194;
            border-left: 1px solid #a2a194;
        }
        #cssmenu ul ul li {
            padding: 0;
            border-bottom: 1px solid #d4d4d4;
            border-top: none;
            background: #f7f7f7;
            background: -moz-linear-gradient(#f7f7f7 0%, #ececec 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f7f7f7), color-stop(100%, #ececec));
            background: -webkit-linear-gradient(#f7f7f7 0%, #ececec 100%);
            background: linear-gradient(#f7f7f7 0%, #ececec 100%);
        }
        #cssmenu ul ul li:last-child {
            border-bottom: none;
        }
        #cssmenu ul ul a {
            padding: 8px 0px 0px 0px;
            display: block;
            color: #FFFFFF;
            font-size: 14px;
            font-weight: 900;
        }
        #cssmenu ul ul a:before {
            position: absolute;
            color: #f9ff00;
        }
        #cssmenu ul ul a:hover {
            color: #f9ff00;
        }

        @keyframes slidy {
            0% { left: 0%; }
            20% { left: 0%; }
            25% { left: -100%; }
            45% { left: -100%; }
            50% { left: -200%; }
            70% { left: -200%; }
            75% { left: -300%; }
            95% { left: -300%; }
            100% { left: -400%; }
        }

        body { margin: 0; }
        div#slider { overflow: hidden; }
        div#slider figure img { width: 20%; float: left; }
        div#slider figure {
            position: relative;
            width: 500%;
            margin: 0;
            left: 0;
            text-align: left;
            font-size: 0;
            animation: 30s slidy infinite;
        }

        .buttonA {
            color: white;
            float: left;
            font-weight: bold;
            margin-bottom: 5px;
            padding: 5px 0;
            text-align: center;
            text-decoration: none;
            text-shadow: 0 1px 1px black;
            text-transform: uppercase;
            font-family: "Open Sans";
            font-size: 18px;
            border-radius: 2px;
            background: linear-gradient(to bottom, #205ca2 0%,#0f2d50 100%);
            width: 220px;
            cursor: pointer;
        }

    </style>
    @stack('style')

</head>

<body>
<script type="6eed67c099493e1b4f7bf9d9-text/javascript">
		$(document).ready(function() {

			$('.fancybox').fancybox();

		});
	</script>
<style media="screen" type="text/css">
    .placeholder {
        color: #aaa;
    }

    .button {
        font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
        color: #ffffff;
        font-size: 11px;
        padding-top: 2px;
        padding-right: 13px;
        padding-bottom: 3px;
        padding-left: 13px;
        text-decoration: none;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        border: solid #000000 0px;
        background: #222222;
        /*
            background: -webkit-gradient(linear, 0 0, 0 100%, from(#555555), to(#111111));
         background: -moz-linear-gradient(top, #555555, #111111);
       */
    }
    .button:hover {
        background: #444444;
    }

    ::-webkit-scrollbar {
        width: 0.5em;
        height: 0.8em; }

    ::-webkit-scrollbar-button {
        background: #ffa20f; }

    ::-webkit-scrollbar-track-piece {
        background: #ffa20f; }

    ::-webkit-scrollbar-thumb {
        background: #151b29; }


</style>



<div align="center">
    <div id="top" style="width: 1200px; height: 120px; padding-top:20px">
        <div id="logo" style="display: inline-block; float:left; width: 300px;"><a href="default.asp"><img src="{{asset('templates/images/logo.png')}}" style="height: 110px; width: 300px;"/></a></div>
        <div id="loginbox" style="display: inline-block; margin-top: 0px; width: 890px; text-align:right;padding-right: 10px;">
		<span id="flags" style="display: inline-block; width: 750px; ">
			<span style="display: inline-block; width: 30px;"><a href="default.asp?lng=tr"><img class="bayraktr" src="{{asset('templates/img/trflag.png')}}"/></a></span>
			<span style="display: inline-block; width: 30px;"><a href="default.asp?lng=en"><img class="bayraken" src="{{asset('templates/img/enflag.png')}}"/></a></span>
			<span style="display: inline-block; width: 30px;"><a href="default.asp?lng=ar"><img class="bayraken" src="{{asset('templates/img/iraqflag.png')}}"/></a></span>
		</span>
            <span id="logins" style="display: inline-block;    float: right;    margin-right: -5px;    padding-top: 10px; ">
			<a href="sportbets.asp" class="kmenu" style="text-decoration:none; color: white;">bahis listem</a> <a href="accounts.asp" class="kmenu" style="text-decoration:none; color: white;">hesabım</a> <a href="acctperiods.asp" class="kmenu" style="text-decoration:none; color: white;">raporlar</a> <a href="logout.asp" class="kmenu" style="text-decoration:none;margin-right: 5px; color: white;background: #B40004;">çıkış</a> <div id="txtLimit" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; color:#FF0; font-size:16px;padding-top: 5px; padding-right:7px">???</div>
		</span>
        </div>
    </div>
    <div  style="height: 45px;min-width:1200px;background:-webkit-linear-gradient(top, #a24420 0%,#500f0f 100%)">
        <div style="width:1200px; text-align:center">
            <a onclick="if (!window.__cfRLUnblockHandlers) return false; location.href='default.asp';" class="sports" data-cf-modified-6eed67c099493e1b4f7bf9d9-="">Spor Bahisleri</a>
            <a onclick="if (!window.__cfRLUnblockHandlers) return false; location.href='live.asp';" class="casinos" data-cf-modified-6eed67c099493e1b4f7bf9d9-="">Canlı Maçlar</a>
            <a onclick="if (!window.__cfRLUnblockHandlers) return false; location.href='slots.asp';" class="casinos" data-cf-modified-6eed67c099493e1b4f7bf9d9-="">SLOT</a>
            <a onclick="if (!window.__cfRLUnblockHandlers) return false; location.href='tombala.asp';" class="casinos" data-cf-modified-6eed67c099493e1b4f7bf9d9-="">TOMBALA</a>
        </div>
    </div>
</div>


<SCRIPT language=javascript type="6eed67c099493e1b4f7bf9d9-text/javascript">

	showLimit();

</SCRIPT>

<script type="6eed67c099493e1b4f7bf9d9-text/javascript">
		var xmlHttpB
		var xmlHttpBc
		function GetXmlHttpObject()
		{
		if (window.XMLHttpRequest)
		  { return new XMLHttpRequest(); }
		if (window.ActiveXObject)
		  { return new ActiveXObject("Microsoft.XMLHTTP"); }
		return null;
		}

		function createuser(idge)
		{
			xmlHttpBc=GetXmlHttpObject();
			if (xmlHttpBc==null)
			 {
				return;
			 }
			var url="/newslot2/createPlayer.php?idge=" + idge;
			xmlHttpBc.open("GET",url,true);
			xmlHttpBc.send(null);
		}


		function getphpid(idge)
		{
			xmlHttpB=GetXmlHttpObject();
			if (xmlHttpB==null)
			 {
				return;
			 }
			var url="/newslot2/getses.php?idge=" + idge;
			xmlHttpB.open("GET",url,true);
			xmlHttpB.send(null);
		}

		//getphpid('8001');
		//createuser('ZD8001');
		</script>


@yield('content')
{{--@include('partials.footer')--}}

{{--<!-- back to top area start -->--}}
{{--<div class="back-to-top">--}}
    {{--<i class="fas fa-chevron-up"></i>--}}
{{--</div>--}}
<!-- back to top area end -->



<!-- The Modal -->
<div id="myModalred" class="modal" style="display: none; position: fixed; z-index: 1; padding-top: 100px; left: 0; top: 0;  width: 100%;  height: 100%; overflow: auto;">

    <!-- Modal content -->
    <div class="mymodal-content">
        <div class="mymodal-header">
            <h2></h2>
        </div>
        <div class="mymodal-body">
            </br>
            <p align="center"><img src="images/close3.png"></p>
            <p align="center">Kuponunuz ONAYLANMAMIŞTIR</p>
            </br>
        </div>
        <div class="mymodal-footer">
            <h3></h3>
        </div>
    </div>

</div>


<!-- The Modal -->
<div id="myModalok" class="modalok" style="display: none; position: fixed; z-index: 1; padding-top: 100px; left: 0; top: 0;  width: 100%;  height: 100%; overflow: auto;">

    <!-- Modal content -->
    <div class="mymodal-content">
        <div class="mymodal-header">
            <h2></h2>
        </div>
        <div class="mymodal-body">
            </br>
            <p align="center"><img src="images/done.png"></p>
            <p align="center">Kuponunuz onaylanmıştır</p>
            </br>
        </div>
        <div class="mymodal-footer">
            <h3></h3>
        </div>
    </div>

</div>

<div id="dwindow" style="position:absolute;background-color:#FFFFFF;cursor:hand;left:0px;top:0px;display:none;" onClick="if (!window.__cfRLUnblockHandlers) return false; closeit()" data-cf-modified-6eed67c099493e1b4f7bf9d9-="">
    <div align="right" style="background-color:#252525;width:100%;height:25px">
        <img src="error.gif" onClick="if (!window.__cfRLUnblockHandlers) return false; closeit()" align="middle" data-cf-modified-6eed67c099493e1b4f7bf9d9-=""></div>
    <div id="dwindowcontent" style="height:100%">
        <iframe id="cframe" src="" width=100% height="100%" name="test" border="0" frameborder="0"></iframe>
    </div>
</div>
<DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>




<div align="center" style="min-width: 1200px;" >
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="background-color:#000">
        <tr>
            <td colspan="2"><hr></td>
        </tr>
        <tr>
            <td width="60%" valign="top" height="35" align="left" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:12px; padding-top:5px; color:#FFF">Weekly Fixture : &nbsp;&nbsp;<a href="fixturAR.pdf" class="kmenuALT">ARABIC</a>&nbsp;-&nbsp;<a href="fixturTR.pdf" class="kmenuALT">TURKISH</a>&nbsp;-&nbsp;<a href="fixturEN.pdf" class="kmenuALT">ENGLISH</a>&nbsp;&nbsp;&nbsp;Daily Fixture: &nbsp;&nbsp;<a href="fixturARG.pdf" class="kmenuALT">ARABIC</a>&nbsp;-&nbsp;<a href="fixturTRG.pdf" class="kmenuALT">TURKISH</a>&nbsp;-&nbsp;<a href="fixturENG.pdf" class="kmenuALT">ENGLISH</a></td>
            <td width="40%" rowspan="2" align="right" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:10px; padding-top:1px; color: #FF0"><span style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:10px; padding-top:1px; color:#FFF"><img src="images/security-trust.png" width="408" height="45"></span></td>
        </tr>
        <tr>
            <td valign="top" height="35" align="left" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:12px; padding-top:5px; color: #CCC">tüm hakları saklıdır - CASHTOBETS</td>
        </tr>
        <tr>
            <td colspan="2" background="images/gradient_wb_small.gif">&nbsp;</td>
        </tr>
    </table>
</div>

<SCRIPT language=javascript type="6eed67c099493e1b4f7bf9d9-text/javascript">
function toggle(box) {
 if( document.getElementById(box).style.display=='none' ){
   document.getElementById(box).style.display = '';
 }else{
   document.getElementById(box).style.display = 'none';
 }
}
function togglec(box) {
   document.getElementById(box).style.display = '';
}
function togglek(box) {
   document.getElementById(box).style.display = 'none';
}
showonlineliste('0','ALL','1');
showonlinelistenext();

//gununcanlilarinigetirZ3();

showsonbes();

</SCRIPT>
<script type="6eed67c099493e1b4f7bf9d9-text/javascript">

            $('#example1, #example3').accordion();
            $('#example2').accordion({
                canToggle: true
            });
            $('#example4').accordion({
                canToggle: true,
                canOpenMultiple: true
            });
            $(".loading").removeClass("loading");

</script>

<script src="/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="6eed67c099493e1b4f7bf9d9-|49" defer=""></script>
</body>

</html>
