<?php
    $api = $this->asanaApi;
    $tasksJson = $api->asana->getProjectTasks($id);
    $api->checkError($tasksJson);
    $tasks = json_decode($tasksJson);
    dump($tasks->data[0]);exit;
    echo '&nbsp;&nbsp;<h2><a class="btn btn-block btn-success" href="#">' . $tasks->data[0]->projects[0]->name . '</a></h2><br>' . PHP_EOL;

    $this->renderPartial('taskGrid', array('data'=>$tasks->data));
?>    
