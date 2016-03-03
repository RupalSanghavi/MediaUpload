<!DOCTYPE html>
<?php
$servername = "localhost";
$username = "root";
$password = "yourpassword";
$dbname = "databaseimage";
?>
<html>
    <head>
        <title>Upload an Image</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action='MediaUpload.php' method="POST" enctype="multipart/form-data">
          File:
          <input type="file" name="image"><input type="submit" name="Upload">
        <form>
        <?php
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          if(isset($_FILES['image'])){
            $file=  $_FILES['image']['tmp_name'];
          }
          if(!isset($file))
            echo "Please select an image.";
          else {
            if(isset($_FILES['image'])){
              $image= (file_get_contents($_FILES['image']['tmp_name']));
              $image_name = ($_FILES['image']['name']);
              $image_size = getimagesize($_FILES['image']['tmp_name']); 

              if($image_size == FALSE)
                echo "Thats not an image.";
              else{
                $sql = "INSERT INTO store VALUES('','image_name','$image')";
                echo "File uploaded into the database.";
              }
            }
          }
         ?>
    </body>
</html>
