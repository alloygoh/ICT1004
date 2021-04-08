<!DOCTYPE html>
<html lang="en">

<head>
    <title>Insert Post</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/insert.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/ulkbmfeqabpdrv13hbp0fk5q9tg2l2f5wjd4weevwtz53gda/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <style>
        /* Input box styling */
        #post-content {
            min-height: 300px;
        }

        #post-content:focus {
            outline: none;
        }
    </style>
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
    <script>
        async function retrieveTags() {
            await axios.post('/process-retrievetags.php', {})
                .then((response) => {
                    response = response.data;
                    let tagList = document.getElementById('tags');
                    response['tagList'].forEach(function(tag) {
                        let newTag = document.createElement('option');
                        newTag.value = tag;
                        tagList.appendChild(newTag);
                    })
                }, (error) => {
                    document.querySelector('#error-alert b').innerHTML = "Could not retrieve tags from database!";
                    $('#error-alert').show();
                })
        }
        async function insertPost() {
            await axios.post('/process-insertpost.php', {
                    postTitle: document.getElementById('post-title').value,
                    postTag: document.getElementById('post-tag').value,
                    postContent: document.getElementById('post-content').innerHTML
                })
                .then((response) => {
                    $('#insert-alert').show();
                }, (error) => {
                    error = error.response.data;
                    document.querySelector('#error-alert b').innerHTML = error.errMsg;
                    $('#error-alert').show();
                });
        }

        window.onload = function() {
            retrieveTags();
            document.getElementById('insert-form').addEventListener('submit', function(event) {
                event.preventDefault();
                insertPost();
            });
        }
    </script>
</head>

<body>
    <?php include "nav.inc.php"; ?>
    <main class="container">
        <div id="insert-alert" class="alert alert-success alert-dismissable collapse" role="alert">
            <b>Post successfully created!</b>
            <button type="button" class="close" onclick="$('#insert-alert').hide()" aria-label="Close">
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
                <form class="contact100-form" id="insert-form" method="POST">
                    <h1 class="contact100-form-title">
                        Create a new post
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
                        <button id="create-button" type="submit" class="contact100-form-btn">
                            <span>
                                Create Post
                                <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>