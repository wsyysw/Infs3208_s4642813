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
?>

<?php include 'header.php';?>

<?php
    $sql = "SELECT * FROM `tasks` WHERE `project_short_name` = '$shortName' AND `project_task_num` = $taskNum";
     if($result = $connection->query($sql)){
        $rowsCount = $result->num_rows;
        if($rowsCount>0){
            $row = $result->fetch_assoc();
            $result->free_result();
        }
        else{
            echo '<span class="error-msg">sql error</span>';
            exit();
        } 
    }
?>

<div class="container task-view">
    <h1><?php echo $shortName . '-' . $taskNum ?></h1>
    <div class="lg-12">
        <a class="back" href="board.php?sn=<?php echo $shortName ?>">&lt;--- Back to board</a>
    </div>
    <div class="lg-12 single-task">
        <h2><?php echo $row['task_name']; ?></h2>
        <p><?php echo $row['task_desc']; ?></p>
    </div> 

        
</div>

<?php $connection->close(); ?>
<?php include 'footer.php';?>
