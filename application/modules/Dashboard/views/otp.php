<!doctype html>
<html lang="en">

<?php // pr($user_id); die; ; 
 ?>

<head>
    <meta charset="utf-8" />
    <title><?php echo title; ?></title>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta content="<?php echo title; ?>" name="description" />
    <meta content="" name="author" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo.png') ?>">


    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="apple-touch-icon" href="images/ico/apple-icon-120.png" />
    <link rel="shortcut icon" type="image/x-icon" href="images/ico/favicon.ico" />
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,500,700" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url('DashboardOur/') ?>assets/fonts/Facon.ttf" />
    <!--Font icons-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url('DashboardOur/') ?>assets/css/themify-style.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('DashboardOur/') ?>assets/css/flag-icon.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.6.2/animate.min.css"
        integrity="sha512-HamjnVxTT+zKHJE1w1T2EDHSVvUlFwKgj71I65H73uirwaaAc7gJqfh2jXvGdzTgXvggQzWx5rjRIX6Uf3YCBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url('DashboardOur/') ?>assets/css/flipclock.min.css"
        integrity="sha512-mVGq8839CGwEny4qxCTdXWnfLhviAYLE5IG5d0swMNqwoWuC8jetxQoivyLEsS2MzmH0Yyuh5TzvRGRAPmPeNg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/css/swiper.min.css"
        integrity="sha512-dPVdKDXZvfK3D65R2xqeeT1RQtxXFbdvTrSE/E6xaLRuK2yR22DACk/AGIIajRi1BDgsxDm6U1dd/E1gDaxBcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- END VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('DashboardOur/') ?>assets/css/demo.min.css" />
    <!-- END CRYPTO CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url('DashboardOur/') ?>assets/css/template-counter.min.css" />
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/bootstrap.min.css" id="bootstrap-style"
        rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet"
        type="text/css" />
    <!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
    <link href="<?php echo base_url('NewDashboard/'); ?>assets/css/animation.css">
    <link rel="stylesheet" href="<?php echo base_url('DashboardOur/') ?>assets/css/custom.css">
    <!-- END Custom CSS-->
    <style>
    #page-content {

        min-height: 124vh !important;
    }

    select.form-control:not([size]):not([multiple]) {
        height: auto !important;
    }

    .icon-set {
        color: #fff;
        margin: 5px;
        background: #2826261f;
        padding: 10px;
        border-radius: 10px;
    }





    @media only screen and (max-width: 360px) {
        .nm-tm-wr {
            margin: 0 15px;
        }

    }
    </style>

</head>

</head>

<body>
    <!-- Preloader | Comment below code if you don't want preloader-->
    <div id="loader-wrapper">
        <svg viewbox=" 0 0 512 512" id="loader">
            <linearGradient id="loaderLinearColors" x1="0" y1="0" x2="1" y2="1">
                <stop offset="5%" stop-color="#28bcfd"></stop>
                <stop offset="100%" stop-color="#1d78ff"></stop>
            </linearGradient>
            <g>
                <circle cx="256" cy="256" r="150" fill="none" stroke="url(#loaderLinearColors)" />
            </g>
            <g>
                <circle cx="256" cy="256" r="125" fill="none" stroke="url(#loaderLinearColors)" />
            </g>
            <g>
                <circle cx="256" cy="256" r="100" fill="none" stroke="url(#loaderLinearColors)" />
            </g>
            <g>
                <circle cx="256" cy="256" r="75" fill="none" stroke="url(#loaderLinearColors)" />
            </g>
            <circle cx="256" cy="256" r="60" fill="url(#loaderImage)" stroke="none" stroke-width="0" />

            <!-- Change the preloader logo here -->
            <defs>
                <pattern id="loaderImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
                    <image href="images/logo.png" preserveAspectRatio="none" width="1" height="1"></image>
                </pattern>
            </defs>
        </svg>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!--/ Preloader -->

    <!-- MAGIC CURSOR -->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
    <!-- /MAGIC CURSOR -->
    <div class="bg-black">
        <div class="text-primary text-center">
            <a href="/" class="logo logo-admin">
                <img src="<?php echo base_url(logo) ?>"
                    style="max-width: 150px;background: #000;margin: 0;border-radius: 10px;padding: 10px;" alt="logo">
            </a>
            <h5 class="mt-3 d-none"
                style="text-transform: uppercase;background: #000;color: #fff;font-weight: bold;font-size: 25px;padding: 5px 0;">
                Welcome Back !</h5>

        </div>
    </div>
    <div class="">
        <div class="">
            <div class="panel panel-primary">
                <div class="">
                    
                    <span class="text-danger"><?php echo $this->session->flashdata('error'); ?></span>
                    
                    <div id="page-content" class="d-flex nm-aic nm-vh-md-100" style="position: relative;">
                        <div class="overlay"></div>

                        <div class="nm-tm-wr">
                            <div class="container">
                                <?php echo form_open('Dashboard/Register/veryfiedOTP', array('id' => 'RegisterForm')); ?>
                                <form>
                                    <div class="nm-hr nm-up-rl-3">
                                        <h2>OTP</h2>
                                        
                                    </div>
                                     <div class="input-group nm-gp">
                                        <span class="nm-gp-pp"><i class="fas fa-envelope"></i></span>

                                        <input type="number" required class="form-control" placeholder="Enter OTP" name="otp" value="<?php echo set_value('otp'); ?>" required>
                                        <input type="hidden" required class="form-control" name="user_id" value="<?php echo $user_id; ?>" required>

                                        <span class="ion ion-locked form-control-feedback "></span>
                                    </div> 
                                    <div class="input-group nm-gp">
                                       <button type="button" class="btn btn-success" onclick="resentOTP(<?php echo $user_id; ?>)">Resent</button>
                                    </div> 

                                    <span class="text-danger"> <?php echo form_error('otp'); ?></span> 

                                  
                            </div>
                            
                            
                            <div class="row nm-aic nm-mb-1 float-right">
                                <div class="col-sm-6 nm-mb-1 nm-mb-sm-0">
                                    <button type="submit" id="deposit" onclick="registerNow(this,'RegisterForm')"class="btn btn-lg btn-gradient-orange btn-round btn-glow" style="color: #fff;">Submit</button>
                                </div>
                            </div>

                           

                            <?php echo form_close(); ?>
                          
                        </div>
                        <div class="form-group has-feedback d-none">
                            <label>Select Position</label>
                            <div class="input-group nm-gp form-control">
                                <!-- Material inline 1 -->
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="materialInline1" name="Lposition"
                                        value="L" <?php if (!empty($_GET['position']) && $_GET['position'] == 'L') {
                                                                                                                  echo 'selected';
                                                                                                                } ?>>
                                    <label class="form-check-label" for="materialInline1">Left</label>
                                </div>

                                <!-- Material inline 2 -->
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="materialInline2" name="Lposition"
                                        value="R" <?php if (!empty($_GET['position']) && $_GET['position'] == 'R') {
                                                                                                                  echo 'selected';
                                                                                                                } ?>>
                                    <label class="form-check-label" for="materialInline2">Right</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-field d-none">
                            <label></label>
                            <input type="number" onchange="total_hub(this)" class="form-control" placeholder="$100"
                                name="package"
                                value="<?php echo empty(set_value('package')) ? '100' : set_value('package'); ?>"
                                required>
                            <span class="ion ion-locked form-control-feedback "></span>
                        </div>
                        <span class="text-danger"> <?php echo form_error('package'); ?></span>
                        <span id="total_hub" class="text-info"> </span>
                    </div>








                </div>

            </div>
        </div>

    </div>




    </div>
    <!-- <div class="home-btn d-none d-sm-block">
            <a href="index-2.html" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div> -->
    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url('DashboardOur/') ?>assets/js/vendor.min.js"></script>
    <script src="<?php echo base_url('DashboardOur/') ?>assets/js/mouse.js"></script>
    <!-- BEGIN VENDOR JS-->

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME JS-->
    <script src="<?php echo base_url('DashboardOur/') ?>assets/js/theme.min.js"></script>



    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/js/app.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
    <!-- <script src="<?php //echo base_url('SmartChain/web3.min.js'); ?>"></script>
<script src="<?php //echo base_url('SmartChain/web3modal.js'); ?>"></script>
<script src="<?php //echo base_url('SmartChain/evm-chains.js'); ?>"></script>
<script src="<?php //echo base_url('SmartChain/config.js'); ?>"></script>
<script src="<?php //echo base_url('SmartChain/index.js'); ?>"></script> -->

    <script>
    $(function() {

        $('#eye').click(function() {

            if ($(this).hasClass('fa-eye-slash')) {

                $(this).removeClass('fa-eye-slash');

                $(this).addClass('fa-eye');

                $('#password_id').attr('type', 'text');

            } else {

                $(this).removeClass('fa-eye');

                $(this).addClass('fa-eye-slash');

                $('#password_id').attr('type', 'password');
            }
        });
    });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
    $(document).on('click', '#otp', function() {
      var email = document.getElementById('email').value;
      console.log(email);
      if(email !=''){
          var url = 'https://thericaverse.net/Dashboard/secureWithdraw/verifyMailOtp/'+email;
          $.get(url, function(res) {
              if (res.status == 1) {
                  // $("#otp").css("display", "none");
                  // $("#none").css("display", "block");
                  // alert('OTP send to registered E-Mail');
                  toastr.success('OTP send to email', {
                          timeOut: 5000
                        })
              } else {
                toastr.error('Network error,please try later', {
                          timeOut: 5000
                        })
                  // alert('Network error,please try later');
              }
          }, 'JSON')
      } else {
        toastr.error('Email is required', {
                          timeOut: 5000
                        })
      }

    })

    function blockSpecialChar(e) {
        var k = e.keyCode;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || (k >= 48 && k <= 57));
    }



    $(document).on('blur', '#sponser_id', function() {
        check_sponser();
    })

    function check_sponser() {
        var user_id = $('#sponser_id').val();
        if (user_id != '') {
            var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
            $.get(url, function(res) {
                $('#errorMessage').html(res);
            })
        }
    }
    check_sponser();

    var selection = document.getElementById("allcountry");
    selection.onchange = function(event) {
        var option = '';
        var countryID = event.target.value;
        if (countryID != '') {
            var url = "<?php echo base_url('Dashboard/Register/countryCode/'); ?>" + countryID;
            fetch(url, {
                    method: "GET",
                })
                .then(response => response.json())
                .then(response => {
                    console.log(response);
                    document.getElementById('countryCode1').value = '+' + response.phonecode;
                });
        } else {
            document.getElementById('countryCode1').value = '';
        }
    };

    function docload(check) {
        if (check == 'yes') {
            var radioButton = document.getElementById("no");
            radioButton.checked = false;
            document.getElementById("sponser_id").value = '';
            $('#errorMessage').html('');
        } else if (check == 'no') {
            var radioButton = document.getElementById("yes");
            radioButton.checked = false;
            document.getElementById("sponser_id").value = 'USDT12345';
            check_sponser();
        }
    }


    function resentOTP(evt) {
        var user_id = evt //document.getElementById('confirm_email').value;
        if (user_id != '') {
            var formData = new FormData();

            var csrf = document.getElementsByName("<?php echo $this->security->get_csrf_token_name(); ?>")[0].value;

            formData.append("<?php echo $this->security->get_csrf_token_name(); ?>", csrf);
            formData.append("user_id", user_id);

            fetch("<?php echo base_url('Dashboard/Register/resentOTP'); ?>", {
                    method: "POST",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(result => {
                    console.log(result);

                    document.getElementsByName("<?php echo $this->security->get_csrf_token_name(); ?>")[0].value =
                        result.token;
                    if (result.status == '1') {
                        toastr.success('OTP has been sent on your email.', {
                          timeOut: 5000
                        })
                        location.reload();

                    } else {
                        toastr.error('oops something went wrong', {
                          timeOut: 5000
                        })
                        location.reload();

                    };
                });
        } 
    }


    function total_hub(evt) {
        const total_hub = evt.value;
        if (total_hub > 0) {

            fetch("<?php echo base_url('Admin/Settings/getHubRate/'); ?>" + total_hub, {
                    method: "GET",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    // body: formData,
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success == '1') {
                        document.getElementById('total_hub').innerHTML = 'Total Hub: ' + result.message;
                    } else {
                        document.getElementById('total_hub').innerHTML = 'Please enter vaild amount!';
                    }
                });
        } else {
            document.getElementById('total_hub').innerHTML = 'Invaild Package Amount!';
        }
    }
    </script>
    <script src="<?php echo base_url('NewDashboard/'); ?>assets/js/particles-type1.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/'); ?>assets/js/particles.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/'); ?>assets/js/vendors.min.js"></script>

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