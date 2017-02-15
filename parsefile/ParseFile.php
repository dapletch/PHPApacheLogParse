<?php
/**
 * Created by PhpStorm.
 * User: Seth
 * Date: 2/13/2017
 * Time: 9:14 PM
 */
include('objects/ParsedLogData.php');
include ('utils/LogFileUtils.php');
function parseLogFileAddToArray($file) {
    $line = @fopen($file, 'r');
    $array = null;
    // Add each line to an array
    if ($line) {
        $array = explode("\n", fread($line, filesize($file)));
    }
    return $array;
}

function parseLogLineAddObjectToArray($logLineArray) {

    $regexNoRemoteUser = '((?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))(?![\\d])'
        . '.*?'
        . '((?:(?:[0-2]?\\d{1})|(?:[3][01]{1}))[-:\\/.](?:Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Sept|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)[-:\\/.](?:(?:[1]{1}\\d{1}\\d{1}\\d{1})|(?:[2]{1}\\d{3})))(?![\\d])'
        . '.*?'
        . '((?:(?:[0-2]?\\d{1})|(?:[3][01]{1}))[-:\\/.](?:[0]?[1-9]|[1][012])[-:\\/.](?:(?:\\d{1}\\d{1})))(?![\\d])'
        . '.*?'
        . '(".*?")'
        . '.*?'
        . '(\\d+)'
        . '.*?'
        . '.*?'
        . '(\\d+)';

    $regexRemoteUser = '((?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))(?![\\d])'
        . '.*?'
        . '((?:[a-z][a-z0-9_]*))'
        . '.*?'
        . '((?:(?:[0-2]?\\d{1})|(?:[3][01]{1}))[-:\\/.](?:Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Sept|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)[-:\\/.](?:(?:[1]{1}\\d{1}\\d{1}\\d{1})|(?:[2]{1}\\d{3})))(?![\\d])'
        . '.*?'
        . '((?:(?:[0-2]?\\d{1})|(?:[3][01]{1}))[-:\\/.](?:[0]?[1-9]|[1][012])[-:\\/.](?:(?:\\d{1}\\d{1})))(?![\\d])'
        . '.*?'
        . '(".*?")'
        . '.*?'
        . '(\\d+)'
        . '.*?'
        . '(\\d+)';

    $parsedLogDataArray = array();
    $timeEntered = getCurrentTimestamp();
    for ($i = 0; $i < count($logLineArray); $i++) {

        // Creating new instance of the ParsedLogData class inside the loop
        $parsedLogData = new ParsedLogData();

        // if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7.$re8.$re9.$re10.$re11."/is", $logLineArray[$i], $matches))
        if ($c=preg_match_all("/".$regexNoRemoteUser."/is", $logLineArray[$i], $matches)) {

            $ipAddress=$matches[1][0]; // ipAddress
            $date=$matches[2][0]; // timeAccessed
            $time=$matches[3][0];
            $timeAccessed = formatLogDateToSqlTimeStamp($date, $time);
            $request=$matches[4][0]; // request
            $statCd=$matches[5][0]; // statCd
            $bytesSent=$matches[6][0]; // bytesSent
            // timeEntered - Added as a timestamp cannot be obtained from the file
            //print "($ipAddress) ($timeAccessed) ($request) ($statCd) ($bytesSent) ($timeEntered) \n";

            $parsedLogData->setIpAddress($ipAddress);
            $parsedLogData->setRemoteUser(null);
            $parsedLogData->setTimeAccessed($timeAccessed);
            $parsedLogData->setRequest($request);
            $parsedLogData->setStatCd($statCd);
            $parsedLogData->setBytesSent($bytesSent);
            $parsedLogData->setTimeEntered($timeEntered);
            // Add object to the array
            array_push($parsedLogDataArray, $parsedLogData);
        } else {
            if ($c=preg_match_all("/".$regexRemoteUser."/is", $logLineArray[$i], $matches)) {

                $ipAddress=$matches[1][0];
                $remoteUser=$matches[2][0];
                $date=$matches[3][0];
                $time=$matches[4][0];
                $timeAccessed = formatLogDateToSqlTimeStamp($date, $time);
                $request=$matches[5][0];
                $statCd=$matches[6][0];
                $bytesSent=$matches[7][0];
                //print "($ipAddress) ($remoteUser) ($timeAccessed) ($request) ($statCd) ($bytesSent) ($timeEntered) \n";

                $parsedLogData->setIpAddress($ipAddress);
                $parsedLogData->setRemoteUser($remoteUser);
                $parsedLogData->setTimeAccessed($timeAccessed);
                $parsedLogData->setRequest($request);
                $parsedLogData->setStatCd($statCd);
                $parsedLogData->setBytesSent($bytesSent);
                $parsedLogData->setTimeEntered($timeEntered);
                // Add object to the array
                array_push($parsedLogDataArray, $parsedLogData);
            }
        }
    }
    return $parsedLogDataArray;
}
?>