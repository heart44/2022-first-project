<?php
    session_start();
    $u_nick="";
    if(isset($_SESSION["login_user"])) {
        $login_user = $_SESSION['login_user'];
        $u_nick= $login_user["u_nick"];
    } else { ?>
        <script>
            alert('비회원입니다!');
            location.href= "../user/login.php";
        </script>
 <?php } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/write.css">
    <title>write</title>
</head>
<body>
    <div><a href="../board/index.php">← 게시판</a></div>
    <div><h1 class="title">글쓰기</h1></div>
    <form action="write_proc.php" method="post">
        <div><input type="text" class="box" name="b_title" placeholder="제목" autofocus></div>
        <hr color="#9ab6a6">
        <div><textarea name="b_ctnt" class="box" placeholder="내용" id="" cols="80" rows="10"></textarea></div>
        <hr color="#9ab6a6">
        <center>
            <input type="submit" class="btn" value="등록">
            <input type="reset" class="btn" value="초기화">
        </center>
    </form>
</body>
</html>