<?= $this->extend("app") ?>
<?= $this->section("user-body") ?>
		<section id="content_area">
			<div class="clearfix wrapper main_content_area">
			
				<div class="clearfix main_content floatleft">
				
					
					<div class="clearfix content">
						
						<div class="contact_us">
						
							<h1>Contact us</h1>
							
							<p>Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a 
							ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class 
							aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos Sed non  mauris vitae erat consequat auctor eu in elit. Class 
							aptent taciti sociosqu</p>
							
							<form method="post" action="<?=base_url("contact-us")?>">
								<p><input type="text" class="wpcf7-text" name="name" placeholder="Full Name*" required/></p>
								<p><input type="text" class="wpcf7-email" name="email" placeholder="Email*"required/></p>
                                <p><input type="text" class="wpcf7-email" name="phone" placeholder="Phone No*"required/></p>
								<p><input type="text" class="wpcf7-text" name="subject" placeholder="Subject*"required/></p>
								<p><textarea class="wpcf7-textarea" name="message" placeholder="Message*" required></textarea></p>
                                <?php if(session()->has("msg")): ?>
                                    <?=session()->get('msg')?>
                                <?php endif; ?>
								<p><input type="Submit" class="wpcf7-submit" value="Submit"/></p>
							</form>
							
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

