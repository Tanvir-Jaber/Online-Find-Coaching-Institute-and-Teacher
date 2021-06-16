<?php
/**
 * Created by PhpStorm.
 * User: sAlek Chowdhury
 * Date: 22-Mar-20
 * Time: 4:52 AM
 */

namespace App\DataManipulation;
use App\Model\Database as DB;
use  App\Utility\Utility;



class DataManipulation extends DB
{
    public $password;

    public function setupdatepass($data){
        if (array_key_exists('re_pass', $data)) {
            $this->password = $data['re_pass'];
        }
    }

    public function Search(){
        $sql = "SELECT * FROM users where checkActive = 'no' && position != 'Admin' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function TotalInstituteSearch(){
        $sql = "SELECT * FROM users where checkActive = 'yes' && position = 'InstructingInstitute' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function TotalTeacheListSearch(){
        $sql = "SELECT * FROM users where checkActive = 'yes' && position = 'Teacher' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function TotalMembersSearch(){
        $sql = "SELECT * FROM users where position != 'Admin' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function SearchCoachingCenter(){
        $sql = "SELECT * FROM users where status = 0 && checkActive = 'yes' && position = 'InstructingInstitute' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function SearchVia(){
        $sql = "SELECT * FROM users where status = 0 && checkActive = 'yes' && position != 'InstructingInstitute' && position != 'Admin' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function SearchViaMany(){
        $sql = "SELECT * FROM users where status = 1 && checkActive = 'yes' && position != 'Admin' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function Admin(){
        $sql = "SELECT * FROM users where checkActive = 'no' && position = 'Admin'  && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function showUserProfile($email)
    {
        $sql = "select * from users where email = '".$email."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetch();
        return $status;
    }
    public function getUserDataToShow($id)
    {
        $sql = "select * from users where no = '".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetch();
        return $status;
    }
    public function SearchAllUsersToView()
    {
        $sql = "select * from users WHERE POSITION != 'Admin'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }

    public  function updateUserPassword($user_id,$re_pass){
        $array=array($re_pass);
        $sql="update  users set pass=? WHERE no =$user_id";
        $data= $this->Dbconnect->prepare($sql);
        $status=$data->execute($array);
        return $status;
    }
    public function userPassword($user_id){
        $sql = "SELECT password FROM users WHERE user_id=$user_id";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();

        return $satatus;
    }
    public function singleUsers($id){
        $sql = "SELECT * FROM users WHERE checkActive = 'yes' && no ='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();

        return $satatus;
    }
    public function checkSubscriptionToken($email){
        $sql = "SELECT * FROM subscription WHERE email ='".$email."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();

        return $satatus;
    }
    public function checkTeacherEmailInList($email){
        $sql = "SELECT * FROM teacher WHERE email ='".$email."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();

        return $satatus;
    }
    public function userPaymentQuery($email){
        $sql = "SELECT * FROM subscription WHERE email ='".$email."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();

        return $satatus;
    }
    public function usercheckactive($user_id){
        $re_check = 'yes';
        $array=array($re_check);
        $sql="update  users set checkActive=? WHERE no='".$user_id."'";
        $data= $this->Dbconnect->prepare($sql);
        $status=$data->execute($array);
        return $status;
    }
    public function usercheckactiveDelete($user_id){
        $sql=" delete from users WHERE no='".$user_id."'";
        $data= $this->Dbconnect->exec($sql);
        return $data;
    }
    public function userProfileUdate($user_id,$name,$address){
        $sql="update  users set name='".$name."' , address = '".$address."'  WHERE no='".$user_id."'";
        $data= $this->Dbconnect->exec($sql);
        return $data;
    }
    public function userupdateStatusTrash($user_id){
        $number = '1';
        $sql="update  users set status ='".$number."' WHERE no='".$user_id."'";
        $data= $this->Dbconnect->exec($sql);
        return $data;
    }
    public function userupdateStatusTrashReover($user_id){
        $number = '0';
        $sql="update  users set status ='".$number."' WHERE no='".$user_id."'";
        $data= $this->Dbconnect->exec($sql);
        return $data;
    }
    public function insertPaymentInfo($token,$name,$email_id,$amount,$subcription){
        $dataArray=array($token,$name,$email_id,$amount,$subcription);
        $sql="insert into subscription(payment_token,name,email,amount,subscription,date)VALUES (?, ?, ?, ?, ?,now())";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);

        $sql_update="update  users set checkActive ='yes' WHERE email='".$email_id."'";
        $data= $this->Dbconnect->exec($sql_update);
        return $status;
    }
    public function checkTeacherEmailInListInsert($name,$email,$gender,$study,$medium,$address,$address2){
        $dataArray=array($name,$email,$gender,$study,$medium,$address,$address2);
        $sql="insert into teacher(name,email,gender,study,medium,address,address2)VALUES (?, ?, ?, ?, ?,?,?)";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);

        $sql_update="update  users set address ='".$address."' WHERE email='".$email."'";
        $data= $this->Dbconnect->exec($sql_update);
        return $status;
    }
    public function checkTeacherEmailInListInsertAccountVerificationInfo($email,$destinationFile,$destinationFile2){
        $dataArray=array($email,$destinationFile,$destinationFile2);
        $sql="insert into teacher(email,nid,std_card)VALUES (?, ?, ?)";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;
    }
    public function checkTeacherEmailInListUpdateAccountVerificationInfo($email,$destinationFile,$destinationFile2){
        $array=array($destinationFile,$destinationFile2);
        $sqls = "update teacher set nid = ?, std_card = ? WHERE  email='" . $email . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
    public function checkTeacherEmailInListInsertEducational($email,$ssc_institute,$ssc_yearpassing,$ssc_group,$ssc_gpa,$hsc_institute,$hsc_yearpassing
        ,$hsc_group,$hsc_gpa,$honours_institute,$honours_yearadmission,$dept,$honours_cgpa){
        $dataArray=array($email,$ssc_institute,$ssc_yearpassing,$ssc_group,$ssc_gpa,$hsc_institute,$hsc_yearpassing
        ,$hsc_group,$hsc_gpa,$honours_institute,$honours_yearadmission,$dept,$honours_cgpa);
        $sql="insert into teacher(email,ssc_institute,ssc_yearpassing,ssc_group,ssc_gpa,hsc_institute,hsc_yearpassing
            ,hsc_group,hsc_gpa,honours_institute,honours_yearadmission,dept,honours_cgpa)VALUES (?, ?, ?, ?, ?,?,?,?,?,?,?,?,?)";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;
    }
    public function checkTeacherEmailInListInsertTuition($tuition_area,$email,$tuition_medium,$tuition_subject,
                                                         $tuition_class,$tuition_week,$tuition_shift,$tuition_salary,$tuition_style){

        $dataArray=array($tuition_area,$email,$tuition_medium,$tuition_subject,
            $tuition_class,$tuition_week,$tuition_shift,$tuition_salary,$tuition_style);
        $sql="insert into teacher(tuition_area,email,tuition_medium,tuition_subject,
                                                         tuition_class,tuition_week,tuition_shift,tuition_salary,tuition_style)VALUES (?, ?, ?, ?, ?,?,?,?,?)";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;

    }
    public function checkTeacherEmailInListUpdateTuition($tuition_area,$email,$tuition_medium,$tuition_subject,
                                                         $tuition_class,$tuition_week,$tuition_shift,$tuition_salary,$tuition_style){
        $array = array($tuition_area,$tuition_medium,$tuition_subject,
            $tuition_class,$tuition_week,$tuition_shift,$tuition_salary,$tuition_style);
        $sqls = "update teacher set tuition_area=?,tuition_medium=?,tuition_subject=?,
            tuition_class=?,tuition_week=?,tuition_shift=?,tuition_salary=?,tuition_style=? WHERE  email='" . $email . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
    public function checkTeacherEmailInListUpdate($name,$email,$gender,$study,$medium,$address,$address2)
    {
        $array = array($name,$gender,$study,$medium,$address,$address2);
        $sqls = "update teacher set name = ?,gender=?,study=?,medium=?,address=?,address2=? WHERE  email='" . $email . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);

        $sql_update="update  users set name = '".$name."', address ='".$address."' WHERE email='".$email."'";
        $data= $this->Dbconnect->exec($sql_update);

        return $status;
    }
    public function checkTeacherEmailInListUpdateEducational($email,$ssc_institute,$ssc_yearpassing,$ssc_group,$ssc_gpa,$hsc_institute,$hsc_yearpassing,$hsc_group,$hsc_gpa,$honours_institute,$honours_yearadmission,$dept,$honours_cgpa)
    {
        $array = array($ssc_institute,$ssc_yearpassing,$ssc_group,$ssc_gpa,$hsc_institute,$hsc_yearpassing,$hsc_group,$hsc_gpa,$honours_institute,$honours_yearadmission,$dept,$honours_cgpa);
        $sqls = "update teacher set ssc_institute=?,ssc_yearpassing=?,ssc_group=?,ssc_gpa=?,hsc_institute=?,hsc_yearpassing=?
        ,hsc_group=?,hsc_gpa=?,honours_institute=?,honours_yearadmission=?,dept=?,honours_cgpa=? WHERE  email='" . $email . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
    public function insertComment($user_id,$name,$post,$commentNo){
        $dataArray=array($user_id,$name,$post,$commentNo);
        $sql="insert into post(user_id,name,post,date,time,commentNo)VALUES (?,?,?,now(),now(),?)";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;
    }
    public function textareaPostSave($user_id,$name,$post){
        $dataArray=array($user_id,$name,$post);
        $sql="insert into post(user_id,name,post,date,time)VALUES (?,?,?,now(),now())";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;
    }
    public function updateNotice($noticeInfo,$id)
    {
        $array = array($noticeInfo);
        $sqls = "update institute_offer set offer_details=? WHERE  institute_offer_no='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
    public function viewNoticeByid($id){
        $sql = "SELECT * FROM institute_offer where institute_offer_no = '".$id."' ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function getPostDataToShow(){
        $sql = "SELECT * FROM post ORDER BY post_no DESC ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function detailsOfTeacher($Meemail){
        $sql = "SELECT * FROM teacher where email = '".$Meemail."' ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function deleteNotice($id)
    {
        $sql = "delete from institute_offer WHERE institute_offer_no = '".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }
    public function addNotice($fname,$notice,$notice_title){
        $dataArray=array($fname,$notice,$notice_title);
        $sql="insert into institute_offer(email,offer_details,title,date)VALUES (?,?,?,now())";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;
    }
    public function viewNoticeInfo()
    {
        $sql = "select * from institute_offer ORDER BY institute_offer_no DESC ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function updatePaymentInfo($token,$email_id,$amounts,$subcription){
        $sql="update  subscription  set payment_token = '".$token."', amount = '".$amounts."',subscription = '".$subcription."'
         , date = now() WHERE email='".$email_id."'";
        $status= $this->Dbconnect->exec($sql);


        $sql_update="update  users set checkActive ='yes' WHERE email='".$email_id."'";
        $datas= $this->Dbconnect->exec($sql_update);
        return $status;
    }
    public function updateCheckActiveTimeOver($email_id){
        $sql_update="update  users set checkActive ='no' WHERE email='".$email_id."'";
        $status= $this->Dbconnect->exec($sql_update);
        return $status;
    }
    public function viewPostByUserId($user_id)
    {
        $sql = "select * from post WHERE user_id = '".$user_id."' && commentNo is null  ORDER BY post_no DESC ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function viewPostComment($postNo){
        $sql = "SELECT * FROM post where commentNo = '".$postNo."' ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function managePostDelete($postNo){
        $sql=" delete from post WHERE commentNo ='".$postNo."' || post_no='".$postNo."'";
        $data= $this->Dbconnect->exec($sql);
        return $data;
    }
    public function postDataCollectviaUserIds($id){
        $sql = "SELECT * FROM post WHERE post_no ='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();

        return $satatus;
    }
    public function postUpdateDataCollectviaUserId($user_id,$post){
        $dataArray=array($post);
        $sql="update  post set post=? WHERE post_no ='".$user_id."'";
        $data= $this->Dbconnect->prepare($sql);
        $status=$data->execute($dataArray);
        return $status;
    }
    public function viewStudentsInfo(){
        $sql = "SELECT * FROM users where checkActive = 'yes' && position = 'Guardian' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function viewStudentTeacherTotalInfo($teachers_id,$students_id){
        $sql = "SELECT * FROM chat where teachers_id = '".$teachers_id."' &&  students_id = '".$students_id."' ORDER BY message_no DESC";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        $updates = "update chat set messageRead = 'seen' where teachers_id = '".$teachers_id."' &&  students_id = '".$students_id."'";
        $this->Dbconnect->exec($updates);

        return $satatus;
    }
    public function insertMessageForChat($teachers_id,$students_id,$teachers_name,$students_name,$chat_message){
        $dataArray=array($teachers_id,$students_id,$teachers_name,$students_name,$chat_message);
        $sql="insert into chat(teachers_id,students_id,teachers_name,students_name,message_from,date,time)VALUES (?,?,?,?,?,now(),now())";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        $update = "update chat set messageRead = 'seen' where teachers_id = '".$teachers_id."' &&  students_id = '".$students_id."'";
        $this->Dbconnect->exec($update);
        return $status;
    }
    public function showAlertonMessageforTeachers($id){
        $message = "unseen";
        $sql = "select students_id, messageRead from chat where teachers_id = '".$id."' && messageRead='".$message."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();

        return $status;
    }
}