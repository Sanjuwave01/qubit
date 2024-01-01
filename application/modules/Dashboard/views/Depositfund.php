<?php require_once 'header.php'; ?>
<style>
	.skin-blue .content__body {
		background: transparent;
	}

	.content__body {
		position: relative;
		padding: 15px 15px;
	}

	.br-pagetitle i {
		float: left;
		color: #000;
		display: table;
		font-size: 44px;
		margin-right: 10px;
	}

	.panel-body {
		padding: 1rem;
		flex: 1 1 auto;
		border-radius: 10px;
	}

	.btn-primary {
		background-color: #00b1f6;
		border-color: #367fa9;
	}

	.btn-success {
		color: #fff !important;
		background-color: #5cb85c;
		border-color: #4cae4c;
	}

	label {
		display: inline-block;
		max-width: 100%;
		margin-bottom: 5px;
		font-weight: 700;
		color: black;
	}

	@media (min-width: 768px) {
		.col-sm-12 {
			position: relative;
			width: 100%;
			padding-right: 0px;
			padding-left: 0px;
		}
	}

	.form-control {
		display: block;
		width: 100%;
		padding: 6px 12px;
		font-size: 14px;
		line-height: 1.42857143;
		color: #000;
		background-color: white;
		border: 1px solid #e9e9ef;
		border-radius: 4px;
		box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
		transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
	}


	.btn {
		border-radius: 3px;
		box-shadow: none;
		border: 1px solid transparent;
	}

	@media (min-width: 992px) {
		.col-md-6 {
			width: 50%;
		}
	}

	.row {
		display: flex;
		flex-wrap: wrap;
	}

	@media (min-width: 768px) {
		.col-sm-12 {

			position: relative;
			width: 100%;
			padding-right: 0px;
			padding-left: 0px;
		}
	}

	@media (min-width: 576px) {
		.col-sm-12 {
			flex: 0 0 100%;
			max-width: 100%;
			position: relative;
			width: 100%;
			padding-right: 0px;
			padding-left: 0px;
		}
	}

	.col-sm-12 {
		position: relative;
		width: 100%;
		padding-right: 0px !important;
		padding-left: 0px !important;
	}

	.col-md-6 {
		position: relative;
		width: 100%;
		padding-right: 7px !important;
		padding-left: 0px !important;
		    min-height: 172px!important;
	}

	[data-sidebar-style="overlay"] .content-body {
		margin-left: 0;
		min-height: 0px !important;
	}

	@media (mix-width: 576px) {

		.content__body {
			padding: 0px !important;
			margin: 0px !important;
		}

	}
</style>


<div class="content-body">
	<div class="container-fluid">
		<div class="col-12">
			<div class="br-pagetitle">
				<i class="fas fa-cart-arrow-down"></i>
				<div>
					<h4>Fund Request</h4>
					<p class="mg-b-0">Fund deposited in your topup wallet</p>
				</div>
			</div>
		</div>
		<h4><?php echo $this->session->flashdata('message');?></h4>
		<?php echo form_open_multipart(); ?>
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-bd lobidrag" style="    background: white;">

							<div class="panel-body">

								<div class="single-port-content" data-margin="0px 0px 0 0">
									<div class="form-group">
										<span id="ContentPlaceHolder1_lblMsg" style="color:Red;font-weight:bold;"></span>
									</div>
									<div class="form-group">
										<label class=" control-label" for="address">Payment Mode</label>
										<select name="payment_method" onchange="javascript:setTimeout('__doPostBack(\'ctl00$ContentPlaceHolder1$ddlPayMode\',\'\')', 0)" id="ContentPlaceHolder1_ddlPayMode" class="form-control">
											<option selected="selected" value="0">--Select Payment Mode--</option>
											<option value="bnb">BNB</option>
											<option value="bep20_usdt">BEP20 USDT</option>
											<option value="tron">Tron(TRX)</option>
											<option value="trc20_usdt">TRC20 USDT</option>

										</select>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Fund Request Amount</label>
										<input name="amount" type="text" maxlength="5" onchange="javascript:setTimeout('__doPostBack(\'ctl00$ContentPlaceHolder1$txtamount\',\'\')', 0)" onkeypress="if (WebForm_TextBoxKeyHandler(event) == false) return false;return IsNumeric(event);" id="ContentPlaceHolder1_txtamount" class="form-control" placeholder="Request Amount $">
										<span id="error" style="color: Red; display: none">* Input digits (0 - 9)</span>
									</div>
									<div class="form-group" style="display: none">
										<h4>
											<span id="ContentPlaceHolder1_lblpackgeamt" style="color:Blue;font-weight:bold;"></span>
										</h4>
									</div>

									<div class="form-group" style="display: flex">
										<h4>
											<span id="ContentPlaceHolder1_lblPMVal" style="color:#09EDDE;font-weight:bold;"></span>
											<span id="ContentPlaceHolder1_lblTotBnbTrx" style="color:#09EDDE;font-weight:bold;"></span>
										</h4>
									</div>
									<div class="form-group">
										<img src="<?php echo base_url('uploads') . '/qrcode.png' ?>" style="width: 243px;" alt="QrImage">
									</div>

									<div class="form-group">
										<label for="exampleInputEmail1">Wallet Address</label>
										<input type="text" id="linkTxt" class="form-control" value="0x1479d82d851d9c4e3a045438f9a035ace56ffd68" readonly>
										<button class="btn btn-primary cpybtn mt-1" id="btnCopy">Copy Link</button>
									</div>
									<div class="form-group">
										<label class=" control-label" for="city">Transaction No</label>
										<input name="txn_id" type="text" id="ContentPlaceHolder1_txtref" class="form-control" placeholder="Transaction No">
									</div>
									<div class="form-group">
										<label class=" control-label" for="city">Remarks</label>
										<textarea name="remark" rows="2" cols="20" id="ContentPlaceHolder1_txtComment" class="form-control" placeholder="Comment"></textarea>
									</div>
									<div class="form-group">
										<label class=" control-label" for="your-mobile">Upload Screenshot <span style="color: blue;">*</span></label>
										<input type="file" name="userfile" id="ContentPlaceHolder1_FileUpload1" class="form-control">
									</div>


									<div class="form-group">
										<button type ="submit" class="btn btn-success" style="background-color: #2d598c;" >Submit</button>&nbsp;
										<!-- <input type="submit" name="ctl00$ContentPlaceHolder1$btnSubmit" value="Submit" onclick="return ValidateForm();" id="ContentPlaceHolder1_btnSubmit" class="btn btn-success" style="background-color: #2d598c;"> -->
										<input type="submit" name="ctl00$ContentPlaceHolder1$Button2" value="Cancel" id="ContentPlaceHolder1_Button2" class="btn btn-danger" style="background-color: #e04205;">

									</div>

									<?php echo form_close(); ?>
									<div style="display: none">
										<label class="col-md-2 control-label" for="your-dob">Payment Date</label>
										<div class="col-md-4">
											<div class="col-md-4">
												<select name="ctl00$ContentPlaceHolder1$ddlDay" id="ContentPlaceHolder1_ddlDay" class="form-control">
													<option selected="selected" value="-Day-">-Day-</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
													<option value="13">13</option>
													<option value="14">14</option>
													<option value="15">15</option>
													<option value="16">16</option>
													<option value="17">17</option>
													<option value="18">18</option>
													<option value="19">19</option>
													<option value="20">20</option>
													<option value="21">21</option>
													<option value="22">22</option>
													<option value="23">23</option>
													<option value="24">24</option>
													<option value="25">25</option>
													<option value="26">26</option>
													<option value="27">27</option>
													<option value="28">28</option>
													<option value="29">29</option>
													<option value="30">30</option>
													<option value="31">31</option>

												</select>

												<select name="ctl00$ContentPlaceHolder1$ddlMonth" id="ContentPlaceHolder1_ddlMonth" class="form-control">
													<option selected="selected" value="-Month-">-Month-</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>

												</select>
												<select name="ctl00$ContentPlaceHolder1$ddlYear" id="ContentPlaceHolder1_ddlYear" class="form-control">
													<option value="-Year-">-Year-</option>
													<option value="1901">1901</option>
													<option value="1902">1902</option>
													<option value="1903">1903</option>
													<option value="1904">1904</option>
													<option value="1905">1905</option>
													<option value="1906">1906</option>
													<option value="1907">1907</option>
													<option value="1908">1908</option>
													<option value="1909">1909</option>
													<option value="1910">1910</option>
													<option value="1911">1911</option>
													<option value="1912">1912</option>
													<option value="1913">1913</option>
													<option value="1914">1914</option>
													<option value="1915">1915</option>
													<option value="1916">1916</option>
													<option value="1917">1917</option>
													<option value="1918">1918</option>
													<option value="1919">1919</option>
													<option value="1920">1920</option>
													<option value="1921">1921</option>
													<option value="1922">1922</option>
													<option value="1923">1923</option>
													<option value="1924">1924</option>
													<option value="1925">1925</option>
													<option value="1926">1926</option>
													<option value="1927">1927</option>
													<option value="1928">1928</option>
													<option value="1929">1929</option>
													<option value="1930">1930</option>
													<option value="1931">1931</option>
													<option value="1932">1932</option>
													<option value="1933">1933</option>
													<option value="1934">1934</option>
													<option value="1935">1935</option>
													<option value="1936">1936</option>
													<option value="1937">1937</option>
													<option value="1938">1938</option>
													<option value="1939">1939</option>
													<option value="1940">1940</option>
													<option value="1941">1941</option>
													<option value="1942">1942</option>
													<option value="1943">1943</option>
													<option value="1944">1944</option>
													<option value="1945">1945</option>
													<option value="1946">1946</option>
													<option value="1947">1947</option>
													<option value="1948">1948</option>
													<option value="1949">1949</option>
													<option value="1950">1950</option>
													<option value="1951">1951</option>
													<option value="1952">1952</option>
													<option value="1953">1953</option>
													<option value="1954">1954</option>
													<option value="1955">1955</option>
													<option value="1956">1956</option>
													<option value="1957">1957</option>
													<option value="1958">1958</option>
													<option value="1959">1959</option>
													<option value="1960">1960</option>
													<option value="1961">1961</option>
													<option value="1962">1962</option>
													<option value="1963">1963</option>
													<option value="1964">1964</option>
													<option value="1965">1965</option>
													<option value="1966">1966</option>
													<option value="1967">1967</option>
													<option value="1968">1968</option>
													<option value="1969">1969</option>
													<option value="1970">1970</option>
													<option value="1971">1971</option>
													<option value="1972">1972</option>
													<option value="1973">1973</option>
													<option value="1974">1974</option>
													<option value="1975">1975</option>
													<option value="1976">1976</option>
													<option value="1977">1977</option>
													<option value="1978">1978</option>
													<option value="1979">1979</option>
													<option value="1980">1980</option>
													<option value="1981">1981</option>
													<option value="1982">1982</option>
													<option value="1983">1983</option>
													<option value="1984">1984</option>
													<option value="1985">1985</option>
													<option value="1986">1986</option>
													<option value="1987">1987</option>
													<option value="1988">1988</option>
													<option value="1989">1989</option>
													<option value="1990">1990</option>
													<option value="1991">1991</option>
													<option value="1992">1992</option>
													<option value="1993">1993</option>
													<option value="1994">1994</option>
													<option value="1995">1995</option>
													<option value="1996">1996</option>
													<option value="1997">1997</option>
													<option value="1998">1998</option>
													<option value="1999">1999</option>
													<option value="2000">2000</option>
													<option value="2001">2001</option>
													<option value="2002">2002</option>
													<option value="2003">2003</option>
													<option value="2004">2004</option>
													<option value="2005">2005</option>
													<option value="2006">2006</option>
													<option value="2007">2007</option>
													<option value="2008">2008</option>
													<option value="2009">2009</option>
													<option value="2010">2010</option>
													<option value="2011">2011</option>
													<option value="2012">2012</option>
													<option value="2013">2013</option>
													<option value="2014">2014</option>
													<option value="2015">2015</option>
													<option value="2016">2016</option>
													<option value="2017">2017</option>
													<option value="2018">2018</option>
													<option value="2019">2019</option>
													<option value="2020">2020</option>
													<option value="2021">2021</option>
													<option value="2022">2022</option>

												</select>
											</div>
										</div>

									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 bg-white">
				<h5>Fund Request List </h5>

				<div class="row" style="margin-top: 20px;">
					<div class="col-sm-12">
						<div class="panel panel-bd lobidrag">

							<div class="panel-body" style="background: white;">
								<!-- Main content -->
								<span id="ContentPlaceHolder1_lblmsggrid" style="font-weight:bold;"></span>


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
													<th>Status</th>
													<th>Payment Method</th>
													<th>Image</th>
													<th>Transaction Id</th>
													<!-- <th>Payable Amount</th> -->
													<th>Remarks</th>
													<th>Craeted Date</th>
													<!-- <th>Update Date</th> -->
												</tr>
											</thead>
											<tbody>
												<?php
												foreach ($payment_request as $key => $row) {
												?>
													<tr>
														<td><?php echo $key + 1; ?></td>
														<td><?php echo $row['user_id']; ?></td>
														<td><?php echo $row['amount']; ?></td>
														<td><?php echo $row['status']; ?></td>
														<td><?php echo $row['payment_method']; ?></td>
														<td><img width="200px;" src="<?php echo base_url('uploads/').$row['image']; ?>" alt="payment method"></td>
														<td><?php echo $row['transaction_id']; ?></td>
														<!-- <td><?php echo $row['payable_amount']; ?></td> -->
														<td><?php echo $row['remarks']; ?></td>
														<td><?php echo $row['created_at']; ?></td>
														<!-- <td><?php echo $row['updated_at']; ?></td> -->
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


<?php require_once 'footer.php'; ?>
<script>
	$(document).on('click', '#btnCopy', function() {
		var copyText = document.getElementById("linkTxt");
		copyText.select();
		copyText.setSelectionRange(0, 99999)
		document.execCommand("copy");
		alert("Copied : " + copyText.value);
	})
</script>