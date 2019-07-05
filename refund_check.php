<!DOCTYPE html>
    <html>
    <head>
        <script language="javascript" type="text/javascript" src="include/head.js"></script>
        <meta charset="utf-8">
        <title>민사페이 환불 확인</title>
    </head>
</html>
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
        $rfid = $_POST["rfid"];
        $check="SELECT * FROM account_info WHERE rfid='$rfid'";
        $result=$mysqli->query($check); 
        $row=$result->fetch_array(MYSQLI_ASSOC);

        if($result->num_rows==0)
        {
            echo "등록되지 않은 계좌입니다.";
            echo "<br><button class = \"button2\" onclick=\"location.href='main.php'\"> 돌아가기 </button>";
        }
        else
        {
            $balance = $row['balance'];
            $charge=mysqli_query($mysqli,"UPDATE account_info SET balance='0' WHERE rfid='$rfid'");
            if($charge)
            {
                echo $idnum," 계좌에 남은 잔액 ", $balance, "원은 전부 환불 처리되었습니다.";
                echo "<br><button class = \"button2\" onclick=\"location.href='main.php'\"> 돌아가기 </button>";
            }
            else
            {
                echo "환불에 실패했습니다.";
                echo "<br><button class = \"button2\" onclick=\"location.href='main.php'\"> 돌아가기 </button>";
            }
        }
    }
?>