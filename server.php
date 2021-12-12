<?php
    session_start();

    //Initialize variables
    $name ="";
    $address = "";
    $id = 0;
    $edit_state = false;

    //Connection to database
    $db = mysqli_connect('localhost', 'root', '', 'crud');

    if(isset($_POST['save'])){
        $name = $_POST['name'];
        $address = $_POST['address'];

        $query = "INSERT INTO info (name, address) VALUES  ('$name', '$address')";
        mysqli_query($db, $query);
        $_SESSION['msg'] = "User added";
        header('location:index.php');
    }

    //update records
    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $address = $_POST['address'];
        $id = $_POST['id'];

        mysqli_query($db, "UPDATE info 
                           SET name='$name', address='$address' WHERE id = $id");
        $_SESSION['msg'] = "User updated";
        header('location:index.php');
    }

    //delete records
    if (isset($_GET['del'])) {
            $id = $_GET['del'];
            mysqli_query($db, "DELETE 
                              FROM info 
                             WHERE id=$id");
            $_SESSION['message'] = "User deleted!"; 
            header('location: index.php');
    }

    //retrieve records
    $results = mysqli_query($db, "SELECT * FROM info");
?>