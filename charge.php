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
            <script language="javascript" type="text/javascript" src="include/head.js"></script>
	        <title>민사 페이 계좌 충전</title>
        </head>
        <body>
            <script language="javascript" type="text/javascript" src="include/header.js"></script>
            <h3>계좌 충전 · 행정위원회</h3>
            <form action = "charge_check.php" method="POST">
                <div>
                    <label for="amount"><h3 class="left">충전할 금액</h3></label>
                    <input type="number" placeholder = "충전할 금액 입력하기 (₩)" name="amount" min="0" required>
                </div>
                <div>
                    <label for="rfid"><h3 class="left">RFID</h3></label>
                    <input type="number" placeholder = "RFID 인식하기" name="rfid" required>
                </div>
                <div class="button">
                <button type="submit"  value="충전하기" class = "button1">계좌 충전하기</button>
        </div>
    </form>
    <script language="javascript" type="text/javascript" src="include/footer.js"></script>
</body>
</html> 
<?php
}
?>