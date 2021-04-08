function retrievePost(id) {
    axios.post('/process-retrievepost.php', {postID: id})
        .then((response) => {
            response = response.data;
            document.getElementById('post-title').value = response.postTitle;
            document.getElementById('post-content').innerHTML = response.postContent;
            document.getElementById('post-tag').value = response.postTag;
            let archiveButton = document.getElementById('archive-button');
            let submitButton = document.getElementById('update-button');
            let formInputs = document.querySelectorAll('#update-form input');
            if (response.isArchived == 1) {
                archiveButton.innerHTML = "Restore";
                archiveButton.classList.remove('btn-danger');
                archiveButton.classList.add('btn-success');
                archiveButton.dataset.target = "#restore-modal";
                formInputs.forEach((input) => {
                    input.disabled = true;
                });
                tinymce.get('post-content').setMode('readonly');
                submitButton.innerHTML = "Updates are disabled as the post is archived";
                submitButton.disabled = true;

            } else {
                archiveButton.innerHTML = "Delete";
                archiveButton.classList.remove('btn-success');
                archiveButton.classList.add('btn-danger');
                archiveButton.dataset.target = "#delete-modal";
                formInputs.forEach((input) => {
                    input.disabled = false;
                });
                tinymce.get('post-content').setMode('design');
                submitButton.innerHTML = "Update";
                submitButton.disabled = false;
            }
        }, (error) => {
            $('#error-alert').show();
        });
}
async function updatePost(id) {
    $('#update-button').prop('disabled',true);
    $('#update-button').text("Updating...");
    await axios.post('/process-updatepost.php', {
            postTitle: document.getElementById('post-title').value,
            postTag: document.getElementById('post-tag').value,
            postContent: document.getElementById('post-content').innerHTML,
            postID: id
        })
        .then((response) => {
            $('#update-alert').show();
            $('#update-alert')[0].scrollIntoView();
            $('#update-button').text("Update");
            retrievePost(id);
        }, (error) => {
            error = error.response.data;
            document.querySelector('#error-alert b').innerHTML = error.errMsg;
            $('#error-alert').show();
            $('#update-button').prop('disabled',false);
            $('#update-button').text('Update');
            $('#error-alert').scrollIntoView();
        });
}
async function deleteBlog(id) {
    await axios.post('process-deletepost.php', {postID: id})
        .then((reponse) => {
            $('#delete-modal').modal('hide');
            let modalHeader = document.querySelector('#success-modal h4');
            modalHeader.innerHTML = "Successfully Deleted!";
            let modalP = document.querySelector('#success-modal p');
            modalP.innerHTML = "We're sad to see that you've deleted your post! If you change your mind any time within the next 30 days, we can get that post back up for you!";
            $('#success-modal').modal('show');
            retrievePost(id);
        }, (error) => {
            document.querySelector('#error-alert b').innerHTML = "Oops! Something went wrong!";
            $('#error-alert').show();
        });
}
async function restoreBlog(id) {
    await axios.post('process-restorepost.php', {postID: id})
        .then((reponse) => {
            $('#restore-modal').modal('hide');
            let modalHeader = document.querySelector('#success-modal h4');
            modalHeader.innerHTML = "Successfully Restored!";
            let modalP = document.querySelector('#success-modal p');
            modalP.innerHTML = "Awesome! Your post's now back up. We're excited to see what new posts you'll create!";
            $('#success-modal').modal('show');
            retrievePost(id);
        }, (error) => {
            document.querySelector('#error-alert b').innerHTML = "Oops! Something went wrong!";
            $('#error-alert').show();
        });
}
window.onload = function() {
    let sp = new URLSearchParams(window.location.search);
    let pid = sp.get('id');
    document.getElementById('update-form').addEventListener('submit', function(event) {
        event.preventDefault();
        updatePost(pid);
    });
    document.getElementById('delete-form').addEventListener('submit', function(event) {
        event.preventDefault();
        deleteBlog(pid);
    });
    document.getElementById('restore-form').addEventListener('submit', function(event) {
        event.preventDefault();
        restoreBlog(pid);
    });
    retrievePost(pid);
}