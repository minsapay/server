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
        <h2>(Authorized User Only)</h2>

        contents..... differs by user

        <br>
        <button type="button" onclick="location.href='logout.php' ">로그아웃</button>
    </body> 
    <hr>
    <blockquote>
        Copyright 2019. Dotnet. all rights reserved
    </blockquote>
</html>