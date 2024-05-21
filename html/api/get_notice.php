<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$notice_no = $conn->real_escape_string($_GET['notice_no']);

$sql = "SELECT n.notice_title, n.notice_content, n.notice_file_path 
        FROM NOTICE n 
        WHERE n.notice_no = '$notice_no'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["error" => "Notice not found"]);
}

$conn->close();
?>
