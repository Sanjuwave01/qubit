<?php $this->load->view('header');?>
<div  class="content-body">
<div  class="container-fluid">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
       <h1 class="panel-heading">

        <small>Recharge History</small>
    </h1>
    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div id="rootwizard" class="card card-body wizard-full-width">

        <div class="wizard-content tab-content">
            <!-- BEGIN tab-pane -->
            <div class="tab-pane active show" id="tabFundRequestForm">
                <!-- BEGIN row -->
                <div class="row">
                    <!-- BEGIN col-6 -->
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-striped dataTable" id="tableView">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User ID</th>
                                    <th>Operator</th>
                                    <th>Phone</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Transaction ID</th>
                                    <th>Pay ID</th>
                                    <th>Deducted Amount</th>
                                    <th>Transfer Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($transactions as $key => $transaction) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1) ?></td>
                                        <td><?php echo $transaction['user_id']; ?></td>
                                        <td><?php echo $transaction['operator']; ?></td>
                                        <td><?php echo $transaction['service']; ?></td>
                                        <td>Rs. <?php echo $transaction['amount']; ?></td>
                                        <td><?php echo ($transaction['status'] == 'success' || $transaction['status'] == 'Success' )?'<span class="text-success">'.$transaction['status'].'</span>':'<span class="text-danger">'.$transaction['status'].'</span>'; ?></td>
                                        <td><?php echo $transaction['orderid']; ?></td>
                                        <td><?php echo $transaction['pay_id']; ?></td>
                                        <td>$<?php echo $transaction['amount']/80; ?></td>
                                        <td><?php echo $transaction['created_at']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
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
    <!-- END wizard -->
</div>
</div>



<?php $this->load->view('footer');?>
