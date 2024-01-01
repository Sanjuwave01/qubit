<!DOCTYPE html>
<html lang="en-US">
<head>

<meta charset="utf-8">
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<title>Ricaverse </title>
<meta name="author" content="themesflat.com">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link
      rel="apple-touch-icon"
      href="<?php echo base_url('DashboardOur/') ?>assets/images/ico/apple-icon-120.png"
    />
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="<?php echo base_url('DashboardOur/') ?>assets/images/ico/favicon.ico"
    />
    <!--Google Fonts-->
    <link
      href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,500,700"
      rel="stylesheet"
    />
    <link rel="stylesheet"  href="<?php echo base_url('DashboardOur/') ?>assets/fonts/Facon.ttf" />
    <!--Font icons-->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">        <!-- BEGIN VENDOR CSS-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('DashboardOur/') ?>assets/css/themify-style.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('DashboardOur/') ?>assets/css/flag-icon.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.6.2/animate.min.css" integrity="sha512-HamjnVxTT+zKHJE1w1T2EDHSVvUlFwKgj71I65H73uirwaaAc7gJqfh2jXvGdzTgXvggQzWx5rjRIX6Uf3YCBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.6.1/flipclock.min.css" integrity="sha512-mVGq8839CGwEny4qxCTdXWnfLhviAYLE5IG5d0swMNqwoWuC8jetxQoivyLEsS2MzmH0Yyuh5TzvRGRAPmPeNg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
      href="<?php echo base_url('DashboardOur/') ?>assets/css/style.css"
    />
    <link rel="stylesheet" href="<?php echo base_url('DashboardOur/') ?>assets/css/custom.css">
    <!-- END Custom CSS-->
  </head>
  <body
    class="1-column page-animated svg-wrapper template-counter"
    data-menu-open="hover"
    data-menu=""
  >
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
              href="<?php echo base_url('uploads/') ?>logo.png"
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

  

    <!-- surya <nav class="vertical-social">
      <ul>
        <li>
          <a href="https://t.me/thericaverseofficial"><i class="fa fa-telegram" aria-hidden="true"></i></a>
        </li>
        <li>
          <a href="https://www.facebook.com/profile.php?id=100090027950943"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        </li>
        <li>
          <a href="https://twitter.com/VerseRica"> <i class="fa fa-twitter" aria-hidden="true"></i></a>
        </li>
        <li>
          <a href="https://www.instagram.com/ricaverse/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </li>
      </ul>
    </nav> -->



    <!-- /////////////////////////////////// HEADER /////////////////////////////////////-->

    <!-- Header Start-->
    
    <header class="page-header">
      <!-- Horizontal Menu Start-->
      <nav
        class="main-menu static-top navbar-dark navbar navbar-expand-lg fixed-top mb-1"
      >
        <div class="container">
          <a
            class="navbar-brand main-logo animated"
            data-animation="fadeInDown"
            data-animation-delay="1s"
            href="https://thericaverse.net/"
            ><img
              src="<?php echo base_url('uploads/') ?>logo.png"
              alt="Crypto Logo" style="width: 70px !important;"
            /><!--<span class="brand-text crypto_green"
              >#makecrypto<span class="text-primary">green</span></span>--></a
          >
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarCollapse"
            aria-controls="navbarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <div id="navigation" class="navbar-nav ml-auto">
              <!-- <ul class="navbar-nav mt-1">
                <li
                  class="nav-item animated"
                  data-animation="fadeInDown"
                  data-animation-delay="1.1s"
                >
                  <a class="nav-link" href="about">Ricaverse</a>
                </li>
                <li
                  class="nav-item animated"
                  data-animation="fadeInDown"
                  data-animation-delay="1.2s"
                >
                  <a class="nav-link" href="#problem-solution"
                    >Solutions</a
                  >
                </li>
                <li
                  class="nav-item animated"
                  data-animation="fadeInDown"
                  data-animation-delay="1.3s"
                >
                  <a class="nav-link" href="#whitepaper"
                    >Whitepaper</a
                  >
                </li>
                <li
                  class="nav-item animated"
                  data-animation="fadeInDown"
                  data-animation-delay="1.4s"
                >
                  <a class="nav-link" href="#roadmap">Roadmap</a>
                </li>
                <li
                  class="nav-item animated"
                  data-animation="fadeInDown"
                  data-animation-delay="1.5s"
                >
                  <a class="nav-link" href="#faq">FAQ</a>
                </li>
                <li
                  class="nav-item animated"
                  data-animation="fadeInDown"
                  data-animation-delay="1.5s"
                >
                  <a class="nav-link" href="#contact">Contact</a>
                </li>
                
              </ul> -->
              <span id="slide-line"></span>
              <form class="form-inline mt-2 mt-md-0">
			        <a
                  class="btn btn-sm btn-gradient-orange btn-round btn-glow my-2 my-sm-0 animated mr-2"
                  data-animation="fadeInDown"
                  data-animation-delay="1.8s"
                  href="<?php echo base_url();?>Dashboard/Register"
                  target="_blank"
                  >{{trans('admin.sign_up')}}</a
                >
                <a
                  class="btn btn-sm btn-gradient-orange btn-round btn-glow my-2 my-sm-0 animated"
                  data-animation="fadeInDown"
                  data-animation-delay="1.8s"
                  href="<?php echo base_url();?>Dashboard/User/MainLogin"
                  target="_blank"
                  > {{trans('admin.sign_in')}}</a
                >
              </form>
            </div>
          </div>
        </div>
      </nav>
      <!-- /Horizontal Menu End-->
    </header>
    <!-- /Header End-->