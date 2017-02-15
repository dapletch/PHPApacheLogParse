<?php
/**
 * Created by PhpStorm.
 * User: Seth
 * Date: 2/14/2017
 * Time: 12:08 PM
 */

function getCurrentTimestamp() {
    return date('Y-m-d H:i:s');
}

function formatLogDateToSqlTimeStamp($date, $time) {
    $day = substr($date, 0, 2);
    $month = convertMonthToNumberValue(substr($date, 3, 3));
    $year = substr($date, 7, 4);
    return $year."-".$month."-".$day." ".$time;
}

function convertMonthToNumberValue($month) {
    $monthNum = null;
    switch ($month) {
        case "Jan":
            $monthNum = "01";
            break;
        case "Feb":
            $monthNum = "02";
            break;
        case "Mar":
            $monthNum = "03";
            break;
        case "Apr":
            $monthNum = "04";
            break;
        case "May":
            $monthNum = "05";
            break;
        case "Jun":
            $monthNum = "06";
            break;
        case "Jul":
            $monthNum = "07";
            break;
        case "Aug":
            $monthNum = "08";
            break;
        case "Sep":
            $monthNum = "09";
            break;
        case "Oct":
            $monthNum = "10";
            break;
        case "Nov":
            $monthNum = "11";
            break;
        case "Dec":
            $monthNum = "12";
            break;
        default:
            echo "Month cannot be converted";
    }
    return $monthNum;
}
?>