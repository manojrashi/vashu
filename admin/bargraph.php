<?php 
include('../include/config.php');
include("../include/functions.php");
// content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');

//$datay=array(1000,5000,10000,50000,0,0,3000,400);


// Create the graph. These two calls are always required
$graph = new Graph(520,250,'auto');
$graph->SetScale("textlin");

//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());
 $num = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
 for($i=1;$i<= $num;$i++){
	 if($i<10){$i='0'.$i;} 
	$monthArr[]= $i;
	
	$cut_date=date('Y')."-".date('m')."-".$i;
	$orderArr=$obj->query("select sum(total_amount) as tot_amout from $tbl_order where order_date like '".$cut_date."%' ");
	$rsOrder=$obj->fetchNextObject($orderArr);
	if($rsOrder->tot_amout==''){
		$rsOrder->tot_amout=0;
		}
	$datay[]=$rsOrder->tot_amout;
 }
//print_r($datay);
// set major and minor tick positions manually
$graph->yaxis->SetTickPositions(array(1000,5000,10000,20000,50000,100000,500000),array(0,1000,5000,10000,20000,50000,100000));
$graph->SetBox(false);

//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($monthArr);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
$graph->yaxis->title->Set('Sales (INR)');
$graph->xaxis->title->Set('Day');
$graph->xaxis->SetLabelAlign('right','center','right');
// Create the bar plots
$b1plot = new BarPlot($datay);

// ...and add it to the graPH
$graph->Add($b1plot);


$b1plot->SetColor("white");
$b1plot->SetFillColor("#06C");
$graph->title->Set("Sales -".date('F')." ".date('Y'));

// Display the graph
$graph->Stroke();
?>