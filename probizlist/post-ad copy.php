<?php require_once('inc/db_conn.php'); ?>
<?php require_once('inc/authorizedusers.php'); ?>

<?php
	$sql_adCat = "SELECT * FROM ad_category WHERE cat_list = 'ad' ORDER BY cat_name ASC";
	$adCat = $conn->query($sql_adCat);
	
	$sql_adLoc = "SELECT * FROM ad_location ORDER BY loc_state ASC";
	$adLoc = $conn->query($sql_adLoc);
?>

 <?php require 'inc/top-header-home.php'; ?>
<script>
function showData(str) {
  var dstr = str.split("_");
  	  str = dstr[0];
	  var a = dstr[1];
  if (str == "") {
    document.getElementById("sub"+a).innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("sub"+a).innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","inc/ajax_processor.php?q="+str+"&a="+a+"&origin=postdata",true);
    xmlhttp.send();
  }
}
</script>
<?php require 'inc/user-side-menu.php'; ?>
<div class="main-body">
<div class="ad-main-body">

<div class="ad_img_sidebar">
<div class="sidebar-ad-box">
<div class="ad-desc">
Side Bar related ads here!
</div>
</div>
</div>
<!-- Ad Img Sidebar Ends //-->

<div class="row">

<?php require 'inc/user-mob-side-menu.php'; ?>

<div class="msg-box">
<div class="ad-msg-box-title">Post Your Advert Here <br /><span style="display:inline-block; padding:10px; font-size:small; color:red;"><?php if (isset($_GET['err'])){echo "<li>".$_GET['err']."</li>"; } ?></span></div>
<form method="post" name="item_insert" id="item_insert" action="<?php echo htmlspecialchars('inc/action_page.php');?>" enctype="multipart/form-data">

<?php if ($adCat->num_rows > 0) { ?>
<select name="item_cat" id="item_cat" onchange="showData(this.value)">
	<option value="" selected="selected">Advert Category</option>
<?php while($row_adCat = $adCat->fetch_assoc()) { ?>
	<option value="<?php echo htmlspecialchars($row_adCat['cat_name'])."_CAT"; ?>"><span style="text-transform:uppercase;"><?php echo $row_adCat['cat_name']; ?></span></option>
<?php } }?>
</select>
<div id="subCAT"></div>

<?php if ($adLoc->num_rows > 0) { ?>
<select name="item_state" id="item_state" onchange="showData(this.value)">
	<option value="" selected="selected">Advert Location</option>
<?php while($row_adLoc = $adLoc->fetch_assoc()) { ?>
	<option value="<?php echo $row_adLoc['loc_state']."_LOC"; ?>"><span style="text-transform:uppercase;"><?php echo $row_adLoc['loc_state']; ?></span></option>
<?php } }?>
</select>
<div id="subLOC"></div>

<input type="file" id="ad_img" name="files[]" onclick="showImageb()" onchange="showImage()" multiple  hidden/>
<span style="font-size:12px; font-weight:bold; vertical-align:middle; writing-mode: vertical-rl;">ADD IMAGE</span><label for="ad_img" class="ad_img_label"><i class="fa fa-plus"></i></label><span class="images" id="showImage"></span>

<span id="ad_details" style="width:100%;">
<input type="text" name="item_title" id="item_title" placeholder="Ad Title*" required />
<select name="item_condition" id="item_condition"/>
<option value="" selected="selected">Condition*</option>
<option value="New">Brand New</option>
<option value="Used">Used</option>
<option value="Not Applicable">Not Applicable</option>
</select>
<textarea rows="10" cols="20" name="item_desc" placeholder="Description*"></textarea>
<input type="number" name="item_price" class="price-fd" id="item_price" placeholder="Price*" required />
<label><input type="checkbox" id="item_nego" name="item_nego" value="1" /> Negotiable</label>
<input type="text" name="item_keywords" id="item_keywords" placeholder="Keywords e.g: women bag, women fashion bag" required />
<br />
</span>
<input type="hidden" name="form_type" value="item_insert" />
<input type="submit" value="POST AD" name="submit" />

</form>

</div>
</div>

<div class="row">
<div class="msg-box">
<div class="ad-desc">
Instructions for ad placement for the users goes here..
</div>
</div>
</div>

</div><!-- ad-Mainbody end DIV -->
<div class="ad-sidebar">
<div class="sidebar-ad-box">
<div class="ad-desc">
Side Bar related ads here!
</div>
</div>
</div><!-- ad-Sidebar end DIV -->

</div><!-- Mainbody end DIV -->
<script>
const url = 'inc/action_page.php';
const form = document.querySelector('form');
//const form = document.getElementById('item_insert');
const ad_img = document.getElementById('ad_img');

function showImageb(){
  var showImage = document.getElementById('showImage');
  showImage.innerHTML = "";
}

function showImage() {
  var ad_img_label = $('.ad_img_label');
  var images = $('.images');
  var total_img= document.querySelector('[type=file]').files.length;
  for(var i=0;i<total_img;i++) {
    $('#showImage').append("<img class='img' src='"+URL.createObjectURL(event.target.files[i])+"' height='60px' width='60px' />");
  }
  //images.on('click', '.img', function () {
  //      $(this).remove()
  //    })
}

form.addEventListener('submit', (e) => {
  e.preventDefault();

  const files = document.querySelector('[type=file]').files;
  const formData = new FormData();

  for (let i = 0; i < files.length; i++) {
    let file = files[i];

    formData.append('files[]', file);
  }

  fetch(url, {
    method: 'POST',
    body: formData,
  }).then((response) => {
    console.log(response);
  })
})
</script>


<?php require 'inc/footer.php'; ?>
</body>
</html>