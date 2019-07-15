<?php
    session_start();

    //세션이 존재하지 않을 때 == 로그인이 아직 안 되어 있을 때
    if(!isset($_SESSION['userid'])) 
    {
        header ('Location: ./login.html');
        exit();
    }
    
    //세션이 존재할 때 == 로그인이 되어 있을 때
?>
<!DOCTYPE html>
<html>
    <head>
        <script language="javascript" type="text/javascript" src="include/head.js"></script>
        <meta charset="utf-8">
        <title>민사페이</title>
    </head>
    <body>
        <script language="javascript" type="text/javascript" src="include/header.js"></script>
        <?php
            $id = $_SESSION['userid'];

            require('db.php');
            
            $check="SELECT * FROM user_info WHERE userid='$id'";
            $result=$mysqli->query($check); 
            $row=$result->fetch_array(MYSQLI_ASSOC);
            $boothname = $row['boothname'];

            echo "<h3 class = 'dataShower'>현재 부스</h3>";
            echo "<h2 class = 'dataShowerH2'>",$boothname,"</h2>";
            $isAdmin = $row['admin'];
            if($isAdmin==1)
            {
                ?>
                    <button type="button" class = "button1" onclick="location.href='add_account.php' ">계좌 개설</button>
                    <button type="button" class = "button1" onclick="location.href='charge.php' ">계좌 충전 관리</button>
                    <button type="button" class = "button1" onclick="location.href='refund.php' ">잔액 환불</button>
                <?php
            }
            else if ($isAdmin==2 || $isAdmin==3)
            {
                ?>

                 <form action = "payment_check.php" method="POST" onsubmit="return validate(this);">
                    <input type="number" placeholder = "결제할 금액을 입력해주세요. (₩)" name="price" min ="0" required>
                    <input type="number" placeholder = "RFID를 태그해주세요." name="rfid" required>
                    <div class="button">
                        <button type="submit" class="button1" >결제하기</button>
                    </div>
                </form>

                <h3 class = 'dataShower'>결제 기록</h3>
                <table class = "BalanceRecordTable">
                    <thead>
                    <tr>
                    <th>번호</th>
                    <th>시간</th>
                    <th>구매</th>
                    <th>금액</th>
                    </tr>
                    </thead>
                    <?php
                        $result  = mysqli_query($mysqli,"SELECT * FROM transaction_list  WHERE booth='$boothname';");
                        $number=0;
                        echo("<tbody>");
                        while($newrow = mysqli_fetch_array( $result ) )
                        {
                            $number++;
                            $time = $newrow['timestamp'];
                            $who =  $newrow['who'];
                            $price =  $newrow['price'];
                            echo "<tr>";
                            echo "<td>".$number."</td>";
                            echo "<td>".$time."</td>";
                            echo "<td>".$who."</td>";
                            echo "<td>".number_format($price)."원</td>";
                            echo "</tr>";
                        }
                        echo("</tbody>");
                    ?>
                </table>
                <?php
            }
            else
            {
                echo "<h3>권한이 없습니다. 관리자에게 문의하세요.</h3>";
            }
        ?>
        <br>
        <button type="button" class = "button2" onclick="location.href='logout.php' ">로그아웃</button>
        <script language="javascript" type="text/javascript" src="include/footer.js"></script>
    </body> 
</html>
