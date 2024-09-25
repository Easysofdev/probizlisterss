<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['files'])) {
        $errors = [];
        $path = 'images/ads/';
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];

        $all_files = count($_FILES['files']['tmp_name']);

        for ($i = 0; $i < $all_files; $i++) {
            $file_name = $_FILES['files']['name'][$i];
            $file_tmp = $_FILES['files']['tmp_name'][$i];
            $file_type = $_FILES['files']['type'][$i];
            $file_size = $_FILES['files']['size'][$i];
            $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$i])));

            $file = $path . $file_name;

            if (!in_array($file_ext, $extensions)) {
                $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
            }

            if (empty($errors)) {
                move_uploaded_file($file_tmp, $file);
            }
        }

        if ($errors) print_r($errors);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Upload Files</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
<style>
label {
  background-color: #FFCC00;
  color: #000;
  font-family: sans-serif;
  font-size:24px;
  border-radius: 0.3rem;
  cursor: pointer;
  display: inline-block;
  margin:5px;
  padding:20px;
}
#showImage{vertical-align:middle;}
#showImage img{border-radius:20px; margin:5px; }
</style>

</head>

<body>
    <form method="post" enctype="multipart/form-data">
      <input type="file" id="ad_img" name="files[]" onclick="showImageb()" onchange="showImage()" multiple  hidden/>
	  <label for="ad_img" class="ad_img_label"><i class="fas fa-plus"></i></label><span class="images" id="showImage"></span>
      <input type="submit" value="Upload File" name="submit" />
    </form>

<script>
const url = 'upload.php';
const form = document.querySelector('form');
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
    $('#showImage').append("<img class='img' src='"+URL.createObjectURL(event.target.files[i])+"' height='70px' width='70px' />");
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
  </body>
</html>