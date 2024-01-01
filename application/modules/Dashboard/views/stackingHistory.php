<?php include 'header.php' ?>
<style>
    section.content-header {
        background: #e0e0e0;
        color: #000;
        padding: 8px 16px;
        border-radius: 10px;
    }

    .messageBox {
        padding: 1em;
        background: #002e3666;
        border: #eee solid 2px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%);
        text-shadow: 0px 0px 8px #000;
        color: #fff;
    }

    #text {
        font-family: Questrial;
        text-align: center;
    }

    #construction {
        font-family: "Pacifico", cursive;
    }


  

    .dataTables_wrapper .dataTables_filter label {
        display: block;
        margin-bottom: 15px;
        color: white;
    }
    .staking-content p {
        color: #000;
        font-size: 14px;
    }
    .btn-right {
        background: #cba750;
        padding: 0 10px;
        color:#fff;
        border-radius:5px;
    }
    .ftr-main {
        display: flex;
        justify-content: space-around;
    }
    .staking-ftr-btn {
        background: #876dff;
        width: 100%;
        padding:11px 0;
        text-align: center;
    }
    .staking-ftr-btn h4 {
        margin: 0px;
    }
</style>

<!-- <div class="messageBox">
  <h1 id="construction">Coming Soon!</h1>
</div> -->

<?php $none = 0; ?>
<?php //($none == 1){ 
?>
<main>
    <div class="content-body">
        <div class="container-fluid">
            <!-- BEGIN breadcrumb -->
            <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
            <!-- END breadcrumb -->
            <!-- BEGIN page-header -->
            <section class="content-header">
                <span>Staking History</span>
            </section>
            <!-- END page-header -->
            <!-- BEGIN wizard -->
            <div class="content">
                <div id="rootwizard" class="wizard wizard-full-width">
                    <!-- BEGIN wizard-header -->

                    <!-- END wizard-header -->
                    <!-- BEGIN wizard-form -->

                    <div class="wizard-content tab-content">
                        <!-- BEGIN tab-pane -->
                        <div class="tab-pane active show" id="tabFundRequestForm">
                            <!-- BEGIN row -->
                            <div class="row">
                                <!-- BEGIN col-6 -->
                                <div class="col-md-12 px-0">
                                    <div class="">
                                        <!-- <p class="desc m-b-20" style="margin-top:20px;font-size: 18px;">Make sure to use a valid input, you'll need to verify it before you can submit request.</p> -->
                                        <div class="form-group m-b-10">

                                        </div>
                                        <div class="form-group m-b-10">
                                            <div class="box box-solid">
                                                <div class="box-body">
                                                    <div class="row">
                                                   
                                                    <?php
                                                                // die;
                                                                // $k = count($stake_history);
                                                                foreach ($stake_history as $key => $row) {
                                                                    // $k = ($key1);
                                                                    $date2 = date('Y-m-d H:i:s',strtotime($row['created_at'].'+'.$row['total_days'].' month'));
                                                                ?>

                                                    <div class="col-md-6">
                                                    <div class="card card-body staking-content">
                                                        <h2><?php echo ($key+1) ?></h2>
                                                        <p>USD Package: <span class="pull-right btn-right" style="background:#ed4843">$<?php echo $row['package']; ?></span></p>
                                                       
                                                        <p>Staked Coin: <span class="pull-right btn-right" style="background:#0078b7">RVC <?php echo $row['coin']; ?></span></p>
                                                        <p>Staked Coin Price: <span class="pull-right btn-right" style="background:#0078b7">$<?php echo $row['token_price']; ?></span></p>
                                                        <p>Staked Days: <span class="pull-right btn-right" style="background:#23b74d">   
														<?php 
                                                         if ($row['total_days'] != '570'){
                                                        if ($row['total_days'] == '1050') 
														echo 1080;
                                                        else if ($row['total_days'] == '1080') 
														echo 1080;
                                            			else 
														echo 540;
                                                         }else{
                                                            echo 570;  
                                                         }
													    ?></span></p>
                                                        <p>Date:   <span class="pull-right btn-right " style="background:#23b74d" > <?php echo $row['created_at']; ?></span></p>
                                                        <div class="ftr-main">
                                                       <!--<div class="staking-ftr-btn">
                                                           <h5>Current Value</h5>
                                                           <h4>$ <?php echo round($row['coin']*$live_token['amount']); ?></h4>
                                                        </div>-->
                                                        <div class="staking-ftr-btn" style="background:#00effa;">
                                                            <h5>Invested Value</h5>
                                                            <h4>$<?php echo $row['package']; ?></h4>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <?php
                                                    // $k--;
                                                                }
                                                                ?>
                                                    
                                                    
                                                    
                                                    </div>
                                                </div>
                                                <?php $links; ?>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <!-- END col-6 -->
                            </div>
                            <!-- END row -->
                        </div>
                        <!-- END tab-pane -->
                        <!-- BEGIN tab-pane -->

                    </div>
                    <!-- END wizard-content -->

                    <!-- END wizard-form -->
                </div>
            </div>
            <!-- END wizard -->


        </div>
    </div>
</main>
<?php //} 
?>





<?php include 'footer.php' ?>