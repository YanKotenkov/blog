<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs = [
    'Posts' => ['index'],
    $model->title => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'List Post', 'url' => ['index']],
    ['label' => 'Create Post', 'url' => ['create']],
    ['label' => 'View Post', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage Post', 'url' => ['admin']],
];
?>

    <h1>Update Post <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', ['model' => $model]); ?>