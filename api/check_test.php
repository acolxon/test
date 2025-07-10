<?php
require '../connect.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$correct = 0;
$total = count($data);
$results = [];

foreach ($data as $question_id => $answer_id) {
    $stmt = $pdo->prepare("SELECT is_correct FROM answers WHERE id = ? AND question_id = ?");
    $stmt->execute([$answer_id, $question_id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    $isCorrect = ($res && $res['is_correct']) ? true : false;
    if ($isCorrect) $correct++;

    $results[] = [
        "question_id" => $question_id,
        "is_correct" => $isCorrect
    ];
}

echo json_encode([
    "correct" => $correct,
    "total" => $total,
    "results" => $results
]);
?>
