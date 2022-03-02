
<?php require $_SERVER["DOCUMENT_ROOT"] . '/views/header.tpl'; ?>

<div class="my-5">
	<form action="/messages/<?= $data['id'] ?>" method="POST">

		<div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" name="title" id="title" value="<?= $data['title'] ?>">
		</div>

		<div class="mb-3">
            <label for="author" class="form-label">Автор</label>
            <input type="text" class="form-control" name="author" id="author" value="<?= $data['author'] ?>">
		</div>

		<div class="mb-3">
            <label for="summary" class="form-label">Короткое описание</label>
            <textarea class="form-control" name="summary" id="summary" rows="3"><?= $data['summary'] ?></textarea>
		</div>
		
		<div class="mb-3">
            <label for="content" class="form-label">Текст сообщения</label>
            <textarea class="form-control" name="content" id="content" rows="3"><?= $data['content'] ?></textarea>
		</div>

		<button type="submit" class="btn btn-primary">Сохранить</button>
	</form>
</div>

<?php require $_SERVER["DOCUMENT_ROOT"] . '/views/footer.tpl'; ?>