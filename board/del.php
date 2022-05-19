<?php
    include_once '../db/db_board.php';

    session_start();
    $login_user = $_SESSION["login_user"];
    $b_id = $_GET["b_id"];
    $u_id = $login_user["u_id"];
    $param = [
        "b_id" => $b_id,
        "u_id" => $u_id,
    ];

    $result = del_board($param);
    if($result) {
        header("location: index.php");
    }