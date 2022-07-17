<?php 
    include "db.php";
    session_start();
    if(!isset($_SESSION['score'])){
		$_SESSION['score'] = 0;
	}
    if($_POST){
        $numberQuestion = $_POST['numberQuestion'];
        $numberQuiz = $_POST['numberQuiz'];
        $selected_answer = $_POST['idAnswer'];

        $_SESSION['question_id'][] = $numberQuestion;
        $_SESSION['quiz_id'] = $numberQuiz;
        $_SESSION['selected_answers'][] = $selected_answer;

        var_dump($_SESSION['question_id']);
        var_dump($_SESSION['quiz_id']);

        $next = $numberQuestion + 1;

        //Get total question
        $sql = "SELECT count(q.question_id) as sl FROM questions q WHERE q.quiz_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $numberQuiz);
        $stmt->execute();
        $result = $stmt->get_result();
        $total_questions = $result->fetch_assoc();

        //Get correct answer
        $sql = "SELECT a.answer_id as idKey FROM answers a WHERE a.question_id = ? AND a.quiz_id = ? AND a.is_correct = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $numberQuestion, $numberQuiz);
        $stmt->execute();
        $result = $stmt->get_result();
        $key = $result->fetch_assoc();

        if($selected_answer == $key['idKey']){
            $_SESSION['score']++;
        }

        if((int)$numberQuestion == $total_questions['sl']){
            header("LOCATION: ../end.php");
        } else{
            header("LOCATION: ../process.php?n=". $next . "&quiz_id=" . $numberQuiz);
        }

    }
?>