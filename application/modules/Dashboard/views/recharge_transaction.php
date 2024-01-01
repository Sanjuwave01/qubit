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
        <span class="text-info" style=""> <?php echo $header; ?> (Balance: <?php echo currency.number_format($balance['balance'],2); ?>)</span><br>


    </h4>

        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

        <div class="wizard-content tab-content p-0">
            <!-- BEGIN tab-pane -->
            <div class="tab-pane active show" id="tabFundRequestForm">
                <!-- BEGIN row -->
                <div class="col-md-12 p-0 m-2">
                    <div class="">
                        <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
                        <?php echo form_open(); ?>

                        <?php if($header == 'Mobile'){ ?>

                        <div class="form-group">
                            <label class="text-dark">Provider</label>
                            <select class="form-control" name="provider_id" style="max-width: 400px" required="">
                                <?php
                                foreach($providers as $key => $provider){
                                    echo'<option value="'.$provider['provider_id'].'">'.$provider['provider_name'].' </option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="text-dark">Mobile No.</label>
                            <input type="number" name="phone" placeholder="Enter Mobile No." required="" class="form-control" style="max-width: 400px">
                        </div>


                        <div class="form-group">
                            <label class="text-dark">Amount</label>
                            <input type="number" name="amount" placeholder="Enter Amount" required="" class="form-control" style="max-width: 400px">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                        <?php }elseif($header == 'Dth'){ ?>

                            <div class="form-group">
                                <label class="text-dark">Provider</label>
                                <select class="form-control" name="provider_id" style="max-width: 400px" required="">
                                    <?php
                                    foreach($providers as $key => $provider){
                                        echo'<option value="'.$provider['provider_id'].'">'.$provider['provider_name'].' </option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-dark">VC No. / Subscriber ID</label>
                                <input type="number" name="phone" placeholder="Enter VC No. / Subscriber ID" required="" class="form-control" style="max-width: 400px">
                            </div>


                            <div class="form-group">
                                <label class="text-dark">Amount</label>
                                <input type="number" name="amount" placeholder="Enter Amount" required="" class="form-control" style="max-width: 400px">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        <?php }elseif($header == 'Mobile Postpaid'){ ?>

                            <div class="form-group">
                                <label class="text-dark">Provider</label>
                                <select class="form-control" name="provider_id" style="max-width: 400px" required="">
                                    <?php
                                    foreach($providers as $key => $provider){
                                        echo'<option value="'.$provider['provider_id'].'">'.$provider['provider_name'].' </option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-dark">Mobile No.</label>
                                <input type="number" name="phone" placeholder="Enter Mobile No." required="" class="form-control" style="max-width: 400px">
                            </div>


                            <div class="form-group">
                                <label class="text-dark">Amount</label>
                                <input type="number" name="amount" placeholder="Enter Amount" required="" class="form-control" style="max-width: 400px">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>


                        <?php }elseif($header == 'Landline'){ ?>

                            <div class="form-group">
                                <label class="text-dark">Provider</label>
                                <select class="form-control" name="provider_id" style="max-width: 400px" required="">
                                    <?php
                                    foreach($providers as $key => $provider){
                                        echo'<option value="'.$provider['provider_id'].'">'.$provider['provider_name'].' </option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-dark">Customer Mobile Number</label>
                                <input type="number" name="customer_phone" placeholder="Customer Mobile Number" required="" class="form-control" style="max-width: 400px">
                            </div>


                            <div class="form-group">
                                <label class="text-dark">Account Number</label>
                                <input type="text" name="phone" placeholder="Account Number" required="" class="form-control" style="max-width: 400px">
                            </div>


                            <div class="form-group">
                                <label class="text-dark">Amount</label>
                                <input type="number" name="amount" placeholder="Enter Amount" required="" class="form-control" style="max-width: 400px">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        <?php }elseif($header == 'Electricity'){ ?>

                            <div class="form-group">
                                <label class="text-dark">Provider</label>
                                <select class="form-control" name="provider_id" style="max-width: 400px" required="">
                                    <?php
                                    foreach($providers as $key => $provider){
                                        echo'<option value="'.$provider['provider_id'].'">'.$provider['provider_name'].' </option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-dark">Customer Mobile Number</label>
                                <input type="number" name="account_number" placeholder="Customer Mobile Number" required="" class="form-control" style="max-width: 400px">
                            </div>


                            <div class="form-group">
                                <label class="text-dark">Customer Id/S. No.</label>
                                <input type="text" name="phone" placeholder="Customer Id/S. No." required="" class="form-control" style="max-width: 400px">
                            </div>


                            <div class="form-group">
                                <label class="text-dark">Amount</label>
                                <input type="number" name="amount" placeholder="Enter Amount" required="" class="form-control" style="max-width: 400px">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            
                        

                        <?php }elseif($header == 'FastTag'){ ?>

                        <div class="form-group">
                            <label class="text-dark">Provider</label>
                            <select class="form-control" name="provider_id" style="max-width: 400px" required="">
                                <?php
                                foreach($providers as $key => $provider){
                                    echo'<option value="'.$provider['id'].'">'.$provider['opreator_name'].' </option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="text-dark">Customer Mobile Number</label>
                            <input type="number" name="account_number" placeholder="Customer Mobile Number" required="" class="form-control" style="max-width: 400px">
                        </div>


                        <div class="form-group">
                            <label class="text-dark">Vehicle Number</label>
                            <input type="text" name="phone" placeholder="Vehicle Number" required="" class="form-control" style="max-width: 400px">
                        </div>


                        <div class="form-group">
                            <label class="text-dark">Amount</label>
                            <input type="number" name="amount" placeholder="Enter Amount" required="" class="form-control" style="max-width: 400px">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>



                        <?php }elseif($header == 'Broadband'){ ?>

                        <div class="form-group">
                            <label class="text-dark">Provider</label>
                            <select class="form-control" name="provider_id" style="max-width: 400px" required="">
                                <?php
                                foreach($providers as $key => $provider){
                                    echo'<option value="'.$provider['id'].'">'.$provider['opreator_name'].' </option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="text-dark">Customer Mobile Number</label>
                            <input type="number" name="account_number" placeholder="Customer Mobile Number" required="" class="form-control" style="max-width: 400px">
                        </div>


                        <div class="form-group">
                            <label class="text-dark">Customer Id</label>
                            <input type="text" name="phone" placeholder="Customer Id" required="" class="form-control" style="max-width: 400px">
                        </div>


                        <div class="form-group">
                            <label class="text-dark">Amount</label>
                            <input type="number" name="amount" placeholder="Enter Amount" required="" class="form-control" style="max-width: 400px">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>


                        <?php }elseif($header == 'LPG gas'){ ?>

                        <div class="form-group">
                            <label class="text-dark">Provider</label>
                            <select class="form-control" name="provider_id" style="max-width: 400px" required="">
                                <?php
                                foreach($providers as $key => $provider){
                                    echo'<option value="'.$provider['id'].'">'.$provider['opreator_name'].' </option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="text-dark">Customer Mobile Number</label>
                            <input type="number" name="account_number" placeholder="Customer Mobile Number" required="" class="form-control" style="max-width: 400px">
                        </div>


                        <div class="form-group">
                            <label class="text-dark">Customer Id</label>
                            <input type="text" name="phone" placeholder="Customer Id" required="" class="form-control" style="max-width: 400px">
                        </div>


                        <div class="form-group">
                            <label class="text-dark">Amount</label>
                            <input type="number" name="amount" placeholder="Enter Amount" required="" class="form-control" style="max-width: 400px">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>


                        <?php }elseif($header == 'Insurance payment'){ ?>

                            <div class="form-group">
                                <label class="text-dark">Provider</label>
                                <select class="form-control" name="provider_id" style="max-width: 400px" required="">
                                    <?php
                                    foreach($providers as $key => $provider){
                                        echo'<option value="'.$provider['id'].'">'.$provider['opreator_name'].' </option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-dark">Customer Mobile Number</label>
                                <input type="number" name="account_number" placeholder="Customer Mobile Number" required="" class="form-control" style="max-width: 400px">
                            </div>


                            <div class="form-group">
                                <label class="text-dark">Customer Id</label>
                                <input type="text" name="phone" placeholder="Customer Id" required="" class="form-control" style="max-width: 400px">
                            </div>


                            <div class="form-group">
                                <label class="text-dark">Amount</label>
                                <input type="number" name="amount" placeholder="Enter Amount" required="" class="form-control" style="max-width: 400px">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        <?php } ?>

                        <?php echo form_close(); ?>

                        

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

//
//
//function get_form(evt){
//    const provider_id = (evt.value);
//    var url = "<?php //echo base_url('Dashboard/MyRecharge/get_json/'); ?>//"+provider_id;
//    fetch(url, {
//        method: "GET",
//        headers: {
//            "X-Requested-With": "XMLHttpRequest"
//        },
//        // body: new FormData(element),
//    })
//    .then(response => response.json())
//    .then(result => {
//        //console.log(result);
//        if(result.success == '1'){
//            const obj = Object.entries(result.records);
//            obj.forEach(element => {
//                console.log(obj);
//            });
//
//        }else{
//
//        }
//    });
//
//}
</script>
