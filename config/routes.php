<?php
return [
	'news/([0-9]+)' => 'news/view/$1', // actionView in NewsController | Просмотр одной новости
	'news/page-([0-9]+)' => 'news/index/$1', // actionIndex in NewsController | Просмотр новостей страницы
	'\b(news)\b' => 'news/index/1', // actionIndex in NewsController | Просмотр новостей 1й страницы

	'not-found' => "news/error404" // actionError404 in NewsController | Неправильная страница
];