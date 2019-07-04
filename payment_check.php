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

    //행정위 관리자가 들어왔을 때: 자기 위치로 이동
    if($isAdmin)
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
        $money=$row2['balance'];
        $total = $money + $amount;
        ?>
        <script>
        var con_test = confirm("<?php echo $idnum," 계좌에 ",$amount,"원 만큼 충전하겠습니까?"?>.");
        if(con_test == false){
            location.href="charge.php";
        }
        </script>
        <?php

        $charge=mysqli_query($mysqli,"UPDATE account_info SET balance='$total' WHERE rfid='$rfid'");
        if($charge)
        {
            echo $idnum," 계좌에 ",$amount,"원 만큼 충전하여 현재 잔액은 ",$total,"원입니다";
            echo "<br><button onclick=\"location.href='main.php'\"> 돌아가기 </button>";
        }
        else
            echo "<br><button onclick=\"location.href='main.php'\"> 충전 실패, 돌아가기 </button>";
    }
    else
    {
        echo "등록되지 않은 학생증입니다.";
        echo "<br><button onclick=\"location.href='main.php'\"> 돌아가기 </button>";
        exit();
    }

?>