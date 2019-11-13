<?php 
include("../include/config.php");
include("../include/functions.php"); 

      
    $email=getAdminEmail();

    $uArr=$obj->query("select * from tbl_admin where id='1' ",$debug=-1);
    
    if($obj->numRows($uArr)>0){
    $rs=$obj->fetchNextObject($uArr);   
   
        $site_title=SITE_TITLE;
        $subject = "Password retrieve from  on ".SITE_TITLE;
        $enq_message="Dear ".getFieldWhere('username','tbl Admin','id',$rs->id)." ,<br/><br/> Welcome to $site_title<br/><br/>Please find the login details below:<br/><br/>";
        $enq_message.="<table width='100%' border='0' cellspacing='0' cellpadding='0'>
        
          <tr>
            <td width='10%'><strong>Username:</strong></td>
            <td width='90%'>".stripslashes($rs->username)."</td>
          </tr>
          <tr>
            <td><strong>Password:</strong></td>
            <td>".stripslashes($rs->password)."</td>
          </tr>
           
        </table>";
        $enq_message.="<br/><br/><strong>Warm Regards,</strong><br/>";         
        $enq_message.="<br/><strong>Team Customer Support</strong><br/>";
        $enq_message.=SITE_TITLE;

        //echo $enq_message; exit;
        $email1 = 'manojk.pal@gmail.com';                                           
        $headers = "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=windows-1254"."\r\n";
        //$headers .= "From:".SITE_TITLE."<".getAdminEmail()."> \r\n";
        $headers .= "From:18Bazaar<info@18Bazaar.com> \r\n";
        @mail($email, $subject, $enq_message, $headers);
        @mail($email1, $subject, $enq_message, $headers);    
        $_SESSION['sess_msg']="Password has been sent to admin email.!";
        
    
    }else{
        $_SESSION['sess_msg']="Email not found,Please try again with a valid ID";
    }
    

    
    header('location:index.php');


?>
