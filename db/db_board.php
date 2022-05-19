<?php
include_once "db.php";

// index.php (paging)
function sel_paging_count(&$param)
{
   $row_count = $param["row_count"];
   $sql = "SELECT CEIL(COUNT(b_id) / $row_count) as cnt
            FROM board_t";

   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);
   $row = mysqli_fetch_assoc($result);
   return $row["cnt"];
}

// index.php
function sel_board_list(&$param)
{
   $start_idx = $param['start_idx'];
   $row_count = $param['row_count'];
   $sql =
      "   SELECT B.b_id, B.b_title, B.b_ctnt, B.b_date, B.b_count
             , U.u_nick
          FROM board_t B
         INNER JOIN user_t U
            ON B.u_id = U.u_id
         ORDER BY B.b_id DESC
         LIMIT $start_idx, $row_count
    ";
   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);
   return $result;
}

// upload_proc
function ins_img(&$param)
{
   $s_id = $param["s_id"];
   $target_filenm = $param["pic_img"];
   $pic_img = $param["pic_img"] == '' ? "NULL" : "'$target_filenm'";

   $sql =
      "  INSERT INTO picture_t
      (s_id, pic_img)
      VALUES
      ('$s_id', $pic_img)
   ";

   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);
   return $result;
}

// write_proc.php
function ins_board(&$param)
{
   $b_title = $param["b_title"];
   $b_ctnt = $param["b_ctnt"];
   $u_id = $param["u_id"];

   $sql = "INSERT INTO board_t (b_title, b_ctnt, u_id)
           VALUES ('$b_title', '$b_ctnt', '$u_id')
          ";

   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);
   return $result;
}

// detail.php
function sel_board(&$param)
{
   $b_id = $param["b_id"];
   $sql = "SELECT B.b_title, B.b_ctnt, B.b_date, B.b_count
                , U.u_id, U.u_nick
             FROM board_t B
            INNER JOIN user_t U
               ON B.u_id = U.u_id
            WHERE B.b_id = ${b_id}";
   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);
   return mysqli_fetch_assoc($result);
}

// detail.php (next ctnt)
function sel_next_board(&$param)
{
   $b_id = $param["b_id"];
   $sql = "SELECT b_id
             FROM board_t
            WHERE b_id > $b_id
            ORDER BY b_id
            LIMIT 1";

   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);
   $row = mysqli_fetch_assoc($result);
   if ($row) {
      return $row["b_id"];
   }
   return 0;
}

// detail.php (previous ctnt)
function sel_prev_board(&$param)
{
   $b_id = $param["b_id"];
   $sql = "SELECT b_id
             FROM board_t
            WHERE b_id < $b_id
            ORDER BY b_id DESC
            LIMIT 1";

   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);
   $row = mysqli_fetch_assoc($result);
   if ($row) {
      return $row["b_id"];
   }
   return 0;
}

// index / detail.php (조회수)
function count_board(&$param)
{
   $conn = get_conn();
   $b_id = $param["b_id"];

   $sql = "UPDATE board_t
              SET b_count = b_count + 1
            WHERE b_id = ${b_id}";

   $result = mysqli_query($conn, $sql);
   return $result;
   mysqli_close($conn);
}

// mod_proc.php
function upd_board(&$param)
{
   $b_id = $param["b_id"];
   $b_title = $param["b_title"];
   $b_ctnt = $param["b_ctnt"];
   $u_id = $param["u_id"];

   $sql = "UPDATE board_t
              SET b_title = '$b_title'
                , b_ctnt = '$b_ctnt'
            WHERE b_id = $b_id
              AND u_id = $u_id";

   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);
   return $result;
}

// del.php
function del_board(&$param)
{
   $b_id = $param["b_id"];
   $u_id = $param["u_id"];

   $sql = "DELETE FROM board_t
            WHERE b_id = $b_id
              AND u_id = $u_id";

   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);
   return $result;
}

// index.php (search)
function search_board(&$param)
{
   $conn = get_conn();

   $search_select = $param["search_select"];
   $search_input_txt = $param["search_input_txt"];
   $textArray = explode(" ", $search_input_txt);

   $where = [];
   $sql = "SELECT B.b_id, B.b_title, B.b_ctnt, B.b_date, B.b_count
                , U.u_id, U.u_nick
             FROM board_t B
            INNER JOIN user_t U
               ON B.u_id = U.u_id
            WHERE ";

   switch ($search_select) {
      case "search_writer":
         $where += ["U.u_nick"];
         break;
      case "search_title":
         $where += ["B.b_title"];
         break;
      case "search_ctnt":
         $where += ["B.b_title", "B.b_ctnt"];
         break;
      default:
   }

   for ($i = 0; $i < count($textArray); $i++) {
      for ($j = 0; $j < count($where); $j++) {
         $sql = $sql . " $where[$j] LIKE '%$textArray[$i]%' ";

         if (($i !== count($textArray) - 1) || ($j !== count($where) - 1)) {
            $sql = $sql . "OR";
         }
      }
   }

   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);
   return $result;
}

//current, past select
function sel_show(&$param)
{
   $gal_id = $param['gal_id'];
   $page = $param['page'];

   //현재면 > 지난이면 < 
   if ($page == "current_show.php") {
      $inequality = ">";
   } else {
      $inequality = "<";
   }

   $conn = get_conn();
   $sql = " SELECT S.*, G.gal_nm FROM show_t S
            INNER JOIN gallery_t G
            ON S.gal_id = G.gal_id
            WHERE S.gal_id = $gal_id and s_e_date $inequality now()";

   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);

   return $result;
}

//갤러리 데이터
function sel_gallery(&$param)
{
   $loc_id = $param['loc_id'];

   $conn = get_conn();
   $sql = " SELECT G.*, L.loc_nm FROM gallery_t G
            INNER JOIN local_t L
            ON L.loc_id = G.loc_id
            WHERE G.loc_id = $loc_id";

   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);

   return $result;
}

//지역 데이터
function sel_location()
{
   $conn = get_conn();
   $sql = " SELECT * FROM local_t ";

   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);

   return $result;
}

function sel_detail(&$param)
{
   $s_id = $param['s_id'];

   $sql =
      "SELECT S.*, G.gal_id , G.gal_nm
    FROM show_t S
    INNER JOIN gallery_t G
    ON S.gal_id = G.gal_id
    WHERE S.s_id = '$s_id'
   ";
   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);
   return mysqli_fetch_assoc($result);
}


function sel_show_list($param)
{
   $s_id = $param['s_id'];

   $sql =
      "SELECT S.s_id, S.gal_id, S.s_nm, S.s_s_date, S.s_e_date, S.s_post, P.pic_img
    FROM show_t S
    INNER JOIN picture_t P
    ON S.s_id = P.s_id
    WHERE S.s_id = '$s_id'
   ";
   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);
   return $result;
}

function ins_ctnt(&$param)
{
   $s_id = $param['s_id'];
   $ctnt = $param['ctnt'];

   $sql = " UPDATE show_t 
            SET s_ctnt = '$ctnt'
            WHERE s_id = $s_id ";

   $conn = get_conn();
   $result = mysqli_query($conn, $sql);
   mysqli_close($conn);
   if ($result) {
      return $result;
   } else {
      echo "실패";
   }
}
