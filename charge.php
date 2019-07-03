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
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
	        <title>Charge</title>
        </head>
        <body>
            <h1><a href="index.php">MinsaPay</a></h1>
            <h3>계좌 충전 (행정위 전용 페이지)</h3>
    <form action = "add_account_check.php" method="POST">
        <div>
            <label for="amount"> 충전할 금액 (원) </label>
            <input type="number" name="amount">
        </div>
        <div>
            <label for="rfid"> RFID 등록 (리더기로 찍기) </label>
            <input type="number" name="rfid"/>
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