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
?>

<?php include 'header.php';?>

<?php
    $sql = "SELECT * FROM `projects` WHERE `Short name` = '$shortName'";
     if($result = $connection->query($sql)){
        $rowsCount = $result->num_rows;
        if($rowsCount>0){
            $row = $result->fetch_assoc();
            $result->free_result();
        }
        else{
            echo '<span class="error-msg">sql error</span>';
        } 
    }
?>

<div class="container task-list-container">
    <h1>Task list</h1>
    <h2>Current project: <strong><?php echo $row['Full name']; ?></strong></h2>
    <div class="lg-6 whoami">
        <?php echo 'Logged in as <strong>' . $_SESSION['user'] . '</strong> <a href="logout.php">[logout]</a>'; ?>
    </div>
    <div class="lg-6 createBoard">
        <a href="newTask.php?sn=<?php echo $shortName ?>" class="btn">Create task</a>
    </div>
    <div class="lg-12">
        <a class="back" href="index.php">&lt;--- Back to projects</a>
    </div>
    <div class="task-list">
        <div class="lg-3 backlog">
            <h3>Backlog</h3>
            <div>
                
                <?php
    
                    $sql1 = "SELECT * FROM tasks WHERE project_short_name = '$shortName' AND state = '1'";
                    $sql2 = "SELECT * FROM tasks WHERE project_short_name = '$shortName' AND state = '2'";
                    $sql3 = "SELECT * FROM tasks WHERE project_short_name = '$shortName' AND state = '3'";
                    $sql4 = "SELECT * FROM tasks WHERE project_short_name = '$shortName' AND state = '4'";
           
                    if($result = $connection->query($sql1)){
                        $projectsCount = $result->num_rows;
                        if($projectsCount>0){

                            while ($row = mysqli_fetch_array($result)) {
                                $tn = $row['project_task_num'];
                                echo "
                                <div class='task-box'>
                                    <a href='task.php?sn=$shortName&tn=$tn' class='task'
                                        <h4>" . ($row['task_name']) . "</h4>
                                        <div>
                                            <span class='task-id'>" . $row['project_short_name'] . "-". $row['project_task_num'] ."</span>
                                        </div>
                                    </a>
                                    <select class='changeStatus' onchange='location = this.value'>
                                        <option class='no-display' selected='selected'>Status</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=1'>Backlog</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=2'>In progress</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=3'>Test</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=4'>Done</option>
                                    </select>
                                </div>
                                ";
                            }
                            $result->free_result();
                        }
                    }
                
                ?>
            </div>
        </div>
        <div class="lg-3 inprogress">
            <h3>In progress</h3>
            <div>
                <?php
                    if($result = $connection->query($sql2)){
                        $projectsCount = $result->num_rows;
                        if($projectsCount>0){

                            while ($row = mysqli_fetch_array($result)) {
                                $tn = $row['project_task_num'];
                                echo "
                                <div class='task-box'>
                                    <a href='task.php?sn=$shortName&tn=$tn' class='task'
                                        <h4>" . ($row['task_name']) . "</h4>
                                        <div>
                                            <span class='task-id'>" . $row['project_short_name'] . "-". $row['project_task_num'] ."</span>
                                        </div>
                                    </a>
                                    <select class='changeStatus' onchange='location = this.value'>
                                        <option class='no-display' selected='selected'>Status</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=1'>Backlog</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=2'>In progress</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=3'>Test</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=4'>Done</option>
                                    </select>
                                </div>
                                ";
                            }
                            $result->free_result();
                        }
                    }
                ?>
            </div>
        </div>
        <div class="lg-3 test">
            <h3>Test</h3>
            <div>
                <?php
                    if($result = $connection->query($sql3)){
                        $projectsCount = $result->num_rows;
                        if($projectsCount>0){

                            while ($row = mysqli_fetch_array($result)) {
                                $tn = $row['project_task_num'];
                                echo "
                                <div class='task-box'>
                                    <a href='task.php?sn=$shortName&tn=$tn' class='task'
                                        <h4>" . ($row['task_name']) . "</h4>
                                        <div>
                                            <span class='task-id'>" . $row['project_short_name'] . "-". $row['project_task_num'] ."</span>
                                        </div>
                                    </a>
                                    <select class='changeStatus' onchange='location = this.value'>
                                        <option class='no-display' selected='selected'>Status</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=1'>Backlog</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=2'>In progress</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=3'>Test</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=4'>Done</option>
                                    </select>
                                </div>
                                ";
                            }
                            $result->free_result();
                        }
                    }
                ?>
            </div>
        </div>
        <div class="lg-3 done">
            <h3>Done</h3>
            <div>
                <?php
                    if($result = $connection->query($sql4)){
                        $projectsCount = $result->num_rows;
                        if($projectsCount>0){

                            while ($row = mysqli_fetch_array($result)) {
                                $tn = $row['project_task_num'];
                                echo "
                                <div class='task-box'>
                                    <a href='task.php?sn=$shortName&tn=$tn' class='task'
                                        <h4>" . ($row['task_name']) . "</h4>
                                        <div>
                                            <span class='task-id'>" . $row['project_short_name'] . "-". $row['project_task_num'] ."</span>
                                        </div>
                                    </a>
                                    <select class='changeStatus' onchange='location = this.value'>
                                        <option class='no-display' selected='selected'>Status</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=1'>Backlog</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=2'>In progress</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=3'>Test</option>
                                        <option value='changeStatus.php?sn=$shortName&tn=$tn&status=4'>Done</option>
                                    </select>
                                </div>
                                ";
                            }
                            $result->free_result();
                        }
                    }
                ?>
            </div>
        </div>
    </div>
        
</div>

<?php $connection->close(); ?>
<?php include 'footer.php';?>
