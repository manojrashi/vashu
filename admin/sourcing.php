<?php
include("../include/config.php");
include("../include/functions.php"); 

validate_admin();

?>
<!DOCTYPE html>
<html>
<?php include("head.php"); ?>
<link rel="stylesheet" href="../colorbox/colorbox.css" />
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>
    <script type="text/javascript" src="../include/ckeditor/ckeditor.js"></script>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>Sourcing</h1>
        
      </section>
      <section class="content">
        <div class="box box-primary">
          <form name="productfrm" id="productfrm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">

            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                   <a href="sourcingaddcash-addf.php">Store</a>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                  <div class="form-group">
                   <a href="order-product-addf.php">Vendor</a>
                    </div>
                  </div>
                  
                  
                  </div>
              </div>
            </div>
          </form>
        </div>
      </section>
    </div>
    <?php include("footer.php"); ?>
    <div class="control-sidebar-bg"></div>
  </div>

  <script src="js/jquery-2.2.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/app.min.js"></script>
  <script src="js/demo.js"></script>
  <script src="js/select2.full.min.js"></script>

  <script src="js/jquery.validate.min.js"></script>

  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
  
    <link rel="stylesheet" href="calender/css/jquery-ui.css">
  <script src="calender/js/jquery-ui.js"></script>
  
  <script type="text/javascript">
  $(document).ready(function(){
   $(function() {
    $( "#expiry_date" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange:'<?php echo date('Y')?>:<?php echo date('Y')+5?>',
      dateFormat: "yy-mm-dd",
    });
  });
   
  $("#productfrm").validate();
    $('#category').change(function() {
      var cat_id=$(this).val(); 
      $.ajax({
        url:"getBrand.php",
        data:{cat_id:cat_id},
        beforeSend:function(){
        $("#brand_id").html('<option value="">Select Brand</option>');
        },
        success:function(data){
          ///console.log(data);
          $("#brand_id").append(data);
        }
      })
    })


  $('#brand_id').change(function() {
    var cat_id=$('#category').val(); 
    var brand_id=$(this).val(); 
    $.ajax({
    url:"getOrderProductName.php",
      data:{cat_id:cat_id,brand_id:brand_id},
      beforeSend:function(){
      $("#product_name_id").html('<option value="">Select Product</option>');
      },
      success:function(data){
      $("#product_name_id").append(data);
      }
    })
  })

    $('#product_name_id').change(function() {
      var cat_id=$('#category').val(); 
      var brand_id=$('#brand_id').val(); 
      var p_id=$(this).val(); 
      $.ajax({
        url:"getOrderProductSize.php",
        data:{cat_id:cat_id,brand_id:brand_id,p_id:p_id},
        beforeSend:function(){
        $("#size_id").html('<option value="">Select Size</option>');
        $("#vendor_id").html('<option value="">Select Vendor</option>');
        },
        success:function(data){
        mydata = data.split("##");
        $("#size_id").append(mydata[0]);
        $("#vendor_id").append(mydata[1]);
        }
      })
    })

    $('#size_id').change(function() {
      var prod_id=$("#product_name_id").val(); 
      var p_id=$(this).val(); 
      $.ajax({
        url:"getProductDetail.php",
        data:{prod_id:prod_id,p_id:p_id},
        beforeSend:function(){
        $("#unit_id").html('<option value="">Select Unit</option>');
        },
        success:function(data){
        //alert(data);
        //console.log(data);
        mydata = data.split("##");
        $("#unit_id").val(mydata[0]);
        $("#mrp_price").val(mydata[1]);
        $("#price_id").val(mydata[4]);
        }

      })
    })

})
    $(".select2").select2();

  </script> 

</div> 

</body>


</html>


