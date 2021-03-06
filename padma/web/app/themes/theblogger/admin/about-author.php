<?php

	function theblogger_about_author()
	{
		$theblogger_about_the_author_module = get_theme_mod('theblogger_setting_author_info_box', 'Yes');
		
		if (($theblogger_about_the_author_module != 'No') && (is_singular('post')))
		{
			?>
				<aside class="about-author">
					<h3 class="widget-title">
						<span>
							<?php
								esc_html_e('Written By', 'theblogger');
							?>
						</span>
					</h3>
					
					<div class="author-bio">
						<div class="author-img">
							<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
								<?php
									echo get_avatar(get_the_author_meta('user_email'), 300, "", get_the_author_meta('display_name'));
								?>
							</a>
						</div>
						<div class="author-info">
							<h4 class="author-name">
								<?php
									the_author();
								?>
							</h4>
							<p>
								<?php	
									echo get_the_author_meta('description');
								?>
							</p>
							<?php
								dynamic_sidebar('theblogger_sidebar_8');
							?>
						</div>
					</div>
				</aside>
			<?php
		}
	}

?>