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
                echo $id," 의 잔액은 ";
                echo "<h4>", $balance, "원</h4>";
                echo"입니다.";
                if($row[freepass])
                    echo "<br><br>당신은 문기부 FREEPASS 대상자 입니다.";
            ?>
            <br>
            <details>
                <summary>결제 내역 보기</summary>
                <table>
                    <thead>
                    <tr>
                    <th>번호</th>
                    <th>시간</th>
                    <th>부스명</th>
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
                            echo "<td>".$balance."</td>";
                            echo "</tr>";
                        }
                        echo("</tbody>");
                    ?>
                </table>
            </details>
            <script language="javascript" type="text/javascript" src="include/footer.js"></script>
        </body>
    </html>