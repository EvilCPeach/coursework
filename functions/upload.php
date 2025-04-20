<?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      require_once '../config/link.php';
      $image = $_FILES['avatar']['tmp_name'];
      // if($_FILES['avatar']['size'] > 2000000){
      //    echo 'больше 2мб';
      // }
      // else{
      //    echo 'меньше 2мб';
      // }
      $imageData = file_get_contents($image);
      $insertAvatar = $link->prepare(" INSERT INTO `users`(`avatar-user`) 
         VALUES (:avatar) ");
      $insertAvatar->bindParam(":avatar", $imageData);
      $resultInsert = $insertAvatar->execute();
      if($resultInsert){
         echo "Аватар успешно загружен";
         $insertAvatar = null;
         $link = null;
      }
      else{
         echo "Ошибка при загрузки аватара";
      }
      header('location: ../index.php');
      exit();
  }
?>