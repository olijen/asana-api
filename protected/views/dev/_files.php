    <?php foreach($model->devFiles as $k => $file) : ?>
        <a href="<?=$file->src?>"><?=$file->name?></a> <a href="/dev/deletefile/id/<?=$file->id?>">[x]</a>, &nbsp;
    <?php endforeach ?>