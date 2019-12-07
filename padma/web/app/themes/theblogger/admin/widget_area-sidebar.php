<?php

	function theblogger_sidebar()
	{
		if (! is_404())
		{
			?>
				<div id="secondary" class="widget-area sidebar" role="complementary">
				    <div class="sidebar-wrap">
						<div class="sidebar-content">
							<?php
								if (is_page())
								{
									$sidebar_individual = get_option('theblogger_select_page_sidebar' . '__' . get_the_ID(), 'No Sidebar');
									dynamic_sidebar($sidebar_individual); // Individual Page sidebar. (Default and Custom page templates)
								}
								elseif (is_post_type_archive('product') || is_tax('product_cat') || is_singular('product'))
								{
									$shop_page_id       = get_option('woocommerce_shop_page_id');
									$sidebar_individual = get_option('theblogger_select_page_sidebar' . '__' . $shop_page_id, 'No Sidebar');
									dynamic_sidebar($sidebar_individual); // Individual Shop sidebar. (WooCommerce)
								}
								elseif (is_tax('portfolio-category'))
								{
									dynamic_sidebar('theblogger_sidebar_15'); // Global Portfolio sidebar.
								}
								elseif (is_singular('portfolio'))
								{
									$sidebar_individual = get_option('theblogger_select_page_sidebar' . '__' . get_the_ID(), 'inherit');
									
									if ($sidebar_individual == 'inherit')
									{
										dynamic_sidebar('theblogger_sidebar_15'); // Global Portfolio sidebar.
									}
									else
									{
										if ($sidebar_individual != 'No Sidebar')
										{
											dynamic_sidebar($sidebar_individual); // Individual Portfolio Post sidebar.
										}
									}
								}
								elseif (is_singular('lp_course'))
								{
									$sidebar_individual = get_option('theblogger_select_page_sidebar' . '__' . get_the_ID(), 'No Sidebar');
									dynamic_sidebar($sidebar_individual); // Individual Course Post sidebar. (LearnPress)
								}
								elseif (is_singular('post'))
								{
									$sidebar_individual = get_option('theblogger_select_page_sidebar' . '__' . get_the_ID(), 'inherit');
									
									if ($sidebar_individual == 'inherit')
									{
										if (is_active_sidebar('theblogger_sidebar_2'))
										{
											dynamic_sidebar('theblogger_sidebar_2'); // Global Post sidebar.
										}
										else
										{
											dynamic_sidebar('theblogger_sidebar_1'); // Global Blog sidebar.
										}
									}
									else
									{
										if ($sidebar_individual != 'No Sidebar')
										{
											dynamic_sidebar($sidebar_individual); // Individual Post sidebar.
										}
									}
								}
								else
								{
									dynamic_sidebar('theblogger_sidebar_1'); // Global Blog sidebar.
								}
							?>
						</div> <!-- .sidebar-content -->
					</div> <!-- .sidebar-wrap -->
				</div> <!-- #secondary .widget-area .sidebar -->
			<?php
		}
	}


/* ============================================================================================================================================= */


	function theblogger_sidebar_yes_no()
	{
		global $theblogger_sidebar;
		$theblogger_sidebar = 'with-sidebar';
		
		if (isset($_GET['sidebar']))
		{
			if ($_GET['sidebar'] == 'no')
			{
				$theblogger_sidebar = "";
			}
		}
		else
		{
			if (is_singular('portfolio'))
			{
				$sidebar_global_portfolio_post = get_theme_mod('theblogger_setting_sidebar_portfolio_post', 'No');
				$sidebar_individual            = get_option('theblogger_select_page_sidebar' . '__' . get_the_ID(), 'inherit');
				
				if ((($sidebar_global_portfolio_post != 'Yes') && ($sidebar_individual == 'inherit')) || ($sidebar_individual == 'No Sidebar'))
				{
					$theblogger_sidebar = "";
				}
			}
			elseif (is_singular('lp_course'))
			{
				$sidebar_individual = get_option('theblogger_select_page_sidebar' . '__' . get_the_ID(), 'No Sidebar');
				
				if ($sidebar_individual == 'No Sidebar')
				{
					$theblogger_sidebar = "";
				}
			}
			elseif (is_single())
			{
				$sidebar_global_blog_post = get_theme_mod('theblogger_setting_sidebar_post', 'Yes');
				$sidebar_individual       = get_option('theblogger_select_page_sidebar' . '__' . get_the_ID(), 'inherit');
				
				if ((($sidebar_global_blog_post == 'No') && ($sidebar_individual == 'inherit')) || ($sidebar_individual == 'No Sidebar'))
				{
					$theblogger_sidebar = "";
				}
			}
			else
			{
				if (is_category() || is_tag() || is_author() || is_date() || is_search())
				{
					$sidebar_archive = get_theme_mod('theblogger_setting_sidebar_archive', 'No');
					
					if ($sidebar_archive != 'Yes')
					{
						$theblogger_sidebar = "";
					}
				}
				else
				{
					$sidebar_blog = get_theme_mod('theblogger_setting_sidebar_blog', 'Yes');
					
					if ($sidebar_blog == 'No')
					{
						$theblogger_sidebar = "";
					}
				}
			}
		}
	}


/* ============================================================================================================================================= */


	function theblogger_singular_sidebar($echo = "")
	{
		global $theblogger_sidebar;
		theblogger_sidebar_yes_no();
		
		$layout_class  = 'layout-fixed';
		$sidebar_class = "";
		$page_sidebar  = get_option('theblogger_select_page_sidebar' . '__' . get_the_ID(), 'No Sidebar');
		
		if ($page_sidebar != 'No Sidebar')
		{
			$layout_class  = 'layout-medium';
			$sidebar_class = 'with-sidebar';
		}
		elseif (is_singular('lp_course'))
		{
			$layout_class = 'layout-medium';
		}
		else
		{
			$archive_layout = theblogger_archive_layout();
			
			if ($archive_layout == 'Other')
			{
				$layout_class = 'layout-medium';
			}
		}
		
		if ($echo == 'class-layout')
		{
			if (is_singular('page') || is_post_type_archive() || is_singular('lp_course') || is_tax('course_category'))
			{
				echo esc_attr($layout_class);
			}
			else
			{
				if ($theblogger_sidebar != "")
				{
					echo 'layout-medium';
				}
				else
				{
					echo 'layout-fixed';
				}
			}
		}
		elseif ($echo == 'class-sidebar')
		{
			if (is_singular('page') || is_post_type_archive())
			{
				echo esc_attr($sidebar_class);
			}
			else
			{
				echo esc_attr($theblogger_sidebar);
			}
		}
		elseif ($echo == 'html-sidebar')
		{
			if (is_singular('page') || is_post_type_archive())
			{
				if ($page_sidebar != 'No Sidebar')
				{
					theblogger_sidebar();
				}
			}
			else
			{
				if ($theblogger_sidebar != "")
				{
					theblogger_sidebar();
				}
			}
		}
	}

?>