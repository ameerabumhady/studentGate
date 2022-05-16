<?php
    include 'config.php';
    include 'mainLayout.php';
?>

<h1 class="mt-4">Courses</h1>
<div class="card mb-4">
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Course id</th>
                    <th>Course name</th>
                    <th>College name</th>
                    
                </tr>
            </thead>

            <tbody>
                <?php
                    $query = "select * from courses";

                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){

                            // select Collge name from college table by college ID 
                            $cQuery = "select name from college where college_id = ". $row['college_id'] ;
                            $cResult = mysqli_query($conn, $cQuery);
                            if(mysqli_num_rows($cResult) > 0){
                                $cRow = mysqli_fetch_assoc($cResult);
                            }

                            echo "<tr> <td>". $row['course_id']."</td> 
                            <td>" . $row['name'] . "</td>  
                            <td>" . $cRow['name'] . "</td> </tr>";
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