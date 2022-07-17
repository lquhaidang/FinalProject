<?php 
include "func/db.php";
include "func/func.php";

session_start();
$message = [];
if(!isset($_SESSION["logged_in"])) {
  $_SESSION['username'] = null;
  $_SESSION['user_id'] = null;
  $_SESSION['role'] = null;
  $_SESSION['logged_in'] = false;
  $_SESSION['msg'] = null;
  $_SESSION['msg_class'] = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.6.0/cosmo/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/slideShow.css">
<link rel="stylesheet" href="css/gamestyles.css">
<title>Quiz Website</title>
</head>
<body>
<header>
      <nav class="navbar navbar-expand-md navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="#"><i class="fa fa-gamepad mr-2" aria-hidden="true"></i>Quizzes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item blue">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create.php">Create Quiz</a>
            </li>
            <?php if($_SESSION['logged_in'] == true): ?>
                </li>
                <a class="nav-link" href="user.php"><i class="fa fa-user-circle" aria-hidden="true"></i> <?= $_SESSION['username'];?><span class="sr-only">(current)</span></a>
                </li>
                </li>
                <a class="nav-link" href="logout.php">Logout<span class="sr-only">(current)</span></a>
                </li>
            <?php else: ?>
                </li>
                <a class="nav-link" href="login.php"><i class="fa fa-user" aria-hidden="true"></i> Login<span class="sr-only">(current)</span></a>
                </li>
            <?php endif; ?>
          </ul>
        </div>
        </div>
      </nav>
    </header>