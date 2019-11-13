<?php
include("../include/config.php");
include("../include/functions.php");
validate_admin();


 if(isset($_POST["MinimumStockReport"])){
	  
    header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=MinimumStockRepoprt.csv');  
    $output = fopen("php://output", "w");  
    
    // output the column headings
    fputcsv($output, array('Sl. NO.', 'Product Id','Category','Brand','Product Name','Size','Minimum Qty','Tot. Sale','Tot. Qty'));
    
    $whr="";
    if($_SESSION['whr']!=''){
        $whr = $_SESSION['whr'];
    }
    
    $sql=$GLOBALS['obj']->query("select a.id,a.cart_min_qty,a.product_id,a.price_id,a.unit_id,a.size,b.product_id as p_id,b.cat_id,b.brand_id,b.product_name from $tbl_productprice as a LEFT JOIN $tbl_product as b ON a.product_id = b.id where a.status=1 and cart_min_qty > (select SUM(COALESCE(CASE WHEN type = 'Cr' THEN totqty END,0))-SUM(COALESCE(CASE WHEN type = 'Dr' THEN totqty END,0)) balance from $tbl_stock where price_id=a.price_id and product_id=b.product_id) $whr");
    
    $data= mysqli_num_rows($sql);
    
    if(empty($data)|| $data==0)
    {
    
    fputcsv($output,array("Sorry, No Result Found"));
    exit;
    }
    
    $no=1;
    while($record = mysqli_fetch_assoc($sql))  
    {
        
    $SlSql = $GLOBALS['obj']->query("select count(totqty) as totqty from $tbl_stock where product_id='".$record['p_id']."' and price_id='".$record['price_id']."' and type='Dr' and status=1");
	$SlResult = mysqli_fetch_assoc($SlSql);
	
    $row['Sl. NO.']=$no;
    $row['Product Id']=$record['p_id'];
    $row['Category']=getCategoryTree($record['cat_id'],$array=array());;
    $row['Brand']=getField('brand',$tbl_brand,$record['brand_id']);;
    $row['Product Name']=$record['product_name'];
    $row['Size']=$record['size']." ".getField('name',$tbl_unit,$record['unit_id']);
    $row['Minimum Qty']=$record['cart_min_qty'];
    $row['Tot. Sale']=$SlResult['totqty'];
    $row['Tot. Qty']=getTotalQty($row->p_id,$record['price_id']);
    fputcsv($output,$row);  
    $no++;
    }  
    fclose($output);  
 }

?>