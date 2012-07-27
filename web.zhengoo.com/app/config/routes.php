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
$route['(login|signup|logout)']          = 'user/$1'; 					
$route['(weibo|taobao|pocket|diandian)'] = 'authorize/auth/$1';
$route['tools'] 						 = 'main/tools';

$route['list/(:any)']                    = 'lists/$1';
$route['app/(:any)']                     = 'app/$1';
$route['collect/(:any)']				 = 'collect/$1';

$route['(:any)']                         = '/user/home/$1';
// $route['(:any)/(:any)']                  = 'lists/collect_list/$1/$2';
/* End of file routes.php */
/* Location: ./application/config/routes.php */