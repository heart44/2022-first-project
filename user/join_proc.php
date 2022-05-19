<?php
include_once "../db/db_user.php";

$u_nick= $_POST["decide_nick"];
$u_pw= $_POST["u_pw"];
$u_pw2= $_POST["u_pw2"];
$u_mail1= $_POST["u_mail1"];
$u_mail2= $_POST["u_mail2"];

$u_mail= $u_mail1."@".$u_mail2;

$param= [
    "u_nick" => $u_nick,
    "u_pw" => $u_pw,
    "u_mail" => $u_mail
];

$check= sel_user($param);
$result= ins_join($param);

if(!$check) { 
    if($u_pw !== $u_pw2) { ?>
        <script>
            alert('비밀번호가 일치하지 않습니다.'); 
            history.back();
        </script>
    <?php exit; } else {
        if($result) { ?>
            <script>
                alert('회원가입이 완료되었습니다.');
                location.replace('login.php');
                // echo ("$result");
            </script>
        <?php exit; } else { ?>
            <script>
                alert('저장에 문제가 생겼습니다. 관리자에게 문의해주세요.');
                mysqli_error($conn);
            </script>
        <?php }
    }
} ?>
