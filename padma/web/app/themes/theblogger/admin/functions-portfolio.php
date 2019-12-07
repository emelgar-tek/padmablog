<?php

	// For Portfolio Page template and Portfolio Category pages.
	
	function theblogger_portfolio_page_layout()
	{
		$sidebar = "";
		
		if (is_page_template('page_template-portfolio.php'))
		{
			$sidebar = get_option('theblogger_select_page_sidebar' . '__' . get_the_ID(), 'No Sidebar'); // Portfolio page sidebar.
		}
		else
		{
			$sidebar = get_theme_mod('theblogger_setting_sidebar_portfolio_category', 'No'); // Portfolio category sidebar.
		}
		
		$page_layout = 'layout-medium';
		$page_layout = get_theme_mod('theblogger_setting_portfolio_page_layout', 'layout-medium');
		
		if (($page_layout == 'layout-fixed') && (($sidebar == 'Yes') || ($sidebar != 'No Sidebar')))
		{
			$page_layout = 'layout-medium';
		}
		
		echo esc_attr($page_layout);
	}


/* ============================================================================================================================================= */

	
	// For single portfolio posts.
	
	function theblogger_portfolio_item__short_description()
	{
		if (has_excerpt())
		{
			?>
				<p>
					<?php
						echo get_the_excerpt();
					?>
				</p>
			<?php
		}
	}
	
	
	function theblogger_portfolio_item__feat_img($linked_url = "")
	{
		if (! empty($linked_url))
		{
			$image_big = $linked_url;
			
			?>
				<figure class="wp-caption aligncenter">
					<a href="<?php echo esc_url($image_big); ?>">
						<?php
							the_post_thumbnail('theblogger_image_size_7');
						?>
					</a>
					<?php
						if (has_excerpt())
						{
							?>
								<figcaption class="wp-caption-text">
									<?php
										echo get_the_excerpt();
									?>
								</figcaption>
							<?php
						}
					?>
				</figure>
			<?php
		}
		else
		{
			if (has_post_thumbnail())
			{
				?>
					<p>
						<?php
							the_post_thumbnail('theblogger_image_size_7');
						?>
					</p>
				<?php
			}
		}
	}
	
	
	function theblogger_portfolio_item__format_image()
	{
		if (has_post_thumbnail())
		{
			$image_big 				 = "";
			$feat_img_id 			 = get_post_thumbnail_id();
			$image_big_width_cropped = wp_get_attachment_image_src($feat_img_id, 'theblogger_image_size_7'); // magnific-popup-width
			
			if ($image_big_width_cropped[1] > $image_big_width_cropped[2])
			{
				$image_big = $image_big_width_cropped[0];
			}
			else
			{
				$image_big_height_cropped = wp_get_attachment_image_src($feat_img_id, 'theblogger_image_size_8'); // magnific-popup-height
				$image_big 				  = $image_big_height_cropped[0];
			}
			
			theblogger_portfolio_item__feat_img($linked_url = $image_big);
		}
	}
	
	
	function theblogger_portfolio_item__format_link()
	{
		$direct_url = stripcslashes(get_option(get_the_ID() . 'theblogger_featured_video_url'));
		
		if (! empty($direct_url))
		{
			$new_tab = get_option(get_the_ID() . 'theblogger_featured_video_url__new_tab', true);
			
			?>
				<p>
					<a class="button" <?php if ($new_tab != false) { echo 'target="_blank"'; } ?> href="<?php echo esc_url($direct_url); ?>">
						<?php
							esc_html_e('Go To Link', 'theblogger');
						?>
					</a>
				</p>
			<?php
		}
	}
	
	
	function theblogger_portfolio_item__format_audio_video()
	{
		$browser_address_url = stripcslashes(get_option(get_the_ID() . 'theblogger_featured_video_url'));
		
		if (! empty($browser_address_url))
		{
			echo theblogger_iframe_from_xml($browser_address_url);
		}
	}
	
	
	function theblogger_portfolio_item__format_chooser()
	{
		if (is_singular('portfolio'))
		{
			if (has_post_format('audio') || has_post_format('video'))
			{
				theblogger_portfolio_item__format_audio_video();
				theblogger_portfolio_item__short_description();
			}
			elseif (has_post_format('link'))
			{
				theblogger_portfolio_item__format_link();
				theblogger_portfolio_item__short_description();
				theblogger_portfolio_item__feat_img();
			}
			elseif (has_post_format('image'))
			{
				theblogger_portfolio_item__format_image();
			}
			elseif (has_post_format('gallery'))
			{
				theblogger_portfolio_item__short_description();
			}
		}
	}


/* ============================================================================================================================================= */


	function theblogger_single_portfolio_meta()
	{
		if (is_singular('portfolio'))
		{
			?>
				<div class="entry-meta">
					<?php
						theblogger_meta_like();
						theblogger_meta_share();
					?>
				</div> <!-- .entry-meta -->
			<?php
		}
	}

?>