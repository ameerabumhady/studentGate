<?php
    session_start();
    if(!$_SESSION['id']){
        
        header("location: login.php");
    }
    $id_log = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>home</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/font-awesome.min.css">

        
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="home.php">Student Gate</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        <li><a class="dropdown-item" href="#!"><?php echo $id_log ?> </a></li>
                        
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                    
                            <!-- <a class="nav-link" href="home.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a> -->
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Colleges
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php
                                    include 'config.php';
                                    
                                    $query = "select * from college";

                                    $result = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
    
                                            $id = $row['college_id'];
                                            $name = $row['name'];
                                            echo "<a class='nav-link' href='college.php?id=$id&name=$name'>".$row['name']."</a>";
                                        }
                                    }
                                    ?>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStudents" aria-expanded="false" aria-controls="collapseStudents">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Studens
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseStudents" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="addStudent.php">Add Student</a>
                                    <a class="nav-link" href="displayStudents.php">Display Students</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCourses" aria-expanded="false" aria-controls="collapseCourses">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Courses
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCourses" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="addCourse.php">Add Course</a>
                                    <a class="nav-link" href="home.php">Display Courses</a>
                                </nav>
                            </div>

                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="grades.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Grades
                            </a>

                            <a class="nav-link" href="newRegistration.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Semester Registration
                            </a>
                            
                            <a class="nav-link" href="addCollege.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Add College
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="" style="background-color: #f8f9fa; margin-left: -24px; margin-right: -24px; padding-left:10px; padding-bottom:1px">
                            <h2>Quick links</h2>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="displayStudents.php">Students</a></li>
                                <li class="breadcrumb-item"><a href="home.php">Courses</a></li>
                                <li class="breadcrumb-item"><a href="grades.php">Grades</a></li>
                                <li class="breadcrumb-item"><a href="newRegistration.php">Semester Registration</a></li>
                                <li class="breadcrumb-item"><a href="displayCollege.php">Colleges</a></li>
                            </ol>
                        </div>
                        
                    