<?php require_once'header.php';?>
<style>
	.form-control {
    color: #111;
    background: #fff;
}
.panel-body {
    padding: 1rem;
    flex: 1 1 auto;
    border-radius: 10px;
}

.form-control {
    display: block;
    width: 100%;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    border: 1px solid #e9e9ef;
    border-radius: 4px;
 
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
.btn-primary {
    background-color: #00b1f6;
    border-color: #367fa9;
}
.col-sm-12{
        position: relative;
    width: 100%;
     padding-right: 0px!important; 
    padding-left: 0px!important;
}
.col-md-12{
        position: relative;
    width: 100%;
     padding-right: 0px!important; 
    padding-left: 0px!important;
}
.col-md-6{
        position: relative;
    width: 100%;
     padding-right: 0px!important; 
    padding-left: 0px!important;
}
.col-md-8{
        position: relative;
    width: 100%;
     padding-right: 0px!important; 
    padding-left: 0px!important;
}
[data-sidebar-style="overlay"] .content-body {
    margin-left: 0;
    min-height: 0px!important;
}

</style>

<div class="content-body">
	<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add BNB Into Topup Wallet ($)</h4>
                    </div>

                    <div class="card-body">
                    	<div class="row">
                        <div class="col-md-8">
                            <script type="text/javascript">
//<![CDATA[
Sys.WebForms.PageRequestManager._initialize('ctl00$ContentPlaceHolder1$ScriptManager1', 'form2', ['tctl00$ContentPlaceHolder1$UpdatePanel2','ContentPlaceHolder1_UpdatePanel2'], [], [], 90, 'ctl00');
//]]>
</script>


                            <div id="ContentPlaceHolder1_UpdateProgress1" class="loader223" style="display:none;">
	
                                    <img src="../img/loader.gif">
                                    <p style="color: #000; text-align: center;">Loging...</p>
                                
</div>

                            <div id="ContentPlaceHolder1_UpdatePanel2">
	
                                    <div class="latest_news">

                                        <div class="row">
                                            <div class="col-md-12" style="font-weight: bold; color: black;">
                                               Enter BNB Quantity : <span id="ContentPlaceHolder1_lblcoinrate" style="font-weight:bold;"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    
                                                    <input name="ctl00$ContentPlaceHolder1$txtAmount" type="text" maxlength="6" id="ContentPlaceHolder1_txtAmount" class="form-control" placeholder="Enter BNB value" onkeypress="return IsNumeric(event);" onkeyup="javascript: return calculatecoininUSD();" style="">
                                                    <span id="error" style="color: Red; display: none">* Input digits (0 - 9)</span>
                                                    <span data-val-controltovalidate="ContentPlaceHolder1_txtAmount" data-val-focusonerror="t" data-val-errormessage="Please select Amount" data-val-display="Dynamic" data-val-validationgroup="g1" id="ContentPlaceHolder1_RequiredFieldValidator1" data-val="true" data-val-evaluationfunction="RequiredFieldValidatorEvaluateIsValid" data-val-initialvalue="" style="display:none;">*</span>

                                                    <input type="hidden" name="ctl00$ContentPlaceHolder1$hdnregno" id="ContentPlaceHolder1_hdnregno" value="459">
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                               <button type="button" onclick="buyToken()" class="btn btn-primary">Make Connection</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <span id="ContentPlaceHolder1_lblMsg" style="color:Red;font-weight:bold;"></span>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">


                                                <h4>Amount In USD :   
                                                    <span id="ContentPlaceHolder1_lblusdvalue"></span></h4>
                                            </div>
                                        </div>
                                        <input type="hidden" name="ctl00$ContentPlaceHolder1$HiddenField1" id="ContentPlaceHolder1_HiddenField1" value="0">

                                    </div>
                                
</div>

                        </div>
                        <div class="col-md-4"style="justify-content: center;
    display: flex;">
                        	 <img src="<?php echo base_url('uploads/connect-wallet.png'); ?>" alt="logo">

                           

                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="container-fluid" >
        <div class="row">
            <div class="col-sm-12">
                <div class="card " style="    margin-top: 25px;">
                    <div class="card-header">
                        <h3 class="card-title">Add Fund History</h3>
                    </div>
                    <div class="card-body">
                        <span id="ContentPlaceHolder1_Label1" style="color:DarkRed;"></span>
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

<?php require_once 'footer.php';?>