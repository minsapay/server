<?php
    session_start();

    //세션이 존재하지 않을 때 == 로그인이 아직 안 되어 있을 때
    if(!isset($_SESSION['userid'])) 
    {
        header ('Location: ./login.html');
    }
    //세션이 존재할 때 == 로그인이 되어 있을 때
    $id = $_SESSION['userid'];

    require('db.php');
    
    $check="SELECT * FROM user_info WHERE userid='$id'";
    $result=$mysqli->query($check); 
    $row=$result->fetch_array(MYSQLI_ASSOC);
    $boothname = $row['boothname'];
    $isAdmin = $row['admin'];

    //행정위 운영자가 들어왔을 때: 자기 위치로 이동
    if($isAdmin)
    {
        header ('Location: ./main.php');
    }
    //부스 운영자가 들어왔을 때
 ?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="MinsaPayDesignSystem.css">
        <meta charset="utf-8">
        <title>부스 관리</title>
    </head>
    <body>
        <h1><a href="index.php">민사페이</a></h1>
        <h3>부스 관리 페이지</h3>
        <?php
            echo "<h4> 현재 로그인 된 부스</h4>";
            echo "<h3>",$boothname, "</h3>";
            echo "<br>";
        