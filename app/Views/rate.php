<?= $this->extend("app") ?>
<?= $this->section("user-body") ?>
<section id="content_area">
    <div class="clearfix wrapper main_content_area">

        <div class="clearfix main_content floatleft">

            <div class="clearfix content">
                <div class="content_title"><h2>RATES</h2></div>

                <div class="clearfix single_content">

                    <div class="clearfix post_detail">

                        <div class="clearfix post_excerpt">


                            <div class="slider"></div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="clearfix sidebar_container floatright">
            <div class="clearfix sidebar">
                <div class="clearfix single_sidebar">
                    <?php require_once ("include/navigation_link.php") ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>


<?= $this->section("user-style") ?>
<style>
    .verticle-scroll {
        height: 800px;
        overflow: auto;
    }
    /* Set the width and height of the scrollbar */
    .verticle-scroll::-webkit-scrollbar {
        width: 5px;
        height: 5px;
    }

    /* Set the background color of the scrollbar */
    .verticle-scroll::-webkit-scrollbar-track {
        background-color: black;
    }

    /* Set the color of the scrollbar thumb */
    .verticle-scroll::-webkit-scrollbar-thumb {
        background-color: #ffd500;
    }

    /* On hover, set the color of the scrollbar thumb */
    .verticle-scroll::-webkit-scrollbar-thumb:hover {
        background-color: #d6c159;
    }


</style>
<?= $this->endSection() ?>

<?= $this->section("user-script") ?>
<?= $this->endSection() ?>
