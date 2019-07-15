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

                require('db.php');
                $id = clean($_POST["studentid"]);
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
                echo "<table><tr><th><h3 class = 'dataShower'>계좌 번호</h3></th></tr>";
                echo "<tr><th><h2 class = 'dataShowerH2'>", $id, "</h2></th></tr>";
                echo "<tr><th><h3 class = 'dataShower'>잔액</h3></th></tr>";
                echo "<tr><th><h2 class = 'dataShowerH2'>", number_format($balance), "원</h2></th></tr>";
                if($row[freepass]) {
                    echo "<tr><th><h3 class = 'dataShower'>문화기획부 Freepass</h3></th></tr>";
                    echo "<tr><th><h2 class = 'dataShowerH2' style = 'color: green'>Active</h2></th></tr>";
                }
                echo "</table>";
                ?>
                <h3 class = 'dataShower'>계좌 기록</h3>
                <table class = "BalanceRecordTable">
                    <thead>
                    <tr>
                    <th>번호</th>
                    <th>시간</th>
                    <th>부스 이름</th>
                    <th>분류</th>
                    <th>잔액</th>
                    </tr>
                    </thead>
                    <?php
                        $result  = mysqli_query($mysqli,"SELECT * FROM transaction_list  WHERE who='$id';");
                        $number=0;
                        echo("<tbody>");
                        while($newrow = mysqli_fetch_array( $result ) )
                        {
                            $number++;
                            $time = $newrow['timestamp'];
                            $booth =  $newrow['booth'];
                            switch($newrow['what'])
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
                                default:
                                $what = "오류";
                            }
                            $balance =  $newrow['balance'];
                            echo "<tr>";
                            echo "<td>".$number."</td>";
                            echo "<td>".$time."</td>";
                            echo "<td>".$booth."</td>";
                            echo "<td>".$what."</td>";
                            echo "<td>".number_format($balance)."원</td>";
                            echo "</tr>";
                        }
                        echo("</tbody>");
                    ?>
                </table>
            <script language="javascript" type="text/javascript" src="include/footer.js"></script>
        </body>
    </html>