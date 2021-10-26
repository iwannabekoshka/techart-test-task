<section class="section news">
<h2 class='news__title'>Новости</h2>
<div class="news__body">
	<?php foreach ($newsList as $newsItem): ?>
        <div class='news-item'>
            <div class='news-item__header'>
                <span class='news-item__date'><?php echo date('d.m.Y', $newsItem['idate']); ?></span>
                <h3 class='news-item__title'>
                    <a href='<?php echo '/news/'.$newsItem['id']; ?>'><?php echo $newsItem['title']; ?></a>
                </h3>
            </div>
            <div class='news-item__body'><?php echo $newsItem['announce']; ?></div>
        </div>
	<?php endforeach; ?>
</div>
<div class='news__footer'>
    <h3>Страницы:</h3>
    <div class='news__pages'>
        <?php for ($i=1; $i <= $pages; $i++): ?>
            <button class='news__page-btn
                <?php 
                    echo ( (int)$page === (int)$i ) ? 'active' : '';
                ?>
            '>
                <a href='<?php echo "/news/page-$i"; ?>'><?php echo $i ?></a>
            </button>
        <?php endfor; ?>
    </div>
</div>
</section>