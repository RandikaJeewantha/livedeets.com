<?php 

    function validateTopic($topic) {
        
        global $errors;

        if (empty($topic['name'])) {
            array_push($errors, "Name is required !");
        }

        if (empty($topic['description'])) {
            array_push($errors, "Description is required !");
        }

        $exitingTopic = selectOne('topics', ['name' => $topic['name']]);
        if($exitingTopic) {

            if(isset($topic["update-topic"]) && $exitingTopic['id'] != $topic['id']) {
                array_push($errors, "Topic already exists");
            }

            if (isset($topic['add-topic'])) {
                array_push($errors, "Topic already exists");
            }
            
        }

        return $errors;
    }

?>