<?php
    include_once '../db/db_board.php';

    session_start();
    $b_title = $_POST["b_title"];
    $b_ctnt = $_POST["b_ctnt"];
    $login_user = $_SESSION["login_user"];
    $u_id = $login_user["u_id"];

    $param = [
        "b_title" => $b_title,
        "b_ctnt" => $b_ctnt,
        "u_id" => $u_id
    ];

    $result = ins_board($param);
    if($result) {
        header("location: index.php");
    }