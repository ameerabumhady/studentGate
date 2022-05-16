<?php

include 'config.php';
include 'mainLayout.php';

if($_POST){
    $error = "";
    $message = "";

    if (!preg_match("/^[0-9.]*$/",$_POST['student'])) {
        $stdIdErr = "This Student not exist";
    }else{
        $student_id = htmlspecialchars($_POST['student']);
    }

    if (!preg_match("/^[0-9.]*$/",$_POST['course'])) {
        $courseIdErr = "This Course not exist";
    }else{
        $stdCourse_id = htmlspecialchars($_POST['course']);
    }

    if (!preg_match("/^[0-9.]*$/",$_POST['grade'])) {
        $gradeErr = "Only numbers allowed from 40 to 100";
    }else{
        $student_grade = htmlspecialchars($_POST['grade']);
    }

    if(empty($student_id) || empty($stdCourse_id) || empty($student_grade) > 0){
        $error = " There exist filed is empty";
    }else{
        
        $query = "insert into studentscourse ( std_id, course_id, grade) VALUES ('$student_id', '$stdCourse_id', $student_grade)";

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
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Semester Registration</h3>
                        </div>
                        <div>
                            <?php
                                if(!empty($message)){
                                    echo "<h3 style='background-color: green;'> $message </h3>";
                                }
                                if(!empty($error)){
                                    echo "<h3 style='background-color: red;'> $error </h3>";
                                }
                                if(!empty($stdIdErr)){
                                    echo "<h3 style='background-color: red;'> $stdIdErr </h3>";
                                }
                                if(!empty($courseIdErr)){
                                    echo "<h3 style='background-color: red;'> $courseIdErr </h3>";
                                }
                                if(!empty($gradeErr)){
                                    echo "<h3 style='background-color: red;'> $gradeErr </h3>";
                                }
                            ?>
                        </div>
                        <div class="card-body">
                            <form method="post" >
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" list="students" name="student" id="student">
                                            <datalist id="students">
                                            <?php
                                                $stdQuery = "select * from students";
                                                $stdResult = mysqli_query($conn, $stdQuery);
                                                if(mysqli_num_rows($stdResult) > 0){
                                                    while($stdRow = mysqli_fetch_assoc($stdResult)){
                                                        echo "<option value='".$stdRow['std_id']."'> ".$stdRow['first_name']." ".$stdRow['last_name']." </option>";                                      
                                                    }
                                                }else{
                                                    $error = 'there exist error';
                                                }      
                                            ?>
                                            </datalist>       
                                            <label for="inputFirstName">Student Name</label>
                                        </div>
                                    </div>                   
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 mb-md-0">
                                            
                                            <input class="form-control" list="courses" name="course" id="course">
                                            <datalist id="courses">
                                                <?php
                                                    $cQuery = "select * from courses";
                                                    $cResult = mysqli_query($conn, $cQuery);
                                                    if(mysqli_num_rows($cResult) > 0){
                                                        while($cRow = mysqli_fetch_assoc($cResult)){
                                                            echo "<option value='".$cRow['course_id']."'> ".$cRow['name']." </option>";
                                                        }
                                                    }else{
                                                        $error = 'there exist error';
                                                    }
                                                ?>
                                            </datalist>
                                            <label for="collegeName">Course</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" type="number" name="grade" id="grade">
                                            <label for="collegeName">Grade</label>
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
                            <div class="small">
                                <a href="home.php">Back to Home Page</a>
                            </div>
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