<?php

    $api = $this->asanaApi;
    
    $taskJson = $api->asana->getTask($id);
    $api->checkError($taskJson);
    $task = json_decode($taskJson)->data;
    
    if ($task->due_on == null) {
        echo 'Обратитесь к менеджеру. <br> Таск должен иметь дату и время дедлайна. <br> <a href="/"> <- Назад <a/>';
        Yii::app()->end();
    }
    
    if ($task->due_at == null) {
        echo 'Обратитесь к менеджеру. <br> Таск должен иметь время дедлайна. <br> <a href="/"> <- Назад <a/>';
        Yii::app()->end();
    }
    
    $complate = '';
    $start = '';
    $stop = 'disabled';
    
    if ($model != null) {
        $start    = ($model->isStart) ? 'disabled' : '';
        $stop     = ($model->isStop)  ? 'disabled' : '';
        $complate = '';

        if ($model->isComplate)
            $complate = $start = $stop = 'disabled';
    }
?>
    <h2>
        <?= (substr($task->name, -1) != ':') ? $task->name : ' [Millistone] ' . $task->name ?>
    </h2> <hr />
<span id="buttons_block">   
    <?php echo CHtml::ajaxLink( //PLAY
    '<i class="fa fa-play"></i>', '/taskLog/start/id/'.$id, array(
        'type' => 'POST',
        'beforeSend' => 'function( xhr ) {
            $("#buttons_block").toggle();
            $("#alert_block").toggle();
        }',
         'success' => 'function(data) {
            $("#buttons_block").toggle();
            $("#alert_block").toggle();
            alert(data);
            $("#start").addClass("disabled");
            $("#stop").removeClass("disabled");
            $("#status").text("in proccess");
         }',
    ), array(
        'id' => 'start',
        'class' => 'btn btn-info '.$start,
    ));
?> &nbsp;&nbsp; 
    <?php echo CHtml::ajaxLink( //STOP
    '<i class="fa fa-pause"></i>', '/taskLog/stop/id/'.$id, array(
        'type' => 'POST',
        'beforeSend' => 'function( xhr ) {
            $("#buttons_block").toggle();
            $("#alert_block").toggle();
        }',
        'success' => 'function(data) {
            $("#buttons_block").toggle();
            $("#alert_block").toggle();
            alert(data);
            $("#stop").addClass("disabled");
            $("#start").removeClass("disabled");
            $("#status").text("is stopped");
        }',
    ), array(
        'id' => 'stop',
        'class' => 'btn btn-danger '.$stop,
    ));
    ?> &nbsp;&nbsp;&nbsp;
    <?php echo CHtml::ajaxLink( //COMPLATE
    '<i class="fa fa-check"></i>', '/taskLog/complate/id/'.$id, array(
        'type' => 'POST',
        'beforeSend' => 'function( xhr ) {
            $("#buttons_block").toggle();
            $("#alert_block").toggle();
        }',
        'success' => 'function(data) {
            $("#buttons_block").toggle();
            $("#alert_block").toggle();
            alert(data);
            $("#stop").addClass("disabled");
            $("#start").addClass("disabled");
            $("#complate").addClass("disabled");
            $("#status").text("is complated");
        }',
    ), array(
        'id' => 'complate',
        'class' => 'btn btn-success '.$complate,
    ));
    ?>
</span>
<span id="alert_block" style="display:none;">
    <h3>Соединение с сервером...</h3>
</span>
        <span id="status" style="font: bold;">
            <?php
            if ($model == null)
                echo 'Ожидание';
            else {
                if ($model->isStart)               echo '<i class="fa fa-play"></i> В процессе';
                if ($model->isStop)                echo '<i class="fa fa-pause"></i> Приостановлен';
                if ($model->isComplate)            echo '<i class="fa fa-check"></i> Закрыт';
            }   
            ?>
        </span>
    <hr />
    
    <h3>Исполнитель: <?= $task->assignee->name ?></h3>
    <p>Создан: <?= AsanaApi::convertDate($task->created_at) ?></p>
    <p>Изменен: <?= AsanaApi::convertDate($task->modified_at) ?></p>
    <p>Актуален до: <?= AsanaApi::convertDate($task->due_at) ?></p>
 <hr />

Описание:
<p><?=$task->notes?></p>
<hr />
<?php 
    echo '<br>'; dump($task);/*
    echo '<br>';
    $resultJson = $api->asana->getTaskStories($id);
    $api->checkError($resultJson);
    echo '<br>';
    $stories = json_decode($resultJson);
    echo "Task stories(comments):" . PHP_EOL;
    dump($stories); */ ?>