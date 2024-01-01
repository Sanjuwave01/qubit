<!DOCTYPE html>
<html lang="en">
<head>
    <title>kubitcoin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet">
</head>
<body>
  <header id="site-header" class="main-header main-header-overlay">
        <div class="container">
            <div class="row align-items-center px-3">
                <div class="col-4 col-lg-3">
                    <a class="navbar-brand" href="#"><img src="<?php echo base_url()?>assets/images/kubit-Logo.png" loading="lazy" width="75" alt=""></a>
                </div>
                <div class="col-8 col-lg-9 justify-content-end module-menu">
                    <div class="navbar navbar-expand-sm justify-content-end">
                        <ul class="navbar-nav" >
                            <li class="nav-item"><a  class="nav-link" href="<?php echo base_url();?>Dashboard/User/MainLogin">Login</a></li>
                        </ul>
                        <a href="<?php echo base_url();?>Dashboard/Register" class="btn btn-outline-primary">Join Now</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
   
  
  

    <div class="">
        <div class="">
            <div class="panel panel-primary">

                <div class="">


                    <!-- <h5><?php //echo title;   
                    ?></h5> -->
                    <span class="text-danger"><?php echo $this->session->flashdata('error'); ?></span>
                    <div class="form-group has-feedback text-danger mb-2 d-none">Do you have Sponsor ID
                        <input type="radio" onclick="docload('yes')" id="yes"> Yes
                        <input type="radio" onclick="docload('no')" id="no"> No
                    </div>
                    <div id="page-content" class="d-flex nm-aic nm-vh-md-100" style="position: relative;">
                        <div class="overlay"></div>

                        <div class="nm-tm-wr">
                            <div class="container">
                                <?php echo form_open('Dashboard/Register?sponser_id=' . $sponser_id, array('id' => 'RegisterForm')); ?>
                                <form>
                                    <div class="nm-hr nm-up-rl-3">
                                        <h2>Register</h2>
                                       
                                    </div>

                                    <div class="form-group has-feedback">
                                        <!-- <label>Enter Referral Id:</label> -->
                                        <div class="input-group nm-gp">
                                            <span class="nm-gp-pp"><i class="fas fa-address-book"></i></span>
                                            <input type="text" class="form-control" id="sponser_id"
                                                placeholder="Sponser ID" value="<?php echo $sponser_id; ?>"
                                                name="sponser_id" required>
                                            <input type="hidden" id="wallet_address" name="eth_address">
                                            <span class="ion ion-locked form-control-feedback "></span>
                                            <span class="text-danger"><?php echo form_error('sponser_id'); ?></span>
                                            <span id="errorMessage" class="text-danger"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback">

                                        <div class="input-group nm-gp">
                                            <!-- <label>Enter your Full Name</label> -->
                                            <span class="nm-gp-pp"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" placeholder="Enter User Name"
                                                id="userID" onkeypress="return blockSpecialChar(event)" name="user_id"
                                                value="<?php echo set_value('user_id'); ?>" required>
                                            <span class="ion ion-locked form-control-feedback "></span>
                                        </div>
                                        <span class="text-danger"> <?php echo form_error('user_id'); ?></span>
                                    </div>

                                    <div class="form-group has-feedback">

                                        <div class="input-group nm-gp">
                                            <!-- <label>Enter your Full Name</label> -->
                                            <span class="nm-gp-pp"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                                value="<?php echo set_value('name'); ?>" required>
                                            <span class="ion ion-locked form-control-feedback "></span>
                                        </div>
                                        <span class="text-danger"> <?php echo form_error('name'); ?></span>
                                    </div>
                                    
                                    <div class="input-group nm-gp">
                                        <!-- <label>Password</label> -->
                                        <span class="nm-gp-pp"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" placeholder="Enter Password"
                                            id="password_id" name="password"
                                            value="<?php echo set_value('password'); ?>" required>
                                        <i id="eye" class="fas fa-eye-slash" style="padding-top:14px;"></i>
                                        <span class="ion ion-locked form-control-feedback "> </span>

                                    </div>
                                    <span class="text-danger"> <?php echo form_error('password'); ?></span>
                                    <div class="input-group nm-gp">
                                        <span class="nm-gp-pp"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" placeholder="Enter Email"  name="email"
                                            value="<?php echo set_value('email'); ?>" required
                                           >
                                        <span class="ion ion-locked form-control-feedback "></span>
                                    </div>
                                    <span class="text-danger"> <?php echo form_error('email'); ?></span>
                                    <!-- <div class="input-group nm-gp">
                                       <button type="button" class="btn btn-success" onclick="sendEmailOtp(this)">Get OTP</button>
                                    </div> -->

                                    <!-- <div class="input-group nm-gp">
                    <span class="nm-gp-pp"><i class="fas fa-envelope"></i></span>
                    <input type="text" class="form-control" placeholder="Enter OTP" name="otp" value="<?php // echo set_value('otp'); ?>" required>
                    <span class="ion ion-locked form-control-feedback "></span>
                  </div> -->
                  <!-- <span class="text-danger"> <?php //echo form_error('otp'); ?></span> -->

                                    <div class="input-group nm-gp">
                                        <!-- <label style="color: white;">Select your Country</label> -->
                                        <select class="form-control" name="country" id="allcountry"
                                            style="    color: #97a4af;background: #fff;">
                                            <option>--Select your Country--</option>
                                            <?php foreach ($countries as $country) : ?>
                                            <option value="<?php echo $country['name']; ?>">
                                                <?php echo $country['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="ion ion-locked form-control-feedback "></span>
                                    </div>
                                    <span class="text-danger"> <?php echo form_error('country'); ?></span>
                            </div>
                            <!-- <div class="form-group has-feedback">
                                <div class="input-group nm-gp">
                                    <div class="row">
                                        <div class="col-4">

                                            <input type="tel" placeholder="+1" class="form-control mb-0"
                                                name="phonecode" value="" required id="countryCode1" readonly="">
                                            <span class="ion ion-locked form-control-feedback "></span>

                                        </div>
                                        <div class="col-8">
                                            <input type="number" class="form-control mb-0" placeholder="Enter Mobile No"
                                                name="phone" id="phone" value="<?php echo set_value('phone'); ?>"
                                                required autocomplete="off">
                                            <span class="ion ion-locked form-control-feedback "></span>

                                        </div>
                                    </div>
                                </div>
                                <span class="ion ion-locked form-control-feedback "></span>
                                <span class="text-danger"><?php echo form_error('phone'); ?></span>
                            </div> -->
                            <label style="font-size: 14px; color: #000;">I have read and agreed to the <a href="#"
                                    class="agree"><b>Terms &amp; Conditions</b></a>
                                <input type="checkbox" name="agree" value="1" checked="checked">
                                <span class="s_checkbox"></span>
                            </label>
                            <div class="row nm-aic nm-mb-1">
                                <div class="col-sm-6 nm-mb-1 nm-mb-sm-0">
                                    <button type="submit" id="deposit" onclick="registerNow(this,'RegisterForm')"
                                        class="btn btn-lg btn-gradient-orange btn-round btn-glow">Register</button>
                                </div>
                            </div>

                            <div class="form-group has-feedback text-center mt-3">
                                <p style="color:#000;    font-size: 0.938rem;">Already have an account. <a
                                        class="signup-btn"
                                        href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">Login?</a></p>

                            </div>

                            <?php echo form_close(); ?>
                            <p style="display:none"><a href="<?php echo base_url('Site/Main/Register'); ?>">REGISTER
                                    NOW!</a></p>
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.11.6/plugins/CSSPlugin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.11.6/plugins/ScrollToPlugin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.121.1/examples/js/controls/OrbitControls.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/28963/modernizr.custom.64310.js"></script>
    <script src="<?php echo base_url()?>assets/js/custom.js"></script>

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


    function sendEmailOtp(evt) {
        var email = evt.value //document.getElementById('confirm_email').value;
        console.log(email);
        if (email != '') {
            var formData = new FormData();
            var csrf = document.getElementsByName("<?php echo $this->security->get_csrf_token_name(); ?>")[0].value;
            formData.append("<?php echo $this->security->get_csrf_token_name(); ?>", csrf);
            formData.append("email", email);
            fetch("<?php echo base_url('Dashboard/User/getMailOtp/'); ?>", {
                    method: "POST",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(result => {
                    document.getElementsByName("<?php echo $this->security->get_csrf_token_name(); ?>")[0].value =
                        result.token;
                    console.log(result)
                    if (result.success == '1') {
                        toastr.success(result.message, {
                          timeOut: 5000
                        })
                    } else {
                        toastr.error(result.message, {
                          timeOut: 5000
                        })
                    };
                });
        } else {
          toastr.error('Email is required', {
                          timeOut: 5000
                        })
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