<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
   


        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <div class="card-header">
                <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">

                    <!-- <div class="col-sm-12 col-md-12 text-center">

                        <form class="form-inline">
                            <div class="form-group">
                                <label for="exampleInputName2">Type</label>
                                 <select class="form-control" name="type">
                                    <option value="">Type</option>
                                    <option value="1">R1</option>
                                    <option value="2">R2</option>
                                    <option value="3">R3</option>
                                    <option value="4">R4</option>
                                    <option value="5">R5</option>
                                    <option value="6">R6</option>
                                    <option value="7">R7</option>
                                    <option value="8">R7</option>
                                    <option value="9">R8</option>
                                    <option value="9">R9</option>
                                    <option value="10">R10</option>

                                </select>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail2">User Id</label>
                                <input type="text" name="user_id" class="form-control" placeholder="User">
                            </div>
                       
                            <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
                            <a class="btn btn-success" href="<?php echo base_url('Admin/Withdraw/userLevel') ?>" aria-expanded="false">
                            Clear
						    </a>


                        </form>
                    </div> -->


                 
                  </div>
                </div>
              </div>
                  <div class="row">
                    <div class="col-md-3">
                      <a href="<?php echo base_url('Admin/Management/ManageBlog') ?>" class="export-btn btn-primary">Create</a>
                    </div>

                   
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = $segament + 1;
                        foreach ($blogs as $key => $blog) {
                            
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $blog['title']; ?></td>
                                <td>
                                    <img src="<?php echo base_url('uploads/') . $blog['image']; ?>" width="200" height="100">
                                </td>
                                <td><?php echo $blog['description']; ?></td>
                                <td><?php echo $blog['created_at']; ?></td>
                                <td>
                                    <a href="<?php echo base_url('Admin/Management/EditBlog/' . $blog['id']); ?>" target="_blank">Edit</a>
                                </td>
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
            <div>
      </div>
         </div><!-- /.container-fluid -->
    </div>
  </div>
<?php include'footer1.php' ?>

<script>
  function exportF(elem) {
  var table = document.getElementById("table");
  var html = table.outerHTML;
  var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
  elem.setAttribute("href", url);
  let r = Math.random().toString(36).substring(7);
  elem.setAttribute("download", r+".xls"); // Choose the file name
  return false;
}


</script>

