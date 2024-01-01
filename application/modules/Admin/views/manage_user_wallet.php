<?php include_once'header.php'; ?>
 <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
        
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage User Wallet</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
    
        <div class="card">
          <div class="card-body">
        <div class="row">

          <div class="col-md-6">
          <?php echo $this->session->flashdata('error');?>
            <?php echo form_open_multipart('',array('id' => 'walletForm'));?>
            <h3 class="text-danger"><?php if(!empty($error)) {echo $error;}  ?></h3>
            <div class="form-group">
                <label>User</label>
                <input type="text" class="form-control" name="user_id"  id="user_id" placeholder="user"/>
                <span class="text-danger"><?php echo form_error('user_id')?></span>
                <span id="errorMessage"></span>
            </div>
            <h3 class="text-danger"><?php if(!empty($error)) {echo $error;}  ?></h3>
            <div class="form-group">
                <label>Amounts</label>
                <input type="text" class="form-control" name="amount"  id="user_id" placeholder="Amount"/>
                <span class="text-danger"><?php echo form_error('amount')?></span>
                <span id="errorMessage"></span>
            </div>
            <h3 class="text-danger"><?php if(!empty($error)) {echo $error;}  ?></h3>
            <div class="form-group">
                <label>Select Type</label>
                <select class="form-control" name="type" id="type">
                    <option value="1">Add </option>
                    <option value="2">Subtract</option>
                </select>
                <span class="text-danger"><?php echo form_error('type')?></span>
                <span id="errorMessage"></span>
            </div>
            
            
            
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Add/Sub</button>
            </div>
            <?php echo form_close();?>
          </div>
           </div>
        </div>
        </div>
      </div>
    </div>
     </div>

<?php include_once'footer1.php'; ?>
<script>
  $(document).on('change','#selectType',function(){
        $('#imageField').toggle();
        $('#videoField').toggle();
  })
</script>
