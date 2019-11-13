<header>
  <div class="topmain">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 text-right">
          <div class="sociallink">
            <ul>
            <?php if(getField('status',$tbl_social,1)==1){?>
              <li><a href="<?php  echo getField('social_url',$tbl_social,1); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <?php }?>
            <?php if(getField('status',$tbl_social,2)==1){?>
              <li><a href="<?php  echo getField('social_url',$tbl_social,2); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <?php }?>
            <?php if(getField('status',$tbl_social,4)==1){?>
              <li><a href="<?php  echo getField('social_url',$tbl_social,4); ?>" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
            <?php }?>
            <?php if(getField('status',$tbl_social,5)==1){?>
              <li><a href="<?php  echo getField('social_url',$tbl_social,5); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            <?php }?>
            <?php if(getField('status',$tbl_social,6)==1){?>
              <li><a href="<?php  echo getField('social_url',$tbl_social,6); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            <?php }?>
            <?php if(getField('status',$tbl_social,1)==1){?>
              <li><a href="<?php  echo getField('social_url',$tbl_social,1); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
            <?php }?>
            <?php if(getField('status',$tbl_social,3)==1){?>
              <li><a href="<?php  echo getField('social_url',$tbl_social,3); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
            <?php }?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<section>
  <div class="toplogomain">
    <div class="container">
      <div class="col-xs-12 col-sm-6 logomain"><a href="<?php echo SITE_URL; ?>"><img src="images/logo.png" class="img-responsive"></a></div>
      <div class="col-xs-12 col-sm-6 callus">
        <?php
        if($_SESSION['user_id']==''){?>
          <a href="#" type="button" data-toggle="modal" data-target="#myModal1">Register </a>
          <a href="social_login/login.php?type=google" type="button" data-toggle="modal" data-target="#myModal">login</a>
        <?php }else{?>
          <a href="dashboard.php" type="button"><?php echo $_SESSION['user_name']; ?></a>
        <?php } ?>
        <img src="images/cart.png" class="img-responsive cart_anchor" onclick="window.location='cart.php'" style="cursor: pointer;">
        <?php  
        $itmes=$cart->get_contents();
        $no_of_itmes=count($itmes);?>
        <span id="c_itmes"><?php echo $cart->itemcount; ?></span>
        </div>
    </div>
  </div>
</section>

<section id="services">
  <div class="container center">
    <form name="headersearchfrm" id="headersearchfrm" action="listing.php">
    <div class="col-xs-12 col-sm-12">
      <input type="text" name="pname" id="pname" placeholder="<?php echo $productName; ?>" value="<?php echo $_REQUEST['pname']; ?>" />
      <select name="cat_id" id="cat_id">
        <option value="">Select Category</option>
        <?php
          $cat_id=$_REQUEST['cat_id']; //die;

          $catSql = $obj->query("select * from $tbl_category where status=1");
          while($catResult = $obj->fetchNextObject($catSql)){?>
            <option value="<?php echo $catResult->id; ?>" <?php if($_REQUEST['cat_id']==$catResult->id){?> selected <?php } ?>><?php echo $catResult->category ?></option>
          <?php }?>    
      </select>
      <select name="subcat_id" id="subcat_id">
        <option value="">Select Sub Category</option>
        <?php 
        if($_REQUEST['cat_id']!=''){
            $scatSql = $obj->query("select * from $tbl_subcategory where status=1 and cat_id='".$_REQUEST['cat_id']."'");
            while($scatResult = $obj->fetchNextObject($scatSql)){?>
            <option value="<?php echo $scatResult->id; ?>" <?php if($_REQUEST['subcat_id']==$scatResult->id){?> selected <?php } ?>><?php echo $scatResult->subcategory; ?></option>
            <?php }
         } ?>
      </select>
      <select name="brand_id" id="brand_id">
        <option value="">Select Brand</option>
        <?php 
        if($_REQUEST['subcat_id']!=''){
            $brandSql = $obj->query("select * from $tbl_brand where status=1 and cat_id='".$_REQUEST['subcat_id']."'");
            while($brandResult = $obj->fetchNextObject($brandSql)){?>
            <option value="<?php echo $brandResult->id; ?>" <?php if($_REQUEST['brand_id']==$brandResult->id){?> selected <?php } ?>><?php if($_SESSION['lang']=='en'){ echo $brandResult->brand_en; }else{ echo $brandResult->brand_ar; } ?></option>
            <?php }
         } ?>
      </select>
      <button>Search</button>
    </div>
  </form>
  </div>
</section>
<script src="admin/js/jquery-2.2.3.min.js"></script>