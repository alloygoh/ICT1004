<?php
    require_once 'db-config.php';

    $temp = json_decode(file_get_contents('php://input'), true);
    $user = $temp["user"];
    $postid = $temp["postid"];
    $status = $temp["status"];
    $check = $temp["check"];

    $stmt2 = $dbh->prepare("select likes from posts where id = :pid");
    $stmt2->bindParam(":pid",$postid,PDO::PARAM_INT);
    $stmt2->execute();
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    //$result2 = $stmt2->get_result();
    //$row2 = $result2->fetch_assoc();
    $likes = $row2["likes"];
    if ($check == 0) {
        //upvote
        $stmt = $dbh->prepare("select upvoted from user_upvoted where user = :uid");
        $stmt->bindParam(":uid",$user,PDO::PARAM_INT);
        $stmt->execute();
        //$result = $stmt->get_result();
        $upvotes;
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $upvotes = $row["upvoted"];
        }
        if ($status == 0) {
            // user exists in entry, but has no upvotes or downvotes
            $upvotes .= "," . $postid . ",";
            $likes += 1;
        } else if ($status == 1) {
            // user unvotes his current vote (toggle)
            $upvotes = str_replace("," . $postid . ",", "", $upvotes);
            $likes -= 1;
        } else if ($status == 2) {
            // user selects the other option. Eg, downvote select upvote, upvote select downvote
            $upvotes .= "," . $postid . ",";
            $likes += 2;
            $stmt = $dbh->prepare("select downvoted from user_upvoted where user = :uid");
            $stmt->bindParam(":uid",$user,PDO::PARAM_INT);
            $stmt->execute();
            //$result = $stmt->get_result();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $downvotes = $row["downvoted"];
            $downvotes = str_replace("," . $postid . ",", "", $downvotes);
            $stmt2 = $dbh->prepare("UPDATE user_upvoted SET downvoted = :dwnvtd WHERE user = :uid");
            $stmt2->bindParam(":dwnvtd",$downvotes);
            $stmt2->bindParam(":uid",$user,PDO::PARAM_INT);
            $stmt2->execute();
        } else if ($status == 3) {
            // user entry does not exist in database. never voted any posts before
            $upvotes = "," . $postid . ",";
            $likes += 1;
            $stmt2 = $dbh->prepare("INSERT into user_upvoted (user, upvoted) values (:uid, :upvtd)");
            $stmt2->bindParam(':uid',$user,PDO::PARAM_INT);
            $stmt2->bindParam(':upvtd',$upvotes);
            $stmt2->execute();
            $stmt3 = $dbh->prepare("UPDATE posts SET likes = :likes WHERE ID = :pid");
            $stmt3->bindParam(':likes',$likes,PDO::PARAM_INT);
            $stmt3->bindParam(':pid',$postid,PDO::PARAM_INT);
            $stmt3->execute();
            exit();
        }
        $stmt2 = $dbh->prepare("UPDATE user_upvoted SET upvoted = :upvtd WHERE user = :uid");
        $stmt2->bindParam(':upvtd',$upvotes);
        $stmt2->bindParam(':uid',$user,PDO::PARAM_INT);
        $stmt2->execute();
        $stmt3 = $dbh->prepare("UPDATE posts SET likes = :likes WHERE ID = :pid");
        $stmt3->bindParam(':likes',$likes,PDO::PARAM_INT);
        $stmt3->bindParam(':pid',$postid,PDO::PARAM_INT);
        $stmt3->execute();
    } else {
        //downvote
        $stmt = $dbh->prepare("select downvoted from user_upvoted where user = :uid");
        $stmt->bindParam(":uid",$user,PDO::PARAM_INT);
        $stmt->execute();
        $downvotes;
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $downvotes = $row["downvoted"];
        }
        if ($status == 0) {
            // user exists in entry, but has no upvotes or downvotes
            $downvotes .= "," . $postid . ",";
            $likes -= 1;
        } else if ($status == 1) {
            // user unvotes his current vote (toggle)
            $downvotes = str_replace("," . $postid . ",", "", $downvotes);
            $likes += 1;
        } else if ($status == 2) {
            // user selects the other option. Eg, downvote select upvote, upvote select downvote
            $downvotes .= "," . $postid . ",";
            $likes -= 2;
            $stmt = $dbh->prepare("select upvoted from user_upvoted where user = :uid");
            $stmt->bindParam(":uid",$user,PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $upvotes = $row["upvoted"];
            $upvotes = str_replace("," . $postid . ",", "", $upvotes);
            $stmt2 = $dbh->prepare("UPDATE user_upvoted SET upvoted = :upvts WHERE user = :uid");
            $stmt2->bindParam(":upvts",$upvotes);
            $stmt2->bindParam(":uid",$user,PDO::PARAM_INT);
            $stmt2->execute();
        } else if ($status == 3) {
            // user entry does not exist in database. never voted any posts before
            $downvotes = "," . $postid . ",";
            $likes -= 1;
            $stmt2 = $dbh->prepare("INSERT into user_upvoted (username, downvoted) values ( :uid, :dwnvts)");
            $stmt2->bindParam(":uid",$user,PDO::PARAM_INT);
            $stmt2->bindParam(":dwnvts",$downvotes);
            $stmt2->execute();
            exit();
        }
        $stmt2 = $dbh->prepare("UPDATE user_upvoted SET downvoted = :dwnvts WHERE user = :uid");
        $stmt2->bindParam(":dwnvts",$downvotes);
        $stmt2->bindParam(":uid",$user,PDO::PARAM_INT);
        $stmt2->execute();
        $stmt3 = $dbh->prepare("UPDATE posts SET likes = :likes WHERE ID = :pid");
        $stmt3->bindParam(":likes",$likes,PDO::PARAM_INT);
        $stmt3->bindParam(":pid",$postid,PDO::PARAM_INT);
        $stmt3->execute();
    }
?>