<?php


echo "<b>File to be uploaded: </b>" . $_FILES["uploadfile"]["name"] . "<br>";
echo "<b>Type: </b>" . $_FILES["uploadfile"]["type"] . "<br>";
echo "<b>File Size: </b>" . $_FILES["uploadfile"]["size"] / 1024 . "<br>";
echo "<b>Store in: </b>" . $_FILES["uploadfile"]["tmp_name"] . "<br>";



if (file_exists($_FILES['uploadfile']['name'])) {
    echo "<h3>The file already exists</h3>";
} else {
    move_uploaded_file($_FILES['uploadfile']['tmp_name'], $_FILES['uploadfile']['name']);
    echo "<h3>File Successfully Uploaded</h3>";
}


