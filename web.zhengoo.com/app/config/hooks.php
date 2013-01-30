<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/


$hook['post_controller_constructor'][] = array(
                                'class'    => '',
                                'function' => 'check_session_user',
                                'filename' => 'zg_hooks.php',
                                'filepath' => 'hooks',
                                'params'   => array(
                               		'authorize/auth/',
                                    'user/login/',
                                    'user/m_login/',
                                    'user/signup/',
                                    'main/message/',
                               		
                                    // 'main/welcome/',
                                    // 'main/discover/',
                                    // 'user/personal/',
                                    // 'user/apply/',
                                    // 'main/tools/',
                                   
                                	)
                                );

$hook['post_controller_constructor'][] = array(
                                'class'    => '',
                                'function' => 'filter_user_name',
                                'filename' => 'zg_hooks.php',
                                'filepath' => 'hooks',
                                'params'   => array('admin', 'root', 'login','signup', 'tools', 'administrator', 'weibo', 'taobao', 'renren', 'qq', 'diandian', 'douban', 'evernote', 'pocket')
                                );

$hook['post_controller'] = array(
                            'class'    => '',
                            'function' => 'filter_auth',
                            'filename' => 'zg_hooks.php',
                            'filepath' => 'hooks',
                            'params'   => array(
                                        /**
                                         * 新浪微博允许进入的用户id
                                         */
                                        1 => array(
                                            '1704348731',//自己
                                            '2310207652',//爱尚你的人
                                            '1693350313',//王玲科
                                            '1576618720',//刘璐
                                            '1648959320',//小新
                                            '1802551491',//葛曳
                                            '1898397313',//胡月
                                        ),
                                        /**
                                         * 腾讯 允许进入的用户
                                         */
                                        2 => array(
                                            ''
                                        ) 
                                    )
                                );


/* End of file hooks.php */
/* Location: ./application/config/hooks.php */