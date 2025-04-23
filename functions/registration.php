<?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      require_once '../config/link.php';
      if($_FILES['avatar']['size'] > 2000000){
        
      }
      else{
         if($_FILES['avatar']['tmp_name'] != null){
            $image = $_FILES['avatar']['tmp_name'];
            $imageData = file_get_contents($image);
         }
         else{
            $imageData = null;
         }
         $FIO = $_POST['FIO'];
         $phone = $_POST['phone'];
         $password = $_POST['password'];
         $login = $_POST['login'];
         $dateComment = $_POST['dateComment'];
         $explodeDate = explode('-',$dateComment);
         $resultDate = implode('.', array_reverse($explodeDate));
         $regQuery = " INSERT INTO `users`
            (`full-name-user`, `phone-user`, `login-user`, `password-user`, `avatar-user`, `date-comment-user`) 
            VALUES (:FIO,:phone,:login,:password,:avatar,:dateComment) ";
         $insertUser = $link->prepare($regQuery);
         $insertUser->bindParam(":avatar", $imageData);
         $insertUser->bindParam(":FIO", $FIO);
         $insertUser->bindParam(":phone", $phone);
         $insertUser->bindParam(":password", $password);
         $insertUser->bindParam(":login", $login);
         $insertUser->bindParam(":dateComment", $resultDate);
         $resultInsert = $insertUser->execute();
      }
      if($resultInsert){
         $insertUser = null;
         $link = null;
      }
      header('location: ../index.php');
      exit();
  }
?>