<?php require_once 'header.php'; ?>
<style>
    .panel {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        word-wrap: break-word;
        /*background-color: #fff;*/
        border: 1px solid #e2e8f0;
        background-clip: border-box;
        border-radius: 7px;
        box-shadow: 0 4px 25px 0 rgb(168 180 208 / 10%);
    }

    .panel-body {
        padding: 1rem;
        flex: 1 1 auto;
        border-radius: 10px;
        /*background: white!important;*/
    }

    .panel-body:before {
        display: table;
        content: " ";
    }

    .row {
        margin-right: -15px;
        margin-left: -15px;
    }

    @media (min-width: 992px) {
        .col-md-12 {
            width: 100%;
            float: left;
        }

    }

    .text-center {
        text-align: center;
    }

    @media (min-width: 992px) {
        .col-md-6 {
            width: 50%;
            float: left;
        }
    }

    .loader223 {
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 99999999999;
        top: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.75);
    }

    .loader223 img {
        width: 74px;
        margin: auto;
        z-index: 999999999;
        position: absolute;
        top: 45%;
        left: 0;
        right: 0;
    }

    .loader223 p {
        margin: auto;
        z-index: 999999999;
        position: absolute;
        top: 60%;
        left: 0;
        right: 0;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: 700;
        color: black;
    }

    @media (min-width: 992px) {
        .col-md-12 {
            width: 100%;
            float: left;
        }
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #111;
        background: #fff;
        border: 1px solid #e9e9ef;
        border-radius: 4px;
        box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    }

    [data-sidebar-style="overlay"] .content-body {
        margin-left: 0;
        min-height: 0px !important;
    }
</style>

<div class="content-body">
    <div class="panel">
        <div class="panel-body">
            <div class="container-fluid bg-white">

                <div class="row">
                    <div class="col-md-12">
                        <div class="border-gradient">
                            <div class="border-gradient_content">
                                <div class="text-center">
                                    <div class="tabs">
                                        <h3>Staking Wallet Withdrawal
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <br>
                        <script type="text/javascript">
                            //<![CDATA[
                            Sys.WebForms.PageRequestManager._initialize('ctl00$ContentPlaceHolder1$ScriptManager1', 'form2', ['tctl00$ContentPlaceHolder1$UpdatePanel2', 'ContentPlaceHolder1_UpdatePanel2'], [], [], 90, 'ctl00');
                            //]]>
                        </script>
                        <div class="col">
                            <div id="ContentPlaceHolder1_UpdateProgress1" class="loader223" style="display:none;">

                                <img src="../img/loader.gif">
                                <p style="color: #000; text-align: center;">Loging...</p>

                            </div>

                            <div id="ContentPlaceHolder1_UpdatePanel2">

                                <div class="latest_news">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Income Staking Wallet Balance :</label>

                                                $<span id="ContentPlaceHolder1_lblbalance" style="font-weight:bold;"><?php echo $balance['balance']; ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">RVC Live Price:</label>
                                                $<span id="ContentPlaceHolder1_lblcoinrate" style="font-weight:bold;"><?php echo $tokenValue['amount'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <p><?php echo $this->session->flashdata('message'); ?> </p>

                                    <?php echo form_open(); ?>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Enter Amount :<span id="ContentPlaceHolder1_lblacept" style="color:Green;"></span></label>
                                                <input name="amount" type="number" onkeyup="myFunction()" maxlength="6" id="ContentPlaceHolder1_txtAmount" class="form-control" placeholder="Enter $" style="">
                                                <span id="error" style="color: Red; display: none">* Input digits (0 - 9)</span>
                                                <span data-val-controltovalidate="ContentPlaceHolder1_txtAmount" data-val-focusonerror="t" data-val-errormessage="Please select Amount" data-val-display="Dynamic" data-val-validationgroup="g1" id="ContentPlaceHolder1_RequiredFieldValidator1" data-val="true" data-val-evaluationfunction="RequiredFieldValidatorEvaluateIsValid" data-val-initialvalue="" style="display:none;">*</span>
                                                <input type="hidden" name="ctl00$ContentPlaceHolder1$hdnregno" id="ContentPlaceHolder1_hdnregno" value="459">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Value in RVC </label>
                                                <span id="ContentPlaceHolder1_lblvalueELT" class="form-control">0</span>
                                            </div>
                                        </div>
                                     
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Select Wallet </label>
                                                <table id="ContentPlaceHolder1_rdradio">
                                                    <tbody>
                                                        <tr>
                                                            <td><input id="ContentPlaceHolder1_rdradio_0" type="radio" name="type" value="rvc_wallet"><label for="ContentPlaceHolder1_rdradio_0">RVC Topup Wallet</label></td>
                                                            <td><input id="ContentPlaceHolder1_rdradio_1" type="radio" name="type" value="busd"><label for="ContentPlaceHolder1_rdradio_1">BUSD </label></td>
                                                            <td><input id="ContentPlaceHolder1_rdradio_2" type="radio" name="type" value="trust_wallet"><label for="ContentPlaceHolder1_rdradio_2">Trust/MetaMask Wallet</label></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <span id="ContentPlaceHolder1_lblMsg" style="color:Red;font-weight:bold;">Minimum Withdrawal $5 </span>
                                    <div class="row mt-2">
                                        <div class="col-md-4">


                                        </div>
                                    </div>
                                    <button class="btn btn-success" type="submit">Submit</button>
                                    <!-- <input type="hidden" name="ctl00$ContentPlaceHolder1$HiddenField1" id="ContentPlaceHolder1_HiddenField1" value="0.00"> -->
                                </div>


                            </div>
                        </div>
                        <?php echo form_close(); ?>
                       <hr>


                    </div>
                </div>
            </div>


           
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-body bg-white mt-2">
                            <div class="row">
                                <h4> Withdrawal History</h4>
                            </div>
                            <br>

                            <div class="panel panel-default">
                                <span id="ContentPlaceHolder1_Label1" style="color:DarkRed;"></span>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="panel panel-default">
                                            <div class="box-body" style="overflow: auto;">



                                            </div>
                                            <div class="ufxtitlecntr">
                                                <br>
                                                <h5 style="margin-bottom: 10px;">Note: Transfer Payecoin on your registered wallet.
                                                </h5>
                                                <input type="hidden" name="ctl00$ContentPlaceHolder1$hfwidmax" id="ContentPlaceHolder1_hfwidmax" value="0">
                                            </div>
                                            <div class="box-solid">
                                                <div class="box-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped dataTable" id="">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>User ID</th>
                                                                <th>Amount</th>
                                                                <th>Admin Charges</th>
                                                                <th>Status</th>
                                                                <th>Coin</th>
                                                                <th>Credit Type</th>
                                                                <th>Payable Amount</th>
                                                                <th>Craeted Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($withdrawRecord as $key => $row) {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $key + 1; ?></td>
                                                                    <td><?php echo $row['user_id']; ?></td>
                                                                    <td><?php echo $row['amount']; ?></td>
                                                                    <td><?php echo $row['admin_charges']; ?></td>
                                                                    <td><?php echo $row['status']; ?></td>
                                                                    <td><?php echo $row['coin']; ?></td>
                                                                    <td><?php echo ucwords(str_replace('_',' ', $row['credit_type'])); ?></td>
                                                                    <td><?php echo $row['payable_amount']; ?></td>
                                                                    <td><?php echo $row['created_at']; ?></td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
<script>
    function myFunction() {
        var token = "<?php echo $tokenValue['amount'] ?>";
        var amount = document.getElementById("ContentPlaceHolder1_txtAmount").value;
        //   alert(amount);

        document.getElementById('ContentPlaceHolder1_lblvalueELT').innerHTML = amount / token;

    }
</script>