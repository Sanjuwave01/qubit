<?php
include_once 'header.php';
date_default_timezone_set('Asia/Kolkata');


?>


<div class="content-body">
    <div class="container-fluid">
        <div>
            <!-- BEGIN breadcrumb -->
            <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
            <!-- END breadcrumb -->
            <!-- BEGIN page-header -->
            <div class="panel-heading">
                <span style="">
                    <?php echo $title; 
                    // echo $rewards['total'];?>
                </span>
            </div>

                                           <?php


                                            
                                                    $firstDayOfMonth = date('Y-m-01');
                                                    $lastDayOfMonth = date('Y-m-t');
                                                     $currentmonth = date('Y-m-d');
                                                    //echo $currentmonth;
 
                                            $Rewards = $this->User_model->get_single_record('tbl_rewards',  'user_id ="' . $this->session->userdata['user_id'] . '" order by id desc LIMIT 1', '*');
                                            $per = $this->User_model->get_single_record('achieve_percentage_amount',  'user_id ="' . $this->session->userdata['user_id'] . '" AND MONTH(created_at) = MONTH(NOW()) order by created_at desc LIMIT 1', '*');
                                            //print_r($per);    

                                                   $diable='';
                                             $target = 0;
                                             $percentage=0;
                                            if ($Rewards['award_id'] == 1) {
                                                 if($rewards['total'] < 2100){
                                                     $diable='disabled';
                                                 }
                                                // echo $rewards['total'].'<br>';
                                                //echo  $acievedpercetage = 2100/$rewards['total'];
                                              $target=2100;
                                            }
                                            elseif($Rewards['award_id'] == 2){
                                                if($rewards['total'] < 2100){
                                                    $diable='disabled';
                                                 }
                                                // echo $rewards['total'];
                                                 //echo $acievedpercetage = 2100/$rewards['total'];
                                             $target=2100;
                                            }
                                             elseif ($Rewards['award_id'] == 3) {
                                                if($rewards['total'] < 5100){
                                                    $diable='disabled';
                                                 }
                                                // echo $rewards['total'];
                                                 //echo  $acievedpercetage = 5100/$rewards['total'];
                                             $target=5100;
                                            }
                                            elseif ($Rewards['award_id'] == 4) {
                                                if($rewards['total'] < 5100){
                                                    $diable='disabled';
                                                }
                                               // echo $rewards['total'];
                                                //echo $acievedpercetage = 5100/$rewards['total'];
                                             $target=5100;
                                            }
                                            elseif ($Rewards['award_id'] == 5) {
                                                if($rewards['total'] < 5100){
                                                    $diable='disabled';
                                             }
                                            // echo $rewards['total'];
                                             //echo  $acievedpercetage = 5100/$rewards['total'];
                                             $target=5100;
                                            }
                                             elseif ($Rewards['award_id'] == null) {
                                                // $diable='disabled';
                                                    $target=0;
                                            }

                                            if ($Rewards && strtotime($Rewards['created_at']) > strtotime($firstDayOfMonth) && strtotime($Rewards['created_at']) < strtotime($lastDayOfMonth) ) {
                                                   $diable='';
                                             } elseif($rewards['total'] >= $target) {
                                                $diable='';   
                                             }else{
                                              $diable='disabled';
                                            }

                                
                                             //print_r($Rewards);
                                             //echo  $Rewards['award_id'];
                                               
                                             
                                            ?>
          


            <!-- END page-header -->
            <!-- BEGIN wizard -->
            <div class="card">
                <div class="card-body">

                    <div id="rootwizard" class="wizard-full-width border-0">
                        <!-- BEGIN wizard-header -->

                        <!-- END wizard-header -->
                        <!-- BEGIN wizard-form -->

                        <div class="wizard-content tab-content p-0">
                            <!-- BEGIN tab-pane -->
                            <div class="tab-pane active show" id="tabFundRequestForm">
                                <!-- BEGIN row -->
                                <div class="row">
                                    <!-- BEGIN col-6 -->
                                    <div class="col-md-6">
                                           <?php   $roundvalue = $roi_income['roi_income'] - $user['offset_wallet'];
                                               // $reward_per_bal =$roundvalue -  $reward_balance['reward_balance'];
                                                $roundoffworkingwallet = $withdraw_transactionss['withdraw_transactionss'] - $roundvalue;
                                               // echo $roundoffworkingwallet;
                                            $useraddress = $user['eth_address'];
                                            ?>
                                            <label style="font-size:15px; color:#00ecc6">Available balance ($
                                                <?php echo round($roundoffworkingwallet, 2); ?>)
                                            </label><br>
                                            <label style="font-size:15px; color:#00ecc6">Target Amount ($
                                                <?php echo round($target, 2); ?>)
                                            </label><br>
                                            <label style="font-size:15px; color:#00ecc6">Achieve Amount ($
                                                <?php echo round($rewards['total'], 2); ?>)
                                            </label><br>



                                            <?php if($Rewards['award_id'] < 6)
                                                 $percentage = ($rewards['total']/$target)*100;
                                                $percatagevalue = '';
                                                $achieveamount = null;
                                                 if($percentage > 25 && $percentage <50 ){
                                                    $percatagevalue = "25%";
                                                    $achieveamount = $roundoffworkingwallet*25/100;
                                                 }elseif($percentage > 50 && $percentage <75){
                                                    $percatagevalue = "50%";
                                                    $achieveamount = $roundoffworkingwallet*50/100;
                                                 }elseif($percentage > 75 && $percentage <100){
                                                    $percatagevalue = "75%";
                                                    $achieveamount = $roundoffworkingwallet*75/100;
                                                 }elseif($percentage > 100){
                                                    $percatagevalue = "100%";
                                                    $achieveamount = $roundoffworkingwallet;
                                                 }
                                                 
                                             ?>
                                            <?php if($Rewards['award_id'] < 6)
                                             {
                                             if($percatagevalue !=''){ ?>
                                          <label style="font-size:15px; color:#00ecc6"> You Have Achieve  <?php echo $percatagevalue ?> If you want withdrawal this amount to 
                                          
                                             </label>
                                             <?php 
                                                    
                                                    echo form_open(base_url('Dashboard/DirectIncomeWithdrawwithperecntage'));
                                            
                                                    echo form_input(['type'=>'hidden','name'=>'achieve','value'=>"$achieveamount",'class'=>'custom_form']);
                                                    echo form_input(['type'=>'hidden','name'=>'available_amount','value'=>"$roundoffworkingwallet",'class'=>'custom_form']);
                                                    echo form_input(['type'=>'hidden','name'=>'wallet_address','value'=>"$useraddress",'class'=>'custom_form']);
                                                    if($per->status != 1)   {
                                                      echo form_submit(['type'=>'submit','name'=>'submit','value'=>'click','class'=>'btn btn-success']);
                                                    }              
                                                    
                                                                     
                                                    echo form_close();

                                                ?>
                                          <?php //echo $achieveamount;?>
                                       <br>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $percatagevalue ?>"
                                                    aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percatagevalue ?>">
                                                    <?php if(isset($percatagevalue)){
                                                 			 echo $percatagevalue; 
                                                			}else{ 
                                                               echo "0"; 
                                                             } 
                                                  	?>
                                                </div>
                                            </div>
                                            <?php }}?>
                                        
                                        <br><br>
                                        <?php
                                        if ($user['withdraw_status'] == 0) {

                                            echo form_open('', array('id' => 'TopUpForm')); ?>
                                            <span class="text-danger">
                                                <?php echo $this->session->flashdata('message'); ?>
                                            </span>
                                           <div class="form-group">
                                            
                                            </div>
                                            <br><br>
                                            <!-- <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text" class="form-control" name="amount" id="amount" onblur="calculate_net_amount();" placeholder="Amount" value="<?php echo set_value('amount'); ?>" />
                                            <span class="text-danger"><?php echo form_error('amount') ?></span>
                                        </div> -->
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input type="text" class="form-control" name="amount" id="amount"
                                                    onkeyup="calculateCoin(this);" placeholder="Amount"
                                                    value="<?php echo set_value('amount'); ?>" />
                                               <input type="hidden" class="form-control" name="total_amount" value="<?php echo $roundoffworkingwallet; ?>" id="amount"
                                                    placeholder="Amount"
                                                    value="<?php echo set_value('amount'); ?>" />
                                                <span class="text-danger">
                                                    <?php echo form_error('amount') ?>
                                                </span>
                                              <input type="hidden" class="form-control" name="rvc_price"
                                           value="<?php echo $data['data']['price']; ?>"/>
                                                <span class="text-danger" id="getCoin"></span>
                                            </div>
                                            <!-- <div class="form-group" style="display:block">
                                <span class="text-success" id="usd_amount"></span>
                            </div> -->

                                            <!-- <div class="form-group" style="display:none">
                                <label>Net Byeol You Will Recieve</label>
                                <span class="text-success" id="netAmount"></span>
                            </div> -->
                                            <div class="form-group" style="display:none">
                                                <label>100% E-wallet Transfer</label><br>
                                                <!-- <input type="radio" name="pin_transfer" onclick="calculate_net_amount();" value="1" checked>Yes &nbsp; -->
                                                <input type="radio" name="pin_transfer" onclick="calculate_net_amount();"
                                                    value="0" checked>No
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <label>Transfer Amount to Topup-wallet</label>
                                                $<span class="text-success" id="bankAmount"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="form-control" name="credit_type" onchange="ChangeAddress()"
                                                    id="ADDWallet">
                                                    <!-- <option value="RVC">RVC</option>----->
                                                <option value="RVC">RVC</option>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label id="Wallet_NAme">RVC BEP20 ADDRESS </label>
                                            <input type="text" class="form-control" name="wallet_address"
                                                id="wallet_address" placeholder="Wallet Address"
                                                value="<?php echo $user['eth_address']; ?>" readonly />
                                        </div>

                                        <div class="form-group">
                                            <label id="Wallet_NAme">OTP</label>
                                            <input type="password" class="form-control" name="otp"
                                                placeholder="Enter OTP" value="" />
                                            <span class="text-danger">
                                                <?php echo form_error('otp') ?>
                                            </span>
                                            <button type="button" class="btn btn-success" id="otp" <?php echo $diable; ?> >GET OTP</button>

                                        </div>

                                        <!-- <div class="form-group">
                                            <label>USDT TRC20 ADDRESS</label>
                                           
                                            <input type="text" class="form-control" name="wallet_address" placeholder="USDT TRC20 Address" value="<?php echo $jsonData['busd'] ?>" readonly/>
                                        </div> -->

                                            <!-- <div class="form-group" style="display: none;">
                                            <label><?php echo currency; ?> Address</label>
                                            <select class="form-control" name="wallet_address">
                                                <option value="<?php echo $jsonData['busd'] ?>"><?php echo 'TRC20 Address: ' . $jsonData['busd'] ?></option> -->

                                            <!-- <option value="<?php //echo $user['eth_address'] 
                                                ?>"><?php //echo 'USDT Address: ' . $user['eth_address'] 
                                                    ?></option> -->
                                            <?php //if (!empty($jsonData['busd'])) :
                                                ?>
                                            <!-- <option value="<?php //echo $jsonData['busd'] 
                                                ?>"><?php //echo 'TRC20 Address: ' . $jsonData['busd'] 
                                                    ?></option> -->
                                            <?php //endif;
                                                ?>
                                            <!-- </select> -->
                                            <!-- <input type="text"  class="form-control"  placeholder="<?php //echo currency; 
                                                ?> Address" value=" <?php //echo $user['eth_address'] 
                                                     ?>"readonly/> -->
                                            <!-- </div> -->
                                            <!-- <div class="form-group">
                                                <label>OTP</label>
                                                <input type="password" class="form-control" name="otp"
                                                    placeholder="Enter OTP" value="" />
                                                <span class="text-danger">
                                                    <?php //echo form_error('otp') 
                                                        ?>
                                                </span>
                                                <button type="button" class="btn btn-success" id="otp">GET OTP</button>
                                            </div> -->
                                            <div class="form-group">

                                                <button type="subimt" id="withdraw_btn" style="display:none" name="save"
                                                    class="btn btn-success" />Withdrawal Now</button>

                                            </div>
                                            <?php echo form_close();
                                        } else {
                                            echo '<span class="text-danger">Withdrawal Closed By Admin</span>';
                                        }
                                        ?>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            if ($title == 'Principal Withdraw') {
                                                // echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Stake</button>';
                                                echo '<a href="' . base_url('Dashboard/Activation/principle_stake') . '" class="btn btn-primary">Stake</a>';
                                            }
                                            ?>
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
    </div>
</div>
<?php $jsonData = json_decode($user['other_address'], true); ?>

<?php include_once 'footer.php'; ?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('Dashboard/Activation/principleStake', ['id' => 'stakeForm']); ?>
            <div class="modal-header">
                <h5 style="color:black" class="modal-title" id="exampleModalLabel">Re Stake Available balance ($
                    <?php echo round($balance['balance'], 2); ?>)
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-danger" id="resMsg"></h5>
                <div class="form-group">
                    <label style="color:black">Amount</label>
                    <input type="number" class="form-control" name="amount" style="max-width: 400px">
                </div>
                <div class="form-group">
                    <label style="color:black">Staking Time</label>
                    <select class="form-control" name="days" style="max-width: 400px" id="days">
                        <option value="1">1 Days</option>
                        <option value="7">7 Days</option>
                        <option value="30">30 Days</option>
                        <option value="180">180 Days</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="stakeAmount(this,'stakeForm')" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    function resentOTP(evt) {
        var user_id = evt //document.getElementById('confirm_email').value;
        if (user_id != '') {
            var formData = new FormData();

            var csrf = document.getElementsByName("<?php echo $this->security->get_csrf_token_name(); ?>")[0].value;

            formData.append("<?php echo $this->security->get_csrf_token_name(); ?>", csrf);
            formData.append("user_id", user_id);

            fetch("<?php echo base_url('Dashboard/Register/resentOTP'); ?>", {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                },
                body: formData,
            })
                .then(response => response.json())
                .then(result => {
                    console.log(result);

                    document.getElementsByName("<?php echo $this->security->get_csrf_token_name(); ?>")[0].value =
                        result.token;
                    if (result.status == '1') {
                        toastr.success('OTP has been sent on your email.', {
                            timeOut: 5000
                        })
                        location.reload();

                    } else {
                        toastr.error('oops something went wrong', {
                            timeOut: 5000
                        })
                        location.reload();

                    };
                });
        }
    }

    const stakeAmount = (evt, id) => {
        document.getElementById('resMsg').innerHTML = 'Please Wait.....'
        var url = document.getElementById(id).action;
        var element = document.getElementById(id);
        fetch(url, {
            method: "POST",
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            body: new FormData(element),
        })
            .then(response => response.json())
            .then(result => {
                document.getElementById('resMsg').innerHTML = result.message
                var csrf_length = document.getElementsByName("csrf_test_name").length;
                for (let i = 0; i < csrf_length; i++) {
                    document.getElementsByName("csrf_test_name")[i].value = result.token;
                }
            })
    }
</script>
<script>
    $(document).on('click', '#otp', function () {
        var url = '<?php echo base_url('Dashboard/secureWithdraw/getOtp'); ?>'
        $.get(url, function (res) {
            if (res.status == 1) {
                $("#otp").css("display", "none");
                $("#withdraw_btn").css("display", "block");
                alert('OTP send to registered email address');
            } else {
                alert('Network error,please try later');
            }
        }, 'JSON')

    })
</script>
<script>
    $(document).on('blur', '#user_id', function () {
        var user_id = $('#user_id').val();
        if (user_id != '') {
            var url = '<?php echo base_url("Dashboard/get_app_user/") ?>' + user_id;
            $.get(url, function (res) {
                if (res.success == 1) {
                    $('#errorMessage').html(res.user.name);
                } else {
                    $('#errorMessage').html(res.message);
                }

            }, 'json')
        }
    })
    $(document).on('submit', '#TopUpForm', function () {
        if (confirm('Are You Sure U want to Withdraw This Account')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
    $(document).on('blur', '#amount', function () {
        var amount = $(this).val();
        //   var netAmount = amount * 90 /100;
        //   $('#netAmount').text(netAmount);
    })

    function calculate_net_amount() {
        var amount = $('#amount').val();
        var bankAmount;
        var tds = 0;
        var transfer_wallet = $("input[name='pin_transfer']:checked").val();
        console.log(transfer_wallet);
        if (transfer_wallet == 0) {
            bankAmount = amount * 90 / 100;
            // tds = amount * 5 /100;
        } else {
            bankAmount = amount * 90 / 100;
            // tds = amount * 5 /100;
        }

        var NetbankAmount = (bankAmount);
        $('#netAmount').text(NetbankAmount);
        $('#NetbankAmount').text(NetbankAmount);
        $('#bankAmount').text(bankAmount);
        $('#tds').text(tds);
    }


    function ChangeAddress() {
        var check = $('#ADDWallet').val();
        if (check == "USD") {
            document.getElementById('Wallet_NAme').innerHTML = "USDT TRC20 ADDRESS";
            document.getElementById('wallet_address').value = "<?php echo $jsonData['busd']; ?>";
        } else {
            document.getElementById('Wallet_NAme').innerHTML = "RVC BEP20 ADDRESS";
            document.getElementById('wallet_address').value = "<?php echo $user['eth_address']; ?>";
        }
    }

    function calculateCoin(evt) {
        let tokenValue = "<?php echo $data['data']['price']; ?>";
        var amount = evt.value;

        // var amount = evt.value;
        let coin = (amount * 0.9) / tokenValue;
        // var credit_type = document.getElementById('credit_type').value;
        if (amount > 0) {
            // if(credit_type === 'USDT'){
            document.getElementById('getCoin').innerHTML = 'You will get RVC ' + (coin);
            // }else{
            // document.getElementById('getCoin').innerHTML = 'You will get '+coin+' DTCOIN';
            // }
        } else {
            document.getElementById('getCoin').innerHTML = '';

        }

    }

</script>