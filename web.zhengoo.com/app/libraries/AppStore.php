<?php 
/*~ class.AppStore.php
 | 
 |	
 |
 |---------------------------------------------
 |
 |
*/
class ZG_AppStore {
	/*
     |-----------------
     | ci 对象
     |-----------------
	 */
	private $_ci;
	/*
     |-----------------
     | 日志对象
     |-----------------
	 */
	private $_logger;
	/*
     |-----------------
     | 
     |-----------------
	 */
	private $_appDOM;
	/*
     |-----------------
     | 
     |-----------------
	 */
	private $_appURL;
	
	/*
     |-----------------
     | 
     |-----------------
	 */
	 private $_app_store_id =  0;
	 /*
     |-----------------
     | itunes lookup 
     |  app api url 
     |-----------------
	 */
     private $_app_lookup_url;
     /*
     |-----------------
     | itunes seach app
     | app api rul
     |-----------------
	 */
	 private $_app_seach_url;

	//------------------------------------------------------

	/**
	 *----------------------------
	 * 构造函数
	 * - 初始化 ci 对象
	 * _ 初始化 app store url
	 *----------------------------
	 */
	function __construct(){
		$this->_ci =& get_instance();
		$this->_logger = Logger::getLogger('AppStore');
		$this->_ci->load->config('appstore');
		$this->_app_lookup_url = $this->_ci->config->item('appstore_lookup_url_tpl');
		$this->_app_seach_url  = $this->_ci->config->item('appstore_serch_url_tpl');
	}

	//------------------------------------------------------

	/**
	 *----------------------------
	 * 获取该app编号
	 *----------------------------
	 * 
	 * @return Int 	app编号
	 */
	public function get_appstore_id(){
		return $this->_app_store_id;
	}

	//------------------------------------------------------

	/**
	 *----------------------------
	 * 按app首字母和页码获取该分类下app
	 * 列表数据
	 * - 抓取一页
	 *----------------------------
	 *
	 * @param url  			appstore分类链接(不包含参数)
	 * @param letter 		首字母
	 * @param page 			页码
	 * @param category_id   分类编号
	 * @return 当前全部app信息(包含名字,url,app_store_id, 首字母, 分类编号)
	 */
	public function getAppsByLetterAndPage($url, $letter, $page){
		$url = $url . '?mt=8&letter=' . $letter . '&page=' . $page;
		$this->logger->debug("AppStore 地址: ". $url);
		return $this->_get_appstore_list($url);
	}

	//------------------------------------------------------

	/**
	 *----------------------------
	 * 根据app详细页面url, 初始化该app信息
	 * - app 编号
	 *----------------------------
	 *
	 * @param app_store_url app详细页面url
	 * @return void
	 */
	private function _init_app_info($app_store_url){
		preg_match('/\/id([0-9]*)/', $app_store_url , $app_url_info);
		if(count($app_url_info) > 0){
			$this->_app_store_id = $app_url_info[1];
		}
		
	}

	//------------------------------------------------------

	/**
	 *----------------------------
	 * 获取app详细信息
	 *----------------------------
	 *
	 * @param id_or_url app编号或app网页地址
	 * @return array app信息
	 */
	public function get_app_info($id_or_url){
		if(is_numeric($id_or_url)){
			$this->_app_store_id = $id_or_url;
		}else{
			$this->_init_app_info($id_or_url);
		}
		if(!empty($this->_app_store_id)){
			$this->_ci->load->helper('date');
			$url = preg_replace('(#app_id#)', $this->_app_store_id, $this->_app_lookup_url);
			$result = $this->_build_app($url);
			return $result[0];
		}else{
			return NULL;
		}	
	}

	//------------------------------------------------------

	/**
	 *----------------------------
	 * 获取分类下热门应用
	 *----------------------------
	 *
	 * @param url app store url
	 * @return array  
	 */
	public function get_hot_apps($url) {
		return $this->_get_appstore_list($url, true);
	}

	//------------------------------------------------------

	/**
	 *----------------------------
	 * 获取分类下热门应用
	 *----------------------------
	 *
	 * @param url app store url
	 * @return array  
	 */
	public function seach_app($keyword){
		$this->_app_seach_url = preg_replace('(#keyword#)', $keyword, $this->_app_seach_url);
		return $this->_build_app($this->_app_seach_url);
	} 

	//------------------------------------------------------

	/**
	 *----------------------------
	 * - 判断是否还有下一页数据
	 *----------------------------
	 *
	 * @param app_store_url app详细页面url
	 * @return int  1 -- 无下一页, 0 -- 还有下一页
	 */
	public function is_next($cur_page){
		$pages = $this->_appDom->find('#selectedgenre ul.paginate li a');
		if($pages){
			foreach ($pages as $num) 
			{
				$page_num[] = $num->plaintext;
			}
			$page_num  = array_unique($page_num);
			$last_page = $page_num[count($page_num) - 1];
			if(!is_numeric($last_page)) $last_page = $page_num[count($page_num) - 2];
			if($cur_page == $last_page) return 1; else return 0;
		}else{
			return 1;
		}
	}

	//------------------------------------------------------

	/**
	 *----------------------------
	 * 通过app store api url 构建apps对象
	 * - api: 查看某个app
	 * - api: 搜索apps
	 *----------------------------
	 * 
	 * @param url string api链接
	 * @return array app对象数组
	 */
	private function _build_app($url) {
		$this->_ci->load->library('curl');
		$result = json_decode($this->_ci->curl->simple_get($url), true);
		if($result['resultCount'] > 0){
			$result_count = $result['resultCount'];
			for($i = 0 ; $i < $result_count; $i++){
				$app_info = $result['results'][$i];
				$this->_logger->info($app_info);
				$local_category = $this->_ci->config->item('local_category');
				$category = explode("|",$local_category[$app_info['primaryGenreId']]);
				$app['app_category_id']   = $category[1];
				$app['app_category_name'] = $category[0];
				$app['app_title']         = $app_info['trackName'];
				$app['app_store_id']      = $app_info['trackId'];
				$app['app_desc']          = $app_info['description'];
				$app['app_price']         = $app_info['price'];
				$app['app_size']          = $app_info['fileSizeBytes'];
				$app['app_version']       = $app_info['version'];
				$app['app_artist_id']     = $app_info['artistId'];
				$app['app_artist_name']   = $app_info['artistName'];
				$app['app_release_notes'] = $app_info['releaseNotes'];
				$app['app_game_center']   = $app_info['isGameCenterEnabled'];
				$app['app_release_notes'] = $app_info['releaseNotes'];
				$app['app_icon']          = $app_info['artworkUrl512'];
				$app['app_store_url']     = $app_info['trackViewUrl'];
				$app['iphone_screen']     = $app_info['screenshotUrls'];
				$app['ipad_screen']       = $app_info['ipadScreenshotUrls'];
				$app['app_language']	  = implode(',', $app_info['languageCodesISO2A']);
				$app['app_devices']		  = $this->_change_device($app_info['supportedDevices']);
				$app['app_status']		  = 1;
				if(isset($app_info['sellerUrl']) && $app_info['sellerUrl'] != 'http://') $app['app_official_web']  = $app_info['sellerUrl'];
				$dt = new DateTime($app_info['releaseDate']);
				$app['app_release_date'] = $dt->format('U');
				$apps[] = $app;
			}
			return $apps;
		}else{
			return NULL;
		}
	}

	//------------------------------------------------------

	/**
	 *----------------------------
	 * 获取url的app列表 包含:
	 * - app 名称
	 * - app 编号
	 * - app url
	 *----------------------------
	 *
	 * @param url app store url
	 * @return array  
	 */
	private function _get_appstore_list($url , $is_hot = false){
		$this->_ci->load->file(APPPATH.'third_party/simplehtmldom/simple_html_dom.php');
		$this->_appDom = file_get_html($url);
		$app_list = $this->_appDom->find('#selectedcontent li > a');
		foreach ($app_list as $list) {
			$herf = $list->getAttribute('href');
			$this->_init_app_info($herf);
			$app['app_title']         = $list->plaintext;
			$app['app_store_url']     = $herf;
			$app['app_store_id']      = $this->get_appstore_id();
			$app['app_hot']			  = $is_hot;			
			$apps[] = $app;
		}
		//$this->_logger->info($apps);
		return $apps;
	}

	//------------------------------------------------------

	/**
	 *----------------------------
	 * 将app store api接口返回的支持
	 * 设备转换成 (all/iPhone/iPad/iPodTouch)
	 *----------------------------
	 *
	 * @param devices app store api接口返回的设备数组
	 * @return string 
	 */
	private function _change_device($devices){
		$devices_str = implode(',', $devices);
		preg_match_all('/(all|iPhone|iPad|iPodTouch)/', $devices_str, $m);
		return implode(',', array_unique($m[0]));
	}

}
// end localhost AppStore.php