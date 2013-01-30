<?php 
	
	$sizes  = isset($sizes) ? $sizes : '';

	$config['base_url']             = '/'.$base_url.'?';
	$config['total_rows']           = $total_rows;
	$config['per_page']             = DEFAULT_PAGE_NUM;

	
	
	$config['full_tag_open']        = '<div class="pagination pagination-'.$sizes.' pagination-centered"><ul>';
	$config['full_tag_close']       = '</ul></div>';
	
	$config['first_link']           = FALSE;
	$config['first_tag_open']       = '<li>';
	$config['first_tag_close']      = '</li>';
	
	$config['last_link']            = FALSE;
	$config['last_tag_open']        = '<li>';
	$config['last_tag_close']       = '</li>';
	
	
	$config['prev_link']            = '← 上一页';
	$config['prev_tag_open']        = '<li>';
	$config['prev_tag_close']       = '</li>';
	$config['prev_first_tag_open']  = '<li class="disabled"><a href="javascript:;">';
	$config['prev_first_tag_close'] = '</a></li>';
	
	$config['next_link']            = '下一页 →';
	$config['next_tag_open']        = '<li>';
	$config['next_tag_close']       = '</li>';
	$config['next_last_tag_open']   = '<li class="disabled"><a href="javascript:;">';
	$config['next_last_tag_close']  = '</a></li>';
	
	
	$config['cur_tag_open']         = '<li class="active"><a href="javascript:;">';
	$config['cur_tag_close']        = '</a></li>';
	
	$config['num_tag_open']         = '<li>';
	$config['num_tag_close']        = '</li>';


	$this->pagination->initialize($config); 
	echo $this->pagination->create_links();
?>