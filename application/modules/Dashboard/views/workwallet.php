
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
 .panel {
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
.panel-body {
    padding: 1rem;
    flex: 1 1 auto;
    border-radius: 10px;
}
h5{
	    font-family: 'Muli', sans-serif;
	    font-size: 14px;
	        font-weight: 600;
    line-height: 1.1;
        margin: 0;
}
.form-control {
    color: #111;
    background: #fff;
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
option {
    font-weight: normal;
    display: block;
    white-space: nowrap;
    min-height: 1.2em;
    padding: 0px 2px 1px;
}
.row:after {
    clear: both;
}
.row:after{
    display: table;
    content: " ";
}

.dataTables_wrapper {
    position: relative;
    clear: both;
    zoom: 1;
    overflow: auto;
}
.dataTables_wrapper .dataTables_length{
    color: #222;
    float: left;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
}
 select {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
    text-transform: none;

}
table.dataTable thead th{
    padding: 10px 18px;
    border-bottom: 1px solid #111111;
}
table.dataTable thead th {
    color: #fff;
}
.table-bordered > thead > tr > th{
    border: 1px solid #f4f4f4;
    color: white!important;
}
table thead tr {
    background: #0037ff;
}
 table.dataTable td.dataTables_empty {
    text-align: center;
}
table.dataTable tbody td {
     padding: 8px 10px; 
}
.dataTables_wrapper .dataTables_info {
    clear: both;
    float: left;
    padding-top: 0.755em;
}
.dataTables_wrapper .dataTables_paginate {
    float: right;
    text-align: right;
    padding-top: 0.25em;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled{
    cursor: default;
    color: #666 !important;
    border: 1px solid transparent;
    background: transparent;
    box-shadow: none;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    box-sizing: border-box;
    display: inline-block;
    min-width: 1.5em;
    padding: 0.em 1em;
    margin-left: 2px;
    text-align: center;
    text-decoration: none !important;
  
}
.dataTables_wrapper:after {
    visibility: hidden;
    display: block;
    content: "";
    clear: both;
    height: 0;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
}
.dataTables_wrapper .dataTables_filter{
    color: #222;
}

.dataTables_wrapper .dataTables_filter {
    float: right;
    text-align: right;
}
.dataTables_wrapper .dataTables_length{
    color: #222;
}
.dataTables_wrapper .dataTables_length {
    float: left;
}
.dataTables_wrapper .dataTables_filter input {
    margin-left: 0.5em;
}

input[type=search] {
    -webkit-appearance: none;
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

<div class="content-body">
     <div class="panel">
        <div class="panel-body">
        	<div class="container-fluid">
            <div class="row" style="background: white;">

                <div class="col-md-4">
                    <h5 style="margin-top: 10px;">Working Walllet ($)</h5>
                </div>
                <div class="col-lg-4"style="margin-top: 10px;">
                    <select name="ctl00$ContentPlaceHolder1$ddlTranstpye" onchange="javascript:setTimeout('__doPostBack(\'ctl00$ContentPlaceHolder1$ddlTranstpye\',\'\')', 0)" id="ContentPlaceHolder1_ddlTranstpye" title="Select Transaction" class="form-control" style="font-weight:bold;">
	<option selected="selected" value="--Select Transaction--">--Select Transaction--</option>
	<option value="Convenience Fee">Convenience Fee</option>
	<option value="Fund Transfer">Fund Transfer</option>
	<option value="Fund Withdrawal">Fund Withdrawal</option>
	<option value="Staking Income">Staking Income</option>

</select>
                </div>
                 <div class="col-md-4">
                        <label class="col-sm-2 control-label" style="margin-top: 10px;">Totat</label>
                        <div class="col-md-4">
                            <span id="ContentPlaceHolder1_lbltotal" style="color:White;">0.00</span>
                        </div>
                    </div>
         
            <div class="user-transactions row">
                <div class="col-md-12">
                    <div class="user-transactions__head" style="overflow: auto;">
                        <span id="ContentPlaceHolder1_lblmsg" style="color:Red;"></span>
                        
                                <div id="example_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="example_length"><label>Show <select name="example_length" aria-controls="example" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="example_filter" class="dataTables_filter"><label>Search:<input type="search" class="" aria-controls="example"></label></div><table class="table table-striped table-bordered table-hover dataTable no-footer" id="example" role="grid" aria-describedby="example_info">
                                    <thead>
                                
                                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.: activate to sort column ascending" style="width: 179px;">S.No.</th><th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Credit: activate to sort column ascending" style="width: 192px;">Credit</th><th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Debit: activate to sort column ascending" style="width: 176px;">Debit</th><th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="TransDate: activate to sort column ascending" style="width: 272px;">TransDate</th><th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="TransType: activate to sort column ascending" style="width: 276px;">TransType</th><th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="TransHash: activate to sort column ascending" style="width: 284px;">TransHash</th></tr>
                                     
                                    </thead>
                            
                                <tbody><tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr></tbody></table><div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div><div class="dataTables_paginate paging_simple_numbers" id="example_paginate"><a class="paginate_button previous disabled" aria-controls="example" data-dt-idx="0" tabindex="0" id="example_previous">Previous</a><span></span><a class="paginate_button next disabled" aria-controls="example" data-dt-idx="1" tabindex="0" id="example_next">Next</a></div></div>
								</div>
                            

                    </div>
                </div>
                   </div>
        </div>
            </div>
        </div>
    </div>



<?php require_once'footer.php';?>



