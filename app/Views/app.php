
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <title>A2ZCty</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Oswald Font -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/frontend/css/tooltipster.css" />
    <!-- home slider-->
    <link href="<?=base_url()?>/frontend/css/pgwslider.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url()?>/frontend/css/font-awesome.min.css">
    <link href="<?=base_url()?>/frontend/style.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>/frontend/responsive.css" rel="stylesheet" media="screen">
    <?= $this->renderSection("user-style")?>
    <style>
        .text-justify >p {
            text-align: justify !important;
        }
        .text-center {
            text-align: center;
        }
        .box-shadow {
            border-radius: 9px;
            box-shadow: -2px 2px 8px 2px #c7c7c7;
        }
        .alert {
            font-weight: bolder;
            color: green;
            text-align: center;
            background: #00800057;
            margin-top: 20px;
            font-size: 20px;
            padding: 10px;
        }

    </style>
    <!--faqs style-->
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
    <!--end faqs style-->
</head>

<body>
<section id="header_area">
    <div class="wrapper header">
        <div class="clearfix header_top">
            <div class="clearfix logo floatleft">
                <a href=""><h1><span>A2Z</span> CITY</h1></a>
            </div>
            <div class="clearfix search floatright">
                <form method="get" action="<?=base_url()?>">
                    <input type="text" name="filter" placeholder="Search"/>
                    <input type="submit" />
                </form>
            </div>
        </div>
        <div class="header_bottom">
            <nav>
                <ul id="nav">
                    <li><a href="<?=base_url()?>">Home</a></li>
                    <li><a href="<?=base_url('about')?>">About us</a></li>
                    <li><a href="<?=base_url('rates')?>">Rates</a></li>
                    <li><a href="<?=base_url('services')?>">Service</a></li>
                    <li><a href="<?=base_url('blogs')?>">Blogs</a></li>
                    <li><a href="<?=base_url('faqs')?>">FAQs</a></li>
                    <li><a href="<?=base_url('contact-us')?>">Contact</a></li>

                </ul>
            </nav>
        </div>
    </div>
</section>

<?= $this->renderSection('user-body') ?>


<?php if("/index.php/faqs"!==$_SERVER['PHP_SELF']): ?>
<div class="more_themes">
    <h2 class="text-center">Frequently Asked Questions <i class="fa fa-arrow-circle-down"></i></h2>
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
</div>
<?PHP endif ;?>

<!--end faqs-->
<section id="footer_top_area">
    <div class="clearfix wrapper footer_top">
        <div class="clearfix footer_top_container">
            <div class="clearfix single_footer_top floatleft">
                <h2>About A2ZCTY</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <a href="">Lorem Ipsum has been the industry</a> standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>

            <div class="clearfix single_footer_top floatright">
                <h2>Usefull Links</h2>
                <ul>
                    <li><a href="<?=base_url()?>">Home</a></li>
                    <li><a href="<?=base_url('about')?>">About us</a></li>
                    <li><a href="<?=base_url('rates')?>">Rates</a></li>
                    <li><a href="<?=base_url('service')?>">Service</a></li>
                    <li><a href="<?=base_url('blogs')?>">Blogs</a></li>
                    <li><a href="<?=base_url('faqs')?>">FAQs</a></li>
                    <li><a href="<?=base_url('contact-us')?>">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="footer_bottom_area">
    <div class="clearfix wrapper footer_bottom">
        <div class="clearfix copyright floatleft">
            <p> Copyright &copy; All rights reserved by <span>a2zcty</span></p>
        </div>
        <div class="clearfix social floatright">
            <ul>
                <li><a class="tooltip" title="Facebook" href=""><i class="fa fa-facebook-square"></i></a></li>
                <li><a class="tooltip" title="Twitter" href=""><i class="fa fa-twitter-square"></i></a></li>
                <li><a class="tooltip" title="Google+" href=""><i class="fa fa-google-plus-square"></i></a></li>
                <li><a class="tooltip" title="LinkedIn" href=""><i class="fa fa-linkedin-square"></i></a></li>
                <li><a class="tooltip" title="tumblr" href=""><i class="fa fa-tumblr-square"></i></a></li>
                <li><a class="tooltip" title="Pinterest" href=""><i class="fa fa-pinterest-square"></i></a></li>
                <li><a class="tooltip" title="RSS Feed" href=""><i class="fa fa-rss-square"></i></a></li>
                <li><a class="tooltip" title="Sitemap" href=""><i class="fa fa-sitemap"></i> </a></li>
            </ul>
        </div>

    </div>
</section>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.0.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>/frontend/js/jquery.tooltipster.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.tooltip').tooltipster();
    });
</script>
<script type="text/javascript" src="<?=base_url()?>/frontend/js/selectnav.min.js"></script>
<script type="text/javascript">
    selectnav('nav', {
        label: '-Navigation-',
        nested: true,
        indent: '-'
    });
</script>
<script src="<?=base_url()?>/frontend/js/pgwslider.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.pgwSlider').pgwSlider({

            intervalDuration: 5000

        });
    });
</script>
<script type="text/javascript" src="<?=base_url()?>/frontend/js/placeholder_support_IE.js"></script>

<!--faqs script-->
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
<!--end faqs script-->
<?= $this->renderSection("user-script")?>
</body>
</html>


