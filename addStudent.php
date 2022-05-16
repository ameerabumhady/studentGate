<?php

include 'config.php';
include 'mainLayout.php';

if($_POST){
    $error = "";
    $message = "";

    $college_id = htmlspecialchars($_POST['college_id']);

    if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['inputFirstName'])) {
        $firstNameErr = "Only letters and white space allowed";
    }else{
        $first_name = htmlspecialchars($_POST['inputFirstName']);
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['inputLastName'])) {
        $lastNameErr = "Only letters and white space allowed";
    }else{
        $last_name = htmlspecialchars($_POST['inputLastName']);
    }

    if (!preg_match("/^[0-9]*$/",$_POST['phoneNumber'])) {
        $phoneNumberErr = "Only number allowed";
    }else{
        $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
    }

    if (!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }else{
        $email = htmlspecialchars($_POST['inputEmail']);
    }

    if(empty($first_name) || empty($last_name) ||empty($email) > 0){
        $error = " There exist filed is empty";
    }else{
        
        $query = "insert into students ( first_name, last_name, email, phone_num, college_id) VALUES ('$first_name', '$last_name', '$email', '$phoneNumber', $college_id)";

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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Student</h3></div>
                                    <?php
                                        if(!empty($message)){
                                            echo "<h3 style='background-color: green;'> $message </h3>";
                                        }
                                        if(!empty($error)){
                                            echo "<h3 style='background-color: red;'> $error </h3>";
                                        }
                                        if(!empty($firstNameErr)){
                                            echo "<h3 style='background-color: red;'> $firstNameErr </h3>";
                                        }
                                        if(!empty($lastNameErr)){
                                            echo "<h3 style='background-color: red;'> $lastNameErr </h3>";
                                        }
                                        if(!empty($emailErr)){
                                            echo "<h3 style='background-color: red;'> $emailErr </h3>";
                                        }
                                    ?>
                                    <div class="card-body">
                                        <form method="post" >
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="inputFirstName" id="inputFirstName" type="text" placeholder="Enter your first name" require/>
                                                        <label for="inputFirstName">First name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="inputLastName" id="inputLastName" type="text" placeholder="Enter your last name" require/>
                                                        <label for="inputLastName">Last name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="inputEmail" id="inputEmail" type="email" placeholder="name@example.com" require/>
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="phoneNumber" id="phoneNumber" type="number" placeholder="Phone Number" />
                                                        <label for="phoneNumber">Phone number</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <!-- <input class="form-control" id="collegeName" type="text" placeholder="College Name" /> -->
                                                        <select class="form-control" name="college_id" id="" require>
                                                            <option> choose college</option>
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
                                                        <label for="collegeName">College</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-block">Add Student</button>
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