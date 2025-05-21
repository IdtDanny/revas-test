<?php 
    # Login Session check ...

    require_once 'session_page.php';

    # Adding user ...

    if(isset($_POST['add-user'])) {
        $username = $_POST['username'];
        $password = substr($username, 0, 3).rand(0001 , 9999);


        $sql_insert_user = "INSERT INTO `users` (`username`, `password`)
                VALUES (:username, :password)";

        $insert_service_prep = $pdo->prepare($sql_insert_service);
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
    }

    # Loading user html ...
    
    include 'include/user.html';
?>