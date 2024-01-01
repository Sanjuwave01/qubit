<!doctype html>
<html lang="en">

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
    <link
      rel="apple-touch-icon"
      href="images/ico/apple-icon-120.png"
    />
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="images/ico/favicon.ico"
    />
    <!--Google Fonts-->
    <link
      href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,500,700"
      rel="stylesheet"
    />
    <link rel="stylesheet"  href="<?php echo base_url('DashboardOur/') ?>assets/fonts/Facon.ttf" />
    <!--Font icons-->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">        <!-- BEGIN VENDOR CSS-->
    <link
      rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"    />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('DashboardOur/') ?>assets/css/themify-style.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('DashboardOur/') ?>assets/css/flag-icon.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.6.2/animate.min.css" integrity="sha512-HamjnVxTT+zKHJE1w1T2EDHSVvUlFwKgj71I65H73uirwaaAc7gJqfh2jXvGdzTgXvggQzWx5rjRIX6Uf3YCBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url('DashboardOur/') ?>assets/css/flipclock.min.css" integrity="sha512-mVGq8839CGwEny4qxCTdXWnfLhviAYLE5IG5d0swMNqwoWuC8jetxQoivyLEsS2MzmH0Yyuh5TzvRGRAPmPeNg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/css/swiper.min.css"
      integrity="sha512-dPVdKDXZvfK3D65R2xqeeT1RQtxXFbdvTrSE/E6xaLRuK2yR22DACk/AGIIajRi1BDgsxDm6U1dd/E1gDaxBcg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- END VENDOR CSS-->
    <link
      rel="stylesheet"
      type="text/css"
      href="<?php echo base_url('DashboardOur/') ?>assets/css/demo.min.css"
    />
    <!-- END CRYPTO CSS-->
    <!-- BEGIN Page Level CSS-->
    <link
      rel="stylesheet"
      type="text/css"
      href="<?php echo base_url('DashboardOur/') ?>assets/css/template-counter.min.css"
    />
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link
      rel="stylesheet"
      type="text/css"
      href="css/style.css"
    />
    <link rel="stylesheet" href="<?php echo base_url('DashboardOur/') ?>assets/css/custom.css">
    <!-- END Custom CSS-->
  

    </head>
    <style>
    @media only screen and (max-width: 360px) {
		.nm-tm-wr {
			margin: 0 15px;
			
		}
		
	}
                </style>
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
          <circle
            cx="256"
            cy="256"
            r="150"
            fill="none"
            stroke="url(#loaderLinearColors)"
          />
        </g>
        <g>
          <circle
            cx="256"
            cy="256"
            r="125"
            fill="none"
            stroke="url(#loaderLinearColors)"
          />
        </g>
        <g>
          <circle
            cx="256"
            cy="256"
            r="100"
            fill="none"
            stroke="url(#loaderLinearColors)"
          />
        </g>
        <g>
          <circle
            cx="256"
            cy="256"
            r="75"
            fill="none"
            stroke="url(#loaderLinearColors)"
          />
        </g>
        <circle
          cx="256"
          cy="256"
          r="60"
          fill="url(#loaderImage)"
          stroke="none"
          stroke-width="0"
        />

        <!-- Change the preloader logo here -->
        <defs>
          <pattern
            id="loaderImage"
            height="100%"
            width="100%"
            patternContentUnits="objectBoundingBox"
          >
            <image
              href="images/logo.png"
              preserveAspectRatio="none"
              width="1"
              height="1"
            ></image>
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


	<main id="page-content" class="d-flex nm-aic nm-vh-md-100" style="position: relative; padding-top: 20px;">
		<div class="overlay"></div>

		<div class="nm-tm-wr">
			<div class="container">
			 <?php echo form_open(base_url('Dashboard/User/forgot_password/')); ?>
                <p style="color:red;text-align: center;"><?php echo $this->session->flashdata('message'); ?></p>
				<form>
					<div class="nm-hr nm-up-rl-3">
						<h2>Recover Password</h2>
						<p class="text-white"> You will receive an email to reset your Password</p>
					</div>
					
					<div class="input-group nm-gp">
						<span class="nm-gp-pp"><i class="fas fa-envelope"></i></span>
						<input id="SiteURL" type='text' name='email' maxlength='50' class="form-control" placeholder="Enter Email"/>
					</div>
				
					<div class="row nm-aic nm-mb-1">
						<div class="col-sm-6 nm-mb-1 nm-mb-sm-0">
							<button type="submit"  id="signupBtn" class="btn btn-lg btn-gradient-orange btn-round btn-glow">Recover</button>
						</div>
					</div>

					<footer style="text-align: center; margin-top: 2rem; font-size: 0.75rem; color: #97a4af; font-weight: 400;">Back to <a class="nm-fs-1 nm-fw-bd" style="font-size: 0.75rem;" href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">Login</a></footer>
				</form>
				<?php echo form_close(); ?>
			</div>
		</div>
	</main>


<!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url('DashboardOur/') ?>assets/js/vendor.min.js"></script>
    <script src="<?php echo base_url('DashboardOur/') ?>assetsjs/mouse.js"></script>
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
