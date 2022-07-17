<?php
include "inc/head.php";
include "func/quizHandller.php";
$id = $_POST['edit'];
if(isset($_POST['title'])){
    $title = htmlspecialchars($_POST['title']);
    $body = htmlspecialchars($_POST['body']);
    $file = $_FILES['image'];    
    validateQuiz2($title, $body, $file, $_POST);
}
?>

<div class="container my-5 py-4">
    <?=editQuizForm($id)?>
</div>

<?php
include "inc/footer.php";
?>