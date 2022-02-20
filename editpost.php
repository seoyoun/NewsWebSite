<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files</title>
    <link rel="stylesheet" type="text/css" href="files.css" />
</head>
<body>
        
        <h1>Edit Post</h1>

        <!--query based on story_id for default text in text boxes-->
        <?php
        require 'newsdb.php';
        $story_id = $_POST['story_id'];

        
        $stmt = $mysqli->prepare("select title, username, body, link from stories where story_id='$story_id'");
        
        //do we still want to query the username?? there's no text box to edit username

        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        else
        {
            echo "query prep succeeded";
        }

        if(!$stmt->execute())
        {
            echo "query execute failed";
        }
        else
        {
            echo "query execute success";
        }

        if(!$stmt->bind_result($title, $username, $body, $link))
        {
            echo "query bind result failed";
        } 
        else
        {
            echo "query bind result succeeded";
        }

        /*
        if($_SESSION['user'] != $username) //!$_SESSION['logged_in'] || 
        {
            echo "You are not authorized to make changes to this post.";
            ?>
            <form name ="input" action='main.php'>
                <input type="submit" value="back to main page" />
            </form>
            <?php
        }
        else
        {*/
        ?>

        <?php echo $title; ?>
        <!--text box for title-->
        <form action="editing.php" method="POST">
        <p>
            <label for="title">Title:</label>
            <!--https://www.w3schools.com/tags/tag_textarea.asp-->
            <textarea id="title" name="title" rows="1" cols="50"><?php if($stmt->fetch()) {
            echo $title;?></textarea>
            
                
            <!--remember to filter title-->

        </p>
        <!--text box for link-->
        <p>
            <label for="link">Link:</label>
            <textarea id="link" name="link" rows="2" cols="50"><?php 
            echo $link;?></textarea>

            <!--remember to filter link-->

        </p>
        <!--text box for body-->
        <p>
            <label for="body">Body:</label>
            <textarea id="body" name="body" rows="6" cols="50"><?php 
            echo $body;}?></textarea>

            <!--remember to filter body-->
        </p>
        <!--send story_id-->


        <!--creative portion: support posting images-->

        <input type="hidden" name = 'story_id' value="<?php echo $story_id?>">
        <input type="submit" class="submitpostButton" value="post" />
        
        </form>


        <?php
        //}
        ?>

        </body>
</html>