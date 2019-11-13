<?php
session_start(); 
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$columns = array( 
// datatable column index  => database column name
	0 =>'a.id', 
	1 => 'a.brand_id',
	2 =>'a.product_name',
	3 =>'a.cat_id'
	);


$sql=$obj->query("select COUNT(*) as num_rows from $tbl_product where 1=1",$debug=-1);
$line=$obj->fetchNextObject($sql);
$totalData=$line->num_rows;
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "select a.id,a.vendor_id,a.product_name,a.product_code,a.cat_id,a.subcat_id,a.brand_id,a.status,a.display_order from $tbl_product as a join $tbl_productprice as b on a.id=b.product_id where 1=1";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
    
    $sql.=" AND ( a.id LIKE '".$requestData['search']['value']."%' ";
    
	$sql.=" OR  a.product_name LIKE '".$requestData['search']['value']."%' "; 
	
	$sql.=" OR a.product_code LIKE '".$requestData['search']['value']."%' )";
		
}


	if (!empty($_SESSION['pcatname'])) {
		$pcatname = $_SESSION['pcatname'];
		$sql.=" and FIND_IN_SET($pcatname,`categories`)";
	}
	
	
	if (!empty($_SESSION['pbrand'])) {
		$sql.=" and a.brand_id='".$_SESSION['pbrand']."'";
	}

	if (!empty($_SESSION['pname'])) {
		$sql .=" and a.product_name like '%".$_SESSION['pname']."%'";
	}

	if (!empty($_SESSION['pstatus'])) {
		if ($_SESSION['pstatus']=="1") {
			$status="1";
		}else{
			$status="0";
		}

		$sql .=" and a.status ='".$status."'";
	}
	
	if (!empty($_SESSION['pstock'])) {
        if ($_SESSION['pstock']=="1") {
         $pstock="1";
        }else{
         $pstock="0";
        }
		$sql.=" and b.in_stock='".$pstock."'";
	}

$sql .=" group by a.id";
//echo $sql; die;

$query = $obj->query($sql);
$totalFiltered=$obj->numRows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 

$requestData['order'][0]['dir']='desc';
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	


//echo $sql; 
//$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$query = $obj->query($sql);


$data = array();
$i=1;
while($row=$obj->fetchNextObject($query)) {  // preparing an array
	 $chk_status =$row->status ==1 ? 'checked':'' ;
	 $nestedData=array();
	 
	 $getpic=$obj->fetchNextObject($obj->query("select pphoto from $tbl_productprice where product_id=".$row->id));	
	 
	 $Var1 = '<label class="switch"><input type="checkbox" onclick="return changeStatus(this.value,this.checked)" class="chkstatus" value="'.$row->id.' '.tbl_product.'" data-one="'.$tbl_product.'"';
	if($row->status==1){
		$Var1 .=' checked';
	}
	$Var1 .=' /> <div class="slider round"></div>
            </label>';
	$VarArr = '';
	$Var='';
	$VarArr = array();
	$PriceSql = $obj->query("select id,size,unit_id from $tbl_productprice where product_id='".$row->id."'");
	while($PriceResult = $obj->fetchNextObject($PriceSql)){
	$totqty = getTotalQty($row->id,$PriceResult->id);
	$VarArr[] = $PriceResult->size."  ".getField('name',$tbl_unit,$PriceResult->unit_id)."-".$totqty;
	}
	//print_r($VarArr);
	$Var='';
	$Vr = array();
	if(!empty($VarArr)){
	for($j=0; $j < count($VarArr); $j++){
	$Vr = explode('-',$VarArr[$j]);
	if($Vr[1] <= getField('minstockqty',$tbl_setting,1)){
	$Var .= '<span class="minimumstockqty">';
	}
	$Var .= $VarArr[$j];
	$Var .= "</br>";
	if($Vr[1] <= 20){
	$Var .= '</span>';
	}
	}
	}else{
	$Var='';
	}


	
	$nestedData[] = '<div class="squaredFour"><input type="checkbox" class="checkall" id="squaredFour'.$i.'" name="ids[]" value="'.$row->id.'" /><label for="squaredFour'.$i.'"></label></div>';
	$nestedData[] = getField('name',$tbl_user,$row->vendor_id)." ".getField('surname',$tbl_user,$row->vendor_id);
 	$nestedData[] = "<strong>Product :</strong> ".$row->product_name."</br><strong>Brand :</strong>".getField('brand',$tbl_brand,$row->brand_id)."</br><strong>Qty :</strong>".$Var;
	$nestedData[] = getField('category',$tbl_category,$row->cat_id)."->".getField('subcategory',$tbl_subcategory,$row->subcat_id);
	
	 $nestedData[] =is_file('../upload_images/product/thumb/'.$getpic->pphoto) ?'<img src="../upload_images/product/tiny/'.$getpic->pphoto.'" class="img-thumbnail-prod">':'No';
	$nestedData[] = $row->home==1 ? '<input type="checkbox" name="home" value="'.$row->id.'" onclick="return showOnhome(this.value,this.checked)" checked>':'<input type="checkbox" name="Home" value="'.$row->id.'" onclick="return showOnhome(this.value,this.checked)">';
	$nestedData[] = $row->best_seller==1 ? '<input type="checkbox" name="bestseller" value="'.$row->id.'" onclick="return showBestSeller(this.value,this.checked)" checked>':'<input type="checkbox" name="bestseller" value="'.$row->id.'" onclick="return showBestSeller(this.value,this.checked)">';
	$nestedData[] =$Var1;


	$nestedData[] = '<p style="text-align:center"><a href="product-addf.php?id='.$row->id.'" class="btn btn-primary" title="edit"> <i class="fa fa-pencil"></i></a>&nbsp;
	 	<a href="productprice-list.php?product_id='.$row->id.'" class="btn btn-primary" title="Manage price/size">&nbsp;<i class="fa fa-inr"></i>&nbsp;</a>';
	
	$data[] = $nestedData;
	$i++;
}


$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);


echo json_encode($json_data);  // send data as json format

?>
