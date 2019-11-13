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


$sql=$obj->query("select count(id) as num_rows from $tbl_order where 1=1",$debug=-1);
$line=$obj->fetchNextObject($sql);
$totalData=$line->num_rows; //die;
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = "select a.* from $tbl_order as a INNER JOIN $tbl_user as b ON a.user_id=b.id where 1=1";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
$sql.=" AND ( a.order_id LIKE '".$requestData['search']['value']."%' ";    
$sql.=" OR  b.name LIKE '".$requestData['search']['value']."%' "; 
$sql.=" OR  b.mobile LIKE '".$requestData['search']['value']."%' "; 
$sql.=" OR a.payment_method LIKE '".$requestData['search']['value']."%' )";
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




	$nestedData[] = '<div class="squaredFour">
	<input type="checkbox" class="checkall" id="squaredFour'.$row->id.'" name="ids[]" value="'.$row->id.'" />
	<label for="squaredFour'.$row->id.'"></label>
	</div>';
	$nestedData[] = date('d M Y H:i',strtotime($row->order_date))."<br/>".CalculateOrderTime($row->order_date);;
	$nestedData[] = $row->orderno;
	$nestedData[] = $website_currency_symbol." ".number_format($row->total_amount,0);
	$nestedData[] = stripslashes($row->payment_method);
	$nestedData[] = getField('name',$tbl_user,$row->user_id)." ".getField('surname',$tbl_user,$row->user_id)."</br>".getField('mobile',$tbl_user,$row->user_id);
	$nestedData[] = $row->ship_address;
	$nestedData[] = '<script>
	$(document).ready(function(){
		$(".iframeOrder'.$row->id.'").colorbox({iframe:true, width:"900px;", height:"800px;", frameborder:"0",scrolling:true});

		$(".iframeViewc'.$row->id.'").colorbox({iframe:true, width:"800px;", height:"600px;", frameborder:"0",scrolling:true});

		$(".iframeAddc'.$row->id.'").colorbox({iframe:true, width:"800px;", height:"600px;", frameborder:"0",scrolling:true});

		});
		</script><a href="vieworder-detail.php?order_id='.$row->id.'" class="btn btn-primary iframeOrder'.$row->id.'" title="View Details">
		<i class="fa fa-eye"></i></a>
		<a href="addcommets.php?order_id='.$row->id.'" class="btn btn-primary iframeAddc'.$row->id.' cboxElement" title="Add Comment">
		<i class="fa fa-plus"></i></a>
		<a href="viewcommets.php?order_id='.$row->id.'" target="_blank"  class="iframeViewc'.$row->id.' btn btn-primary" title="View Comment">
		<i class="fa fa-comment"></i></a>';

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
