<?php 
session_start(); 
include( "../include/config.php"); 
include( "../include/functions.php"); 
include( "../include/simpleimage.php"); 
validate_admin(); 



if($_REQUEST['submitForm']=='yes'){
    $user_id=$_REQUEST[ 'user_id']; 
    $address=$obj->escapestring($_REQUEST['address']);

    if($_REQUEST['id']==''){ 
$obj->query("insert into $tbl_useraddress set user_id='$user_id',address='$address',status=1 ",$debug=-1); //die;
$_SESSION['sess_msg']='Address added successfully'; 
}else{ 
    $sql=" update $tbl_useraddress set user_id='$user_id',address='$address' where id='".$_REQUEST['id']."'";
    $obj->query($sql); 
    $_SESSION['sess_msg']='Address updated successfully'; 
}
header("location:useraddress-list.php?id=$user_id"); 
exit(); 
} 

if($_REQUEST['id']!=''){ 
    $sql=$obj->query("select * from $tbl_useraddress where id=".$_REQUEST['id']); 
    $result=$obj->fetchNextObject($sql); 
} 
$user_id = $_GET['user_id'];
?>
<!DOCTYPE html>
<html>
<?php include( "head.php"); ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php include( "header.php"); ?>
        <?php include( "menu.php"); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1><?php if($_REQUEST['id']==''){?> Add <?php }else{?> Update <?php }?> Address</h1>
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a>
                    </li>
                    <li><a href="useraddress-list.php?id=<?php echo $user_id;?>">View Address List</a>
                    </li>
                </ol>
            </section>
            <section class="content">
                <div class="box box-primary">
                    <form name="customerfrm" id="customerfrm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
                        <input type="hidden" name="submitForm" value="yes" />
                        <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control" rows="5" cols="20"><?php echo $result->address; ?></textarea>
                                    </div>
                                </div>


                            </div>
                            <div class="box-footer">
                                <input type="submit" name="submit" value="Submit" class="button" border="0" />&nbsp;&nbsp;
                                <input name="Reset" type="reset" id="Reset" value="Reset" class="button" border="0" />
                            </div>
                        </form>
                    </div>
                </section>
            </div>
            <?php include( "footer.php"); ?>
            <div class="control-sidebar-bg"></div>
        </div>
        <script src="js/jquery-2.2.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/app.min.js"></script>
        <script src="js/demo.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script type="text/javascript" language="javascript">
            $(document).ready(function() {
                $("#customerfrm").validate();
            })
        </script>

    </body>

    </html>
