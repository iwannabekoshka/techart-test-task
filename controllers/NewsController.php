<?php

include_once ROOT.'/models/News.php';

class NewsController
{
	public function actionIndex($page)
	{
		if ($page) {
			$offset = ( (int)$page - 1 ) * 5;
		} else {
			$offset = 0;
		}

		$limit = 5;

		$newsList = News::getList($offset, $limit);
		if (!$newsList) {
			$domain = $_SERVER['HTTP_HOST'];
			header("Location: http://$domain/not-found");
			exit;
		}
		$newsCount = News::getCount();
		$pages = (int)($newsCount/5) + 1;

		$template = "news/index.php";
		$params = [
			"pageTitle" => "News List",
			"newsList" => $newsList,
			"newsCount" => $newsCount,
			"pages" => $pages,
			"page" => $page,
		];
		$this->render($template, $params);

		return true;
	}

	public function actionView($id)
	{
		if ($id) {
			$newsItem = News::getItemById($id);
		}

		if (!$newsItem) {
			$domain = $_SERVER['HTTP_HOST'];
			header("Location: http://$domain/not-found");
			exit;
		}

		$template = "news/view.php";
		$params = [
			"pageTitle" => "News View",
			"newsItem" => $newsItem,
		];
		$this->render($template, $params);

		return true;
	}

	public function actionError404()
	{

		$template = "404.php";
		$params = [
			"pageTitle" => "Error 404",
		];
		$this->render($template, $params);

		return true;
	}

	public function render($template, $params)
	{
		extract($params, EXTR_OVERWRITE);

		ob_start();
		require_once(ROOT.'/views/'.$template);
		$content = ob_get_contents();
		ob_end_clean();

		require_once(ROOT.'/views/news/layout.php');
	}
}