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
                    exit();
                }
                $balance = $row['balance'];
                $id = $row['idnumber'];
                echo "당신의 잔액은 ";
                echo "<h4>", $balance, "원</h4>";
                echo"입니다.";
                if($row[freepass])
                    echo "<br><br>당신은 문기부 FREEPASS 대상자 입니다.";
            ?>
            <br><br>
            <details>
            <summary>결제 기록 보기</summary>
                <div id="myDIV">
                    <?php
                        $query  = $mysqli->_query("SELECT * FROM transaction_list ORDER BY num asc WHERE who='$id';");
                        $result = $mysqli->_fetch($query);
                        ?>
                        <thead>
                        <tr>
                        <th>시간</th>
                        <th>계좌</th>
                        <th>부스명</th>
                        <th>분류</th>
                        <th>잔액</th>
                        </tr>
                        </thead>
                        <?php
                        echo("<tbody>");
                        for($i=0; $i<sizeof($result); $i++)
                        {
                            $count++;
                            $time = $result[$i]->timestamp;
                            $who =  $result[$i]->who;
                            $booth =  $result[$i]->booth;
                            switch($result[$i]->what)
                            {
                                case 0:
                                $what = "개설";
                                break;
                                case 1:
                                $what = "충전";
                                break;
                                case 2:
                                $what = "결제";
                                break;
                                case 3:
                                $what = "반납";
                                break;
                            }
                            $balance =  $result[$i]->balance;
                            echo("<tr><td>".$time."</td><td>".$who."</td><td>".$booth."</td><td>".$what."</td><td>".$balance."</td></tr>");
                        }
                        echo("</tbody>");
                    ?>
                </div>
                    </details>
            <script language="javascript" type="text/javascript" src="include/footer.js"></script>
        </body>
    </html>