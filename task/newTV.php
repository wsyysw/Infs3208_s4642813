<?php
session_start();
require_once "connect.php";

$connection = new mysqli($host, $db_user, $db_password, $db_name);
$shortName = $_GET['sn'];
if($connection->connect_errno!=0){
    echo "Error: ".$connection->connect_errno . "<br>";
    echo "Description: " . $connection->connect_error;
    exit();
}

else{
    $taskTitle = $_POST['taskTitle'];
    $taskDescription = $_POST['taskDescription'];
    $sqlCount = "SELECT * FROM `tasks` WHERE `project_short_name` = '$shortName'";
    if($result = $connection->query($sqlCount)){
        $taskCount = $result->num_rows+1;
        $sql = "INSERT INTO `tasks`(`id`, `project_short_name`, `project_task_num`, `task_name`, `task_desc`, `state`) VALUES (NULL,'$shortName','$taskCount','$taskTitle','$taskDescription',1)";
    
        if($connection->query($sql)){
            header('Location: board.php?sn='.$shortName);
        }
        else echo '2nd sql error';
    }
    
    else echo '1st sql error' . $taskCount;
    $connection->close();
}



?>