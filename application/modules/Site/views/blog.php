<?php require_once 'header.php';?>
<style>
    .card-img-top {
        max-height: 18rem;
        overflow: hidden;
    }
</style>
<div class="">
    <div class="container">
        <div class="row">


            <?php 
    if(isset($blogs) && !empty($blogs)){
    foreach ($blogs as $blog_keys=>$blog_data){
      
        ?>
            <div class="col-4 mb-3">
                <div class="card">
                    <img src="<?php echo base_url().'uploads/'.$blog_data->image;?>" class="card-img-top" alt="...">
                    <div class="card-body p-4">
                        <h5 class="card-title text-left">
                            <?php echo $blog_data->title;?>
                        </h5>
                        <p class="card-text text-left">
                            <?php echo substr($blog_data->description, 0, 200);?>..<a class="text-danger"
                                href="<?php echo base_url().'blog-details/'.$blog_data->id;?>">Read More</a>
                        </p>
                    </div>
                </div>
            </div>
            <?php } 
        }else{
            echo "<p>No Record Found</p>";
        }?>


        </div>
    </div>
    <br>

</div>

<?php require_once 'footer.php';?>