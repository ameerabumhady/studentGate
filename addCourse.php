<?php

include 'config.php';
include 'mainLayout.php';

if($_POST){
    $error = "";
    $message = "";

    $college_id = htmlspecialchars($_POST['college_id']);

    if (!preg_match("/^[a-zA-Z-' 0-9]*$/",$_POST['inputCourseName'])) {
        $courseNameErr = "Only letters and white space allowed";
    }else{
        $course_name = htmlspecialchars($_POST['inputCourseName']);
    }

    if(empty($course_name) || empty($college_id) > 0){
        $error = "There exist filed is empty";
    }else{
        
        $query = "insert into courses (name, college_id) VALUES ('$course_name', $college_id)";

        if(mysqli_query($conn, $query)){
            $message = "succed";
        }else{
            $error = "faild";
        }
    }

}
?>

<div id="layoutAuthentication_content">
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Course</h3></div>
                        <!-- print error and message -->
                        <?php
                            if(!empty($message)){
                                echo "<h3 style='background-color: green;'> $message </h3>";
                            }
                            if(!empty($error)){
                                echo "<h3 style='background-color: red;'> $error </h3>";
                            }
                            if(!empty($courseNameErr)){
                                echo "<h3 style='background-color: red;'> $courseNameErr </h3>";
                            }
                        ?>
                        <div class="card-body">
                            <form method="post" >
                                <div class="row mb-3">
                                    <div class="col-md-9">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="inputCourseName" id="inputCourseName" type="text" placeholder="Enter Course Name" require/>
                                            <label for="inputCourseName">Course Name</label>
                                        </div>
                                    </div>       
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-9">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <!-- <input class="form-control" id="collegeName" type="text" placeholder="College Name" /> -->
                                            <select class="form-control" name="college_id" id="" require>
                                                <?php
                                                    $query = "select * from college";
                                                    $result = mysqli_query($conn, $query);
                                                    if(mysqli_num_rows($result) > 0){
                                                        while($row = mysqli_fetch_assoc($result)){
                                                            echo "<option value=".$row['college_id'].">".$row['name']."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label for="collegeName">College Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-block">Add Course</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <div class="small"><a href="home.php">Back to Home Page</a></div>
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