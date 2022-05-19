<?php
    $s_id = $_GET['s_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>
    <div><a onclick="history.go(-1);">← Back</a></div>
    <div><h3>Upload</h3></div>
    <form action="upload_proc.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="s_id" value="<?= $s_id ?>">
        <div><label>img : <input type="file" name="pic_img" accept="img/*"></label></div>
        <div><input type="submit" value="upload"></div>
    </form>
</body>
</html>