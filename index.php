<!DOCTYPE html>
    <html>
        <head>
            <script language="javascript" type="text/javascript" src="include/head.js"></script>
            <meta charset="utf-8">
	        <title>민사페이</title>
        </head>
        <body>
            <script language="javascript" type="text/javascript" src="include/header.js"></script>
            <form method="POST" id="Balance Check Form" action="balance_check.php"autocomplete="off" >
                <input type="number" name="studentid" placeholder = "아이디 입력 · RFID 태그" value="Student ID number"> <br>
            </form>
            <button type="submit" class = "button1" form="Balance Check Form" value="잔액 확인">계좌 조회</button>
            <button type="button" class = "button2" onclick="location.href='main.php' ">운영진 로그인</button>
            <script language="javascript" type="text/javascript" src="include/footer.js"></script>
        </body> 
    </html>