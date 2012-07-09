<?php
$page_config['base_url'] = current_url().'?z=1';
$page_config['total_rows'] = $apps_count;
$page_config['per_page'] = DEFAULT_PAGE_NUM;
$page_config['uri_segment'] = 4;

$page_config['full_tag_open'] = '<div class="pagination" style="margin-top:10px"><ul class="pages">';
$page_config['full_tag_close'] = '</ul></div>';

$page_config['first_link'] = '首页';
$page_config['first_tag_open'] = '<li class="prev">';
$page_config['first_tag_close'] = '</li>';

$page_config['last_link'] = '末页';
$page_config['last_tag_open'] = '<li class="next">';
$page_config['last_tag_close'] = '</li>';

$page_config['next_link'] = '下一页';
$page_config['next_tag_open'] = '<li class="next">';
$page_config['next_tag_close'] = '</li>';

$page_config['prev_link'] = '上一页';
$page_config['prev_tag_open'] = '<li class="prev">';
$page_config['prev_tag_close'] = '</li>';

$page_config['cur_tag_open'] = '<li><a class="active" href="javascript:;">';
$page_config['cur_tag_close'] = '</a></li>';

$page_config['num_tag_open'] = '<li>';
$page_config['num_tag_close'] = '</li>';

$this->pagination->initialize($page_config);
echo $this->pagination->create_links();
?>
