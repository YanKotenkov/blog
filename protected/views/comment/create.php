<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs = [
    'Comments' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'List Comment', 'url' => ['index']],
    ['label' => 'Manage Comment', 'url' => ['admin']],
];
?>

    <h1>Create Comment</h1>

<?php $this->renderPartial('_form', ['model' => $model]); ?>