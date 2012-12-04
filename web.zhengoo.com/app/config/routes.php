<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "main/welcome";
$route['404_override']       = '';


/*
 | -------------------------------------------------------------------------
 | Admin Route
 | -------------------------------------------------------------------------
 |
 */

$route[ADMIN_PATH]                   = 'admin/index/login';
$route[ADMIN_PATH.'/(login|logout)'] = 'admin/index/$1';
$route[ADMIN_PATH.'/(:any)'] 		 = 'admin/$1';

/*
 | -------------------------------------------------------------------------
 | Web Route
 | -------------------------------------------------------------------------
 |
 */
$route['(login|signup|logout|m_login)']         = 'user/$1'; 					
$route['(weibo|qq|taobao|pocket|diandian|weixin)']     = 'authorize/auth/$1';
$route['tools']                                 = 'main/tools';
$route['home']                                  = 'user/home';
$route['discover']                              = 'main/discover/staff-picks';

$route['list/(:any)']                           = 'lists/$1';
$route['app/(:any)']                            = 'app/$1';
$route['collect/(:any)']                        = 'collect/$1';

$route['discover/(staff-picks|popular|recent)'] = 'main/discover/$1';
$route['follow/(:any)/(:any)'] 					= 'lists/follow/$1/$2';
$route['follow/(:any)']                         = 'user/follow/$1';

$route['comment/delete/(:num)']					= 'comment/delete/$1';

$route['comment/(:any)-(:num)-(:num)'] 			= 'comment/add/$2/$3';
$route['(:any)/(:any)-(:num)-(:num)']           = 'collect/info/$1/$4/';
$route['(:any)/(following|followers)']			= 'user/personal_$2/$1';
$route['(:any)/(:any)']                         = 'collect/lists/$1/$2';
$route['(:any)']                                = 'user/personal/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */