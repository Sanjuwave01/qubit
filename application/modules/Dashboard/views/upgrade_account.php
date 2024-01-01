<?php include_once 'header.php'; ?>
   
<style>
section.content-header {
    background-color: #111010;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
}
span.heading {
    color: #f5c242;
    font-size: 22px;
    font-weight: bold;
}

</style>
<script>
function countdown(element, seconds) {
    // Fetch the display element
    var el = document.getElementById(element).innerHTML;

    // Set the timer
    var interval = setInterval(function() {
        if (seconds <= 0) {
            //(el.innerHTML = "level lapsed");
            $('#'+element).text('Expired')

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

    var dDisplay = day > 0 ? day + (day == 1 ? " day, " : "D ") : "";
    var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : "H ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : "M ") : "";
    var sDisplay = s > 0 ? s + (s == 1 ? " second" : "S ") : "";
    var t = dDisplay + hDisplay + mDisplay + sDisplay;
    return t;
    // console.log(t)
}
</script>
<div class="content-body">
			<div class="container-fluid">
        <div>
            <section class="content-header" style="border-radius: 15px;overflow: hidden;">
            <div id="particles-js"></div>
                <div class="col-md-12">
                    <div class="row align-items-center">
                        <div class="col-md-6 mining-bg">
                            <span style=""><img style="width:100%;height: 95%;margin-top: 10px;" src="https://www.btcs.love/images/invite/Mining.gif"></span>
                           <div class="counting" data-count="100100100100100100100100100100">0</div>

                        </div>
                        <div class="col-md-6 mining-coins">
                           <!--  <div class="mining-head text-center">
                                <img style="max-width:150px;" src="<?php echo base_url('uploads/logo.png');?>">
                            </div> -->
                            <div class="mining-details text-center">
                            <?php if(!empty($roiStatus['user_id'])):
                              $date1 = date('Y-m-d H:i:s');
                              $date2 = date('Y-m-d H:i:s',strtotime($user['topup_date'].' + 0 days'));
                              $diff = strtotime($date1) - strtotime($date2);
                              if($diff > 0){
                                if($roiStatus['status'] == 1):
                            ?>
                                  <button class="btn btn-primary w-100 mt-2 theme-btn" type="button" onclick="adsView()">Click Here to Mine</button>
                            <?php 
                                else:
                                  echo '<span class="text-danger">Today Task Done</span>';
                                  $diff1 = strtotime('+ 24 hours', strtotime($roiStatus['updated_at'])) - strtotime(date('Y-m-d H:i:s'));
                                  echo ' <p class="text-danger">Time Left for Next Task</p> <p class="text-danger" id="TradingTimmer"></p>';
                                  echo'<script> countdown("TradingTimmer",'.$diff1.') </script>';
                                endif;
                              } else {
                                echo 'Wait....';
                              } 
                              ?>
                            <?php else:?>
                              <span class="heading">Please Activate Your Account</span>
                            <?php endif;?>
                            <div class="row">
                              <div class="col-sm-6">
                                 <h4>Today Mining Profit : </h4><span class="text-golden">$<?php echo $today['today_roi'];?></span>
                              </div>
                              <div class="col-sm-6">
                                 <h4>Total Mining Profit : </h4><span class="text-golden">$<?php echo $total['total_roi']; ?></span>
                              </div>
                            </div>
                               
                               
                                
                            </div>

                        </div>
                        
                    </div>
                </div>
            </section>
        
</div>
</div>
</div>
</div>




<?php include_once'footer.php'; ?>
<script>

function adsView(){
    var url = "<?php echo base_url('Dashboard/AjaxController/adsView');?>";
    fetch(url,{
        methods:"GET",
        headers:{
            "X-Requested-With": "XMLHttpRequest",
        }
    })
    .then(response => response.json())
    .then(response => {
      location.reload();
    })
}
    // $(document).on('blur', '#user_id', function () {
    //     var user_id = $('#user_id').val();
    //     if (user_id != '') {
    //         var url = '<?php //echo base_url("Dashboard/User/get_user/") ?>' + user_id;
    //         $.get(url, function (res) {
    //             $('#errorMessage').html(res);
    //             $('#user_id').val(user_id);
    //         })
    //     }
    // })
    $(document).on('submit', '#TopUpForm', function () {
        if (confirm('Are You Sure U want to Topup This Account')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
    $(document).on('change','#PackageId',function(){
        var package_price = parseInt($(this).children("option:selected").data('price'));
        $('#Payamount').val(package_price);
        // alert(package_price)
    })
</script>

<script>
    // $("body").on("mousemove", function (e) {
//   //   var x = e.pageX,
//   //       y = e.pageY,
//   //       w = $(window).width()/2;

//   //   if(x > w){
//   //     var dir = "right"
//   //     } else if(x < w){
//   //       var dir = "left"
//   //       }

//   //   console.log(dir);


// });

particlesJS("particles-js", {

  "particles": {
    "number": {
      "value": 250,
      "density": {
        "enable": true,
        "value_area": 1500
      }
    },
    "color": {
      "value": "#fff"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "http://image.ibb.co/g9eFcF/logo_transparent.png",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 1,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.6,
        "sync": false
      }
    },
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 3,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 120,
      "color": "#ffffff",
      "opacity": 0.5,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 8,
      "direction": "random",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": true,
      "attract": {
        "enable": true,
        "rotateX": 3600,
        "rotateY": 3600
      }
    }
  },



  "interactivity": {
    "detect_on": "canvas",

    "events": {
      "onhover": {
        "enable": true,
        "mode": "grab"
      },

      "onclick": {
        "enable": true,
        "mode": "remove"
      },
      "resize": true
    },

    "modes": {
      "grab": {
        "distance": 140,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 100,
        "size": 4,
        "duration": 2,
        "opacity": 1,
        "speed": 3
      },

      "repulse": {
        "distance": 200,
        "duration": 0.5
      },

      "push": {
        "particles_nb": 5
      },

      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
</script>

<script>
 // number count for stats, using jQuery animate

$('.counting').each(function() {
  var $this = $(this),
      countTo = $this.attr('data-count');
  
  $({ countNum: $this.text()}).animate({
    countNum: countTo
  },

  {

    duration: 6000,
    easing:'linear',
    step: function() {
      $this.text(Math.floor(this.countNum));
    },
    complete: function() {
      $this.text(this.countNum);
      //alert('finished');
    }

  });  
  

});
</script>
