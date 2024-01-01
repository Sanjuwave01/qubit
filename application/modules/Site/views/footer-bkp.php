
<style>
	@media screen and (max-width: 550px){
                .flex-set{
                    flex-direction: column !important;
                }
          
			   li.nav-item.animated.ml-4 {
					margin-left: 0 !important;
				}
				form.form-inline.mt-2.ml-4.mt-md-0 {
					margin-left: 0 !important;
				}
	}
		   
		   
	 @media screen and (max-width: 768px){
				.social-buttons {
					width: 100% !important;
					justify-content: center !important;
					display: flex !important;
				}
			}
		   
</style>

 <footer
      class="footer static-bottom footer-dark footer-custom-class"
      data-midnight="white"
    >
      <div class="container">
        <div class="footer-wrapper mx-auto text-center">
          <!-- surya <div
            class="footer-title mb-5 animated"
            data-animation="fadeInUpShorter"
            data-animation-delay="0.2s"
          >
            Stay updated with us
          </div>
          <form
            action="#"
            method="post"
            class="subscribe mb-3 animated"
            data-animation="fadeInUpShorter"
            data-animation-delay="0.3s"
            accept-charset="utf-8"
          >
            <input
              type="text"
              name="subscribe"
              class="subscribe-text"
              placeholder="Enter your email address"
            />
            <button
              type="submit"
              class="btn btn-gradient-orange btn-glow rounded-circle subscribe-btn"
            >
              <i class="ti-angle-right"></i>
            </button>
          </form>
          <p
            class="subscribe-desc mb-4 animated"
            data-animation="fadeInUpShorter"
            data-animation-delay="0.4s"
          >
            Subscribe now and be the first to find about our latest products!
          </p> -->
          <!-- surya <ul class="social-buttons list-unstyled mb-5" style="display: flex;
              justify-content: center;">
            <li
              class="animated"
              data-animation="fadeInUpShorter"
              data-animation-delay="0.5s"
            >
              <a
                href="https://www.facebook.com/profile.php?id=100090027950943"
                title="Facebook"
                class="btn btn-outline-facebook rounded-circle"
                ><i class="fa fa-facebook" aria-hidden="true"></i></a>
            </li>
            <li
              class="animated"
              data-animation="fadeInUpShorter"
              data-animation-delay="0.5s"
            >
              <a
                href="https://www.instagram.com/ricaverse/"
                title="Instagram"
                class="btn btn-outline-facebook rounded-circle"
                ><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </li>

            <li
              class="animated"
              data-animation="fadeInUpShorter"
              data-animation-delay="0.6s"
            >
              <a
                href="https://twitter.com/VerseRica"
                title="Twitter"
                class="btn btn-outline-twitter rounded-circle"
                ><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </li>
                      <li
              class="animated"
              data-animation="fadeInUpShorter"
              data-animation-delay="0.8s"
            >
              <a
                href="https://www.youtube.com/channel/UCuOLNYzwmml5zF1a9qX17Sg"
                title="Youtube"
                class="btn btn-outline-github rounded-circle"
                ><i class="fa fa-youtube" aria-hidden="true"></i></a>
            </li>
            <li
              class="animated"
              data-animation="fadeInUpShorter"
              data-animation-delay="0.9s"
            >
              <a
                href="https://t.me/thericaverseofficial"
                title="Telegram"
                class="btn btn-outline-pinterest rounded-circle"
                ><i class="fa fa-telegram" aria-hidden="true"></i></a>
            </li>
          </ul> -->
		  
              <!-- <ul class="navbar-nav mt-1 flex-set" style="flex-direction: row; justify-content: center;">
                <li
                  class="nav-item animated ml-4"
                  data-animation="fadeInDown"
                  data-animation-delay="1.1s"
                >
                  <a class="nav-link" href="index.html#about">Ricaverse</a>
                </li>
                <li
                  class="nav-item animated ml-4"
                  data-animation="fadeInDown"
                  data-animation-delay="1.2s"
                >
                  <a class="nav-link" href="index.html#problem-solution"
                    >Solutions</a
                  >
                </li>
                <li
                  class="nav-item animated  ml-4"
                  data-animation="fadeInDown"
                  data-animation-delay="1.3s"
                >
                  <a class="nav-link" href="index.html#whitepaper"
                    >Whitepaper</a
                  >
                </li>
                <li
                  class="nav-item animated  ml-4"
                  data-animation="fadeInDown"
                  data-animation-delay="1.4s"
                >
                  <a class="nav-link" href="index.html#roadmap">Roadmap</a>
                </li>
                <li
                  class="nav-item animated  ml-4"
                  data-animation="fadeInDown"
                  data-animation-delay="1.5s"
                >
                  <a class="nav-link" href="index.html#faq">FAQ</a>
                </li>
                <li
                  class="nav-item animated  ml-4"
                  data-animation="fadeInDown"
                  data-animation-delay="1.5s"
                >
                  <a class="nav-link" href="contact.html">Contact</a>
                </li>
                
              </ul> -->
              <span id="slide-line"></span>
              <form class="form-inline mt-2 ml-4 mt-md-0" style="display: flex;
    justify-content: center;
    margin-bottom: 10px; margin-top: 10px !important;">
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
                  >{{trans('admin.sign_in')}}</a
                >
              </form>
            
         <span
            class="copyright animated"
            data-animation="fadeInUpShorter"
            data-animation-delay="1.0s"
            <strong>Copyright @2022. Ricaverse All rights reserved</span>
        </div>
      </div>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url('DashboardOur/') ?>assets/js/vendor.min.js"></script>
    <script src="<?php echo base_url('DashboardOur/') ?>assets/js/mouse.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?php echo base_url('DashboardOur/') ?>assets/js/flipclock.js"></script>    
    <script src="<?php echo base_url('DashboardOur/') ?>assets/theme-assets/vendors/waypoints/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url('DashboardOur/') ?>assets/js/swiper-bundle.min.js"></script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME JS-->
    <script src="<?php echo base_url('DashboardOur/') ?>assets/js/theme.min.js"></script>
    <!-- BEGIN PAGE LEVEL JS-->
    <script>
      var swiper = new Swiper('.swiper-roadmap-7', {
          pagination: {
              el: ".swiper-pagination",
              clickable: true,
            },

          breakpoints: {
              0: {
                  slidesPerView: 1,
                  spaceBetween: 30,
              },
              768: {
                  slidesPerView: 2,
                  spaceBetween: 30,
              },
              1024: {
                  slidesPerView: 7,
                  spaceBetween: 30,
              },

          }

      });
    </script>
    <!-- END PAGE LEVEL JS-->
  </body>
</html>
