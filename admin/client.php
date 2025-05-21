<?php 
    # Login Session check ...

    require_once 'session_page.php';

    # Deleting Client

    if (isset($_POST['delete'])) {
        $client_id = $_POST['id'];

        # Delete the service
        $sql_delete = 'DELETE FROM `client` WHERE `no` =:id';
        $delete_statement = $pdo->prepare($sql_delete);
        $delete_statement -> execute([
            'id' => $client_id
        ]);

        if ($sql_delete) {
            header('Location: client.php');
        }
    }

    # Updating client ...

    if (isset($_POST["update_client"])) {
        $no = $_POST['no'];
        $client_id = $_POST['client_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $country = $_POST['country'];

        $sql_update = "UPDATE `client` SET 
            `client_id`=:client_id,
            `fname`=:fname,
            `lname`=:lname,
            `email`=:email,
            `phonenumber`=:phonenumber,
            `country`=:country
            WHERE `no`=:no";
            
        $update_statement = $pdo->prepare($sql_update);
        $update_statement->execute([
            "client_id"     => $client_id,
            "fname"         => $fname,
            "lname"         => $lname,
            "email"         => $email,
            "phonenumber"   => $phonenumber,
            "country"       => $country,
            "no"            => $no
        ]);

        if ($sql_update) {
            header('Location: client.php');
        }
    }

    # Approve client booking ..
    if (isset($_POST['approved'])) {
        $no  = $_POST['id'];
        echo "fsdshfjskadhfjksdhkfhas";

        $sql_update_book = "UPDATE `client` SET `address`=:addr WHERE `no`=:nid";
        $update_statement = $pdo->prepare($sql_update_book);
        $update_statement->execute([
            "addr" => 'Approved',
            "nid"  => $no
        ]);

        if ($sql_update_book) {
            header('Location: client.php');
        }
    }

    # Loading client html ...
    
    include 'include/client.html';
?>