<?php
include "ConnectDB.php";
$ConnectDB = new ConnectDB;

if (isset($_GET['page'])) {
	$page = ( (int)$_GET['page'] - 1 )*5;
} else {
	$page = 0;
}

$newsQuery = $ConnectDB->query("SELECT * FROM news ORDER BY idate DESC LIMIT 5 OFFSET $page");
$news = $newsQuery->fetchAll();

$newsQuery = $ConnectDB->query("SELECT * FROM news");
$newsCount = $newsQuery->numRows();

$html = '';
$html .= createNewsBody($news);
$html .= createNewsFooter($newsCount);

echo $html;

function createNewsBody($news) {
	$newsBody = '<div class="news__body">';
	foreach ($news as $newsItem) {
		$id = $newsItem['id'];
		$date = date('d.m.Y', $newsItem['idate']);
		$title = $newsItem['title'];
		$announce = $newsItem['announce'];
		$content = $newsItem['content'];

		$newsBody .= "
    	<div class='news-item' data-id='$id'>
			<div class='news-item__header'>
				<span class='news-item__date'>$date</span>
				<h3 class='news-item__title'>$title</h3>
			</div>
			<div class='news-item__body'>$announce</div>
		</div>
    ";
	}
	$newsBody .= '</div>';

	return $newsBody;
}

function createNewsFooter($newsCount) {
	$pages = (int)($newsCount/5) + 1;

	$footer = '<div class="news__footer">';
	for ($i = 0; $i < $pages; $i++) {
		$pageNum = $i+1;

		$footer .= "
			<a style='text-decoration: none' href='./news.php?page=$pageNum'>
				<button style='width: 30px'>$pageNum</button>
			</a>
		";
	}
	$footer .= '</div>';

	return $footer;
}