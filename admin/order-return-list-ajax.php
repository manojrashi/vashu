<?php
session_start(); 
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$columns = array( 
// datatable column index  => database column name
	0 =>'id', 
	1 =>'order_date',
	2 =>'order_id',
	3 =>'total_amount',
	4=>'payment_method'
	);


$sql=$obj->query("select count(id) as num_rows from $tbl_order_itmes as a inner join $tbl_order as b on a.order_id=b.id where 1=1 and a.status in (3,5)",$debug=-1);
$line=$obj->fetchNextObject($sql);
$totalData=$line->num_rows; //die;
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = "select a.*,b.order_id as order_num,b.order_status,b.order_date,b.ship_type,b.user_id,b.payment_method,b.payment_status from $tbl_order_itmes as a inner join $tbl_order as b on a.order_id=b.id where 1=1 and a.status in (3,5)";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( order_id LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR payment_method LIKE '".$requestData['search']['value']."%' )";
}

if(!empty($_SESSION['whr'])){
	$sql.=$_SESSION['whr'];
}

//echo $sql; die;
$query = $obj->query($sql);
$totalFiltered=$obj->numRows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 

$requestData['order'][0]['dir']='desc';
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	


//echo $sql; //die;
//$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$query = $obj->query($sql);


$data = array();
$i=1;
while($row=$obj->fetchNextObject($query)) {  // preparing an array
	$nestedData=array();

	if($row->ship_type=='Normal'){
		$order_date =  date('d M Y H:i',strtotime($row->order_date))."<br/>".CalculateOrderTime($row->order_date); 
	}else{
		$order_date = "Express";
	}

	if($row->ship_type=='Normal'){
		$delevery_date =  date('D j M Y',strtotime($row->ship_date))."</br>".getField('time_from',$tbl_bookingslot,$row->ship_timing)." ".getField('time_to',$tbl_bookingslot,$row->ship_timing); ; 
	}else{
		$delevery_date = "Express";
	} 
    
    $name = getField('name',$tbl_user,$row->user_id)." ".getField('surname',$tbl_user,$row->user_id)."</br>".getField('mobile',$tbl_user,$row->user_id);
    
    
    if($row->payment_status==0){
        $payment_status = "Unpaid";
    }else{
        $payment_status = "Paid";
    }
    
	$nestedData[] = $i;
	$nestedData[] = $name;
    $nestedData[] = $order_date;
    $nestedData[] = $row->order_num;
	$nestedData[] = getField('order_status',$tbl_order_status,$row->order_status);
	$nestedData[] = getField('product_name',$tbl_product,$row->product_id);
	$nestedData[] = getField('size',$tbl_productprice,$row->price_id)." ".getField('name',$tbl_unit,getField('unit_id',$tbl_productprice,$row->price_id));
	$nestedData[] = $row->qty." * ".number_format($row->price,0);
	$nestedData[] = number_format($row->qty*$row->price,0);
	$nestedData[] = $row->payment_method." / ".$payment_status;
	$nestedData[] = '<script>
                          $(document).ready(function(){
                            $(".iframeOrder'.$row->id.'").colorbox({iframe:true, width:"700px;", height:"500px;", frameborder:"0",scrolling:true});
                          });
                        </script>
                        <a href="productreturnstatus.php?price_id='.$row->price_id.'&order_id='.$row->order_id.'" class="btn btn-primary iframeOrder'.$row->id.' cboxElement" title="View Details"><i class="fa fa-plus"></i></a>';
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
