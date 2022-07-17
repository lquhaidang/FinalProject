<?php
 $new_user = [
    "username" => "",
    "username_err" => false,
    "username_matching" => 0,
    "email" => "",
    "email_err" => false,
    "password" => "",
    "password_err" => false,
    "password_confirm" => "",
    "password_confirm_err"=> false
 ];

 $edit_user = [
   "username" => "",
   "edit_user_err" => false,
   "email" => "",
   "edit_email_err" => false,
   "password" => "",
   "edit_password_err" => false,
   "password_confirm" => "",
   "edit_password_confirm_err"=> false
 ];
 // login user arr to store login data and errors
 $login_user = [
    "username" => "",
    "username_err" => false,
    "password" => "",
    "password_err" => false
 ];

 function getUser($user) {
    global $conn;
    $sql = "SELECT * from users where username = ?";
    $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $user);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows > 0) {
         return $result->fetch_assoc();
      } else {
         return 0;
      }
 }

 function loginUser($user) {
    $_SESSION['username'] = $user['username'];
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['logged_in'] = true;
    $_SESSION['msg'] = "Logged in successfully";
    $_SESSION['msg_class'] = "success";

    header("Location: index.php");
 }

 function validateLogin($user, &$login_user) {
    $login_user['username'] = htmlspecialchars($user['username']);
    $login_user['password'] = $user['password'];
    $user = getUser($login_user['username']);

    if(empty($user)) {
        //setMsg
        setMsg("Username not found!", "danger", null);
        $login_user['username_err'] = true;
    } else {
        if(password_verify($login_user['password'],$user['password_hash'])) {
            loginUser($user);
        } else {
            $login_user['password_err'] = true;
            //setMsg
            setMsg("Incorrect password!", "danger", null);
        }
    }
}

function createNewUser($new_user) {
    global $conn;
    $user = [
       "username" => $new_user['username'],
       "email" => $new_user['email'],
       "password" => password_hash($new_user['password'], PASSWORD_DEFAULT)
    ];
    $sql = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $user['username'], $user['email'], $user['password']);
    $stmt->execute();
    if($stmt->affected_rows == 1) {
       $loginuser = getUser($user['username']);
       loginUser($loginuser);
    }
 }

function validateNewUser($user, &$new_user) {
    $new_user['username'] = htmlspecialchars($user['username']);
    $new_user['email'] = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
    $new_user['password'] = htmlspecialchars($user['password']);
    $new_user['password_confirm'] = htmlspecialchars($user['password_confirm']);
    //input validation
    $user = getUser($new_user['username']);
    // check username > 5 chars
    if(strlen($new_user['username']) <  5) {
       $new_user['username_err'] = true;
    }
    //check if new username already exists in database
    if((!empty($user))) {
       $new_user['username_matching'] = 1;
    }
    // check email is valid
    if(!filter_var($new_user['email'], FILTER_VALIDATE_EMAIL)) {
       $new_user['email_err'] = true;
    }
    // check password > 5 chars
    if(strlen($new_user['password']) < 5) {
       $new_user['password_err'] = true;
    }
    // check password a = password b
    if($new_user['password'] != $new_user['password_confirm']) {
       $new_user['password_confirm_err'] = true;
    }
    var_dump(($new_user));
    // check if any _err == true in $new_user, if no error create account, else output error msg setMsg($msg, $class)
    if(array_search(1, $new_user)) {
      setMsg("There already name " . $new_user['username'] . " exists!", "danger");
      } 
      if(array_search(true, $new_user, true)) {
         setMsg("There was an error with your submission!", "danger");
      } 
      if(!array_search(true, $new_user, true) && !array_search(1, $new_user, true)) {
       // create new account, login the user then redirect to home page
       createNewUser($new_user);
    }
 }

 function checkValid($field, $arr) {
    $key = $field . "_err"; // username + _err => $new_user['username_err']
    if($arr[$key]) {
       echo "is-invalid";
    }
 }

 function getUserById() {
   global $conn;
   $sql = "SELECT * FROM users WHERE user_id = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("i", $_SESSION['user_id']);
   $stmt->execute();
   $result = $stmt->get_result();
   return $result->fetch_assoc();
 }

 function changeUserInfo($user_info, &$edit_user) {
   global $conn;
   $edit_user['username'] = htmlspecialchars($user_info['edit-username']);
   $edit_user['email'] = filter_var($user_info['edit-email'], FILTER_SANITIZE_EMAIL);
   $edit_user['password'] = htmlspecialchars($user_info['edit-password']);
   $edit_user['password_confirm'] = htmlspecialchars($user_info['edit-passwordConfirm']);
   //no empty and not only white space
   if(strlen(trim($edit_user['username'])) > 0){
      $sql = "UPDATE users u SET u.username = ?, date_updated = current_timestamp  WHERE u.user_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("si", $edit_user['username'],$user_info['user-id']);
      $stmt->execute();

      $loginUser = getUserById();
      loginUser($loginUser);
   }
   if(strlen(trim($edit_user['email'])) > 0){
      $sql = "UPDATE users SET email = ?, date_updated = current_timestamp WHERE user_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("si", $edit_user['email'], $user_info['user-id']);
      $stmt->execute();


      $loginUser = getUserById();
      loginUser($loginUser);
   }
   // if change password, user have to type in both pw and pw_confirm
   if(strlen(trim($edit_user['password'])) > 0 && strlen(trim($edit_user['password_confirm'])) <= 0 || (strlen(trim($edit_user['password'])) <= 0 && strlen(trim($edit_user['password_confirm']))) > 0){
      //do nothing
   }else{ //success
      //check pw_confirm == pw or that 2 input not be empty or have only white space
      if($edit_user['password'] != $edit_user['password_confirm']  || (strlen(trim($edit_user['password_confirm']) ) <= 0 && (strlen(trim($edit_user['password'])) <= 0))){
         //do nothing;
      }else{
         $pw = password_hash($edit_user['password'], PASSWORD_DEFAULT);
         $sql = "UPDATE users SET password_hash = ?, date_updated = current_timestamp WHERE user_id = ?";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("si", $pw, $user_info['user-id']);
         $stmt->execute();


         $loginUser = getUserById();
         loginUser($loginUser);
      }
   }
 }