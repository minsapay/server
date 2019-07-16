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

    //일반 부스 운영자가 들어왔을 때: 자기 위치로 이동

    if($isAdmin != 1)
    {
        header ('Location: ./main.php');
        exit();
    }
    else
    {

    // 행정위 직원이 들어왔을 때(정상적인 상황)
?>
<!DOCTYPE html>
    <html>
        <head>
            <script language="javascript" type="text/javascript" src="include/head.js"></script>
            <meta charset="utf-8">
            <title>민사페이 계좌 등록</title>
        </head>
        <body>
        <script language="javascript" type="text/javascript" src="include/header.js"></script>
        <h3>계좌 개설 · 행정위원회</h3>
        <form action = "add_account_check.php" method="POST">
            <table>
                <tr>
                    <th><h3 class = 'dataShower'>아이디</h3></th>
                </tr>
                <tr>
                    <th><input type="number" placeholder="학생은 학번, 선생님은 생년월일 입력" name="id" min="160000" max="999999" required></th>
                </tr>
                <tr>
                    <th><h3 class = 'dataShower'>문화기획부 프리패스</h3></th>
                </tr>
                <tr>
                    <th>
                    <label>
                        <input type="radio" checked="checked" name="freepass" id = "freepass yes" value="yes">
                        네, 문화기획부 프리패스가 있습니다.
                    </label>
                    </th>
                </tr>
                <tr>
                    <th>
                    <label>
                        <input type="radio" checked="checked" name="freepass" id = "freepass no" value="no">
                        아니요, 문화기획부 프리패스가 없습니다.
                    </label>
                    </th>
                </tr>
                <tr>
                    <th><h3 class = 'dataShower'>가입 유형</h3></th>
                </tr>
                <tr>
                    <th>
                        <label>
                            <input type="radio" checked="checked" name="info" id="one" value="normal"> 일반인 <p class = "smallp">잔금 0원으로 계좌가 개설됩니다.</p>
                        </label>
                    </th>
                </tr>
                <tr>
                    <th>
                        <label>
                            <input type="radio"  name="info" id="two"  value="senior"> 3학년 재학생 <p class = "smallp">잔금 7,000원으로 계좌가 개설됩니다.</p>
                        </label>
                    </th>
                </tr>
                <tr>
                    <th>
                        <label>
                            <input type="radio"  name="info" id="three" value="teacher"> 선생님 <p class = "smallp">잔금 10,000원으로 계좌가 개설됩니다.</p>
                        </label>
                    </th>
                </tr>
                <tr>
                    <th><h3 class = 'dataShower'>RFID 태그</h3></th>
                </tr>
                <tr>
                    <th><input type="number" placeholder="RFID를 태그해주세요." name="rfid", required/></th>
                </tr>
            </table>
            <button type="submit" class="button1">계좌 개설</button>
        </form>
        <script language="javascript" type="text/javascript" src="include/footer.js"></script>
    </body>
</html> 
<?php
}
?>