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
            <span class="">Stacking Reward Withdraw History</span>
          </section>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Stacking Reward Withdraw History </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              

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
                          
                          <th>Amount</th>
                          <th>Deductions</th>
                          <th>Payable Amount</th>
                          <th>coin</th>
                          <th>Token Price</th>
                          
                          <th>Type</th>
                          <th>Status</th>
                         
                          <th>MPY Address</th>
                         
                         
                          <th>Remark</th>
                          <th>Request Date</th>
                         
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
                              if ($request['processing'] == 0) {
                                echo form_open(base_url('Admin/Withdraw/stakingstatus/'.$request['id']));
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
                   
                            <td><?php echo $request['amount']; ?></td>
                            <td><?php echo $request['tds'] + $request['admin_charges']; ?></td>
                            <td><?php echo $request['payable_amount']; ?></td>
                            <td><?php echo $request['coin'];
                                ?></td>
                            <td><?php echo $request['token_price'];
                                ?></td>
                            <td><?php echo ucwords(str_replace('_', ' ', $request['type'])); ?></td>
                            <td><?php
                                 if ($request['processing'] == 0) {
                                  echo "<button class='btn btn-primary'> Pending</button>";
                                 }
                                   elseif($request['processing'] == 1){
                                     echo "<button class='btn btn-success'> Approved</button>";
                                   }else{
                                     echo "<button class='btn btn-danger'> Reject</button>";
                                   }
                              ?>
                            </td>
                           
                            <td><?php echo $request['zil_address']; ?></td>
                           


                            <td><?php echo $request['remarks']; ?></td>
                           
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
