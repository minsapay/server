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
                    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
                    <link rel="stylesheet" type="text/css" href="MinsaPayDesignSystem.css">
                    <meta charset="utf-8">
                    <title>민사페이</title>
                </head>
                <body>
                    <h1><a href="index.php">민사페이</a></h1>
                    <h3>잔액 환불 (행정위 전용 페이지)</h3>
                    <form method="POST" id="refund" action="refund_check.php" autocomplete="off" >
                        <input type="number" name="rfid" placeholder = "RFID를 입력해주세요" value="RFID number"> <br>
                    </form>
                    <button type="submit" class = "button1" form="refund" value="잔액 환불">잔액 환불</button>
                </body> 
            <h6>
                © 닷넷. 모든 권리 보유.
            </h6>
            </html>
        <?php
    }
?>