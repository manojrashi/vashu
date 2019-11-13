<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_bar.php');

include("../include/config.php");
include("../include/functions.php"); 



$i=1;
$currdate = date('Y-m-d');
$week_date = date('Y-m-d',strtotime("-1 week", strtotime($currdate)));
$month_date = date('Y-m-d',strtotime("-1 month", strtotime($currdate)));
$year_date = date('Y-m-d',strtotime("-1 year", strtotime($currdate)));


$TodaySql=$obj->query("select count(id) as totA from $tbl_order where order_status=4 and order_date='$currdate'",$debug=-1);
$TodayResult=$obj->fetchNextObject($TodaySql);


$WeekSql=$obj->query("select count(id) as totB from $tbl_order where order_status=4 and order_date <='$currdate' and order_date >= '$week_date'",$debug=-1);
$WeekResult=$obj->fetchNextObject($WeekSql);

$MonthSql=$obj->query("select count(id) as totC from $tbl_order where order_status=4 and order_date <='$currdate' and order_date >= '$month_date'",$debug=-1);
$MonthResult=$obj->fetchNextObject($MonthSql);


$YearSql=$obj->query("select count(id) as totD from $tbl_order where order_status=4 and order_date <='$currdate' and order_date >= '$year_date'",$debug=-1);
$YearResult=$obj->fetchNextObject($YearSql);

$datay=array($TodayResult->totA,$WeekResult->totB,$MonthResult->totC,$YearResult->totD);


// Create the graph. These two calls are always required
$graph = new Graph(350,220,'auto');
$graph->SetScale("textlin");

//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// set major and minor tick positions manually
$graph->yaxis->SetTickPositions(array(0,100,200,300,400,500), array(50,150,250,350,450));
$graph->SetBox(false);

//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels(array('Today','Week','Month','Year'));
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($datay);

// ...and add it to the graPH
$graph->Add($b1plot);


$b1plot->SetColor("white");
$b1plot->SetFillGradient("#4B0082","white",GRAD_LEFT_REFLECTION);
$b1plot->SetWidth(45);
$graph->title->Set("Bar Gradient(Left reflection)");

// Display the graph
$graph->Stroke();
?>