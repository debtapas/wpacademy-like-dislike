<?php
	function wpac_settings_page_html(){
			if (!is_admin()) {
				return;
			}
			?>
				<div class="wrap">
					<h1 style="color:red"><?= esc_html(get_admin_page_title()); ?></h1>
					<form action="options.php" method="post">
						<?php
							settings_fields('wpac-settings');
							do_settings_sections('wpac-settings');
							submit_button('Save Changes');
						?>
					</form>
				</div>
			<?php
		}

		add_action('admin_init', 'wpac_settings_page_html');

		// For top Level Administrative Menu
		function wpac_register_menu_page(){
			add_menu_page('WPAC like System', 'WPAC Setting', 'manage_options', 'wpac-settings', 'wpac_settings_page_html', 'dashicons-thumbs-up', 30); 
				//page_title, menu_title, capability, menu_slug, function, icon_url, position
		}
		add_action('admin_menu', 'wpac_register_menu_page');

		function wpac_plugin_settings(){
			//Add a Setting #
			register_setting(
				'wpac-settings',//string $option_group
			    'wpac_like_btn_label'//string $option_name/id
			    //callable $sanitize_callback = ''
			);

			register_setting(
				'wpac-settings',//string $option_group
			    'wpac_dislike_btn_label'//string $option_name/id
			    //callable $sanitize_callback = ''
			);

			//Add a Section #
			add_settings_section(
			    'wpac_label_settings_section', //string $id
			    'WPAC Button labels', //string $title
			    'wpac_plugin_settings_section_cb', //callable $callback
			    'wpac-settings' //string $page
			);

			//Add a like label_settings Field #
			add_settings_field(
			    'wpac_like_label_field', //string $id,
			    'Like Button Label', //string $title,
			    'wpac_like_label_field_cb', //callable $callback,
			    'wpac-settings', //string $page,
			    'wpac_label_settings_section' //string $section = 'default',
			    //array $args = []
			);

			//Add a dislike label_settings Field #
			add_settings_field(
			    'wpac_dislike_label_field', //string $id,
			    'Dislike Button Label', //string $title,
			    'wpac_dislike_label_field_cb', //callable $callback,
			    'wpac-settings', //string $page,
			    'wpac_label_settings_section' //string $section = 'default',
			    //array $args = []
			);
		}

		add_action('admin_init', 'wpac_plugin_settings');

		function wpac_plugin_settings_section_cb(){
			echo '<p>Define Button Labels</p>';
		}

		function wpac_like_label_field_cb(){
			// get the value of the setting we've registered with register_setting()
		    $setting = get_option('wpac_like_btn_label');
		    // output the field
		    ?>
		    <input type="text" name="wpac_like_btn_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
		    <?php
		}

		function wpac_dislike_label_field_cb(){
			// get the value of the setting we've registered with register_setting()
		    $setting = get_option('wpac_dislike_btn_label');
		    // output the field
		    ?>
		    <input type="text" name="wpac_dislike_btn_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
		    <?php
		}