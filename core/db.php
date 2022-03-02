<?php

$db = new PDO('mysql:dbname=messages;host=127.0.0.1', 'root', 'root');

function getMessages($limit)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM messages ORDER BY id ASC LIMIT :limit");
	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function paginate($offset, $perPages)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM messages ORDER BY id ASC LIMIT :offset, :perPages");
	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	$stmt->bindParam(':perPages', $perPages, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMessage(int $id)
{
	global $db;
	$stmt = $db->prepare('SELECT * FROM messages WHERE id = :id');
	$stmt->execute([':id' => $id]);
	$item = $stmt->fetch(PDO::FETCH_ASSOC);
	return $item;
}

function getRowsCount()
{
	global $db;
	return (int) $db->query('SELECT count(*) as count FROM messages')->fetch(PDO::FETCH_NUM)[0];
}

function setMessage()
{
	global $db;
	$stmt = $db->prepare('INSERT INTO messages (title, author, summary, content) VALUES (:title, :author, :summary, :content)');
	return $stmt->execute([
			':title' => $_POST['title'],
			':author' => $_POST['author'],
			':summary' => $_POST['summary'],
			':content' => $_POST['content']
		]);
}

function updateMessage($id)
{
	global $db;
	$stmt = $db->prepare('UPDATE messages SET title = :title, author = :author, summary = :summary, content = :content
		WHERE id = :id');
	return $stmt->execute([
			':title' => $_POST['title'],
			':author' => $_POST['author'],
			':summary' => $_POST['summary'],
			':content' => $_POST['content'],
			':id' => $id,
		]);
}

function deleteMessage($id)
{
	global $db;
	$stmt = $db->prepare('DELETE FROM messages WHERE id = :id');
	return $stmt->execute([':id' => $id]);
}

function saveComment($id)
{
	global $db;
	$stmt = $db->prepare('INSERT INTO comments (comment, message_id) VALUES (:comment, :message_id)');
	return $stmt->execute([
		':comment' => $_POST['comment'],
		':message_id' => $id,
	]);
}

function getComments($id)
{
	global $db;
	$stmt = $db->prepare('SELECT * FROM comments WHERE message_id = :id');
	$stmt->execute([':id' => $id]);
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}