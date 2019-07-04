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
                    <button type="button" class = "button1" onclick="location.href='refund.php' ">잔액 환불</button>
                <?php
            }
            else
            {
                ?>
                 <form action = "payment_check.php" method="POST">
                    <input type="number" placeholder = "결제할 금액을 입력해주세요 (₩)" name="price" min ="0" required>
                    <input type="number" placeholder = "학생증 RFID를 찍어주세요" name="rfid" required>
                    <div class="button">
                        <button type="submit" class="button1">결제하기</button>
                    </div>
                </form>
                <?php
            }
        ?>
        <br>
        <button type="button" class = "button2" onclick="location.href='logout.php' ">로그아웃</button>
    </body> 
    <h6>
        © 닷넷. 모든 권리 보유.
    </h6>
</html>