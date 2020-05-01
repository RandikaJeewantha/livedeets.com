<?php 

    function validatePost($post) {
            
        global $errors;

        if (empty($post['title'])) {
            array_push($errors, "Title is required !");
        }

        if (empty($post['body'])) {
            array_push($errors, "Body is required !");
        }

        if (empty($post['topic_id'])) {
            array_push($errors, "Please select a topic !");
        }

        $exitingPost = selectOne('posts', ['title' => $post['title']]);
        if($exitingPost) {

            if(isset($post["update-post"]) && $exitingPost['id'] != $post['id']) {
                array_push($errors, "Post with that title already exists");
            }

            if (isset($post['add-post'])) {
                array_push($errors, "Post with that title already exists");
            }
            
        }

        return $errors;
    }

?>