<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

// 검색어 가져오기
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// SQL 쿼리 작성 - qna_title에서 검색어를 기준으로 검색
$sql = "SELECT q.qna_no, q.qna_title, u.user_name as author, q.qna_date, q.qna_content
        FROM QNA q 
        JOIN USER u ON q.user_no = u.user_no";

if (!empty($searchTerm)) {
    $sql .= " WHERE q.qna_title LIKE '%$searchTerm%'";
}

$sql .= " ORDER BY q.qna_date DESC";
$result = $conn->query($sql);

$qnas = array();
while($row = $result->fetch_assoc()) {
    $qnas[] = $row;
}

echo json_encode($qnas);

$conn->close();
?>
