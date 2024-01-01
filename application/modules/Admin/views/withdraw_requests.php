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
            <span class="">Withdraw Request </span>
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
              <span style=""> Wallet balance: <span id="balance"></span><br>
                <span style=""> Wallet Address: <span id="wallet_address"></span><br>

                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">


                    <?php echo form_open('', array('id' => 'withDrawPayments')); ?>

                    <?php echo form_close() ?>

                    <table class="table table-hover" id="tableView">
                      <thead>
                        <tr>

                          <th>#</th>
                          <th>Action</th>

                          <th>User ID</th>
                          <th>Name</th>
                          <th>Phone</th>
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
                          <th>BEP20 Address</th>
                          <th>TRC20 Address</th>
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
                        foreach ($requests as $key => $request) {
                          //                        pr($request);
                        ?>
                          <tr>
                            <td><?php echo ($key + 1) ?></td>
                            <td class="w-300">
                              <?php 
                              if ($request['status'] == 0) {
                                echo form_open(base_url('Admin/Withdraw/requestWithdraw/'.$request['id']));
                                echo form_hidden('id',$request['id']);
                                $option = [
                                  '1' => 'Approve',
                                  '2' => 'Reject'
                                ];
                                echo form_dropdown('status',$option);
                                echo form_input(['type'=>'text','name'=>'remark','placeholder'=>'Enter Remark','class'=>'custom_form']);
                                echo form_submit(['type'=>'submit','name'=>'submit','value'=>'Submit','class'=>'btn btn-success']);
                                echo form_close();

                              }
                              
                              ?>
                            </td>
                            <td><?php echo $request['user_id']; ?></td>
                            <td><?php echo $request['user']['name']; ?></td>
                            <td><?php echo $request['user']['phone']; ?></td>
                            <td><?php echo $request['amount']; ?></td>
                            <td><?php echo $request['tds'] + $request['admin_charges']; ?></td>
                            <td><?php echo $request['payable_amount']; ?></td>
                            <td><?php echo $request['coin'];
                                ?></td>
                            <td><?php echo $request['token_price'];
                                ?></td>
                            <td><?php echo ucwords(str_replace('_', ' ', $request['type'])); ?></td>
                            <td><?php
                                $dataForPaying = json_encode($request, true);
                                if ($request['status'] == 0) {
                                  echo "<button class='btn btn-primary'> Pending</button>";
                                  $dd = 'withdraw_' . $request['id'];
                                  echo form_open(base_url(), ['id' => $dd]);
                                ?>
                                <input type="hidden" name="id" value="<?php echo $request['id']; ?>" required="true">
                                <input type="hidden" name="payable_amount" value="<?php echo $request['payable_amount']; ?>" required="true">

                                <!-- <button type='button' class='btn btn-danger' onclick='withdraw(this, "<?php echo $dd; ?>")' data-id='<?php echo $request['id']; ?>' data-wallet_address='<?php echo $request['zil_address']; ?>' data-payable_amount='<?php echo $request['payable_amount']; ?>'><i class='fas fa-bolt' aria-hidden='true'> Pending</button> -->
                              <?php echo form_close();
                                } elseif ($request['status'] == 1) {
                                  echo "<button class='btn btn-success'> Approved</button>";
                                } elseif ($request['status'] == 2) {
                                  echo 'Rejected';
                                }
                              ?>

                              <!-- <select class="form-control" name="status">
                                <option value="1">Approve</option>
                                <option value="2">Reject</option>
                              </select> -->
                            </td>
                            <!-- <td> -->
                            <?php

                            // if($request['credit_type'] == 'BlockChain'){
                            //   echo $request['bank']['btc'].'<br>';

                            // }else{

                            // if ($request['bank']['kyc_status'] == 0)
                            //     $kyc_status = 'Not Applied';
                            // elseif ($request['bank']['kyc_status'] == 1)
                            //     $kyc_status = 'Pending';
                            // elseif ($request['bank']['kyc_status'] == 2)
                            //     $kyc_status = 'Approved';
                            // elseif ($request['bank']['kyc_status'] == 3)
                            //     $kyc_status =  'Rejected';

                            // echo 'Bank Name :'. $request['bank']['bank_name'].'<br>';
                            // echo 'Bank Account Number :'. $request['bank']['bank_account_number'].'<br>';
                            // echo 'Account Holder Name :'. $request['bank']['account_holder_name'].'<br>';
                            // echo 'Ifsc Code :'. $request['bank']['ifsc_code'].'<br>';
                            // echo 'Kyc Status :'. $kyc_status.'<br>';

                            // echo '<td>'. $request['bank']['bank_name'].'</td>';
                            // echo '<td>'. $request['bank']['bank_account_number'].'</td>';
                            // echo '<td>'. $request['bank']['account_holder_name'].'</td>';
                            // echo '<td>'. $request['bank']['ifsc_code'].'</td>';
                            // echo '<td>'. $kyc_status.'</td>';

                            // echo 'BTC : '. $request['bank']['btc'].'<br>';
                            // echo 'Ethereum : '. $request['bank']['ethereum'].'<br>';
                            // echo 'Tron : '. $request['bank']['tron'].'<br>';
                            // echo 'Litecoin : '. $request['bank']['litecoin'].'<br>';
                            // echo 'XRP : '. $request['bank']['xrp'].'<br>';
                            // echo 'One FX : '. $request['bank']['one_fx'].'<br>';

                            //}
                            ?>
                            <!-- </td> -->
                            <!-- <td><?php // echo $request['bank']['btc']; 
                                      ?></td>
                                      <td><?php // echo $request['bank']['ethereum']; 
                                          ?></td>
                                      <td><?php // echo $request['bank']['tron']; 
                                          ?></td> -->
                            <td><?php echo $request['zil_address']; ?></td>
                            <td><?php echo $request['user']['eth_address']; ?></td>


                            <td><?php
                                $jsonData = json_decode($request['user']['other_address'], true);
                                echo $jsonData['busd'];
                                ?></td>


                            <!-- <td><?php // echo $request['bank']['litecoin'];  -->
                                      ?></td>
                       <td><?php // echo $request['bank']['xrp']; 
                            ?></td>
                                      <td><?php // echo $request['bank']['one_fx']; 
                                          ?></td> -->

                            <td><?php echo $request['remark']; ?></td>
                            <td><?php echo $request['created_at']; ?></td>
                            <!-- <td><?php // echo $request['credit_type']; 
                                      ?></td> -->
                            <!-- <td> -->
                            
                                <!-- <a class="btn btn-success" href="<?php //echo base_url('Admin/Withdraw/approveNormal/' . $request['id']) ?>">Approve</a>  -->
                                <!-- <a class="btn btn-danger" href="<?php //echo base_url('Admin/Withdraw/rejectNormal/' . $request['id']) ?>">Reject</a> -->
                   <!-- <a href="<?php //echo base_url('Admin/Withdraw/request/' . $request['id']); ?>" target="_blank">View</a> -->
                           
                              <!-- </td> -->
                       
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
