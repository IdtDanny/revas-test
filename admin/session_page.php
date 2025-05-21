<?php
    session_start();

    # Checking if The client logged in...

    if (!isset($_SESSION['sessionToken'])) {
        header("location:../index.php");
    }

    # Includes...
    require_once '../config/core/connection.php';

    # Getting Information of Signed in User
    $username = $_SESSION['sessionToken']->username;
    $user_id = $_SESSION['sessionToken']->userid;
    // $client_name = $_SESSION['sessionToken']->lname;
    $photo_errorMessage = '';
    $photo_successMessage = '';
    $successMessage  = '';
    $errorMessage = '';

    # Calculating Each Number of Users, Cards, business, agents and so on...
    $sql_book_service = 'SELECT * FROM `book_service`';
    $sql_client = 'SELECT * FROM `client`';
    $sql_payment = 'SELECT * FROM `payment`';
    $sql_service = 'SELECT * FROM `service`';
    $sql_user = 'SELECT * FROM `user`';

    $statement = $pdo->prepare($sql_book_service);
    $statement->execute();

    $statement_client = $pdo->prepare($sql_client);
    $statement_client -> execute();

    $statement_payment = $pdo->prepare($sql_payment);
    $statement_payment -> execute();

    $statement_service = $pdo->prepare($sql_service);
    $statement_service -> execute();

    $statement_user = $pdo->prepare($sql_user);
    $statement_user -> execute();

    # Getting The number of Clients, Book_Service, Services...
    $book_serviceCount = $statement->rowCount();
    $registered_client = $statement_client->rowCount();
    $registered_payment = $statement_payment -> rowCount();
    $offered_service = $statement_service -> rowCount();

    # Fetching book_service info ...

    $book_service_FetchQuery = 'SELECT * FROM `book_service` ORDER BY `booking_date` DESC';
    $book_service_FetchStatement = $pdo->prepare($book_service_FetchQuery);
    $book_service_FetchStatement->execute();
    // $book_service_Result = $book_service_FetchStatement->fetch();

    # Limit first 5 recent booking for dashboard ...
    $book_servLim_FetchQuery = 'SELECT * FROM `book_service` ORDER BY `booking_date` DESC LIMIT 5';
    $book_servLim_FetchStatement = $pdo->prepare($book_servLim_FetchQuery);
    $book_servLim_FetchStatement->execute();
    // $book_servLim_Result = $book_servLim_FetchStatement->fetch();

    # Fetching book_service info ...

    $client_FetchQuery = 'SELECT * FROM `client` ORDER BY `registered_date` DESC';
    $client_FetchStatement = $pdo->prepare($client_FetchQuery);
    $client_FetchStatement->execute();
    $client_Result = $client_FetchStatement->fetch();

    # Getting client Info. for update form...

    $clientFetchQuery = 'SELECT * FROM `user` WHERE `userid` = :userid';
    $clientFetchStatement = $pdo->prepare($clientFetchQuery);
    $clientFetchStatement->execute([
        'userid' => $user_id
    ]);
    $clientResults = $clientFetchStatement->fetch();

    # Adding Service ...

    // if (isset($_POST['add_service'])) {
    //     echo "submit";
    // }
?>