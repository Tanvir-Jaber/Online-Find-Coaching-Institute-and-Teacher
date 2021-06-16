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
$userdetails = $dbmanipulate->showUserProfile($Meemail);
if (isset($_SESSION ['Mid']) && isset($_SESSION ['Mname']) && isset($_SESSION ['Memail']) ){
    include_once "institue_head.php";
    $trueStatus = $dbmanipulate->singleUsers($Meid);
    ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Message</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <input type="hidden" class="user_id" value="<?php echo $Meid?>">
            <input type="hidden" class="user_name" value="<?php echo $userdetails->name?>">
            <input type="hidden" class="students_name">
            <input type="hidden"  class="students_id">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List of Students</h3>
                            </div>
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tableBody attrTable">
                                    <?php
                                    $list = $dbmanipulate->viewStudentsInfo();
                                    if ($list){
                                        foreach ($list as $lists){
                                            ?>
                                            <tr>
                                                <td class="attrName"><?php echo $lists->name ?>
                                                    <span class="message-show-on-alert badge-danger badge"></span>
                                                </td>

                                                <td><?php echo $lists->pnumber ?></td>
                                                <td><?php echo $lists->address ?></td>

                                                <td>
                                                    <a data-id = "<?php echo $lists->no?>" href="#" class="attrValue show-chat-box-click btn-sm btn-info"><i class="fas fa-chalkboard-teacher"></i></a>
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
        <div style="display: none; position: absolute; width: 30%; bottom: 0;right: 5%; z-index: 9999999" class="show-chat-box card card-warning direct-chat direct-chat-warning shadow">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-close-tool">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body ">
                <div style="height: 400px" class="direct-chat-messages chatlogs">


                </div>
            </div>
            <div class="card-footer">
                <form action="#" method="post">
                    <div class="input-group">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control chatMessageSend">
                        <span class="input-group-append">
                      <button type="button" class="btn btn-warning chatSendBtn">Send</button>
                    </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include_once "institue_foot.php";
    ?>
    <script>

        setInterval(function () {
            var ary = [];
            var teachers_id = $(".user_id").val();
            var f = $(function () {
                $('.attrTable tr').each(function (a, b) {
                    /*var name = $('.attrName', b).text();*/
                    var value = $('.attrValue', b).attr('data-id');
                    ary.push(value)
                });
                /*console.log(JSON.stringify(ary));*/
                $.ajax({
                    url: "../process/all-process.php",
                    type:'GET',
                    data:{user_type_for_teachers:ary,user_id:teachers_id},
                    success:function (result) {
                        var datas = JSON.parse(result);
                        htmlstring = "";
                        var j = 0;
                        for (var f = 0; f<ary.length; f++) {
                            for (var i = 0; i < datas.length; i++) {
                                if ((datas[i].messageRead == "unseen") && (datas[i].students_id == ary[f]) ) {
                                    $('.attrTable tr').each(function (a, b) {
                                        var name = $('.attrName', b).text();
                                        if($(".attrValue",b).attr('data-id') == datas[i].students_id){
                                            j=j+1;
                                            htmlstring = $(".attrValue",b).attr('data-id');
                                            $('.attrName .message-show-on-alert',b).text(j);
                                        }
                                    });
                                }
                            }
                            j=0;
                        }
                    }
                });
            });
        },800);
        $(".show-chat-box-click").click(function () {
            var teachers_name = $(".user_name").val();
            var teachers_id = $(".user_id").val();
            var students_id = $(this).attr("data-id");
            var studentsDataCollectViaId = "";
            var students_name = $(this).parent().parent().find('td').eq('0').text();
            $(".students_id").val(students_id);
            $(".students_name").val(students_name);

            setInterval(function () {
                $.ajax({
                    type: "POST",
                    url: "../process/all-process.php",
                    data: {
                        studentsDataCollectViaId :studentsDataCollectViaId,
                        teachers_id :teachers_id,
                        students_id :students_id,
                    },
                    success: function(data)
                    {
                        var data = JSON.parse(data);
                        var htmlstring = "";
                        for(var i =0; i<data.length;i++){
                            if((data[i].message_from) !=null){
                                htmlstring +="<div class=\"direct-chat-msg\">\n" +
                                    "                        <div class=\"direct-chat-infos clearfix\">\n" +
                                    "                            <span class=\"direct-chat-name float-left\">" + data[i].teachers_name + "</span>\n" +
                                    "                            <span class=\"direct-chat-timestamp float-right\">" + tConvert(data[i].time) + "</span>\n" +
                                    "                        </div>\n" +
                                    "                        <img class=\"direct-chat-img\"  src=\"../../assets/img/t.jpg\"  alt=\"Message User Image\">\n" +
                                    "                        <div class=\"direct-chat-text\">\n" + data[i].message_from +
                                    "                        </div>\n" +
                                    "                    </div>"
                            }
                            if((data[i].message_to) !=null){
                                htmlstring += "<div class=\"direct-chat-msg right\">\n" +
                                    "                        <div class=\"direct-chat-infos clearfix\">\n" +
                                    "                            <span class=\"direct-chat-name float-right\">"+ data[i].students_name + "</span>\n" +
                                    "                            <span class=\"direct-chat-timestamp float-left\">"+tConvert(data[i].time) + "</span>\n" +
                                    "                        </div>\n" +
                                    "                        <img class=\"direct-chat-img\"  src=\"../../assets/img/images.png\"  alt=\"Message User Image\">\n" +
                                    "                        <div class=\"direct-chat-text\">\n" + data[i].message_to +
                                    "                        </div>\n" +
                                    "                    </div>"
                            }
                        }
                        $('.chatlogs').html(htmlstring);
                    }
                });
            },1000);

            $(".btn-tool").click(function () {
                students_id = null;
                $(".students_id").val("")
            });
            $(".show-chat-box").css("display","block")

        });
        function tConvert (time) {
            // Check correct time format and split into components
            time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

            if (time.length > 1) { // If time format correct
                time = time.slice (1);  // Remove full string match value
                time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
                time[0] = +time[0] % 12 || 12; // Adjust hours
            }
            return time.join (''); // return adjusted time or original string
        }

        $(".btn-close-tool").click(function () {
            $(".show-chat-box").css("display","none");
            location.reload();
        });

        $(".chatSendBtn").click(function () {
            var teachers_name = $(".user_name").val();
            var teachers_id = $(".user_id").val();
            var students_id = $(".students_id").val();
            var students_name = $(".students_name").val().trim();
            var chat_message = $(".chatMessageSend").val();
            var htmlstring = " ";
            var studentsDataCollectViaId = " ";
            if(chat_message.length>0){
                $.ajax({
                    type: "POST",
                    url: "../process/all-process.php",
                    data: {
                        teachers_name :teachers_name,
                        teachers_id :teachers_id,
                        students_id :students_id,
                        students_name :students_name,
                        chat_message :chat_message,
                    },
                    success: function(data)
                    {
                        $(".chatMessageSend").val("")
                        $.ajax({
                            type: "POST",
                            url: "../process/all-process.php",
                            data: {
                                studentsDataCollectViaId :studentsDataCollectViaId,
                                teachers_id :teachers_id,
                                students_id :students_id,
                            },
                            success: function(data)
                            {
                                console.log(data);
                                var data = JSON.parse(data);
                                var htmlstring = "";
                                for(var i =0; i<data.length;i++){
                                    if((data[i].message_from) !=null){
                                        htmlstring +="<div class=\"direct-chat-msg\">\n" +
                                            "                        <div class=\"direct-chat-infos clearfix\">\n" +
                                            "                            <span class=\"direct-chat-name float-left\">" + data[i].teachers_name + "</span>\n" +
                                            "                            <span class=\"direct-chat-timestamp float-right\">" + tConvert(data[i].time) + "</span>\n" +
                                            "                        </div>\n" +
                                            "                        <img class=\"direct-chat-img\"  src=\"../../assets/img/t.jpg\"  alt=\"Message User Image\">\n" +
                                            "                        <div class=\"direct-chat-text\">\n" + data[i].message_from +
                                            "                        </div>\n" +
                                            "                    </div>"
                                    }
                                    if((data[i].message_to) !=null){
                                        htmlstring += "<div class=\"direct-chat-msg right\">\n" +
                                            "                        <div class=\"direct-chat-infos clearfix\">\n" +
                                            "                            <span class=\"direct-chat-name float-right\">"+ data[i].students_name + "</span>\n" +
                                            "                            <span class=\"direct-chat-timestamp float-left\">"+tConvert(data[i].time) + "</span>\n" +
                                            "                        </div>\n" +
                                            "                        <img class=\"direct-chat-img\"  src=\"../../assets/img/images.png\"  alt=\"Message User Image\">\n" +
                                            "                        <div class=\"direct-chat-text\">\n" + data[i].message_to +
                                            "                        </div>\n" +
                                            "                    </div>"
                                    }
                                }
                                $('.chatlogs').html(htmlstring);
                            }
                        });
                    }
                });
            }
        });

    </script>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>
