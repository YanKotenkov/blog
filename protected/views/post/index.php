<?php
/* @var $this PostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'Posts',
];

$this->menu = [
    ['label' => 'Create Post', 'url' => ['create']],
    ['label' => 'Manage Post', 'url' => ['admin']],
];
?>

<h1>Posts</h1>

<?php if (!empty($_GET['tag'])) : ?>
    <h1>Записи с тегом <i><?php echo CHtml::encode($_GET['tag']); ?></i></h1>
<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'template' => "{items}\n{pager}",
]); ?>
