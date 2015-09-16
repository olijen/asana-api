<h3>
<?php
    $process = thisUser()->inProcess;
    if (empty($process)) {
        $html = '<a href="/" class="btn btn-danger">Займись делом!</a>';
        if (Yii::app()->request->isAjaxRequest)
            exit($html);
        else {
            echo $html; return;
        }
            
    } 
?>

     Статус работы: &nbsp;&nbsp;&nbsp;&nbsp; <?=$process->statusIcon?>
</h3>
<div style="background: #eee; padding: 10px;">
    <?php
    
    if (!empty($process)) : ?>
        <span id="taskname" style="font-weight:bold;color:black;">
            <a class="btn" href="/site/task/id/<?=$process->inAsana->id?>"><?=$process->inAsana->name?></a>
        </span> <br />
        Старт: <span id="start"><?= AsanaApi::convertTimestamp($process->start)?></span> <br />
        Дедлайн: <span id="left"><?= AsanaApi::convertTimestamp($process->deadline) ?></span><br />
        Потрачено(ч): <span id="left"><?= AsanaApi::convertTsToHours($process->timeSpent) ?></span><br />
        Время: <span id="left"><?= AsanaApi::convertTimestamp(time()) ?></span><br />
        <?php if ($process->timeIsOver) : ?>
            <h3 class="btn btn-danger">ВРЕМЯ ИСТЕКЛО <?=AsanaApi::convertTsToHours(thisUser()->timeLeft)?> ч. назад!</h3>
        <?php else : ?>
            Осталось(ч): <span class="btn btn-success" id="left"><?= AsanaApi::convertTsToHours(thisUser()->timeLeft) ?></span>
        <?php endif ?>
        &nbsp;&nbsp;&nbsp;&nbsp;
    <?php  else : ?>
       Туплю
    <?php endif ?>
    <?php //echo 'Timezone - '.date_default_timezone_get() ?>
</div>
<?php
    
    if ($process->timeLeft <= 0 && empty(Yii::app()->request->cookies['alert_deadline']->value)) {
        $cookie = new CHttpCookie('alert_deadline', 1);
        $cookie->expire = time() + 60*60;
        Yii::app()->request->cookies['alert_deadline'] = $cookie;
        echo '<script>
            alert("Время до дедлайна истекло для таска \''.$process->inAsana->name.'\'");
        </script>';
    } elseif ($process->timeLeft < 60*60 && empty(Yii::app()->request->cookies['alert_1hour']->value)) {
        $cookie = new CHttpCookie('alert_1hour', 1);
        $cookie->expire = time() + 60*60;
        Yii::app()->request->cookies['alert_1hour'] = $cookie;
        echo '<script>
            alert("Остался один час до дедлайна таска \''.$process->inAsana->name.'\'");
        </script>';
    }
    
    thisUser()->timeReport();