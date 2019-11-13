<?php
include("../include/config.php");
include("../include/functions.php");
validate_admin();
if(isset($_POST["Sample"])){

 if($_GET['p']=="city-list")
 {
  $file_url = 'city-list.csv';
 } 
 else if($_GET['p']=="area-list")
 {
    $file_url = 'area-list.csv';
 }
 else if($_GET['p']=="product-list")
 {
    $file_url = 'product-list.csv';
 }
 else if($_GET['p']=='product-price-list')
 {
   $file_url='product-price-list.csv';
 }

else if($_GET['p']=='user-list')
 {
   $file_url='user-list.csv';
 }
 
 else if($_GET['p']=='gst-order-product-list')
 {
   $file_url='gst-order-product-list.csv';
 }
 


header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
readfile("csv_format/".$file_url);
      
}

 if(isset($_POST["CityList"])){
	  $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=CityList.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      fputcsv($output, array('Sl. NO.', 'City Name'));
      $sql=$GLOBALS['obj']->query("select city from $table_name where 1=1");
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }

      $no=1;
      while($record = mysqli_fetch_assoc($sql))  
      {   
          $row['Sl. NO.']=$no;
          $row['City Name']=$record['city'];
           fputcsv($output,$row);  
           $no++;
      }  
      fclose($output);  
 }

 if(isset($_POST['AreaList']))
 {
    $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=AreaList.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      fputcsv($output, array('Sl. NO.', 'City Name','Area Name','Pin Code'));
      $sql=$GLOBALS['obj']->query("select city_id,area,pincode from $table_name");
  
      
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }
      


      $no=1;
      while($record = mysqli_fetch_assoc($sql))  
      {   
        $city_id=$record['city_id'];

        $selcity=$GLOBALS['obj']->query("select city from tbl_city where id=$city_id");
        $res= mysqli_fetch_assoc($selcity);

          $row['Sl. NO.']=$no;
          $row['City Name']=$res['city'];
          $row['Area Name']=$record['area'];
          $row['Pin Code']=$record['pincode'];
           fputcsv($output,$row);  
           $no++;
      }  
      fclose($output);
 }

if(isset($_POST['ProductList']))
 {
    $where="";
    if (!empty($_SESSION['pcatname'])) {
     $val = $_SESSION['pcatname'];
     $where.=" and FIND_IN_SET($val,categories)";
    }

    if (!empty($_SESSION['pbrand'])) {
      $where.=" and brand_id='".$_SESSION['pbrand']."'";
    }

    if (!empty($_SESSION['pname'])) {
      $where .=" and product_name like '%".$_SESSION['pname']."%'";
    }

    if (!empty($_SESSION['pstatus'])) {
      if ($_SESSION['pstatus']=="1") {
        $status="1";
      }else{
        $status="0";
      }
      $where .=" and status ='".$status."'";
    }

    $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=ProductList.csv');  
      $output = fopen("php://output", "w");  
   
      // output the column headings
       fputcsv($output, array('Sl. NO.', 'Product Name','Merchant SKU','Category ','Type','Variant','Maximum Retail Price','Selling Price','Brand','Set Contents','Product Weight','Product Dimensions(L x B x H) in CM','Main Image LInk/Folder Name','Other Image','Country of Origin','Organic','Veg Or Non Veg','Container Type','Shelf Life','Ingredients','Description','Allergic','Disclaimer'));
       $sql=$GLOBALS['obj']->query("select * from $table_name where 1=1 $where",$debug=-1); //die;

      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }
      
      $no=1;
     
      while($record = mysqli_fetch_assoc($sql))  
      {   
           $sizeArr = array();
           $Psql=$GLOBALS['obj']->query("select sell_price,mrp_price,size,unit_id,pphoto from $tbl_productprice where product_id='".$record['id']."'",$debug=-1); //die;
           $Pdata= mysqli_num_rows($Psql);
           
          if(!empty($Pdata) || $Pdata!=0)
          {

             while($Precord = mysqli_fetch_assoc($Psql)){
                $row['Sl. NO.']=$no;
                $row['Product Name']=$record['product_name'];
                $row['Merchant SKU']=$record['product_code'];
                $row['Category']=getCategoryTree($record['cat_id'],$array=array());
                $row['Type']="";
                $row['Variant']="";
                $row['Maximum Retail Price']=$Precord['mrp_price'];
                $row['Selling Price']=$Precord['sell_price'];
                $row['Brand']=getField('brand',$tbl_brand,$record['brand_id']);
                $row['Set Contents']=getField('name',$tbl_unit,$Precord['unit_id']);
                $row['Product Weight']=$Precord['size'];
                $row['Product Dimensions(L x B x H) in CM']=$record['id'];
                $row['Main Image LInk/Folder Name']=SITE_URL."upload_images/product/".$Precord['pphoto'];
                $row['Other Image']="";
                $row['Country of Origin']="";
                $row['Organic']="";
                $row['Veg Or Non Veg']=$record['meal_type'];
                $row['Container Type']="";
                $row['Shelf Life']="";
                $row['Ingredients']="";
                $row['Description']=strip_tags($record['description']);
                $row['Allergic']="";
                $row['Disclaimer']="";           
                
                fputcsv($output,$row);  
                $no++;
             }
            
          }
        
      }  
      fclose($output);
 }

 if(isset($_POST['ProductPriceList']))
 {

    $where="";
    if (!empty($_SESSION['pcatname'])) {
     $where.=" and cat_id='".$_SESSION['pcatname']."'";
    }

    if (!empty($_SESSION['pbrand'])) {
      $where.=" and brand_id='".$_SESSION['pbrand']."'";
    }

    if (!empty($_SESSION['pname'])) {
      $where .=" and product_name like '%".$_SESSION['pname']."%'";
    }

    if (!empty($_SESSION['pstatus'])) {
      if ($_SESSION['pstatus']=="1") {
        $status="1";
      }else{
        $status="0";
      }
      $where .=" and status ='".$status."'";
    }
      // echo $where."<br>";
      // echo "select id from $tbl_product where 1=1 $where <br>"; 
    if(!empty($where))
    {
      $productIdSql = $obj->query("select id from $tbl_product where 1=1 $where");
      while($PidResult = $obj->fetchNextObject($productIdSql)){
        $id1[]=$PidResult->id;
      }
      $ids1 = implode(',',$id1);
      $where1.=" and product_id in($ids1)";


    }
    //  $sql1222="select id,product_id,size,unit_id,actual_price,mrp_price,discount,sell_price, in_stock,totqty,instockqty,cart_max_qty,price1,price2,price3,pphoto,barcode_number,video,display_order,status from $tbl_productprice where 1=1 $where1";
    // echo $sql1222;die;


      $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=ProductPriceList.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      // fputcsv($output, array('Sl. NO.','id','Product id','Size','Unit Id','Actual Price','Mrp Price','Discount(%)','Sell Price','In Stock','Total Quantity','Max Qnt. In Cart','Local Price 1','Local Price 2','Local Price 3','Photo','Barcode Number','Video','Display order','status'));
      // $sql=$GLOBALS['obj']->query("select id,product_id,size,unit_id,actual_price,mrp_price,discount,sell_price, in_stock,cart_max_qty,price1,price2,price3,pphoto,barcode_number,video,display_order,status from $table_name where 1=1 $where1");

      fputcsv($output, array('Product Name','Brand Name','Size','Unit Id','Actual Price','Mrp Price','Discount(%)','Sell Price'));
      $sql=$GLOBALS['obj']->query("select id,product_id,size,unit_id,actual_price,mrp_price,discount,sell_price, in_stock,cart_max_qty,price1,price2,price3,pphoto,barcode_number,video,display_order,status from $table_name where 1=1 $where1");
  
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }
      
      $no=1;
      while($record = mysqli_fetch_assoc($sql))  
      {   

          $row['Product Name']=getField('product_name',$tbl_product,$record['product_id']);
          $row['Brand Name']=getField('brand',$tbl_brand,getField('brand_id',$tbl_product,$record['product_id']));
          $row['Size']=$record['size'];
          $row['Unit']=getField('name',$tbl_unit,$record['unit_id']);
          $row['Actual Price']=$record['actual_price'];
          $row['Mrp Price']=$record['mrp_price'];
          $row['Discount']=$record['discount'];
          $row['Sell Price']=$record['sell_price'];
          

          // $totqty = getTotalQty($record['product_id'],$record['id']);
          // $row['Sl. NO.']=$no;
          // $row['id']=$record['id'];
          // $row['Product id']=$record['product_id'];
          // $row['Size']=$record['size'];
          // $row['Unit Id']=$record['unit_id'];
          // $row['Actual Price']=$record['actual_price'];
          // $row['Mrp Price']=$record['mrp_price'];
          // $row['Discount']=$record['discount'];
          // $row['Sell Price']=$record['sell_price'];
          // $row['In Stock']=$record['in_stock'];
          // $row['Total Quantity']=$totqty;
          // $row['Max Qnt in cart']=$record['cart_max_qty'];
          // $row['Local Price 1']=$record['price1'];
          // $row['Local Price 2']=$record['price2'];
          // $row['Local Price 3']=$record['price3'];
          // $row['photo']=$record['pphoto'];
          // $row['Barcode Number']=$record['barcode_number'];
          // $row['video']=$record['video'];
          // $row['display order']=$record['display_order'];
          // $row['status']=$record['status'];

           fputcsv($output,$row);  
           $no++;
      }  
      fclose($output);

 }


if(isset($_POST['UserList']))
 {
      $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=UserList.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      fputcsv($output, array('Sl. NO.','Name','Mobile1','Mobile2','Email','Other Contact Name','Other Mobile','Date Of Birth','Date of Anniversary','Religion','Flat','Flor','Tower','Street No','Block','Landmark','Society','Area','City','Smart Basket','Active Order','Last Order','Call Schedule','User Group','Daily Basket(Monthly Charges)','Clamor User','User Status'));



      $whr = '';

      if($_SESSION['whr']!=''){
        $whr = $_SESSION['whr'];
      }

      $sql=$obj->query("select * from $table_name where 1=1 $whr");
      $data= $obj->numRows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }
      
      $no=1;
      $add =='';
      while($record = $obj->fetchNextObject($sql))  
      {
        // User Address
        $UserSql = $obj->query("select * from $tbl_useraddress where user_id='".$record->id."'",$debug=-1);
        $UserResult = $obj->fetchNextObject($UserSql);


        // Samart Basket Detail
        $sb='';
        $CartSql = $obj->query("select cart_type from $tbl_cart where user_id='".$record->id."' group by cart_type");
        while($CartResult = $obj->fetchNextObject($CartSql)){
          if($CartResult->cart_type==1){
            $sb .=  "D ,";
          }else if($CartResult->cart_type==2){
             $sb .= "W ,";
          }else if($CartResult->cart_type==3){
             $sb .= "M ,";
          }
        }
       


        //Active Order Query
        $ActiveSql = $obj->query("select ship_timing,order_date from $tbl_order where order_status not in(4,6) and  user_id='".$record->id."' order by id desc limit 0,1");
        $ActiveResult = $obj->fetchNextObject($ActiveSql);
        if(!is_null($ActiveResult->order_date)){
          $ActiveOrder =  date('d-m-Y',strtotime($ActiveResult->order_date))." -> ".$ActiveResult->ship_timing;
        }else{
          $ActiveOrder =  "No New Order";
        }
        // Last Order Query
        $LastSql = $obj->query("select ship_timing,delivered_date from $tbl_order where order_status in(4) and  user_id='".$record->id."' order by id desc limit 0,1",$debug=-1);
        $LastResult = $obj->fetchNextObject($LastSql);
        if(!is_null($LastResult->delivered_date)){
          $LastOrder =   date('d-m-Y',strtotime($LastResult->delivered_date))." -> ".$LastResult->ship_timing;
        }else{
         $LastOrder =   "No Last Order";
        }

        // Call Schedule
        $CallSql = $obj->query("select pdate,ptime from $tbl_callschedule where user_id='".$record->id."' order by id desc limit 0,1");
        $CallResult = $obj->fetchNextObject($CallSql);
        if(!is_null($CallResult->pdate)){
        $callschedule =  date('d-m-Y',strtotime($CallResult->pdate));
        $callscheduleT =  $CallResult->ptime;
        $callschedule = $callschedule." ->".$callscheduleT;
        }else{
        $callschedule = "No Schedule";
        }

        $name = ucfirst($record->title)." ".ucfirst($record->name)." ".ucfirst($record->surname);
        if($record->status==1){
          $ustatus = "Active";
        }else if($record->status==2){
          $ustatus = "Inactive";
        }else if($record->status==3){
          $ustatus = "Blocked";
        }
        
        if($record->daily_basket_charg==1){
            $daily_basket_charg = "Yes";
        }else{
            $daily_basket_charg = "No";
        }
        if($record->clamor_user==1){
            $clamor_user = "Yes";
        }else{
            $clamor_user = "No";
        }
        $row['Sl. NO.']=$no;
        $row['Name']=$name;
        $row['Mobile1']=$record->mobile;
        $row['Mobile2']=$record->mobile1;
        $row['Email']=$record->email;
        $row['Other Contact Name']=$record->other_contact_name;
        $row['Other Mobile']=$record->mobile2;
        $row['Date Of Birth']=$record->dob;
        $row['Date of Anniversary']=$record->doa;
        $row['Religion']=$record->religion;
        $row['Flat']=$UserResult->flat;
        $row['Flor']=$UserResult->flor;
        $row['Tower']=$UserResult->tower;
        $row['Street No']=$UserResult->street_no;
        $row['Block']=$UserResult->block;
        $row['Landmark']=$UserResult->landmark;
        $row['Society']= getField('society',$tbl_society,$UserResult->society);
        $row['Area']= getField('area',$tbl_area,$UserResult->area);
        $row['City']= getField('city',$tbl_city,$UserResult->city);
        $row['Smart Basket']=$sb;
        $row['Active Order']=$ActiveOrder;
        $row['Last Order']=$LastOrder;
        $row['Call Schedule']=$callschedule;
        $row['User Group']=getField('groupname',$tbl_usergroup,$record->user_group);
        $row['Daily Basket(Monthly Charges)']=$daily_basket_charg;
        $row['Clamor User']=$clamor_user;
        $row['User Status']=$ustatus;

        fputcsv($output,$row);  
        $no++;
      }  
      fclose($output);
 }




//Area detail
if(isset($_POST["AreaDetialList"])){
      $table_name = $_GET['table_name'];
      $area_id = $_POST['area_id'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=AreaDetail.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      $whr = $_SESSION['whr'];
      fputcsv($output, array('Sl. NO.', 'Area Name','Employee Name','Customer Name','Customer Mobile','Address','Availability','Interest','Download','Comments'));
      $sql=$GLOBALS['obj']->query("select * from $table_name where 1=1 and area_id='$area_id' $whr order by id desc");
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }

      $no=1;
      
      while($line=$obj->fetchNextObject($sql))  
      {   
        $Address="";
        $download="";
        $username="";

        if($line->plot_no!=''){ $Address .= "Plot No : ".$line->plot_no.","; }
        if($line->block_no!=''){ $Address .= "Block No : ".$line->block_no.","; }
        if($line->building_name!=''){ $Address .= "Building Name : ".$line->building_name.","; }
        if($line->society_name!=''){ $Address .= "Society Name : ".$line->society_name.","; }
        if($line->nooftower!=''){ $Address .= "Tower No. : ".$line->nooftower.","; }
        if($line->street_no!=''){ $Address .= "Street No : ".$line->street_no.","; }
        if($line->house_no!=''){ $Address .= "House No : ".$line->house_no.","; }
        if($line->house_name!=''){ $Address .= "House Name : ".$line->house_name; }
        if($line->customer_availble==1){ $availability = "Not Available".",".$line->reason;}else{ $availability = "Availeble"; }
        if($line->not_interest ==1){ $interest =  "Not Interested";}else{ $interest =  "Interested"; }

        if($line->dapp!='0'){ $download .= "App : Yes".","; }else { $download .= "App : No".","; }
        if($line->voucher!='0'){ $download .= "Voucher : Yes".","; }else { $download .= "Voucher : No".","; }
        if($line->referral!='0'){ $download .=  "Referral : Yes"; }else { $download .= "Referral : No"; }

            $username = getField('emp_name',$tbl_admin,$line->user_id)." ".getField('emp_surname',$tbl_admin,$line->user_id);
            $ASql = $obj->query("select user_id from $tbl_reassignarea where address_id='".$line->id."'");
            while($AResult = $obj->fetchNextObject($ASql)){
            $username .= ", ".getField('emp_name',$tbl_admin,$AResult->user_id)." ".getField('emp_surname',$tbl_admin,$AResult->user_id);
            }


          $row['Sl. NO.']=$no;
          $row['Area Name']= getField('area',$tbl_assignarea,$line->area_id);
          $row['Employee Name']= $username;
          $row['Customer Name']= ucfirst(stripslashes($line->cus_name));
          $row['Customer Mobile']= ucfirst(stripslashes($line->cus_mobile));
          $row['Address']= $Address;
          $row['Availability']= $availability;
          $row['Interest']= $interest;
          $row['Download']= $download;
          $row['Comments']= stripcslashes($line->comments);
           fputcsv($output,$row);  
           $no++;
      }  
      fclose($output);  
 }


if(isset($_POST["FixedHrList"])){
      $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=fixedHr.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      $whr = $_SESSION['fixedhrwhr'];
    fputcsv($output, array('Sl. NO.', 'Date','Posted By','Category','Paid User','Paid By','Amount','Mode/Invoice No','Remarks'));
      $sql=$GLOBALS['obj']->query("select * from $table_name where 1=1 $whr order by id desc");
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }

      $no=1;
      
      while($line=$obj->fetchNextObject($sql))  
      {   
          if($line->cat_id==1){
           $cat = "Salary";
          }else if($line->cat_id==2){
            $cat =  "Bonus";
          }else if($line->cat_id==3){
            $cat = "Other";
          } 
          $row['Sl. NO.']=$no;
          $row['Date']= date('Y-m-d',strtotime($line->sdate));
          $row['Posted By']= getField('emp_name',$tbl_admin,$line->posted_by)." ".getField('emp_surname',$tbl_admin,$line->posted_by);
          $row['Category']= $cat;
          $row['Paid User']= getField('emp_name',$tbl_admin,$line->paid_user_id)." ".getField('emp_surname',$tbl_admin,$line->paid_user_id);
          $row['Paid By']= getField('emp_name',$tbl_admin,$line->paidby_user_id)." ".getField('emp_surname',$tbl_admin,$line->paidby_user_id);
          $row['Amount']= $line->total_paid_amount;
          $row['Mode/Invoice No']= $line->paid_mode." / ".$line->invoice_no;
          $row['Remarks']= stripcslashes($line->remarks);
          fputcsv($output,$row);  
          $no++;
      }  
      fclose($output);  
 }

 if(isset($_POST["FixedInventoryList"])){
      $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=fixedInventory.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      $whr = $_SESSION['fixedinventorywhr'];
      fputcsv($output, array('Sl. NO.', 'Date','Posted By','Category Name','Total Amount','User Name','Remarks'));
      $sql=$GLOBALS['obj']->query("select * from $table_name where 1=1 $whr order by id desc");
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }

      $no=1;
      
      while($line=$obj->fetchNextObject($sql))  
      {   
          if($line->cat_id==1){
           $cat = "Inventory";
          }else if($line->cat_id==2){
            $cat =  "JIT";
          }
          $row['Sl. NO.']=$no;
          $row['Date']= $line->dateto." - ".$line->datefrom;
          $row['Posted By']= getField('emp_name',$tbl_admin,$line->posted_by)." ".getField('emp_surname',$tbl_admin,$line->posted_by);
          $row['Category Name']= $cat;
          $row['Total Amount']= $line->total_expense_amt;
          $row['User Name']= getField('emp_name',$tbl_admin,$line->user_id)." ".getField('emp_surname',$tbl_admin,$line->user_id);
          $row['Remarks']= stripcslashes($line->remarks);
          fputcsv($output,$row);  
          $no++;
      }  
      fclose($output);  
 }

 if(isset($_POST["FixedLogisticsList"])){
      $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=FixedLogistics.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      $whr = $_SESSION['fixedlogisticswhr'];
      fputcsv($output, array('Sl. NO.', 'Date','Posted By','Vehicle No','Refueling KM','Refueling Amount','Bill No','User Name','Remarks'));
      $sql=$GLOBALS['obj']->query("select * from $table_name where 1=1 $whr order by id desc");
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }

      $no=1;
      
      while($line=$obj->fetchNextObject($sql))  
      {   

          $row['Sl. NO.']=$no;
          $row['Date']= $line->refueling_date;
          $row['Posted By']= getField('emp_name',$tbl_admin,$line->posted_by)." ".getField('emp_surname',$tbl_admin,$line->posted_by);
          $row['Vehicle No']= getField('vehicle_no',$tbl_vehicle,$line->vehicle_id);
          $row['Refueling KM']= stripcslashes($line->refueling_km);
          $row['Refueling Amount']= stripcslashes($line->refueling_amt);
          $row['Bill No']= stripcslashes($line->bill_no);
          $row['User Name']= getField('emp_name',$tbl_admin,$line->user_id)." ".getField('emp_surname',$tbl_admin,$line->user_id);
          $row['Remarks']= stripcslashes($line->remarks);
          fputcsv($output,$row);  
          $no++;
      }  
      fclose($output);  
 }

 if(isset($_POST["FixedMarketingList"])){
      $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=fixedMarketing.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      $whr = $_SESSION['fixedmarketingwhr'];
      fputcsv($output, array('Sl. NO.', 'Date','Posted By','Category Name','Total Amount','User Name','Remarks'));
      $sql=$GLOBALS['obj']->query("select * from $table_name where 1=1 $whr order by id desc");
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }

      $no=1;
      
      while($line=$obj->fetchNextObject($sql))  
      {   
          if($line->cat_id==1){
          $cat = "Flyer Printing";
          }else if($line->cat_id==2){
           $cat =  "Flyer Distribution";
          }else if($line->cat_id==3){
           $cat =  "Physical Marketing";
          }else if($line->cat_id==4){
           $cat =  "Social Media Marketing";
          }else if($line->cat_id==5){
           $cat =  "Gifts";
          }else if($line->cat_id==6){
           $cat =  "Other";
          }
          $row['Sl. NO.']=$no;
          $row['Date']= $line->dateto." - ".$line->datefrom;
          $row['Posted By']= getField('emp_name',$tbl_admin,$line->posted_by)." ".getField('emp_surname',$tbl_admin,$line->posted_by);
          $row['Category Name']= $cat;
          $row['Total Amount']= $line->total_expense_amt;
          $row['User Name']= getField('emp_name',$tbl_admin,$line->user_id)." ".getField('emp_surname',$tbl_admin,$line->user_id);
          $row['Remarks']= stripcslashes($line->remarks);
          fputcsv($output,$row);  
          $no++;
      }  
      fclose($output);  
 }

 if(isset($_POST["FixedSpaceSetupList"])){
      $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=fixedSpaceandSetup.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      $whr = $_SESSION['fixedspacesetupwhr'];
      fputcsv($output, array('Sl. NO.', 'Date','Posted By','Category Name','Total Amount','User Name','Remarks'));
      $sql=$GLOBALS['obj']->query("select * from $table_name where 1=1 $whr order by id desc");
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }

      $no=1;
      
      while($line=$obj->fetchNextObject($sql))  
      {   
          if($line->cat_id==1){
          $cat = "Space";
          }else if($line->cat_id==2){
           $cat =  "Electricity";
          }else if($line->cat_id==3){
           $cat =  "Water";
          }else if($line->cat_id==4){
           $cat =  "Pesticides";
          }
          $row['Sl. NO.']=$no;
          $row['Date']= $line->dateto." - ".$line->datefrom;
          $row['Posted By']= getField('emp_name',$tbl_admin,$line->posted_by)." ".getField('emp_surname',$tbl_admin,$line->posted_by);
          $row['Category Name']= $cat;
          $row['Total Amount']= $line->total_expense_amt;
          $row['User Name']= getField('emp_name',$tbl_admin,$line->user_id)." ".getField('emp_surname',$tbl_admin,$line->user_id);
          $row['Remarks']= stripcslashes($line->remarks);
          fputcsv($output,$row);  
          $no++;
      }  
      fclose($output);  
 }

 if(isset($_POST["FixedUtilitiesList"])){
      $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=fixedUtilities.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      $whr = $_SESSION['fixedutilitieswhr'];
      fputcsv($output, array('Sl. NO.', 'Date','Posted By','Category Name','Sub Category','Total Amount','User Name','Remarks'));
      $sql=$GLOBALS['obj']->query("select * from $table_name where 1=1 $whr order by id desc");
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }

      $no=1;
      
      while($line=$obj->fetchNextObject($sql))  
      {   
          if($line->cat_id==1){
          $cat = "Pantry";
          }else if($line->cat_id==2){
           $cat =  "Stationary";
          }else if($line->cat_id==3){
           $cat =  "Cleaning";
          }else if($line->cat_id==4){
           $cat =  "Pesticides";
          }else if($line->cat_id==5){
           $cat =  "Miscellaneous";
          }else if($line->cat_id==6){
           $cat =  "Other";
          }
          $row['Sl. NO.']=$no;
          $row['Date']= $line->dateto." - ".$line->datefrom;
          $row['Posted By']= getField('emp_name',$tbl_admin,$line->posted_by)." ".getField('emp_surname',$tbl_admin,$line->posted_by);
          $row['Category Name']= $cat;
          $row['Sub Category']= $line->subcategory;
          $row['Total Amount']= $line->total_expense_amt;
          $row['User Name']= getField('emp_name',$tbl_admin,$line->user_id)." ".getField('emp_surname',$tbl_admin,$line->user_id);
          $row['Remarks']= stripcslashes($line->remarks);
          fputcsv($output,$row);  
          $no++;
      }  
      fclose($output);  
 }

 if(isset($_POST["OrderActiveList"])){
      $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=order_active_list.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      $whr = $_SESSION['orderactivelist'];
      fputcsv($output, array('Sl. NO.', 'Order Date/Time','Delivery Date/Slot','Order Id','Amount','Method Of Payment'));
      $sql=$GLOBALS['obj']->query("select * from $tbl_order where 1=1 and order_status=1 $whr order by id desc");
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }

      $no=1;
      
      while($line=$obj->fetchNextObject($sql))  
      {   
          $row['Sl. NO.']=$no;
          $row['Order Date/Time']= date('d M Y H:i',strtotime($line->order_date))." / ".CalculateOrderTime($line->order_date);
          $row['Delivery Date/Slot']= date('D j M Y',strtotime($line->ship_date))." / ".stripslashes($line->ship_timing);
          $row['Order Id']= stripslashes($line->order_id);
          $row['Amount']= number_format($line->total_amount,0);
          $row['Method Of Payment']= stripslashes($line->payment_method);
          fputcsv($output,$row);  
          $no++;
      }  
      fclose($output);  
 }


if(isset($_POST["OrderDeliveredList"])){
      $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=order_active_list.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      $whr = $_SESSION['orderdeliveredlist'];
      fputcsv($output, array('Sl. NO.', 'Order Date/Time','Delivery Date/Slot','Order Id','Amount','Method Of Payment'));
      $sql=$GLOBALS['obj']->query("select * from $tbl_order where 1=1 and order_status=4 $whr order by id desc");
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }

      $no=1;
      
      while($line=$obj->fetchNextObject($sql))  
      {   
          $row['Sl. NO.']=$no;
          $row['Order Date/Time']= date('d M Y H:i',strtotime($line->order_date))." / ".CalculateOrderTime($line->order_date);
          $row['Delivery Date/Slot']= date('D j M Y',strtotime($line->ship_date))." / ".stripslashes($line->ship_timing);
          $row['Order Id']= stripslashes($line->order_id);
          $row['Amount']= number_format($line->total_amount,0);
          $row['Method Of Payment']= stripslashes($line->payment_method);
          fputcsv($output,$row);  
          $no++;
      }  
      fclose($output);  
 }

 if(isset($_POST["OrderReturnList"])){
      $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=order_active_list.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      $whr = $_SESSION['orderreturnlist'];
      fputcsv($output, array('Sl. NO.', 'Order Date/Time','Order ID','Order Status','Product Name','Size','Qty*Price','Total Price'));
      $sql=$GLOBALS['obj']->query("select a.*,b.order_id as order_num,b.order_status,b.order_date from $tbl_order_itmes as a inner join $tbl_order as b on a.order_id=b.id where 1=1 $whr and a.status in (3,5) order by a.id desc");
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }

      $no=1;
      
      while($line=$obj->fetchNextObject($sql))  
      {   
          $row['Sl. NO.']=$no;
          $row['Order Date/Time']= date('d M Y H:i',strtotime($line->order_date))." / ".CalculateOrderTime($line->order_date);
          $row['Order ID']= $line->order_num;
          $row['Order Status']= getField('order_status',$tbl_order_status,$line->order_status);
          $row['Product Name']= getField('product_name',$tbl_product,$line->product_id);
          $row['Size']= getField('size',$tbl_productprice,$line->price_id)." ".getField('name',$tbl_unit,getField('unit_id',$tbl_productprice,$line->price_id));
          $row['Qty*Price']= $line->qty." * ".number_format($line->price,0);
          $row['Total Price'] = number_format($line->qty*$line->price,0);
          fputcsv($output,$row);  
          $no++;
      }  
      fclose($output);  
 }

 if(isset($_POST["OrderCancelledList"])){
      $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=order_active_list.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  

      // output the column headings
      $whr = $_SESSION['ordercancelledlist'];
      fputcsv($output, array('Sl. NO.', 'Order Date/Time','Order ID','Contact No','Address','Amount','Method of payment'));
      $sql=$GLOBALS['obj']->query("select * from $tbl_order where 1=1 and order_status=6 $whr order by id desc");
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }

      $no=1;
      
      while($line=$obj->fetchNextObject($sql))  
      {   
          $row['Sl. NO.']=$no;
          $row['Order Date/Time']= date('d M Y H:i',strtotime($line->order_date))." / ".CalculateOrderTime($line->order_date);
          $row['Order ID']= stripslashes($line->order_id);
          $row['Contact No']= stripslashes($line->ship_mobile);
          $row['Address']= stripslashes($line->ship_sectorno)." , ".stripslashes($line->ship_city);
          $row['Amount']= number_format($line->total_amount,0);
          $row['Method of payment']= stripslashes($line->payment_method);
          fputcsv($output,$row);  
          $no++;
      }  
      fclose($output);  
 }
 
 
 
 
 
  if(isset($_POST["GSTOrderProductList"])){
	  $table_name = $_GET['table_name'];
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=GSTOrderProductList.csv');  
      $output = fopen("php://output", "w");  

      // output the column headings
      fputcsv($output, array('Sl. NO.', 'Date','Brand','Product Name','Size','MRP','QTY','Selling Price','GST'));
      $sl = "select * from $table_name where 1=1";
      
      if (!empty($_SESSION['order_date_from']) && !empty($_SESSION['order_date_to'])) {
	    $sl.=" and date(cdate) between '".$_SESSION['order_date_from']."' and '".$_SESSION['order_date_to']."' ";
        }
      $sql=$GLOBALS['obj']->query($sl);
      
      $data= mysqli_num_rows($sql);
      if(empty($data)|| $data==0)
      {
        
         fputcsv($output,array("Sorry, No Result Found"));
         exit;
      }

      $no=1;
      while($record = mysqli_fetch_assoc($sql))  
      {   

          $row['Sl. NO.']=$no;
          $row['Date']= $record['cdate'];
          $row['Brand']=getField('brand',$tbl_brand,getField('brand_id',$tbl_product,$record['product_id']));
          $row['Product Name']= $record['product_name'];
          $row['Size']= getField('size',$tbl_productprice,$record['price_id'])." ".getField('name',$tbl_unit,getField('unit_id',$tbl_productprice,$record['price_id']));
          $row['MRP']=getField('mrp_price',$tbl_productprice,$record['price_id']);
          $row['QTY']=$record['qty'];
          $row['Selling Price']=$record['price'];
          $row['GST']=getField('gst',$tbl_productprice,$record['price_id'])."%";
    
          fputcsv($output,$row);  
          $no++;
      }  
      fclose($output);  
 }
?>