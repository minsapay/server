<!DOCTYPE html>
    <html>
    <head>
        <script language="javascript" type="text/javascript" src="include/head.js"></script>
        <meta charset="utf-8">
        <title>민사페이 결제 확인</title>
    </head>
</html>

<?php
    session_start();

    //세션이 존재하지 않을 때 == 로그인이 아직 안 되어 있을 때
    if(!isset($_SESSION['userid'])) 
    {
        header ('Location: ./main.php');
        exit();
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
        exit();
    }
    else
    {
        $price=$_POST['price'];
        $rfid = $_POST['rfid'];
        ?>
        <script type="text/javascript">
         var con_test = confirm("<?php echo $price;?>원을 결제하겠습니까?");
        if(con_test == false){
        <?php
        echo "<br><button class = \"button2\" onclick=\"location.href='main.php'\"> 돌아가기 </button>";
        exit();
        ?>
        }
        </script>
        <?php
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
            $money=$row2['balance'];
    
            if($isAdmin == 3 && $row2['freepass'] == 1) // 프리패스 대상자가 문기부에서 결재
            {
                $date = date("m/d h:i:s",strtotime ("+9 hours"));
                $price = 0;
                $trans = mysqli_query($mysqli, "INSERT INTO transaction_list (who,booth,what,balance, timestamp,price) VALUES ('$idnum','$boothname',2,'$money','$date',0)");
                if($trans)
                {
                    echo "문기부 프리패스가 적용되어<br> ", $idnum," 계좌에서 ",$price,"원 만큼 결제되었습니다.";
                    echo "<br><button class = \"button2\" onclick=\"location.href='main.php'\"> 돌아가기 </button>";
                    exit();
                }
                else
                {
                        echo "결제에 실패했습니다.";
                        echo "<br><button class = \"button2\" onclick=\"location.href='main.php'\"> 돌아가기 </button>";
                        exit();
                }
            }
            else // 문기부에서 결재 안할때
            {
                $total = $money - $price;
                if($total<0) // 잔액 없을 때
                {
                    echo "잔액이 부족합니다.";
                    echo "<br><button class = \"button2\" onclick=\"location.href='main.php'\"> 돌아가기 </button>";
                    exit();
                }
                else // 잔액 충분할 때
                {
                    $date = date("m/d h:i:s",strtotime ("+9 hours"));
                    $query = "UPDATE account_info SET balance='$total' WHERE rfid='$rfid'; ";
                    $query .= "INSERT INTO transaction_list (who,booth,what,balance, timestamp,price) VALUES ('$idnum','$boothname',2,'$total','$date','$price')";
            
                    if (mysqli_multi_query($mysqli, $query))
                    {
                        echo $idnum," 계좌에서 ",$price,"원 만큼 결제되었습니다.";
                        echo "<br><button class = \"button2\" onclick=\"location.href='main.php'\"> 돌아가기 </button>";
                        exit();
                    }
                    else
                    {
                        echo "결제에 실패했습니다.";
                        echo "<br><button class = \"button2\" onclick=\"location.href='main.php'\"> 돌아가기 </button>";
                        exit();
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
    }

?>