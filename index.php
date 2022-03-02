<?php

require_once 'core/functions.php';
require_once 'core/db.php';

$uri = getUri();
$httpMethod = $_SERVER['REQUEST_METHOD'];


switch (true)
{
	// страница добавления сообщения
	case (bool) preg_match("#messages/create#", $uri):
		$title = 'Добавить запись';
		require_once 'views/messages/create.tpl';
	break;


	// страница редактирования сообщения
	case (bool) preg_match("#messages/(\d+)/edit#", $uri, $vars):
		$title = 'Редактировать запись';
		$id = $vars[1];
		$data = getMessage($id);
		require_once 'views/messages/edit.tpl';
	break;


	// добавление комментария
	case (bool) preg_match("#messages/(\d+)/comment#", $uri, $vars):
		if($httpMethod == 'POST')
		{
			$id = $vars[1];
			if(saveComment($id)){
				redirect('/messages/' . $id);
			} else {
				echo 'Ошибка записи комментария';
			}
		}
	break;


	// удаление сообщения
	case (bool) preg_match("#messages/(\d+)/delete#", $uri, $vars):
		if($httpMethod == 'POST')
		{
			$id = $vars[1];
			if(deleteMessage($id)){
				redirect('home');
			} else {
				echo 'Ошибка удаления';
			}
		}
	break;


	// страница сообщения
	case (bool) preg_match("#messages/(\d+)#", $uri, $vars):
		// обновление сообщения, если пришел POST
		if($httpMethod == 'POST')
		{
			$id = $vars[1];
			if(updateMessage($id)){
				redirect('/messages/' . $id . '/edit');
			} else {
				echo 'Ошибка обновления';
			}
		}

		$id = $vars[1];
		$data = getMessage($id);
		$comments = getComments($id);
		$title = $data['title'];
		require_once 'views/messages/show.tpl';
	break;


	// Главная страница. Список сообщений
	case (bool) preg_match("##", $uri):
		// добавляем сообщение, если пришел POST
		if($httpMethod == 'POST'){
			if(setMessage()){
				redirect('home');
			} else {
				echo 'Ошибка записи сообщения';
			}
		}

		$page = (int) isset($_GET['page']) ? $_GET['page'] : 1;

		$perPages = 3;
		$offset = ($page - 1) * $perPages;

		$rowsCount = getRowsCount();
		$pages = ceil($rowsCount / $perPages);

		if($page > $pages){
			redirect('home');
		}

		$title = "Сообщения - Страница {$page}";
		$data = paginate($offset, $perPages);
		require_once 'views/index.tpl';
	break;

	default:
		echo '404 not found';
}
