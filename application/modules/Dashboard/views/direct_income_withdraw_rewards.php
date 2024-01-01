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
                    <?php echo $title; ?>
                </span>
            </div>

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

                                        <?php
                                        if ($user['withdraw_status'] == 0) {

                                            echo form_open('', array('id' => 'TopUpForm')); ?>
                                            <span class="text-danger">
                                                <?php echo $this->session->flashdata('message'); ?>
                                            </span>
                                            <?php 
                                            $roundvalue = $roi_income['roi_income'] - $user['offset_wallet'];
                                            $reward_per_bal =$roundvalue -  $reward_balance['reward_balance'];
                                           
                                            ?>
                                            <div class="form-group">
                                                <label style="font-size:20px; color:#00ecc6">Available Staking Reward Balance ($
                                                    <?php echo round($reward_per_bal, 2); ?>)
                                                </label><br>
                                            </div>
                                            <!-- <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text" class="form-control" name="amount" id="amount" onblur="calculate_net_amount();" placeholder="Amount" value="<?php echo set_value('amount'); ?>" />
                                            <span class="text-danger"><?php echo form_error('amount') ?></span>
                                        </div> -->
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input type="number" class="form-control" name="amount" id="amount"
                                                    onkeyup="calculateCoin(this);" placeholder="Amount"
                                                    value="<?php echo set_value('amount'); ?>" max="<?php echo $reward_per_bal;?>"/>
                                                <span class="text-danger">
                                                    <?php echo form_error('amount') ?>
                                                </span>
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
                                        <input type="hidden" value="<?php echo $reward_per_bal;?>" name="total_value">
                                      <input type="hidden" name="user_id"
                                                    value="<?php echo $this->session->userdata['user_id'];?>">

                                        <div class="form-group">
                                            <label id="Wallet_NAme">OTP</label>
                                            <input type="password" class="form-control" name="otp"
                                                placeholder="Enter OTP" value="" />
                                            <span class="text-danger">
                                                <?php echo form_error('otp') ?>
                                            </span>
                                            <?php 
                                          $statingdate = "1";
                                            $endingdate = "1";

                                            $middate = "15";
                                            $endingmidate = "15";
                                            date_default_timezone_set("Asia/Calcutta"); //India time (GMT+5:30)
                                            //echo date('d-m-Y H:i:s');
                                            $checkdate = date('d'); 
                                           // echo $checkdate;
                                            if($checkdate >= $statingdate && $checkdate <= $endingdate){
                                                $morningtime = date('h:i');
                                                if($morningtime >= "8:00"){
                                                    if($morningtime <= "20:00"){
                                                        $deseable = '';
                                                    }
                                                     
                                                }
                                               
                                            }elseif($checkdate >= $middate && $checkdate <= $endingmidate){
                                                $morningtime = date('h:i');
                                                if($morningtime >= "8:00"){
                                                    if($morningtime <= "20:00"){
                                                        $deseable = '';
                                                    }
                                                }
                                            } 
                                                else{
                                                $deseable = 'disabled'; 
                                            }
                                             
                                            ?>
                                            <button style="margin-top:10px" type="button" class="btn btn-success" id="otp"   <?php echo $deseable?>
                                            >GET OTP</button>
                                            <p style="color:#fff;margin-top:10px;">Withdrawal will enable on 1st and 15th of each month 8:00am to 8:00pm only </p>

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
        let tokenValue = "<?php //echo $tokenValue['amount']; ?>1.15";
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