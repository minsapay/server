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
            <meta charset="utf-8">
	        <title>Add Account</title>
        </head>
        <body>
            <h1><a href="index.php">MinsaPay</a></h1>
            <h3>Add account (행정위 전용 페이지)</h3>
    <form action = "add_account_check.php" method="POST">
        다음을 순서대로 입력
        <div>
            <label for="id"> 학번 입력 (선생님일 경우 주민번호 앞 6자리) </label>
            <input type="number" name="id" min="160000" max="999999">
        </div>
        <div>
            <label for="freepass"> 문기부 FREEPASS? </label>
            <input type="checkbox" name="freepass" value="yes"/>
        </div>
        <div>
            <label for="balance"> 초기 충전 금액 </label>
            <input type="number" name="balance"/>
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