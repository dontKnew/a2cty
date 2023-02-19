<?= $this->extend("app") ?>
<?= $this->section("user-body") ?>
<section id="content_area">
    <div class="clearfix wrapper main_content_area">

        <div class="clearfix main_content floatleft">

            <div class="clearfix content">

                <h1><?=$service['escort_title']?></h1>
                <div class="clearfix post-meta">
                    <p><span><i class="fa fa-list-alt"></i> <?=$service['category_name']?></span> <span><i class="fa fa-clock-o"></i> <?=date("D d-m-Y", strtotime($service['created_at']))?></span> <span><i class="fa fa-eye"></i> 1055K views</span> <span></p>
                </div>

                <p>
                <div class="rectangle_large aligncenter" style="float:right; margin-left:15px">
                    <img class="box-shadow" style="height:100%" src="<?=base_url("frontend/images/escort")."/".$service['thumbnail_image']?>" alt="<?=$service['escort_title']?>" />
                </div>
                <span class="text-justify"><?=$service['description']?></span>
                </p>

            </div>


            <div class="more_themes">
                <h2>Related Post <i class="fa fa-thumbs-o-up"></i></h2>
                <div class="more_themes_container">
                    <?php foreach($related_service as $b): ?>
                        <div class="single_more_themes floatleft">
                            <img src="<?=base_url("frontend/images/escort")."/".$b['thumbnail_image']?>" alt="<?=$b['escort_title']?>"/>
                            <a href=""><h2><?=$b['escort_title']?></h2></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
        <div class="clearfix sidebar_container floatright">
            <div class="clearfix sidebar">
                <div class="clearfix single_sidebar">
                    <div class="popular_post">
                        <div class="sidebar_title"><h2>Most Popular</h2></div>
                        <ul>
                            <?php foreach ($services as $pb) : ?>
                                <li><a href="<?=base_url()."/".$pb['url']?>" title="<?=$pb['page_title']?>"><?=$pb['escort_title']?> </a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="clearfix single_sidebar category_items">
                    <?php require_once ("include/navigation_link.php") ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>