<?php

include_once ROOT.'/models/News.php';

class NewsController
{
	public function actionIndex($page)
	{
		$newsList = News::getNewsList($page);
		$newsCount = News::getNewsCount();
		$pages = (int)($newsCount/5) + 1;

		require_once(ROOT.'/views/news/index.php');

		return true;
	}

	public function actionView($id)
	{
		if ($id) {
			$newsItem = News::getNewsItemById($id);
		}

		require_once(ROOT.'/views/news/view.php');

		return true;
	}

	/**
	 * Returns true/false if current page is equal to iteration page (used in pagination generation)
	 * @param $page
	 * @param $i
	 * @return bool
	 */
	private function isPageActive($page, $i) {
		return ( (int)$page === (int)$i ) || !$page;
	}

	/**
	 * Returns pagination button class
	 * @param $page
	 * @param $i
	 * @return string
	 */
	public function getButtonClass($page, $i) {
		$activeClass = $this->isPageActive($page, $i) ? 'active' : '';
		return "news__page-btn $activeClass";
	}
}