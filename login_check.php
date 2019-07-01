<?php
    session_start();
    $id=$_POST['id'];
    $pw=$_POST['pw'];

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $mysqli=mysqli_connect($server, $username, $password, $db);
    
    $check="SELECT * FROM user_info WHERE userid='$id'";
    $result=$mysqli->query($check); 

    if($result->num_rows==1)
    {
         //하나의 열을 배열로 가져오기
        $row=$result->fetch_array(MYSQLI_ASSOC);

         //MYSQLI_ASSOC 필드명으로 첨자 가능
        if($row['userpw']==$pw)
        {
            //로그인 성공 시 세션 변수 만들기
            $_SESSION['userid']=$id;           

            //세션 변수가 참일 때
            if(isset($_SESSION['userid'])) 
            {
                //로그인 성공 시 페이지 이동
                header('Location: ./main.php');   
            }
            else
                echo "세션 저장 실패";
        }
        else
            echo "wrong id or pw";
    }
    else
        echo "wrong id or pw";
    
?>
