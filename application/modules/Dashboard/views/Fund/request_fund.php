<style>
    #content .page-titel spna {
        color: #3fbfd7;
    }

    #content .page-titel {
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
        border-radius: 5px;
        overflow: hidden;

    }

    .copy_btn {
        background: #31a5da;
        color: #fff;
        border: 0px;
        padding: 4px 11px;
        font-weight: bold;
        font-size: 18px;
        display: inline-block;
        position: absolute;
        right: 0px;
        top: -1px;
        border-radius: 0px 10px 10px 0px;
    }

    .copy_btn i {
        color: #fff;
    }

    div#qrcode img {
        max-width: 100%;
    }

    .copy-cls {
        background: #473e72;
        color: #fff;
        padding: 10px 15px;
        display: inline;
        float: left;
        margin-top: 10px;
    }

    @media screen and (max-width: 640px) {
        .transaction-box {
            width: 100%;
        }

        .copy-cls {
            display: block;
        }
    }

    div#qrcode img {
        width: 250px !important;
    }

    .barcode-bg {

        padding: 10%;

    }

    .barcode-bg img {
        max-width: 37%;
        margin: 0px auto;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<div class="content-body">
    <div class="container-fluid">
        <div>

            <!-- <section class="main-content"> -->
            <div class="row">
                <div class="panel-heading">
                    <span>Deposit Fund (ONLY RVC BEP20)</span>
                </div>
            </div>
            <div class="content">
                <div class="card" id="scroll_top">
                    <div class="card-body">
                        <div class="tab-pane active show" id="tabFundRequestForm">
                            <div class="">
                                <div class="">
                                    <div class="form-group m-b-10">
                                        <div class="row row-space-6">
                                        </div>
                                    </div>
                                    <div class="form-group m-b-10">

                                        <div class="form-group m-b-10">
                                            <div class="row row-space-6">

                                                <div class="col-md-12 ">

                                                    <!-- <a href="Fund-Request.html?TB=tabFundRequestForm#" class="to-padding widget widget-stats"> -->
                                                    <div class="widget-stats-info mm-info">
                                                        <h3 style="color:white">Deposit Only RVC BEP20</h3>
                                                        <!-- <div class="widget-stats-value to-fontsize"
                                                            id="balance_received"> E-Wallet Balance: </div> -->
                                                        <!-- <div class="widget-desc">E-Wallet Balance </div> -->
                                                    </div>

                                                    <!-- </a> -->
                                                </div>
                                            </div>
                                            <div class="row d-none">
                                                <!-- <div class="form-group"> -->
                                                <select class="form-control" style="max-width: 100%;" onchange="getAddress(this)">
                                                    <!-- <option value="trc">TRC20 USDT</option> -->
                                                    <option value="bep">BEP20 RVC</option>
                                                </select>
                                                <!-- </div> -->
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
                                                        <!-- <p> <input class="form-control" type="text" id="linkTxt" value="<?php echo $user['wallet_address2']; ?>" readonly></p> -->
                                                        <!-- </div> -->
                                                        <div class="col-md-8">
                                                            <div class="transaction-box">
                                                                <button id="btnCopy" iconcls="icon-save" class="btncopy btn-rounded m-b-5 copy-section">
                                                                    Copy Address
                                                                </button>
                                                                <a href="<?php echo base_url('Dashboard/fund/depositHistory'); ?>" class="copy-cls">Click here to See Transaction at
                                                                    Bsc Scan </a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--                                     </div>
                                    </div> -->
                                                </div>
                                            </div>


                                            <span id="resMsg"></span>


                                            <?php
                                            echo form_open_multipart('Dashboard/Fund/payfund', array('id' => 'paymentForm')); ?>
                                            <div class="row" id="mainform">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Enter Amount you want to Request in
                                                            <?php echo currency; ?></label>
                                                        <?php
                                                        echo form_input(array('type' => 'number', 'name' => 'amount', 'onkeyup' => "total_hub(this)", 'class' => 'form-control amount'));

                                                        ?>
                                                    </div>
                                                    <span class="text-danger" id="coinGet"></span>
                                                    <div class="form-group">
                                                        <!-- <button id ="nextbtn" onclick="nextData2()" type="button">next</button> -->
                                                        <?php
                                                        echo form_input(array('type' => 'button', 'class' => 'btn btn-success', 'name' => 'fundbtn', 'value' => 'Next', 'onclick' => 'nextData()', 'id' => 'nextbtn'));
                                                        // echo form_hidden(array('type' => 'number', 'name' => 'days','value' =>'0', 'class' => 'form-control'));

                                                        ?>
                                                    </div>


                                                    <div style="display:none;" id="nextForm">
                                                        <div class="form-group" style="width:100%">
                                                            <img src="<?php echo base_url('uploads/ricaversebarcode.jpeg'); ?>" style="max-width:100%">
                                                            <p style="font-size:16px;color:#fff;font-weight:400;margin:10px 0px">RVC BEP20
                                                                Address: </p>
                                                            <!-- <br> <p>TLEMDheWaSfNSCxyuKxggxFSHJPynB8oLW</p> -->
                                                            <div class="form-group position-relative">
                                                                <input style="" type="text" id="linkTxt" value="0x3D442aBC0E1A28dc59D9fe2aBA49eA9eaE597de4" class="form-control" readonly>
                                                                <a id="btnCopy" iconcls="icon-save" class="btncopy copy_btn"><i class="flaticon-049-copy"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Enter Transaction ID</label>
                                                            <?php
                                                            echo form_input(array('type' => 'text', 'name' => 'txn_id', 'class' => 'form-control', "required"));
                                                            ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Staking Time</label>
                                                            <select class="form-control" name="days" style="max-width: 500px" id="">
                                                                <option value="18">18 Months</option>
                                                                <option value="36">36 Months</option>
                                                            </select>
                                                        </div>


                                                        <div class="form-group">
                                                            <label>Proof</label>
                                                            <input type="file" name="userfile" value="" id="payment_slip" class="form-control" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <img src="<?php echo base_url('classic/no_image.png');
                                                                        ?>" title="Payment Slip" id="slipImage" style="width: 100%; display:none;">
                                                        </div>
                                                        <div class="form-group">
                                                            <?php
                                                            echo form_input(array('type' => 'button', 'class' => 'btn btn-success', 'name' => 'fundbtn', 'value' => 'Submit', 'onclick' => "requestNow(this,'paymentForm')"));
                                                            ?>
                                                        </div>


                                                    </div>
                                                </div>

                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- </section> -->
                </div>
            </div>
        </div>
        <?php  //$this->load->view('footer');
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            function total_hub(evt) {
                var tokenValue = "<?php echo $tokenValue['amount']; ?>";
                console.log(tokenValue);
                var amount = evt.value;
                var lastAmout = amount / tokenValue;
                document.getElementById('coinGet').innerHTML = 'You will Get  ' + lastAmout.toFixed(3) + '';
            }
        </script>
        <script type="text/javascript">
            function getAddress(via) {
                var coin = via.options[via.selectedIndex].value;
                if (coin == 'trc') {
                    var walletAddress = "<?php echo $user['wallet_address2']; ?>";
                } else {
                    var walletAddress = "<?php echo $user['wallet_address2']; ?>";
                }
                var code = walletAddress;
                document.getElementById("qrcode").innerHTML = '';
                new QRCode(document.getElementById("qrcode"), code);
                document.getElementById('linkTxt').value = walletAddress;
            }
            var code = '<?php echo $user['wallet_address']; ?>';
            new QRCode(document.getElementById("qrcode"), code);
        </script>
        <script>
            $('#global-loader').hide()

            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#slipImage').attr('src', e.target.result);
                        $('#slipImage').css('display', 'block');

                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#payment_slip").change(function() {
                readURL(this);
            });
            $(document).on('submit', '#', function(e) {
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
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.success === 1) {
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




        <script>
            function check_updated_balance() {
                var params = "msgcheck=1";
                var jsondata = "";
                var url = "<?php echo base_url() ?>Dashboard/Fund/depositAjax";
                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'html',
                    data: params,
                    success: function(html) {
                        jsondata = JSON.parse(html);
                        // console.log(jsondata.wallet);
                        if (jsondata.records.balance != "")
                            if (jsondata.records.balance > 0) {
                                document.getElementById("balance_received").innerHTML = 'E-Wallet Balance :' +
                                    jsondata.records.balance;

                            } else {
                                document.getElementById("balance_received").innerHTML = 'E-Wallet Balance : 0';
                            }
                    }
                });


            }
            // var timer = setInterval(function() {
            //     check_updated_balance();
            // }, 1000);
        </script>
        <script>
            function inpNum(e) {
                e = e || window.event;
                var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
                var charStr = String.fromCharCode(charCode);
                if (!charStr.match(/^[0-9]+$/))
                    e.preventDefault();
            }

            function nextData() {
                var amount = document.getElementsByClassName("amount");
                //    var amount =  document.getElementById("AMmount").value;
                var req_amount = amount[0].value;
                console.log(amount[0].value);

                if (Number(req_amount) >= 100) {
                    // document.getElementsByClassName("amount").value= amount;

                    $('.amount').prop('readonly', true);
                    $('#nextForm').css('display', 'block');
                    $('#nextbtn').css('display', 'none');
                } else {
                    alert('Deposit amount atleast 100!');
                }

            }


            const requestNow = (evt, id) => {
                document.getElementById('resMsg').innerHTML = '<p class="text-danger">Please wait...</p>';
                // evt.preventDefault();

                var url = document.getElementById(id).action;
                let element = document.getElementById(id)
                var Formdata = new FormData(element);
                // Formdata.append("files", fileInputElement.files[0]);
                // Formdata.append("amount", document.querySelector('input[name=amount]').value);
                // Formdata.append("csrf_test_name", document.querySelector('input[name=csrf_test_name]').value);
                // Formdata.append("txn_id", document.querySelector('input[name=txn_id]').value);
                // console.log(Formdata);

                fetch(url, {
                        method: "POST",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        body: Formdata,
                    })
                    .then(response => response.json())
                    .then(result => {
                        // toastr.options.newestOnTop = true;
                        // toastr.options.progressBar = true;
                        // toastr.options.closeButton = true;
                        // toastr.options.preventDuplicates = true;
                        var csrf_length = document.getElementsByName("csrf_test_name").length;
                        for (let i = 0; i < csrf_length; i++) {
                            document.getElementsByName("csrf_test_name")[i].value = result.token;
                        }
                        console.log(result);
                        if (result.status == true) {
                            // alert('Thank You!')
                            // console.log('success');

                            //toastr.success(result.message);
                            $('#mainform').css('display', 'none');

                            document.getElementById('resMsg').innerHTML = '<h5 class="text-success">' + result.message + '</span>'
                            // location.reload();
                            document.getElementById("scroll_top").style.paddingTop = "100px";
                            // window.location.reload();

                        } else {
                            console.log(result.status);
                            //toastr.info(result.message)
                            document.getElementById('resMsg').innerHTML = '<h5 class="text-danger">' + result.message + '</span>'
                        };
                    });
            }
        </script>
        <script type="">
            $(document).on('click', '#btnCopy', function () {
    //linkTxt
    var copyText = document.getElementById("linkTxt");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    alert("Copied the text: " + copyText.value);
})


</script>