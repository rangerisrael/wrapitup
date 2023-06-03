<div class="navbar navbar-expand-lg navbar-dark navbar-static">

		<div class="navbar-brand text-center text-lg-left">
			<a href="javascript:void(0)" class="d-inline-block">
				<img src="../assets/image/wrapitup-logo.jpg" class="d-none d-sm-block" alt="Logo">
				<img src="../assets/image/wrapitup-logo.jpg" class="d-sm-none" alt="Logo">
			</a>
		</div>

		<div class="collapse navbar-collapse order-2 order-lg-1" id="navbar-mobile">
		
		</div>

		<ul class="navbar-nav flex-row order-1 order-lg-2 flex-1 flex-lg-0 justify-content-end align-items-center">

			<li class="nav-item nav-item-dropdown-lg dropdown dropdown-user h-100">
				<a href="#" class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle d-inline-flex align-items-center h-100" data-toggle="dropdown">
					<img src="assets/images/placeholders/placeholder.jpg" class="rounded-pill mr-lg-2" height="34" alt="">
					<span class="d-none d-lg-inline-block"><?=$user['firstname'].' '.$user['surname']?></span>
				</a>

				<div class="dropdown-menu dropdown-menu-right">
					<!-- <div class="dropdown-divider"></div> -->
					<a href="?logout=true" class="dropdown-item">Logout</a>
				</div>
			</li>
		</ul>
	</div>