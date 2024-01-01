<?php include_once'header.php'; 
//die('under mantainace !');
$d_none=true;

?>
<style>

.text-success {
    float: left;
    width: 100%;
}
  #myDIV {
    display:none;
}
</style>
<div class="content-body">
			<div class="container-fluid">
        <div>

    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->

   
<div class="panel-heading">
                          <h4 class="panel-title">Activate Account</h4>
                                                              </div>
 


    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
                                   <div class="card-body">
      <h4 class="page-header">
        <span style=""> Wallet balance <span id=""> (<?php echo '$'.$wallet['wallet_balance'];?>)</span></span><br>
        <span style=""> Offset Wallet balance <span id=""> (<?php echo '$'.$user['offset_wallet_per'];?>)</span></span>


    </h4>

        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

        <div class="wizard-content tab-content p-0">
            <!-- BEGIN tab-pane -->
            <div class="tab-pane active show" id="tabFundRequestForm">
                <!-- BEGIN row -->
                <div class="col-md-12 p-0">
                    <!-- BEGIN col-6 -->
                    <?php echo $this->session->flashdata('message'); ?>
                    <?php
                        if($d_none == true){
                    echo form_open('', array('id' => 'TopUpForm')); ?>
                    <div class="form-group">
                        <label>User ID</label>
                        <input type="text" class="form-control" id="user_id" name="user_id"
                            value="<?php echo set_value('user_id'); ?>" placeholder="User ID"
                            style="max-width: 400px" />
                        <span class="text-danger"><?php echo form_error('user_id') ?></span>
                        <span class="text-danger" id="errorMessage"></span>
                    </div>
                    <input type="hidden" id="wallet_address" name="eth_address">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" name="amount"
                            value="<?php echo set_value('amount'); ?>" placeholder="Enter Amount"
                            style="max-width: 400px" id="amount" onkeyup="calculateCoin(this);" />
                        <span class="text-danger"><?php echo form_error('amount') ?></span>
                       <input type="hidden" class="form-control" name="rvc_price"
                            value="<?php echo $data['data']['price']; ?>"/>
                      <span class="text-danger" id="getCoin"></span>
                    </div>
                  
                      <div class="form-group">
                        <input type="radio" onclick="myFunction()"> <span style="color:#fff">Select Offset Wallet Balance</span>
                        <br>
                        <div id="myDIV" >
                        <select class="form-control" name="perce" style="max-width: 400px;" id="perce">
                            <option value="">Select Percentage</option>
                                <option value="10">10%</option>
                                <option value="20">20%</option>
                                <option value="30">30%</option>
                                <option value="50">50%</option>
                            </select>
                      </div>
                    </div>      
                    <div class="form-group">
                        <label>Staking Time</label>
                        <select class="form-control" name="days" style="max-width: 400px" id="days">
                            <option value="18">18 Months</option>
                           <!-- <option value="20">20 Months</option>-->
                            <option value="36">36 Months</option>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label>Choose Package</label>
                        <select class="form-control" name="package_id" style="max-width: 400px">
                            <?php
                            // foreach($packages as $key => $package){
                            //     echo'<option value="'.$package['id'].'">'.$package['title'].' With '.currency.' '.$package['price'].' </option>';
                            // }
                            ?>
                        </select>
                    </div> -->

                    <!-- <div class="form-group" id="SaveBtn">
                        <button type="button" name="save" class="btn btn-success" onclick="activateNow(this,'TopUpForm')">Activate</button>
                    </div> -->
                    <div class="form-group" id="SaveBtn">
                        <button type="submit" name="save" class="btn btn-success">Activate</button>
                    </div>
                    <?php echo form_close(); 
                        }else{
                            echo '<span class="text-danger">We are working on it.Please wait...</span>';
                        }
                    ?>

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
  </div></div>
     </div> 
</div>

<?php include_once'footer.php'; ?>
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
<script src="<?php echo base_url('SmartChain/web3.min.js'); ?>"></script>
<script src="<?php echo base_url('SmartChain/web3modal.js'); ?>"></script>
<script src="<?php echo base_url('SmartChain/evm-chains.js'); ?>"></script>
<script src="<?php echo base_url('SmartChain/config.js'); ?>"></script>
<script src="<?php echo base_url('SmartChain/main.js'); ?>"></script> -->
<script>
$(document).on('blur', '#user_id', function() {
    var user_id = $('#user_id').val();
    if (user_id != '') {
        var url = '<?php echo base_url("Dashboard/check_sponser_packages/") ?>' + user_id;
        var html = '';
        $.get(url, function(res) {

            console.log(res);
            $('#errorMessage').html(res.message);
            $('#user_id').val(res.user.user_id);
            $.each(res.packages,function(key,value){
                html +='<option value="'+ value.id +'">'+value.title+' With Rs. ' + value.price+' </option>';
            })
            $('#packages').html(html);
        },'json')
    }
})
$(document).on('submit', 'form', function() {
    if (confirm('Are You Sure U want to Topup This Account')) {
        yourformelement.submit();
    } else {
        return false;
    }
})
$(document).on('change', '#PackageId', function() {
    var package_price = parseInt($(this).children("option:selected").data('price'));
    $('#Payamount').val(package_price);
    // alert(package_price)
})
$(document).on('change', '#payment_method', function() {
    $('#SaveBtn').toggle();
    $('#PayBtcBtn').toggle();
})
$(document).on('click', '#PayBtcBtn', function(e) {
    var formData = $(this).serialize();
    var user_id = $('#user_id').val();
    console.log(formData);
    if (user_id == '') {
        alert('Please Fill User ID');
        return;
    }
    $('#BtcForm').submit();
})

</script>
<script>
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
  
}
</script>
<script>
 function calculateCoin(evt) {
        let tokenValue = "<?php echo $data['data']['price']; ?>";
        var amount =  document.getElementById('amount').value;
         //alert(amount);
        // var amount = evt.value;
        let coin = amount / tokenValue;
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
