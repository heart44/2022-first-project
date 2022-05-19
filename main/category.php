<?php 
    include_once '../db/db_board.php';

    $rs = sel_location();
?>

<link rel="stylesheet" href="../css/category.css">


<input type="checkbox" class="bar_check" id="bar_check">
<label class="bar_icon" for="bar_check">
    <div class="bar_sticks"></div>
</label>
<div class="menu" style="width: 300px;">
    <div>
        <ul>
            <li><a>CATEGORY</a></li>
            <?php foreach($rs as $item) { ?>
                <li><a href='../gallery/gallery.php?loc_id=<?= $item['loc_id'] ?>'><?= $item['loc_nm'] ?></a></li>
            <?php } ?>
            <li><a href='../board/index.php'>게시판</a></li>
        </ul>
    </div>
</div>