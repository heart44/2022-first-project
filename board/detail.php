<?php
    include_once '../db/db_board.php';
    
    session_start();
    if(isset($_SESSION["login_user"])) {
        $login_user = $_SESSION["login_user"];
    }
    $b_id = $_GET["b_id"];
    $param = [
        "b_id" => $b_id,
    ];

    $item = sel_board($param);
    $next_board = sel_next_board($param);
    $prev_board = sel_prev_board($param);
    $count = count_board($param);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/detail.css">
    <title><?=$item["b_title"]?></title>
</head>
<body>
    <div><a class="post" href="index.php">← 게시판</a></div>
    <div class="button">
        <?php if($prev_board !== 0) { ?>
            <a href="detail.php?b_id=<?=$prev_board?>"><button class="p_n">이전</button></a>
        <?php } ?>

        <?php if($next_board !== 0) { ?>
            <a href="detail.php?b_id=<?=$next_board?>"><button class="p_n">다음</button></a>
        <?php } ?>
    </div>
    <hr>
    <table>
        <tr>
            <td width=30>제목</td>
            <td width=100><?=$item["b_title"]?></td>
        <tr>
            <td width=30>작성자</td>
            <td width=100><?=$item["u_nick"]?></td>
        </tr>
        <tr>
            <td width=30>작성날짜</td>
            <td width=100><?=$item["b_date"]?></td>
        </tr>
        <tr>
            <td width=30>내용</td>
            <td width=100><?=$item["b_ctnt"]?></td>
        </tr>
        <tr>
            <td width=30>조회수</td>
            <td width=100><?=$item["b_count"]?></td>
        </tr>
    </table>

    <?php if(isset($_SESSION["login_user"]) && $login_user["u_id"] === $item["u_id"]) { ?>
        <div>
            <a href="mod.php?b_id=<?=$b_id?>"><button class="btn">수정</button></a>
            <button class="btn" onclick="isDel();">삭제</button>
        </div>
    <?php } ?>
    <script>
        function isDel() {
            console.log('isDel worked!');
            if(confirm('정말로 지우시겠습니까?')) {
                location.href = "del.php?b_id=<?=$b_id?>";
            }
        }
    </script>
</body>
</html>