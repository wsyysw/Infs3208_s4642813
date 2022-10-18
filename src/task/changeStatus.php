<?php

    session_start();
    if(!(isset($_SESSION['logged-in']))){
        header('Location: login.php');
        exit();
    }
    if(!(isset($_GET['sn']))){
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";

    $connection = new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0){
        echo "Error: ".$connection->connect_errno . "<br>";
        echo "Description: " . $connection->connect_error;
        exit();
    }
    $shortName = $_GET['sn'];
    $taskNum = $_GET['tn'];
    $newStatus = $_GET['status'];

    $sql = "UPDATE tasks SET state = '$newStatus' WHERE project_short_name = '$shortName' AND project_task_num = '$taskNum'";

     if($result = $connection->query($sql)){
        header("Location: board.php?sn=$shortName");
    }
    else{
        echo '<span class="error-msg">sql error</span>';
    } 
?>

