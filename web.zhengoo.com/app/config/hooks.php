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


$hook['post_controller_constructor'] = array(
                                'class'    => '',
                                'function' => 'check_session_user',
                                'filename' => 'zg_hooks.php',
                                'filepath' => 'hooks',
                                'params'   => array(
                               			'authorize/auth/',
                               			'main/welcome/',
                               			'user/login/',
                                    'user/m_login/',
                               			'user/signup/',
                                    'main/tools/'
                                	)
                                );

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */