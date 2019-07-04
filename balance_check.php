<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
	        <title>잔액 확인하기</title>
            <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="MinsaPayDesignSystem.css">
        </head>
        <body>
            <h1><a href="index.php">민사페이</a></h1>
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
        </body> 
    <h6>
        © 닷넷. 모든 권리 보유.
    </h6>
    </html>