var ajaxRequest;  // The variable that makes Ajax possible!

function ajaxFunction() {
   try {
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   } catch (e) {
   
      // Internet Explorer Browsers
      try {
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
      
         try {
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         } catch (e) {
      
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
}

function viewMore() {
    ajaxFunction();
   
    // Here processRequest() is the callback function.
    ajaxRequest.onreadystatechange = function() {//Call a function when the state changes.
        if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
            document.getElementById("cardcontainer").innerHTML = this.responseText;
        }
    }
    
    var target = parseInt(document.getElementById("counter").innerHTML) + parseInt("5");
    var url = "loadtop.php";
    var param = "?limit=" + target;
    document.getElementById("counter").innerHTML = target;
   
    ajaxRequest.open("GET", url+param, true);
    ajaxRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajaxRequest.send();
}
async function handlevote(name, postid, status, check){
    // 0 = user never voted this post before, 1 = unvote, 2 = other vote, 3 = no vote before on any post
    // check = 0, upvote. check = 1, downvote
    
    let url = "/handlevote.php";
    let data = {user: name, postid: postid, status: status, check:check};
    let response = await fetch(url, {
        body: JSON.stringify(data),
        method: "post"
    });
    window.location.href = 'individualpage.php?post=' + postid;
    //let data1 = await response.text();
    //console.log(data1);
    
}

$(document).ready(
    $('#user-register').on('submit',function(e){
        e.preventDefault();
        $('#reg-button').prop('disabled',true);
        $('#reg-button').text('Registering...');
        $('#reg-button').addClass('btn-secondary');
        $('#reg-button').removeClass('btn-primary');
        var form = $(this);
        var url = 'process-register.php';
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(){
                if ($('#reg-error').length != 0){
                    $('#reg-error').remove();
                }
                var temp = $('<div class="alert alert-success"></div>');
                temp.html('Account has been successfully created! Proceed to <a href="/login.php" class="alert-link">login</a>');
                $("#user-register").before(temp);
                $("#user-register").trigger("reset");
                $('#reg-button').text('Registered!');
            },
            statusCode: {
                400: function(data){
                    if ($('#reg-error').length != 0){
                        var temp = $('#reg-error');
                        temp.empty();
                    } else{
                        var temp = $('<div class="alert alert-danger alert-dismissible fade show" role="alert" id="reg-error"></div>');
                    }
                    temp.text('The Following Errors Were Detected:');
                    var temp_ul = $('<ul></ul>');
                    var el = data.responseText.split('<br>');
                    el.forEach(element => {
                        if (element!=""){
                            temp_ul.append('<li>' + element + '</li>');
                        }
                    });
                    temp.append(temp_ul);
                    $("#user-register").before(temp);
                    $('#reg-button').prop('disabled',false);
                    $('#reg-button').text('Register');
                    $('#reg-button').addClass('btn-primary');
                    $('#reg-button').removeClass('btn-secondary');
                }
            }
        });
    }),
    $('#form-profile').on('submit',function(e){
        e.preventDefault();
        $('#profile-submit').prop('disabled',true);
        $('#profile-submit').text('Updating...');
        $('#profile-submit').addClass('btn-secondary');
        $('#profile-submit').removeClass('btn-primary');
        var form = $(this);
        var url = 'process-profile.php';
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(){
                if ($('#reg-error').length != 0){
                    $('#reg-error').remove();
                }
                var temp = $('<div class="alert alert-success"></div>');
                temp.html('Profile Updated!');
                $("#form-profile").before(temp);
                $("#form-profile").trigger("reset");
                $('#profile-submit').text('Saved!');
            },
            statusCode: {
                400: function(data){
                    if ($('#reg-error').length != 0){
                        var temp = $('#reg-error');
                        temp.empty();
                    } else{
                        var temp = $('<div class="alert alert-danger alert-dismissible fade show" role="alert" id="reg-error"></div>');
                    }
                    temp.text('The Following Errors Were Detected:');
                    var temp_ul = $('<ul></ul>');
                    var el = data.responseText.split('br');
                    el.forEach(element => {
                        temp_ul.append('<li>' + element + '</li>');
                    });
                    temp.append(temp_ul);
                    $("#form-profile").before(temp);
                    $('#profile-submit').prop('disabled',false);
                    $('#profile-submit').text('Save Changes');
                    $('#profile-submit').addClass('btn-primary');
                    $('#profile-submit').removeClass('btn-secondary');
                }
            }
        });
    }),
)    
function processEmail(){
    var formChildren = $('#form-profile').children('input');
    var email = formChildren[0];
    if (email.value !== ''){
        $(formChildren[1]).attr('required',true);
        return;
    }
    $(formChildren[1]).attr('required',false);
    return;
}
function processPassword(){
    var formChildren = $('#form-profile').children('input');
    var newPass = formChildren[2];
    if (newPass.value !== ''){
        $(formChildren[1]).attr('required',true);
        $(formChildren[3]).attr('required',true);
        return;
    }
    $(formChildren[1]).attr('required',false);
    $(formChildren[1]).attr('required',false);
    return;
}

async function clicktags() {

    let url = "../display-posts.php";
    let data1 = {type: "tags"};
    let response = await fetch(url, {
        body: JSON.stringify(data1),
        method: 'post'
    });
    console.log(response);
    let data = await response.text();
    document.getElementById("cardcontainer").innerHTML=data;
    console.log(data);
};