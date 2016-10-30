<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs = [
    'Posts' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'List Post', 'url' => ['index']],
    ['label' => 'Manage Post', 'url' => ['admin']],
];
?>

    <h1>Create Post</h1>

<?php $this->renderPartial('_form', ['model' => $model]); ?>