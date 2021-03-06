<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs = [
    'Posts' => ['index'],
    'Manage',
];

$this->menu = [
    ['label' => 'List Post', 'url' => ['index']],
    ['label' => 'Create Post', 'url' => ['create']],
];

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#post-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Posts</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', ['class' => 'search-button']); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', [
        'model' => $model,
    ]); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', [
    'id' => 'post-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,

    'columns' => [
        [
            'name' => 'title',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->title), $data->url)'
        ],
        [
            'name' => 'status',
            'value' => 'Lookup::item("PostStatus",$data->status)',
            'filter' => Lookup::items('PostStatus'),
        ],
        [
            'name' => 'create_time',
            'type' => 'datetime',
            'filter' => false,
        ],
        [
            'class' => 'CButtonColumn',
        ],
    ],

]); ?>
