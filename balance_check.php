<!DOCTYPE html>
    <html>
        <head>
            <script language="javascript" type="text/javascript" src="include/head.js"></script>
            <meta charset="utf-8">
	        <title>민사페이 계좌 잔액 확인</title>
        </head>
        <body>
            <script language="javascript" type="text/javascript" src="include/header.js"></script>
            <?php
                $id = $_POST["studentid"];
                require('db.php');
                $check="SELECT * FROM account_info WHERE idnumber='$id' OR rfid='$id'";
                $result=$mysqli->query($check); 
                $row=$result->fetch_array(MYSQLI_ASSOC);
                if($result->num_rows==0)
                {
                    echo "등록되지 않은 계좌입니다.";
                }
                else
                {
                    $balance = $row['balance'];
                    echo "당신의 잔액은 ";
                    echo "<h4>", $balance, "원</h4>";
                    echo"입니다.";
                }
            ?>
            <script language="javascript" type="text/javascript" src="include/footer.js"></script>
        </body>
    </html>