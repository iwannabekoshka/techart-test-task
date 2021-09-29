<?php
include "ConnectDB.php";
$ConnectDB = new ConnectDB;

if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	echo "Нет новости без новости :(";
	die;
}

// news from offset to limit
$newsQuery = $ConnectDB->query("SELECT * FROM news WHERE id = $id");
$news = $newsQuery->fetchAll();

$html = createNewsBody($news);

echo $html;

function createNewsBody($news) {
	$html = '';

	foreach ($news as $newsItem) {
		$title = $newsItem['title'];
		$content = $newsItem['content'];

		$html = "
			<h2 class='news__title'>$title</h2>
			<div class='news__body'>
				$content
			</div>
			<div class='news__footer'>
				<a href='./news.php'>Все новости >></a>
			</div>
		";
	}

	return $html;
}