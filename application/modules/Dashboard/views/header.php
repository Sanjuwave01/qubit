<?php
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off") {
	$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: ' . $redirect);
	exit();
}
$user_info = userinfo();
$bankinfo = bankinfo();
$mynews = mynews();
$none = 0;
$apiUrl = 'https://admin.republicexchange.io/api/p2p/live-amount-tracking?coin=RVC';
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="<?php echo title; ?>" />
	<meta property="og:title" content="<?php echo title; ?>" />
	<meta property="og:description" content="<?php echo title; ?>" />

	<meta name="format-detection" content="telephone=no">
	<title>Kubit Coin </title>
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('uploads/'); ?>favicon.png">
	<link rel="stylesheet" href="<?php echo base_url('againdashboard/'); ?>vendor/chartist/css/chartist.min.css">
	<link href="<?php echo base_url('againdashboard/'); ?>vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="<?php echo base_url('againdashboard/'); ?>vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="<?php echo base_url('againdashboard/'); ?>css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		body {

			background-size: cover;
			background-position: center;
			background-attachment: fixed;
		}

		.content-body {
			background: #efeff3;
		}



		.deznav {
			background: white !important;
		}

		.panel-heading {
			background: #f5c03b;
			padding: 10px 10px 4px;
			border-radius: 5px;
			margin-bottom: 10px;
		}

		.deznav {

			border-right: 1px #686868 solid;
			/*box-shadow: 5px 2px 7px #ffffff30;*/
		}

		[data-header-position="fixed"] .header {
			background-color: transparent;
		}

		[data-sidebar-position="fixed"][data-layout="vertical"] .nav-header {
			background: white;
			border-bottom: 1px transparent solid;
			border-right: 1px transparent solid;
		}

		.navbar-expand .navbar-nav {
			text-align: right;
			float: right;
			position: absolute;
			right: 0;
		}

		.header .navbar {
			height: 4.4rem;
			/*background: linear-gradient(45deg, #000000, #efa620) !important;*/
		}

		.header .navbar .navbar-collapse {
			background-color: transparent;
		}

		.header-right .header-profile>a.nav-link .header-info span {
			color: black !important;
		}

		.header-right .header-profile img {

			float: left;
			margin-right: 10px;
		}


		.deznav .metismenu>li>a {
			color: #ffff;
		}

		@media (max-width: 1199px) {
			ul.navbar-nav {
				margin-top: 0px !important;
				overflow: hidden;
			}

		}

		@media screen and (max-width: 767px) {
			.deznav {
				background: #000;
			}

			[data-sidebar-position="fixed"][data-layout="vertical"] .nav-header {
				background: transparent;
			}
		}

		@media only screen and (max-width: 575px) {
			.header-right .header-profile>a.nav-link .header-info {
				display: block;
			}
		}

		[data-sidebar-style="overlay"] .deznav .metismenu>li>a {

			color: #fff;

		}

		.deznav .copyright {

			color: #ffff;

		}


		.card {
			background: #fff;
		}

		/*.header .sub-header {
			background-color: #0000006b;
		}*/

		.btn {
			background: #f5c242;
		}

		.deznav .metismenu>li>a svg {
			max-width: 24px;
			max-height: 24px;
			height: 100%;
			margin-right: 5px;
			margin-top: -3px;
			color: #000000;
		}
	</style>
</head>

<body>

	<!--*******************
        Preloader start
    ********************-->
	<div id="preloader">
		<div class="sk-three-bounce">
			<div class="sk-child sk-bounce1"></div>
			<div class="sk-child sk-bounce2"></div>
			<div class="sk-child sk-bounce3"></div>
		</div>
	</div>
	<!--*******************
        Preloader end
    ********************-->

	<!--**********************************
        Main wrapper start
    ***********************************-->
	<div id="main-wrapper">

		<!--**********************************
            Nav header start
        ***********************************-->
		<div class="nav-header">
			<a href="<?php echo base_url('Dashboard/User/'); ?>" class="brand-logo">

				<img style="max-width:56px;margin:0px auto;" src="<?php echo base_url(); ?>uploads/logo.png">
			</a>


		</div>
		<hr>
		<!--**********************************
            Nav header end
        ***********************************-->

		<!--**********************************
            Header start
        ***********************************-->
		<div class="header">
			<div class="header-content">
				<nav class="navbar navbar-expand">
					<div class="collapse navbar-collapse justify-content-between">

						<ul class="navbar-nav header-right main-notification">
							<div class="dropdown-menu dropdown-menu-right">
								<div id="dlab_W_Notification1" class="widget-media dz-scroll p-3 height380">
									<ul class="timeline">
										<li>
											<div class="timeline-panel">
												<div class="media mr-2">
													<img alt="image" width="50" src="images/avatar/1.jpg">
												</div>
												<div class="media-body">
													<h6 class="mb-1">Dr sultads Send you Photo</h6>
													<small class="d-block">29 July 2020 - 02:26 PM</small>
												</div>
											</div>
										</li>
										<li>
											<div class="timeline-panel">
												<div class="media mr-2 media-info">
													KG
												</div>
												<div class="media-body">
													<h6 class="mb-1">Resport created successfully</h6>
													<small class="d-block">29 July 2020 - 02:26 PM</small>
												</div>
											</div>
										</li>
										<li>
											<div class="timeline-panel">
												<div class="media mr-2 media-success">
													<i class="fa fa-home"></i>
												</div>
												<div class="media-body">
													<h6 class="mb-1">Reminder : Treatment Time!</h6>
													<small class="d-block">29 July 2020 - 02:26 PM</small>
												</div>
											</div>
										</li>
										<li>
											<div class="timeline-panel">
												<div class="media mr-2">
													<img alt="image" width="50" src="images/avatar/1.jpg">
												</div>
												<div class="media-body">
													<h6 class="mb-1">Dr sultads Send you Photo</h6>
													<small class="d-block">29 July 2020 - 02:26 PM</small>
												</div>
											</div>
										</li>
										<li>
											<div class="timeline-panel">
												<div class="media mr-2 media-danger">
													KG
												</div>
												<div class="media-body">
													<h6 class="mb-1">Resport created successfully</h6>
													<small class="d-block">29 July 2020 - 02:26 PM</small>
												</div>
											</div>
										</li>
										<li>
											<div class="timeline-panel">
												<div class="media mr-2 media-primary">
													<i class="fa fa-home"></i>
												</div>
												<div class="media-body">
													<h6 class="mb-1">Reminder : Treatment Time!</h6>
													<small class="d-block">29 July 2020 - 02:26 PM</small>
												</div>
											</div>
										</li>
									</ul>
								</div>
								<a class="all-notification" href="javascript:void(0)">See all notifications <i class="ti-arrow-right"></i></a>
							</div>
							</li>

							<li class="nav-item dropdown header-profile">
								<div class="nav-control">
									<div class="hamburger">
										<span class="line"></span><span class="line"></span><span class="line"></span>
									</div>
								</div>
							</li>

							<li class="nav-item dropdown header-profile">
								<a class="nav-link" href="#" role="button" data-toggle="dropdown">
									<!-- <img alt="" src="<?php //echo base_url('uploads/' . $bankinfo->profile_image); 
															?>" class=""> -->
									<div class="header-info">
										<!-- <span><? php // echo $user_info->name; 
													?></span> -->
										<span>Ricaverse </span>
									</div>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<a href="<?php echo base_url('Dashboard/Profile'); ?>" class="dropdown-item ai-icon">
										<svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
											<circle cx="12" cy="7" r="4"></circle>
										</svg>
										<span class="ml-2">Profile </span>
									</a>
									<a href="<?php echo base_url('Dashboard/Support/Inbox'); ?>" class="dropdown-item ai-icon">
										<svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
											<polyline points="22,6 12,13 2,6"></polyline>
										</svg>
										<span class="ml-2">Inbox </span>
									</a>
									<a href="<?php echo base_url('Dashboard/User/logout'); ?>" class="dropdown-item ai-icon">
										<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
											<polyline points="16 17 21 12 16 7"></polyline>
											<line x1="21" y1="12" x2="9" y2="12"></line>
										</svg>
										<span class="ml-2">Logout </span>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>


		<div class="deznav">
			<div class="deznav-scroll">
				<div class="main-profile">
					<div class="image-bx d-none">
						<!-- <img src="<?php echo base_url('uploads/' . $bankinfo->profile_image); ?>" alt=""> -->
						<a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a>
					</div>
					<h5 class="name"><span class="font-w400">Hello,</span> <?php echo $user_info->name; ?></h5>
					<p class="email">Member id: <?php echo $user_info->user_id; ?></p>
				</div>
				<ul class="metismenu" id="menu">
					<!-- <li class="nav-label first">Main Menu</li> -->
					<li><a href="<?php echo base_url('Dashboard/User/'); ?>" aria-expanded="false">

							<span class="nav-text">Dashboard</span>
						</a>


					</li>

					<!-- <li class="nav-label">Profile</li> -->
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-077-menu-1"></i>
							<span class="nav-text">Profile</span>
						</a>
						<ul aria-expanded="false">

							<li><a href="<?php echo base_url('Dashboard/Profile'); ?>">Edit Profile</a></li>
							<li><a href="<?php echo base_url('Dashboard/Profile/zilUpdate'); ?>">Edit Wallet Address</a></li>
							<li><a href="<?php echo base_url('Dashboard/Profile/changePassword'); ?>">Reset Password</a></li>



						</ul>
					</li>

					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-061-puzzle"></i>
							<span class="nav-text">Staking</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="<?php echo base_url('Dashboard/Activation'); ?>">Stake Now</a></li>
						<!--	<li><a href="<?php //echo base_url('Dashboard/Fund/request_fund'); ?>">Direct Stake</a></li>-->
							<li><a href="<?php echo base_url('Dashboard/Reports/Stackinghistory') ?>">Staking History (18 , 36)</a></li>
   							<li><a href="<?php echo base_url('Dashboard/Reports/Stackinghistory20') ?>">Staking History (20) </a></li>
							<li><a href="<?php echo base_url('Dashboard/Reports/incomesHolding') ?>">Staking Ledger</a></li>


						</ul>
					</li>
					<!-- <li class="nav-label">Team Business</li> -->
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-003-diamond"></i>
							<span class="nav-text">Partner Details</span>
						</a>
						<ul aria-expanded="false">

							<li><a href="<?php echo base_url('Dashboard/User/Tree/' . $user_info->user_id); ?>">My Partner Tree</a></li>
							<li><a href="<?php echo base_url('Dashboard/User/directs/'); ?>">My Partner </a></li>

							<li><a href="<?php echo base_url('Dashboard/Network/levelView'); ?>">Level Report</a></li>
                          <li><a href="<?php echo base_url('Dashboard/User/rankachiever'); ?>">Rank Achiever</a></li>
							<li><a href="<?php echo base_url('Dashboard/Reports/DirectReport'); ?>">Business Reports</a></li>




						</ul>
					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-053-heart"></i>
							<span class="nav-text">Statement</span>

						</a>
						<ul aria-expanded="false">

							<?php
							$incomes = incomes();
							foreach ($incomes as $key => $inc) :
							?>
								<li><a href="<?php echo base_url('Dashboard/Reports/incomes/' . $key); ?>"><?php echo $inc; ?></a></li>
							<?php
							endforeach;
							?>
							<li><a href="<?php echo base_url('Dashboard/Reports/incomesLedger') ?>">Working Statement</a></li>
						
							<!-- <li><a href="<?php echo base_url('Dashboard/Reports/payout_summary') ?>">Payout Summary</a></li> -->



						</ul>
					</li>


					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-coins"></i>
							<span class="nav-text">Fund Manager</span>
						</a>
						<ul aria-expanded="false">
							<!-- <li><a href="<?php echo base_url('Dashboard/Depositfund') ?>">Deposit Fund</a></li> -->
							<!-- <li><a href="<?php echo base_url('Dashboard/Fund/Request_fund') ?>">Deposit Fund</a></li> -->
							<li><a href="<?php echo base_url('Dashboard/Fund/requests') ?>">Fund Request History</a></li>
							<!--<li><a href="<?php echo base_url('Dashboard/Fund/income_to_ewallet') ?>">Income To E-Wallet</a></li>-->

							<!--<li><a href="<?php //echo base_url('Dashboard/Fund/Transfer_fund') ?>">Transfer Topup Wallet</a></li>-->
							<li><a href="<?php echo base_url('Dashboard/Reports/TopuptHistory') ?>">Transfer Topup History</a></li>
							<!-- <li><a href="<?php echo base_url('Dashboard/Addpyc') ?>">Addpyc</a></li> -->
							<!-- <li><a href="<?php echo base_url('Dashboard/Deposit_bnb') ?>">Deposit_bnb</a></li>
							<li><a href="<?php echo base_url('Dashboard/Deposit_BUSD') ?>">Deposit BUSD</a></li> -->
							<!-- <li><a href="<?php echo base_url('Dashboard/Withdraw_Staking') ?>">Withdraw Staking</a></li>
							<li><a href="<?php echo base_url('Dashboard/Withdraw_Working') ?>">Withdraw Working</a></li> -->
							<li><a href="<?php echo base_url('Dashboard/DirectIncomeWithdraw') ?>">Withdrawal Fund Wallet</a></li>
							<li><a href="<?php echo base_url('Dashboard/DirectIncomeWithreward') ?>">Withdrawal Staking Reward Wallet</a></li>
							<li><a href="<?php echo base_url('Dashboard/withdraw_history') ?>">Withdrawal History</a></li>
                          <li><a href="<?php echo base_url('Dashboard/stakinghistory') ?>">Withdrawal Staking History</a></li>
							<!-- <li><a href="<?php echo base_url('Dashboard/Sell_PYC') ?>">Sell PYC</a></li> -->
						</ul>
					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-network"></i>
							<span class="nav-text">Support</span>
						</a>
						<ul aria-expanded="foxlse">
							<li><a href="<?php echo base_url('Dashboard/Support/ComposeMail'); ?>"> Create Ticket</a></li>
							<li><a href="<?php echo base_url('Dashboard/Support/Inbox'); ?>"> Inbox</a></li>
							<li><a href="<?php echo base_url('Dashboard/Support/Outbox'); ?>"> Outbox</a></li>
						</ul>
					</li>
					<li><a class="has-arrow ai-icon" href="<?php echo base_url('Dashboard/User/logout'); ?>" aria-expanded="false">
							<i class="flaticon-049-copy"></i>
							<span class="nav-text">Logout</span>
						</a>

					</li>
				</ul>
				<div class="copyright">
					<p><strong>Kubit Coin </strong> © 2023 All Rights Reserved</p>

				</div>
			</div>
		</div>