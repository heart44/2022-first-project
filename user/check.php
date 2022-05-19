<?php
include_once "../db/db_user.php";

$u_nick= $_GET["u_nick"];
$param= [
    "u_nick" => $u_nick
];

$result= sel_user($param);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/join.css">
    <title>ID 중복 검사</title>
</head>
<body>
    <h3>ID 중복 검사</h3>
    <div class="check">
    <?php if(!$result) { ?>
        <div class="check_nm"><span style="color: blue"><b style="color: red;"><?= $u_nick ?></b></span> 는 사용 가능한 아이디 입니다.</div>
    <div><input type="button" class="check_btn" value="이 nick 사용" onclick="opener.location.href ='javascript: decide()';  window.close();"></div>
    <?php } else { ?>
        <div class="check_nm"><span style="color: red"><b style="color: red;"><?= $u_nick ?></b></span> 는 중복된 아이디 입니다.</div>
        <div><input type="button" class="check_btn" value="다른 nick 사용" onclick="opener.location.href ='javascript: change()'; window.close()"></div>
    <?php } ?>            
    </div>
</body>
</html>
