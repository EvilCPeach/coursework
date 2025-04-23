<?php
    require_once '../config/link.php';
    $selectUsers = " SELECT * FROM `users` ";
    $queryUsers = $link->prepare($selectUsers);
    $queryUsers->execute();
    $resultUsers = $queryUsers->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>