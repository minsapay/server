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
    $id=$_POST['id'];
    if (isset($_POST['freepass']) && $_POST['freepass'] == 'yes') 
        $freepass=1;
    else
        $freepass=0;
    switch($_POST['info'])
    {
        case "senior":
            $balance=7000;
            break;
        case "teacher":
            $balance=10000;
            break;
        default:
            $balance=0;
    }
    $rfid=$_POST['rfid'];
    echo $id;
    echo "<br>";
    echo $freepass;
    echo "<br>";
    echo $balance;
    echo "<br>";
    echo $rfid;
    if($id==NULL || $freepass==NULL || $balance==NULL || $rfid==NULL)
    {
        echo "빈 칸을 모두 채워주세요";
        echo "<br><button onclick=\"location.href='add_account.php'\"> 돌아가기 </button>";
        exit();
    }
    $check="SELECT *from account_info WHERE rfid='$rfid'";
    $result=$mysqli->query($check);
    if($result->num_rows==1)
    {
        echo "이미 등록된 학생증입니다.";
        echo "<br><button onclick=\"location.href='add_account.php'\"> 돌아가기 </button>";
        exit();
    }
    $signup=mysqli_query($mysqli,"INSERT INTO account_info (rfid,balance,freepass,idnumber) VALUES ('$rfid','$balance','$freepass','$id')");
    if($signup)
    {
        ?>
        <meta charset="utf-8" />
        <script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
        <meta http-equiv="refresh" content="0 url=/">
        <?php
    }
    else
        echo "<br><button onclick=\"location.href='signUp.html'\"> 회원가입 실패, 돌아가기 </button>";
    
?>