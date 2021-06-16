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
                        <h1 class="m-0 text-dark">View Users Profile</h1>
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
                                <h3 class="card-title">View Member Data</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $list = $dbmanipulate->SearchAllUsersToView();
                                    if ($list){
                                        foreach ($list as $lists){
                                            ?>
                                            <tr>
                                                <td><?php echo $lists->name ?></td>
                                                <td><?php echo $lists->position ?></td>
                                                <td><?php echo $lists->address ?></td>
                                                <td><?php echo $lists->pnumber ?></td>
                                                <td>
                                                    <button data-id="<?php echo $lists->no; ?>" data-toggle="modal" data-target="#exampleModal" class="btn-sm btn-danger see-details"><i class="fas fa-eye-dropper"></i></button>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title " id="exampleModalLabel">Users Information</h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-sm btn-info" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once "adminFoot.php";
    ?>
    <script>
        $(".see-details").click(function () {
            var value = $(this).attr('data-id')
            $.ajax({
                url: "../process/data-process.php",
                type:'GET',
                data:{user_Details_Preview:value},
                success:function (result) {
                    var datas = JSON.parse(result);
                    console.log(datas);
                    var htmlstring = ""
                    if(datas.position == "Guardian"){
                    htmlstring = "                    <div class=\"row\">\n" +
                        "                        <div class=\"col-6\">\n" +
                        "                            <input disabled  type=\"text\"  value = '"+ datas.name + " '  class=\"form-control\"><br>\n" +
                        "                        </div>\n" +
                        "                        <div class=\"col-6\">\n" +
                        "                            <input type=\"text\" disabled  value = '"+ datas.email + " '  class=\"form-control\"><br>\n" +
                        "                        </div>\n" +
                        "                    </div>\n" +
                        "                    <div class=\"row\">\n" +
                        "                        <div class=\"col-6\">\n" +
                        "                            <input type=\"text\" disabled  value = '"+ datas.pnumber + " ' class=\"form-control\"><br>\n" +
                        "                        </div>\n" +
                        "                        <div class=\"col-6\">\n" +
                        "                            <input type=\"text\" disabled  value = '"+ datas.address + " '  class=\"form-control\"><br>\n" +
                        "                        </div>\n" +
                        "                    </div>";}

                    else if(datas.position == "InstructingInstitute"){
                        htmlstring = "                    <div class=\"row\">\n" +
                            "                        <div class=\"col-6\">\n" +
                            "                            <input disabled  type=\"text\"  value = '"+ datas.name + " '  class=\"form-control\"><br>\n" +
                            "                        </div>\n" +
                            "                        <div class=\"col-6\">\n" +
                            "                            <input type=\"text\" disabled  value = '"+ datas.email + " '  class=\"form-control\"><br>\n" +
                            "                        </div>\n" +
                            "                    </div>\n" +
                            "                    <div class=\"row\">\n" +
                            "                        <div class=\"col-4\">\n" +
                            "                            <input type=\"text\" disabled  value = '"+ datas.pnumber + " ' class=\"form-control\"><br>\n" +
                            "                        </div>\n" +
                            "                        <div class=\"col-4\">\n" +
                            "                            <input type=\"text\" disabled  value = '"+ datas.address + " '  class=\"form-control\"><br>\n" +
                            "                        </div>\n" +
                            "                        <div class=\"col-4\">\n" +
                            "                            <input type=\"text\" disabled  value = '"+ datas.cname + " '  class=\"form-control\"><br>\n" +
                            "                        </div>\n" +
                            "                    </div>";}
                    else{
                        htmlstring = "<div class=\"d-flex justify-content-center\"><img style=\"width: 300px; height: 300px\" src='"+ datas.nid + " ' ></div><br>\n" +
                            "                    <div class=\"row\">\n" +
                            "                        <div class=\"col-6\">\n" +
                            "                            <input disabled  type=\"text\"  value = '"+ datas.name + " '  class=\"form-control\"><br>\n" +
                            "                        </div>\n" +
                            "                        <div class=\"col-6\">\n" +
                            "                            <input type=\"text\" disabled  value = '"+ datas.email + " '  class=\"form-control\"><br>\n" +
                            "                        </div>\n" +
                            "                    </div>\n" +
                            "                    <div class=\"row\">\n" +
                            "                        <div class=\"col-6\">\n" +
                            "                            <input type=\"text\" disabled  value = '"+ datas.pnumber + " ' class=\"form-control\"><br>\n" +
                            "                        </div>\n" +
                            "                        <div class=\"col-6\">\n" +
                            "                            <input type=\"text\" disabled  value = '"+ datas.address + " '  class=\"form-control\"><br>\n" +
                            "                        </div>\n" +
                            "                    </div>";}
                        $(".modal-body").html(htmlstring)

                }
            });
        });
    </script>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>

