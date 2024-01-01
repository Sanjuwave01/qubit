r<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>The Ricaverse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" /> -->
    <!-- <meta content="Themesbrand" name="author" /> -->
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo.png') ?>">

    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('NewDashboard/');?>assets/css/animation.css">

     <style>
         body{
           background-image: linear-gradient(70deg, #140E38 0%, #140E38 25%, #14387B 35%, #14387B 65%, #140E38 75%, #140E38 100%);
            background-size: cover;
            background-position: center;
            position: relative;
            height: 100vh;
        }
        .account-pages {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: absolute;
            width: 100%;
            top: 0;
        }
           .card-wrapper {
            max-width: 500px;
            width: 100%;
        }
        .card{
          margin-bottom: 0px;
        }
        .login-top-heading{
            text-transform: uppercase;
            color: #fff;
            font-weight: bold;
            font-size: 20px;
            display: inline-block;
        }
        h2.page-title {
            font-size: 23px;
            color: green;
            text-transform: uppercase;
            font-weight: bold;
        }

        .card-body {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75remrem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    border: 1px solid #23a2fd;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    
    background: #000000;
    color: white;
}


        a.back-to-home {
                color: #fff;
                padding: 0 20px;
                font-size: 21px;
            }
        @media screen and (max-width: 767px){
           .card{
                 margin-bottom:0px;
               }
            .card-wrapper{
                max-width: 100%;
                width: 100%;
            }

        }
        @media screen and (max-width: 575px){
            .top-head{
                text-align: center;
            }
        }
       /*.bg-black{
            background-color:#3b3363;
            padding: 21px 0 0px;
        }*/
    </style>

</head>

<body>
<div id="particles-js"></div>
<div class="account-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="align-items-center top-head">
                       
                    </div>
                    <div class="card overflow-hidden mt-3">
                        <div class="card-body py-0">
                            <div class="">
                                <div class="panel panel-primary">
                                    <div class="form-inner text-center" style="text-align:center;">
                          <a href="/" class="logo logo-admin">
                                <img src="<?php echo base_url(''); ?>assets/images/logo.png" style="max-width: 133px;margin-top: 20px;" alt="logo">
                            </a> <br>


                            <h5 style="text-transform: uppercase;color: #fff;font-weight: bold;font-size: 22px;font-family: inherit;
    font-weight: 600;    margin-top: -19px;    margin-top: 7px;
    line-height: 1.5; align-items: center; text-align: center;">Welcome Back !</h5><br>
                      <h5 style="text-transform: uppercase;color: #fff;font-weight: bold;font-size: 22px;font-family: inherit;
    font-weight: 600;    margin-top: -19px;
    line-height: 1.5; align-items: center; text-align: center;">Sign in to continue to The Ricaverse</h5>
                            <!-- <p class="m-0">Please enter your credentials to login.</p> -->
                       </div>


                    <?php
                    echo'<h5 class="mainboxes" style="margin-top:10px;    text-align: center; color:#46afd7;">' . $message . '</h5>';
                    ?>
                    <div style="font-size:20px;font-weight: bold; color:#45aed7; margin-top:20px"><a  href="<?php echo base_url('Dashboard/User/MainLogin'); ?>"   style="  background-image: linear-gradient(40deg, #28BCFD 20%, #1D78FF 51%, #28BCFD 90%)!important;
                border: 0px;
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: 0.25rem;
                box-shadow: 0 0 12px 0 #1f87ff!important;
                background-size: 200% auto;
                color: #FFFFFF;
                font-weight: 700;text-align: center;display: block;">Click Here to Login</a></div>

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

    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/node-waves/waves.min.js"></script>

    <script src="<?php echo base_url('NewDashboard/') ?>assets/js/app.js"></script>
<script>
						$(document).on('blur', '#sponser_id', function () {
								check_sponser();
						})
						function check_sponser() {
								var user_id = $('#sponser_id').val();
								if (user_id != '') {
										var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
										$.get(url, function (res) {
												$('#errorMessage').html(res);
										})
								}
						}
						check_sponser();
						$(document).on('submit', '#RegisterForm', function () {
								if (confirm('Please Check All The Fields Before Submit')) {
										yourformelement.submit();
								} else {
										return false;
								}
						})
				</script>
                  <script src="<?php echo base_url('NewDashboard/');?>assets/js/particles-type1.min.js"></script>
<script src="<?php echo base_url('NewDashboard/');?>assets/js/particles.min.js"></script> 
<script src="<?php echo base_url('NewDashboard/');?>assets/js/vendors.min.js"></script>

<script>
  particlesJS("particles-js", {
  "particles": {
    "number": {
      "value": 80,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "#ffffff"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      }
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 6,
      "direction": "none",
      "random": true,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
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
        "mode": "push"
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
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true

 

});
</script>
</body>
</html>
