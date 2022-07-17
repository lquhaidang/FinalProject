<?php
include "inc/head.php";
include "func/quizHandller.php";

$score = round(($_SESSION['score'] * 100) / count($_SESSION['question_id']));
$quiz_id  = $_SESSION['quiz_id'];
$quiz = getQuiz($quiz_id);
$totalQuestion = getTotalQuestions($quiz_id);
$allQuestions = getQuestionsInArray($quiz_id);
$allCorrectAnswers = getCorrectAnswers($quiz_id);
$allSelectedAnswers = [];
$answers = [];
for($i = 0; $i < count($allQuestions); $i++){
    $temp = getSelectedAnswers($quiz_id, $allQuestions[$i]['question_id'], $_SESSION['selected_answers'][$i]);
    array_push($allSelectedAnswers, $temp);
}
?>

<h2 class="text-center font-weight-bold mt-5">Quiz "<?=$quiz['quiz_title']?>" report</h2>

<div class="container my-4">
    <div class="row justify-content-around pb-5 align-items-center">
        <div class="col-md-4">
            <div class="progress mx-auto">
                <span class="progress-left">
                    <span class="left-side progress-bar border-success"></span>
                </span>
                <span class="progress-right">
                    <span class="right-side progress-bar border-success"></span>
                </span>
                <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                    <div class="score h2 font-weight-bold"><?=$score?><sup class="small">%</sup></div>
                </div>
            </div>
        </div>

        <div class="col-md-6 card-body border-dark border">
            <div class="row">
                <div class="col-md-5">
                    <h4>Date/Time:</h4>
                    <h4>Answered:</h4>
                    <h4>Scores:</h4>
                    <h4>Player:</h4>
                </div>
                <div class="col-md-6 justify-content-around">
                    <h4><?=date('d-m-y/g:i a')?></h4>
                    <h4><?=count($allQuestions)?>/<?=$totalQuestion['sl']?></h4>
                    <h4><?=$_SESSION['score']?></h4>
                    <?php if(empty($_SESSION['username'])):?>
                        <h4>Guest</h4>
                    <?php else:?>
                        <h4><?=$_SESSION['username']?></h4>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <thead class="bg-primary">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Question</th>
            <th scope="col" style="text-align:center;">Correct</th>
            </tr>
        </thead>
        <?php for($i = 0; $i < count($allQuestions); $i++):?>
            <tbody>
                <tr class="table-secondary">
                    <th scope="row"><?= $i + 1 ?></th>
                    <td><?=$allQuestions[$i]['question_text']?></td>
                    <?php if($allCorrectAnswers[$i]['answer_id'] == $allSelectedAnswers[$i]['answer_id']) :?>
                    <td style="text-align:center; background-color:#18db18;"><i class="fa fa-check" aria-hidden="true"></i></td>
                    <?php else :?>
                        <td style="text-align:center; background-color:#db1818;"><i class="fa fa-times" aria-hidden="true"></i></td>
                    <?php endif;?>
                </tr>
            </tbody>
        <?php endfor;?>
    </table>
    <div class="d-flex mt-2 justify-content-between">
        <button type="button" class="btn btn-secondary rounded view-answers" data-toggle="modal" data-target="#exampleModal">View Answers</button>
        <a href="index.php"><button type="button" class="btn btn-secondary rounded">Back to home</button></a>
    </div>
</div>

<!-- Modal -->
<div class="modal faded" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Answers Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php for($i = 0; $i < count($allQuestions); $i++):?>
                <h4>Question <?=$i + 1?></h4>
                <h5 style="background-color: #67fd89;">Correct Answer: <?= $allCorrectAnswers[$i]['answer_text']?></h5>
                <?php if($allCorrectAnswers[$i]['answer_id'] == $allSelectedAnswers[$i]['answer_id']) :?>
                    <h5 style="background-color: #67fd89;">Your Answer: <?= $allSelectedAnswers[$i]['answer_text']?><i class="fa fa-check ml-2" aria-hidden="true"></i></h5>
                    <br>
                <?php else:?>
                    <h5 style="background-color: #ff7a87;">Your Answer: <?= $allSelectedAnswers[$i]['answer_text']?><i class="fa fa-times ml-2" aria-hidden="true"></i></h5>
                    <br>
                <?php endif;?>
            <?php endfor;?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
    </div>
</div>

<?php
include "inc/footer.php";
?>