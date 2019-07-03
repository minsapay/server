<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
	        <title>Balance</title>
        </head>
        <body>
            <h1><a href="index.php">MinsaPay</a></h1>
            <?php
                $id = $_POST["studentid"];
                require('db.php');
                $check="SELECT * FROM account_info WHERE idnumber='$id'";
                $result=$mysqli->query($check); 
                $row=$result->fetch_array(MYSQLI_ASSOC);
                $balance = $row['balance'];
                echo "당신의 잔액은 ",$balance,"원입니다.";
            ?>
        </body> 
        <hr>
        <blockquote>
            Copyright 2019. Dotnet. all rights reserved
        </blockquote>
    </html>