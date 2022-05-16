<?php
    include 'config.php';
    include 'mainLayout.php';
?>

<h1 class="mt-4">Grades</h1>
<div class="card mb-4">
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>student id</th>
                    <th>course id</th>
                    <th>Grade</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $query = "select * from studentscourse";

                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){

                            // select full name from Students table by student ID
                            $Studentquery = "select first_name, last_name from students where std_id = ". $row['std_id'] ;
                            $Studentresult = mysqli_query($conn, $Studentquery);
                            if(mysqli_num_rows($Studentresult) > 0){
                                $Studentrow = mysqli_fetch_assoc($Studentresult);
                                $f_name = $Studentrow['first_name'];
                                $l_name = $Studentrow['last_name'];
                                
                            }

                            // select course name from courses table by course ID 
                            $Coursequery = "select name from courses where course_id = ". $row['course_id'] ;
                            $Courseresult = mysqli_query($conn, $Coursequery);
                            if(mysqli_num_rows($Courseresult) > 0){
                                $Courserow = mysqli_fetch_assoc($Courseresult);
                                
                                
                            }
                            
                            echo "<tr> <td>". $f_name ." ". $l_name ."</td>  <td>" . $Courserow['name'] . "</td> <td>" . $row['grade'] . "</td> </tr>";
                        }

                    }else{
                        $error = 'there exist error';
                    }
                

                // echo "<tr> <td>". $row['std_id']."</td> <td>" . $row['course_id'] . "</td> <td>" . $row['grade'] . "</td> </tr>";
                ?>
                
            </tbody>
        </table>
    </div>
</div>

<?php
    include 'footer.php';
?>

