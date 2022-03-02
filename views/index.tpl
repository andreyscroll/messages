
<?php require $_SERVER["DOCUMENT_ROOT"] . '/views/header.tpl'; ?>

<h1>Список сообщений</h1>

<div class="my-4">
	<a href="/messages/create" class="btn btn-primary">Добавить запись</a>
</div>

<?php foreach($data as $msg): ?>
	<div class="card mb-3">
		<div class="card-body">
			<h2 class="fs-5">
				<a href="/messages/<?= $msg['id'] ?>"><?= $msg['title'] ?></a>
			</h2>
			<p><?= $msg['summary'] ?></p>
		</div>
	</div>
<?php endforeach; ?>

<nav>
	<ul class="pagination">
		<?php for($i = 1; $i <= $pages; $i++): ?>
			<li class="page-item"><a class="page-link" href="/?page=<?= $i ?>"><?= $i ?></a></li>
		<?php endfor; ?>
	</ul>
</nav>

<?php require $_SERVER["DOCUMENT_ROOT"] . '/views/footer.tpl'; ?>