<?php

class Router
{
	private $routes;

	public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}

	public function run()
	{
		$uri = $this->getURI();

		if ($uri == '') {
			$domain = $_SERVER['HTTP_HOST'];
			header("Location: http://$domain/news/");
			exit;
		}

		$pageNotFound = true;

		// Проверка наличия запроса в routes.php
		foreach ($this->routes as $uriPattern => $path) {
			if ( preg_match("~$uriPattern~", $uri) ) {
				$pageNotFound = false;

				// Внутренний маршрут controller/action/params
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);

				$segments = explode('/', $internalRoute);

				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);
				$actionName = 'action'.ucfirst(array_shift($segments));
				$parameters = $segments; // Оставшиеся части запроса

				$controllerFile = $this->getControllerFile($controllerName);
				if ( file_exists($controllerFile) ) {
					include_once($controllerFile);
				}

				$controllerObject = new $controllerName;

				// Вызывает метод $actionName у объекта $controllerObject с параметрами $parameters
				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);

				if ($result != null) {
					break;
				}
			}
		}

		if ($pageNotFound) {
			ErrorHandler::throwError404();
		}
	}

	/**
	 * Returns request string
	 * @return string
	 */
	private function getURI() {
		// Получение строки запроса
		if ( !empty($_SERVER['REQUEST_URI']) ) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	/**
	 * Returns controller file path
	 * @param $controllerName
	 * @return string
	 */
	private function getControllerFile($controllerName) {
		return ROOT . '/controllers/' . $controllerName . '.php';
	}
}