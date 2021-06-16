<?php
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
use App\DataManipulation\DataManipulation;
$Meid = $_SESSION ['Mid'];
$Mename = $_SESSION ['Mname'];
$Meemail = $_SESSION ['Memail'];
$dbmanipulate = new DataManipulation();
$trueStatus = $dbmanipulate->singleUsers($Meid);
$userdetails = $dbmanipulate->showUserProfile($Meemail);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Find Instructing Institute and Teacher</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../dist/css/bappi.min.css">
    <link rel="stylesheet" href="../../assets/css/alt/animate.css">
    <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
    <style>
        .error{
            color: #e80000;
            display: table;
            border-collapse: collapse;
            width:100%;
            margin: 0px;

        }
        .typewriter h1 {

            overflow: hidden;
            border-right: .10em solid orange;
            white-space: nowrap;
            margin: 0 auto;
            letter-spacing: .10em; /* Adjust as needed */
            animation:
                    typing 3.5s steps(55, end ),
                    blink-caret .75s step-end infinite ;

        }

        /* The typing effect */
        @keyframes typing {
            from { width: 0 }
            to { width: 50% }
        }

        /* The typewriter cursor effect */
        @keyframes blink-caret {
            from, to { border-color: transparent }
            30% { border-color: orange; }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <marquee><span style="font-size: 20px" class="brand-text font-weight-bold">  Find Instructing Institute and Teacher</span></marquee>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="profile.php" class="brand-link">
            <span class="brand-text font-weight-bolder d-flex justify-content-center">Find Instructing Institute <br>and Teacher</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-5 pb-3 mb-3 d-flex">
                <div class="image">
                    <img style="width: 3.1rem; height: 3.1rem" src="../../assets/img/t.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info mt-2">
                    <span class=" d-block font-weight-bold text-white"><?php echo $userdetails->name ?></span>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link ">
                            <i class="nav-icon fas fa-user-alt"></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="update.php" class="nav-link ">
                            <i class="nav-icon fab fa-bitcoin"></i>
                            <p>
                                Update Profile
                            </p>
                        </a>
                    </li>
                    <?php if($userdetails->checkActive == 'yes') {?>
                    <li class="nav-item">
                        <a href="post.php" class="nav-link ">
                            <i class="nav-icon fas fa-h-square"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                            <a href="message.php" class="nav-link ">
                                <i class="nav-icon fas fa-check"></i>
                                <p>
                                    Message
                                </p>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a href="view_request.php" class="nav-link ">
                            <i class="nav-icon fab fa-atlassian"></i>
                            <p>
                                View Request
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="manage_post.php" class="nav-link ">
                            <i class="nav-icon fab fa-battle-net"></i>
                            <p>
                                Manage Post
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link ">
                            <i class="nav-icon fas fa-blender-phone"></i>
                            <p>
                               Contact
                            </p>
                        </a>
                    </li><?php }?>
                    <li class="nav-item">
                        <a href="../process/data-process.php?Alogout=1" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>