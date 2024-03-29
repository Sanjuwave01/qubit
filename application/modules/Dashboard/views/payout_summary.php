<?php include'header.php' ?>
<style>
  .col-12{
    position: relative;
    width: 100%;
    padding-right: 0px!important;
    padding-left: 0px!important;
  }
   .col-sm-12{
     position: relative;
    width: 100%;
    padding-right: 0px!important;
    padding-left: 0px!important;
   }
</style>
<div class="content-body">

<div class="container-fluid">
<div class="">
    <div class="page-content">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="panel-heading">
            <span class="">PayOut Summary</span>
          </div>
          </div><!-- /.col -->
        <!--   <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">PayOut Summary</li>
            </ol>
          </div> -->
        </div><!-- /.row -->
      
     
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <div class="card-header">
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <?php 
                              foreach($type as $ty){
                                 echo '<th>'.str_replace('_',' ',$ty['type']).'</th>'; 
                              }
                            ?>
                            <th>Total Payout</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $i = 1;
                        $i = $segament + 1;
                        foreach ($records as $key => $record) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $record['date']; ?></td>
                                  <?php
                                    foreach($type as $ty){
                                      echo '<td>'.$record['incomes'][$ty['type']].'</td>'; 
                                    }
                                  ?>
                                
                                <td><?php echo $record['incomes']['total_payout']; ?></td>
                                <td><a href="<?php echo base_url('Dashboard/Settings/dateWisePayout/'.$record['date']);?>">View</a></td>
                            </tr>
                            <?php
                            $i++;
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
  </div>
   
<?php include'footer.php' ?>
