<?php 
    # Login Session check ...

    require_once 'session_page.php';

    # Deleting Booking ...

    if (isset($_POST['delete'])) {
        $book_id = $_POST['id'];

        # Delete the service
        $sql_delete = 'DELETE FROM `book_service` WHERE `id` =:id AND `booking_status`=:book_status';
        $delete_statement = $pdo->prepare($sql_delete);
        $delete_statement -> execute([
            'id' => $book_id,
            'book_status' => 'pending'
        ]);

        if ($sql_delete) {
            header('Location: booking.php');
        }
    }

    # Updating service ...

    if (isset($_POST['update_book'])) {
        $id = $_POST['id']; 
        $book_service_id = $_POST['book_service_id'];
        $service_name = $_POST['service_name'];
        $booking_date = $_POST['booking_date'];

        $sql_update_book = 'UPDATE `book_service` SET 
            `booking_date` =:booking_date
            WHERE `id` =:id AND `book_service_id`=:book_service_id';

        $update_book_prep = $pdo->prepare($sql_update_book);

        // try {
            $update_book_prep->execute([
                "booking_date"    => $booking_date,
                "id"              => $id,
                "book_service_id" => $book_service_id
            ]);

            if ($sql_update_book) {
                header('Location: booking.php');
            }
    }

    # Loading booking html ...
    
    include 'include/booking.html';
?>