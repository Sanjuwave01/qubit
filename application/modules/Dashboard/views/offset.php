<?php include_once'header.php'; 
//die('under mantainace !');
$d_none=true;

?>
<style>

.text-success {
    float: left;
    width: 100%;
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

                         <?php $roundvalue = $roi_income['roi_income'] - $user['offset_wallet'];?>
                          <h4 class="panel-title">Staking Wallet ($ <?php echo $roundvalue;?>)</h4>
                                                              </div>
 


    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
                                   <div class="card-body">
      

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
                    <?php echo form_open('', array('id' => 'offset_wallet')); ?>
                       <div class="form-group">
                        <label>Transfer Amount in Offset Wallet</label>
                        <input type="number" class="form-control" name="amount"
                           min="15" max="<?php echo $roundvalue;?>" value="" placeholder="Enter Amount"
                            style="max-width: 400px" id="amount"/>
                        
                    </div>
                    
                    
                    <div class="form-group" id="SaveBtn">
                        <button type="submit" name="save" class="btn btn-success">Transfer</button>
                    </div>
                    <?php echo form_close(); ?>

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

