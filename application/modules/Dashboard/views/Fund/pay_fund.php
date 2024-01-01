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
                    <span>Deposit Fund </span>
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

                                        </div>
                                    </div>
                                    <div class="form-group m-b-10">

                                        <div class="form-group m-b-10">

                                            <?php echo form_open_multipart();?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h2><?php echo $this->session->flashdata('message');?></h2>
                                                    <div class="form-group">
                                                        <label>Enter Amount</label>
                                                        <?php
                                                echo form_input(array('type' => 'number', 'name' => 'amount', 'class' => 'form-control','required'=>true));
                                                ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php
                                                echo form_input(array('type' => 'submit' , 'class' => 'btn btn-success pull-right','name' => 'fundbtn','value' => 'Next'));
                                                ?>
                                                    </div>
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
            </div>
        </div>
    </div>
    <?php  $this->load->view('footer');?>