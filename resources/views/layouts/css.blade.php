    <meta charset="utf-8">
    <title>MyErp | PME PMI solution</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <!-- #CSS Links -->
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('HTML_version/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('HTML_version/css/font-awesome.min.css') }}">

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('HTML_version/css/smartadmin-production-plugins.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('HTML_version/css/smartadmin-production.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('HTML_version/css/smartadmin-skins.min.css') }}">

    <!-- SmartAdmin RTL Support -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('HTML_version/css/smartadmin-rtl.min.css') }}"> 

    <!-- We recommend you use "your_style.css" to override SmartAdmin
         specific styles this will also ensure you retrain your customization with each SmartAdmin update.
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('HTML_version/css/your_style.css') }}"> -->

    <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('HTML_version/css/demo.min.css') }}">

    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="{{ asset('HTML_version/img/favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('HTML_version/img/favicon/favicon.ico') }}" type="image/x-icon">

    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    <!-- #APP SCREEN / ICONS -->
    <!-- Specifying a Webpage Icon for Web Clip 
         Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
    <link rel="apple-touch-icon" href="{{ asset('HTML_version/img/splash/sptouch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('HTML_version/img/splash/touch-icon-ipad.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('HTML_version/img/splash/touch-icon-iphone-retina.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('HTML_version/img/splash/touch-icon-ipad-retina.png') }}">
    
    <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    
    <!-- Startup image for web apps -->
    <link rel="apple-touch-startup-image" href="{{ asset('HTML_version/img/splash/ipad-landscape.png') }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="{{ asset('HTML_version/img/splash/ipad-portrait.png') }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="{{ asset('HTML_version/img/splash/iphone.png') }}" media="screen and (max-device-width: 320px)">
    <link rel="stylesheet" href="{{ asset('dist/css/qrcode-reader.css') }}">

    <link href="{{ asset('alert/alert/css/alert.css') }}" rel="stylesheet" />
    <link href="{{ asset('alert/alert/themes/default/theme.css') }}" rel="stylesheet" />
    <script src="{{ asset('HTML_version/js/libs/jquery-2.1.1.min.js') }}"></script>
			<style>
                .tablebutton {
    border: solid 1px #b1b8bf;
    padding: 1px 5px;
    min-width: 32px;
    font-weight: bold;
    line-height: 13px;
    text-shadow: 0 1px 1px rgba(255, 255, 255, 0.5);
    color: #424e58;
    background-color: #f4f6f9;
    background-image: linear-gradient(#fff, #eceef4 99%, #eceef4);
    background-image: -webkit-linear-gradient(#fff, #eceef4 99%, #eceef4);
    background-image: -moz-linear-gradient(#fff, #eceef4 99%, #eceef4);
    background-image: -o-linear-gradient(#fff, #eceef4 99%, #eceef4);
    background-image: -ms-linear-gradient(#fff, #eceef4 99%, #eceef4);
    -pie-background: linear-gradient(#fff, #eceef4 99%, #eceef4);
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    box-shadow: 0 2px rgba(2, 3, 3, 0.05), 0 0 5px #fff inset;
    -webkit-box-shadow: 0 2px rgba(2, 3, 3, 0.05), 0 0 5px #fff inset;
    -moz-box-shadow: 0 2px rgba(2, 3, 3, 0.05), 0 0 5px #fff inset;
    -ms-box-shadow: 0 2px rgba(2, 3, 3, 0.05), 0 0 5px #fff inset;
    -o-box-shadow: 0 2px rgba(2, 3, 3, 0.05), 0 0 5px #fff inset;
}

.tablebutton:hover {
    border: solid 1px #a8b3c4;
    background-color: #dde3e9;
    background-image: linear-gradient(#ebeff5, #d2d9e0);
    background-image: -webkit-linear-gradient(#ebeff5, #d2d9e0);
    background-image: -moz-linear-gradient(#ebeff5, #d2d9e0);
    background-image: -o-linear-gradient(#ebeff5, #d2d9e0);
    background-image: -ms-linear-gradient(#ebeff5, #d2d9e0);
    -pie-background: linear-gradient(#ebeff5, #d2d9e0);
    box-shadow: 0 2px rgba(2, 3, 3, 0.05), 0 2px rgba(255, 255, 255, 0.25) inset, 0 0 5px rgba(255, 255, 255, 0.5) inset;
    -webkit-box-shadow: 0 2px rgba(2, 3, 3, 0.05), 0 2px rgba(255, 255, 255, 0.25) inset, 0 0 5px rgba(255, 255, 255, 0.5) inset;
    -moz-box-shadow: 0 2px rgba(2, 3, 3, 0.05), 0 2px rgba(255, 255, 255, 0.25) inset, 0 0 5px rgba(255, 255, 255, 0.5) inset;
    -ms-box-shadow: 0 2px rgba(2, 3, 3, 0.05), 0 2px rgba(255, 255, 255, 0.25) inset, 0 0 5px rgba(255, 255, 255, 0.5) inset;
    -o-box-shadow: 0 2px rgba(2, 3, 3, 0.05), 0 2px rgba(255, 255, 255, 0.25) inset, 0 0 5px rgba(255, 255, 255, 0.5) inset;
}

.tablebutton.tablebuttonActive {
    border: 1px solid #7991a8;
    box-shadow: 0 0 4px rgba(86, 122, 155, 0.4), 0 0 5px #fff inset;
    -webkit-box-shadow: 0 0 4px rgba(86, 122, 155, 0.4), 0 0 5px #fff inset;
    -moz-box-shadow: 0 0 4px rgba(86, 122, 155, 0.4), 0 0 5px #fff inset;
    -o-box-shadow: 0 0 4px rgba(86, 122, 155, 0.4), 0 0 5px #fff inset;
    -ms-box-shadow: 0 0 4px rgba(86, 122, 155, 0.4), 0 0 5px #fff inset;
}

.tablebutton.tablebuttonclick {
    border: 1px solid #9ba8bc;
    background-color: #dde3e9;
    background-image: linear-gradient(#d2d9e0, #ebeff5);
    background-image: -webkit-linear-gradient(#d2d9e0, #ebeff5);
    background-image: -moz-linear-gradient(#d2d9e0, #ebeff5);
    background-image: -o-linear-gradient(#d2d9e0, #ebeff5);
    background-image: -ms-linear-gradient(#d2d9e0, #ebeff5);
    -pie-background: linear-gradient(#d2d9e0, #ebeff5);
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15) inset, 0 0 4px rgba(255, 255, 255, 0.5) inset;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15) inset, 0 0 4px rgba(255, 255, 255, 0.5) inset;
    -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15) inset, 0 0 4px rgba(255, 255, 255, 0.5) inset;
    -ms-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15) inset, 0 0 4px rgba(255, 255, 255, 0.5) inset;
    -o-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15) inset, 0 0 4px rgba(255, 255, 255, 0.5) inset;
}

#dt_basic {
    border: 1px;
    border-color: black;
    border-style:solid; 

    }
    #dt_basic td{
    border: 1px;
    border-color: black;
    border-style:solid; 

    }
#dt_basic th {
    border: 1px;
    border-color: black;
    border-style:solid; 
    font-weight: bold;
    background-color: hsl(215, 86%, 75%);
    }


    .mypersonnaldata {
    border: 1px;
    border-color: black;
    border-style:solid; 

    }
    .mypersonnaldata td{
    border: 1px;
    border-color: black;
    border-style:solid; 

    }
    .mypersonnaldata th {
    border: 1px;
    border-color: black;
    border-style:solid; 
    font-weight: bold;
    background-color: hsl(215, 86%, 75%);
    }
    #messagedefilant{
        animation: messagedefilant 3s infinite;
    }
    @keyframes messagedefilant{
        0%{opacity: 2;}
        50%{opacity: 0.5;}
        100%{opacity: 2;}
    }
    </style>

    <script src="{{ asset('HTML_version/js/libs/jquery-ui-1.10.3.min.js') }}"></script>