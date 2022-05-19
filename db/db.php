<?php
define("URL", "localhost");
define("USERNAME", "root");
define("PASSWORD", "1234");     // heidisql (506greendg@)
define("DB_NAME", "project_test");

function get_conn() {
    return mysqli_connect(URL, USERNAME, PASSWORD, DB_NAME);
}