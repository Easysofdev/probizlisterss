<?php require_once('inc/db_conn.php'); ?>
<?php require 'inc/top-header-home.php'; ?>
<script>
function getAd(c) {
  if (c == "") {
    return false;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	   if (xmlhttp.readyState == 1){
		document.getElementById("d_ad").innerHTML = "<br /><img src='images/progress-bar.gif' style='width:95%; max-width:350px; border-radius:10px;' />";
	  }
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("d_ad").innerHTML = this.responseText;
		document.getElementById("d_ad").focus();
      }
    };
    xmlhttp.open("GET","inc/ajax_general_processor.php?c="+c+"&origin=home_ad_by_cat",true);
    xmlhttp.send();
  }
}
</script>

<?php require 'inc/main-side-menu.php'; ?>

<div class="main-body" style="background-color:rgba(0,153,0,0.3); padding:0 0 50px;">
<div style="margin:auto; width:90%; text-align:left;">
<div style="margin:0; width:100%; line-height:1.5em;">
<div class="pol_top_hd"><img src="images/probiz-logo.svg" /></div>
<div class="bbox">
<span class="bbox_hd">About Us</span>
<div class="bb_text">
ProBizList is a business and professional listing and classified ads website to make it easy for
people to project themselves and get whatever things they want easily anywhere. We are ready
to let your business and profession look professional online.
</div>
</div>

</div></div>
<div class="row" style="margin:40px 0 0;">
<div class="ad-contact-btn btm"><a href="https://probizlist.com/businesses/ProBizList-8.php"><button class="offer-btn">Contact Us</button></a></div>
</div>
</div><!-- Mainbody end DIV -->

<?php require 'inc/footer.php'; ?>
</body>
</html>