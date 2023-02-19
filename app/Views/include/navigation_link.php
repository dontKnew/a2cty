<div class="popular_post">
    <div class="sidebar_title"><h2>Top Navigation Menu</h2></div>
    <ul class="verticle-scroll">
        <?php foreach ($city_list as $city): ?>
            <li><a href="<?=$city['url']?>" title="<?=$city['page_title']?>">Escorts in <?=ucwords($city['name'])?></a></li>
        <?php endforeach; ?>
    </ul>
</div>