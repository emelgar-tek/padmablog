<?php

	function theblogger_excerpt_length($length)
	{
		$layout = 'Regular';
		
		if (isset($_GET['layout']))
		{
			$layout = $_GET['layout'];
		}
		else
		{
			$layout = theblogger_archive_layout();
		}
		
		if (($layout == 'Regular') || ($layout == 'regular'))
		{
			return get_theme_mod('theblogger_setting_excerpt_length', '65');
		}
		else
		{
			return get_theme_mod('theblogger_setting_excerpt_length_layout_grid', '35');
		}
	}
	
	add_filter('excerpt_length', 'theblogger_excerpt_length', 999);


/* ============================================================================================================================================= */


	function theblogger_read_more_link()
	{
		return '<p class="more"><a class="more-link" href="' . esc_url(get_permalink()) . '">' . esc_html__('Read More', 'theblogger') . '</a></p>';
	}
	
	add_filter('the_content_more_link', 'theblogger_read_more_link');
	
	
	function theblogger_excerpt_more($more)
	{
		return '... ' . theblogger_read_more_link();
	}
	
	add_filter('excerpt_more', 'theblogger_excerpt_more');


/* ============================================================================================================================================= */


	function theblogger_content()
	{
		if (is_home() || is_archive() || is_search()) // Archive content.
		{
			if (! has_post_format('chat'))
			{
				if (has_excerpt())
				{
					the_excerpt();
					
					echo theblogger_read_more_link();
				}
				else
				{
					$automatic_excerpt = get_theme_mod('theblogger_setting_automatic_excerpt', 'standard'); // Regular archives.
					
					if (isset($_GET['layout']))
					{
						if ($_GET['layout'] != 'regular')
						{
							$automatic_excerpt = 'Yes'; // Grid, List, Circles archives.
						}
					}
					else
					{
						$layout = theblogger_archive_layout();
						
						if ($layout == 'Other')
						{
							$automatic_excerpt = 'No'; // Other archives.
						}
						elseif ($layout != 'Regular')
						{
							$automatic_excerpt = 'Yes'; // Grid, List, Circles archives.
						}
					}
					
					if ($automatic_excerpt == 'Yes')
					{
						the_excerpt(); // All post formats.
					}
					elseif ($automatic_excerpt == 'standard')
					{
						$format = get_post_format();
						
						if ($format == false)
						{
							the_excerpt(); // Standard post format.
						}
						else
						{
							the_content(); // Other post formats.
						}
					}
					else
					{
						the_content(); // All post formats.
					}
				}
			}
		}
		else
		{
			the_content(); // Single content.
		}
		
		wp_link_pages(
			array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'theblogger') . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>'
			)
		);
	}

?>