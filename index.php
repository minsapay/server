<!DOCTYPE html>

<?php
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $conn = new mysqli($server, $username, $password, $db);
    echo "<h3>This is a php embbeded title</h3>";
?>

    <html>
        <head>
	        <title>제목</title>
        </head>
    <body>
        <h1>This is a Title</h1>
        <h2>This is a second title</h2>
        <h3>This is a third title</h3>
    </body>
</html>