<?php include_once 'header.php';
$userinfo = userinfo();
?>

<style>
    .currency-icon {
        height: 40px !important;
        width: 40px !important;
        position: absolute;
        right: -12px;
        top: 10px;
    }


    .text-white {
        margin-top: 0px;
        float: none;
        text-align: left;
    }

    .card h2 {
        color: #f5c242;
        margin-top: 5px;
    }

    .deznav {
        border-right: 0px #686868 solid;
        box-shadow: 0px 0px 0px #ffffff30;
    }

    .card h2 {
        color: #000000;
        font-size: 16px;
    }

    .text-success {
        float: left;
        color: white;
    }

    .text-center {
        /*float: left;*/
        color: white;
    }

    .header-right .header-profile>a.nav-link .header-info span {
        color: #fff;
        margin-right: 10px;
    }

    .card-box-center-img {
        position: absolute;
        right: 20px;
        top: 14px;
    }

    .fas {
        width: 28px;
    }

    .details_cntr .report-box-2__indicator {
        padding-top: 3px;
        padding-bottom: 3px;
        margin-bottom: 15px;
        margin-right: auto;
        display: flex;
        align-items: center;
        border-radius: 9999px;
        padding-left: 0.5rem;
        padding-right: 0.25rem;
        font-size: 14px;
        line-height: 1rem;
        font-weight: 500;
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity));
    }

    .details_cntr {
        padding: 20px;
        border-right: 1px solid #eeeef4;
        background: white;
    }

    .details_cntr .svg-icon {
        width: 2.5rem;
        height: 4.5rem;
    }

    .accovercntr a {
        float: left;
        box-shadow: 0.3rem 0.3rem 0.6rem #c9d1e7, -0.2rem -0.2rem 0.5rem #ffffff;
        border-radius: 50px;
        color: #555;
        width: 30%;
        margin: 0 3px;
        padding: 3px 0;
        text-align: center;
        font-size: 22px;
        margin-top: 10px;
    }

    .accovercntr a:hover {
        box-shadow: inset 0.2rem 0.2rem 0.5rem #c9d1e7, inset -0.2rem -0.2rem 0.5rem #ffffff;
    }

    .img-thumbnail {
        display: inline-block;
        max-width: 100%;
        height: auto;
        padding: 4px;
        line-height: 1.42857143;
        background-color: #fff;
        border: 1px solid #ddd;
        transition: all .2s ease-in-out;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
        line-height: 1.5;
    }

    .btn-primary {
        color: #fff;
        background-color: #337ab7;
        border-color: #2e6da4;
        margin-top: -9px;
    }

    .text-success {
        /*float: left;*/

        color: #3c763d;
        margin-left: 7px;
    }

    .flex {
        display: flex;
        align-items: center;
    }

    .mt-5 {
        margin-top: 19px !important;
    }

    .bottom_box {
        position: relative;
        overflow: hidden;
        padding: 30px;
        border-radius: 8px;
        margin-bottom: 15px;
        /*margin-left: 10px;*/
    }

    .bottom_box h4 {
        width: 62%;
        font-weight: normal;
        font-size: 22px;
        line-height: 28px;
    }

    .bottom_box p {

        margin-top: 10px;
        margin-bottom: 0;
        color: black;
    }

    .bottom_box .tooltip_cntr {
        position: relative;
        width: 55%;
        margin-top: 20px;
        z-index: 1;
        padding: 6px 10px;
        background: #0b122e;
        border: 1px solid #fff;
        border-radius: 5px;
    }

    .bottom_box .tooltip_cntr .referlinkli a {
        position: unset;
        margin: auto;
        display: block;
        color: #94a3b8;
    }

    .bottom_box .tooltip_cntr a:last-child {
        right: 5px;
    }

    .bottom_box .tooltip_cntr a {
        top: 0;
        bottom: 0;
    }

    .bottom_box .tooltip_cntr a {
        position: absolute;
        top: 0;
        right: 28px;
        bottom: 0;
        margin: auto;
        display: inline-table;
        width: 20px;
        color: #fff;
    }

    .fa {

        font-weight: 900;
    }

    .bottom_box img {
        width: 40%;
    }

    .box_illus {
        position: absolute;
        right: 0;
        top: 0;
        margin-right: 5px;
    }

    .bg-primary {
        color: #fff;
        background-color: #337ab7;
    }

    .bottom_box .btn {
        margin-top: 20px;
    }

    .btn-info {
        background-color: #00c0ef !important;
        border-color: #00acd6 !important;
        color: #fff;
    }

    .btn {
        border-radius: 3px;
        box-shadow: none;
        border: 1px solid transparent;
    }

    .btn {
        display: inline-block;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        touch-action: manipulation;
        cursor: pointer;
        user-select: none;
        background-image: none;
    }

    img.img-responsive {
        width: 100%;
        margin: auto;
    }

    .img-responsive {
        display: block;
        max-width: 100%;
        height: auto;
    }

    /*.col-xs-5 {
    width: 41.66666667%;
}
.col-xs-7 {
    width: 58.33333333%;
    float: left;
}
.col-xl-4{
        padding: 0 9px;
}
*/
    .avatar-md {
        width: 4rem;
    }

    .nav>li>a {
        padding: 10px 11px;
    }

    .bg-primary.bg-soft {
        background-color: rgba(85, 110, 230, .25) !important;
    }

    .pl-r {
        padding: 0 4px;
    }

    @media screen and (max-width: 767px) {
        .bottom_box {
            margin-top: 20px;
        }
    }

    @media screen and (max-width: 575px) {
        .p-nooe {
            padding: 0px !important
        }

        .pl-r {
            padding: 0;
        }

        .bottom_box .tooltip_cntr {
            width: 100%;
        }
    }

    @media (min-width: 992px) {
        .col-md-4 {
            width: 33.33333333%;
        }
    }

    .mini-stats-wid .mini-stat-icon {
        overflow: hidden;
        position: relative;
        width: 45px;
        height: 45px;
    }

    .rounded-circle {
        border-radius: 50%;
    }

    .bg-primary {
        color: #fff;
        background-color: #337ab7;
    }

    .mini-stats-wid .mini-stat-icon:before {
        content: "";
        position: absolute;
        width: 8px;
        height: 54px;
        background-color: rgba(255, 255, 255, .1);
        left: 16px;
        transform: rotate(32deg);
        top: -5px;
        transition: all .4s;
    }

    .avatar-title {
        -webkit-box-align: center;
        align-items: center;
        background-color: #556ee6;
        color: #fff;
        display: flex;
        font-weight: 500;
        height: 50px;
        -webkit-box-pack: center;
        justify-content: center;
        width: 60px;
        border-radius: 50%;
    }

    .font-size-24 {
        font-size: 24px !important;
    }

    .mini-stats-wid .mini-stat-icon::after {
        left: -12px;
        width: 12px;
        transition: all .2s;
    }

    .mini-stats-wid .mini-stat-icon:after {
        content: "";
        position: absolute;
        height: 54px;
        background-color: rgba(255, 255, 255, .1);
        transform: rotate(32deg);
        top: -5px;
    }

    .card {
        margin-top: 10px;

    }
</style>
<!-- <link href="https://busdstake.biz/assets/css/particle-theme.css" rel="stylesheet"> -->
<?php $userinfo = userinfo(); 

$apiUrl = 'https://admin.republicexchange.io/api/p2p/live-amount-tracking?coin=RVC';
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);
//print_r($data);
?>


<script>
    function countdown(element, seconds) {
        // Fetch the display element
        var el = document.getElementById(element).innerHTML;

        // Set the timer
        var interval = setInterval(function() {
            if (seconds <= 0) {
                //(el.innerHTML = "level lapsed");
                $('#' + element).text('Expired !')

                clearInterval(interval);
                return;
            }
            var time = secondsToHms(seconds)
            $('#' + element).text(time)

            seconds--;
        }, 1000);
    }

    function secondsToHms(d) {
        d = Number(d);
        var day = Math.floor(d / (3600 * 24));
        var h = Math.floor(d % (3600 * 24) / 3600);
        var m = Math.floor(d % 3600 / 60);
        var s = Math.floor(d % 3600 % 60);

        var dDisplay = day > 0 ? day + (day == 1 ? " day, " : " Days, ") : "";
        var hDisplay = h > 0 ? h + (h == 1 ? " Hour, " : " hours, ") : "";
        var mDisplay = m > 0 ? m + (m == 1 ? " Minute, " : " Minutes, ") : "";
        var sDisplay = s > 0 ? s + (s == 1 ? " Second" : " Seconds") : "";
        var t = dDisplay + hDisplay + mDisplay + sDisplay;
        return t;
        // console.log(t)
    }
</script>

<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

<!--**********************************
            Sidebar start
        ***********************************-->

<!--**********************************
            Sidebar end
        ***********************************-->

<!--**********************************
            Content body start
        ***********************************-->


<!-- All Operation here -->
<?php 
$roundvalue = $roi_income['roi_income'] - $user['offset_wallet'];
$reward_per_bal =$roundvalue -  $reward_balance['reward_balance'];
$roundoffworkingwallet = $withdraw_transactions['withdraw_transactions'] - $roundvalue;
?>
<!-- All Operation Here -->



<div class="content-body">


    <!-- <div class="form-head" style="background-image:url('images/background/bg3.jpg');background-position: bottom; ">
				<div class="container max d-flex align-items-center mt-0">
					<h2 class="font-w600 title text-white mb-2 mr-auto ">Dashboard</h2>
					<div class="weather-btn mb-2">
						<span class="mr-3 font-w600 text-black"><i class="fa fa-cloud mr-2"></i>21</span>
						<select class="form-control style-1 default-select  mr-3 ">
							<option>Medan, IDN</option>
							<option>Jakarta, IDN</option>
							<option>Surabaya, IDN</option>
						</select>
					</div>
					<a href="javascript:void(0);" class="btn white-transparent mb-2"><i class="las la-calendar scale5 mr-3"></i>Filter Periode</a>
				</div>
			</div> -->
    <div class="col-md-12">
        <div class="alert alert-info" style=" text-align: center; background: #fff !important; border: inherit; box-shadow: 0 4px 25px 0 rgb(168 180 208 / 10%);">
            <p>
                <marquee style="color: #017aee;margin-top: 6px;">
                    <?php

                    $i = 1;
                    foreach ($news as $n => $ne) {
                        echo $i . '. ' . $ne['news'];
                        $i++;
                    }
                    ?>
                    <!-- Welcome To Payetoken Family.. Our website is under maintenance! We will be back shortly. -->
                </marquee>
            </p>
            <!-- <p style="text-align:left;margin-left:10px">Joining Date: <?php //echo $userinfo->created_at; 
                                                                            ?> <br>
                       Activate Date: <?php //echo $userinfo->topup_date; 
                                        ?></p> -->

        </div>

    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-4 p-nooe">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-2">
                                    <h4 class="text-primary" style="font-size: 15px; color: #337ab7 !important; ">Welcome Back !</h4>
                                    <p class="m-0">RVC Dashboard</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="<?php echo base_url('uploads/'); ?>profile-img.png" alt="" class="img-responsive">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-4 px-0 ">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <img src="<?php echo base_url('uploads/'); ?>logo.png" alt="" class="img-thumbnail rounded-circle">
                                </div>
                                <h5 class="font-size-15 text-truncate">
                                    <span id="ContentPlaceHolder1_lbluseriddas"><?php echo $userinfo->user_id; ?></span>
                                </h5>
                            </div>

                            <div class="col-8 pr-0">
                                <div class="pt-4">
                                    <div class="row">
                                        <div class="col-md-12 px-0">
                                            <h4>$ <span id="ContentPlaceHolder1_Spantokenrate"> <?php //echo $token_value['amount']; ?><?php echo number_format($data['data']['price'], 3); ?></span></h4>
                                            <p class="text-muted mb-0" style="font-size: 12px;">RVC Live Price</p>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <h5>$<span id="ContentPlaceHolder1_spanteamBusines"><?php echo $teamBusiness['teamBusiness']; ?></span></h5>
                                            <p class="text-muted mb-0" style="font-size: 12px;">Team Business</p>
                                        </div> -->
                                    </div>
                                    <div class="mt-4">
                                        <a href="https://thericaverse.net/Dashboard/Profile" class="btn btn-primary waves-effect waves-light btn-sm">View Profile </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div class="row">
                        <div class="box-solid">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped dataTable" id="">
                                        <thead>
                                            <tr>

                                                <th>User ID</th>
                                                <th>Total Business</th>



                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // pr($Businessleg);

                                            for ($x = 0; $x <= 2; $x++) {
                                                //   echo "The number is: $x <br>";


                                                if ($x == '0') {
                                                    $userID = $Businessleg['teamAUserID'];
                                                    $busi = $Businessleg['firstLeg'];
                                                }
                                                if ($x == '1') {
                                                    $userID = $Businessleg['teamBUserID'];
                                                    $busi = $Businessleg['secondLeg'];
                                                }
                                                if ($x == '2') {
                                                    $userID = $Businessleg['teamCUserID'];
                                                    $busi = $Businessleg['otherleg'];
                                                }

                                            ?>
                                                <tr>
                                                    <td><?php echo $userID; ?> </td>
                                                    <td><?php echo $busi; ?></td>






                                                </tr>

                                            <?php } ?>


                                        </tbody>


                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
            <div class="form-wrapper d-none">
                <div class="copyrefferal box box-body pull-up bg-hexagons-white p-0 border-0">
                    <div class="box-solid">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped dataTable" id="">
                                    <thead>
                                        <tr>

                                            <th>User ID</th>
                                            <th>Total Business</th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // pr($Businessleg);

                                        for ($x = 0; $x <= 2; $x++) {
                                            //   echo "The number is: $x <br>";


                                            if ($x == '0') {
                                                $userID = $Businessleg['teamAUserID'];
                                                $busi = $Businessleg['firstLeg'];
                                            }
                                            if ($x == '1') {
                                                $userID = $Businessleg['teamBUserID'];
                                                $busi = $Businessleg['secondLeg'];
                                            }
                                            if ($x == '2') {
                                                $userID = $Businessleg['teamCUserID'];
                                                $busi = $Businessleg['otherleg'];
                                            }

                                        ?>
                                            <tr>
                                                <td><?php echo $userID; ?> </td>
                                                <td><?php echo $busi; ?></td>






                                            </tr>

                                        <?php } ?>


                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-8 p-0">
                <div class="row">

                    <div class="col-xl-6 col-sm-6 pl-r ">
                        <div class="card card-coin  ">
                            <div class="card-body">
                                <div class="text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fa fa-wallet font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <p class="mb-0 fs-16">
                                            <span class="text-left mr-1">Current Rank</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left">
                                            <?php
                                            $Rewards = $this->User_model->get_single_record('tbl_rewards',  'user_id ="' . $this->session->userdata['user_id'] . '" order by id desc LIMIT 1', '*');


                                            if ($Rewards['award_id'] == 1) {
                                                echo 'R 1';
                                            } elseif ($Rewards['award_id'] == 2) {
                                                echo 'R 2';
                                            } elseif ($Rewards['award_id'] == 3) {
                                                echo 'R 3';
                                            } elseif ($Rewards['award_id'] == 4) {
                                                echo 'R 4';
                                            } elseif ($Rewards['award_id'] == 5) {
                                                echo 'R 5';
                                            } elseif ($Rewards['award_id'] == 6) {
                                                echo 'R 6';
                                            } elseif ($Rewards['award_id'] == 7) {
                                                echo 'R 7';
                                            } elseif ($Rewards['award_id'] == 8) {
                                                echo 'R 8';
                                            } elseif ($Rewards['award_id'] == 9) {
                                                echo 'R 9';
                                            } elseif ($Rewards['award_id'] == 10) {
                                                echo 'R 10';
                                            } else {
                                                echo 'No Rank';
                                            } ?>
                                        </h2>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- <div class="col-xl-6 col-sm-6 pl-r ">
                        <div class="card card-coin  ">
                            <div class="card-body">
                                <div class="text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fa fa-wallet font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <p class="mb-0 fs-16">
                                            <span class="text-left mr-1">R2 Achieve In 28 Days</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left">
                                            <?php
                                            //    $Rewards = $this->User_model->get_single_record('tbl_rewards',  'user_id ="' . $this->session->userdata['user_id'] . '" order by id desc LIMIT 1', '*');


                                            // if ($userinfo->rank >= 2) {
                                            //     echo 'YES';
                                            // } else {
                                            //     echo 'No';
                                            // } ?>
                                        </h2>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div> -->



                    <div class="col-xl-6 col-sm-6 pl-r">
                        <div class="card card-coin">
                            <div class="card-body">
                                <div class="text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fa fa-wallet font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0 fs-16">
                                          <span class="text-left mr-1 "><b>Total Profit</b></span>
                                        </p>
                                         <?php 
                                            $total_earnss = $direct_income['direct_income'] + $roi_incomes['roi_incomes']+ $level_incomes['level_incomes'] + $booster_rewards_income['booster_rewards_income'] + $reward_income['reward_income'];
                                      ?>
                                        <h2 class="text-white mb-2 font-w600 text-left">$<?php echo number_format($total_earnss, 2); ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-6 pl-r">
                        <div class="card card-coin">
                            <div class="card-body">
                                <div class="text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fa fa-wallet font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <p class="mb-0 fs-16">
                                            <span class="text-left mr-1 ">Today Total Earning</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left">$<?php echo number_format($today_income['today_income'], 2); ?></h2>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6 col-sm-6 pl-r">
                        <div class="card card-coin">
                            <div class="card-body">
                                <div class="text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fa fa-wallet font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <p class="mb-0 fs-16">
                                            <span class="text-left mr-1 ">Income Limit</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left"> Total: $<?php echo $user['incomeLimit2']; ?> <br> Earned: $<?php echo $user['incomeLimit']; ?></h2>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6 col-sm-6 pl-r">
                        <div class="card card-coin">
                            <div class="card-body">
                                <div class="text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fa fa-wallet font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <p class="mb-0 fs-16">
                                            <span class="text-left mr-1 ">Topup Wallet (RVC/USD)</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left">$<?php echo number_format($wallet_balance['wallet_balance'], 2); ?></h2>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                   <div class="col-xl-6 col-sm-6 pl-r">
                        <div class="card card-coin">
                            <div class="card-body">
                                <div class="text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fa fa-wallet font-size-24" data-toggle="modals" data-target="#myModals"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                          <?php
                                          //$total_earns = $income_balance1['income_balance1'] + $income_balance2['income_balance2'] + $income_balance3['income_balance3'] + $with_roi_income['with_roi_income'];
                                        //  $total_earns_sub = $total_earns - $withdraw_transactions[0]['withdraw_transactions'];
                                         ?>
                                        <p class="mb-0 fs-16">
                                            <span class="text-left mr-1 ">Working Income Wallet</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left">$<?php echo number_format($roundoffworkingwallet, 3); ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="modal fade" id="myModals" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modals">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                          </div>
                          <div class="modal-body">
                            <p>Some text in the modal.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modals">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="col-xl-6 col-sm-6 pl-r d-none">

                        <div class="card card-coin">
                            <div class="card-body">
                                <div class="text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fab fa-battle-net font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <p class="mb-0 fs-16">
                                            <span class="text-left mr-1 ">Total Income</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left">$<?php echo number_format($total_income['total_income'], 2); ?></h2>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="col-xl-6 col-sm-6 pl-r d-none">

                        <div class="card card-coin">
                            <div class="card-body">
                                <div class="text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fab fa-battle-net font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <p class="mb-0 fs-16">
                                            <span class="text-left mr-1 ">Staking Income Wallet</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left">$<?php echo number_format($non_working_income['non_working_income'], 2); ?></h2>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-6 col-sm-6 pl-r">



                        <div class="card card-coin">
                            <div class="card-body">
                                <div class=" text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">

                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fas fa-chart-bar font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0 fs-16">
                                            <span class="text-left mr-1">Current Package</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left">$<?php echo $user['total_package']; ?></h2>

                                    </div>

                                    <!-- <div class="card-text-center">

								<img src="<?php echo base_url(); ?>uploads/logo-icon.png" class="currency-icon">
							</div> -->
                                </div>
                            </div>
                        </div>

                    </div>
<!-- 
                    <div class="col-xl-6 col-sm-6 pl-r">
                        <div class="card card-coin">

                            <div class="card-body">

                                <div class=" text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fas fa-hand-holding-usd font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0 fs-16">

                                            <span class="text-left mr-1">Direct Business</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left">$<?php // echo round($directBusiness['directBusiness'], 3); ?></h2> -->
                                        <!-- 	<p class="mb-0 fs-16">

									<span class="text-left mr-1">Total Business</span>
								</p> -->
                                    <!-- </div>
                                </div>
                            </div>
                        </div>

                    </div> -->


                    <div class="col-xl-6 col-sm-6 pl-r">
                        <div class="card card-coin">

                            <div class="card-body">

                                <div class=" text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fas fa-hand-holding-usd font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0 fs-16">

                                            <span class="text-left mr-1">Team Business</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left">Total $<?php echo round($teamBusiness['teamBusiness'], 3); ?></h2>
                                        <h2 class="text-white mb-2 font-w600 text-left">Today $<?php echo round($TodayteamBusiness['teamBusiness'], 3); ?></h2>

                                        <!-- 	<p class="mb-0 fs-16">

									<span class="text-left mr-1">Total Business</span>
								</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- <div class="col-xl-6 col-sm-6 pl-r">
                        <div class="card card-coin">

                            <div class="card-body">

                                <div class=" text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fas fa-hand-holding-usd font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0 fs-16">

                                            <span class="text-left mr-1">Monthly Business</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left">$ <?php
                                                                                            // $date = date('m');
                                                                                           // echo getBusinessMonth($this->session->userdata['user_id'], $date); 
                                                                                           
                                                                                           ?> 
                                                                                           </h2> -->

                                        <!-- 	<p class="mb-0 fs-16">

									<span class="text-left mr-1">Total Business</span>
								</p> -->
                                    <!-- </div>
                                </div>
                            </div>
                        </div>

                    </div> -->
                    <!-- <div class="col-xl-6 col-sm-6 pl-r">

                        <div class="card card-coin">
                            <div class="card-body">
                                <div class="text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fas fa-chart-bar font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0 fs-16">

                                            <span class="text-left mr-1">Total Direct Team</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left"><?php // echo round($directTeam['directTeam'], 3); ?></h2>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> -->
                    <div class="col-xl-6 col-sm-6 pl-r">

                        <div class="card card-coin">
                            <div class="card-body">
                                <div class="text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fas fa-chart-bar font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0 fs-16">

                                            <span class="text-left mr-1">Total Team</span>
                                        </p>
                                        <?php $totalTeam = $team_unpaid['team'] + $team_paid['team'] ?>
                                        <h2 class="text-white mb-2 font-w600 text-left">Total:- <?php echo $totalTeam; ?></h2>
                                        <h2 class="text-white mb-2 font-w600 text-left">Active:- <?php echo $team_paid['team']; ?></h2>
                                        <h2 class="text-white mb-2 font-w600 text-left">Inactive:- <?php echo $team_unpaid['team']; ?></h2>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                  <div class="col-xl-6 col-sm-6 pl-r">
                        <div class="card card-coin">
                            <div class="card-body">
                                <div class="text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fas fa-chart-bar font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0 fs-16">
                                            <span class="text-left mr-1">Staking Reward Wallet</span>
                                        </p>
                                        <?php //$roundvalue = $roi_income['roi_income'] - $user['offset_wallet'];?>
                                        <h2 class="text-white mb-2 font-w600 text-left">$ <?php echo round($reward_per_bal, 2); ?></h2>
                                        <a href="<?php echo base_url('Dashboard/User/offset_wallet')?>">Transfer Rewards Wallet</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-6 pl-r">
                        <div class="card card-coin">
                            <div class="card-body">
                                <div class="text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fas fa-chart-bar font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0 fs-16">
                                            <span class="text-left mr-1">Offset Wallet</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left">$ <?php  if($user['offset_wallet_per']){
                                            echo $user['offset_wallet_per'];
                                        }else{
                                            echo 0;
                                        }?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>













<!-- 
                    <div class="col-xl-6 col-sm-6 pl-r">

                         <div class="card card-coin">
                            <div class="card-body">
                                <div class="text-left">
                                    <div class="card-box-center">
                                        <div class="card-box-center-img">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fas fa-chart-bar font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0 fs-16">

                                            <span class="text-left mr-1">Today Business</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left">
                                            $<?php // echo round($TodayBusiness['TodayBusiness']); ?></h2>
                                        <p class="mb-0 fs-16">

                                            <span class="text-left mr-1">Monthly Business</span>
                                        </p>
                                        <h2 class="text-white mb-2 font-w600 text-left">
                                            $<?php //echo round($MonthBusiness['MonthBusiness']); ?></h2>

                                    </div>
                                </div>
                            </div>
                        </div> 

                    </div> -->


                </div>
            </div>
        </div>


    </div>


    <div class="row">

        <div class="col-xl-4 col-sm-6 d-none">
            <div class="card card-coin mb-3">
                <div class="card-body text-left">
                    <div class="card-box-center">
                        <div class="card-box-center-img">
                            <img src="<?php echo base_url(); ?>uploads/logo-icon.png" class="currency-icon">
                        </div>
                        <p class="mb-0 fs-16">

                            <span class="text-left mr-1">Deposit Balance</span>
                        </p>
                        <h2 class="text-white mb-2 font-w600 text-left">$ <?php echo $wallet_balance['wallet_balance']; ?></h2>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card card-coin mb-3">
                <div class="card-body text-left">
                    <div class="card-box-center">
                        <div class="card-box-center-img">
                            <div class="flex-shrink-0 align-self-center">

                            </div>
                        </div>
                        <p class="mb-0 fs-16">

                            <span class="text-left mr-1">Coin Balance :RVC <?php echo number_format($coinBalance['balance'], 2); ?></span>
                        </p>

                        <h2 class="text-white mb-1 font-w600 text-left">Current Value: $<?php echo number_format($coinBalance['balance'] * $data['data']['price'], 2); ?></h2>

                    </div>
                </div>

            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card card-coin mb-3">
                <div class="card-body text-left">
                    <div class="card-box-center">
                        <div class="card-box-center-img">
                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="far fa-gem font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0 fs-16">

                            <span class="text-left mr-1">Daily Staking Income</span>
                        </p>
                        <h2 class="text-white mb-2 font-w600 text-left">$ <?php echo number_format($daily_minting_profit['daily_minting_profit'], 2); ?></h2>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card card-coin mb-3">
                <div class="card-body text-left">
                    <div class="card-box-center">
                        <div class="card-box-center-img">
                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="far fa-gem font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0 fs-16">

                            <span class="text-left mr-1">Level Income</span>
                        </p>
                        <h2 class="text-white mb-2 font-w600 text-left">$ <?php echo number_format($level_income['level_income'], 2); ?></h2>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card card-coin mb-3">
                <div class="card-body text-left">
                    <div class="card-box-center">
                        <div class="card-box-center-img">
                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="far fa-gem font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0 fs-16">

                            <span class="text-left mr-1">Today Booster Income</span>
                        </p>
                        <h2 class="text-white mb-2 font-w600 text-left">$ <?php echo number_format($booster_reward['today_income'], 2); ?></h2>

                    </div>
                </div>
            </div>
        </div>














        <?php
        $incomes = incomes();
        foreach ($incomes as $incKey => $inc) :
            $getBalance = $this->User_model->get_single_record('tbl_income_wallet', ['user_id' => $this->session->userdata['user_id'], 'type' => $incKey], 'ifnull(sum(amount),0) as balance');
        ?>
            <div class="col-xl-4 col-sm-6 m-t35 d-none">
                <div class="card card-coin mb-3">
                    <div class="card-body text-left">
                        <img src="<?php echo base_url(); ?>uploads/logo-icon.png" class="currency-icon">
                        <h2 class="text-white mb-2 font-w600">$ <?php echo ' ' . round($getBalance['balance'], 2); ?></h2>
                        <p class="mb-0 fs-14">

                            <span class="text-success mr-1"><?php echo $inc; ?></span>
                        </p>
                    </div>
                </div>
            </div>

        <?php
        endforeach;
        ?>

    </div>
    <?php if ($userinfo->paid_status == 1) : ?>
        <div class="row">
            <div class="col-md-6 mt-2">

            </div>
        </div>
    <?php endif; ?>



    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 p-nooe">
                <div class="row">
                    <div class="col-md-6 p-0">
                        <div class="details_cntr h-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="shopping-bag" data-lucide="shopping-bag" class="lucide lucide-shopping-bag w-10 h-10 text-warning svg-icon">
                                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 01-8 0"></path>
                            </svg>
                            <h4>Staking Package:</h4>
                            <h3><b>$<span id="ContentPlaceHolder1_Spanpackage"><?php echo $userinfo->total_package ?></span></b>&nbsp;&nbsp;<b><span id="ContentPlaceHolder1_lblstatus"><?php echo $userinfo->paid_status > 0 ? 'Active' : 'In-Active' ?></span></b></h3>
                            <!-- <div class="report-box-2__indicator bg-success" data-toggle="tooltip" data-original-title="4.7% Today's Yield of Income">
                                    4.7%
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-up" data-lucide="chevron-up" class="lucide lucide-chevron-up w-4 h-4 ml-0.5">
                                    <polyline points="18 15 12 9 6 15"></polyline></svg>
                                </div> -->
                            <p class="text-dark">Upgrade now for quick access of new features.</p>


                            <div class="accovercntr">
                                <p class="text-dark m-0">Join Our Community :</p>
                                <strong class="text-muted">
                                    <a href="https://twitter.com/VerseRica" target="_blank">
                                        <i class="fab fa-twitter"></i></a>
                                    <a href="https://www.instagram.com/ricaverse/" target="_blank">
                                        <i class="fab fa-instagram"></i></a>
                                    <a href="https://www.facebook.com/profile.php?id=100090027950943" target="_blank">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                    <a href="https://t.me/thericaverseofficial" target="_blank"><i class="fab fa-telegram"></i></a>
                                    <a id="" data-action="share/whatsapp/share" href="https://www.youtube.com/channel/UCuOLNYzwmml5zF1a9qX17Sg" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                    <a href="<?php echo base_url(); ?>uploads/Ricaverse presentations.pdf" title="Plan" download>
                                        <i class="far fa-file-pdf"></i>
                                    </a>
                                </strong>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 p-0" style="color: black;">
                        <div class="details_cntr">
                            <div class="text-slate-500 text-xs">Staked Coin</div>
                            <div class="flex">
                                <div class="text-base"><span id="ContentPlaceHolder1_Spanstakecoin"><?php echo $totalMurphyAmount['balance2']; ?></span></div>
                                <!-- <div class="text-success" data-toggle="tooltip" data-original-title="3% Higher than last month">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-up" data-lucide="chevron-up" class="lucide lucide-chevron-up w-4 h-4 ml-0.5">
                                        <polyline points="18 15 12 9 6 15"></polyline>
                                    </svg>
                                </div> -->
                            </div>
                            <!-- <div class="text-slate-500 text-xs mt-5">Reward Rank</div>
                            <div class="flex">
                                <div class="text-base"><span id="ContentPlaceHolder1_lblRewardBonus"></span></div>
                            </div> -->
                            <div class="text-slate-500 text-xs mt-5">Strong Leg Business</div>
                            <div class="flex">
                                <div class="text-base"><span id="ContentPlaceHolder1_Spansteonglegbusines"><?php echo $legBusiness['firstLeg']; ?></span></div>
                                <!-- <div class="text-success" data-toggle="tooltip" data-original-title="0% Lower than last month">
                                    0%
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down" class="lucide lucide-chevron-down w-4 h-4 ml-0.5">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </div> -->
                            </div>
                            <!-- <div class="text-slate-500 text-xs mt-5">Strong Leg ID</div>
                            <div class="flex">
                                <div class="text-base"><span id="ContentPlaceHolder1_Spanstronglegid"></span></div>
                            </div> -->
                            <div class="text-slate-500 text-xs mt-5">Other Leg Business</div>
                            <div class="flex">
                                <div class="text-base"><span id="ContentPlaceHolder1_Spanotherlegbusines"><?php echo $legBusiness['secondLeg']; ?></span></div>
                                <!-- <div class="text-success" data-toggle="tooltip" data-original-title="0% Higher than last month">
                                    0%
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-up" data-lucide="chevron-up" class="lucide lucide-chevron-up w-4 h-4 ml-0.5">
                                        <polyline points="18 15 12 9 6 15"></polyline>
                                    </svg>
                                </div> -->
                            </div>
                            <div class="text-slate-500 text-xs mt-5">Direct Id/Total Business :</div>
                            <div class="flex">
                                <div class="text-base"><span id="ContentPlaceHolder1_spandirectid"><?php echo $directBusiness['directBusiness']; ?></span>
                                <!-- <span id="ContentPlaceHolder1_Spandirectbus"></span> -->
                            </div>
                                <!-- <div class="text-success" data-toggle="tooltip" data-original-title="0% Higher than last month">
                                    0%
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-up" data-lucide="chevron-up" class="lucide lucide-chevron-up w-4 h-4 ml-0.5">
                                        <polyline points="18 15 12 9 6 15"></polyline>
                                    </svg>
                                </div> -->
                            </div>

                            <!-- <div class="text-slate-500 text-xs mt-5">Royalty Income</div>
                            <div class="flex">
                                <div class="text-base"><span id="ContentPlaceHolder1_SpanRoyaltyincome"><?php echo $royalty_income['royalty_income']; ?></span></div>
                            </div> -->


                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-6 p-0">
                <div class="row">

                    <div class="col-md-12">
                        <div class="bottom_box bg-primary">
                            <h4>Smart Contract address</h4>


                            <div class="border-gradient_content status-panel_wallets" style="margin-top: 15px;">
                                <div class="status-panel_wallet" style="text-overflow: ellipsis; overflow: hidden;">
                                    <a id="" href="https://bscscan.com/token/0x7b95723f5b987b4C0FB99fc8Af843572A1834dD3" target="blank" class="text-white">0x7b95723f5b987b4C0FB99fc8Af843572A1834dD3</a>

                                </div>
                                <a class="status-panel_wallets__btn btn btn-info" style="padding: 3px 12px;" href="https://bscscan.com/token/0x7b95723f5b987b4C0FB99fc8Af843572A1834dD3" target="blank">TO BSCSCAN </a>
                                <div class="btn btn-info" style="padding: 3px 12px;" onclick="copyToClipboard2('0x7b95723f5b987b4C0FB99fc8Af843572A1834dD3')">
                                    COPY
                                </div>
                            </div>

                            <img class="box_illus" src="<?php echo base_url(); ?>uploads/woman-illustration.svg">

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="col-md-12">
        <div class="bottom_box card" style="    margin-top: 10px;">
            <div class="card">
                <div class="card-header d-sm-flex d-block pb-0 border-0">
                    <div>
                        <h4 class="fs-20 ">Refferal Link</h4>
                        <p class="mb-0 fs-12">Copy that link and share with your friends</p>
                    </div>

                </div>
                <div class="card-body">
                    <div class="form-wrapper">
                        <div class="copyrefferal box box-body pull-up bg-hexagons-white p-0 border-0">
                            <input style="background: black;
                                            color: white;" type="text" id="linkTxt" value="<?php echo base_url('Dashboard/Register/?sponser_id=' . $userinfo->user_id); ?>" class="form-control">
                            <button id="btnCopy" iconcls="icon-save" onclick="myFunction()" class="btncopy btn-rounded m-b-5 copy-section" style="      padding: 10px;
                                            background: #dfb82d;
                                            font-size: 15px;
                                            color: #fff;
                                            font-weight: bold;
                                            border-radius: 4px;
                                            border: navajowhite;
                                            letter-spacing: 2px;
                                            width: 100%;
                                            margin-top: 10px;
                                                        ">
                                Copy link
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="bottom_box card" style="margin-top: 10px;">
            <div class="card">
                <div class="card-header d-sm-flex d-block pb-0 border-0">
                    <h4 class="">Rewards</h4>
                </div>
                <div class="card-body">
                    <?php
                    $rewards  = [
                        1 => ['name' => 'R1', 'direct' => '500', 'team' => '2500', 'business' => '', 'reward_amount' => '250'],
                        2 => ['name' => 'R2', 'direct' => '500', 'team' => '10000', 'business' => '', 'reward_amount' => '500'],
                        3 => ['name' => 'R3', 'direct' => '2000', 'team' => '25000', 'business' => '', 'reward_amount' => '1000'],
                        4 => ['name' => 'R4', 'direct' => 'ROI 10% & Direct Refferal Bonus 10%', 'team' => '50000', 'business' => '', 'reward_amount' => '2500'],
                        5 => ['name' => 'R5', 'direct' => 'ROI 10% & Direct Refferal Bonus 10%', 'team' => '150000', 'business' => '', 'reward_amount' => '5000'],
                        6 => ['name' => 'R6', 'direct' => '', 'team' => '750000', 'business' => '', 'reward_amount' => '25000'],
                        7 => ['name' => 'R7', 'direct' => '', 'team' => '1500000', 'business' => '', 'reward_amount' => '50000'],
                        8 => ['name' => 'R8', 'direct' => '', 'team' => '6000000', 'business' => '', 'reward_amount' => '200000'],
                        9 => ['name' => 'R9', 'direct' => '', 'team' => '15000000', 'business' => '', 'reward_amount' => '500000'],
                        10 => ['name' => 'R10', 'direct' => '', 'team' => '45000000', 'business' => '', 'reward_amount' => '1250000'],

                    ];

                    //$rewards2  = [
                    //  4 => ['name' => 'R4', 'leg' => 'R3', 'reward_amount' => '2500'],
                    //  5 => ['name' => 'R5', 'leg' => 'R4', 'reward_amount' => '5000'],
                    //   6 => ['name' => 'R6', 'leg' => 'R5', 'reward_amount' => '25000'],
                    // 7 => ['name' => 'R7', 'leg' => 'R6', 'reward_amount' => '50000'],
                    // 8 => ['name' => 'R8', 'leg' => 'R7', 'reward_amount' => '200000'], 
                    //9 => ['name' => 'R9', 'leg' => 'R8', 'reward_amount' => '500000'],
                    // 10 => ['name' => 'R10', 'leg' => 'R9', 'reward_amount' => '1250000'],
                    // ];
                    ?>
                    <div class="form-wrapper">
                        <div class="copyrefferal box box-body pull-up bg-hexagons-white p-0 border-0">
                            <div class="box-solid">
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped dataTable" id="">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Reward Name</th>
                                                    <th>Direct</th>
                                                    <th>Team</th>
                                                    <th>Rewards</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($rewards as $key => $reward) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $key; ?></td>
                                                        <td><?php echo $reward['name']; ?></td>
                                                        <td><?php echo $reward['direct']; ?></td>
                                                        <td><?php echo $reward['team']; ?></td>
                                                        <td><?php echo $reward['reward_amount']; ?> USDT</td>
                                                        <td>
                                                            <?php

                                                            if ($Rewards['award_id'] >= $key) {

                                                                echo '<span class="badge badge-success">Achieved</span>';
                                                            } else {
                                                                echo '<span class="badge badge-danger">Pending</span>';
                                                            }

                                                            ?></td>
                                                    </tr>

                                                <?php } ?>


                                            </tbody>


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="bottom_box card" style="margin-top: 10px;">
            <div class="card">
                <div class="card-header d-sm-flex d-block pb-0 border-0">
                    <h4 class="">New Rewards</h4>
                </div>
                <div class="card-body">

                    <div class="form-wrapper">
                        <div class="copyrefferal box box-body pull-up bg-hexagons-white p-0 border-0">
                            <div class="box-solid">
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped dataTable" id="">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Team A</th>
                                                    <th>Team B</th>
                                                    <th>Team C</th>
                                                    <th>Per Day</th>
                                                    <th>Total Economy</th>
                                                    <th>Days</th>
                                                    <th>Pending Time</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <?php $reward = $this->load->config->item('rewardArray');
                                                foreach ($reward as $key => $re) {
                                                    $level = $this->User_model->get_single_record('tbl_roi_reward',  ['user_id' => $this->session->userdata['user_id'], 'level' => $key], '*');
                                                  //  echo $this->db->last_query($level);die();

                                                ?>
                                                    <tr>
                                                        <td><?php echo $key; ?></td>
                                                        <td><?php echo $re['TeamA']; ?></td>
                                                        <td><?php echo $re['TeamB']; ?></td>
                                                        <td><?php echo $re['TeamC']; ?></td>
                                                        <td><?php echo $re['PerDay']; ?> USDT</td>
                                                        <td><?php echo $re['TotalEconomy']; ?> USDT</td>
                                                        <td><?php echo $re['Days']; ?></td>
                                                        <td class="">
                                                            <?php
                                                            if (empty($level)) {
                                                                if($topup_date['created_at'] <= "2023-07-07 00:00:00"){
                                                                    $diff = strtotime('+ ' . $re['Days'] . 'days', strtotime("2023-07-07 00:00:00")) - strtotime(date('Y-m-d H:i:s'));
                                                                }else{
                                                                    $diff = strtotime('+ ' . $re['Days'] . 'days', strtotime($topup_date['created_at'])) - strtotime(date('Y-m-d H:i:s'));
                                                                }
                                                                // $diff = strtotime('+14 days', strtotime($userinfo->topup_date)) - strtotime(date('Y-m-d H:i:s'));
                                                                if ($diff > 0) {
                                                                    echo '<p class="timer-bg" style="color:white;"><br><i><span id="demo' . $key . '" style="color:white;font-weight:bold;"></i></span></p>';
                                                                    echo '<script> countdown("demo' . $key . '",' . $diff . ') </script>';
                                                                } else {
                                                                    echo '<p class="timer-bg" style="color: #fff;"><br><span  style="color:#fff;font-weight:bold;"> Expired !</span></p>';
                                                                }
                                                            } else {
                                                                echo 0;
                                                            }

                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php

                                                            if (!empty($level)) {
                                                                echo '<span class="badge badge-success">Achieved</span>';
                                                            } else {
                                                                echo '<span class="badge badge-danger">Pending</span>';
                                                            }


                                                            ?></td>
                                                    </tr>

                                                <?php } ?>


                                            </tbody>


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


<?php if ($popup['status'] == 1) {
?>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <img src="<?php echo base_url('uploads/') . $popup['media']; ?>" class="img-fluid" width="650">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>




<?php include_once 'footer.php'; ?>
<script>
    $(document).ready(function() {
        $('#myModal').modal('show');
    });
</script>



<script>
    $(document).on('click', '#btnCopy', function() {
        var copyText = document.getElementById("linkTxt");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        alert("Copied the text: " + copyText.value);
    })


    $(document).on('click', '#btnCopy2', function() {
        var copyText = document.getElementById("linkTxt2");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        alert("Copied the text: " + copyText.inneHTML);
    })

    function myFunction() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        alert("Copied the text: " + copyText.value);
    }

    function refreshBalance() {
        $.get('<?php echo base_url('Dashboard/Binance/binance_balance_fetch') ?>', function(res) {
            $('#bbalance').text(res);
        }, 'json')
    }
</script>
<script>
    var url1 = "<?php echo base_url('Dashboard/Activation/stackCoin'); ?>";
    stackFrom.onsubmit = async (e) => {
        e.preventDefault();
        let response = await fetch(url1, {
            method: 'POST',
            body: new FormData(stackFrom)
        });
        let result = await response.json();
        updateToken(result.token);
        if (result.status == 1) {
            alert(result.message);
            location.reload();
        } else {
            alert(result.message);
        }
    };
    var url2 = "<?php echo base_url('Dashboard/Activation/purchaseMurphy'); ?>";
    purchaseFrom.onsubmit = async (e) => {
        e.preventDefault();
        let response = await fetch(url2, {
            method: 'POST',
            body: new FormData(purchaseFrom)
        });
        let result = await response.json();
        updateToken(result.token);
        if (result.status == 1) {
            alert(result.message);
            location.reload();
        } else {
            alert(result.message);
        }
    };

    var url3 = "<?php echo base_url('Dashboard/Activation/buyCoin'); ?>";
    buyCoinForm.onsubmit = async (e) => {
        e.preventDefault();
        let response = await fetch(url3, {
            method: 'POST',
            body: new FormData(buyCoinForm)
        });
        let result = await response.json();
        updateToken(result.token);
        if (result.status == 1) {
            alert(result.message);
            location.reload();
        } else {
            alert(result.message);
        }
    };

    var url4 = "<?php echo base_url('Dashboard/Activation/sellCoin'); ?>";
    sellCoinForm.onsubmit = async (e) => {
        e.preventDefault();
        let response = await fetch(url4, {
            method: 'POST',
            body: new FormData(sellCoinForm)
        });
        let result = await response.json();
        updateToken(result.token);
        if (result.status == 1) {
            alert(result.message);
            location.reload();
        } else {
            alert(result.message);
        }
    };

    function updateToken(token) {
        var els = document.getElementsByClassName("tokenall");
        for (var i = 0; i < els.length; i++) {
            els[i].value = token;
        }
    }

    function getBalance() {
        var url2 = "<?php echo base_url('Dashboard/Activation/getBalance'); ?>";
        fetch(url2, {
                method: "GET"
            })
            .then(response => response.json())
            .then(response => {
                //document.getElementById('coinBalance').innerHTML = '<span class="text-success">Murphy Balance: '+response.coinBalance+'</span>';
                //document.getElementById('walletBalance').innerHTML = '<span class="text-success">Wallet Balance: '+response.walletBalance+'</span>';
                document.getElementById('walletBalance2').innerHTML = '<span class="text-success">Wallet Balance: ' + response.walletBalance + '</span>';
                document.getElementById('walletBalance3').innerHTML = '<span class="text-success">GCELL Balance: ' + response.coinBalance + '</span>';
            })
    }

    function getMHY() {
        var url = "<?php echo base_url('Dashboard/Activation/getMHY'); ?>";
        fetch(url, {
                method: "GET"
            })
            .then(response => response.json())
            .then(response => {
                var amount = document.getElementById('amount').value;
                document.getElementById('murphyCoin').innerHTML = 'Approx: GCELL: ' + amount / (response.tokenValue);
                document.getElementById('buyCoinAmount').value = 'Approx: GCELL: ' + amount / (response.tokenValue);
            })
    }

    function getMHY2() {
        var url = "<?php echo base_url('Dashboard/Activation/getMHY'); ?>";
        fetch(url, {
                method: "GET"
            })
            .then(response => response.json())
            .then(response => {
                var amount = document.getElementById('buyCoinAmount1').value;
                var amount2 = document.getElementById('sellCoinAmount1').value;
                document.getElementById('buyCoinAmount2').value = amount / (response.tokenValue);
                document.getElementById('sellCoinAmount2').value = amount2 * (response.sellValue);
            })
    }

    function calculateCoin() {
        var month = document.getElementById('months').value;
        var amount = document.getElementById('stackAmount').value;
        var finalAmount = 0;
        var extraCoin = 0;
        if (month == 18) {
            extraCoin = parseInt(amount * 0.2);
            finalAmount = parseInt(amount) + parseInt(amount * 0.2);
        } else if (month == 24) {
            extraCoin = parseInt(amount * 0.36);
            finalAmount = parseInt(amount) + parseInt(amount * 0.36);
        } else if (month == 36) {
            extraCoin = parseInt(amount * 0.48);
            finalAmount = parseInt(amount) + parseInt(amount * 0.48);
        } else if (month == 48) {
            extraCoin = parseInt(amount * 0.6);
            finalAmount = parseInt(amount) + parseInt(amount * 0.6);
        }
        document.getElementById('extraStack').innerHTML = 'Extra Coin: ' + extraCoin;
        document.getElementById('totalStack').innerHTML = 'Total Coin: ' + parseInt(finalAmount);
    }
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- <script src="https://busdstake.biz/assets/vendor/particles/particles.min.js"></script> -->

<script>
    function copyToClipboard(text) {
        var inputc = document.body.appendChild(document.createElement("input"));
        inputc.value = text; //window.location.href;
        inputc.focus();
        inputc.select();
        document.execCommand('copy');
        inputc.parentNode.removeChild(inputc);
        toastr.success("Reffer Link Copied.", {
            timeOut: 5000
        })

    }


    function copyToClipboard2(text) {
        var inputc = document.body.appendChild(document.createElement("input"));
        inputc.value = text; //window.location.href;
        inputc.focus();
        inputc.select();
        document.execCommand('copy');
        inputc.parentNode.removeChild(inputc);
        toastr.success("Copy Address.", {
            timeOut: 5000
        })

    }
</script>




<script>
    // $("body").on("mousemove", function (e) {
    //   //   var x = e.pageX,
    //   //       y = e.pageY,
    //   //       w = $(window).width()/2;

    //   //   if(x > w){
    //   //     var dir = "right"
    //   //     } else if(x < w){
    //   //       var dir = "left"
    //   //       }

    //   //   console.log(dir);


    // });

    particlesJS("particles-js", {

        "particles": {
            "number": {
                "value": 250,
                "density": {
                    "enable": true,
                    "value_area": 1500
                }
            },
            "color": {
                "value": "#fff"
            },
            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 0,
                    "color": "#000000"
                },
                "polygon": {
                    "nb_sides": 5
                },
                "image": {
                    "src": "http://image.ibb.co/g9eFcF/logo_transparent.png",
                    "width": 100,
                    "height": 100
                }
            },
            "opacity": {
                "value": 1,
                "random": false,
                "anim": {
                    "enable": false,
                    "speed": 1,
                    "opacity_min": 0.6,
                    "sync": false
                }
            },
            "size": {
                "value": 3,
                "random": true,
                "anim": {
                    "enable": false,
                    "speed": 3,
                    "size_min": 0.1,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": true,
                "distance": 120,
                "color": "#ffffff",
                "opacity": 0.5,
                "width": 1
            },
            "move": {
                "enable": true,
                "speed": 8,
                "direction": "random",
                "random": false,
                "straight": false,
                "out_mode": "out",
                "bounce": true,
                "attract": {
                    "enable": true,
                    "rotateX": 3600,
                    "rotateY": 3600
                }
            }
        },



        "interactivity": {
            "detect_on": "canvas",

            "events": {
                "onhover": {
                    "enable": true,
                    "mode": "grab"
                },

                "onclick": {
                    "enable": true,
                    "mode": "remove"
                },
                "resize": true
            },

            "modes": {
                "grab": {
                    "distance": 140,
                    "line_linked": {
                        "opacity": 1
                    }
                },
                "bubble": {
                    "distance": 100,
                    "size": 4,
                    "duration": 2,
                    "opacity": 1,
                    "speed": 3
                },

                "repulse": {
                    "distance": 200,
                    "duration": 0.5
                },

                "push": {
                    "particles_nb": 5
                },

                "remove": {
                    "particles_nb": 2
                }
            }
        },
        "retina_detect": true
    });
</script>