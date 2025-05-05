<?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      require_once '../config/link.php';
      if (!file_exists('../uploads')) {
          mkdir('../uploads', 0777, true);
      }
      $originalFilename = 'original_' . time() . '.jpg';
      $processedFilename = 'processed_' . time() . '.jpg';
      move_uploaded_file($_FILES['userRoom']['tmp_name'], '../uploads/' . $originalFilename);
      $room = imagecreatefromjpeg('../uploads/' . $originalFilename);
      $userChoice = $_POST['furniture'];
      switch($userChoice) {
          case 'chair':
              $furniture = imagecreatefrompng('../images/объедоккресло.png');
              break;
          case 'table':
              $furniture = imagecreatefrompng('../images/объедокстол.png');
              break;
      }
      imagecopy($room, $furniture, 100, 200, 0, 0, imagesx($furniture), imagesy($furniture));
      imagejpeg($room, '../uploads/' . $processedFilename);
      imagedestroy($room);
      header('Content-Type: application/json');
      echo json_encode([
          'success' => true,
          'originalUrl' => './uploads/' . $originalFilename,
          'processedUrl' => './uploads/' . $processedFilename
      ]);
      exit();
  }
?>
