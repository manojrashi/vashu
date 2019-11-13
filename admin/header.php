 <header class="main-header">
    <!-- Logo -->
    <a href="welcome.php" class="logo">
      <img src="../images/logo.png" class="user-image" alt="User Image" style="height: 40px; width: 200px;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?php echo SITE_TITLE; ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo SITE_TITLE; ?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

           <li class="dropdown user user-menu">
              
              
              <a href="../index" target="_blank"><img src="images/computer.png" class="user-image" alt="User Image"> <span class="hidden-xs">Visit Website</span></a>
            
           </li>

          <li class="dropdown user user-menu">
            <a href="welcome.php" class="dropdown-toggle" data-toggle="dropdown">
              <img src="images/avatar.png" class="user-image" alt="User Image">
              <span class="hidden-xs">
                <?php echo ucfirst($_SESSION['sess_admin_username']); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="images/avatar.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo ucfirst($_SESSION['sess_admin_username']); ?>
                  <small>Member since <?php echo date("l,F  d"); ?></small>
                </p>
              </li>
              <li class="user-footer">
                
                <div class="pull-left">
                  <a href="change-password.php" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>