<?php
use Illuminate\Html\HtmlFacade;
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
    <meta http-equiv="Content-Type" content="text/html; charset=tis-620">
    <title>Index</title>

    {!!Html::script('amcharts/amcharts.js')!!}
    {!!Html::script('amcharts/serial.js')!!}
    {!!Html::script('amcharts/pie.js')!!}
    {!!Html::script('amcharts/themes/light.js')!!}
    {!!Html::script('amcharts/plugins/export/export.js')!!}
    {!!Html::style('amcharts/plugins/export/export.css')!!}
    {!!Html::script('js/jquery.min.js')!!}
    {!!Html::style('css/animate.css')!!}



    <style type="text/css">
        body {
            background-image: url({{ URL::asset('amcharts/patterns/yellow_pastel_pattern.jpg')}});
        }
        #chartdiv,#chartdiv2 {
            width       : 100%;
            height            : 500px;
            font-size   : 11px;
        }
        #chartdiv3 {
            width       : 100%;
            height            : 435px;
            font-size   : 11px;
        }
        .amcharts-export-menu-top-right {
            top: 10px;
            right: 0;
        }

    </style>

</head>

<body id="app-layout">
    @yield('content')
</body>
{!!Html::script('js/wow.min.js')!!}
<script> new WOW().init(); </script>
</html>


