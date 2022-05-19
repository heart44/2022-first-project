<?php
    include_once "../db/db_user.php";

    $u_nick= $_POST["u_nick"];
    $u_pw= $_POST["u_pw"];

    // echo "u_nick : ", $u_nick, "<br>";
    // echo "u_pw : ", $u_pw, "<br>";

    $param= [
        "u_nick" => $u_nick
    ];

    $result= sel_user($param);
    if(!$result) { ?>
        <script>
            alert ("닉네임을 확인해주세요.") ;
            history.back();
        </script>
    <?php exit; } 
    
    if($result["u_pw"]===$u_pw) {
        session_start();
        $_SESSION["login_user"]= $result; 
        header("Location: ../main/main.php");
    } else { ?>
        <script>
            alert("비밀번호를 확인해주세요.");
            history.back();
        </script>
    <?php } ?>
        