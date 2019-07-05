<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" type="text/css" href="MinsaPayDesignSystem.css">
            <meta charset="utf-8">
	        <title>민사페이</title>
        </head>
        <body>
            <h1><a href="index.php">민사페이</a></h1>
            <form method="POST" id="Balance Check Form" action="balance_check.php"autocomplete="off" >
                <input type="number" name="studentid" placeholder = "아이디·RFID 입력" value="Student ID number"> <br>
            </form>
            <button type="submit" class = "button1" form="Balance Check Form" value="잔액 확인">잔액 확인</button>
            <button type="button" class = "button2" onclick="location.href='main.php' ">운영진 로그인</button>
        </body> 

    <h6>
        © 닷넷. 모든 권리 보유.
    </h6>
    </html>