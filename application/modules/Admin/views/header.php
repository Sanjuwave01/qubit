<?php 
    $guard = $this->session->userdata['guard'];

    if(empty($guard)){
        redirect('Admin/Management/logout');
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Kubit Coin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="icon" href="<?php echo base_url('NewDashboard/');?>assets/images/favicon.png">
    <link href="<?php echo base_url('NewDashboard/') ?>assets/libs/chartist/chartist.min.css" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/bootstrap.min.css" id="bootstrap-style"
        rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet"
        type="text/css" />
   <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet"
        type="text/css" />

</head>
<style>
.navbar-header {
    background: black;
}
</style>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">


                        <a href="<?php echo base_url('Admin/Management/'); ?>" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="<?php echo base_url('uploads/logo.png');?>" alt="" style="max-width:50px;">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url('uploads/logo.png');?>" alt="" style="max-width:50px;">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="mdi mdi-menu"></i>
                    </button>

                </div>

                <div class="d-flex">
                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="fa fa-search"></span>
                        </div>
                    </form>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="<?php echo base_url();?>uploads/id_proof1646378107.jpeg" alt="Header Avatar">
                            Admin
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-account-circle font-size-17 align-middle mr-1"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-wallet font-size-17 align-middle mr-1"></i> My Wallet</a>
                            <a class="dropdown-item d-block" href="#"><span
                                    class="badge badge-success float-right">11</span><i
                                    class="mdi mdi-settings font-size-17 align-middle mr-1"></i> Settings</a>
                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-lock-open-outline font-size-17 align-middle mr-1"></i> Lock
                                screen</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger"
                                href="<?php echo base_url('Admin/Management/logout'); ?>"><i
                                    class="bx bx-power-off font-size-17 align-middle mr-1 text-danger"></i> Logout</a>
                        </div>
                    </div>

                    <div class="dropdown d-none">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="mdi mdi-settings-outline"></i>
                        </button>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">
                <a href="<?php echo base_url('Admin/Management/'); ?>" class="brand-link" style="">


                </a>

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Main</li>

                        <li>
                            <a href="<?php echo base_url('Admin/Management/'); ?>" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span> User Details</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?php echo base_url('Admin/Withdraw/Stackinghistory/'); ?>">Staking
                                        History (18 , 36)</a></li>
                                        <li><a href="<?php echo base_url('Admin/Withdraw/Stackinghistory20/'); ?>">Staking
                                        History (20)</a></li>
                                <li><a href="<?php echo base_url('Admin/Withdraw/incomeHolding/'); ?>">Staking
                                        Ledger</a></li>
                                <li><a href="<?php echo base_url('Admin/Management/users'); ?>">All Members</a></li>
                                <li><a href="<?php echo base_url('Admin/Management/paidUsers'); ?>">Paid Members</a>
                                </li>
                                <li><a href="<?php echo base_url('Admin/roi-details'); ?>">ROI Members</a></li>



                                <!-- <li><a href="<?php //echo base_url('Admin/Management/matrixPoolUsers'); ?>">Matrix Pool View</a></li> -->
                                <!-- <li><a href="<?php //echo base_url('Admin/Management/nextMatrixPoolUsers'); ?>">Next Matrix Pool View</a></li> -->





                                <!-- <li><a href="<?php echo base_url('Admin/Task/silverClub'); ?>">Silver Club Members</a></li>
                                  <li><a href="<?php echo base_url('Admin/Task/GoldClub'); ?>">Gold Club Members</a></li> -->
                                <li><a href="<?php echo base_url('Admin/Management/today_joinings'); ?>">View Today
                                        Joinings</a></li>

                            </ul>
                        </li>
                        <li>
                            <a class="" href="<?php echo base_url('Admin/Withdraw/userIncome') ?>"
                                aria-expanded="false">
                                <i class="ti-package"></i>
                                <span class="nav-text">User Reports</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="<?php echo base_url('Admin/Withdraw/userLevel') ?>" aria-expanded="false">
                                <i class="ti-package"></i>
                                <span class="nav-text">Level Achiever</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="<?php echo base_url('Admin/Withdraw/ManageUserWallet') ?>"
                                aria-expanded="false">
                                <i class="ti-package"></i>
                                <span class="nav-text">Manage User Wallet</span>
                            </a>
                        </li>
                        <li>
                            <a class="" href="<?php echo base_url('Admin/Management/Blogs') ?>" aria-expanded="false">
                                <i class="ti-package"></i>
                                <span class="nav-text">Blogs</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span> Settings</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <!-- <li><a href="<?php //echo base_url('Admin/Settings/setHubRate'); ?>">Set Hub Price</a></li> -->
                                <li><a href="<?php echo base_url('Admin/Settings/token_value'); ?>">Buy Price</a></li>
                                <li><a href="<?php echo base_url('Admin/Settings/sellValue'); ?>">Sell Price</a></li>
                                <li><a href="<?php echo base_url('Admin/Settings/news'); ?>">News</a></li>
                                <li><a href="<?php echo base_url('Admin/Management/popup_upload'); ?>">Upload Popup
                                        Image</a></li>
                                <li><a href="<?php echo base_url('Admin/Settings/popup_upload'); ?>">User Popup
                                        Image</a></li>
                                <!-- <li><a href="<?php //echo base_url('Admin/set-roi'); ?>">Set ROI</a></li> -->
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span> Income Reports</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <?php
                                    $incomes = incomes();
                                    foreach ($incomes as $key => $income) {
                                        echo'<li>
                                    <a href="' . base_url('Admin/Withdraw/income/' . $key) . '">

                                       <p>' . $income . '</p>
                                    </a>
                                 </li>';
                                    }
                                    ?>
                                <li><a href="<?php echo base_url('Admin/Withdraw/incomeLedgar/'); ?>">Income Ledgar</a>
                                </li>
                                <li><a href="<?php echo base_url('Admin/Withdraw/payout_summary/'); ?>">Payout
                                        Summary</a></li>

                                <li><a href="<?php echo base_url('Admin/Management/sendIncome/'); ?>">Credit/Debit
                                        Income</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span>Notifications</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?php echo base_url('Admin/Management/CommingSoon/News'); ?>">News</a></li>

                            </ul>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span>Mail</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?php echo base_url('Admin/Support/inbox'); ?>">Inbox</a></li>
                                <li><a href="<?php echo base_url('Admin/Support/Compose'); ?>">Compose Mail</a></li>
                                <li><a href="<?php echo base_url('Admin/Support/Outbox'); ?>">Outbox</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span>Fund Management</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?php echo base_url('Admin/Management/Fund_requests') ?>">Fund Request List
                                    </a></li>
                                <li><a href="<?php echo base_url('Admin/Management/Fund_requests/1') ?>">Approved Fund
                                        Request List </a></li>
                                <li><a href="<?php echo base_url('Admin/Management/Fund_requests/0') ?>">Pending Fund
                                        Request List </a></li>
                                <li><a href="<?php echo base_url('Admin/Management/Fund_requests/2') ?>">Rejected Fund
                                        Request List </a></li>



                                <li><a href="<?php echo base_url('Admin/Management/SendWallet') ?>">Fund Transfer</a></li>
                              <li><a href="<?php echo base_url('Admin/Management/SendWallet_History') ?>">Fund Transfer History</a></li>
                                <li><a href="<?php echo base_url('Admin/Management/SendCoin') ?>"> Send Coin</a></li>
                                <li><a href="<?php echo base_url('Admin/Report/CoinHistory') ?>"> Coin History</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span>Withdraw Management</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <!-- <li><a href="<?php echo base_url('Admin/Management/BankTransactions') ?>"> Bank Transactions</a></li> -->
								<li><a href="<?php echo base_url('Admin/Withdraw/Dec_Withdraw_Pending') ?>">9 Dec Pending Withdraw
                                        Request</a></li>
                                <li><a href="<?php echo base_url('Admin/Withdraw/Pending') ?>">Pending Withdraw
                                        Request</a></li>
                                <li><a href="<?php echo base_url('Admin/Withdraw/Approved') ?>"> Approved Withdraw
                                        Request</a></li>
                                <!-- <li><a href="<?php echo base_url('Admin/Withdraw/OldApproved') ?>">Old Approved Withdraw Request</a></li> -->
                                <!-- <li><a href="<?php //echo base_url('Admin/Withdraw/Pending') ?>">Pending Withdraw Request</a></li> -->
                                <li><a href="<?php echo base_url('Admin/Withdraw/Rejected') ?>">Rejected Withdraw
                                        Request</a></li>
                              <li><a href="<?php echo base_url('Admin/Withdraw/stakingreward') ?>">Stacking Reward Withdraw Pending</a></li>
                              <li><a href="<?php echo base_url('Admin/Withdraw/stakingrewardapprove') ?>">Stacking Reward Withdraw Approve</a></li>
                              <li><a href="<?php echo base_url('Admin/Withdraw/stakingrewardreject') ?>">Stacking Reward Withdraw Reject</a></li>
                            </ul>
                        </li>



                        <!-- 
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-package"></i>
                                    <span> <?php echo currency; ?> Withdraw Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                   <li><a href="<?php echo base_url('Admin/Withdraw/withdrawZil/') ?>"><?php echo currency; ?> Withdraw Request</a></li>
                                   <li><a href="<?php echo base_url('Admin/Withdraw/withdrawZil/pending') ?>"><?php echo currency; ?> Pending Withdraw Request</a></li>

                                    <li><a href="<?php echo base_url('Admin/Withdraw/withdrawZil/approve') ?>"> <?php echo currency; ?> Approved Withdraw Request</a></li>
                                    <li><a href="<?php echo base_url('Admin/Withdraw/withdrawZil/reject') ?>"><?php echo currency; ?> Rejected Withdraw Request</a></li>
                                </ul>
                            </li> -->
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span> <?php echo currency; ?> Crypto Transactions</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?php echo base_url('Admin/Crypto') ?>"><?php echo currency; ?> TRC20
                                        Transactions</a></li>
                                <li><a href="<?php echo base_url('Admin/Crypto/pending') ?>">Pending TRC20
                                        Transactions</a></li>
                                <li><a href="<?php echo base_url('Admin/Crypto/bep20transaction') ?>"><?php echo currency; ?>
                                        BEP20 Transactions</a></li>
                                <li><a href="<?php echo base_url('Admin/Crypto/bep20Pending') ?>">Pending BEP20
                                        Transactions</a></li>

                            </ul>
                        </li>


                        <li>
                            <a href="<?php echo base_url('Admin/Management/logout'); ?>">
                                <i class="ti-more"></i>
                                <span>Logout</span>
                            </a>

                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->