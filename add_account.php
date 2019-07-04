<?php
    session_start();

    //세션이 존재하지 않을 때 == 로그인이 아직 안 되어 있을 때
    if(!isset($_SESSION['userid'])) 
    {
        header ('Location: ./main.php');
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
?>
<!DOCTYPE html>
    <html>
        <head>
            <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="MinsaPayDesignSystem.css">
            <meta charset="utf-8">
            <title>Add Account</title>
        </head>
        <body>
        <h1><a href="index.php">민사페이</a></h1>
        <h3>계좌 개설하기</h3>
        <h4>행정위원회만 접속할 수 있는 페이지입니다.</h4>
        <form action = "add_account_check.php" method="POST">
            <table cellspacing="0">
              <tr>
                <th rowspan="2">아이디</th>
                <td colspan="3">학생은 학번을, 선생님일 경우 생년월일 6자리를 아이디로 입력해주세요.</td>
              </tr>
              <tr>
                <td colspan="3"><input type="number" class = "clearinput" placeholder="여기에 입력해주세요." name="id" min="160000" max="999999" required></td>
              </tr>
              <tr>
                <th rowspan="2">문화기획부<br>프리패스</th>
                <td colspan="3">
                    <label>
                        <input type="radio" checked="checked" name="freepass" id = "freepass yes" value="yes">
                        네, 문화기획부 프리패스가 있습니다.
                    </label>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                    <label>
                        <input type="radio" checked="checked" name="freepass" id = "freepass no" value="no">
                        아니요, 문화기획부 프리패스가 없습니다.
                    </label>
              </tr>
              <tr>
                <th rowspan="3">가입<br>유형</th>
                <td colspan="3">
                    <label>
                        <input type="radio" checked="checked" name="info" id="one" value="normal">
                        일반인 <p class = "smallp">잔금 0원으로 계좌가 개설됩니다.</p>
                    </label>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label>
                        <input type="radio" checked="checked" name="info" id="two"  value="senior">
                        3학년 재학생 <p class = "smallp">잔금 7,000원으로 계좌가 개설됩니다.</p>
                    </label>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                        <input type="radio" checked="checked" name="info" id="three" value="teacher">
                        선생님 <p class = "smallp">잔금 10,000원으로 계좌가 개설됩니다.</p>
                    </label>
                </td>
            </tr>
              </tr>
              <tr>
                <th rowspan="1">RFID 태그</th>
                <td colspan="3">
                    <input type="number" class = "clearinput" placeholder="카드를 인식해주세요." name="rfid", required/>
                </td>
              </tr>
            </table>
            <button type="submit" class="button1">계좌 개설하기</button>
        </form>
    </body>
    <h6>
        © 닷넷. 모든 권리 보유.
    </h6>
</html> 