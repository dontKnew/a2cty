<?= $this->extend("app") ?>
<?= $this->section("user-body") ?>
    <section id="content_area">
        <div class="clearfix wrapper main_content_area">

            <div class="clearfix main_content floatleft">

                <div class="clearfix content">
                    <div class="content_title"><h2>A2Z of Frequently Asked Questions</h2></div>

                    <div class="clearfix single_content">

                        <div class="clearfix post_detail">

                            <div class="clearfix post_excerpt">
                                <div class="faq-container">
                                    <?php foreach ($faqs_list as $faqs): ?>
                                    <div class="faq-question">
                                        <h2><?=$faqs['question']?></h2>
                                        <div class="faq-answer">
                                            <p><?=$faqs['answer']?></p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>


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


        .faq-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .faq-question {
            margin-bottom: 20px;
        }

        .faq-question h2 {
            margin: 0;
            padding: 10px 20px;
            background-color: #e1e1e1;
            color: #333;
            font-size: 16px;
            cursor: pointer;
        }

        .faq-answer {
            display: none;
            padding: 10px 20px;
            background-color: #f5f5f5;
            color: #333;
            font-size: 14px;
        }

        .slider {
            width: 100%;
            height: 10px;
            background-color: #f5f5f5;
            position: relative;
        }

        .slider-thumb {
            width: 30px;
            height: 30px;
            background-color: #333;
            border-radius: 50%;
            position: absolute;
            top: -10px;
            left: 0;
            cursor: pointer;
            z-index: 10;
        }


    </style>
<?= $this->endSection() ?>
<?= $this->section("user-script") ?>
<script>
    $(document).ready(function() {
        // Accordion
        $('.faq-question h2').click(function() {
            $(this).toggleClass('active');
            $(this).siblings('.faq-answer').slideToggle(200);
            $('.faq-question h2').not(this).removeClass('active');
            $('.faq-question h2').not(this).siblings('.faq-answer').slideUp(200);
        });

        // Slider
        var slider = $('.slider');
        var thumb = $('.slider-thumb');
        var sliderWidth = slider.width();
        var thumbWidth = thumb.width();

        thumb.draggable({
            axis: 'x',
            containment: 'parent',
            drag: function(event, ui) {
                var thumbPos = ui.position.left;
                var percent = thumbPos / (sliderWidth - thumbWidth);
                $('.faq-container').scrollLeft(percent * ($('.faq-container')[0].scrollWidth - sliderWidth));
            }
        });

        $('.faq-container').on('scroll', function() {
            var scrollLeft = $(this).scrollLeft();
            var scrollPercent = scrollLeft / ($('.faq-container')[0].scrollWidth - sliderWidth);
            thumb.css('left', (sliderWidth - thumbWidth) * scrollPercent);
        });
    });

</script>
<?= $this->endSection() ?>
