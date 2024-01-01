<?php include_once'header.php'; ?>
<style>

input {
    max-width: 400px;
}

</style>

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
                        <?php echo form_open('',['id' => 'billForm']); ?>
                        
                        <div class="form-group">
                            <label class="text-dark">Provider</label>
                            <select class="form-control" name="provider_id" style="max-width: 400px" required="" id="provider_id">
                                <?php
                                echo '<option value="">--Select Provider--</option>';
                                foreach($providers as $key => $provider){
                                    echo'<option value="'.$provider['provider_id'].'">'.$provider['provider_name'].' </option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group" id="validateRes">
                            <button type="button" onclick="validateProvider()" class="btn btn-primary">submit</button>
                        </div>
                        <div id="params">
                        </div>
                        <div class="form-group" id="fetchBtn">
                           
                        </div>
                        <div class="form-group">
                            <span id="billRes"></span>
                        </div>
                        <div class="form-group" id="amountField">
                            
                        </div>
                        <div class="form-group" id="pay-btn">
                            
                        </div>
                        

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

$(document).on('submit', 'form', function() {
    if (confirm('Are You Sure U want to Topup This Account')) {
        yourformelement.submit();
    } else {
        return false;
    }
})

let token = "<?php echo $this->security->get_csrf_hash();?>"

const validateProvider = () => {
    let prID = document.querySelector('#provider_id').value;
    if(prID != ''){
        document.getElementById('validateRes').innerHTML = 'Please wait....'
        const url = "<?php echo base_url('dashboard/bill-validate/');?>"+prID
        fetch(url,{
            method:"GET",
            headers:{
                "X-Requested-With":"XMLHttpRequest"
            }
        })
        .then(res => res.json())
        .then(res => {
            let input = '';
            if(res.data['params'] != ''){
                res.data['params'].forEach((value,index) => {
                    input += '<div class="form-group"><input type="text" name="optional[]" placeholder="'+value['placeholder']+'" class="form-control"></div><div class="form-group"><input type="text" name="phone" id="phone" placeholder="Enter Mobile Number" required="" class="form-control" style="max-width: 400px"></div>'
                })
                document.getElementById('fetchBtn').innerHTML = '<button type="button" class="btn btn-primary" onclick="fetchBill(this,billForm)">Fetch Bill</button>'
                document.getElementById('validateRes').innerHTML = ''
            } else {
                document.getElementById('validateRes').innerHTML = '<button type="button" onclick="validateProvider()" class="btn btn-primary">submit</button>'
            }
            document.getElementById('params').innerHTML = input
        })
    } else {
        alert('Please select provider');
    }
}
const fetchBill = (evt,id) => {
    document.getElementById('fetchBtn').innerHTML = 'Please wait....'
    let url = "<?php echo base_url('dashboard/get-bill');?>";
    fetch(url,{
        method:"POST",
        headers:{
            "X-Requested-With":"XMLHttpRequest"
        },
        body: new FormData(id)
    })
    .then(res => res.json())
    .then(res => {
        var csrfLength = document.getElementsByName("csrf_test_name").length;
        for(let i=0;i < csrfLength;i++){
            document.getElementsByName("csrf_test_name")[i].value = res.token
        }
        if(res.status == true){
            document.getElementById('fetchBtn').innerHTML = '<p>Name:'+res.data['name']+'</p><p>Amount:'+res.data['amount']+'</p>';
            document.getElementById('amountField').innerHTML = res.amountField
            document.getElementById('pay-btn').innerHTML = res.pay_bill
        } else {
            document.getElementById('billRes').innerHTML = res.data.message
            setTimeout(() => {
                document.getElementById('billRes').innerHTML = ''
                document.getElementById('fetchBtn').innerHTML = '<button type="button" class="btn btn-primary" onclick="fetchBill(this,billForm)">Fetch Bill</button>'
            }, 3000);
        }
    })
}

const payBill = (evt,id) => {
    document.getElementById('pay-btn').innerHTML = 'Please wait....'
    let url = "<?php echo base_url('dashboard/pay-bill');?>";
    fetch(url,{
        method:"POST",
        headers:{
            "X-Requested-With":"XMLHttpRequest"
        },
        body: new FormData(id)
    })
    .then(res => res.json())
    .then(res => {
        var csrfLength = document.getElementsByName("csrf_test_name").length;
        for(let i=0;i < csrfLength;i++){
            document.getElementsByName("csrf_test_name")[i].value = res.token
        }
        if(res.status == true){
            document.getElementById('pay-btn').innerHTML = ''
            document.getElementById('amountField').innerHTML = res.amountField
            document.getElementById('pay-btn').innerHTML = '<p>'+res.message+'</p><p> UTR Number: '+res.msg['utr']+'</p>'
        } else {
            setTimeout(() => {
                document.getElementById('pay-btn').innerHTML = ''
                document.getElementById('pay-btn').innerHTML = '<button type="button" class="btn btn-danger" onclick="payBill(this,billForm)">Pay Bill</button>'
            }, 3000);
        }
    })
}

</script>
