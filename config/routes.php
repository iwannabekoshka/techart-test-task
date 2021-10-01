<?php
return [
	'news/([0-9]+)' => 'news/view/$1', // actionView in NewsController | Просмотр одной новости
	'news/page-([0-9]+)' => 'news/index/$1', // actionIndex in NewsController | Просмотр новостей страницы
	'news' => 'news/index/1', // actionIndex in NewsController | Просмотр новостей 1й страницы
];