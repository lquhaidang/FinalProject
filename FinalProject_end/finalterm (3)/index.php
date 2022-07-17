<?php
include "inc/head.php";
include "func/quizHandller.php";
$quizzes = getQuizzes();
?>

<!-- Begin page content -->
<div class="jumbotron" style="background: url(images/banner.jpg); background-size:cover;">
    <main role="main" class="container mt-4 py-3">
      <div class="p-5 bg-white">
        <h1 class="py-2 text-center"><i class="fa fa-gamepad" aria-hidden="true"></i> Challenge yourself with quizzes</h1>
        <!-- Slideshow container -->
        <div class="slideshow-container">
        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
          <div class="numbertext">1 / 3</div>
          <img src="images/elonmusk.jpg" style="width:100%">
          <div class="bg-dark">
            <div class="text mb-4 bg-dark">Founder, CEO at SpaceX</div>
            <div class="text bg-dark">This website make me amazed, I'm going to trade for this website</div>
          </div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">2 / 3</div>
          <img src="images/billgate.jpg" style="width:100%">
          <div class="bg-dark">
            <div class="text mb-4 bg-dark">Founder, CEO at Microsoft</div>
            <div class="text bg-dark">Those kids should work for microsoft!!!</div>
          </div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">3 / 3</div>
          <img src="images/spencer.jpg" style="width:100%">
          <div class="bg-dark">
            <div class="text mb-4 bg-dark">CEO of MVC pattern</div>
            <div class="text bg-dark">One of the best website that I have ever use in my life</div>
          </div>
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>

        <!-- The dots/circles -->
        <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        </div>
      </div>
      </main>
    </div>
      <hr>
    <div class="container py-4">
      <h3 class="font-weight-light">Recent Quizzes</h3>
      <hr>
      <div class="row">
        <?php foreach($quizzes as $post): ?>
          <div class="col-md-4 my-3 d-flex">
            <div class="card flex-fill">
            <a href="quiz.php?id=<?= $post['quiz_id'];?>"><img src="<?= $post['quiz_img'] ?>" class="card-img-top" alt="..." style="height: 35vh";></a>
            <div class="card-body">
              <a href="quiz.php?id=<?= $post['quiz_id'];?>"><h3 class="card-title"><?= $post['quiz_title']?></h3></a>
              <p class="card-text"><?= $post['quiz_description']?></p>
            </div>
            <div class="card-footer text-muted d-flex justify-content-between">
              <p><?= date("d M Y",strtotime($post['date_created']))?></p>
              <p><?= $post['username'] ?></p>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
</div>

<?php
include "inc/footer.php";
?>