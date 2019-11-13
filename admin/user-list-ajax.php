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
	1 => 'name',
	2 =>'mobile'
);

$sql=$obj->query("select COUNT(*) as num_rows from $tbl_user where 1=1 and user_type=1",$debug=-1);

$line=$obj->fetchNextObject($sql);
$totalData=$line->num_rows;
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = "select * from $tbl_user where 1=1 and user_type=1";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter

$sql.=" AND ( id LIKE '".$requestData['search']['value']."%' ";

$sql.=" OR name LIKE '".$requestData['search']['value']."%' ";

$sql.=" OR surname LIKE '".$requestData['search']['value']."%' ";

$sql.=" OR email LIKE '".$requestData['search']['value']."%' ";

$sql.=" OR mobile LIKE '".$requestData['search']['value']."%') ";
}


$query = $obj->query($sql);
$totalFiltered=$obj->numRows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 

$requestData['order'][0]['dir']='desc';
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	

//echo $sql; 
$query = $obj->query($sql);


$data = array();
$i=1;
while($row=$obj->fetchNextObject($query)) {  // preparing an array
	$nestedData=array();
	$UserSql = $obj->query("select * from $tbl_useraddress where user_id='".$row->id."'",$debug=-1);
	$UserResult = $obj->fetchNextObject($UserSql);

	$nestedData[] = '<div class="squaredFour"><input type="checkbox" class="checkall" id="squaredFour'.$i.'" name="ids[]" value="'.$row->id.'" /><label for="squaredFour'.$i.'"></label></div>';
	$nestedData[] = $row->id;
	$nestedData[] = $row->name." ".$row->surname;
	$nestedData[] = $row->email;
	$nestedData[] = $row->mobile;
	$nestedData[] = '<div style="width:100%; max-height:80px; overflow:auto">'.$UserResult->address.'</div>';;
	
	if($row->status==1) { $chk_status='checked';}else{ $chk_status='';};
  	$status = '<label class="switch"><input type="checkbox" onclick="return changeStatus(this.value,this.checked)" class="chkstatus" '.$chk_status.' value="'.$row->id.' '.tbl_useraddress.'"  data-one="'.$tbl_useraddress.'"/>
  	<div class="slider round"></div></label>';


	$nestedData[] =$status;
	$nestedData[] = '<p style="text-align:center"><a href="user-addf.php?id='.$row->id.'" class="btn btn-primary" title="edit"> <i class="fa fa-pencil"></i></a>&nbsp;
	<a href="useraddress-list.php?id='.$row->id.'" class="btn btn-primary" title="Add Address"> <i class="fa fa-envelope"></i></a>
	</p>';
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
