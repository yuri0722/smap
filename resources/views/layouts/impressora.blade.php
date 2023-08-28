<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/img/system/favicon.ico" type="image/x-icon" rel="icon" />
    <title>@yield('pageTitle',' -')</title>
    <link href="{{ asset('css/main-print.css') }}" rel="stylesheet">
    <link href="{{ asset('css/impressao.css') }}" rel="stylesheet">
    <style type="text/css" media="print">
        .botao_impressao {display: none;}
    </style>
    <style type="text/css">
        .navbar {display: none;}
        .panel-heading {display: none;}
        #footer {display: none;}
        #modal  {display: none;}

        #wrapper  {width: 718px; margin: 0 auto; font-family: monospace; font-size: 1em;}

        #header   {border-bottom: 1px solid #000000; border-top: 1px solid #000000; float: left; width: 100%;}
        #header img {float: left;}
        #header p {font-size: 1em; margin: 0px 0px 0 30px; text-align: center;}

        .box    {border-bottom: 1px solid #000; width: 100%;  orphans: 4;}
        .box h1   {font-size: 1em; text-align: center;}
        .box h2   {font-size: 0.9em; text-align: left; font-weight: bold;}
        .box p    {margin: 1px 0 0 0; font-size: 1.2em;}
        .botao_impressao  {float: right;width:32px; cursor: pointer;}

        .imagemMapa {float: right; border: 1px solid #000;}
        #MapaLonge {display: none;}

        .page-break {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
<div class="container-fluid">

    <div id='wrapper'>
        <div id='header'>
            <div style="float: left;width:42px; height:45px;">
                <img alt="" src="/img/logo_pequena.png" style="width:42px; height:45px;" />
            </div>
            <div class="botao_impressao" style="" onClick="window.print()">
                <img alt="" src="/img/imprimir.png" />
            </div>
            <div>
                @yield('cabecalho')

            </div>
        </div>

        @yield('content')
    </div>

</div>
<script src="{{ asset('js/main-print.js') }}" defer></script>
</body>
</html>

