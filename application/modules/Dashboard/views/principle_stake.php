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
        <span style=""><?php echo $title; ?> </span>
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

                        <?php echo form_open('Dashboard/Activation/principle_stake',['id' => '']);?>

                            <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                            <h5 class="text-danger" id="resMsg"></h5>

                            <div class="form-group">
                                <label style="font-size:20px; color:#00ecc6">Re Stake Available balance ($<?php echo round($balance['balance'],2);?>)</label><br>
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount"  placeholder="Amount" value="<?php echo set_value('amount');?>"/>
                                <span class="text-danger"><?php echo form_error('amount')?></span>
                            </div>
                            <div class="form-group">
                                <label>Staking Time</label>
                                <select class="form-control" name="days"  id="days">
                                    <option value="1">1 Days</option>
                                    <option value="7">7 Days</option>
                                    <option value="30">30 Days</option>
                                    <option value="180">180 Days</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php ?>
                                <button type="subimt"  name="save" class="btn btn-primary" />Submit</button> 
                            </div>
                            <?php echo form_close();?>

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

<?php include_once 'footer.php'; ?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <?php echo form_open('Dashboard/Activation/principleStake',['id' => 'stakeForm']);?>
            <div class="modal-header">
                <h5 style="color:black" class="modal-title" id="exampleModalLabel">Re Stake Available balance ($<?php echo round($balance['balance'],2);?>)</h5>
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
        <?php echo form_close();?>
    </div>
  </div>
</div>
<script>

    const stakeAmount = (evt,id) => {
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
            window.location.href = result.url;
            // var csrf_length = document.getElementsByName("csrf_test_name").length;
            // for (let i = 0; i < csrf_length; i++) {
            //     document.getElementsByName("csrf_test_name")[i].value = result.token;
            // }
        })
    }

    $(document).on('click','#otp',function(){
        var url = '<?php echo base_url('Dashboard/secureWithdraw/getOtp');?>'
        $.get(url,function(res){
            if(res.status == 1){
                $("#otp").css("display", "none");
                alert('OTP send to registered mobile number');
            }else{
                alert('Network error,please try later');
            }
        },'JSON')
    })
</script>
<script>
    $(document).on('blur','#user_id',function(){
        var user_id = $('#user_id').val();
        if(user_id != ''){
            var url  = '<?php echo base_url("Dashboard/get_app_user/")?>'+user_id;
            $.get(url,function(res){
                if(res.success == 1){
                    $('#errorMessage').html(res.user.name);
                }else{
                    $('#errorMessage').html(res.message);
                }

            },'json')
        }
    })
    $(document).on('submit','#TopUpForm',function(){
        if (confirm('Are You Sure U want to Withdraw This Account')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
    $(document).on('blur','#amount',function(){
      var amount = $(this).val();
    //   var netAmount = amount * 90 /100;
    //   $('#netAmount').text(netAmount);
    })
    function calculate_net_amount(){
        var amount = $('#amount').val();
        var bankAmount;
        var tds = 0;
        var transfer_wallet = $("input[name='pin_transfer']:checked").val();
        console.log(transfer_wallet);
        if(transfer_wallet == 0){
            bankAmount = amount * 90 /100;
            // tds = amount * 5 /100;
        }else{
            bankAmount = amount * 90 /100;
            // tds = amount * 5 /100;
        }

        var NetbankAmount = (bankAmount);
        $('#netAmount').text(NetbankAmount);
         $('#NetbankAmount').text(NetbankAmount);
        $('#bankAmount').text(bankAmount);
        $('#tds').text(tds);
    }

</script>
