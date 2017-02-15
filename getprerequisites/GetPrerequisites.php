<?php
/**
 * Created by PhpStorm.
 * User: Seth
 * Date: 2/15/2017
 * Time: 1:37 PM
 */
include('objects/TimeAccessedPreReqs.php');
function getTimeAccessedPreRequisites(PDO $pdo) {

    $timeAccessedPreReqs = new TimeAccessedPreReqs();
    $maxTimeEntered = null;
    $minTimeAccessed = null;
    $maxTimeAccessed= null;
    // sql statements
    $maxTimeEnteredSql = 'SELECT date(max(time_entered)) AS max_time_entered FROM log_data;';
    $maxMinTimeAccessedSql = 'SELECT date(min(time_accessed)) AS min_time_accessed, date(max(time_accessed)) as max_time_accessed FROM log_data WHERE date(time_entered) = :maxTimeEntered;';

    try {
        $con = $pdo;
        // set the PDO error mode to exception
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $con->query($maxTimeEnteredSql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxTimeEntered = $row['max_time_entered'];

        $stmt = $con->prepare($maxMinTimeAccessedSql);
        $stmt->bindParam(':maxTimeEntered', $maxTimeEntered);
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach($result as $row) {
            $minTimeAccessed = $row['min_time_accessed'];
            $maxTimeAccessed = $row ['max_time_accessed'];
        }

        $timeAccessedPreReqs->setMaxTimeEntered($maxTimeEntered);
        $timeAccessedPreReqs->setMinTimeAccessed($minTimeAccessed);
        $timeAccessedPreReqs->setMaxTimeAccessed($maxTimeAccessed);

        echo "\nMax Time Entered: " . $timeAccessedPreReqs->getMaxTimeEntered() . "\n";
        echo "Min Time Accessed: " . $timeAccessedPreReqs->getMinTimeAccessed() . "\n";
        echo "Max Time Accessed: " . $timeAccessedPreReqs->getMaxTimeAccessed() . "\n";

        } catch (PDOException $e) {
            $e->getMessage();
        }
        return $timeAccessedPreReqs;
}
?>