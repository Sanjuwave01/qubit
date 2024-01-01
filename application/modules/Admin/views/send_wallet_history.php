<?php include 'header.php' ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <section class="content-header">
                        <span class="">Fund Transfer History
                        </span>
                    </section>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Fund Transfer History
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- BEGIN tab-pane -->
                                <div class="tab-pane active show" id="tabFundRequestForm">
                                    <!-- BEGIN row -->
                                    <div class="row">
                                        <!-- BEGIN col-6 -->
                                        <div class="col-md-12">
                                            <div class="card card-body">
                                                <!-- <p class="desc m-b-20" style="margin-top:20px;font-size: 18px;">Make sure to use a valid input, you'll need to verify it before you can submit request.</p> -->
                                                <div class="form-group m-b-10">

                                                </div>
                                                <div class="form-group m-b-10">
                                                    <div class="box box-solid">
                                                        <div class="box-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped dataTable" id="tableView">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S No.</th>
                                                                            <th>User ID</th>

                                                                            <th>Amount</th>
                                                                            <th>Sender ID</th>
                                                                            <th>Type</th>
                                                                            <th>Remarks</th>
                                                                          <th>Date</th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                      
                                                                      <?php 
                                                                           $x=1;
                                                                   foreach($topup as $top){?>
                                                                       <tr>
                                                                      <td> <?php echo $x;?></td>
                                                                      <td><?php echo $top['user_id'];?></td>
                                                                         <td><?php echo $top['amount'];?></td>
                                                                         <td><?php echo $top['sender_id'];?></td>
                                                                         <td><?php echo $top['type'];?></td>
                                                                         <td><?php echo $top['remark'];?></td>
                                                                         <td><?php echo $top['created_at'];?></td>
                                                                         
                                                                      </tr>
                                                                      <?php $x++;?>
                                                                            
                                                                    <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                       
                                                    </div>

                                                </div>

                                            </div>
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
                    <!-- END wizard -->


                </div>
            </div>
        </div>
    </div>
    </main>
    <?php //} 
    ?>





    <?php include 'footer.php' ?>