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
        return view('index', ['GetYear' => $GetYear, 'GetMonth' => $GetMonth, 'GetGroup' => $GetGroup, 'drop_year' => $drop_year, 'drop_month' => $drop_month, 'drop_month' => $drop_month, 'vyear_pergroup' => $vyear_pergroup, 'vmonth_pergroup' => $vmonth_pergroup, 'vmonth_name_pergroup' => $vmonth_name_pergroup
            , 'vresident_pergroup' => $vresident_pergroup, 'vsmall_serv_pergroup' => $vsmall_serv_pergroup, 'vmed_serv_pergroup' => $vmed_serv_pergroup, 'vlarg_serv_pergroup' => $vlarg_serv_pergroup, 'vspec_serv_pergroup' => $vspec_serv_pergroup, 'vgov_pergroup' => $vgov_pergroup
            , 'vagic_pergroup' => $vagic_pergroup, 'vtemp_tariff_pergroup' => $vtemp_tariff_pergroup, 'vpublic_pergroup' => $vpublic_pergroup
            , 'vyear' => $vyear, 'vmonth' => $vmonth, 'vmonth_name' => $vmonth_name, 'vresident' => $vresident, 'vsmall_serv' => $vsmall_serv, 'vmed_serv' => $vmed_serv, 'vlarg_serv' => $vlarg_serv
            , 'vspec_serv' => $vspec_serv, 'vgov' => $vgov, 'vagic' => $vagic, 'vtemp_tariff' => $vtemp_tariff, 'vpublic' => $vpublic]);

    }
}
