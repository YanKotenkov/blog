<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs = [
    'Posts' => ['index'],
    $model->title,
];

$this->menu = [
    ['label' => 'List Post', 'url' => ['index']],
    ['label' => 'Create Post', 'url' => ['create']],
    ['label' => 'Update Post', 'url' => ['update', 'id' => $model->id]],
    ['label' =>
        'Delete Post',
        'url' => '#',
        'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']
    ],
    ['label' => 'Manage Post', 'url' => ['admin']],
];
?>

<h1>View Post #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'title',
        'content',
        'tags',
        'status',
        [
            'name' => 'create_time',
            'type' => 'datetime',
            'filter' => false,
        ],
        [
            'name' => 'update_time',
            'type' => 'datetime',
            'filter' => false,
        ],
        'author_id',
    ],
]); ?>

<div id="comments">
    <?php if ($model->commentCount >= 1) : ?>
        <h3>
            <?php echo $model->commentCount . 'comment(s)'; ?>
        </h3>

        <?php $this->renderPartial('_comments', [
            'post' => $model,
            'comments' => $model->comments,
        ]); ?>
    <?php endif; ?>

    <br>
    <h3>Оставить комментарий</h3>

    <?php if (Yii::app()->user->hasFlash('commentSubmitted')) : ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
        </div>
    <?php else : ?>
        <?php $this->renderPartial('/comment/_form', [
            'model' => $comment,
        ]); ?>
    <?php endif; ?>
</div> <!-- comments -->
