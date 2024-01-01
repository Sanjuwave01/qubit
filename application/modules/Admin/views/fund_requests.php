<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
              <span class=""> Fund Requests ( <?php echo currency.round($sumrequests['sumrequests'],2); ?>)</span> 
            </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Fund Requests</li>
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
                            <th>Coin</th>

                            <th>Token Price</th>
                            <!-- <th>Image</th> -->
                            <th>Status</th>
                            <th>Payment Method</th>
                            <th>Transaction ID</th>
                            <th>Remark</th>
                            <th>CreatedAt</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($requests as $key => $request) {
                          // pr($request);
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $request['user_id']; ?></td>
                                <td><?php echo $request['amount']; ?></td>
                                <td><?php echo $request['coin']; ?></td>
                                <td><?php echo $request['token_price']; ?></td>
                                <!-- <td><img src="<?php echo base_url('uploads/' . $request['image']); ?>" height="100px" width="100px"></td> -->
                                <td><?php 
                                    if($request['status'] == 0){
                                        echo'<span class="btn btn-primary">Pending</span>';
                                    }elseif($request['status'] == 1){
                                        echo'<span class="btn btn-success">Approved</span>';
                                    }elseif($request['status'] == 2){
                                        echo'<span class="btn btn-danger">Rejected</span>';
                                    }
                                ?></td>
                                <td><?php echo $request['payment_method']; ?></td>
                                <td><?php echo $request['transaction_id']; ?></td>
                                <td><?php echo $request['remarks']; ?></td>
                                <td><?php echo $request['created_at']; ?></td>
                                <td><a href="<?php echo base_url('Admin/Management/update_fund_request/'.$request['id']);?>" class="btn btn-info">View</a></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
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

<?php include'footer1.php' ?>