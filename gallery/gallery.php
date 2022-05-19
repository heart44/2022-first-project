<?php
    include_once '../db/db_board.php';

    $loc_id = $_GET['loc_id'];
    $param = [
        "loc_id" => $loc_id,
    ];
    $g_result = sel_gallery($param);
    $result_rs = mysqli_fetch_assoc($g_result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/gallery_3.css">
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $result_rs['loc_nm'] ?> 미술관</title>
    <style>
        .gallery_nm2 {
            padding-top: 25px;
        }

        .gallery_intro img {
            padding-bottom: 25px;
        }
    </style>
</head>

<body>
    <?php include_once "../main/header_1.php" ?>
    <div class="container">
        <div class="aside">
            <aside class="left">
                <h4>LOCATION</h4>
                <ul>
                    <!-- $rs는 category.php에 있는데 cascading 된듯 -->
                    <!-- header-1.php가 아마 모든 파일에 include 돼서 변수 이름 똑같이 하면 에러터질수도 있음 -->
                    <?php foreach ($rs as $item) { ?>
                        <li><a href='../gallery/gallery.php?loc_id=<?= $item['loc_id'] ?>'><?= $item['loc_nm'] ?></a></li>
                    <?php } ?>
                </ul>
            </aside>
        </div>
        <div class="contents">
            <table class="gallery">
                <?php foreach($g_result as $list) { ?> 
                    <tr>
                        <td rowspan="2" class="gallery_pic"><a href="#"><img src="../images//gallery/<?= $list['gal_img'] ?>"></a></td>
                        <td class="gallery_nm2"><a href="../show/current_show.php?gal_id=<?= $list['gal_id'] ?>"><?= $list['gal_nm'] ?></a></td>
                    </tr>
                    <tr>
                        <td class="gallery_intro"><img src="../images/gallery/<?= $list['gal_intro'] ?>"></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <?php include_once "../main/footer.php" ?>
</body>

</html>