<?php

include 'config.php';
include 'mainLayout.php';

if($_POST){
    $error = "";
    $message = "";

    if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['inputCollegeName'])) {
        $collegeNameErr = "Only letters and white space allowed";
    }else{
        $college_name = htmlspecialchars($_POST['inputCollegeName']);
    }

    if(empty($college_name) > 0){
        $error = "The College name is empty";
    }else{       
        $query = "insert into college (name) VALUES ('$college_name')";

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
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Add College</h3></div>
                        <!-- print error and message -->
                        <?php
                            if(!empty($message)){
                                echo "<h3 style='background-color: green;'> $message </h3>";
                            }
                            if(!empty($error)){
                                echo "<h3 style='background-color: red;'> $error </h3>";
                            }
                            if(!empty($collegeNameErr)){
                                echo "<h3 style='background-color: red;'> $collegeNameErr </h3>";
                            }
                        ?>
                        <div class="card-body">
                            <form method="post" >
                                <div class="row mb-3">
                                    <div class="col-md-9">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="inputCollegeName" id="inputCollegeName" type="text" placeholder="Enter College Name" require/>
                                            <label for="inputCollegeName">College Name</label>
                                        </div>
                                    </div>       
                                </div>
                                
                                <div class="mt-4 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-block">Add College</button>
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