
<?php require $_SERVER["DOCUMENT_ROOT"] . '/views/header.tpl'; ?>

<div class="my-5">
	<h1><?= $title ?></h1>
	<p>Автор: <mark><?= $data['author'] ?></mark></p>
	<?= $data['content'] ?>
</div>

<div>
	<a href="/messages/<?= $data['id'] ?>/edit" class="btn btn-secondary btn-sm">Редактировать</a>
</div>

<div class="my-2">
	<form action="/messages/<?= $data['id'] ?>/delete" method="POST">
		<input type="submit" class="btn btn-danger btn-sm" value="Удалить запись">
	</form>
</div>

<h2>Комментарии</h2>
<?php if(!empty($comments)): ?>
	<?php foreach($comments as $comment): ?>
	<div class="card mb-3">
		<div class="card-body">
			<?= $comment['comment'] ?>
		</div>
	</div>
	<?php endforeach; ?>
<?php else: ?>
	<p class="text-success">Ваш комментарий будет первым.</p>
<?php endif; ?>

<div class="my-2">
	<h3>Написать комментарий</h3>
	<form action="/messages/<?= $data['id'] ?>/comment" method="POST">
		<div class="mb-3">
            <label for="comment" class="form-label">Текст сообщения</label>
            <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
		</div>
		<input type="submit" class="btn btn-primary" value="Отправить">
	</form>
</div>

<?php require $_SERVER["DOCUMENT_ROOT"] . '/views/footer.tpl'; ?>