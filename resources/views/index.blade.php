@extends('layouts.app')

@section('content')

<div class="container">
    <div name= 'dropdown' style='padding:20px;'>
        ปี :
        <select id= "YEAR" name="YEAR" onchange="calculate()">
            @for($i = 0 ; $i < count($drop_year);$i++)
                <option value="{{ $drop_year[$i] }}" @if($GetYear==$drop_year[$i]) {{ "selected='selected'" }} @endif>  {{ $drop_year[$i] }} </option>
            @endfor
        </select>
        เดือน :
        <select id= "MONTH" name="MONTH" onchange="calculate()">
            <option value="all" @if($GetMonth=='all') {{ "selected='selected'" }} @endif >All</option>
            @for($i = 0 ; $i < count($drop_month);$i++)
                <option value="{{ $drop_month[$i] }}"  @if($GetMonth==$drop_month[$i]) {{ "selected='selected'" }} @endif > {{ $drop_month[$i] }} </option>
            @endfor
        </select>
    </div>
    <script type="text/javascript">
        function calculate(){
            var YEAR = document.getElementById('YEAR').value;
            var MONTH = document.getElementById('MONTH').value;
            var GROUP = document.getElementById('GROUP').value;
            {{--window.location.href = {!! json_encode(URL('/')) !!} +"/test/" + YEAR + "/" + MONTH;--}}
            window.location.href = {!! json_encode(URL('/')) !!} +"/index/" + YEAR + "/" + MONTH + "/" + GROUP;
        }
    </script>

    <div class="wow fadeIn" id="chartdiv"></div>

    <div class="wow bounceInDown" id="chartdiv3"></div>
    <div class="container-fluid">
        <div class="row text-center" style="overflow:hidden;">
            <div class="col-sm-3" style="float: none !important;display: inline-block;">
                <label class="text-left">Angle:</label>
                <input class="chart-input" data-property="angle" type="range" min="0" max="60" value="30" step="1"/>
            </div>

            <div class="col-sm-3" style="float: none !important;display: inline-block;">
                <label class="text-left">Depth:</label>
                <input class="chart-input" data-property="depth3D" type="range" min="1" max="25" value="10" step="1"/>
            </div>
            <div class="col-sm-3" style="float: none !important;display: inline-block;">
                <label class="text-left">Inner-Radius:</label>
                <input class="chart-input" data-property="innerRadius" type="range" min="0" max="80" value="0" step="1"/>
            </div>
        </div>
    </div>

    <div name= 'dropdown' style='padding:20px;'>
        ประเภทผู้ใช้ไฟฟ้า :
        <select id= "GROUP" name="GROUP" onchange="calculate()">
            <?PHP for($i = 0 ; $i < count($tariffs_group_list);$i++){ ?>
            <option value="{{ $tariffs_group_list[$i] }}" @if($GetGroup==$tariffs_group_list[$i]) {{ "selected='selected'" }} @endif > {{ $tariffs_group_list[$i] }}</option>
            <?PHP } ?>
        </select>
    </div>
    <div class="wow zoomIn data-wow-delay='5s'" id="chartdiv2"></div>

    <script type="text/javascript">
        var chart = AmCharts.makeChart("chartdiv", {
            "type": "serial",
            "theme": "light",
            "titles": [{
                "text": "ประเภทผู้ใช้ไฟฟ้าแยกตามเดือน",
                "size": 18
            }],
            "marginRight": 70,
            "dataProvider": [{
                "tariffs_group": "{{ $tariffs_group_list[0] }}",
                "sales": '{{ $vresident[0] }}',
                "color": "#FF0F00"
            }, {
                "tariffs_group": "{{  $tariffs_group_list[1] }}",
                "sales": '{{  $vsmall_serv[0] }}',
                "color": "#FF6600"
            }, {
                "tariffs_group": "{{ $tariffs_group_list[2] }}",
                "sales": '{{  $vmed_serv[0] }}',
                "color": "#FF9E01"
            }, {
                "tariffs_group": "{{  $tariffs_group_list[3] }}",
                "sales": '{{  $vlarg_serv[0] }}',
                "color": "#FCD202"
            }, {
                "tariffs_group": "{{  $tariffs_group_list[4] }}",
                "sales": '{{  $vspec_serv[0] }}',
                "color": "#F8FF01"
            }, {
                "tariffs_group": "{{  $tariffs_group_list[5] }}",
                "sales": '{{  $vgov[0] }}',
                "color": "#B0DE09"
            }, {
                "tariffs_group": "{{  $tariffs_group_list[6] }}",
                "sales": '{{  $vagic[0] }}',
                "color": "#04D215"
            }, {
                "tariffs_group": "{{  $tariffs_group_list[7] }}",
                "sales": '{{  $vtemp_tariff[0] }}',
                "color": "#0D8ECF"
            }, {
                "tariffs_group": "{{  $tariffs_group_list[8] }}",
                "sales": '{{  $vresident[0]+$vsmall_serv[0]+$vmed_serv[0]+$vlarg_serv[0]+$vspec_serv[0]+$vgov[0]+$vagic[0]+$vtemp_tariff[0] }}',
                "color": "#0D52D1"
            }, {
                "tariffs_group": "{{  $tariffs_group_list[9] }}",
                "sales": '{{ $vpublic[0] }}',
                "color": "#2A0CD0"
            }, {
                "tariffs_group": "{{  $tariffs_group_list[10] }}",
                "sales": '{{  $vresident[0]+$vsmall_serv[0]+$vmed_serv[0]+$vlarg_serv[0]+$vspec_serv[0]+$vgov[0]+$vagic[0]+$vtemp_tariff[0]+$vpublic[0] }}',
                "color": "#8A0CCF"
            }],
            "valueAxes": [{
                "axisAlpha": 0,
                "position": "left",
                "title": "สถิติจำนวนหน่วยจำหน่าย (ล้านหน่วย)"
            }],
            "startDuration": 1,
            "graphs": [{
                "balloonText": "<b>[[category]]: [[value]]</b>",
                "labelText":"[[value]]",
                "fillColorsField": "color",
                "fillAlphas": 0.9,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "sales"
            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "tariffs_group",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 45
            },
            "export": {
                "enabled": true
            }
        });
        var graphData1 =  generateGraphData1();
        var chart = AmCharts.makeChart("chartdiv2", {
            "type": "serial",
            "theme": "light",
            "titles": [{
                "text": "แยกตามประเภทผู้ใช้ไฟฟ้า",
                "size": 18
            }],
            "legend": {
                "equalWidths": true,
                "useGraphSettings": true,
                "valueAlign": "left",
                "valueWidth": 80 ,
                //"valueHeight": 10
            },

            "dataProvider": [{
                "tariffs_group": "{{ $GetGroup }}",
                "Jan": "{{ isset($vdata_pergroup[0]) ? $vdata_pergroup[0] : '' }}", "Feb": "{{ isset($vdata_pergroup[1]) ? $vdata_pergroup[1] : '' }}", "Mar": "{{  isset($vdata_pergroup[2]) ? $vdata_pergroup[2] : '' }}", "Apr": "{{ isset($vdata_pergroup[3]) ? $vdata_pergroup[3] : '' }}","May": "{{ isset($vdata_pergroup[4]) ? $vdata_pergroup[4] : '' }}","Jun": "{{ isset($vdata_pergroup[5]) ? $vdata_pergroup[5] : '' }}",
                "Jul": "{{ isset($vdata_pergroup[6]) ? $vdata_pergroup[6] : '' }}",  "Aug": "{{ isset($vdata_pergroup[7]) ? $vdata_pergroup[7] : '' }}", "Sep": "{{ isset($vdata_pergroup[8]) ? $vdata_pergroup[8] : '' }}", "Oct": "{{ isset($vdata_pergroup[9]) ? $vdata_pergroup[9] : '' }}","Nov": "{{ isset($vdata_pergroup[10]) ? $vdata_pergroup[10] : '' }}","Dec": "{{ isset($vdata_pergroup[11]) ? $vdata_pergroup[11] : '' }}"
            }],
            "valueAxes": [{
                "axisAlpha": 0,
                "position": "left",
                "title": "สถิติจำนวนหน่วยจำหน่าย (ล้านหน่วย)"
            }],
            "startDuration": 1,
            "graphs":graphData1,
            "chartCursor": {
                "cursorAlpha": 0.1,
                "cursorColor":"#000000",
                "fullWidth":true,
                "valueBalloonsEnabled": false,
                "zoomable": true
            },
            "categoryField": "tariffs_group",
            "creditsPosition" : "top-right",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation" : 0
            },
            "export": {
                "enabled": true
            }
        });

        function generateGraphData1() {

            var graphData1 = [];
            var Currentmonth = {{ count($vmonth_data) }};
            var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            var colorpick = ['#FF0F00','#FF6600','#FF9E01','#FCD202','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#CD0D74','#FF6699']
            for(i = 0 ; i < Currentmonth ; i++){
                graphData1.push({
                    "balloonText": "<b>[[category]] ([[title]]) : [[value]]</b>",
                    "legendValueText": "[[value]] ",
                    "labelText":"[[value]]",
                    "fillColors": colorpick[i],
                    "fillAlphas": 0.9,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "title": month[i],
                    "valueField": month[i]
                });
            }
            return graphData1 ;
        }
        var chart = AmCharts.makeChart( "chartdiv3", {
            "type": "pie",
            "theme": "light",
            "dataProvider": [ {
                "country": "{{ $tariffs_group_list[0] }}",
                "value": '{{ $vresident[0] }}'
            }, {
                "country": "{{ $tariffs_group_list[1] }}",
                "value": '{{ $vsmall_serv[0] }}'
            }, {
                "country": "{{ $tariffs_group_list[2] }}",
                "value": '{{ $vmed_serv[0] }}'
            }, {
                "country": "{{ $tariffs_group_list[3] }}",
                "value": '{{ $vlarg_serv[0] }}'
            }, {
                "country": "{{ $tariffs_group_list[4] }}",
                "value": '{{ $vspec_serv[0] }}'
            }, {
                "country": "{{ $tariffs_group_list[5] }}",
                "value": '{{ $vgov[0] }}'
            }, {
                "country": "{{ $tariffs_group_list[6] }}",
                "value": '{{ $vagic[0] }}'
            }, {
                "country": "{{ $tariffs_group_list[7] }}",
                "value": '{{ $vtemp_tariff[0] }}'
            }, {
                "country": "{{ $tariffs_group_list[9] }}",
                "value": '{{ $vpublic[0] }}'
            }],
            "valueField": "value",
            "titleField": "country",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 30,
            "creditsPosition" : "bottom-right",
            "export": {
                "enabled": true
            }
        } );
        jQuery( '.chart-input' ).off().on( 'input change', function() {
            var property = jQuery( this ).data( 'property' );
            var target = chart;
            var value = Number( this.value );
            chart.startDuration = 0;
            if ( property == 'innerRadius' ) {
                value += "%";
            }
            target[ property ] = value;
            chart.validateNow();
        } );
    </script>
</div>
@endsection


