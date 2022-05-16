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
                    <th>Student id</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>College</th>
                    <th>Edit</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $query = "select * from students";

                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){

                            // select course name from college table by college ID 
                            $cQuery = "select name from college where college_id = ". $row['college_id'] ;
                            $cResult = mysqli_query($conn, $cQuery);
                            if(mysqli_num_rows($cResult) > 0){
                                $cRow = mysqli_fetch_assoc($cResult);
                            }

                            echo "<tr> <td>". $row['std_id']."</td> 
                            <td>" . $row['first_name'] . "</td> 
                            <td>" . $row['last_name'] . "</td> 
                            <td>". $row['email'] . "</td> 
                            <td>" . $row['phone_num']. "</td> 
                            <td>" . $cRow['name'] . "</td> 
                            <td> <a href='editStudent.php?id=".$row['std_id']."'>edit</a> | <a href='SemesterRegistration.php?std_id=".$row['std_id']."&col_id=".$row['college_id']."'>Add</a> | <a href='recessionCourse.php?id=".$row['std_id']."&message=' ''>Recession</a> </td> </tr>";
                        }
                    }else{
                        $error = 'there exist error';
                    }      
                ?>
                
            </tbody>
        </table>
    </div>
</div>    

<?php
include 'footer.php';
?>