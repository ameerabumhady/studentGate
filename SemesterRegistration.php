<?php

include 'config.php';
include 'mainLayout.php';

if($_POST){
    $error = "";
    $message = "";

    // $student_id = htmlspecialchars($sid);
    // $course_id = htmlspecialchars($cid);

    // if (!preg_match("/^[0-9]*$/",$_POST['std_id'])) {
    //     $stdIdErr = "This Student not exist";
    // }else{
    //     $student_id = htmlspecialchars($_POST['std_id']);
    // }

    // if (!preg_match("/^[0-9]*$/",$_POST['course_id'])) {
    //     $courseIdErr = "This Course not exist";
    // }else{
    //     $course_id = htmlspecialchars($_POST['course_id']);
    // }


    if(empty($sid) || empty($cid) > 0){
        $error = " There exist filed is empty";
    }else{
        
        $query = "insert into studentscourse ( std_id, course_id) VALUES ('$sid', '$cid')";

        if(mysqli_query($conn, $query)){
            $message = "succed";
        }else{
            $error = "faild";
        }
    }

}

if($_GET){
    $std_id = htmlspecialchars($_GET['std_id']);
    $col_id = htmlspecialchars($_GET['col_id']);

    $query = "select * from students where std_id = $std_id";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }else{
        header("Location: error404.php");
    }
}
?>

    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Semester Registration</h3></div>
                            <?php
                                // if(!empty($message)){
                                //     echo "<h3 style='background-color: green;'> $message </h3>";
                                // }
                                // if(!empty($error)){
                                //     echo "<h3 style='background-color: red;'> $error </h3>";
                                // }
                                // if(!empty($firstNameErr)){
                                //     echo "<h3 style='background-color: red;'> $firstNameErr </h3>";
                                // }
                                // if(!empty($lastNameErr)){
                                //     echo "<h3 style='background-color: red;'> $lastNameErr </h3>";
                                // }
                            
                            ?>
                            <div class="card-body">
                                <form method="post" action="">
                                    <?php
                                        $sid = "";
                                        $cid = "";
                                    ?>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <?php $sid=5; ?>
                                            <input type="hidden" value="<?php if(isset($row['std_id'])) echo $row['std_id']; ?>" name="<?php if(isset($row['std_id'])) echo $row['std_id']; ?>">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" name="inputFirstName" value="<?php if(isset($row['first_name'])) echo $row['first_name']; ?>" id="inputFirstName" type="text" placeholder="Enter your first name" require/>
                                                
                                                <label for="inputFirstName">First name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" name="inputLastName" value="<?php if(isset($row['last_name'])) echo $row['last_name']; ?>" id="inputLastName" type="text" placeholder="Enter your last name" require/>
                                                
                                                <label for="inputLastName">Last name</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                        <div class="form-floating mb-3 mb-md-0">
                                                <select class="form-control" name="college_id" id="" require>
                                                    <option> Choose College</option>
                    
                                                    <?php
                                                    $colQuery = "select * from college";
                                                    $colResult = mysqli_query($conn, $colQuery);
                                                    if(mysqli_num_rows($colResult) > 0){
                                                        while($colRow = mysqli_fetch_assoc($colResult)){
                                                            $colRow['college_id'] == $row['college_id'] ? $s = "selected" : $s = "";
                                                            echo "<option $s value=".$colRow['college_id'].">".$colRow['name']."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="collegeName">College</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <select class="form-control" name="college_id" id="" require>
                                                    <option> Choose Course</option>
                                                    <?php
                                                        $cQuery = "select * from courses where college_id = $col_id";
                                                        $cResult = mysqli_query($conn, $cQuery);
                                                        if(mysqli_num_rows($cResult) > 0){
                                                            while($cRow = mysqli_fetch_assoc($cResult)){
                                                                $cid = $cRow['course_id'];
                                                                echo "<option value=".$cid.">".$cRow['name']."</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label for="collegeName">Course</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="displayStudents.php">Back to Students Page</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
<?php
include 'footer.php';
?>