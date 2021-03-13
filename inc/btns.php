<?php

		function wpac_like_dislike_buttons($content){

			$like_btn_lebel = get_option('wpac_like_btn_label', 'Like');
			$dislike_btn_lebel = get_option('wpac_dislike_btn_label', 'Dislike');

			$like_btn_wrap = '<div class="wpac_wrap">';
			$like_btn = '<a href="javascript:;" class="wpac-btn like-btn">'.$like_btn_lebel.'</a>';	
			$dislike_btn = '<a href="javascript:;" class="wpac-btn dislike-btn">'.$dislike_btn_lebel.'</a>';
			$like_btn_wrap_end = '</div>';

			$content .= $like_btn_wrap;
			$content .= $like_btn;
			$content .= $dislike_btn;
			$content .= $like_btn_wrap_end;

			return $content;
		}
		add_filter('the_content', 'wpac_like_dislike_buttons');
	