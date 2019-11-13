<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
include("../FCM-User.php");
$fcmuser = new FCMUSER ();

validate_admin();
  
if($_REQUEST['submitForm']=='yes'){

    if($_REQUEST['id']==''){
      $msg=$obj->escapestring($_POST['msg']);
      $type=$obj->escapestring($_POST['type']);
      $users=$obj->escapestring($_POST['users']);

      $img=time().substr($_FILES['photo']['name'],-5);
      if($img!=''){
        move_uploaded_file($_FILES['photo']['tmp_name'],"../upload_images/notification/".$img);
      }
      $imgP = SITE_URL."upload_images/notification/".$img; //die;
      if($type==1){
        //Push Notifiction code here
        $UserArr = $obj->query("select token_id from $tbl_user where status='1'");
        while($UserResult = $obj->fetchNextObject($UserArr)){
          if($UserResult->token_id!=''){
            $messages = $msg;
            $registatoin_ids = array (
            $UserResult->token_id
            );

            $message = array (
            "message" => $messages 
            );
            $fcmuser->send_notification($registatoin_ids,$messages );
          }
        }
        //Push notification code end

      }else{
        $usersArr = explode(',', $users);
        //print_r($usersArr); die;
        //Push Notifiction code here
        foreach ($usersArr as $val) {
          if($val!=''){
            $UserArr = $obj->query("select token_id from $tbl_user where mobile='$val' and status='1'",$debug=-1); //die;
            $UserResult = $obj->fetchNextObject($UserArr);

            $messages = $msg;
            $registatoin_ids = array (
            $UserResult->token_id
            );

           
              $message = array (
              "message" => $messages
              );

             if($img!=''){
              $fcmuser->send_notification($registatoin_ids,$messages,$imgP);
             }else{
              $fcmuser->send_notification($registatoin_ids,$messages);
             }
            
          }
        }
        //Push notification code end
      }

       if($type==1){
         $users = "";
       }else{
        $users = $users;
       }

       if($img!=''){
        $img= $img;
       }else{
        $img = "";
       }

      $obj->query("insert into $tbl_schedule_notification set sdate=now(),user_type='$type',users='$users',msg='$msg',img='$img',cdate=now(),status=2");
      $_SESSION['sess_msg']='Notification send sucessfully';  
    }
    header("location:send-notification-list.php");
    exit();
}      
     

?>
<!DOCTYPE html>
<html>
<?php include("head.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include("header.php"); ?>
   <?php include("menu.php"); ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Send Notification </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="send-notification-list.php">View Notification List</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
    <form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
    <input type="hidden" name="submitForm" value="yes" />
    <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
        <div class="box-body">
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label>User</label>
                <select class="form-control" name="type" id="type">
                  <option value="">Select User</option>
                  <option value="1">All</option>
                  <option value="2">Perticular</option>
                </select>
              </div>
            </div>
            </div>

            <div class="row user_id_cls" style="display: none;">
            <div class="col-md-6">
              <div class="form-group">
                <label>User</label>
               <textarea class="form-control" name="users" placeholder="9800000000,9800000000,9800000000"></textarea>
              </div>
            </div>
            </div>


            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Message</label>
                <textarea name="msg" class="required form-control" style="margin: 0px -24.5px 0px 0px; width: 545px; height: 174px;"></textarea>
              </div>
            </div>
          </div>

           <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Image</label>
                <input type="file" name="photo">
              </div>
            </div>
          </div>


       </div>
    <div class="box-footer">
    <input type="submit" name="submit" value="Submit"  class="button" border="0"/>&nbsp;&nbsp;
    <input name="Reset" type="reset" id="Reset" value="Reset" class="button" border="0" />
    </div>
    </form>
      </div>
    </section>
  </div>
  <?php include("footer.php"); ?>
  <div class="control-sidebar-bg"></div>
</div>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/app.min.js"></script>
<script src="js/demo.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
  $("#frm").validate();
  $("#type").change(function(){
    if($(this).val()==1){
      $(".user_id_cls").hide();
    }else{
      $(".user_id_cls").show();
    }
  })
})
</script>
</body>
</html>
