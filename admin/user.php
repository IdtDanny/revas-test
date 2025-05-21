<?php 
    # Login Session check ...

    require_once 'session_page.php';

    # Adding user ...

    if(isset($_POST['add-user'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $username = $fname.rand(001 , 999);
        $userid = substr($fname, 0, 3).rand(0001 , 9999);
        $password = $fname.'123';
        $hashed_password = md5($password);
        $role = $_POST['role'];
        $phone = $_POST['phone'];

        $sql_insert_user = "INSERT INTO `user` (`userid`, `fname`, `lname`, `username`, `email`, `phone`, `password`, `role`)
                VALUES (:userid, :fname, :lname, :username, :email, :phone, :password, :role)";

        $insert_user_prep = $pdo->prepare($sql_insert_user);
        $insert_user_prep->execute([
                ":userid" => $userid,
                ":fname" => $fname,
                ":lname" => $lname,
                ":username" => $username,
                ":email" => $email,
                ":phone" => $phone,
                ":password" => $password,
                ":role" => $role
        ]);

        if ($sql_insert_user) {
                header('Location: user.php');
        }
    }

    # Loading user html ...
    
    include 'include/user.html';
?>
