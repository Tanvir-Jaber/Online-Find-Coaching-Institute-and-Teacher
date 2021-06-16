<?php
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
use App\DataManipulation\DataManipulation;
$Adid = $_SESSION ['Aid'];
$Adname = $_SESSION ['Aname'];
$Ademail = $_SESSION ['Aemail'];
$dbmanipulate = new DataManipulation();
$userdetails = $dbmanipulate->showUserProfile($Ademail);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Find Instructing Institute and Teacher</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../../dist/css/bappi.min.css">
    <link rel="stylesheet" href="../../assets/css/alt/animate.css">
    <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">

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
        <a href="bHome.php" class="brand-link">
            <span class="brand-text font-weight-bolder d-flex justify-content-center">Find Instructing Institute <br>and Teacher</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-5 pb-3 mb-3 d-flex">
                <div class="image">
                    <img style="width: 3.1rem; height: 3.1rem" src="../../assets/img/a.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info mt-2">
                    <span class=" d-block font-weight-bold text-white"><?php echo $userdetails->name ?></span>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="bHome.php" id="one" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="manage_accounts.php" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Manage Accounts
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="manage_institute.php" class="nav-link">
                            <i class="nav-icon fas fa-house-damage"></i>
                            <p>
                                Manage Institute
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="bprofile.php" class="nav-link">
                            <i class="nav-icon fas fa-user-alt"></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="view_users_profile.php" class="nav-link">
                            <i class="nav-icon fas fa-user-alt-slash"></i>
                            <p>
                                View Users Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="request_appreoved.php" class="nav-link">
                            <i class="nav-icon fas fa-trash-restore-alt"></i>
                            <p>
                                Request Approve
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="trash.php" class="nav-link">
                            <i class="nav-icon fas fa-trash-alt"></i>
                            <p>
                                Recover List
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="add_new_admin.php" class="nav-link">
                            <i class="nav-icon fas fa-book-dead"></i>
                            <p>
                                Add New Admin
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="manage_admin.php" class="nav-link">
                            <i class="nav-icon fas fa-user-edit"></i>
                            <p>
                                Manage New Admin
                            </p>
                        </a>
                    </li>
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