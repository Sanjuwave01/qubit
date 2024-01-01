<?php include_once'header.php'; ?>
<div class="content-body">
			<div class="container-fluid">
        <div>
            <div class="panel-heading">
                <h4 class="panel-title"><?php echo $header;?> <?php if(!empty($balance)){ echo '($ '.$balance['balance'].')';} ?></h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="wizard-content tab-content p-0">
                        <div class="tab-pane active show" id="tabFundRequestForm">
                            <div class="col-md-12 p-0">
                                <?php 
                                    echo $this->session->flashdata('message');
                                    echo form_open('', array('id' => 'TopUpForm')); 
                                    echo $form;
                                    echo form_close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<?php include_once'footer.php'; ?>
<script>
$(document).on('blur', '#user_id', function() {
    var user_id = $('#user_id').val();
    if (user_id != '') {
        var url = '<?php echo base_url("Dashboard/check_sponser_packages/") ?>' + user_id;
        var html = '';
        $.get(url, function(res) {
            console.log(res);
            $('#errorMessage').html(res.message);
            $('#user_id').val(res.user.user_id);
            $.each(res.packages,function(key,value){
                html +='<option value="'+ value.id +'">'+value.title+' With Rs. ' + value.price+' </option>';
            })
            $('#packages').html(html);
        },'json')
    }
})
$(document).on('submit', 'form', function() {
    if (confirm('Are you sure for this action')) {
        yourformelement.submit();
    } else {
        return false;
    }
})
</script>
