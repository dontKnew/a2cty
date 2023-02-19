<?= $this->extend("app") ?>
<?= $this->section("user-body") ?>
<section id="content_area">
    <div class="clearfix wrapper main_content_area">

        <div class="clearfix main_content floatleft">


            <div class="clearfix content">
                <div class="content_title"><h2>Our Blogs</h2></div>

                <div class="clearfix single_work_container">
                    <?php foreach ($blogs as $blog): ?>
                        <div class="clearfix single_work">
                            <a href="<?=base_url()."/blog/".$blog['url']?>" title="<?=$blog['page_title']?>">
                                <img class="img_bottom" src="<?=base_url("frontend/images/blog/".$blog['thumbnail_image'])?>" alt="<?=$blog['blog_title']?>"/>
                                <h2><?=$blog['blog_title']?></h2>
                                <p class="caption"><?=word_limiter(strip_tags($blog['description']),20)?></p>

                            </a>
                        </div>
                    <?php endforeach;?>

                    <div class="clearfix work_pagination">
                        <nav>
                            <a class="newer floatleft" href=""> < -- Newer Post</a>
                            <a class="older floatright" href="">Older Post -- ></a>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
        <div class="clearfix sidebar_container floatright">
            <div class="clearfix sidebar">
                <div class="clearfix single_sidebar">
                    <div class="clearfix single_sidebar">
                        <?php require_once ("include/navigation_link.php") ?>
                    </div>
                </div>
                <div class="clearfix single_sidebar">
                    <h2>Recent Post</h2>
                    <ul>
                        <?php foreach($recent_post as $rp): ?>
                            <li><a href="<?=base_url()."blog/".$rp['url']?>" title="<?=$rp['page_title']?>"><?=$rp['blog_title']?></a></li>
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

