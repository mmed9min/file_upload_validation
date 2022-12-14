<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "<h1><center>File is an image </center></h1>" ;

    $uploadOk = 1;
  } else {
    echo "<br><h1><center>File is not an image.</center></h1>";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "<br><h1><center>Sorry, file already exists.</center></h1>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "<br><h1><center>Sorry, your file is too large.</center></h1>";
  $uploadOk = 0;
}

//Allow certain file formats
if($imageFileType != "jpg" ) {
  echo "<br><h1><center>Sorry, only JPG is allowed.</center></h1>";
  $uploadOk = 0;
}

if (substr_count($_FILES["fileToUpload"]["name"], '.') > 1){
    echo "<br><h1><center>Double extension</center></h1>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "<br><h1><center>Sorry, your file was not uploaded.</center></h1>";



// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "<br><h1><center>The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.</center></h1>";
  } else {
    echo "<br><h1><center>Sorry, there was an error uploading your file.</center></h1>";
  }
}
?>