<?php include 'header.php' ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <section class="content-header">
                        <span class="">Staking History
                        </span>
                    </section>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Staking History
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <form method="GET" action="<?php echo base_url('Admin/Withdraw/Stackinghistory/'); ?>">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <select class="form-control" name="type">
                                                    <option value="user_id" <?php echo $type == 'user_id' ? 'selected' : ''; ?>>
                                                        User ID</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="value" class="form-control float-right" value="<?php echo $value; ?>" placeholder="Search">
                                            </div>

                                            <div class="col-md-3">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
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
                                                                <table class="table table-bordered table-striped dataTable" id="">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S No.</th>
                                                                            <th>User ID</th>

                                                                            <th>Package</th>
                                                                            <th>Staked Coin</th>
                                                                            <th>Monthly Staking</th>
                                                                            <th>Total Days</th>
                                                                            <th>Pending Days</th>
                                                                            <th>Staking Date</th>
                                                                            <th>Unstake Date</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        // die;
                                                                        $i = $segment + 1;
                                                                        foreach ($stake_history as $key => $row) {
                                                                            $date2 = date('Y-m-d', strtotime($row['created_at'] . '+' . $row['total_days'] . ' month'));
                                                                            $now = time(); // or your date as well
                                                                            $your_date = strtotime(date('Y-m-d', strtotime($row['created_at'])));
                                                                            $datediff = $now - $your_date;
                                                                            $diffDay = round($datediff / (60 * 60 * 24));

                                                                            $days = '1050';
                                                                            if ($row['total_days'] == '1050') {
                                                                                $days =  1050;
                                                                            } else if ($row['total_days'] == '1080') {
                                                                                $days =  1050;
                                                                            } else if($row['total_days'] == '600'){
                                                                                $days =  600;
                                                                            }
                                                                          else 
                                                                            {
                                                                            $days=510;
                                                                             }
 
                                                                            $balanceDays = $days - ($diffDay);

                                                                            $toAddDays = '+ ' . $balanceDays . ' days';
                                                                        ?>
                                                                            <tr>

                                                                                <td><?php echo $i ?></td>
                                                                                <td><?php echo $row['user_id']; ?></td>

                                                                                <td>$<?php echo $row['package']; ?></td>
                                                                                <td>RVC <?php echo $row['coin']; ?></td>
                                                                                <td>$<?php echo $row['roi_amount']; ?></td>
                                                                               
                                                                                <td>
                                                                                    <?php
                                                                                    if ($row['total_days'] == '1050')
                                                                                        echo 1050;
                                                                                    else if ($row['total_days'] == '1080')
                                                                                        echo 1050;
                                                                                       else if ($row['total_days'] == '600')
                                                                                      echo 600;
                                                                                    else
                                                                                        echo 510;
                                                                                    ?>
                                                                                </td>
                                                                                <td> <?php echo $balanceDays; ?> </td>
                                                                                <td>
                                                                                    <?php
                                                                                    echo date('Y-m-d', strtotime($row['created_at']));
                                                                                    //  echo  date('Y-m-d', strtotime('-30 day', strtotime($row['creditDate'])))
                                                                                    ?>

                                                                                </td>

                                                                                <td><?php echo date('Y-m-d', strtotime(date('Y-m-d') . '' . $toAddDays . '')); ?></td>
                                                                               <td>
                                                                                <form
                                                                                    action="<?php echo base_url('Admin/Withdraw/stakeEdit/' . $row['id']); ?>"
                                                                                    target="_blank">
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary btn-sm">Edit</button>
                                                                                </form>
                                                                            </td>
                                                                               
                                                                            </tr>
                                                                        <?php
                                                                            $i++;
                                                                        }
                                                                        ?>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <?php echo $links; ?>
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
