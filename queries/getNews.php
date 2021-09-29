<?php

include "ConnectDB.php";

$ConnectDB = new ConnectDB;

$news = $ConnectDB->query('SELECT * FROM news LIMIT 5')->fetchAll();

$html = '';
foreach ($news as $newsItem) {
    $id = $newsItem['id'];
	$date = date('d.m.Y', $newsItem['idate']);
    $title = $newsItem['title'];
    $announce = $newsItem['announce'];
    $content = $newsItem['content'];

    $html .= "
    	<div class='news-item' data-id='$id'>
			<div class='news-item__header'>
				<span class='news-item__date'>$date</span>
				<h3 class='news-item__title'>$title</h3>
			</div>
			<div class='news-item__body'>$announce</div>
		</div>
    ";
}

echo $html;