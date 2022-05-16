<?php
    include 'config.php';
    include 'mainLayout.php';
    
    if($_GET){
        $name = htmlspecialchars($_GET['name']);
        
        echo "<h1 class='mt-4'>" . $name ."</h1>";
    }
?>
            
<div class="card mb-4">
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Course name</th>
                    <th>College name</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    if($_GET){
                        $id = htmlspecialchars($_GET['id']);
                    
                        $query = "select * from courses where college_id = $id";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){

                                echo "<tr> <td>". $row['course_id']."</td> 
                                <td>" . $row['name'] . "</td> 
                                <td>" . $row['college_id'] . "</td> </tr>";
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