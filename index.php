<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
	        <title>MinsaPay</title>
        </head>
        <body>
            <h1><a href="index.php">MinsaPay</a></h1>

            <form method="POST" action="balance_check.php">
                잔액 및 거래기록 확인:
                <br>
                <input type="number" name="studentid" value="Student ID number">
                <input type="submit" value="학번을 입력하세요">
            </form>
            <br> <br><br><br><br> <br><br><br>
            <button type="button" onclick="location.href='main.php' ">Authorized User Only (로그인 필요)</button>

        </body> 
        <hr>
        <blockquote>
            Copyright 2019. Dotnet. all rights reserved
        </blockquote>
    </html>