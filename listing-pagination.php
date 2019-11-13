<?php
  $adjacents = 3;
  if(empty($targetpage)) $targetpage = "?";
  if(empty($limit)) $limit = 30;
  $page = $_GET['page'];
  if ($page)
      $start = ($page - 1) * $limit;
  else
      $start = 0;
  
  if ($page == 0)
      $page = 1;
  $prev = $page - 1;
  $next = $page + 1;
  $lastpage = ceil($total_pages / $limit);
  $lpm1 = $lastpage - 1;
  
  $pagination = "";
  if ($lastpage > 1) {
      $pagination .= "<ul>";
      if ($page > 1)
          $pagination .= " <li><a href=\"javascript:void(0)\" onclick=\"return doPagingSearch($prev)\">Prev</a></li>";
      else
          $pagination .= "<li> <a href=\"javascript:void(0)\">Prev</a></li>";
      
      
      if ($lastpage < 7 + ($adjacents * 2)) {
          for ($counter = 1; $counter <= $lastpage; $counter++) {
              if ($counter == $page)
                  $pagination .= "<li><a  href=\"javascript:void(0)\" class=\"act\">$counter</a></li>";
              else
                  $pagination .= "<li><a  href=\"javascript:void(0)\" onclick=\"return doPagingSearch($counter)\" >$counter</a></li>";
          }
      }  

	  elseif ($lastpage > 5 + ($adjacents * 2)) {
          if ($page < 1 + ($adjacents * 2)) {
              for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                  if ($counter == $page)
                      $pagination .= "<li><a  href=\"javascript:void(0)\"  class=\"act\">$counter</a></li>";
                  else
                      $pagination .= "<a href=\"javascript:void(0)\" onclick=\"return doPagingSearch($counter)\">$counter</a>";
              }
              $pagination .= "...";
              $pagination .= "<li><a  href=\"javascript:void(0)\" onclick=\"return doPagingSearch($lpm1)\">$lpm1</a></li>";
              $pagination .= "<li><a href=\"javascript:void(0)\" onclick=\"return doPagingSearch($lastpage)\">$lastpage</a></li>";
          } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
              $pagination .= "<li><a href=\"javascript:void(0)\" onclick=\"return doPagingSearch(1)\" >1</a></li>";
              $pagination .= "<li><a href=\"javascript:void(0)\" onclick=\"return doPagingSearch(2)\" >2</a></li>";
              $pagination .= "...";
              for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                  if ($counter == $page)
                      $pagination .= "<li><a href=\"javascript:void(0)\" class=\"act\">$counter</a></li>";
                  else
                      $pagination .= "<li><a href=\"javascript:void(0)\" onclick=\"return doPagingSearch($counter)\">$counter</a></li>";
              }
              $pagination .= "...";
              $pagination .= "<li><a href=\"javascript:void(0)\" onclick=\"return doPagingSearch($lpm1)\" >$lpm1</a></li>";
              $pagination .= "<li><a href=\"javascript:void(0)\" onclick=\"return doPagingSearch($lastpage)\" >$lastpage</a></li>";
          } else {
              $pagination .= "<li><a href=\"javascript:void(0)\" onclick=\"return doPagingSearch(1)\">1</a></li>";
              $pagination .= "<li><a href=\"javascript:void(0)\" onclick=\"return doPagingSearch(2)\">2</a></li>";
              $pagination .= "...";
              for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                  if ($counter == $page)
                      $pagination .= "<li><a  href=\"javascript:void(0)\" class=\"act\">$counter</a></li>";
                  else
                      $pagination .= "<li><a href=\"javascript:void(0)\" onclick=\"return doPagingSearch($counter)\">$counter</a></li>";
              }
          }
      }
      if ($page < $counter - 1)
          $pagination .= "<li><a href=\"javascript:void(0)\" onclick=\"return doPagingSearch($next)\">Next </a></li>";
      else
          $pagination .= "<li><a href=\"javascript:void(0)\">Next </a></li>";
      $pagination .= "</ul>\n";
  }
?>
 