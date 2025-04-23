<?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      require_once '../config/link.php';
      $room = imagecreatefromjpeg($_FILES['userRoom']['tmp_name']);
      $userChoise = $_POST['furniture'];
      switch($userChoise){
         case 'chair':
            $furniture = imagecreatefrompng('../images/объедоккресло.png');
            break;
         case 'table':
            $furniture = imagecreatefrompng('../images/объедокстол.png');
            break;
      }
      imagecopy($room, $furniture, 100, 200, 0, 0, imagesx($furniture), imagesy($furniture));
      header('Content-Type: image/jpeg');
      imagejpeg($room);
      imagedestroy($room);
      exit();
  }
?>