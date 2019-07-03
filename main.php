<?php
    session_start();

    //세션이 존재하지 않을 때 == 로그인이 아직 안 되어 있을 때
    if(!isset($_SESSION['userid'])) 
    {
        header ('Location: ./login.html');
    }
    
    //세션이 존재할 때 == 로그인이 되어 있을 때
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="MinsaPayDesignSystem.css">
        <meta charset="utf-8">
        <title>민사페이</title>
    </head>
    <body>
        <h1><a href="index.php">민사페이</a></h1>
        <h4>각 부스 운영진 및 민족제 운영진만 접속할 수 있습니다.</h4>
        <?php
            $id = $_SESSION['userid'];

            require('db.php');
            
            $check="SELECT * FROM user_info WHERE userid='$id'";
            $result=$mysqli->query($check); 
            $row=$result->fetch_array(MYSQLI_ASSOC);
            $boothname = $row['boothname'];

            echo "<h4> 현재 로그인 된 부스</h4>";
            echo "<h3>",$boothname, "</h3>";
            echo "<br>";
            $isAdmin = $row['admin'];
            if($isAdmin)
            {
                ?>
                    <button type="button" class = "button1" onclick="location.href='add_account.php' ">사용자 계좌 추가</button>
                    <button type="button" class = "button1" onclick="location.href='charge.php' ">계좌 충전 관리</button>
                <?php
            }
            else
            {
                ?>
                    <button type="button" class = "button1" onclick="location.href='booth.php' ">부스 관리 콘솔로 이동</button>
                <?php
            }
        ?>
        <br>
        <button type="button" class = "button2" onclick="location.href='logout.php' ">로그아웃</button>
    </body> 
    <blockquote>
        Copyright 2019. Dotnet. all rights reserved
    </blockquote>
</html>