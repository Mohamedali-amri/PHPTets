<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include "./db_congif.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['json-file'])) {
    $file = $_FILES['json-file'];

    if ($file['type'] !== 'application/json') {
        echo 'Please upload a valid JSON file';
        exit;
    }

    $jsonData = file_get_contents($file['tmp_name']);
    $data = json_decode($jsonData, true);

    if ($data === null) {
        echo 'Error reading the JSON file';
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO reservations (participation_id, employee_name, employee_mail, event_id, event_name, participation_fee, event_date) VALUES (?, ?, ?, ?, ?, ?, ?)");

    foreach ($data as $entry) {
        if (
            isset(
                $entry['participation_id'],
                $entry['employee_name'],
                $entry['employee_mail'],
                $entry['event_id'],
                $entry['event_name'],
                $entry['participation_fee'],
                $entry['event_date']
            ) &&
            is_numeric($entry['participation_id']) &&
            is_numeric($entry['event_id']) &&
            is_numeric($entry['participation_fee'])
        ) {
            // Vérifier si les données existent déjà dans la base avec participation_id
            $checkStmt = $conn->prepare("SELECT COUNT(*) FROM reservations WHERE participation_id = ?");
            $checkStmt->bind_param("i", $entry['participation_id']);
            $checkStmt->execute();
            $checkStmt->bind_result($count);
            $checkStmt->fetch();
            $checkStmt->close();

            if ($count == 0) {
                // Si les données n'existent pas, on les insère
                $stmt->bind_param(
                    "ississs",
                    $entry['participation_id'],
                    $entry['employee_name'],
                    $entry['employee_mail'],
                    $entry['event_id'],
                    $entry['event_name'],
                    $entry['participation_fee'],
                    $entry['event_date']
                );
                $stmt->execute();
            } else {
                // Si les données existent déjà, on les ignore sans erreur
                echo "Data with participation_id {$entry['participation_id']} already exists. Skipping insertion.<br>";
            }
        } else {
            echo "Invalid data in the JSON file. Skipping entry.<br>";
        }
    }

    $stmt->close();
    $conn->close();

    echo 'Data processing completed!';
} else {
    echo 'No JSON file received';
}
