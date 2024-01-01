<?php include 'header.php' ?>
<style>
  td.w-300 {
    width: 300px !important;
}
input.custom_form {
    margin: 8px 0px;
    padding: 4px 6px;
}
</style>
<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <section class="content-header">
            <span class="">Pending Withdraw Request (9 Dec)</span>
          </section>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Withdraw Request </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
          

                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">

                    <table class="table table-hover" id="tableView">
                      <thead>
                        <tr>

                          <th>#</th>
                     

                          <th>User ID</th>
                          <th>Amount</th>
                          <th>Deductions</th>
                          <th>Payable Amount</th>
                          <th>coin</th>
                          <th>Token Price</th>
                          <!-- <th>Byeol</th> -->
                          <th>Type</th>
                          <th>Status</th>
                          <!-- <th>BTC</th>
                            <th>Ethereum</th>
                            <th>Tron</th> -->
                          <th>MPY Address</th>
                          
                          <!-- <th>Litecoin</th> -->
                          <!-- <th>XRP</th>
                            <th>One FX</th> -->
                          <th>Remark</th>
                          <th>Request Date</th>
                          <!-- <th>Credit IB</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($users as $key => $request) {
                        //  echo "<pre>";   print_r($request);die();                  
                        ?>
                          <tr>
                            <td><?php echo ($key + 1) ?></td>
                          
                            <td><?php echo $request['user_id']; ?></td>
                            <td><?php echo $request['amount']; ?></td>
                            <td><?php echo $request['tds'] + $request['admin_charges']; ?></td>
                            <td><?php echo $request['payable_amount']; ?></td>
                            <td><?php echo $request['coin'];
                                ?></td>
                            <td><?php echo $request['token_price'];
                                ?></td>
                            <td><?php echo ucwords(str_replace('_', ' ', $request['type'])); ?></td>
                            <td><?php
                                // $dataForPaying = json_encode($request, true);
                                // if ($request['status'] == 0) {
                                  // echo "<button class='btn btn-primary'> Pending</button>";
                                  // $dd = 'withdraw_' . $request['id'];
                                  // echo form_open(base_url(), ['id' => $dd]);
                                ?>
                                <input type="hidden" name="id" value="<?php echo $request['id']; ?>" required="true">
                                <input type="hidden" name="payable_amount" value="<?php echo $request['payable_amount']; ?>" required="true">

                                <!-- <button type='button' class='btn btn-danger' onclick='withdraw(this, "<?php echo $dd; ?>")' data-id='<?php echo $request['id']; ?>' data-wallet_address='<?php echo $request['zil_address']; ?>' data-payable_amount='<?php echo $request['payable_amount']; ?>'><i class='fas fa-bolt' aria-hidden='true'> Pending</button> -->
                              <?php echo form_close();
                              
                                  echo "<button class='btn btn-success'> Approved</button>";
                              ?>
                            <td><?php echo $request['zil_address']; ?></td>

                            <td><?php echo $request['remark']; ?></td>
                            <td><?php echo $request['created_at']; ?></td>
                        
                       
                          </tr>
                        <?php
                        }
                        ?>

                      </tbody>
                    </table>
                    <?php
                    echo $this->pagination->create_links();
                    ?>
                  </div>
                  <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer1.php' ?>
