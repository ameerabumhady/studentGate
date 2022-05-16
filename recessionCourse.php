<?php
    include 'config.php';
    include 'mainLayout.php';
  
    $message ="";
    $error = "";

    if($_GET){
        $message = htmlspecialchars($_GET['message']);
        // $error = htmlspecialchars($_GET['error']);
    }else{
        $message ="";
    }
?>
            
<div class="card mb-4">
    <div class="card-body">
    <?php
        if(!empty($message)){
            echo "<h3 style='background-color: green;'> $message </h3>";
        }
        if(!empty($error)){
            echo "<h3 style='background-color: red;'> $error </h3>";
        }
    ?>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Course name</th>
                    <th>grade</th>
                    <th>Recession</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    if($_GET){
                        $id = htmlspecialchars($_GET['id']);
                        
                        $query = "select * from studentscourse where std_id = $id";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $cQuery = "select * from courses where course_id = ".$row['course_id'];
                                $cResult = mysqli_query($conn, $cQuery);
                                if(mysqli_num_rows($cResult) > 0){
                                    while($cRow = mysqli_fetch_assoc($cResult)){
                                        echo "<tr> <td>". $row['course_id']."</td> 
                                    <td>" . $cRow['name'] . "</td> 
                                    <td>" . $row['grade'] . "</td> 
                                    <td> <a href='deleteCourse.php?sid=".$row['std_id']."&cid=".$row['course_id']."'> Recession </a> </td></tr>";
                                    }   
                                }
                            }
                        }else{
                            header("Location: error404.php");
                        }
                    }
 
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include 'footer.php';
?>