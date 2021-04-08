<?php
    require_once 'db-config.php';
    if(!$auth->isLogged()){
        header('Location: /index.php',true,302);
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Post</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/insert.css">
    <link rel="stylesheet" href="css/update.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/ulkbmfeqabpdrv13hbp0fk5q9tg2l2f5wjd4weevwtz53gda/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="js/update.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script>
        tinymce.init({
            selector: '#post-content',
            inline: true,
            toolbar: [
                'undo redo | bold italic underline | fontselect fontsizeselect',
                'forecolor backcolor | alignleft aligncenter alignright alignfull | numlist bullist outdent indent'
            ],
            menubar: false
        });
    </script>
</head>

<body>
    <?php include "log-nav.inc.php"; ?>
    <main class="container">
        <div id="update-alert" class="alert alert-success alert-dismissable collapse" role="alert">
            <b>Successfully Updated!</b>
            <button type="button" class="close" onclick="$('#update-alert').hide()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="error-alert" class="alert alert-danger alert-dismissable collapse" role="alert">
            <b>Oops! Something went wrong;</b>
            <button type="button" class="close" onclick="$('#error-alert').hide()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="container-contact100 bg0">
            <div class="wrap-contact100">
                <form class="contact100-form" id="update-form" method="POST">
                    <h1 class="contact100-form-title">
                        Update Post
                    </h1>

                    <div class="wrap-input100 bg1">
                        <label class="label-input100" for="post-title">Title</label>
                        <input required class="input100" id="post-title" name="post-title" aria-describedby="post-title" placeholder="Enter a title for your post">
                    </div>

                    <div class="wrap-input100 bg1">
                        <label class="label-input100" for="post-tag">Tag</label>
                        <input list="tags" class="input100" id="post-tag" name="post-tag" aria-describedby="post-tag" placeholder="What is your post about?">
                        <datalist id="tags">
                        </datalist>
                    </div>

                    <div class="wrap-input100 bg0">
                        <label class="label-input100">Content</label>
                        <div class="input100" id="post-content" aria-describedby="post-content">
                        </div>
                    </div>

                    <div class="container-contact100-form-btn">
                        <button id="update-button" type="submit" class="contact100-form-btn">
                            Update
                        </button>
                    </div>

                    <div class="container-contact100-form-btn">
                        <button type="button" id="archive-button" data-toggle="modal" data-target="#delete-modal" class="contact100-form-btn">
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal HTML -->
        <div id="delete-modal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <div class="icon-box">
                            <i class="material-icons">&#xE5CD;</i>
                        </div>
                        <h4 class="modal-title w-100">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure that you want to delete this post?</p>
                        <p>Your post will remain archived for 30 days, at which point it will be permanently deleted</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <form id="delete-form" method="POST">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="restore-modal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <div class="icon-box">
                            <i class="material-icons">check</i>
                        </div>
                        <h4 class="modal-title w-100">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure that you want to restore this post?</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <form id="restore-form" method="POST">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Restore</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="success-modal" class="modal fade">
            <div class="modal-dialog modal-success">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <div class="icon-box">
                            <i class="material-icons">&#xE876;</i>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body text-center">
                        <h4>Success!</h4>
                        <p>We're sad that your post's done. But if you change your mind you can always restore your post.</p>
                        <button class="btn btn-success" data-dismiss="modal"><span>Go Back</span> <i class="material-icons">&#xE5C8;</i></button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>