<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'guest';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//###################<<EXTRA ROUTE RULES>>##########################
$route['home/(:num)'] = 'guest/home/$1';
$route['contact']='guest/contact';
$route['captcha']='guest/captcha';
$route['msg_to_user/(:num)']='guest/contact_user/$1';
$route['search']='guest/search';
$route['city']='guest/city';
$route['city/(:num)']='guest/city/$1';
$route['profile/(:any)']='guest/profile/$1';
$route['submit']='guest/submit';
$route['login']='guest/login';
$route['logout']='guest/logout';
$route['login-user']='guest/check_user';
$route['newhome']='guest/add_home';
$route['register_user']='guest/register';
$route['agents']='guest/agents';
$route['more_searh_result']='guest/more_searh_result';
$route['more_agents_searh_result']='guest/more_agents_searh_result';

$route['new_home']='front/new_home';
$route['profile/(:num)']='front/profile/$1';
$route['category/(:any)'] = 'front/category/$1';
$route['realtors/(:any)'] = 'front/realtors/$1';
$route['realtors'] = 'front/realtors';
$route['city/(:any)']='front/city/$1';

//$route['/(:num)']='front/profile/$1';
//$route['(:any)']='front/$1';
//$route['(:any)/(:any)']='front/$1/$2';
//$route['(:any)/(:any)/(:any)']='front/$1/$2/$3';
