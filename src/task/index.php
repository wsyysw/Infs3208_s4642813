<?php
    session_start();
    if(!(isset($_SESSION['logged-in']))){
        header('Location: login.php');
        exit();
    }
    
    require_once "connect.php";

    $connection = new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0){
        echo "Error: ".$connection->connect_errno . "<br>";
        echo "Description: " . $connection->connect_error;
        exit();
    }
?>

<?php include 'header.php';?>

<div class="container projectListContainer">
    <h1>Projects list</h1>
    <div class="lg-6 whoami">
        <?php echo 'Logged in as <strong>' . $_SESSION['user'] . '</strong> <a href="logout.php">[logout]</a>'; ?>
    </div>
    <div class="lg-6 createBoard">
        <a href="newProject.php" class="btn">Create board</a>
    </div>
    <div class="lg-12">
        <table class="project-list">
            <thead>
                <tr>
                    <th>Full name</th>
                    <th>Short name</th>
                    <th>Tasks left</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $sql = "SELECT * FROM projects";

                if($result = $connection->query($sql)){
                    $projectsCount = $result->num_rows;
                    if($projectsCount>0){
                            
                        while ($row = mysqli_fetch_array($result)) {
                            $sn = $row['Short name'];
                            $sumSQL = "SELECT count(*) as tasksLeft FROM `tasks` WHERE project_short_name = '$sn' AND state != 4";
                            $sumResult = $connection->query($sumSQL);
                            $row2 = $sumResult->fetch_assoc();
                            echo "
                            <tr>
                                <td>".($row['Full name'])."</td>
                                <td>".($row['Short name'])."</td>
                                <td>".$row2['tasksLeft']."</td>
                                <td><a href='board.php?sn=".$row['Short name']."' class='btn'>Board</a></td>
                            </tr>";
                        }
                        $result->free_result();
                    }
                    else{
                        echo "No projects?";
                    }
                }
                
                ?>
            </tbody>
        </table>
        <?php
            if(isset($_SESSION['newProjectSuccess'])){
                echo $_SESSION['newProjectSuccess'];
                unset($_SESSION['newProjectSuccess']);
            }
        ?>
    </div>
</div>

<?php $connection->close(); ?>
<?php include 'footer.php';?>
