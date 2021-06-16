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
if (isset($_SESSION ['Aid']) && isset($_SESSION ['Aname']) && isset($_SESSION ['Aemail']) ){
    include_once "adminHead.php";
    ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Users Accounts</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Member Data</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Contact Number</th>
                                        <th>Address</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $list = $dbmanipulate->SearchVia();
                                    if ($list){
                                        foreach ($list as $lists){
                                            ?>
                                            <tr>
                                                <td><?php echo $lists->name ?></td>
                                                <td><?php echo $lists->position ?></td>
                                                <td><?php echo $lists->pnumber ?></td>
                                                <td><?php echo $lists->address ?></td>
                                                <td>
                                                    <a href="../process/data-process.php?user_status_active=<?php echo $lists->no; ?>" class="btn-sm btn-danger"><i class="fas fa-trash-restore-alt"></i></a>
                                                </td>

                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php
    include_once "adminFoot.php";
}
else{
    header("Location: ../login-register/login.php");
}
?>

