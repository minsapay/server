<!DOCTYPE html>
    <html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="MinsaPayDesignSystem.css">
        <meta charset="utf-8">
        <title>민사페이</title>
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

    //무권한/행정위 관리자가 들어왔을 때: 자기 위치로 이동
    if($isAdmin == 0 || $isAdmin == 1)
    {
        header ('Location: ./main.php');
    }

    $price=$_POST['price'];
    $rfid = $_POST['rfid'];
    //먼저 해당 rfid가 가입되어 있는지 검사
    $check="SELECT *from account_info WHERE rfid='$rfid'";
    $result=$mysqli->query($check);
    if($result->num_rows==1)
    {
        //한 개 계정이 검출
        $current="SELECT * FROM account_info WHERE rfid='$rfid'";
        $result2=$mysqli->query($current); 
        $row2=$result2->fetch_array(MYSQLI_ASSOC);
        $idnum = $row2['idnumber'];

        if($isAdmin == 3 && $row2['freepass'] == 1) // 프리패스 대상자가 문기부에서 결재
        {
            $price = 0;
            echo "문기부 프리패스 ", $idnum," 계좌에서 ",$price,"원 만큼 결제되었습니다.";
            echo "<br><button class = \"button2\" onclick=\"location.href='main.php'\"> 돌아가기 </button>";
        }
        else // 문기부에서 결재 안할때
        {
            $money=$row2['balance'];
            $total = $money - $price;
            if($total<0) // 잔액 없을 때
            {
                echo "잔액이 부족합니다.";
                echo "<br><button class = \"button2\" onclick=\"location.href='main.php'\"> 돌아가기 </button>";
            }
            else // 잔액 충분할 때
            {
                $charge=mysqli_query($mysqli,"UPDATE account_info SET balance='$total' WHERE rfid='$rfid'");
                if($charge)
                {
                    echo $idnum," 계좌에서 ",$price,"원 만큼 결제되었습니다.";
                    echo "<br><button class = \"button2\" onclick=\"location.href='main.php'\"> 돌아가기 </button>";
                }
                else
                {
                    echo "결제에 실패했습니다.";
                    echo "<br><button class = \"button2\" onclick=\"location.href='main.php'\"> 돌아가기 </button>";
                }
            }
        }
    }
    else //계좌가 검색되지 않을 때
    {
        echo "등록되지 않은 학생증입니다.";
        echo "<br><button class = \"button2\" onclick=\"location.href='main.php'\"> 돌아가기 </button>";
        exit();
    }

?>