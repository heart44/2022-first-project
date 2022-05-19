<?php
    include_once '../db/db_board.php';

    $gal_id = $_GET['gal_id'];                //합치면 get으로 미술관 번호 가져오기
    $page = basename($_SERVER['PHP_SELF']);          //현재 페이지 주소 가져오기(현재, 지난 확인)

    $param = [ 
        "gal_id" => $gal_id,
        "page" => $page,
    ];

    $s_list = sel_show($param);
    $s_list_cnt = mysqli_num_rows($s_list);
    $s_rs = mysqli_fetch_assoc($s_list)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/current_show.css">
    <title>현재전시 | <?= $s_rs['gal_nm'] ?></title>
</head>

<body>
    <?php include('../main/header_1.php'); ?>
    <div id="container">
        <div><a onclick="history.go(-1);">← Back</a></div>
        <div class="show_nm">
            <div><?= $s_rs['gal_nm'] ?></div>
        </div>
        <div class="show_ul">
            <ul>
                <li><a href="../show/current_show.php?gal_id=<?= $gal_id ?>">현재전시</a></li>
                <li><a href="../show/past_show.php?gal_id=<?= $gal_id ?>">지난전시</a></li>
            </ul>
        </div>
        <section class="<?= $s_list_cnt == 1 ? 'sec_1' : 'sec_2'; ?>">
            <?php foreach($s_list as $item) { ?>
                <div class="poster_grid">
                    <!-- 디테일 링크로 바꾸기 -->
                    <a href="show_detail.php?s_id=<?= $item['s_id'] ?>">
                        <img src="../images/show/<?= $item['s_post'] ?>" alt="전시1">
                    </a>
                    <div class="poster_ctnt">
                        <!-- 디테일 링크로 바꾸기 -->
                        <div><a href="show_detail.php?s_id=<?= $item['s_id'] ?>"><?= $item['s_nm'] ?></a></div>
                        <div><?= $item['s_s_date'] ?> ~ <?= $item['s_e_date'] ?></div>
                    </div>
                </div>
            <?php } ?>
        </section>
    </div>
    <?php include('../main/footer.php'); ?>
</body>

</html>