const newsContainer = document.querySelector('.news');

async function getNews() {
	const url = './queries/getNews.php';
	try {
		const response = await fetch(url);
		return await response.json();
	} catch (error) {
		console.error(error);
	}
}
async function renderNews() {
	const news = await getNews();

	const html = news.map(renderNewsItem);

	newsContainer.insertAdjacentHTML('beforeend', html.join(''));
}
function renderNewsItem(newsItem) {
	const date = formatDateFromUnix(newsItem.date);

	return `
		<div class="news-item">
			<div class="news-item__header">
				<span class="news-item__date">${date}</span>
				<h3 class="news-item__title">${newsItem.title}</h3>
			</div>
			<div class="news-item__body">${newsItem.announce}</div>
		</div>
	`;
}
function formatDateFromUnix(unix) {
	const date = new Date(unix * 1000);

	const year = date.getFullYear();
	let month = date.getMonth() + 1; // 0 - December
	let day = date.getDate();

	if (month < 10) {
		month = '0' + month;
	}
	if (day < 10) {
		day = '0' + day;
	}

	return `${day}.${month}.${year}`;
}

renderNews();