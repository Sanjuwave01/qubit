<?php include_once 'header.php'; ?>
<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <section class="content-header">
            <span class="">Update Stake History</span>
          </section>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Settings</li>
            <li class="breadcrumb-item"> Stake History</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <h3><?php echo $this->session->flashdata('message'); ?></h3>
              <?php echo form_open(); ?>
              <div class="form-group">
                <label>Coin</label>
                <input type="text" name="coin" class="form-control" value="<?php echo $user['coin']; ?>" />
                <label class="text-danger"><?php echo form_error('coin'); ?></label>
              </div>
              <div class="form-group">
                <label>Amount</label>
                <input type="text" name="roi_amount" class="form-control" value="<?php echo $user['roi_amount']; ?>" />
                <label class="text-danger"><?php echo form_error('roi_amount'); ?></label>
              </div>
              <div class="form-group">
                <label>Total Days</label>
                <input type="text" name="total_days" class="form-control" value="<?php echo $user['total_days']; ?>" />
                <label class="text-danger"><?php echo form_error('total_days'); ?></label>
              </div>
              <div class="form-group">
                <label>Days</label>
                <input type="text" name="days" class="form-control" value="<?php echo $user['days']; ?>" />
                <label class="text-danger"><?php echo form_error('days'); ?></label>
              </div>
              <div class="form-group">
                <label>Credit Date</label>
                <input type="text" name="created_at" class="form-control" value="<?php echo $user['created_at']; ?>" />
                <label class="text-danger"><?php echo form_error('created_at'); ?></label>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success pull-right">Update</button>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once 'footer1.php'; ?>