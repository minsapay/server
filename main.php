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
        <meta charset="utf-8">
        <title>MinsaPay</title>
    </head>
    <body>
        <h1><a href="index.php">MinsaPay</a></h1>
        <h4>(Authorized User Only)</h4>
        <?php
            $id = $_SESSION['userid'];

            require('db.php');
            
            $check="SELECT * FROM user_info WHERE userid='$id'";
            $result=$mysqli->query($check); 
            $row=$result->fetch_array(MYSQLI_ASSOC);
            $boothname = $row['boothname'];

            echo "<h4> 현재 로그인 된 부스: {$boothname}</h4>";
            $isAdmin = $row['admin'];
            if($isAdmin)
            {
                ?>
                    <button type="button" onclick="location.href='add_account.php' ">사용자 계좌 추가</button>
                    <button type="button" onclick="location.href='charge.php' ">계좌 충전 관리</button>
                <?php
            }
            else
            {
                ?>
                    <button type="button" onclick="location.href='booth.php' ">부스 관리 콘솔로 이동</button>
                <?php
            }
        ?>
        <br>
        <button type="button" onclick="location.href='logout.php' ">로그아웃</button>
    </body> 
    <hr>
    <blockquote>
        Copyright 2019. Dotnet. all rights reserved
    </blockquote>
</html>