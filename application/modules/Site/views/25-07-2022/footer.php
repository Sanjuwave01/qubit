     
        <!--footer Start-->   
        <footer class="footer-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 footer-box-1">
                        <div class="footer-logo">
                            <a href="https://coinpool.sacredthemes.net/cp-mercury.html#" title=""><img src="<?php echo base_url('');?>uploads/logo.png" alt="Cp Silver"></a>
                        </div>
                        <p><?php echo title;?> blockchain technology removes the need for legacy middlemen, resulting in reduced settlement time and cost savings for issuance as well as other processes.</p>
                    </div>
                    <div class="col-md-3 footer-box-2">
                        <ul class="footer-menu onepage">
                            <li><a href="#about">About Us</a></li>
                            <li><a href="#mission">Mission</a></li>
                            <li><a href="#token">Token</a></li>
                            <li><a href="#roadmap">Roadmap</a></li>
                            <li><a href="#team">Team</a></li>
                            <li><a href="#press">Media</a></li>
                        </ul>
                    </div>
                    <div class="col-md-5 footer-box-3">
                        <h4>Newsletter</h4>
                        <p>Keep up to date with our progress. Subscribe for e-mail updates.</p>
                        <div class="newsletter">
                            <form>
                                <div class="input"><input type="email" name="Email" placeholder="Your email address"></div>
                                <div class="submit"><input class="btn" type="submit" name="subscribe" value="subscribe"></div>
                            </form>
                        </div>
                        <div class="socials">
                            <ul>
                                <li><a href="https://facebook.com/"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://plus.google.com/"><i class="fa fa-google-plus-g"></i></a></li>
                                <li><a href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="copyrights style-1">
                            © 2022 Ricaverse 
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--footer end--> 
    </div>
    <!--Main Wrapper End-->
 
    <script src="<?php echo base_url('Newsite/');?>js/jquery.min.js"></script>
    <script src="<?php echo base_url('Newsite/');?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('Newsite/');?>js/onpagescroll.js"></script>
    <script src="<?php echo base_url('Newsite/');?>js/wow.min.js"></script>
    <script src="<?php echo base_url('Newsite/');?>js/jquery.countdown.js"></script>
    <script src="<?php echo base_url('Newsite/');?>js/owl.carousel.js"></script>
    <script src="<?php echo base_url('Newsite/');?>js/script.js"></script>
    <script type="text/javascript">
        function isScrolledIntoView(elem) {
            var docViewTop = jQuery(window).scrollTop();
            var docViewBottom = docViewTop + jQuery(window).height();
            var elemTop = jQuery(elem).offset().top;
            var elemBottom = elemTop + jQuery(elem).height();
            return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        }
        jQuery(window).scroll(function () {
            jQuery('.about-mercury-animation').each(function () {
                if (isScrolledIntoView(this) === true) {
                    jQuery(this).addClass('visible');
                }
            });
            jQuery('.token-pricing-section').each(function () {
                if (isScrolledIntoView(this) === true) {
                    jQuery(this).addClass('visible');
                }
            });
        });
        jQuery(document).ready(function () {
            jQuery('.allocation-list-point li:first-child').addClass('hover');
            jQuery('.allocation-list-point li .point').hover(function(){
                jQuery('.allocation-list-point li').removeClass('hover');
                jQuery(this).parent('li').addClass('hover');
            });
        });
    </script>

</body></html>