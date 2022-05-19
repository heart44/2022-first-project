<?php
    include_once '../db/db_board.php';
    $b_id = $_GET["b_id"];
    $param = [
        "b_id" => $b_id
    ];
    $item = sel_board($param);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/write.css">
    <title>글수정</title>
</head>
<body>
    <div><a onclick="history.go(-1);">← Back</a></div>
    <div><h1 class="title">글수정</h1></div>

    <form action="mod_proc.php" method="post">
        <input type="hidden" name="b_id" value="<?=$b_id?>" readonly>
        <div><input class="box" type="text" name="b_title" placeholder="제목" value="<?=$item["b_title"]?>"></div>
        <hr color="#9ab6a6">
        <div><textarea class="box" name="b_ctnt" cols="30" rows="10" placeholder="내용"><?=$item["b_ctnt"]?></textarea></div>
        <hr color="#9ab6a6">
        <center>
            <input type="submit" value="수정" class="btn">
            <input type="reset" value="초기화" class="btn">
        </center>
    </form>
</body>
</html>