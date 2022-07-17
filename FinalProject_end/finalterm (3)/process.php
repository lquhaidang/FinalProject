<?php 
    include "inc/head.php";
    include "func/quizHandller.php";    
    $question = null;
    $answers = null;

    if(isset($_POST['start'])) {
        if(isset($_SESSION['score'])) {
            unset($_SESSION['score']);
        }
        if(isset($_SESSION['question_id']) && isset($_SESSION['quiz_id']) && isset($_SESSION['selected_answers'])) {
            unset($_SESSION['question_id']);
            unset($_SESSION['quiz_id']);
            unset($_SESSION['selected_answers']);
            unset($_SESSION['correct_answer']);
        }
        $quiz_id = $_POST['start'];
        $question = getQuestion($quiz_id);
        $total_question = getTotalQuestions($quiz_id);
        $answers = getAnswers($question['question_id'], $quiz_id);
        shuffle($answers);
    } else {
        $quiz_id = $_GET['quiz_id'];
        $question_id = $_GET['n'];
        $total_question = getTotalQuestions($quiz_id);
        $question = getNextQuestion($quiz_id, $question_id);
        $answers = getAnswers($question['question_id'], $quiz_id);
        shuffle($answers);
    }

?>

<main style="margin: 125px 0px;">

<div class="container score">
    <h3 class="font-weight-bold">Question: <?php echo $question['question_id'];?> / <?php echo $total_question['sl'];?></h3>
</div>

<div class="container game-space">
    <h2 id="question" class="font-weight-bolder mb-3 text-center"><?= $question['question_text']?></h2>
    <form action="func/nextQuestion.php" method="post">
        <div class="row gx-5 justify-content-between">
        <?php foreach($answers as $answer): ?>
            <div class="mb-3 col-md-5 rounded text-white">
                    <button type="submit" class="submitBtn" name="idAnswer" value="<?php echo $answer['answer_id']; ?>"></button>
                    <p class="answer-text text-center"><?php echo " " . $answer['answer_text']; ?></p>
                    <input type="hidden" name="numberQuestion" value="<?php echo $question['question_id']; ?>">
                    <input type="hidden" name="numberQuiz" value="<?php echo $question['quiz_id']; ?>">
            </div>
        <?php endforeach; ?>  
        </div>
    </form>
</div>
</main>
</body>
<?php include "inc/footer.php";?>