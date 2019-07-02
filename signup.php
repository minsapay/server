<?php
    include "../password.php";
    
    $id=$_POST['id'];
    $pw=$_POST['pw'];
    $pwc=$_POST['pwc'];
    $booth=$_POST['booth'];
    $userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
    
    if($pw!=$pwc) 
    {
        echo "비밀번호와 비밀번호 확인이 다릅니다.";
        echo "<button onclick=\"location.href='signUp.html'\"> 돌아가기 </button>";
        exit();
    }
    if($id==NULL || $pw==NULL || $booth==NULL)
    {
        echo "빈 칸을 모두 채워주세요";
        echo "<button onclick=\"location.href='signUp.html'\"> 돌아가기 </button>";
        exit();
    }
    
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $mysqli=mysqli_connect($server, $username, $password, $db);
    
    $check="SELECT *from user_info WHERE userid='$id'";
    $result=$mysqli->query($check);
    if($result->num_rows==1)
    {
        echo "중복된 id입니다.";
        echo "<button onclick=\"location.href='signUp.html'\"> 돌아가기 </button>";
        exit();
    }

    $signup=mysqli_query($mysqli,"INSERT INTO user_info (userid,userpw,boothname) VALUES ('$id','$userpw','$booth')");
    if($signup)
    {
        ?>
        <meta charset="utf-8" />
        <script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
        <meta http-equiv="refresh" content="0 url=/">
        <?php
    }
    else
        echo "<button onclick=\"location.href='signUp.html'\"> 회원가입 실패, 돌아가기 </button>";
    
?>
