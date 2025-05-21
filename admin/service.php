<?php 
    # Login Session check ...

    require_once 'session_page.php';

    # Deleting service

    if (isset($_POST['delete'])) {
        $service_id = $_POST['id'];

        # Delete the service
        $sql_delete = 'DELETE FROM `service` WHERE `id` =:id';
        $delete_statement = $pdo->prepare($sql_delete);
        $delete_statement -> execute([
            'id' => $service_id
        ]);

        if ($sql_delete) {
            header('Location: service.php?s');
        }
    }

    # Updating service ...

    if (isset($_POST['update_service'])) {
        $service_id = $_POST['service_id']; 
        $service_code = $_POST['service_code'];
        $service_name = $_POST['service_name'];
        $service_description = $_POST['service_description'];
        $service_type = $_POST['service_type'];
        $service_amount = $_POST['service_amount'];
        $service_currency = $_POST['service_currency'];
        $service_duration = $_POST['service_duration'];

        $sql_update_service = 'UPDATE `service` SET 
            `service_code` =:service_code, 
            `service_name` =:servic_name, 
            `description` =:descriptio, 
            `service_type` =:service_type, 
            `price` =:price, 
            `currency` =:currency, 
            `duration` =:duration 
            WHERE `id` =:service_id';

        $update_service_prep = $pdo->prepare($sql_update_service);

        // try {
            $update_service_prep->execute([
                "service_code" => $service_code,
                "servic_name" => $service_name,
                "descriptio"  => $service_description,
                "service_type" => $service_type,
                "price"        => $service_amount,
                "currency"     => $service_currency,
                "duration"     => $service_duration,
                "service_id"     => $service_id
            ]);

            if ($sql_update_service) {
                header('Location: service.php');
            }
        // } catch (PDOException $e) {
        //     echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        // }
    }

    # Inserting Service

    if (isset($_POST['add_service'])) {
        $service_name = $_POST['service_name'];
        $service_type = $_POST['service_type'];
        $service_duration = $_POST['service_duration'];
        $service_amount = $_POST['service_amount'];
        $service_currency = $_POST['service_currency'];
        $service_description = $_POST['service_description'];
        $service_code = substr($service_name, 0, 3).rand(0001 , 9999);

        $sql_insert_service = "INSERT INTO `service` (`service_code`, `service_name`, `description`, `service_type`, `price`, `currency`, `duration`)
                VALUES (:service_code, :service_name, :service_description, :service_type, :service_amount, :service_currency, :duration)";

        $insert_service_prep = $pdo->prepare($sql_insert_service);

        try {
            $insert_service_prep->execute([
                ":service_code" => $service_code,
                ":service_name" => $service_name,
                ":service_description" => $service_description,
                ":service_type" => $service_type,
                ":service_amount" => $service_amount,
                ":service_currency" => $service_currency,
                ":duration" => $service_duration
            ]);

            if ($sql_insert_service) {
                header('Location: service.php');
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    # Loading service html ...
    
    include 'include/service.html';
?>