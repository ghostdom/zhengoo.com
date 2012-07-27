<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['app_icons'] = array(
	'tu-shu'               => 'icon-book',
	'shang-ye'             => 'icon-eye-open',
	'mu-lu'                => 'icon-bookmark',
	'jiao-yu'              => 'icon-flag',
	'yu-le'                => 'icon-play',
	'cai-wu'               => 'icon-fire',
	'you-xi'               => 'icon-star',
	'jian-kang-jian-mei'   => 'icon-heart',
	'sheng-huo'            => 'icon-gift',
	'yi-liao'              => 'icon-plus',
	'yin-yue'              => 'icon-music',
	'dao-hang'             => 'icon-arrow-right',
	'xin-wen'              => 'icon-bookmark',
	'bao-kan-za-zhi'       => 'icon-th-large',
	'she-ying-yu-lu-xiang' => 'icon-facetime-video',
	'xiao-lv'              => 'icon-magnet',
	'can-kao'              => 'icon-tags',
	'she-jiao'             => 'icon-heart',
	'ti-yu'                => 'icon-user',
	'lv-xing'              => 'icon-plane',
	'gong-ju'              => ' icon-pencil',
	'tian-qi'              => 'icon-asterisk'
);
/*
| -------------------------------------------------------------------
|  分类别名(拼音) 所对应 app store的分类编号
| -------------------------------------------------------------------
| Prototype:
|
|  $config['app_store_category_ids'] = array('category_alias', app_category_id);
|
*/
$config['app_store_category_ids'] = array(
	'tu-shu'               => 6018,
	'shang-ye'             => 6000,
	'mu-lu'                => 6022,
	'jiao-yu'              => 6017,
	'yu-le'                => 6016,
	'cai-wu'               => 6015,
	'you-xi'               => 6014,
	'jian-kang-jian-mei'   => 6013,
	'sheng-huo'            => 6012,
	'yi-liao'              => 6020,
	'yin-yue'              => 6011,
	'dao-hang'             => 6010,
	'xin-wen'              => 6009,
	'bao-kan-za-zhi'       => 6021,
	'she-ying-yu-lu-xiang' => 6008,
	'xiao-lv'              => 6007,
	'can-kao'              => 6006,
	'she-jiao'             => 6005,
	'ti-yu'                => 6004,
	'lv-xing'              => 6003,
	'gong-ju'              => 6002,
	'tian-qi'              => 6001,
	'mei-shi-jia-yin'	   => 6023
);

/*
| -------------------------------------------------------------------
|  app store 分类编号所对应本地分类id和分类名称
| -------------------------------------------------------------------
| Prototype:
|
|  $config['local_category'] = array(app_category_id, '分类名称|分类id');
|
*/
$config['local_category'] = array(
	6018 => '图书|1',
	6000 => '商业|2',
	6022 => '目录|3',
	6017 => '教育|4',
	6016 => '娱乐|5',
	6015 => '财务|6',
	6014 => '游戏|7',
	6013 => '健康健美|8',
	6012 => '生活|9',
	6020 => '医疗|10',
	6011 => '音乐|11',
	6010 => '导航|12',
	6009 => '新闻|13',
	6021 => '报刊杂志|14',
	6008 => '摄影与录像|15',
	6007 => '效率|16',
	6006 => '参考|17',
	6005 => '社交|18',
	6004 => '体育|19',
	6003 => '旅行|20', 
	6002 => '工具|21',
	6001 => '天气|22',
	6023 => '美食佳饮|23'
);

/*
| -------------------------------------------------------------------
|  [数据中心] 从app store 按分类获取应用列表URL模版
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['apple_url_tpl'] = 'http://'
|
*/
$config['appstore_category_url_tpl'] = 'http://itunes.apple.com/cn/genre/ios-#category_alias#/id#category_id#';
$config['appstore_lookup_url_tpl']   = 'http://itunes.apple.com/lookup?id=#app_id#&lang=zh_cn&country=CN';
$config['appstore_serch_url_tpl'] = 'http://itunes.apple.com/search?term=#keyword#&entity=software&limit=25';