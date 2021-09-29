<?php
include "ConnectDB.php";
$ConnectDB = new ConnectDB;

if (isset($_GET['page'])) {
	$page = ( (int)$_GET['page'] - 1 )*5;
} else {
	$page = 0;
}

// news from offset to limit
$newsQuery = $ConnectDB->query("SELECT * FROM news ORDER BY idate DESC LIMIT 5 OFFSET $page");
$news = $newsQuery->fetchAll();

// overall news count
$newsQuery = $ConnectDB->query("SELECT * FROM news");
$newsCount = $newsQuery->numRows();

$html = '';
$html .= createNewsBody($news);
$html .= createNewsFooter($newsCount);

echo $html;

function createNewsBody($news) {
	$newsItems = createNewsItems($news);

	return "
		<h2 class='news__title'>Новости</h2>
		<div class='news__body'>
			$newsItems
		</div>
	";
}

function createNewsItems($news) {
	$newsItems = '';

	foreach ($news as $newsItem) {
		$id = $newsItem['id'];
		$date = date('d.m.Y', $newsItem['idate']);
		$title = $newsItem['title'];
		$announce = $newsItem['announce'];

		$newsItems .= "
			<div class='news-item'>
				<div class='news-item__header'>
					<span class='news-item__date'>$date</span>
					<h3 class='news-item__title'>
						<a href='./view.php?id=$id'>$title</a>
					</h3>
				</div>
				<div class='news-item__body'>$announce</div>
			</div>
		";
	}

	return $newsItems;
}

function createNewsFooter($newsCount) {
	$footerButtons = createNewsFooterButtons($newsCount);

	return "
		<div class='news__footer'>
			<h3>Страницы:</h3>
			<div class='news__pages'>
				$footerButtons
			</div>
		</div>";
}

function createNewsFooterButtons($newsCount) {
	$pages = (int)($newsCount/5) + 1;

	$buttons = "";

	for ($i = 0; $i < $pages; $i++) {
		$pageNum = $i+1;
		$classActive = $pageNum === (int)$_GET['page'] ? 'active' : '';

		$buttons .= "
			<button class='news__page-btn $classActive'>
				<a href='./news.php?page=$pageNum'>$pageNum</a>
			</button>
		";
	}

	return $buttons;
}