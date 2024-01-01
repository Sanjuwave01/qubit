<style>
    #content .page-titel spna
    {
        color: #3fbfd7;
    }

    #content .page-titel
    {
        font-size: 13px;
        font-weight: 500;
        text-transform: uppercase;
    }
    .content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
}
</style>
<style>
  section.content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
    width: 100%;
}
.messageBox {
  padding: 1em;
  background: #002e3666;
  border: #eee solid 2px;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-right: -50%;
  transform: translate(-50%, -50%);
  text-shadow: 0px 0px 8px #000;
  color: #fff;
}
#text {
  font-family: Questrial;
  text-align: center;
}
#construction {
  font-family: "Pacifico", cursive;
}
.transaction-box {
    position: relative;
     border-radius: 5px ;
     overflow: hidden;

}
button#btnCopy {
    background: #31a5da;
    color: #fff;
    border: 0px;
    padding: 7px 13px;
    font-weight: bold;
    display: inline-block;
}
div#qrcode img {
    max-width: 100%;
}
.copy-cls{
    background: #473e72;
    color: #fff;
    padding: 10px 15px;
    display: inline;
    float: left;
    margin-top: 10px;
}
@media screen and (max-width: 640px){
  .transaction-box{
    width: 100%;
  }
  .copy-cls{
    display: block;
  }
}

div#qrcode img
{
  width:250px !important;
}

.barcode-bg {
    
    padding: 10%;
   
}
.barcode-bg img {
    max-width: 37%;
    margin: 0px auto;
}

</style>
<div class="content-body">
			<div class="container-fluid">
        <div>

    <!-- <section class="main-content"> -->
        <div class="row">
        <div class="panel-heading">
    <span>Deposit Fund (ONLY BEP20)</span>
   </div>
        </div>
        <div class="content">
        <div class="card">
    <div class="card-body">
                <div class="tab-pane active show" id="tabFundRequestForm" style="margin-top:30px">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group m-b-10">
                                <div class="row row-space-6">
                                    <!-- <div class="col-md-6">
                                        <a href="Fund-Request.html?TB=tabFundRequestForm#" class="to-padding widget widget-stats">
                                            <div class="widget-stats-info mm-info">
                                                <div class="widget-stats-value to-fontsize" id="FBald58">Rs.</div>
                                                <div class="widget-desc">E-Wallet Balance </div>
                                            </div>
                                        </a>
                                    </div> -->
                                </div>
                            </div>
                            <div class="form-group m-b-10">

                            <div class="form-group m-b-10">
                                <div class="row row-space-6">

                                    <div class="col-md-12 ">

                                        <!-- <a href="Fund-Request.html?TB=tabFundRequestForm#" class="to-padding widget widget-stats"> -->
                                            <div class="widget-stats-info mm-info">
                                                <h3 style="color:white">Manual Fund Deposit </h3>
                                                <!-- <div class="widget-stats-value to-fontsize" id="FBald58"> E-Wallet Balance: (<?php echo currency.''.$amount['amount'] ?>)</div> -->
                                                <!-- <div class="widget-desc">E-Wallet Balance </div> -->
                                            </div>

                                        <!-- </a> -->
                                    </div>
                                </div>
                                <div class="row d-none">
                                    <div class="col-md-4">
                                            <div class="barcode-bg">
                                                 <div class="qr" id="qrcode"></div>
                                            </div>
                                        </div>
                                    <div class="col-md-8">
                                        <div class="card card-body" style="background: #000 !important;">
                                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 ">
                                    <div class="row mt-12"> -->
                                            <!-- <div class="col-md-8"> -->
                                                        <p> <input class="form-control" type="text" id="linkTxt" value="<?php echo $user['wallet_address']; ?>" readonly></p>
                                            <!-- </div> -->
                                            <div class="col-md-8">
                                                <div class="transaction-box">
                                                    <button id="btnCopy" iconcls="icon-save" class="btncopy btn-rounded m-b-5 copy-section">
                                                    Copy Address
                                                    </button>
                                                    <a href="<?php echo base_url('Dashboard/fund/depositHistory');?>" class="copy-cls">Click here to See Transaction at Tron Scan </a>

                                                </div>
                                            </div>
                                        </div>
    <!--                                     </div>
                                    </div> -->
                                </div>
                                </div>



                                <?php echo form_open_multipart();?>
                                <div class="row" >
                                    <div class="col-md-6">
                                        <h2><?php echo $this->session->flashdata('message');?></h2>
                                        <div class="form-group">
                                                <label>Enter Amount you want to Request in $</label>
                                                <?php
                                                echo form_input(array('type' => 'number', 'name' => 'amount', 'class' => 'form-control'));
                                                ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Choose Payment Method</label>
                                                <?php
                                                $option = [
                                                    // 'coinbase' => 'Coinbase',
                                                    'usdt' => 'USDT Payment',
                                                    'busd' => 'BUSD Payment',
                                                    'bnb' => 'BNB Payment',
                                                  
                                                ];
                                                echo form_dropdown('payment_method',$option,'','class = form-control');
                                                ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Enter Block ID</label>
                                                <?php
                                                echo form_input(array('type' => 'text', 'name' => 'txn_id', 'class' => 'form-control'));
                                                ?>
                                            </div>

                                            <div class="form-group" style="width:100%">
                                                <img src="https://user.fgmusdt.io/uploads/funddeposit.jpeg" style="max-width:300px">
                                                <p style="font-size:18px; font-weight:bold">BNB BEP20 Address: </p>
                                                <!-- <br> <p>TLEMDheWaSfNSCxyuKxggxFSHJPynB8oLW</p> -->
                                                <input style="" type="text" id="linkTxt1" value="0xbb6c0d8d4233b0e54ba4b69a7bcfe6355a7e07cf" class="form-control">
                                                <a id="btnCopy1" iconcls="icon-save" class="btncopy btn-success btn-rounded m-b-5  " style="width: 30%; padding: 5px;">Copy Address</a>
                                            </div>
                                            <div class="form-group">
                                                <label>Upload Receipt</label>
                                                <?php
                                                echo form_input(array('type' => 'file', 'name' => 'userfile', 'class' => 'form-control','id' => 'payment_slip'));
                                                ?>
                                            </div>
                                            <div class="form-group">
                                                <?php
                                                echo form_input(array('type' => 'submit' , 'class' => 'btn btn-success pull-right','name' => 'fundbtn','value' => 'Request'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="<?php echo base_url('classic/no_image.png');?>" title="Payment Slip" id="slipImage" style="width: 100%;">
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- </section> -->
</div></div></div>
<?php  $this->load->view('footer');?>
<script type="">
    $(document).on('click', '#btnCopy1', function () {
    //linkTxt
    var copyText = document.getElementById("linkTxt1");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    alert("Copied the text: " + copyText.value);
})
</script>
<!-- <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script type="text/javascript">
		var code = '0xbb6c0d8d4233b0e54ba4b69a7bcfe6355a7e07cf';
		new QRCode(document.getElementById("qrcode"),code);
	</script>
<script>
    $('#global-loader').hide()
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#slipImage').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#payment_slip").change(function () {
        readURL(this);
    });
    $(document).on('submit', '#paymentForm', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('#savebtn').css('display', 'none');
        $('#uploadnot').css('display', 'block');
        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                data = JSON.parse(data);
                if (data.success === 1)
                {
                    toastr.success(data.message);
//                    swal("Thank You", data.message);
                    //window.location = "https://soarwaylife.in/Dashboard/request_money.php" + data.message;
                    location.reload();
                } else {
                    toastr.error(data.message);
                }
                $('#savebtn').css('display', 'block');
                $('#uploadnot').css('display', 'none');
            }
        });
    });


</script>
