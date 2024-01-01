<?php $this->load->view('header'); ?>
<script>
function countdown(element, seconds) {
    // Fetch the display element
    var el = document.getElementById(element).innerHTML;

    // Set the timer
    var interval = setInterval(function() {
        if (seconds <= 0) {
            //(el.innerHTML = "level lapsed");
            $('#'+element).text()

            clearInterval(interval);
            return;
        }
        var time = secondsToHms(seconds)
        $('#'+element).text(time)

        seconds--;
    }, 1000);
}

function secondsToHms(d) {
    d = Number(d);
    var day = Math.floor(d / (3600 * 24));
    var h = Math.floor(d % (3600 * 24) / 3600);
    var m = Math.floor(d % 3600 / 60);
    var s = Math.floor(d % 3600 % 60);

    var dDisplay = day > 0 ? day + (day == 1 ? " day, " : " days, ") : "";
    var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes, ") : "";
    var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";
    var t = dDisplay + hDisplay + mDisplay + sDisplay;
    return t;
    // console.log(t)
}
</script>


<div class="content-body">
			<div class="container-fluid">
        <div>
            <div class="panel-heading">
                <h4 class="panel-title"><?php echo $header; ?></h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="wizard-content tab-content p-0">
                        <div class="tab-pane active show" id="tabFundRequestForm">
                            <div class="col-md-12 p-0">
            <form method="GET" action="<?php  echo $path;?>">
             <div class="row ">
                  </div>
              <div class="row">
                      <?php echo $field;?>
              </div>
            </form>

            <div class="wizard-content tab-content p-0">
                            <!-- BEGIN tab-pane -->
                            <div class="tab-pane active show" id="tabFundRequestForm">
                                <!-- BEGIN row -->
                                <div class="row">
                                    <!-- BEGIN col-6 -->
                                    <div class="col-md-6 ">

                                        <?php echo form_open('', array('id' => 'TopUpForm')); ?>

                                        <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>

                                        <div class="">

                                        <div class="form-group">
                                            <label>user Id</label>
                                            <input type="text" class="form-control" name="amount" id="userId" placeholder="user id" value="" />
                                            <span class="text-danger"><?php echo form_error('amount') ?></span>
                                        </div>
                               
                                        <div class="form-group">
                                            <label id="to_lable">To</label>
                                            <input type="text" class="form-control" name="to_date" id="to" placeholder="To date" value="" />
                                        </div>

                                        <div class="form-group">
                                            <label id="from_lable">From</label>
                                            <input type="text" class="form-control" name="from_date" id="from" placeholder="To date" value="" />
                                        </div>
                                   
                                            <button type="subimt" name="save" class="btn btn-success">Withdrawal Now</button>
                                        </div>
                                        <?php echo form_close(); ?>

                                    </div>
                                  
                                    <!-- END col-6 -->
                                </div>
                                <!-- END row -->
                            </div>
                            <!-- END tab-pane -->
                            <!-- BEGIN tab-pane -->

                        </div>

    <div class="table-responsive">

                <table class="table table-bordered table-striped dataTable">
                    <thead>
                        <?php echo $thead; ?>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($tbody as $key => $value) {
                            echo $value;
                        }
                    ?>
                    </tbody>
                </table>

                <?php echo $this->pagination->create_links(); ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> </div>
    </div>
</div> 



<?php $this->load->view('footer');?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <script>
  $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  </script>
