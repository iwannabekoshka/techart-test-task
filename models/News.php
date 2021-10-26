<?php

class News
{
	/**
	 * Returns single news item with current id
	 * @param integer $id
	 */
	public static function getItemById($id)
	{
		$id = (int)$id;

		if ($id) {
			$db = Database::getConnection();

			$result = $db->prepare("SELECT * FROM news WHERE id = :id");
			$result->bindParam(':id', $id, PDO::PARAM_INT);
			$result->execute();


			// Вывод данных в формате ['COLUMN_NAME' => 'VALUE']
			$result->setFetchMode(PDO::FETCH_ASSOC);

			$newsItem = $result->fetch();

			return $newsItem;
		}
	}

	/**
	 * Returns an array of news items limited by offset
	 * @param $offset
	 * @return array
	 */
	public static function getList($offset, $limit)
	{
		$db = Database::getConnection();

		$newsList = [];

		$result = $db->prepare("
								SELECT * 
								FROM news 
								ORDER BY idate DESC 
								LIMIT :limit 
								OFFSET :offset");
		$result->bindParam(':offset', $offset, PDO::PARAM_INT);
		$result->bindParam(':limit', $limit, PDO::PARAM_INT);
		$result->execute();

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
	public static function getCount() {
		$db = Database::getConnection();

		$number_of_rows = $db->query('SELECT COUNT(*) FROM news')->fetchColumn();

		return $number_of_rows;
	}
}
