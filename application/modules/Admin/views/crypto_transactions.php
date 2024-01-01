<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
        
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <section class="content-header">
                    <span class="">Crypto Transaction</span>
                </section>  
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Crypto Transaction</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
     
    
  
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                        <!-- /.card-header -->
                            <div class="card-body">
                                <h3><?php echo $this->session->flashdata('message');?></h3>
                                <?php echo form_open();?>
                                <div class="form-group">
                                    <label>UserID</label>
                                    <input type="text" name="" class="form-control" value="<?php echo $transaction['user_id'];?>"  placeholder="User ID" readonly/>
                                    <label class="text-danger"></label>
                                </div> 
                                <div class="form-group">
                                    <label>Hash</label>
                                    <input type="text" name="" class="form-control" value="<?php echo $transaction['hash'];?>" readonly/>
                                    <label class="text-danger"></label>
                                </div> 
                                <div class="form-group">
                                    <label>From</label>
                                    <input type="text" name="" class="form-control" value="<?php echo $transaction['from'];?>"  readonly/>
                                    <label class="text-danger"></label>
                                </div> 
                                <div class="form-group">
                                    <label>to</label>
                                    <input type="text" name="" class="form-control" value="<?php echo $transaction['to'];?>" readonly/>
                                    <label class="text-danger"></label>
                                </div> 
                                <div class="form-group">
                                    <label>Token </label>
                                    <input type="text" name="" class="form-control" value="<?php echo $transaction['tokenName'];?>" readonly/>
                                    <label class="text-danger"></label>
                                </div> 
                                 <div class="form-group">
                                    <label>Token </label>
                                    <input type="text" name="" class="form-control" value="<?php echo $transaction['value'];?>" readonly/>
                                    <label class="text-danger"></label>
                                </div> 
                                <!-- <div class="form-group">
                                    <label>Trx Balance  </label>
                                    <button class="btn btn-success">Balance</button>
                                </div> --> 
                                <!-- <div class="form-group">
                                    <button type="submit" class="btn btn-success pull-right">Update</button>
                                </div> -->
                                <?php echo form_close();?>
                            </div> 
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <iv class="col-6">
                    <div class="card">
                        <div class="card-body">
                        <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label>USDT Balance</label>
                                    <input type="text" id="usdt" class="form-control"   readonly/>
                                </div> 
                                <div class="form-group">
                                    <button type="submit" onclick="collectData('<?php echo $transaction['id']?>')"class="btn btn-success pull-right">USDT Balance</button>
                                </div>
                                 <div class="form-group">
                                    <label>Tron balance</label>
                                    <input type="text" id="tron" class="form-control"   readonly/>
                                </div> 
                                <div class="form-group">
                                    <button type="submit" onclick="tronbalance('<?php echo $transaction['id']?>')"class="btn btn-success pull-right">Tron Balance</button>
                                </div>
                                 <div class="form-group">
                                    <label  ></label>
                                    <input type="text" class="form-control"  id="troncredit" readonly/>
                                </div> 
                                <div class="form-group">
                                    <button type="submit" onclick="credittron('<?php echo $transaction['id']?>')"class="btn btn-success pull-right">Credit Tron</button>
                                </div>
                                
                                <span class="text-danger">Please wait 1 minutes after credit tron.</span>
                                 <div class="form-group">
                                    <label>Debit USDT</label>
                                    <input type="text" id="trondebit" class="form-control"   readonly/>
                                </div> 
                                <div class="form-group">
                                    <button type="submit" onclick="debittron('<?php echo $transaction['id']?>')"class="btn btn-success pull-right">Debit USDT</button>
                                </div>
                            </div> 
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
<?php include'footer.php' ?>

<script>
function collectData(id){
        // alert('op');
   var url = '<?php echo base_url("Admin/Crypto/usdtBalance");?>/'+id;
   fetch(url,{
      method:"GET",
   })
   .then(response => response.json())
   .then(response => {
    console.log(response['balance']);
      document.getElementById('usdt').value = response['balance'];
   })
   

 }

 function tronbalance(id){
        // alert('op');
   var url = '<?php echo base_url("Admin/Crypto/trxBalance");?>/'+id;
   fetch(url,{
      method:"GET",
   })
   .then(response => response.json())
   .then(response => {
    console.log(response);
      document.getElementById('tron').value = response['balance'];
   })
   

 }


  function credittron(id){
        // alert('op');
   var url = '<?php echo base_url("Admin/Crypto/creditTron");?>/'+id;
   fetch(url,{
      method:"GET",
   })
   .then(response => response.json())
   .then(response => {
    console.log(response);
    alert(response['success']);
      document.getElementById('troncredit').value = response['receipt']['txid'];
   })
   

 }

 function debittron(id){
        // alert('op');
   var url = '<?php echo base_url("Admin/Crypto/debitUsdt");?>/'+id;
   fetch(url,{
      method:"GET",
   })
   .then(response => response.json())
   .then(response => {
    console.log(response);
    alert(response['success']);
      document.getElementById('trondebit').value = response['receipt']['txid'];
   })
   

 }
</script>       