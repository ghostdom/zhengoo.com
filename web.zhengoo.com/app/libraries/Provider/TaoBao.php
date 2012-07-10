<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * TaoBao OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Ghostdom.wj
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

class OAuth2_Provider_Taobao extends OAuth2_Provider 
{

	/**
	 * @var  string  the method to use when requesting tokens
	 */
	public $method = 'POST';
	/**
	 * @var   host
	 */
	public $host = "https://eco.taobao.com/router/rest";
	/**
	 * @var   return data
	 */
	public $format = 'json';

	// --------------------------------------------------------------------

	private $api_fields_mapping = array(
			'taobao.user.get'  			
				=> 'user_id,uid,nick,seller_credit,location,created,last_visit,birthday,type,promoted_type,status,alipay_bind,avatar,email',
			'taobao.users.get' 			
				=> 'user_id,uid,nick,seller_credit,location,created,last_visit,birthday,type,promoted_type,status,alipay_bind,avatar,email',
			'taobao.shopcats.list.get'	
				=> 'cid,parent_cid,name,is_parent',
			'taobao.itemcats.get'		
				=> 'cid,parent_cid,name,is_parent,status,sort_order,features',
			'taobao.item.get' 			
				=> 'detail_url,num_iid,cid,seller_cids,props,pic_url,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,title,nick,price,type,skus,props_name,created,
					promoted_service,is_lightning_consignment,is_fenxiao,auction_point,property_alias,volume,template_id,after_sale_id,is_xinpin,has_warranty,has_showcase,modified,postage_id,product_id,item_imgs,prop_imgs,outer_id,is_virtual,score,
					ww_status,wap_desc,wap_detail_url,cod_postage_id,sell_promise'
		);

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * set property
	 * -----------------------------
	 *
	 * @param property_name
	 * @param value
	 * @return void
	 */
	function __set($property_name, $value)
	{
		$this->$property_name = $value;	
	}

	/**
	 * -----------------------------
	 * Oauht2 授权地址
 	 * -----------------------------
	 */
	public function url_authorize()
	{
		return 'https://oauth.taobao.com/authorize';
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 换取access_token 请求地址
 	 * -----------------------------
	 */
	public function url_access_token()
	{
		return 'https://oauth.taobao.com/token';
	}

	// --------------------------------------------------------------------

	private function _req_before($method, $params = array())
	{
		$this->api_url       = $this->host;
		$params['method']    = $method;
		$params['format']    = $this->format;
		$params['v']         = '2.0';
		$params['fields']    = $this->api_fields_mapping[$method];

		if($this->access_token){
			$params['access_token'] = $this->access_token;
		}else{
			$params['app_key']     = $this->client_id;
			$params['timestamp']   = date('Y-m-d H:m:s');
			$params['sign_method'] = 'md5';
			$params['sign']        = $this->_create_sign($params);
		}
		return $params;
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 生成签名
	 * -----------------------------
	 *
	 * @param $paramArr：api参数数组
	 * @return $sign
	 */
	private function _create_sign($paramArr) {
		ksort($paramArr);
		reset($paramArr);
		$sign = "";
		foreach ($paramArr as $key => $val) {
			if("@" != substr($val, 0, 1)) {
				$sign .= $key.$val;
			}
		}
		$sign = strtoupper(md5($this->client_secret.$sign.$this->client_secret));
		return $sign;
	}

	// --------------------------------------------------------------------
	// ================================
	// = ========== 账号接口 ========== =
	// ================================

	/**
	 * -----------------------------
	 * 根据用户名获取用户信息
	 * - 支持多用户获取
	 * -----------------------------
	 *
	 * @param nick 	用户昵称
	 * @return array 用户信息集合
	 */
	public function get_user($nick = NULL)
	{
		if(is_array($nick)) $nick = implode(',', $nick);
		$this->_ci->load->helper('string');
		$num = segment_num($nick);
		$param = array();
		if($num == 1){
			$param['nick'] = trim($nick);
			$params = $this->_req_before('taobao.user.get', $param);
		}else if($num > 1 && $num <= 40){
			$param['nicks'] = preg_replace("/[\s]{1,}/","",$nick);
			$params = $this->_req_before('taobao.users.get', $param);
		}else{
			return false;
		}
		return $this->get($params);
	}

	// --------------------------------------------------------------------
	// ================================
	// = ========== 类目接口 ========== =
	// ================================

	/**
	 * -----------------------------
	 * 获取后台供卖家发布商品的标准商品类目
	 * - cids、parent_cid至少传一个
	 * -----------------------------
	 *
	 * @param parent_cid 	父商品类目 id，0表示根节点, 传输该参数返回所有子类目
	 * @param cids 			商品所属类目ID列表，可以是数组或用半角逗号(,)分割开的字符串
	 * @return array 		类目信息集合
	 */
	private function _get_itemcats($parent_cid = -1, $cids = NULL)
	{
		if(is_array($cids)) $cids = implode(',', $cids);
		if($cids) $param['cids'] = $cids;
		if($parent_cid != -1) $param['parent_cid'] = $parent_cid;
		$params = $this->_req_before('taobao.itemcats.get', $param);
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据父商品类目 id, 
	 * 获取后台供卖家发布商品的标准商品类目
	 * -----------------------------
	 *
	 * @param parent_cid 	父商品类目 id，0表示根节点, 传输该参数返回所有子类目
	 * @return array 		类目信息集合
	 */
	public function get_itemcat_by_pid($parent_cid = 0)
	{
		if(is_numeric($parent_cid)){
			return $this->_get_itemcats($parent_cid);
		}else{
			return false;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据商品所属类目ID, 
	 * 获取后台供卖家发布商品的标准商品类目
	 * -----------------------------
	 *
	 * @param cids 		商品所属类目ID列表，可以是数组或用半角逗号(,)分割开的字符串
	 * @return array 	类目信息集合
	 */
	public function get_itemcat_by_cid($cids)
	{
		return $this->_get_itemcats(-1, $cids);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取淘宝面向买家的浏览导航类目 
	 * -----------------------------
	 *
	 * @param cids 		商品所属类目ID列表，可以是数组或用半角逗号(,)分割开的字符串
	 * @return array 	类目信息集合
	 */
	public function get_shopcats()
	{
		$params = $this->_req_before('taobao.shopcats.list.get');
		return $this->get($params);
	}

	// --------------------------------------------------------------------
	// ================================
	// = ========== 商品接口 ========== =
	// ================================

	/**
	 * -----------------------------
	 * 获取单个商品的详细信息 卖家未登录时
	 * 只能获得这个商品的公开数据，卖家登录
	 * 后可以获取商品的所有数据
	 * -----------------------------
	 *
	 * @param id 	 淘宝商品id
	 * @return array 淘宝商品信息集合
	 */
	public function get_item($id)
	{
		$param['num_iid'] = $id;
		$params = $this->_req_before('taobao.item.get', $param);
		return $this->get($params);
	}

	// --------------------------------------------------------------------



	// --------------------------------------------------------------------
	// ================================
	// = ========== 淘客接口 ========== =
	// ================================





}