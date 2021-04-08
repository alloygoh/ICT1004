<?php
try{
    require_once 'db-config.php';
    require_once 'utils.php';
    
    // Decode the $_POST superglobal from JSON before processing
    $_POST = json_decode(file_get_contents("php://input"),true);

    $errorMsg;
    $success = true;
    if(!isset($_POST['postTitle']) || empty($_POST['postTitle'])) {
        http_response_code(500);
        $errorMsg .= "Title cannot be empty!\n";
        $success = false;
    }

    if(!isset($_POST['postContent']) || empty($_POST['postContent'])) {
        http_response_code(500);
        $errorMsg .= "Content cannot be empty!";
        $success = false;
    }

    if($success == true){
        $post_op = $auth->getCurrentUID();
        $post_title = $_POST['postTitle'];
        $post_tag = $_POST['postTag'];
        $post_content = $_POST['postContent'];
        $query = $dbh->prepare("INSERT INTO posts (op, title, body, tag) VALUES (:op, :title, :body, :tag)");
        $query->bindParam(':op',$post_op);
        $query->bindParam(':title',$post_title);
        $query->bindParam(':tag',$post_tag);
        $query->bindParam(':body',$post_content);
        $query->execute();
        $query2 = $dbh->prepare("INSERT IGNORE INTO following (user_id, tag) VALUE (:uid, :tag)");
        $query2->bindParam(':uid',$post_op);
        $query2->bindParam(':tag',$post_tag);
        $query2->execute();
    }else{
        $err_json = array("errMsg" => $errorMsg);
        echo json_encode($err_json);
    } 
}catch(PDOException $e){
    http_response_code(500);
    return;
}
?>