<!-- Bottom Bannner /-->
<div class="row">
<div class="col botm_banner"><h1></h1></div>
</div>

<!-- Footer /-->
<div class="row footer">
<div class="col footer-left"><a href="<?php echo $site_domain; ?>about-us.php" style="color:#fff;">About ProBizList</a><br /><a href="<?php echo $site_domain; ?>we-are-hiring.php" style="color:#fff;">We are hiring!</a></div>
<div class="col footer-right">support@probizlist.com<br />Safety Tips</div>
<div class="col footer-left"><a href="<?php echo $site_domain; ?>terms-of-use.php" style="color:#fff;">Terms & Conditions</a><br /><a href="<?php echo $site_domain; ?>privacy-policy.php" style="color:#fff;">Privacy Policy</a></div>
<div class="col footer-right"><a href="https://probizlist.com/businesses/ProBizList-8.php" style="color:#fff;">Contact Us</a><br /><a href="<?php echo $site_domain; ?>faq.php" style="color:#fff;">FAQ</a></div>
</div>
<!-- Footer2 /-->
<div class="row footer2">Powered By ProBizList &copy; <?php echo date("Y") ?></div>
</div>
<script>

function show_Pass(a) {
  var showPass = document.getElementById("showMe"+a);
  var pass = document.getElementById("password"+a);
  var eye = document.getElementById("eye"+a);
  
  // If the checkbox is checked, display the output text
  if (showPass.checked == true){
    pass.type = "text";
	eye.innerHTML = "<label for='showMe"+a+"' style='cursor:pointer;'><i class='fa fa-eye-slash'></i></label>";
  } else {
    pass.type = "password";
	eye.innerHTML = "<label for='showMe"+a+"' style='cursor:pointer;'><i class='fa fa-eye'></i></label>";
  }
}

//Mobile Menu Script
function openNav() {
 document.getElementById("myNav")
 .style.width = "100%";
}

function closeNav() {
 document.getElementById("myNav")
 .style.width = "0%";
}
</script>

<script>
//ADS IMAGES SLIDESHOW STARTS HERE
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("ad_img_Slides");
  var dots = document.getElementsByClassName("ad_img_mini");

  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" ad_img_active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " ad_img_active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
<script>
//show_modal('block','status');

function show_modal(a,b){
document.getElementById("login-box").style.display = "none";
document.getElementById("signup-box").style.display = "none";
document.getElementById("signup2-box").style.display = "none";
document.getElementById(b+"-box").style.display = a;
}
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-60d59c14b04310bb"></script>