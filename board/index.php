<?php
include_once "../db/db_board.php";

session_start();
$u_nick = "";

$page = 1;

if (isset($_GET["page"])) {
    $page = intval($_GET["page"]);
}

if (isset($_SESSION["login_user"])) {
    $login_user = $_SESSION["login_user"];
    $u_nick = $login_user["u_nick"];
}

$row_count = 5;
$param = [
    "row_count" => $row_count,
    "start_idx" => ($page - 1) * $row_count
];

$paging_count = sel_paging_count($param);
$list = sel_board_list($param);

if (isset($_POST['search_input_txt']) && $_POST['search_input_txt'] != "") {
    $param += [
        "search_select" => $_POST["search_select"],
        "search_input_txt" => $_POST["search_input_txt"],
    ];

    $list = search_board($param);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/index.css">
    <title>Board</title>
</head>

<body>
    <?php include_once "../main/header_1.php" ?>
    <div id="container">

       
        <main>
            <div class="top">
                <h2>게시판</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th width=100>Post ID</th>
                        <th width=300>제목</th>
                        <th width=120>작성자</th>
                        <th width=200>작성일</th>
                        <th width=70>조회수</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $item) { ?>
                        <tr>
                            <td><?= $item["b_id"] ?></td>
                            <td><a href="detail.php?b_id=<?= $item["b_id"] ?>"><?= $item["b_title"] ?></a></td>
                            <td><?= $item["u_nick"] ?></td>
                            <td><?= $item["b_date"] ?></td>
                            <td><?= $item["b_count"] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="pageSelected">
                <?php for ($i = 1; $i <= $paging_count; $i++) { ?>
                    <span class="<?= $i == $page ? "pageSelected" : "" ?>">
                        <a href="index.php?page=<?= $i ?>"><?= $i ?></a>
                    </span>
                <?php } ?>
            </div>
        </main>
        <form action="index.php" method="post">
            <div>
                <select name="search_select">
                    <option value="search_writer">NAME</option>
                    <option value="search_title">TITLE</option>
                    <option value="search_ctnt">TITLE + CONTENT</option>
                </select>
                <div>
                    <input type="text" name="search_input_txt" class="input_box">
                    <input type="submit" value="SEARCH" class="input_btn">
                </div>
            </div>
        </form>
        <?php if (isset($_SESSION['login_user'])) { ?>
            <center>
                <button class="no" onclick="location.href='../board/write.php'">글쓰기</button>
            </center>
        <?php } ?>
    </div>
    <?php include_once "../main/footer.php" ?>
</body>

</html>