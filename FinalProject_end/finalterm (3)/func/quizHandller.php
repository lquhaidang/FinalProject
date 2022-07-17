<?php
include "db.php";
function getQuizzes() {
    global $conn;
    $sql = "SELECT q.*, username
            FROM quiz_blogs q join users u on q.user_id = u.user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function getQuiz($id) {
    global $conn;
    $sql = "SELECT * FROM quiz_blogs q join users u on q.user_id = u.user_id WHERE q.quiz_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getQuestion($quiz_id) {
    global $conn;
    $sql = "SELECT q.* FROM questions q WHERE q.quiz_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getQuestions($quiz_id) {
    global $conn;
    $sql = "SELECT * FROM questions q WHERE q.quiz_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function getNextQuestion($quiz_id, $question_id) {
    global $conn;
    $sql = "SELECT q.* FROM questions q WHERE q.quiz_id = ? AND q.question_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $quiz_id, $question_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getAnswers($question_id, $quiz_id) {
    global $conn;
    $sql = "SELECT a.* FROM answers a WHERE a.question_id = ? AND a.quiz_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $question_id, $quiz_id);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function getTotalQuestions($quiz_id) {
    global $conn;
    $sql = "SELECT count(q.question_id) as sl FROM questions q WHERE q.quiz_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function validateQuiz($title, $body, $file, $data){
    $errors = [];

    if(empty($title) || strlen($title) < 2) {
        $errors['title'] = "Title cannot be empty or too short!";
        setMsg($errors['title'], "danger");
    }

    if(empty($body) || strlen($body) < 10) {
        $errors['body'] = "Body cannot be empty or too short!";
        setMsg($errors['body'], "danger");
    }
    // before moving the file, ensure there are no errors with the form (so you don't orphaned files)
    if(empty($errors)) {
        $file_dest = validateFile($file);
        if(!$file_dest) {
            // if there is a problem with the file this will return false
            $errors['file'] = "There was a problem with your file!";
            setMsg($errors['file'], "danger");
            var_dump($errors);
        } else {
            // if there are no errors, create the new post
            createQuiz($title, $body, $file_dest, $data);
        }
    } else {
        var_dump($errors);
    }
}

function validateQuiz2($title, $body, $file, $data){
    $errors = [];

    if(empty($title) || strlen($title) < 2) {
        $errors['title'] = "Title cannot be empty or too short!";
        setMsg($errors['title'], "danger");
    }

    if(empty($body) || strlen($body) < 10) {
        $errors['body'] = "Body cannot be empty or too short!";
        setMsg($errors['body'], "danger");
    }
    // before moving the file, ensure there are no errors with the form (so you don't orphaned files)
    if(empty($errors)) {
        $file_dest = validateFile($file);
        if(!$file_dest) {
            // if there is a problem with the file this will return false
            $errors['file'] = "There was a problem with your file!";
            setMsg($errors['file'], "danger");
            var_dump($errors);
        } else {
            // if there are no errors, create the new post
            editQuiz($title, $body, $file_dest, $data);
        }
    } else {
        var_dump($errors);
    }
}

function createQuiz($title, $body, $file_dest, $data) {
    $countingQues = 1;
    $countingAns = 1;
    $correct = 1;
    $incorrect = 0;
    $numQues = (count($data) - 2) / 6;
    $id_user = $_SESSION['user_id'];
    global $conn;
    $sql = "INSERT INTO quiz_blogs (user_id, quiz_title, quiz_description, quiz_img) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $id_user, $title, $body, $file_dest);
    $stmt->execute();
    if($stmt->affected_rows === 1) {
        $id = $stmt->insert_id;
        while($countingQues <= $numQues){
            $sql1 = "INSERT INTO questions (question_id, quiz_id, question_text) VALUES (?,?,?)";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param("iis", $countingQues, $id, $data['text_question'.$countingQues]);
            $stmt1->execute();
            
            while($countingAns <= 4){
                if(empty($data['text_answer'.$countingAns.'_'.$countingQues])) {
                    break;
                } else {
                    $sql2 = "INSERT INTO answers (answer_id, question_id, quiz_id, answer_text, is_correct) VALUES (?,?,?,?,?)";
                    $stmt2 = $conn->prepare($sql2);
                    if($countingAns == $data['Ans'.$countingQues]){
                        $stmt2->bind_param("iiisi", $countingAns, $countingQues, $id, $data['text_answer'.$countingAns.'_'.$countingQues], $correct);
                    } else{
                        $stmt2->bind_param("iiisi", $countingAns, $countingQues, $id, $data['text_answer'.$countingAns.'_'.$countingQues], $incorrect);
                    }
                    $stmt2->execute();
                    $countingAns++;
                }
            }
            $countingAns = 1;
            $countingQues++;
        }
        $countingQues = 1;
        header("LOCATION: quiz.php?id=" . $id);
    }  else {
        setMsg("There were some problems with your quiz!", "danger");
    }
}

function editQuiz($title, $body, $file_dest, $data) {
    $countingQues = 1;
    $countingAns = 1;
    $correct = 1;
    $incorrect = 0;
    $numQues = getTotalQuestions($data['edit'])['sl'];
    global $conn;

    //Delete old image
    $sql = "SELECT qb.quiz_img FROM quiz_blogs qb WHERE qb.quiz_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $data['edit']);
    $stmt->execute();
    $result = $stmt->get_result();
    $temp = $result->fetch_assoc();
    unlink($temp['quiz_img']);

    //Update new quiz
    $sql = "UPDATE quiz_blogs set quiz_title = ?, quiz_description = ?, quiz_img = ? WHERE quiz_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $body, $file_dest, $data['edit']);
    $stmt->execute();
    if($stmt->affected_rows === 1) {
        while($countingQues <= $numQues){
            $sql1 = "UPDATE questions set question_text = ? WHERE quiz_id = ? and question_id = ?";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param("sii",$data['text_question'.$countingQues], $data['edit'], $countingQues);
            $stmt1->execute();
            
            while($countingAns <= 4){
                if(empty($data['text_answer'.$countingAns.'_'.$countingQues])) {
                    break;
                } else {    
                    $sql2 = "UPDATE answers set answer_text = ?, is_correct = ? WHERE quiz_id =? and question_id=? and answer_id = ?";
                    $stmt2 = $conn->prepare($sql2);
                    if($countingAns == $data['Ans'.$countingQues]){
                        $stmt2->bind_param("siiii", $data['text_answer'.$countingAns.'_'.$countingQues], $correct, $data['edit'], $countingQues, $countingAns);
                    } else{
                        $stmt2->bind_param("siiii", $data['text_answer'.$countingAns.'_'.$countingQues], $incorrect, $data['edit'], $countingQues, $countingAns);
                    }
                    $stmt2->execute();
                    $countingAns++;
                }
            }
            $countingAns = 1;
            $countingQues++;
        }
        $countingQues = 1;
        header("LOCATION: quiz.php?id=" . $data['edit']);
    }  else {
        setMsg("There were some problems with your quiz!", "danger");
    }
}

function validateFile($file) {
    // validate file
    $errors = [];
    if($file['error'] === 0) {
        // check size is less than 5mb
        if($file['size'] > 5000000) {
            $errors['size'] = "File is too large!";
        }
        // check file ext is allowed
        $allowed_ext = ["png", "jpg", "jpeg", "gif"];
        $file_ext = explode("/", $file['type']);
        $file_ext = end($file_ext);
        if(!in_array(strtolower($file_ext), $allowed_ext)) {
            $errors['type'] = "Only images may be uploaded!";
            setMsg($errors['type'], "danger");
        }
        // if there are no errors, rename file and move it
        if(empty($errors)) {
            // rename file
            $new_name = uniqid("itec_") . "." . $file_ext;
            $dest = "images/" . $new_name;
            // move to images/
            if(move_uploaded_file($file['tmp_name'], $dest)) {
                return $dest;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function deleteQuiz($quiz_id){
    global $conn;
    //delete img in folder images
    $sql = "SELECT qb.quiz_img FROM quiz_blogs qb WHERE qb.quiz_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $temp = $result->fetch_assoc();
    unlink($temp['quiz_img']);
    //Delete answers
    $sql = "DELETE FROM answers WHERE quiz_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    //Delete questions
    $sql = "DELETE FROM questions WHERE quiz_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    //Delete quiz 
    $sql = "DELETE FROM quiz_blogs WHERE quiz_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();

    //Sort answers, questions, quiz_blogs table
    $sql = "ALTER TABLE answers ORDER BY answer_id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $sql = "ALTER TABLE answers ORDER BY question_id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $sql = "ALTER TABLE answers ORDER BY quiz_id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $sql = "ALTER TABLE questions ORDER BY question_id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $sql = "ALTER TABLE questions ORDER BY quiz_id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $sql = "ALTER TABLE quiz_blogs ORDER BY quiz_id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    header("LOCATION: index.php");
}

function getQuestionsInArray($quiz_id) {
    global $conn;
    $sql = "SELECT q.* 
            FROM questions q JOIN quiz_blogs qb ON q.quiz_id = qb.quiz_id 
            WHERE q.quiz_id = ? and q.question_id In (". implode(',', $_SESSION['question_id']). ")";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function getSelectedAnswers($quiz_id, $question_id, $selected_answer_id) {
    global $conn;
    $sql = "SELECT * FROM answers WHERE quiz_id = ? and question_id = ? and answer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quiz_id, $question_id, $selected_answer_id);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_assoc();
}

function getCorrectAnswers($quiz_id) {
    global $conn;
    $sql = "SELECT * FROM answers WHERE quiz_id = ? and is_correct = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function editQuizForm($id){
    $quiz = getQuiz($id);
    $countingQues = 1;
    $questions = getQuestions($id);
    echo "
    <div class ='row'>
        <div class='col-md-8 offset-md-2'>
            <h3><i class='fas fa-pencil mr-2'></i> Edit a Quiz</h3>
            <form action='update.php' method='post' enctype='multipart/form-data'>
                <div class='card mt-3 text-dark'>
                    <div class='card-body'>
                        <div class='form-group'>
                            <label for='title'>Quiz Title</label>
                            <input type='text' name='title' class='form-control' value='{$quiz['quiz_title']}'>
                        </div>
                        <div class='form-group'>
                            <label for='body'>Quiz Body</label>
                            <textarea name='body' class='form-control' rows='5'>{$quiz['quiz_description']}</textarea>
                        </div>
                        <div class='form-group'>
                            <label for='customFile'>Quiz Image<sup style='color:#e90606;'>*Do not let this empty</sup></label>
                            <input type='file' name='image' class='form-control' id='customFile'>
                        </div>
                    </div>
                </div> <!-- Done quiz part -->
                <h2 class='mt-4'><i class='fa fa-pencil mr-2' style='font-size: smaller;'></i>Question Part</h2>
                <div class='create-question-space card mt-3 text-dark'>
                    <div class='card-body'>";
                        foreach ($questions as $question){
                            $answers = GetAnswers($question['question_id'], $question['quiz_id']);
                            echo"<div class='form-group'>
                                <label for='text_question{$countingQues}'>Question Text {$countingQues}</label>
                                <input type='text' name='text_question{$countingQues}' class='form-control' value ='{$question['question_text']}'>
                            </div>";
                            
                            for($i = 0;$i < count($answers);$i+=2){
                                echo"<div class='row mb-3'>
                                    <div class='col'>
                                        <label for='text_answer{$answers[$i]['answer_id']}'>Answer {$answers[$i]['answer_id']} Text</label>
                                        <input type='text' name='text_answer{$answers[$i]['answer_id']}_{$question['question_id']}' class='form-control' value ='{$answers[$i]['answer_text']}'>";
                                    if($answers[$i]['is_correct'] == 1){
                                        echo"<input class='form-check-input' style='margin: 5px 4px;' type='radio' name='Ans{$question['question_id']}' id='Anskey{$answers[$i]['answer_id']}' value='{$answers[$i]['answer_id']}' checked>
                                            <label class='form-check-label' for='Anskey{$answers[$i]['answer_id']}'>
                                                Answer {$answers[$i]['answer_id']}
                                            </label>";
                                    }else{
                                        echo"<input class='form-check-input' style='margin: 5px 4px;' type='radio' name='Ans{$question['question_id']}' id='Anskey{$answers[$i]['answer_id']}' value='{$answers[$i]['answer_id']}'>
                                            <label class='form-check-label' for='Anskey{$answers[$i]['answer_id']}'>
                                                Answer {$answers[$i]['answer_id']}
                                            </label>
                                        ";
                                    }
                                        echo"</div>";
                                        if(!empty($answers[$i + 1]))
                                        {
                                            echo"<div class='col'>
                                            <label for='text_answer{$answers[$i + 1]['answer_id']}'>Answer {$answers[$i + 1]['answer_id']} Text</label>
                                            <input type='text' name='text_answer{$answers[$i + 1]['answer_id']}_{$question['question_id']}' class='form-control' value ='{$answers[$i+1]['answer_text']}'>";
                                            if($answers[$i + 1]['is_correct'] == 1){
                                                echo"<input class='form-check-input' style='margin: 5px 4px;' type='radio' name='Ans{$question['question_id']}' id='Anskey{$answers[$i + 1]['answer_id']}' value='{$answers[$i + 1]['answer_id']}' checked>
                                                    <label class='form-check-label' for='Anskey{$answers[$i + 1]['answer_id']}'>
                                                        Answer {$answers[$i + 1]['answer_id']}
                                                    </label>
                                                ";
                                            }else{
                                                echo"<input class='form-check-input' style='margin: 5px 4px;' type='radio' name='Ans{$question['question_id']}' id='Anskey{$answers[$i + 1]['answer_id']}' value='{$answers[$i + 1]['answer_id']}'>
                                                    <label class='form-check-label' for='Anskey{$answers[$i + 1]['answer_id']}'>
                                                        Answer {$answers[$i + 1]['answer_id']}
                                                    </label>";
                                            }
                                            echo"</div>";                                     
                                        }
                                    echo"</div>";
                            }
                            $countingQues++;
                        }
                    echo"</div> <!-- End card body -->
                </div> <!-- Done question part -->
                <input type='hidden' name='edit' value='{$id}'>
                <button type='submit' class='btn btn-outline-primary btn-block mt-4'><i class='fa fa-plus-circle' aria-hidden='true'></i> Edit Quiz</button>
            </form>
        </div>
    </div>";
}