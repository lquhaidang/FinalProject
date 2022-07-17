<?php
include "inc/head.php";
include "func/quizHandller.php";
$quizzes = [];

if(isset($_GET['id'])) {
    $quizzes = getQuiz($_GET['id']);
}
if(isset($_POST['delete'])){
    deleteQuiz($_POST['delete']);
}
?>

<div class="bg_banner">
<?php if(empty($quizzes)): ?>
        <h3 class="display-4" style="text-align: center; position: relative; top: 200px;"> POST NOT FOUND!!!</h3>
    <?php else: ?>
        <div class="container">
        <div class="jumbotron container">
            <img src="<?= $quizzes['quiz_img'] ?>" style ="max-width: 100%" alt="">
            <h3 class="display-4"><?= $quizzes['quiz_title'] ?></h3>
            <p class="lead">
            <?=$quizzes['username']?> | <?=date("d M Y", strtotime($quizzes['date_created'])) ?>
            </p>
            <?php if($quizzes['username'] == $_SESSION['username'] || $_SESSION['role'] == 1) :?>
                <div class="d-flex" style="gap: 15px;">
                <form action="update.php" method="post">
                    <input type="hidden" name="edit" value="<?php echo $quizzes['quiz_id']?>">
                    <button class="btn btn-outline-warning btn-lg"> <i class="fa fa-pencil-square mr-2"></i>Edit</button>
                </form>
                <form action="quiz.php" method="post">
                    <input type="hidden" name="delete" value="<?php echo $quizzes['quiz_id']?>">
                    <button class="btn btn-outline-danger btn-lg"> <i class="fa-solid fa-trash-can mr-2"></i>Delete</button>
                </form>
                </div>
            <?php else: ?>

            <?php endif; ?>
            <hr class="my-4">
            <p> <?php echo $quizzes['quiz_description'] ;?></p>

            <div class="d-flex justify-content-between">
                <a href="index.php"><button class="btn btn-outline-warning btn-lg"> <i class= "fa fa-arrow-circle-left mr-2" aria-hidden="true"></i> Back</button></a>
                <form action="process.php?n=1" method="post">
                    <input type="hidden" name="start" value="<?php echo $quizzes['quiz_id']?>">
                    <button class="btn btn-outline-success btn-lg"> <i class="fa fa-star mr-2" aria-hidden="true"></i>Start Quiz</button>
                </form>
            </div>
        </div>
        </div>
    <?php endif; ?>
</div>

<?php
include "inc/footer.php";
?>