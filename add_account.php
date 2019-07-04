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

    //일반 부스 운영자가 들어왔을 때: 자기 위치로 이동
    if(!$isAdmin)
    {
        header ('Location: ./main.php');
    }

    // 행정위 직원이 들어왔을 때(정상적인 상황)
?>
<!DOCTYPE html>
    <html>
        <head>
            <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="MinsaPayDesignSystem.css">
            <meta charset="utf-8">
            <title>Add Account</title>
        </head>
        <body>
            <h1><a href="index.php">MinsaPay</a></h1>
            <h3>Add account (행정위 전용 페이지)</h3>
    <form action = "add_account_check.php" method="POST">
        다음을 순서대로 입력
        <div style="border:1px solid; padding:10px;">
            <label for="id"> 학번 입력 (선생님일 경우 주민번호 앞 6자리) </label>
            <input type="number" name="id" min="160000" max="999999" required>
        </div>
        <div style="border:1px solid; padding:10px;">
            <label for="freepass"> 문기부 FREEPASS? </label>
            <input type="checkbox" name="freepass" value="yes"/>
        </div>
        <div style="border:1px solid; padding:10px;">
            <input type="radio" name="info" value="normal" required>일반인 (0원)
            <input type="radio" name="info" value="senior">3학년 (7000원 기본 충전)
            <input type="radio" name="info" value="teacher">선생님 (10000원 기본 충전)
        </div>
        
        <div style="border:1px solid; padding:10px;">
            <label for="rfid"> RFID 등록 (리더기로 찍기) </label>
            <input type="number" name="rfid", required/>
        </div>
        <div class="button">
            <input type="submit" value="submit">
        </div>
    </form>
</body>
<hr>
<blockquote>
    Copyright 2019. Dotnet. all rights reserved
</blockquote>
</html> 