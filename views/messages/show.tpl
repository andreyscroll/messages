
<?php require $_SERVER["DOCUMENT_ROOT"] . '/views/header.tpl'; ?>

<div class="my-5">
	<h1><?= $title ?></h1>
	<p>Автор: <mark><?= $data['author'] ?></mark></p>
	<?= $data['content'] ?>
</div>

<?php require $_SERVER["DOCUMENT_ROOT"] . '/views/footer.tpl'; ?>