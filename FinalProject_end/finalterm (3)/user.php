<?php
include "inc/head.php";
include "func/loginHandller.php";

$user_info = getUserById();
if(isset($_POST['update'])) {
    changeUserInfo($_POST, $edit_user);
}
?>
<div class="container" style="position: relative; height: 390px;">
    <div class="my-5 user-info">
        <div class="avatar fa-5x" style="position: absolute; top:-65px; left: 0;">
        <i class="fa fa-user-circle" aria-hidden="true"></i>
        </div>
        <div class="card-body border border-dark">
            <h4 class="font-weight-bold text-center pb-4">USER INFORMATION</h4>
            <p>Username: <?= $user_info['username']?></p>
            <p>Email: <?= $user_info['email']?></p>
            <p>Date Created: <?= $user_info['date_created']?></p>
            <button type="button" class="btn btn-secondary rounded view-answers" data-toggle="modal" data-target="#edit-info">Change information</button>
        </div>
    </div>
</div>

<div class="modal faded" id="edit-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="user.php" method="post">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Information <sup style="color:#e90606;">*change one or many information</sup></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label for="edit-username">Username</label>
            <input type="text" name="edit-username" class="form-control">
            <label for="edit-email">Email</label>
            <input type="email" name="edit-email" class="form-control">
            <label for="edit-password">Password</label>
            <input type="password" name="edit-password" class="form-control">
            <label for="edit-passwordConfirm">Password Confirm</label>
            <input type="password" name="edit-passwordConfirm" class="form-control">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="update" class="btn btn-primary">Save changes</button>
            <input type="hidden" name="user-id" value="<?=$user_info['user_id'] ?>">
          </div>
          </form>
        </div>
      </div>
    </div>
<?php
include "inc/footer.php";
?>