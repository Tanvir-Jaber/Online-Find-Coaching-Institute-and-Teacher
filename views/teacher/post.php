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
            <div class="d-flex justify-content-center " >
                <div style="width: 90%" class="card-body>
                    <div class="card card-danger card-outline callout callout-danger">
                        <form id="FormData" action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="name" name="name" value="<?php echo $userdetails->name?>">
                            <input type="hidden" id="user_id" name="user_id" value="<?php echo $Meid?>">
                            <div class="card-body ">
                                <strong><i class="fas fa-book mr-1"></i>Post Box</strong>
                                <textarea style="resize: none; height: 150px" name="noticeInfo" class="post-message main-search form-control"></textarea>
                                <div class="row mt-1">
                                    <div class="col-12">
                                        <button type="submit" name="newNotice" style="background: #7e183b;border: #00adc2;color: #ffffff;font-weight: bold" class="newNotice btn btn-block"><i class="fa fa-sign-language mr-2" aria-hidden="true"></i>Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
    <div class="row d-flex justify-content-center ">
        <div class="col-md-8 dataShow"></div>

    </div>
            </div>

            <footer>

            </footer>
    </div>
    <?php
    include_once "institue_foot.php";
    ?>
    <script>

        showData();
        var user_name = $("#name").val();
        var user_id = $("#user_id").val();
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
        function showData() {
            var getData = " ";
            $.ajax({
                type: "GET",
                url: "../process/all-process.php",
                data: {
                    getData: getData
                },
                success: function(data)
                {
                    var data = JSON.parse(data);
                    var html = " ";
                    var htmlString = " ";
                    for (var i = 0;  i<data.length;  i++){
                        if (data[i].commentNo == null) {
                            html +="<div class=\"\">\n" +
                                "<div class=\"card card-widget\">\n" +
                                "<div class=\"card-header\">\n" +
                                "<div class=\"user-block\">\n" +
                                "<img class=\"img-circle\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWJz431lREZTdQ7ma-aYTxR7o-FQlkSBYvww&usqp=CAU\" alt=\"User Image\">\n" +
                                "<span class=\"username\"><a href=\"#\">" + data[i].name + "</a></span>\n" +
                                "<span class=\"description\">" +data[i].date + " Time " +  tConvert(data[i].time) +"</span>\n" +
                                "</div>\n" +
                                "<div class=\"card-tools\">\n";
                            html+="<button data-id ='"+ data[i].user_id +"' type=\"button\" class=\"btn btn-tool\"  data-card-widget=\"collapse\">\n" +
                                "<i class=\"fas fa-minus\"></i>\n" +
                                "</button>\n" +
                                "</div>\n" +
                                "</div>\n" +
                                "<div class=\"card-body\">\n" +
                                "<div style='white-space: pre-wrap'>" + data[i].post + "</div>" +
                                "<span class=\"float-right text-muted\">Comments</span></div>"

                            for (var j = 0; j < data.length; j++) {
                                if (data[i].post_no == data[j].commentNo) {
                                    html += "<div class=\"card-footer card-comments\">\n" +
                                        "<div class=\"card-comment\">\n" +
                                        "<img class=\"img-circle img-sm\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSYOAIEfQyI9D0ppg3JUB7layTQxYoQQrmKg&usqp=CAU\" alt=\"User Image\">\n" +
                                        "<div class=\"comment-text\">\n" +
                                        "<span class=\"username\">\n" + data[j].name +
                                        "<span class=\"text-muted float-right\">"  + tConvert(data[j].time) + " </span>\n" +
                                        "</span>" + data[j].post +
                                        "</div>\n" +
                                        "</div>\n" +
                                        "</div>\n"
                                }
                            }
                            html += "<div class=\"card-footer\">\n" +
                                "<a href='' data-id ='"+ data[i].post_no +"' class=\"telegrambtn text-primary img-fluid img-circle img-sm\"><i class=\"fab fa-telegram fa-2x\" ></i></a>\n" +
                                "<div class=\"img-push\">\n" +
                                "<input type=\"text\" class=\"form-control form-control-sm\" placeholder=\"Press enter to post comment\">\n" +
                                "</div>\n" +
                                "</div>\n" +
                                "</div>\n" +
                                "</div>"


                        }
                        $(".dataShow").html(html);
                        $(".telegrambtn").click(function (e) {
                            e.preventDefault();
                            var commentValue = $(this).parent().find('input').val();
                            var commentNo = $(this).attr("data-id");
                            var user_name = $("#name").val();
                            var user_id = $("#user_id").val();
                            if (commentValue.length>0){
                                $.ajax({
                                    type: "POST",
                                    url: "../process/all-process.php",
                                    data: {
                                        commentValue: commentValue,
                                        commentNo: commentNo,
                                        user_name: user_name,
                                        user_id: user_id,
                                    },
                                    success: function(data)
                                    {
                                        showData()
                                    }
                                });
                                $(this).parent().find('input').val(" ")

                            }
                        })
                    }
                }
            });

        }
        function submitPostData(form_data) {
            $.ajax({
                type: "POST",
                url: "../process/all-process.php",
                data: form_data,
                processData:false,
                contentType:false,
                cache:false,
                success: function(data)
                {
                    showData()
                }
            });
        }
        $(".newNotice").click(function (e) {
            e.preventDefault();
            var textarea = $(".post-message").val().length;
            var textareas = $(".post-message").val();
            var form_data = new FormData($('#FormData')[0]);
            form_data.append("user_name",user_name);
            form_data.append("user_id",user_id);
            if(textarea>0)
            {
                submitPostData(form_data);
                $(".post-message").val("");
            }
        })

    </script>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>
