<?php include_once 'header.php';?>
<style>
	.col-xs-12 {
    width: 100%;
}
 .box {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 100%;
    word-wrap: break-word;
    background-color: #fff;
    border: 1px solid #e2e8f0;
    background-clip: border-box;
    border-radius: 7px;
    box-shadow: 0 4px 25px 0 rgb(168 180 208 / 10%);
}
 .box-header {
    color: #282f53;
    display: block;
    padding: 1.5rem;
    position: relative;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.box-header.with-border {
    border-bottom: 1px solid #f4f4f4;
}
 .box-header .box-title {
    display: inline-block;
    font-size: 14px;
    margin: 0;
    line-height: 1;
    font-weight: 700;
}
@media (min-width: 992px){
.col-md-6 {
    width: 50%;
}
}
.form-group {
    margin-bottom: 15px;
    color: black;
    font-weight: 600;
}
@media (min-width: 992px){
.col-md-12 {
    width: 100%;
}
}
[data-sidebar-style="overlay"] .content-body {
    margin-left: 0;
    min-height: 0px!important;
}
</style>

    <div class="content-body">
                 <script type="text/javascript">
//<![CDATA[
Sys.WebForms.PageRequestManager._initialize('ctl00$ContentPlaceHolder1$ScriptManager1', 'form2', ['tctl00$ContentPlaceHolder1$UpdatePanel1','ContentPlaceHolder1_UpdatePanel1','tctl00$ContentPlaceHolder1$UpdatePanel2','ContentPlaceHolder1_UpdatePanel2'], [], [], 90, 'ctl00');
//]]>
</script>
<div class="container-fliud">
        <div class="row">
            <div class="col-md-12">
            	<h2 class="box-title">Mobile Recharge&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h2>
                <div class="box box-primary">

                    <div class="">
                        <div class="box-header with-border">
                            <!-- <h2 class="box-title">Token Balance:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h2>
                            <span id="ContentPlaceHolder1_lblbalance">0.00</span> -->
                        </div>
                        

                        <script lang="javascript" type="text/javascript">
                            function validatenew() {
                                var mobno1 = document.getElementById("ContentPlaceHolder1_txtmobno").value;
                            var regpath = /^[6789]\d{9}$/;
                            var matchArray = mobno1.match(regpath);
                            if (matchArray == null) {
                                alert("Please Enter Correct Mobile No. i.e Start With 6/7/8/9!");
                                document.getElementById("ContentPlaceHolder1_txtmobno").focus();
                                    return false;
                                }


                            }
                        </script>

                        <script type="text/javascript">
                            function onlyNumbers(evt) {
                                var e = event || evt; // for trans-browser compatibility
                                var charCode = e.which || e.keyCode;
                                if (charCode > 31 && (charCode < 48 || charCode > 57))
                                    return false;
                                return true;
                            }
                        </script>
                        <div class="breadcrumbs" id="breadcrumbs">
                            <script type="text/javascript">
                                try { ace.settings.check('breadcrumbs', 'fixed') } catch (e) { }
                            </script>

                        </div>
                    </div>

                    <div class="row">


	

                                <div class="col-md-6" style="padding-top: 10px; padding-left:30px;  padding-right:30px;">
                                    <!-- <div class="form-group">
                                       Token Rate
                                        <span id="ContentPlaceHolder1_lblcoinrate">0.1456</span>
                                    </div> -->
                                    <div class="form-group">
                                        <label>
                                            Mobile No.<span data-val-controltovalidate="ContentPlaceHolder1_txtmobno" data-val-errormessage="Enter Mobile No." id="ContentPlaceHolder1_RequiredFieldValidator1" data-val="true" data-val-evaluationfunction="RequiredFieldValidatorEvaluateIsValid" data-val-initialvalue="" style="visibility:hidden;">*</span>
                                            :
                                        </label>
                                        <input name="ctl00$ContentPlaceHolder1$txtmobno" type="text" maxlength="10" id="ContentPlaceHolder1_txtmobno" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            Recharge Amount
                                            <span data-val-controltovalidate="ContentPlaceHolder1_txtamt" data-val-errormessage="Enter Recharge Amount." id="ContentPlaceHolder1_RequiredFieldValidator2" data-val="true" data-val-evaluationfunction="RequiredFieldValidatorEvaluateIsValid" data-val-initialvalue="" style="visibility:hidden;">*</span>
                                            :</label>
                                        <input name="ctl00$ContentPlaceHolder1$txtamt" type="text" maxlength="4" onchange="javascript:setTimeout('__doPostBack(\'ctl00$ContentPlaceHolder1$txtamt\',\'\')', 0)" onkeypress="if (WebForm_TextBoxKeyHandler(event) == false) return false;return onlyNumbers(this);" id="ContentPlaceHolder1_txtamt" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        USD Value
                                        <span id="ContentPlaceHolder1_lblcoindeduction" style="color:Blue;">0</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Operator :</label>
                                        <select name="ctl00$ContentPlaceHolder1$DropDownList1" id="ContentPlaceHolder1_DropDownList1" class="form-control">
		<option value="- Select Operator -">- Select Operator -</option>
		<option value="1">AIRTEL</option>
		<option value="2">VI</option>
		<option value="3">IDEA</option>
		<option value="4">TATA INDICOM</option>
		<option value="5">TATA DOCOMO</option>
		<option value="7">MTNL</option>
		<option value="8">BSNL</option>
		<option value="9">AEROVOYCE</option>
		<option value="10">VIDEOCON</option>
		<option value="11">MTS</option>
		<option value="37">RELIANCE GSM</option>
		<option value="38">RELIANCE CDMA</option>
		<option value="40">BSNL STV</option>
		<option value="41">TATA DOCOMO STV</option>
		<option value="42">TELENOR STV</option>
		<option value="43">VIDEOCON STV</option>
		<option value="44">MTNL STV</option>
		<option value="88">Jio</option>

	</select>
                                    </div>
                                    <div class="form-group">
                                        <span id="ContentPlaceHolder1_lblMsg" class="errorMsg" style="color:Red;">Server Down , Please try after some time later !</span>
                                    </div>
                                    <div class="form-group">
                                        
                                    </div>
                                    <div class="form-group">
                                        <div data-val-showmessagebox="True" data-val-showsummary="False" id="ContentPlaceHolder1_ValidationSummary2" data-valsummary="true" style="display:none;">

	</div>
                                        
                                    </div>
                                </div>
                            
</div>



                    <table class="mainTable" style="width: 95%; margin: 0 auto;" id="TABLE1" onclick="return TABLE1_onclick()">

                        <tbody><tr style="color: #ffffff">
                            <td style="width: 31%"></td>
                            <td style="width: 46%" align="center">&nbsp;<div id="ContentPlaceHolder1_UpdateProgress2" class="loader223" style="display:none;">
	
                                    <img src="../images/loader.gif">
                                
</div>
                            </td>
                            <td style="width: 33%; padding-right: 25px;" align="right"></td>
                        </tr>

                        <tr>
                            <td colspan="3" align="center">
                                <div id="ContentPlaceHolder1_UpdatePanel2">
	
                                        <span id="ContentPlaceHolder1_Label1">No Data found!!</span>
                                        <div>

	</div>
                                    
</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 60px" colspan="3" align="center">
                                <div data-val-showmessagebox="True" data-val-showsummary="False" data-val-validationgroup="g1" id="ContentPlaceHolder1_ValidationSummary1" data-valsummary="true" style="color:DarkRed;display:none;">

</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="formTitle" colspan="3">

                                <input type="hidden" name="ctl00$ContentPlaceHolder1$hfreqid" id="ContentPlaceHolder1_hfreqid" value="0">
                                <input type="hidden" name="ctl00$ContentPlaceHolder1$hfregno" id="ContentPlaceHolder1_hfregno" value="0">
                            </td>
                        </tr>
                    </tbody></table>
                </div>
            </div>
        </div>
  </div>

    </div>

<?php require_once'footer.php';?>