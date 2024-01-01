<?php include_once'header.php'; ?>

<div class="content-body">
			<div class="container-fluid">
<div>
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
      <div class="panel-heading">
        <span>Support  /  Compose Mail</span>
    </div>
 
    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
       <div class="card-body">
         <h4 class="page-header">

        <small>Create a New Ticket</small>
    </h4>
    <div id="rootwizard" class="wizard wizard-full-width border-0">
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content p-0">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-12">
                          <?php echo form_open('', array('id' => 'composeMail')); ?>
                          <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
                          <div class="form-group">
                              <label>Topic</label>
                              <select class="form-control" name="title">
                                  <option>General</option>
                                  <option>Withdraw</option>
                                  <option>Topup</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Message</label>
                              <textarea class="form-control" name="message" required></textarea>
                          </div>
                          <div class="form-group">
                              <button type="subimt" name="save" class="btn btn-success" />Send</button>
                          </div>
                          <?php echo form_close(); ?>
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
   </div>

    <!-- END wizard -->
  </div>
</div>
</div>









<?php include_once'footer.php'; ?>
