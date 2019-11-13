<?php
$uArr=$obj->query("select roles from $tbl_admin where id='".$_SESSION['sess_admin_id']."' ");
$rsU=$obj->fetchNextObject($uArr);
$myRols=explode(",",$rsU->roles); 
?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="images/avatar.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo ucfirst($_SESSION['sess_admin_username']); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <?php if(in_array(1,$myRols) || in_array(2,$myRols) || in_array(3,$myRols) || in_array(4,$myRols) || in_array(5,$myRols)){ ?>
        <li class="treeview <?php echo  (basename($_SERVER['SCRIPT_NAME'])=='banner-list.php' || basename($_SERVER['SCRIPT_NAME'])=='banner-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='unit-list.php' || basename($_SERVER['SCRIPT_NAME'])=='unit-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='social-list.php' || basename($_SERVER['SCRIPT_NAME'])=='social-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='order_status-list.php' || basename($_SERVER['SCRIPT_NAME'])=='update-setting.php' || basename($_SERVER['SCRIPT_NAME'])=='fiesta-banner-list.php' || basename($_SERVER['SCRIPT_NAME'])=='fiesta-banner-addf.php')?'active' :'' ?>">
          <a href="javascript:void(0);">
            <i class="fa fa-cogs"></i> <span>Admin Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <?php if(in_array(1,$myRols)){ ?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='banner-list.php' || basename($_SERVER['SCRIPT_NAME'])=='banner-addf.php')?'active' :'' ?>"><a href="banner-list.php"><i class="fa fa-circle-o"></i>Manage Banners</a></li>
            <?php }?>
            <?php if(in_array(2,$myRols)){ ?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='fiesta-banner-list.php' || basename($_SERVER['SCRIPT_NAME'])=='fiesta-banner-addf.php')?'active' :'' ?>"><a href="fiesta-banner-list.php"><i class="fa fa-circle-o"></i>Manage Fiesta Banners</a></li>
            <?php }?>
            <?php if(in_array(3,$myRols)){ ?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='social-list.php' || basename($_SERVER['SCRIPT_NAME'])=='social-addf.php')?'active' :'' ?>"><a href="social-list.php"><i class="fa fa-circle-o"></i>Manage Social Links</a></li>
            <?php }?>
            <?php if(in_array(4,$myRols)){ ?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='unit-list.php' || basename($_SERVER['SCRIPT_NAME'])=='unit-addf.php')?'active' :'' ?>"><a href="unit-list.php"><i class="fa fa-circle-o"></i>Manage Unit</a></li>
            <?php }?>
            <?php if(in_array(5,$myRols)){ ?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='update-setting.php')?'active' :'' ?>"><a href="update-setting.php"><i class="fa fa-circle-o"></i>Update Setting</a></li>
            <?php }?>
          </ul>
        </li>
      <?php }?>
      <?php if(in_array(6,$myRols)){ ?>
        <li class="treeview <?php echo (basename($_SERVER['SCRIPT_NAME'])=='coupon-list.php' || basename($_SERVER['SCRIPT_NAME'])=='coupon-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='voucher-list.php' || basename($_SERVER['SCRIPT_NAME'])=='voucher-addf.php')?'active' :'' ?>">
          <a href="javascript:void(0);">
            <i class="fa fa-recycle"></i>
            <span>Manage Offer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(in_array(6,$myRols)){ ?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='coupon-list.php' || basename($_SERVER['SCRIPT_NAME'])=='coupon-addf.php')?'active' :'' ?>"><a href="coupon-list.php"><i class="fa fa-circle-o"></i>Manage Coupons</a></li>
            <?php }?>

          </ul>
        </li>
      <?php }?>
      <?php if(in_array(7,$myRols) || in_array(8,$myRols) || in_array(9,$myRols) || in_array(10,$myRols)){ ?>
        <li class="treeview <?php echo (basename($_SERVER['SCRIPT_NAME'])=='category-list.php' || basename($_SERVER['SCRIPT_NAME'])=='category-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='subcategory-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='subcategory-list.php' || basename($_SERVER['SCRIPT_NAME'])=='brand-list.php' || basename($_SERVER['SCRIPT_NAME'])=='brand-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='brand-edit.php' || basename($_SERVER['SCRIPT_NAME'])=='product-list.php' || basename($_SERVER['SCRIPT_NAME'])=='product-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='productprice-list.php' || basename($_SERVER['SCRIPT_NAME'])=='productprice-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='product-localprice-list.php')?'active' :'' ?>">
          <a href="javascript:void(0);">
            <i class="fa fa-university"></i>
            <span>Manage Catalog</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(in_array(7,$myRols)){ ?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='category-list.php' || basename($_SERVER['SCRIPT_NAME'])=='category-addf.php')?'active' :'' ?>"><a href="category-list.php"><i class="fa fa-circle-o"></i>Manage Category</a></li>
            <?php }?>
            <?php if(in_array(8,$myRols)){ ?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='subcategory-list.php' || basename($_SERVER['SCRIPT_NAME'])=='subcategory-addf.php')?'active' :'' ?>"><a href="subcategory-list.php"><i class="fa fa-circle-o"></i>Manage Sub Category</a></li>
            <?php }?>
            <?php if(in_array(9,$myRols)){ ?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='brand-list.php' || basename($_SERVER['SCRIPT_NAME'])=='brand-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='brand-edit.php')?'active' :'' ?>"><a href="brand-list.php"><i class="fa fa-circle-o"></i>Manage Brand</a></li>
            <?php }?>
            <?php if(in_array(10,$myRols)){ ?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='product-list.php' || basename($_SERVER['SCRIPT_NAME'])=='product-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='productprice-list.php' || basename($_SERVER['SCRIPT_NAME'])=='productprice-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='productstock-list.php')?'active' :'' ?>"><a href="product-list.php"><i class="fa fa-circle-o"></i>Manage Products</a></li>
            <?php }?>
          </ul>
        </li>
      <?php }?>
      <?php if(in_array(11,$myRols)){?>
        <li class="treeview <?php echo (basename($_SERVER['SCRIPT_NAME'])=='user-list.php' || basename($_SERVER['SCRIPT_NAME'])=='user-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='useraddress-list.php')?'active' :'' ?>">
          <a href="javascript:void(0);">
            <i class="fa fa-users"></i>
            <span>Manage Customer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(in_array(11,$myRols)){?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='user-list.php' || basename($_SERVER['SCRIPT_NAME'])=='user-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='useraddress-list.php')?'active' :'' ?>"><a href="user-list.php"><i class="fa fa-circle-o"></i>Manage Customer</a></li>
            <?php }?>

          </ul>
        </li>
      <?php }?>

      <?php if(in_array(12,$myRols) || in_array(13,$myRols) || in_array(14,$myRols) || in_array(15,$myRols)){?>
        <li class="treeview <?php echo (basename($_SERVER['SCRIPT_NAME'])=='order-active-list.php' || basename($_SERVER['SCRIPT_NAME'])=='order-delivered-list.php' || basename($_SERVER['SCRIPT_NAME'])=='order-all-list.php' || basename($_SERVER['SCRIPT_NAME'])=='order-onhold-list.php' || basename($_SERVER['SCRIPT_NAME'])=='order-cancelled-list.php' || basename($_SERVER['SCRIPT_NAME'])=='order-return-list.php' || basename($_SERVER['SCRIPT_NAME'])=='order-product-delete-list.php')?'active' :'' ?>">
          <a href="javascript:void(0);">
            <i class="fa fa-area-chart"></i>
            <span>Manage Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(in_array(12,$myRols)){?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='order-active-list.php')?'active' :'' ?>"><a href="order-active-list.php"><i class="fa fa-circle-o"></i>New Orders (<?php echo $obj->numRows($obj->query("select id from $tbl_order where order_status in (1,2)")) ?>)</a></li>
            <?php }?>
            <?php if(in_array(13,$myRols)){?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='order-delivered-list.php')?'active' :'' ?>"><a href="order-delivered-list.php"><i class="fa fa-circle-o"></i>Order Delivered (<?php echo $obj->numRows($obj->query("select id from $tbl_order where order_status=3")) ?>)</a></li>
            <?php }?>
            <?php if(in_array(14,$myRols)){?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='order-cancelled-list.php')?'active' :'' ?>"><a href="order-cancelled-list.php"><i class="fa fa-circle-o"></i>Order Cancelled (<?php echo $obj->numRows($obj->query("select id from $tbl_order where order_status=4")) ?>)</a></li>
            <?php }?>
            <?php if(in_array(15,$myRols)){?>
              <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='order-all-list.php')?'active' :'' ?>"><a href="order-all-list.php"><i class="fa fa-circle-o"></i>All Orders (<?php echo $obj->numRows($obj->query("select id from $tbl_order where 1=1")) ?>)</a></li>
            <?php }?>
          </ul>
        </li>
      <?php }?>
      <?php if(in_array(16,$myRols)){?>
        <li class="treeview <?php echo (basename($_SERVER['SCRIPT_NAME'])=='vender-list.php' || basename($_SERVER['SCRIPT_NAME'])=='vender-addf.php')?'active' :'' ?>">
          <a href="javascript:void(0);">
            <i class="fa fa-vimeo-square"></i>
            <span>Manage Vendor</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
               <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='vender-list.php' || basename($_SERVER['SCRIPT_NAME'])=='vender-addf.php')?'active' :'' ?>"><a href="vender-list.php"><i class="fa fa-circle-o"></i>Manage Vendor</a></li>
         </ul>
        </li>
      <?php }?>
      <?php if(in_array(17,$myRols)){?>
        <li class="treeview <?php echo (basename($_SERVER['SCRIPT_NAME'])=='admin-list.php' || basename($_SERVER['SCRIPT_NAME'])=='admin-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='manage_roles.php')?'active' :'' ?>">
          <a href="javascript:void(0);"><i class="fa fa-user"></i><span>Manage Admin</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
          <ul class="treeview-menu">
            <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='admin-list.php' || basename($_SERVER['SCRIPT_NAME'])=='admin-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='manage_roles.php')?'active' :'' ?>"><a href="admin-list.php"><i class="fa fa-circle-o"></i>Manage Admin</a></li>

          </ul>
        </li>
      <?php }?>
      <?php if(in_array(18,$myRols)){?>
        <li class="treeview <?php echo (basename($_SERVER['SCRIPT_NAME'])=='content-list.php' || basename($_SERVER['SCRIPT_NAME'])=='content-addf.php')?'active' :'' ?>">
          <a href="javascript:void(0);">
            <i class="fa fa-pagelines"></i>
            <span>Manage Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='content-list.php' || basename($_SERVER['SCRIPT_NAME'])=='content-addf.php')?'active' :'' ?>"><a href="content-list.php"><i class="fa fa-circle-o"></i>Manage Pages</a></li>
          </ul>
        </li>
      <?php }?>
      <?php if(in_array(19,$myRols)){?>
        <li class="treeview <?php echo (basename($_SERVER['SCRIPT_NAME'])=='news-list.php' || basename($_SERVER['SCRIPT_NAME'])=='news-addf.php')?'active' :'' ?>">
          <a href="javascript:void(0);">
            <i class="fa fa-pagelines"></i>
            <span>Manage News</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='news-list.php' || basename($_SERVER['SCRIPT_NAME'])=='news-addf.php')?'active' :'' ?>"><a href="news-list.php"><i class="fa fa-circle-o"></i>Manage News</a></li>
          </ul>
        </li>
      <?php }?>

       <?php if(in_array(20,$myRols)){?>
        <li class="treeview <?php echo (basename($_SERVER['SCRIPT_NAME'])=='faqcat-list.php'||basename($_SERVER['SCRIPT_NAME'])=='faqcat-addf.php' ||basename($_SERVER['SCRIPT_NAME'])=='faq-list.php' ||basename($_SERVER['SCRIPT_NAME'])=='faq-addf.php' )?'active' :'' ?>">
          <a href="javascript:void(0);">
            <i class="fa fa-pagelines"></i>
            <span>Manage FAQs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='faqcat-list.php' || basename($_SERVER['SCRIPT_NAME'])=='faqcat-addf.php')?'active' :'' ?>"><a href="faqcat-list.php"><i class="fa fa-circle-o"></i>Manage FAQs Categories</a></li>
            <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='faq-list.php' || basename($_SERVER['SCRIPT_NAME'])=='faq-addf.php')?'active' :'' ?>"><a href="faq-list.php"><i class="fa fa-circle-o"></i>Manage FAQs</a></li>
          </ul>
        </li>
      <?php }?>


    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
