<?php
include "./db_congif.php";

$jsonFile = 'data.json';
$jsonData = file_get_contents($jsonFile);
$dataArray = json_decode($jsonData, true);

foreach ($dataArray as $data) {
    $participation_id = $data['participation_id'];
    $employee_name = $data['employee_name'];
    $employee_mail = $data['employee_mail'];
    $event_id = $data['event_id'];
    $event_name = $data['event_name'];
    $participation_fee = $data['participation_fee'];
    $event_date = $data['event_date'];

    $sql = "INSERT INTO reservations (participation_id, employee_name, employee_mail, event_id, event_name, participation_fee, event_date)
            VALUES ('$participation_id', '$employee_name', '$employee_mail', '$event_id', '$event_name', '$participation_fee', '$event_date')";

    if (!$conn->query($sql)) {
        echo "Error during insertion : " . $conn->error . "<br>";
    }
}

echo "Data inserted successfully";

$conn->close();
