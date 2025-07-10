<?php
require '../connect.php';

header('Content-Type: application/json');

try {
    if (!isset($_GET['course_id'])) {
        throw new Exception('course_id is required');
    }

    $course_id = $_GET['course_id'];

    $stmt = $pdo->prepare("SELECT * FROM questions WHERE course_id = ?");
    $stmt->execute([$course_id]);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($questions as &$q) {
        $stmt = $pdo->prepare("SELECT id, answer_text FROM answers WHERE question_id = ?");
        $stmt->execute([$q['id']]);
        $q['answers'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($questions);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
