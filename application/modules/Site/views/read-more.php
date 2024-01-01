<?php require_once 'header.php';?>

<div class="">
<div class="container">
<div class="row"> 
    <br>
    <?php 
    if(isset($blog_details[0]) && !empty($blog_details[0])){
        ?>   
        <div class="col-12 mb-3">
            <div class="card">
                <img src="<?php echo base_url().'uploads/'.$blog_details[0]->image;?>" class="card-img-top" alt="...">
                <div class="card-body p-4">
                <h5 class="card-title text-left"><?php echo $blog_details[0]->title;?></h5>
                <p class="card-text text-left"><?php echo $blog_details[0]->description;?>
                </div>
            </div>
        </div>
        <?php 
        }else{
            echo "<p>No Record Found</p>";
        }?>
      
    
</div>
</div>
</div>   

<?php require_once 'footer.php';?>