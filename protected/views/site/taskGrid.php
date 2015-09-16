<?php

    $arrayDataProvider=new CArrayDataProvider($data, array());
    
    $this->widget('zii.widgets.grid.CGridView', array(
    	'dataProvider' => $arrayDataProvider,
    	'columns' => array(
    		array(
    			'name' => 'Id',
    			'type' => 'raw',
    			'value' => 'CHtml::encode($data->id)'
    		),
    		array(
    			'name' => 'Таск',
    			'type' => 'raw',
    			'value' => 'CHtml::link(CHtml::encode($data->name), "/site/task/id/".CHtml::encode($data->id))',
    		),
            /*array(
    			'name' => 'Создан',
    			'type' => 'raw',
    			'value' => 'var_dump($data); exit;AsanaApi::convertDate($data->due_on)',
    		),*/
            array(
                'class'=>'CButtonColumn',
                'template'=>'{start}{stop}{complate}',
                'buttons'=>array(
                    'start' => array(
                        'label'=>'<a class="btn btn-xs"><i class="fa fa-play"></i></a>',
                        'options'=>array(),
                        'click'=>'function() {alert("coming soon")}',
                        'visible'=>'1',
                    ),
                    'stop' => array(
                        'label'=>'<a class="btn btn-xs"><i class="fa fa-pause"></i></a>',
                        'options'=>array(),
                        'click'=>'function() {alert("coming soon")}',
                        'visible'=>'1',
                    ),
                    'complate' => array(
                        'label'=>'<a class="btn btn-xs"><i class="fa fa-check"></i></a>',
                        'options'=>array(),
                        'click'=>'function() {alert("coming soon")}',
                        'visible'=>'1',
                    ),
                ),
            ),
    	),
    ));
?>    