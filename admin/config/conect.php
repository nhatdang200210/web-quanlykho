<?php
$mysqli = new mysqli("localhost", "root", "", "khodienmay_sql");

// Check connection
if ($mysqli->connect_errno) {
  echo "Lỗi kết nối MYSQL " . $mysqli->connect_error;
  exit();
}
