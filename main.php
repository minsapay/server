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
            $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

            $server = $url["host"];
            $username = $url["user"];
            $password = $url["pass"];
            $db = substr($url["path"], 1);
        
            $mysqli=mysqli_connect($server, $username, $password, $db);
            
            $check="SELECT * FROM user_info WHERE userid='$id'";
            $result=$mysqli->query($check); 
            $row=$result->fetch_array(MYSQLI_ASSOC);
            $boothname = $row['boothname'];

            echo "<h4>{$boothname} 님 환영합니다.</h4>";
        ?>
        <br>
        <button type="button" onclick="location.href='logout.php' ">로그아웃</button>
    </body> 
    <hr>
    <blockquote>
        Copyright 2019. Dotnet. all rights reserved
    </blockquote>
</html>