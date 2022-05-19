<?php
    $s_id = $_GET['s_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="text_proc.php" method="POST">
        <input type="hidden" name="s_id" value="<?= $s_id ?>">
        <textarea name="ctnt"></textarea>
        <input type="submit" value="등록">
    </form>
</body>
</html>