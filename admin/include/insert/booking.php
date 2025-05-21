<?php
// Load PDO connection from external file
    require_once '../../../config/core/connection.php';

// Get JSON POST body and decode it
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data)) {
    $service_name = $data['service_name'];
    $service_type = $data['service_type'];
    $service_amount = $data['service_amount'];
    $service_currency = $data['service_currency'];
    $service_description = $data['service_description'];
    $service_code = substr($service_name, 0, 3).rand(0001 , 9999);

    $sql_insert_service = "INSERT INTO `service` (`service_code`, `service_name`, `description`, `service_type`, `price`, `currency`, `duration`)
            VALUES (:service_code, :service_name, :service_description, :service_typle, :service_amount, :service_currency, :duration)";

    $insert_service_prep = $pdo->prepare($sql_insert_service);

    try {
        $insert_service_prep->execute([
            ':service_code' => $service_code,
            ':service_name' => $data['service_name'],
            ':service_description' => $data['service_description'],
            ':service_typle' => $data['service_typle'],
            ':service_amount' => $data['service_amount'],
            ':service_currency' => $data['service_currency'],
            ':duration' => $data['duration']
        ]);

        echo json_encode(['success' => true, 'message' => 'Data inserted successfully']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
}
?>
