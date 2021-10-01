<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>News View | php mvc first try</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
	<section class="section news">
		<h2 class='news__title'><?php echo $newsItem['title'] ?></h2>
		<div class='news__body'>
			<?php echo $newsItem['content'] ?>
		</div>
		<div class='news__footer'>
			<a href='/news'>Все новости >></a>
		</div>
	</section>
</div>

</body>
</html>
