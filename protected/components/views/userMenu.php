<ul>
	<li><?php echo CHtml::link('Создать новую запись', ['post/create']); ?></li>
	<li><?php echo CHtml::link('Управление записями', ['post/admin']); ?></li>
	<li><?php echo CHtml::link('Одобрение комментариев', ['comment/index'])
			. ' (' . Comment::model()->pendingCommentCount . ')'; ?></li>
	<li><?php echo CHtml::link('Выход', ['site/logout']); ?></li>
</ul>