	<nav class="navbar navbar-default">
		<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
       
          </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
				<?php
					if (empty($_SESSION['user_id']) AND empty($_SESSION['user_password']))
						echo "<li><a href=\"index.php\">Home </a></li>";
					else
					{
						if($_SESSION[user_level] == "admin")
						{
				?>				
							<li><a href="dashboard.php"><img src='icon/home.png' /> Utama </a></li>
							<li><a href="manage_customer.php"><img src='icon/customer.png' /> Pelanggan</a></li>
							<li>
							  <div class="container-fluid">                                       
								  <p><div class="dropdown">
									<button class="btn btn-blue btn-sm dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><img src='icon/fabric.png' /> Kain
									<span class="caret"></span></button>
									<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
										<li role="presentation"><a role="menuitem" tabindex="-1" href="manage_fabric.php">Senarai Kain</a></li>
									  <li role="presentation"><a role="menuitem" tabindex="-1" href="add_fabric.php">Tambah Jenis Kain</a></li>
									</ul>
								  </div></p>
								</div>
							</li>
							<li><a href="admin_manage_order.php"><img src='icon/order.png' /> Senarai Tempahan</a></li>
							<li><a href="logout.php"><img src='icon/logout.png' /> Log keluar</a></li>
				<?php 	}
						else if($_SESSION[user_level] == "customer")
						{
				?>
							<li><a href="dashboard.php"><img src='icon/home.png' /> Utama </a></li>
							<li><a href="change_password.php"><img src='icon/password.png' /> Tukar Kata Laluan</a></li>
							<li><a href="update_profile.php"><img src='icon/customer.png' /> Kemaskini Profail</a></li>
							<li>
							  <div class="container-fluid">                                       
								  <p><div class="dropdown">
									<button class="btn btn-blue btn-sm dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><img src='icon/garment.png' /> Ukuran
									<span class="caret"></span></button>
									<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
										<li role="presentation"><a role="menuitem" tabindex="-1" href="manage_garment.php">Senarai Ukuran</a></li>
									  <li role="presentation"><a role="menuitem" tabindex="-1" href="add_garment.php">Tambah Ukuran Baru</a></li>
									</ul>
								  </div></p>
								</div>
							</li>
							<li>
							  <div class="container-fluid">                                       
								  <p><div class="dropdown">
									<button class="btn btn-blue btn-sm dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><img src='icon/order.png' /> Tempahan
									<span class="caret"></span></button>
									<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
										<li role="presentation"><a role="menuitem" tabindex="-1" href="manage_order.php">Senarai Tempahan</a></li>
									  <li role="presentation"><a role="menuitem" tabindex="-1" href="place_order.php">Buat Tempahan Baru</a></li>
									</ul>
								  </div></p>
								</div>
							</li>
							<li><a href="logout.php"><img src='icon/logout.png' /> Log Keluar</a></li>
				<?php	}
					} ?>
            </ul>
      
        </div>
      </div><!-- /.navbar-collapse -->
    </nav>