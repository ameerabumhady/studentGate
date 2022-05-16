<?php

include 'config.php';
include 'mainLayout.php';
?>

<h1 class="mt-4">Colleges</h1>
<div class="card mb-4">
    <div class="card-body">
        <?php
            $query = "select * from college";

            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){

                    $collapse = $row['college_id'];
                    // echo "<tr> <td>". $row['college_id']."</td> 
                    // <td>" . $row['name'] . "</td> </tr>" ;
                    echo "<h3 class='nav-link collapsed' href='#' data-bs-toggle='collapse' data-bs-target='#col".$collapse."' aria-expanded='false' aria-controls='col".$collapse."'>
                        <div class='sb-nav-link-icon'></div> <i class='fas fa-angle-down'></i>
                        ". $row['name'] ."</h3>";
                    
                        // select course name from college table by college ID 
                    $cQuery = "select name from courses where college_id = $collapse ";
                    $cResult = mysqli_query($conn, $cQuery);
                    if(mysqli_num_rows($cResult) > 0){
                        
                        while($cRow = mysqli_fetch_assoc($cResult)){
                            
                            $name = $cRow['name'];
                            echo '<div class="collapse" id="col'.$collapse.'" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <h4 class="nav-link">'.$name.'</h4>
                            </nav>
                        </div>';
                        }
                    }
                }
            }else{
                $error = 'there exist error';
            }      
        ?>       
        
    </div>
</div>    

<?php
include 'footer.php';
?>