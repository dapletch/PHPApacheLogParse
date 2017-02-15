<?php
/**
 * Created by PhpStorm.
 * User: Seth
 * Date: 2/13/2017
 * Time: 8:17 PM
 */
include "parsefile/ParseFile.php";
include "writelogtodb/WriteLogToDb.php";
$numOfArgs = sizeof($argv);
print_r(array_values($argv));
if (($numOfArgs - 1) === 1) {
    if (file_exists($argv[1])) {
        echo "File is valid: " . $argv[1];
        $lineArray = array();
        $lineArray = parseLogFileAddToArray($argv[1]);
        $parsedLogDatArray = array();
        $parsedLogDataArray = parseLogLineAddObjectToArray($lineArray);
        writeLogToDb($parsedLogDataArray);
    }
} else {
    echo "Incorrect number of arguments. Please check your arguments and try again.";
}
?>