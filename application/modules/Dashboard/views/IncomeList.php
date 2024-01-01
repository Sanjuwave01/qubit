<?php require_once'header.php';?>
<style>
	.content {
    min-height: 250px;
    padding: 15px;
    margin-right: auto;
    margin-left: auto;
    padding-left: 15px;
    padding-right: 15px;
}
.panel{
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
        margin-bottom: 20px;

}
@media screen and (max-width: 640px){
.dataTables_wrapper .dataTables_length{
    float: none;
    text-align: center;
}
}

.panel-body {
    padding: 1rem;
    flex: 1 1 auto;
    border-radius: 10px;
}
 .panel-body:before {
    display: table;
    content: " ";
}
 .row:before {
    display: table;
    content: " ";
}
@media (min-width: 992px){
.col-md-12 {
    width: 100%;
        position: relative;
    min-height: 1px;
    padding-right: 0px;
    padding-left: 0px;
}
}
h4{
	font-weight: 600;
    line-height: 1.1;
   margin-top: 10px;
    color: black;
}
hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #eee;
}
@media (min-width: 1200px){
.col-lg-4 {
    width: 33.33333333%;
        position: relative;
    min-height: 1px;
    padding-right: 0px;
    padding-left: 0px;
}
}
.form-group {
    margin-bottom: 15px;
}
.clearfix:before{
	    display: table;
    content: " ";
}
@media (min-width: 768px){
.col-sm-4 {
    width: 33.33333333%;
        position: relative;
    min-height: 1px;
    padding-right: 0px;
    padding-left: 0px;
}
}
@media screen and (max-width: 640px){
.dataTables_wrapper .dataTables_filter {
    margin-top: 0.5em;
    float: none;
    text-align: center;
}
}
.col-sm-12{
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

<div class="content-body "style="min-height: auto!important;">
        <div class="panel">
            <div class="panel-body">
            	<div class="container-fluid">
                <div class="row" style="    background: white;">
                    <div class="col-md-12">
                        <h4 style="margin-top: 10px;">Daily Staking Income</h4>
                        <hr>
                        <div class="form-group clearfix">
                            <div class="col-sm-4" style="margin-top: 10px;">
                                <select name="ctl00$ContentPlaceHolder1$ddlpayout" onchange="javascript:setTimeout('__doPostBack(\'ctl00$ContentPlaceHolder1$ddlpayout\',\'\')', 0)" id="ContentPlaceHolder1_ddlpayout" class="form-control">
	<option selected="selected" value="--Select Package--">--Select Package--</option>

</select>
                            </div>
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                                <span id="ContentPlaceHolder1_lblMsg" style="color:Red;"></span>
                                <span id="ContentPlaceHolder1_lblErrorText" style="color:Red;"></span>
                            </div>
                        </div>
                        <div class="user-transactions">
                            <div class="user-transactions__head" style="overflow: auto;">
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>



<?php require_once'footer.php';?>