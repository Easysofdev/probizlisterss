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

<div class="main-body" style="background-color:rgba(0,153,0,0.3);">
<div style="margin:auto; width:90%; text-align:left;">
<div style="margin:0; width:100%; line-height:1.5em;">

<div class="pol_top_hd">FAQ</div>
<ol><div class="pol_hd"><li>Question: Is it FREE to be on ProBizList</li></div>
Answer: YES (To be on ProBizlist is free, to post/write review is free, to post ads is free)
<div class="pol_hd"><li>Question: Is Business and Professional Registration Free</li></div>
Answer: No (An Annual subscription plan is attached to all business and professional
registration)
<div class="pol_hd"><li>What are the benefits for register on ProBizList.</li></div>
<ol type="i"><li>ProBizList website Business and Profession account serve as you mini website</li>
<li>It advertises your products, goods and services.</li>
<li>Lead Generation.</li>
<li>To increase your brand/business visibility and impression on search.</li>
<li>To draw traffic and patronage to your business original website and location.</li>
<li>To serve as your online store, offlice.</li>
<li>To navigate you on any search related to your business or professional.</li></ol>
</ol>

</div></div>

<div class="row" style="margin:40px 0 0;">
<div class="ad-contact-btn btm"><a href="https://probizlist.com/businesses/ProBizList-8.php"><button class="offer-btn">Contact Us</button></a></div>
</div>
</div><!-- Mainbody end DIV -->

<?php require 'inc/footer.php'; ?>
</body>
</html>