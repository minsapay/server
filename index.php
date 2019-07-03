<!DOCTYPE html>
    <html>
        <head>
            <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="MinsaPayDesignSystem.css">
            <meta charset="utf-8">
	        <title>민사페이</title>
        </head>
        <body>
            <h1><a href="index.php">민사페이</a></h1>
            <form method="POST" action="balance_check.php">
                <input type="number" name="studentid" placeholder = "학번을 입력해주세요" value="Student ID number"> <br>
                <input type="submit" value="잔액 확인 💵">
            </form>
            <button type="button" onclick="location.href='main.php' ">운영진 로그인</button>
        </body> 
        <hr>
        <blockquote>
            Copyright 2019. Dotnet. all rights reserved
        </blockquote>
    </html>