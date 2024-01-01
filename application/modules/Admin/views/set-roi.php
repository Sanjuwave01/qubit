<?php include_once'header.php'; ?>
 <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
       <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class=""><?php echo $header;?></span>
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <?php echo $this->session->flashdata('message'); ?>
            <?php echo form_open();?>
            <div class="form-group">
                <label><?php echo $label;?></label>
                <input type="text" class="form-control" name="amount" value="<?php echo $token_value['amount'];?>" placeholder="Enter Amount"/>
                <span class="text-danger"><?php echo form_error('amount')?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Update</button>
            </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include_once'footer1.php'; ?>