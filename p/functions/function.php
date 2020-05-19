<?php

function upload_image($path_img)
{
    // check image extention and move location
    if(isset($_FILES['image'])){
    if($_FILES['image']['name']!="") {
     $image_name=$_FILES['image']['name']; //get image name
    $tmp_name=$_FILES['image']['tmp_name']; //temporary location
    $path=$path_img; // a new images location
    
    $allowed = array('jpeg','png','jpg');  //array to save allowed image type
    $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION)); //allowed extension
    if (in_array($ext, $allowed)) {
     if(move_uploaded_file($tmp_name,$path.$image_name)){ 
return $image_name;
     }
}
}
}
}


?>
   