<?php
include "./db_congif.php";


$employeeName = $_GET['employee_name'] ?? '';
$eventName = $_GET['event_name'] ?? '';
$eventDate = $_GET['event_date'] ?? '';

$query = "SELECT * FROM reservations WHERE 1=1";
if (!empty($employeeName)) {
    $query .= " AND employee_name LIKE '%" . $conn->real_escape_string($employeeName) . "%'";
}
if (!empty($eventName)) {
    $query .= " AND event_name LIKE '%" . $conn->real_escape_string($eventName) . "%'";
}
if (!empty($eventDate)) {
    $query .= " AND DATE(event_date) = '" . $conn->real_escape_string($eventDate) . "'";
}

$result = $conn->query($query);

$response = [];
$totalFee = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response['data'][] = $row;
        $totalFee += (float)$row['participation_fee'];
    }
}

$response['total_fee'] = $totalFee;

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
