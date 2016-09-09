<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function  index($GetYear, $GetMonth, $GetGroup)
    {
        $sqlyear = DB::select("SELECT `Year` FROM energy_sales GROUP BY `Year`;");
        $sqlmonth = DB::select("SELECT `Year`,`Month`,Month_Name FROM energy_sales WHERE `Year` = '$GetYear' GROUP BY `Year`,`Month`,Month_Name;");
        $sqlmain = DB::select("SELECT `Year`,'ALL' AS `Month`,'ALL' AS Month_Name,SUM(Residential) AS Residential,SUM(Small_General_Service) AS Small_General_Service,SUM(Medium_General_Service) AS Medium_General_Service,SUM(Large_General_Service) AS Large_General_Service,SUM(`Specific_Busines_Service`) AS Specific_Busines_Service,SUM(`Government_Institutions_and_Non_Profit_Organizations`) AS Government_Institutions_and_Non_Profit_Organizations,SUM(Water_Pumping_for_Agricultural_Purposes) AS Water_Pumping_for_Agricultural_Purposes,SUM(Temporary_Tariff) AS Temporary_Tariff,SUM(`Public_Lightings`) AS Public_Lightings FROM energy_sales WHERE `Year` = '$GetYear' GROUP BY `Year`;");
        $sqlmain_pergroup  = DB::select("SELECT `Year`,`Month`,Month_Name,Residential,Small_General_Service,Medium_General_Service,Large_General_Service,`Specific_Busines_Service`,`Government_Institutions_and_Non_Profit_Organizations`,Water_Pumping_for_Agricultural_Purposes,Temporary_Tariff,`Public_Lightings` FROM energy_sales WHERE `Year` = '$GetYear';");
//        echo json_encode($sqlmain_pergroup);
        foreach ($sqlyear as $qyear){
            $drop_year[] = $qyear->Year;
        }
        foreach ($sqlmonth as $qmonth){
            $drop_month[] = $qmonth->Month_Name;
        }
        foreach ($sqlmain as $qmain){
//            echo $qmain_pergroup->Residential.'<br>';
            $vyear[] = $qmain->Year;
            $vmonth[] = $qmain->Month;
            $vmonth_name[] = $qmain->Month_Name;
            $vresident[] = $qmain->Residential;
            $vsmall_serv[] = $qmain->Small_General_Service;
            $vmed_serv[] = $qmain->Medium_General_Service;
            $vlarg_serv[] = $qmain->Large_General_Service;
            $vspec_serv[] = $qmain->Specific_Busines_Service;
            $vgov[] = $qmain->Government_Institutions_and_Non_Profit_Organizations;
            $vagic[] = $qmain->Water_Pumping_for_Agricultural_Purposes;
            $vtemp_tariff[] = $qmain->Temporary_Tariff;
            $vpublic[] = $qmain->Public_Lightings;
        }

        foreach ($sqlmain_pergroup as $qmain_pergroup){
//            echo $qmain_pergroup->Residential.'<br>';
            $vyear_pergroup[] = $qmain_pergroup->Year;
            $vmonth_pergroup[] = $qmain_pergroup->Month;
            $vmonth_name_pergroup[] = $qmain_pergroup->Month_Name;
            $vresident_pergroup[] = $qmain_pergroup->Residential;
            $vsmall_serv_pergroup[] = $qmain_pergroup->Small_General_Service;
            $vmed_serv_pergroup[] = $qmain_pergroup->Medium_General_Service;
            $vlarg_serv_pergroup[] = $qmain_pergroup->Large_General_Service;
            $vspec_serv_pergroup[] = $qmain_pergroup->Specific_Busines_Service;
            $vgov_pergroup[] = $qmain_pergroup->Government_Institutions_and_Non_Profit_Organizations;
            $vagic_pergroup[] = $qmain_pergroup->Water_Pumping_for_Agricultural_Purposes;
            $vtemp_tariff_pergroup[] = $qmain_pergroup->Temporary_Tariff;
            $vpublic_pergroup[] = $qmain_pergroup->Public_Lightings;
        }
//        print_r($vsmall_serv[0]);

        $tariffs_group_list = ['บ้านอยู่อาศัย','กิจการขนาดเล็ก','กิจการขนาดกลาง','กิจการขนาดใหญ่','กิจการเฉพาะอย่าง','ส่วนราชการและองค์กรฯ',
            'สูบน้ำเพื่อการ เกษตร','ไฟชั่วคราว','หน่วยขายไม่รวมไฟสาธารณะ','ไฟสาธารณะ','หน่วยขายรวมไฟสาธารณะ'];
        $month_list = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

//print_r($sqlyear);
        if(!isset($GetYear)){
            $GetYear = $drop_year[0];
        }else{
            $GetYear = $GetYear;
        }
        if(!isset($GetMonth)){
            $GetMonth  = 'all';
        }else{
            $GetMonth  = $GetMonth;
        }

        $vdata_pergroup = array();
        for($i=0;$i<count($vmonth_name_pergroup);$i++){
            for($j=0;$j<count($month_list);$j++){
                if($vmonth_name_pergroup[$i] == $month_list[$j]){
                    if(!isset($GetGroup)){
                        $GetGroup = $tariffs_group_list[0];
                    }else{
                        $GetGroup = $GetGroup;
                    }
                    $vmonth_data[$j] = $vmonth_pergroup[$i];
                    if($GetGroup == $tariffs_group_list[0]){
                        $vdata_pergroup[$j] = $vresident_pergroup[$i];
                    }if($GetGroup == $tariffs_group_list[1]){
                        $vdata_pergroup[$j] = $vsmall_serv_pergroup[$i];
                    }if($GetGroup == $tariffs_group_list[2]){
                        $vdata_pergroup[$j] = $vmed_serv_pergroup[$i];
                    }if($GetGroup == $tariffs_group_list[3]){
                        $vdata_pergroup[$j] = $vlarg_serv_pergroup[$i];
                    }if($GetGroup == $tariffs_group_list[4]){
                        $vdata_pergroup[$j] = $vspec_serv_pergroup[$i];
                    }if($GetGroup == $tariffs_group_list[5]){
                        $vdata_pergroup[$j] = $vgov_pergroup[$i];
                    }if($GetGroup == $tariffs_group_list[6]){
                        $vdata_pergroup[$j] = $vagic_pergroup[$i];
                    }if($GetGroup == $tariffs_group_list[7]){
                        $vdata_pergroup[$j] = $vtemp_tariff_pergroup[$i];
                    }if($GetGroup == $tariffs_group_list[8]){
                        $vdata_pergroup[$j] = $vresident_pergroup[$i]+$vsmall_serv_pergroup[$i]+$vmed_serv_pergroup[$i]+$vlarg_serv_pergroup[$i]+$vspec_serv_pergroup[$i]+$vgov_pergroup[$i]+$vagic_pergroup[$i]+$vtemp_tariff_pergroup[$i];
                    }if($GetGroup == $tariffs_group_list[9]){
                        $vdata_pergroup[$j] = $vpublic_pergroup[$i];
                    }if($GetGroup == $tariffs_group_list[10]){
                        $vdata_pergroup[$j] = $vresident_pergroup[$i]+$vsmall_serv_pergroup[$i]+$vmed_serv_pergroup[$i]+$vlarg_serv_pergroup[$i]+$vspec_serv_pergroup[$i]+$vgov_pergroup[$i]+$vagic_pergroup[$i]+$vtemp_tariff_pergroup[$i]+$vpublic_pergroup[$i];
                    }
                }
            }
        }

        return view('index', ['GetYear' => $GetYear, 'GetMonth' => $GetMonth, 'GetGroup' => $GetGroup, 'drop_year' => $drop_year, 'drop_month' => $drop_month, 'drop_month' => $drop_month, 'vyear_pergroup' => $vyear_pergroup, 'vmonth_pergroup' => $vmonth_pergroup, 'vmonth_name_pergroup' => $vmonth_name_pergroup
            , 'vresident_pergroup' => $vresident_pergroup, 'vsmall_serv_pergroup' => $vsmall_serv_pergroup, 'vmed_serv_pergroup' => $vmed_serv_pergroup, 'vlarg_serv_pergroup' => $vlarg_serv_pergroup, 'vspec_serv_pergroup' => $vspec_serv_pergroup, 'vgov_pergroup' => $vgov_pergroup
            , 'vagic_pergroup' => $vagic_pergroup, 'vtemp_tariff_pergroup' => $vtemp_tariff_pergroup, 'vpublic_pergroup' => $vpublic_pergroup
            , 'vyear' => $vyear, 'vmonth' => $vmonth, 'vmonth_name' => $vmonth_name, 'vresident' => $vresident, 'vsmall_serv' => $vsmall_serv, 'vmed_serv' => $vmed_serv, 'vlarg_serv' => $vlarg_serv
            , 'vspec_serv' => $vspec_serv, 'vgov' => $vgov, 'vagic' => $vagic, 'vtemp_tariff' => $vtemp_tariff, 'vpublic' => $vpublic
            , 'vdata_pergroup' => $vdata_pergroup, 'tariffs_group_list' => $tariffs_group_list, 'month_list' => $month_list, 'vmonth_data' => $vmonth_data]);

    }
}
