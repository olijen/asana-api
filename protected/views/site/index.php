<?php 
    $asana = $this->asanaApi->asana;
    $api = $this->asanaApi;
    
    $workspaces = $asana->getWorkspaces();

    $api->checkError($workspaces);

    $workspacesJson = json_decode($workspaces);
    
    foreach ($workspacesJson->data as $workspace) {
        echo '<h3>' . $workspace->name . ' (id ' . $workspace->id . ')' . '</h3><br />' . PHP_EOL;

        $tasks = $asana->getWorkspaceTasks($workspace->id, 'me', array('completed_since'=>'now'));
        $tasksJson = json_decode($tasks);
        $api->checkError($tasks);
        $this->renderPartial('taskGrid', array('data'=>$tasksJson->data));
        
    } ?>    