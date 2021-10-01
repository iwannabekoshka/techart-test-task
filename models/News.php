<?php

class News
{
	/**
	 * Returns single news item with current id
	 * @param integer $id
	 */
	public static function getNewsItemById($id)
	{
		$id = (int)$id;

		if ($id) {
			$db = Database::getConnection();

			$result = $db->query("SELECT * FROM news WHERE id = $id");

			// Вывод данных в формате ['COLUMN_NAME' => 'VALUE']
			$result->setFetchMode(PDO::FETCH_ASSOC);

			$newsItem = $result->fetch();

			return $newsItem;
		}
	}

	/**
	 * Returns an array of news items limited by page
	 * @param $page
	 * @return array
	 */
	public static function getNewsList($page)
	{
		$db = Database::getConnection();

		$newsList = [];

		if ($page) {
			$offset = ( (int)$page - 1 ) * 5;
		} else {
			$offset = 0;
		}

		$result = $db->query("
								SELECT * 
								FROM news 
								ORDER BY idate DESC 
								LIMIT 5
								OFFSET $offset");

		while ($row = $result->fetch()) {
			array_push($newsList, [
				'id' => $row['id'],
				'idate' => $row['idate'],
				'title' => $row['title'],
				'announce' => $row['announce'],
			]);
		}

		return $newsList;
	}

	/**
	 * Returns overall count of rows
	 * @return mixed
	 */
	public static function getNewsCount() {
		$db = Database::getConnection();

		$result = $db->query("SELECT * FROM news");
		$count = count($result->fetchAll());

		return $count;
	}
}
