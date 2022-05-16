<?php
    include 'config.php';
    
    $message = "";
    if($_GET){
        $std_id = htmlspecialchars($_GET['sid']);
        $c_id = htmlspecialchars($_GET['cid']);
    
        $query = "delete from  studentscourse where std_id = $std_id and course_id = $c_id";
        
        if(mysqli_query($conn, $query)){
            $message = "succed";
            header("location: recessionCourse.php?message=$message&id=$std_id");
            
        }else{
            $error = "faild";
        }
    }
    
    echo $message;
?>