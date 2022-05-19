<?php
    include_once '../db/db.php';
    // db와 연결 시도 하여 connection 객체 얻어오기
    $conn = get_conn();
    //날짜 정보 가져오기
    $YY = date('Y');
    $MM = date('m');
    $DD = date('d');
    $dat = $YY . "-" . $MM . "-" . $DD;

    $sql = "SELECT * FROM board_t
             WHERE b_date = '$b_date'";
    
    $result = mysqli_query($conn, $sql);
    $list = mysqli_num_rows($result);

    if(!$list) { //아무도 들어온 적이 없어서 date 정보가 없을 경우
        $b_count = 0; // count = 0
    } else { //누군가가 들어온 적이 있어서 date 정보가 존재할 경우
        $row = mysqli_fetch_assoc($result);
        $b_count = $row['b_count']; // 현재 날짜의 count값을 가져온다
    }

    if($b_count === 0) {
        $b_count++; //오늘 날짜로 새로운 count값을 추가
        $sql = "INSERT INTO board_t
                VALUES ($b_count, '$b_date')";
    } else {
        $count++; //오늘 날짜의 기존 count값을 변경
        $sql = "UPDATE board_t
                   SET b_count = $b_count
                 WHERE b_date = '$b_date'";
    }
