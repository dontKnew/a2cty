<?= $this->extend("app") ?>
<?= $this->section("user-body") ?>
<section id="content_area">
    <div class="clearfix wrapper main_content_area">

        <div class="clearfix main_content floatleft">


            <div class="clearfix content">
                <div class="content_title">
                    <h2>
                    <?php switch ($page_type){
                        case 'null':
                            echo "Escort Services";
                            break;
                        case 'category':
                            if(isset($services[0]['category_name'])){
                                echo 'Best '.$services[0]['category_name']." Services";
                            }else {
                                echo 'Escort Services';
                            }
                        break;
                        case 'city':
                        if(isset($services[0]['category_name'])){
                            echo 'Service in '.$services[0]['city_name'];
                        }else {
                            echo 'Escort Services';
                        }
                        break;
                    } ?>

                    </h2>
                </div>

                <div class="clearfix single_work_container">
                    <?php if(is_array($services) && count($services)!==0): ?>
                        <?php foreach ($services as $escort): ?>
                            <div class="clearfix single_work">
                                <a href="<?=base_url()?>/<?=$escort['url']?>" title="<?=$escort['page_title']?>">
                                    <img class="img_bottom" src="frontend/images/escort/<?=$escort['thumbnail_image']?>" alt="<?=$escort['escort_title']?>"/>
                                    <h2><?=$escort['escort_title']?></h2>
                                    <p class="caption"><?=word_limiter(strip_tags($escort['description']),20)?></p>
                                </a>
                            </div>
                        <?php endforeach; ?>
                        <div class="clearfix work_pagination">
                            <nav>
                                <a class="newer floatleft" href=""> < -- Newer Post</a>
                                <a class="older floatright" href="">Older Post -- ></a>
                            </nav>
                        </div>
                    <?php else: ?>
                    <div class="alert"> No Escort Service Found</div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <div class="clearfix sidebar_container floatright">
            <div class="clearfix sidebar">
                <div class="clearfix single_sidebar">
                    <?php require_once ("include/navigation_link.php") ?>
                </div>
                <div class="clearfix single_sidebar category_items">
                    <h2>Categories</h2>
                    <ul>
                        <?php foreach($category as $rp): ?>
                            <li class="cat-item">
                                <a href="<?=base_url()."/".$rp['url']?>" title="<?=$rp['page_title']?>"><?=$rp['name']?></a>(<?=$rp['service']?>)
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="clearfix single_sidebar">
                    <h2>Recent Post</h2>
                    <ul>
                        <?php foreach($recent_post as $rp): ?>
                            <li><a href="<?=base_url()."/".$rp['url']?>" title="<?=$rp['page_title']?>"><?=$rp['escort_title']?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section("user-style") ?>
<style>
    .caption {
        font-weight: bold;
        text-shadow: 3px 2px 2px black;
    }
</style>
<?= $this->endSection() ?>

