<?php include_once'header.php'; ?>

<div class="content-body ">

    <div class="page-content">
        <div class="container-fluid">


    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->

   
<div class="panel-heading">
                          <h4 class="panel-title"><?php echo $header; ?></h4>
                                                              </div>
 


    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
                                   <div class="card-body">
      <h4 class="page-header">
        <span class="text-info" style=""> <?php echo $header; ?></span><br>


    </h4>

        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

        <div class="wizard-content tab-content p-0">
            <!-- BEGIN tab-pane -->
            <div class="tab-pane active show" id="tabFundRequestForm">
                <!-- BEGIN row -->
                <div class="col-md-12 p-0 m-2">
                    <div class="row text-center">
                        <div class="col-md-3 m-0">
                            <a href="<?php echo base_url('dashboard/recharge/mobile'); ?>">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAAC5UlEQVRoge2Z30uTURjHP+/2ajZpYqaYsDQiChQXSNJF0EWadKORSdOLCv0P7EbwIhC7MCgT76KhXuWUIuymQu+6yLrRXKWIYRoUWxZNG6nvu9OFKRvzR8edWOL7udp73ud7nue785yddxtYWOxutO2IPI3NLtMQ7QLOAfsSrGFeEwxhszX1d7ROyIqlDXgam12GIUaA/bLaLfiu65q7987NWRmRTTaLaYh21BcPkGkY4rasSJcV/GkbAIor6nFmu2SniCEUmOHN867VywpZvfQKENXziRYP4Mw5FHMpq9+Ogf8Ky0CysQwkG8tAstnxBqRP4q1INRcpH/OS/7qXlGk/AMsFRUyX1jJYVM+SfY/SfEoN5IQ/U9NVhf5hNGY8ZXyYo+PDHD7STf+1xwQcB5XlVNZCqebiusVHo0+NUNN9gVRzUVVadQbKx7xrxRuajfsZpXjy6qjNq8ObcRJDW0mlT41Q5u/abCoplBnIf/Vg7XWPs4Q+ZzHf7A7m7A58Tjc9zpK1+wVRsYmibA9U/yzkl6s4ZuzujSYiQtDY0obP6cbndAOQtmByVlFedR+jaY64oYgQgIgb1/bGx24XZStwr7OT3PSVb6je3of4njylsaVt7b6n8jz1ly8C8GVB4Hu/rCSvMgPjcxFy0+0AXL1UBcDgi5cAlJ0+xZXqyphYVSgz4A+YFB6wke3Q0HWdBk81DZ7quLhgWOAPmqrSqtsDpoCBSYNgOL7nVwmGBQOTBubGIdIoPYkXlgS+d8sUZds5nmUjy7GyJ76GBRNzEfxBU2nx8A+ehUwBowGT0YC6NtmMHf80ahlINpaBZGMZSDYJGQgFZhIuIBT4mJA+oYMs6mfxpLHjW2g7KzDPFv+LzU68XXfcdaxw85k1fsgWI70CmmBIVvPXCJ7JSuRXwGZrQkTOAJkbhWz5Tq/PXEQY16XLkRX0d7RO6LrmBvqBkKx+HUJAX0QYJx513vqkYD4Li13Fb6Wz2q5murL0AAAAAElFTkSuQmCC" style="width: 20% !important;">
                                <p class="text-dark">Mobile Recharge</p>
                            </a>
                        </div>

                        <div class="col-md-3 m-0">
                            <a href="<?php echo base_url('dashboard/recharge/dth'); ?>">
                                <img src="data:image/png;base64,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" style="width: 20% !important;">
                                <p class="text-dark">DTH Recharge</p>
                            </a>
                        </div>

                        <div class="col-md-3 m-0">
                            <a href="<?php echo base_url('dashboard/recharge/Mobile_Postpaid'); ?>">
                                <img src="data:image/png;base64,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" style="width: 20% !important;">
                                <p class="text-dark">Mobile Postpaid</p>
                            </a>
                        </div>

                        <div class="col-md-3 m-0">
                            <a href="<?php echo base_url('dashboard/get-bill/landline'); ?>">
                                <img src="data:image/png;base64,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" style="width: 20% !important;">
                                <p class="text-dark">Landline</p>
                            </a>
                        </div>
                        <div class="col-md-3 m-0">
                            <a href="<?php echo base_url('dashboard/get-bill/Electricity'); ?>">
                                <img src="data:image/png;base64,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" style="width: 20% !important;">
                                <p class="text-dark">Electricity</p>
                            </a>
                        </div>
                        <div class="col-md-3 m-0">
                            <a href="<?php echo base_url('dashboard/get-bill/FASTag'); ?>">
                                <img src="data:image/png;base64,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" style="width: 20% !important;">
                                <p class="text-dark">FastTag</p>
                            </a>
                        </div>
                        <div class="col-md-3 m-0">
                            <a href="<?php echo base_url('dashboard/get-bill/Broadband'); ?>">
                                <img src="data:image/png;base64,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" style="width: 20% !important;">
                                <p class="text-dark">Broadband</p>
                            </a>
                        </div>
                        <div class="col-md-3 m-0">
                            <a href="<?php echo base_url('dashboard/get-bill/LPG_Gas'); ?>">
                                <img src="data:image/png;base64,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" style="width: 20% !important;">
                                <p class="text-dark">LPG GAS</p>
                            </a>
                        </div>
                        <div class="col-md-3 m-0">
                            <a href="<?php echo base_url('dashboard/get-bill/Insurance'); ?>">
                                <img src=" data:image/png;base64,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" style="width: 20% !important;">
                                <p class="text-dark">Insurance Payment</p>
                            </a>
                        </div>
                    </div>
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
  </div></div>
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
    if (confirm('Are You Sure U want to Topup This Account')) {
        yourformelement.submit();
    } else {
        return false;
    }
})
$(document).on('change', '#PackageId', function() {
    var package_price = parseInt($(this).children("option:selected").data('price'));
    $('#Payamount').val(package_price);
    // alert(package_price)
})
$(document).on('change', '#payment_method', function() {
    $('#SaveBtn').toggle();
    $('#PayBtcBtn').toggle();
})
$(document).on('click', '#PayBtcBtn', function(e) {
    var formData = $(this).serialize();
    var user_id = $('#user_id').val();
    console.log(formData);
    if (user_id == '') {
        alert('Please Fill User ID');
        return;
    }
    $('#BtcForm').submit();
})
</script>
