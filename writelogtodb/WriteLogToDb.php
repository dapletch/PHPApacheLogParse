<?php
/**
 * Created by PhpStorm.
 * User: Seth
 * Date: 2/14/2017
 * Time: 9:33 PM
 */
// Passing the array of ParsedLogDataObjects to a foreach loop to be written to the database
function writeLogToDb($parsedLogDataArray) {

    // needed to change localhost to 127.0.0.1 to get the PDO to work
    $con = new PDO('mysql:host=127.0.0.1;dbname=apache_log_parse', 'root', '');
    // set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $count = 0;
    foreach ($parsedLogDataArray as $parsedLogData) {

        $ipAddress = $parsedLogData->getIpAddress();
        $remoteUser = $parsedLogData->getRemoteUser();
        $timeAccessed = $parsedLogData->getTimeAccessed();
        $request = $parsedLogData->getRequest();
        $statCd = $parsedLogData->getStatCd();
        $bytesSent = $parsedLogData->getBytesSent();
        $timeEntered = $parsedLogData->getTimeEntered();

        try {
            $stmt = $con->prepare('INSERT INTO log_data (ip_address, remote_user, time_accessed, request, stat_cd, bytes_sent, time_entered)'
                . ' VALUES (:ipAddress, :remoteUser, :timeAccessed, :request, :statCd, :bytesSent, :timeEntered);');
            $stmt->bindParam(':ipAddress', $ipAddress);
            $stmt->bindParam(':remoteUser', $remoteUser);
            $stmt->bindParam(':timeAccessed', $timeAccessed);
            $stmt->bindParam(':request', $request);
            $stmt->bindParam(':statCd', $statCd);
            $stmt->bindParam(':bytesSent', $bytesSent);
            $stmt->bindParam(':timeEntered', $timeEntered);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if ($count % 100 === 0) {
            echo "\n$count records submitted";
        }
        $count++;
    }
    echo "\n$count records inputted successfully.\n";
}
?>