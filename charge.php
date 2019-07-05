<?php
    session_start();

    //세션이 존재하지 않을 때 == 로그인이 아직 안 되어 있을 때
    if(!isset($_SESSION['userid'])) 
    {
        header ('Location: ./main.php');
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
    if($isAdmin != 1)
    {
        header ('Location: ./main.php');
    }
    else
    {
?>
<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" type="text/css" href="MinsaPayDesignSystem.css">
            <meta charset="utf-8">
	        <title>민사 페이 계좌 충전</title>
        </head>
        <body>
            <h1><a href="index.php">민사페이</a></h1>
            <h3>계좌 충전 · 행정위원회</h3>
    <form action = "charge_check.php" method="POST">
        <div>
            <label for="amount"> 충전할 금액 (원) </label>
            <input type="number" name="amount" min="0" required>
        </div>
        <div>
            <label for="rfid"> RFID (리더기로 찍기) </label>
            <input type="number" name="rfid" required>
        </div>

        <div class="button">
            <input type="submit" value="충전하기">
        </div>
    </form>
</body>
<hr>
    <h6>
        © 닷넷. 모든 권리 보유.
    </h6>
</html> 
<?php
}
?>