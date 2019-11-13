<div class="left_bar">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default active">
      <div class="panel-heading">
        <a href="vendor-dashboard.php" class="active"> <h4 class="panel-title"> <i class="fa fa-th" aria-hidden="true"><span>DASHBOARD</span></i>  </h4></a>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading <?php if(basename($_SERVER['SCRIPT_NAME'])=='vendor-profile.php'){?> active <?php }?>">
        <a href="vendor-profile.php"><h4 class="panel-title"> <i class="fa fa-user" aria-hidden="true"><span>Update Profiles</span></i>  </h4></a>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading <?php if(basename($_SERVER['SCRIPT_NAME'])=='manage-product.php' || basename($_SERVER['SCRIPT_NAME'])=='product-addf.php'){?> active <?php }?>">
        <a href="manage-product.php"><h4 class="panel-title"><i class="fa fa-book" aria-hidden="true"><span style="margin-left: 7px;"> Manage Product </span></i>  </h4></a>
      </div>
    </div>
<!--     <div class="panel panel-default">
      <div class="panel-heading <?php if(basename($_SERVER['SCRIPT_NAME'])==''){?> active <?php }?>">
        <a href="javascript:void(0);"><h4 class="panel-title"><i class="fa fa-book" aria-hidden="true"><span style="margin-left: 7px;"> My Order </span></i>  </h4></a>
      </div>
    </div> -->
    <div class="panel panel-default">
      <div class="panel-heading <?php if(basename($_SERVER['SCRIPT_NAME'])=='vendor-change-password.php'){?> active <?php }?>">
        <a href="vendor-change-password.php"><h4 class="panel-title"> <i class="fa fa-key" aria-hidden="true"><span style="margin-left: 7px;"> Change Password</span></i>  </h4></a>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <a href="logout.php"><h4 class="panel-title11"> <i class="fa fa-sign-in" aria-hidden="true"><span style="margin-left: 12px;">Logout</span></i> </h4></a> 
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
  var fileobj;
  function upload_file(e) {
    e.preventDefault();
    fileobj = e.dataTransfer.files[0];
    ajax_file_upload(fileobj);
  }

  function file_explorer() {
    document.getElementById('selectfile').click();
    document.getElementById('selectfile').onchange = function() {
      fileobj = document.getElementById('selectfile').files[0];
      ajax_file_upload(fileobj);
    };
  }

  function ajax_file_upload(file_obj) {
    if(file_obj != undefined) {
      var form_data = new FormData();                  
      form_data.append('file', file_obj);
      $.ajax({
        type: 'POST',
        url: 'ajax/vendor_profile_image_upload.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
          $('#set_images').html(response);
          $('.add-site').html(response);
          $('#selectfile').val('');
        }
      });
    }
  }
</script>