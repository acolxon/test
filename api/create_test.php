<?php
require '../connect.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$pdo->beginTransaction();
$stmt = $pdo->prepare("INSERT INTO questions (course_id, question_text) VALUES (?, ?)");
$stmt->execute([$data['course_id'], $data['question']]);
$question_id = $pdo->lastInsertId();

$stmt = $pdo->prepare("INSERT INTO answers (question_id, answer_text, is_correct) VALUES (?, ?, ?)");
foreach ($data['answers'] as $answer) {
  $stmt->execute([$question_id, $answer['text'], $answer['is_correct'] ? 1 : 0]);
}

$pdo->commit();
echo json_encode(["status" => "ok"]);
?>