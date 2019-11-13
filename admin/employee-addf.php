<?php
session_start();
include("../include/config.php");
include("../include/functions.php");

// Image crop
include("thumb_functions.php");
define('IMAGE_SMALL_DIR', '../upload_images/employee/thumb/');
define('IMAGE_SMALL_SIZE', 200);

//end Image Crop

 validate_admin();

  
  if($_REQUEST['submitForm']=='yes'){
    $emp_name=$obj->escapestring($_POST['emp_name']);
    $emp_surname=$obj->escapestring($_POST['emp_surname']);
    $emp_email=$obj->escapestring($_POST['emp_email']);
    $emp_mobile1=$obj->escapestring($_POST['emp_mobile1']);
    $emp_mobile2=$obj->escapestring($_POST['emp_mobile2']);
    $emp_laddress=$obj->escapestring($_POST['emp_laddress']);
    $emp_laddressverification=$obj->escapestring($_POST['emp_laddressverification']);
    $emp_paddress=$obj->escapestring($_POST['emp_paddress']);
    $emp_paddressverification=$obj->escapestring($_POST['emp_paddressverification']);
    $emp_emergencycontact1=$obj->escapestring($_POST['emp_emergencycontact1']);
    $emp_relation1=$obj->escapestring($_POST['emp_relation1']);
    $emp_emergencycontact2=$obj->escapestring($_POST['emp_emergencycontact2']);
    $emp_relation2=$obj->escapestring($_POST['emp_relation2']);
    //$aadharcard=$obj->escapestring($_POST['aadharcard']);
    $aadharcard_no1=$obj->escapestring($_POST['aadharcard_no1']);
    $aadharcard_no2=$obj->escapestring($_POST['aadharcard_no2']);
    $aadharcard_no3=$obj->escapestring($_POST['aadharcard_no3']);
    $aadharcard_no=$aadharcard_no1.$aadharcard_no2.$aadharcard_no3;
    //$drivinglicense=$obj->escapestring($_POST['drivinglicense']);
    $drivinglicense_no=$obj->escapestring($_POST['drivinglicense_no']);
    $bank_name=$obj->escapestring($_POST['bank_name']);
    $account_no=$obj->escapestring($_POST['account_no']);
    $ifsc=$obj->escapestring($_POST['ifsc']);
    $premark=$obj->escapestring($_POST['premark']);
    $emp_id=$obj->escapestring($_POST['emp_id']);
    $emp_offical_email=$obj->escapestring($_POST['emp_offical_email']);
    $exp=$obj->escapestring($_POST['exp']);
    $weeklyoff=$obj->escapestring($_POST['weeklyoff']);
    $overtime=$obj->escapestring($_POST['overtime']);
    $officeremarks=$obj->escapestring($_POST['officeremarks']);
    $designation = implode(',',$_POST['designation']);
    $department=$_POST['department'];
    $username=$obj->escapestring($_POST['username']);
    $password=$obj->escapestring($_POST['password']);
    $bloodgroup=$obj->escapestring($_POST['bloodgroup']);
    $salary=$obj->escapestring($_POST['salary']);
    
    $user_type='emp';

   


 //Employee Image Start  
if($_FILES['image_upload_file']['size']>0 && $_FILES['image_upload_file']['error']=='')
  {
        //echo $_FILES['image_upload_file']['name']; die;
        $output['status']=FALSE;
        set_time_limit(0);
        $allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
        if ($_FILES['image_upload_file']["error"] > 0) {
          $output['error']= "Error in File";
        }
        elseif (!in_array($_FILES['image_upload_file']["type"], $allowedImageType)) {
          $output['error']= "You can only upload JPG, PNG and GIF file";
        }
        elseif (round($_FILES['image_upload_file']["size"] / 1024) > 4096) {
          $output['error']= "You can upload file size up to 4 MB";
        } else {
          //create directory with 777 permission if not exist - start
          createDir(IMAGE_SMALL_DIR);
          //create directory with 777 permission if not exist - end
          $path[0] = $_FILES['image_upload_file']['tmp_name'];
          $file = pathinfo($_FILES['image_upload_file']['name']);
          $fileType = $file["extension"];
          $desiredExt='jpg';
          $fileNameNew = rand(333, 999) . time() . ".$desiredExt";
          $path[1] = IMAGE_SMALL_DIR . $fileNameNew;

          if (createThumb($path[0], $path[1],"$desiredExt", IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE,IMAGE_SMALL_SIZE)) {
              $output['status']=TRUE;
              $output['image_small']= $path[1];
          }
          move_uploaded_file($_FILES['image_upload_file']['tmp_name'],"../upload_images/employee/".$fileNameNew);
        }   
  }
  //Employee Image End

  //Aadhar Image Start  
if($_FILES['aadharcard']['size']>0 && $_FILES['aadharcard']['error']=='')
  {
        //echo $_FILES['aadharcard']['name']; die;
        $output['status']=FALSE;
        set_time_limit(0);
        $allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
        if ($_FILES['aadharcard']["error"] > 0) {
          $output['error']= "Error in File";
        }
        elseif (!in_array($_FILES['aadharcard']["type"], $allowedImageType)) {
          $output['error']= "You can only upload JPG, PNG and GIF file";
        }
        elseif (round($_FILES['aadharcard']["size"] / 1024) > 4096) {
          $output['error']= "You can upload file size up to 4 MB";
        } else {
          //create directory with 777 permission if not exist - start
          createDir(IMAGE_SMALL_DIR);
          //create directory with 777 permission if not exist - end
          $path[0] = $_FILES['aadharcard']['tmp_name'];
          $file = pathinfo($_FILES['aadharcard']['name']);
          $fileType = $file["extension"];
          $desiredExt='jpg';
          $AdharfileNameNew = rand(333, 999) . time() . ".$desiredExt";
          $path[1] = IMAGE_SMALL_DIR . $AdharfileNameNew;

          if (createThumb($path[0], $path[1],"$desiredExt", IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE,IMAGE_SMALL_SIZE)) {
              $output['status']=TRUE;
              $output['image_small']= $path[1];
          }
          move_uploaded_file($_FILES['aadharcard']['tmp_name'],"../upload_images/employee/".$AdharfileNameNew);
        }   
  }
  //Adhar Card Image End

//Licence Image Start  
if($_FILES['drivinglicense']['size']>0 && $_FILES['drivinglicense']['error']=='')
  {
        //echo $_FILES['drivinglicense']['name']; die;
        $output['status']=FALSE;
        set_time_limit(0);
        $allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
        if ($_FILES['drivinglicense']["error"] > 0) {
          $output['error']= "Error in File";
        }
        elseif (!in_array($_FILES['drivinglicense']["type"], $allowedImageType)) {
          $output['error']= "You can only upload JPG, PNG and GIF file";
        }
        elseif (round($_FILES['drivinglicense']["size"] / 1024) > 4096) {
          $output['error']= "You can upload file size up to 4 MB";
        } else {
          //create directory with 777 permission if not exist - start
          createDir(IMAGE_SMALL_DIR);
          //create directory with 777 permission if not exist - end
          $path[0] = $_FILES['drivinglicense']['tmp_name'];
          $file = pathinfo($_FILES['drivinglicense']['name']);
          $fileType = $file["extension"];
          $desiredExt='jpg';
          $LicencefileNameNew = rand(333, 999) . time() . ".$desiredExt";
          $path[1] = IMAGE_SMALL_DIR . $LicencefileNameNew;

          if (createThumb($path[0], $path[1],"$desiredExt", IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE,IMAGE_SMALL_SIZE)) {
              $output['status']=TRUE;
              $output['image_small']= $path[1];
          }
          move_uploaded_file($_FILES['drivinglicense']['tmp_name'],"../upload_images/employee/".$LicencefileNameNew);
        }   
  }
  //Licence Image End


    $ESql ="";
    if($emp_name!=''){
      $ESql .="emp_name='$emp_name'";
    }
    if($emp_id!=''){
      $ESql .=", emp_id='$emp_id'";
    }
    if($emp_surname!=''){
      $ESql .=", emp_surname='$emp_surname'";
    }
    if($emp_email!=''){
      $ESql .=", emp_email='$emp_email'";
    }
    if($emp_mobile1!=''){
      $ESql .=", emp_mobile1='$emp_mobile1'";
    }
    if($emp_mobile2!=''){
      $ESql .=", emp_mobile2='$emp_mobile2'";
    }
    if($emp_laddress!=''){
      $ESql .=", emp_laddress='$emp_laddress'";
    }
    if($emp_laddressverification!=''){
      $ESql .=", emp_laddressverification='$emp_laddressverification'";
    }
    if($emp_paddress!=''){
      $ESql .=", emp_paddress='$emp_paddress'";
    }
    if($emp_paddressverification!=''){
      $ESql .=", emp_paddressverification='$emp_paddressverification'";
    }
    if($emp_emergencycontact1!=''){
      $ESql .=", emp_emergencycontact1='$emp_emergencycontact1'";
    }
    if($emp_relation1!=''){
      $ESql .=", emp_relation1='$emp_relation1'";
    }
    if($emp_emergencycontact2!=''){
      $ESql .=", emp_emergencycontact2='$emp_emergencycontact2'";
    }
    if($emp_relation2!=''){
      $ESql .=", emp_relation2='$emp_relation2'";
    }
    if($AdharfileNameNew!=''){
      $ESql .=", aadharcard='$AdharfileNameNew'";
    }
    if($aadharcard_no!=''){
      $ESql .=", aadharcard_no='$aadharcard_no'";
    }
    if($LicencefileNameNew!=''){
      $ESql .=", drivinglicense='$LicencefileNameNew'";
    }
    if($drivinglicense_no!=''){
      $ESql .=", drivinglicense_no='$drivinglicense_no'";
    }
    if($bank_name!=''){
      $ESql .=", bank_name='$bank_name'";
    }
    if($account_no!=''){
      $ESql .=", account_no='$account_no'";
    }
    if($ifsc!=''){
      $ESql .=", ifsc='$ifsc'";
    }
    if($emp_offical_email!=''){
      $ESql .=", emp_offical_email='$emp_offical_email'";
    }
    if($exp!=''){
      $ESql .=", exp='$exp'";
    }
    if($weeklyoff!=''){
      $ESql .=", weeklyoff='$weeklyoff'";
    }
    if($overtime!=''){
      $ESql .=", overtime='$overtime'";
    }
    if($officeremarks!=''){
      $ESql .=", officeremarks='$officeremarks'";
    }
    if($user_type!=''){
      $ESql .=", user_type='$user_type'";
    }
    if($department!=''){
      $ESql .=", department='$department'";
    }
    if($designation!=''){
      $ESql .=", designation='$designation'";
    }
    if($username!=''){
      $ESql .=", username='$username'";
    }
    if($password!=''){
      $ESql .=", password='$password'";
    }
    if($bloodgroup!=''){
      $ESql .=", bloodgroup='$bloodgroup'";
    }
    if($fileNameNew!=''){
      $ESql .=", img='$fileNameNew'";
    }
    if($salary!=''){
      $ESql .=", salary='$salary'";
    }
    
  if($_REQUEST['id']==''){
    $userArr=$obj->query("select * from   $tbl_admin where  username='$username'  ");
    if($obj->numRows($userArr)<1){
     $obj->query("insert into $tbl_admin set $ESql, register_date=now()",$debug=-1); //die;

     $LastId = $obj->lastInsertedId();

    $referalcode = genrateReferralCode($LastId,2);
    $obj->query("insert into $tbl_referral_code set u_id='$LastId',referral_code='$referalcode',u_type=2");

     $_SESSION['sess_msg']='Employee added sucessfully'; 
     header("location:employee-list.php");
       exit();
    }else{
     $_SESSION['sess_msg']='This Employee already regisred,Plese choose another Login Username';    
    }
    
       }else{
      $sql = "update $tbl_admin set $ESql ";
      if($fileNameNew){
        $ESql = $obj->query("select img,aadharcard,drivinglicense from $tbl_admin where id='".$_REQUEST['id']."'");
        $EResult = $obj->fetchNextObject($ESql);
        @unlink("../upload_images/employee/".$EResult->img);
        @unlink("../upload_images/employee/thumb/".$EResult->img);
      }

      if($AdharfileNameNew){
        $ESql = $obj->query("selectaadharcard from $tbl_admin where id='".$_REQUEST['id']."'");
        $EResult = $obj->fetchNextObject($ESql);
        @unlink("../upload_images/employee/".$EResult->aadharcard);
        @unlink("../upload_images/employee/thumb/".$EResult->aadharcard);
      }

      if($LicencefileNameNew){
        $ESql = $obj->query("select drivinglicense from $tbl_admin where id='".$_REQUEST['id']."'");
        $EResult = $obj->fetchNextObject($ESql);
        @unlink("../upload_images/employee/".$EResult->drivinglicense);
        @unlink("../upload_images/employee/thumb/".$EResult->drivinglicense);
      }
              
     $sql .=" where id='".$_REQUEST['id']."'";
    // echo $sql; die;
     $obj->query($sql);
     $_SESSION['sess_msg']='Employee updated sucessfully';  
     
  }
      header("location:employee-list.php");
      exit(); 
  }        
if($_REQUEST['id']!=''){
$sql=$obj->query("select * from $tbl_admin where id=".$_REQUEST['id']);
$result=$obj->fetchNextObject($sql);

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
      <h1><?php if($_REQUEST['id']!=''){?>Update <?php }else{?> Add <?php }?> Employee</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="employee-list.php">View Employees</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-default">
      <form name="frm" id="employeefrm" method="POST" enctype="multipart/form-data" action="">
      <input type="hidden" name="submitForm" value="yes" />
      <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
        <div class="box-body">
       	  <h4>Personal Details</h4> 
	      <div class="row">
	      	<div class="col-md-3">
              <div class="form-group">
                <label>Employee Name</label>
                <input name="emp_name" type="text" id="emp_name" class="required form-control" value="<?php echo stripslashes($result->emp_name);?>" />
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Surname</label>
                <input name="emp_surname" type="text" id="emp_surname" class="required form-control" value="<?php echo stripslashes($result->emp_surname);?>" />
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Mobile 1</label>
                <input name="emp_mobile1" type="text" id="emp_mobile1" maxlength="10" class="required form-control" value="<?php echo stripslashes($result->emp_mobile1);?>" />
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Mobile 2</label>
                <input name="emp_mobile2" type="text" id="emp_mobile2" maxlength="10" class="form-control" value="<?php echo stripslashes($result->emp_mobile2);?>" />
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <label>Local Address</label>
                <textarea name="emp_laddress" id="emp_laddress" class="form-control" rows="2"><?php echo stripcslashes($result->emp_laddress); ?></textarea>
              </div>
            </div>
            <?php if($_SESSION['user_type']=='superadmin'){?>
            <div class="col-md-2">
              <div class="form-group">
                <label>Verification</label>
                <select name="emp_laddressverification" id="emp_laddressverification" class="form-control">
                  <option value="No" <?php if($result->emp_laddressverification=='No'){?> selected <?php } ?>>No</option>
                  <option value="Yes" <?php if($result->emp_laddressverification=='Yes'){?> selected <?php } ?>>Yes</option>
                </select>
              </div>
            </div>
            <?php }?>
            <div class="col-md-10">
              <div class="form-group">
                <label>Permanent Address</label>
                <textarea name="emp_paddress" id="emp_paddress" class="form-control" rows="2"><?php echo stripcslashes($result->emp_paddress); ?></textarea>
              </div>
            </div>
            <?php if($_SESSION['user_type']=='superadmin'){?>
            <div class="col-md-2">
              <div class="form-group text-center">
                <label>Verification</label>
                <select name="emp_paddressverification" id="emp_paddressverification" class="form-control">
                  <option value="No" <?php if($result->emp_paddressverification=='No'){?> selected <?php } ?>>No</option>
                  <option value="Yes" <?php if($result->emp_paddressverification=='Yes'){?> selected <?php } ?>>Yes</option>
                </select>
              </div>
            </div>
            <?php }?>
            </div>
            <div class="row">
             <div class="col-md-4">
              <div class="form-group">
                <label>Personal Email ID</label>
                <input name="emp_email" type="text" id="emp_email" class="required form-control" value="<?php echo stripslashes($result->emp_email);?>" />
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Emergency Contact 1</label>
                <input name="emp_emergencycontact1" type="text" maxlength="10" id="emp_emergencycontact1" class="form-control" value="<?php echo stripslashes($result->emp_emergencycontact1);?>" />
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label>Relation</label>
                <select name="emp_relation1" id="emp_relation1" class="form-control">
                  <option value="">Select</option>
                  <option value="Brother" <?php if($result->emp_relation1=='Brother'){?> selected <?php } ?>>Brother</option>
                  <option value="Wife" <?php if($result->emp_relation1=='Wife'){?> selected <?php } ?>>Wife</option>
                  <option value="Father" <?php if($result->emp_relation1=='Father'){?> selected <?php } ?>>Father</option>
                  <option value="Mother" <?php if($result->emp_relation1=='Mother'){?> selected <?php } ?>>Mother</option>
                  <option value="Sister" <?php if($result->emp_relation1=='Sister'){?> selected <?php } ?>>Sister</option>
                  <option value="Husband" <?php if($result->emp_relation1=='Husband'){?> selected <?php } ?>>Husband</option>
                  <option value="Child" <?php if($result->emp_relation1=='Child'){?> selected <?php } ?>>Child</option>
                  <option value="Other" <?php if($result->emp_relation1=='Other'){?> selected <?php } ?>>Other</option>
                </select>
              </div>
            </div>
             <div class="col-md-2">
              <div class="form-group">
                <label>Emergency Contact 2</label>
                <input name="emp_emergencycontact2" type="text" maxlength="10" id="emp_emergencycontact2" class="form-control" value="<?php echo stripslashes($result->emp_emergencycontact2);?>" />
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Relation</label>
                <select name="emp_relation2" id="emp_relation2" class="form-control">
                  <option value="">Select</option>
                  <option value="Brother" <?php if($result->emp_relation2=='Brother'){?> selected <?php } ?>>Brother</option>
                  <option value="Wife" <?php if($result->emp_relation2=='Wife'){?> selected <?php } ?>>Wife</option>
                  <option value="Father" <?php if($result->emp_relation2=='Father'){?> selected <?php } ?>>Father</option>
                  <option value="Mother" <?php if($result->emp_relation2=='Mother'){?> selected <?php } ?>>Mother</option>
                  <option value="Sister" <?php if($result->emp_relation2=='Sister'){?> selected <?php } ?>>Sister</option>
                  <option value="Husband" <?php if($result->emp_relation2=='Husband'){?> selected <?php } ?>>Husband</option>
                  <option value="Child" <?php if($result->emp_relation2=='Child'){?> selected <?php } ?>>Child</option>
                   <option value="Other" <?php if($result->emp_relation2=='Other'){?> selected <?php } ?>>Other</option>
                </select>
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Aadhar Card</label>
                <input name="aadharcard" type="file" id="aadharcard" class="form-control"/><br/>
                <?php if(is_file("../upload_images/employee/thumb/".$result->aadharcard)){ ?>
               <img src="../upload_images/employee/thumb/<?php echo $result->aadharcard; ?>"  /><?php } ?>
              </div>
            </div>
           <div class="col-md-4">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Aadhar</label>
                  <input name="aadharcard_no1" type="text" id="aadharcard_no1" maxlength="4" class="form-control" value="<?php echo substr($result->aadharcard_no,0,4);?>" />
                </div>
              </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label>Card</label>
                  <input name="aadharcard_no2" type="text" id="aadharcard_no2" maxlength="4" class="form-control" value="<?php echo substr($result->aadharcard_no,4,4);?>" />
                </div>
              </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label>Number</label>
                  <input name="aadharcard_no3" type="text" id="aadharcard_no3" maxlength="4" class="form-control" value="<?php echo substr($result->aadharcard_no,8,4);?>" />
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Driving License</label>
                <input name="drivinglicense" type="file" id="drivinglicense" class="form-control"/><br/>
                <?php if(is_file("../upload_images/employee/thumb/".$result->drivinglicense)){ ?>
               <img src="../upload_images/employee/thumb/<?php echo $result->drivinglicense; ?>"  /><?php } ?>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Driving License Number</label>
                <input name="drivinglicense_no" type="text" id="drivinglicense_no" class="form-control" value="<?php echo stripslashes($result->drivinglicense_no);?>" />
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Blood Group</label>
                <select name="bloodgroup" id="bloodgroup" class="form-control">
                  <option value="">Select Blood Group</option>
                  <option value="O-NEG" <?php if($result->bloodgroup=='O-NEG'){?> selected <?php } ?>>O-</option>
                  <option value="O-PLUS" <?php if($result->bloodgroup=='O-PLUS'){?> selected <?php } ?>>O+</option>
                  <option value="A-NEG" <?php if($result->bloodgroup=='A-NEG'){?> selected <?php } ?>>A-</option>
                  <option value="A-PLUS" <?php if($result->bloodgroup=='A-PLUS'){?> selected <?php } ?>>A+</option>
                  <option value="B-NEG" <?php if($result->bloodgroup=='B-NEG'){?> selected <?php } ?>>B-</option>
                  <option value="B-PLUS" <?php if($result->bloodgroup=='B-PLUS'){?> selected <?php } ?>>B+</option>
                  <option value="AB-NEG" <?php if($result->bloodgroup=='AB-NEG'){?> selected <?php } ?>>AB-</option>
                  <option value="AB-PLUS" <?php if($result->bloodgroup=='AB-PLUS'){?> selected <?php } ?>>AB+</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Bank Name</label>
                <input name="bank_name" type="text" id="bank_name" class="form-control" value="<?php echo stripslashes($result->bank_name);?>" />
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Account Number</label>
                <input name="account_no" type="text" id="account_no" class="form-control" value="<?php echo stripslashes($result->account_no);?>" />
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>IFSC Code</label>
                <input name="ifsc" type="text" id="ifsc" class="form-control" value="<?php echo stripslashes($result->ifsc);?>" />
              </div>
            </div>
             </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Remarks</label>
                <textarea name="premark" class="form-control" rows="2"><?php echo stripcslashes($result->premark); ?></textarea>
              </div>
            </div>
            </div>
          
    <div class="clr">
      <h4>Official Details</h4> 
        <div class="row">
          <div class="col-md-2">
              <div class="form-group">
                <label>Employee ID</label>
                <input name="emp_id" type="text" id="emp_id" class="form-control" value="<?php echo stripslashes($result->emp_id);?>" />
              </div>
            </div>
          <div class="col-md-2">
              <div class="form-group">
                <label>Email Id</label>
                <input name="emp_offical_email" type="text" id="emp_offical_email" class="form-control" value="<?php echo stripslashes($result->emp_offical_email);?>" />
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Work Experience (Month)</label>
                <select name="exp" id="exp" class="form-control">
                  <option value="">Month</option>
                   <?php
                  for($i=1; $i<=100; $i++){?>
                    <option value="<?php echo $i; ?>" <?php if($result->exp==$i){?> selected <?php }?>><?php echo $i; ?></option>
                  <?php }
                  ?>
                </select></div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
               <label>Weekly Off</label>
               <select name="weeklyoff" id="weeklyoff" class="form-control">
                 <option value="">Select</option>
                 <option value="Monday" <?php if($result->weeklyoff=='Monday'){?> selected <?php }?>>Monday</option>
                 <option value="Tuesday" <?php if($result->weeklyoff=='Tuesday'){?> selected <?php }?>>Tuesday</option>
                 <option value="Wednesday" <?php if($result->weeklyoff=='Wednesday'){?> selected <?php }?>>Wednesday</option>
                 <option value="Thursday" <?php if($result->weeklyoff=='Thursday'){?> selected <?php }?>>Thursday</option>
                 <option value="Friday" <?php if($result->weeklyoff=='Friday'){?> selected <?php }?>>Friday</option>
                 <option value="Saturday" <?php if($result->weeklyoff=='Saturday'){?> selected <?php }?>>Saturday</option>
                  <option value="Sunday" <?php if($result->weeklyoff=='Sunday'){?> selected <?php }?>>Sunday</option>
               </select>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
               <label>Over Time in Month</label>
               <input type="text" name="overtime" id="overtime" class="form-control" placeholder="Hours" value="<?php echo stripcslashes($result->overtime); ?>">
              </div>
            </div>
            
            
            <div class="col-md-2">
              <div class="form-group">
               <label>Basic Salary</label>
               <input type="text" name="salary" id="salary" class="form-control" placeholder="Salary" value="<?php echo stripcslashes($result->salary); ?>">
              </div>
            </div>
            
          </div>
            
            <div class="row">
             <div class="col-md-12">
              <div class="form-group">
               <label>Remarks</label>
              <textarea name="officeremarks" id="officeremarks" class="form-control" rows="2"><?php echo stripcslashes($result->officeremarks); ?></textarea>
              </div>
            </div>

            </div>

            <div class="row">
            <?php
           // if($_REQUEST['id']==''){?>
            <div class="col-md-2">
             <div class="form-group">
                <label>User Name</label>
                <input type="text" name="username" class="required form-control" value="<?php echo stripcslashes($result->username) ?>">
              </div>
             </div>
             <div class="col-md-2">
             <div class="form-group">
                <label>Password</label>
               <input type="text" name="password" class="required form-control" value="<?php echo stripcslashes($result->password) ?>">
              </div>
             </div>
         <?php //}?>
           <div class="col-md-2">
             <div class="form-group">
                <label>Department</label>
                <select name="department" id="department" class="required form-control select2">
                  <option value="">Select Type</option>
                  <?php
                  $RoleSql = $obj->query("select * from $tbl_rolecategory where status=1");
                  while($RoleResult = $obj->fetchNextObject($RoleSql)){?>
                  <option value="<?php echo $RoleResult->id; ?>" <?php if($result->department==$RoleResult->id){?> selected <?php } ?>><?php echo $RoleResult->role; ?></option>
                  <?php } ?>
                 
                </select>
              </div>
             </div>
             <div class="col-md-3">
             <div class="form-group">
                <label>Designation</label>
                <?php
                $designationArr = explode(',',$result->designation);
                ?>
                <select name="designation[]" id="designation" class="required form-control select2" multiple="">
                  <option value="">Select Type</option>
                  <?php
                  $RoleArr=$obj->query("select * from $tbl_rolesubcategory where status=1 and role_id='".$result->department."'",$debug=-1); 
                  while($RoleResult=$obj->fetchNextObject($RoleArr)){
                  ?>
                  <option value="<?php echo $RoleResult->id; ?>"<?php if(in_array($RoleResult->id,$designationArr)){?>selected<?php } ?>><?php echo stripslashes($RoleResult->role); ?></option>
                  <?php } ?>
                </select>
              </div>
             </div>
             <div class="col-md-3">
             <div class="form-group">
                <label>Photo</label>
            <input type="file" name="image_upload_file" class='form-control' /><br/>
            <?php if(is_file("../upload_images/employee/thumb/".$result->img)){ ?>
            <img src="../upload_images/employee/thumb/<?php echo $result->img; ?>"  /><?php } ?>
              </div>
             </div>
               
            
       </div>
     
           
            </div>
          </div>
                  <div class="box-footer">
    <input type="submit" name="submit" value="Submit"  class="button" border="0"/>&nbsp;&nbsp;
    <input name="Reset" type="reset" id="Reset" value="Reset" class="button" border="0" />
    </div>
          </div>
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
<script src="js/select2.full.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
 $(".select2").select2();
  $(document).ready(function(){
  	$("#employeefrm").validate();
   
    $("#department").change(function(){
      userid = $(this).val();
      $.ajax({
      url:"ajax_get_role.php",
      type:"POST",
      data:{userid,userid},
      success:function(data)
      {
        $("#designation").html(data);
      }
      })


    })
  })
</script>
</body>
</html>
