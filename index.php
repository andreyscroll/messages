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

	// добавление комментария
	case (bool) preg_match("#messages/(\d+)/comment#", $uri, $vars):
		$data = getMessage($vars[1]);
		$title = $data['title'];
		require_once 'views/messages/show.tpl';
	break;

	// страница сообщения
	case (bool) preg_match("#messages/(\d+)#", $uri, $vars):
		$data = getMessage($vars[1]);
		$comments = getComments($vars[1]);
		$title = $data['title'];
		require_once 'views/messages/show.tpl';
	break;


	// Главная страница. Список сообщений
	case (bool) preg_match("##", $uri):

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
