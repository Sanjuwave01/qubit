<?php include'header.php' ?>
<div class="main-content">
  <div class="page-content">
<div class="container-fluid">
  <!-- Breadcrumb-->
   <div class="row pt-2 pb-2">
      <div class="col-sm-9">
      <h4 class="page-title">Withdraw Money</h4>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('Dashboard'); ?>">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Withdraw Money</li>
       </ol>
   </div>

   </div>

  <div class="row">
    <div class="col-lg-12">
       <div class="card">
         <div class="card-body">
            <?php
            echo $date = date('H:i');
            //
            if($user['directs'] >= 2){
            if($admin['withdraw_status'] == 0){
            //     if($user['withdraw_status'] == 0){
                //if(($date >= '11:00' && $date <= '22:00')){

                    echo form_open('',array('id' => 'TopUpForm'));?>
                        <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                        <div class="form-group">
                            <label style="font-size:20px; color:red">Available balance (Rs.
                                <?php echo $balance['balance'];?>)</label><br>
                        </div>
                        <div class="form-group">
                            <label>Benficiary ID</label>
                            <input type="text" class="form-control" name="beneficiary_id" placeholder="Beneficiary ID"
                                value="<?php echo $beneficiary_id;?>" />
                            <span class="text-danger"><?php echo form_error('beneficiary_id')?></span>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" name="amount" id="amount"
                                onblur="calculate_net_amount();" placeholder="Amount"
                                value="<?php echo set_value('amount');?>" />
                            <span class="text-danger"><?php echo form_error('amount')?></span>
                        </div>
                        <div class="form-group">
                            <label>Transaction Pin</label>
                            <input type="password" class="form-control" name="master_key" placeholder="Master Key"
                                value="" />
                            <span class="text-danger"><?php echo form_error('master_key')?></span>
                        </div>
                        <div class="form-group">
                                <label>OTP</label>
                                <input type="password" class="form-control" name="otp" placeholder="Enter OTP"
                                    value="" />
                                <span class="text-danger"><?php echo form_error('otp') ?></span>
                                <button type="button" class="btn btn-success" id="otp">GET OTP</button>
                            </div>
                        <div class="form-group">
                            <button type="subimt" name="save" class="btn btn-success" />Withdraw Now</button>
                        </div>
                        <?php echo form_close();
                // }else{
                // echo '<span class="text-danger">Withdraw Between 11AM to 5PM Daily. <br>  </span>';
                // }
                }else{
                echo '<br><span class="text-danger">Withdraw Closed!</span>';
                }

                }else{
                echo '<br><span class="text-danger">Two Directs Required for Withdraw!</span>';
                }
            // }else{
            //     echo '<span class="text-danger">Withdraw Closed!</span>';
            // }
            ?>
            </div>
            <!--end: Datatable -->
        </div>
    </div>
</div>
<?php include'footer1.php' ?>
<script>
$(document).on('click','#otp',function(){
    var url = '<?php echo base_url('Dashboard/Support/generateKey');?>'
    $.get(url,function(res){
        if(res.success == 1){
            $("#otp").css("display", "none");
            alert('OTP send to registered mobile number');
        }else{
            alert('Network error,please try later');
        }
    },'JSON')
})
</script>
