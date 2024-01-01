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

// $route['default_controller'] = 'blog';
$route['default_controller'] = 'Site/Main';
$route['blog'] = 'Site/Main/Blog';
// $route['default_controller'] = 'Dashboard/User/MainLogin';
$route['AdminSecure_Area'] = 'Admin/Management/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['app']['GET'] = 'Site/Auth';
$route['app']['POST'] = 'Site/Auth';
$route['app-logout'] = 'App/User/logout';
$route['csv'] = 'Site/Csv';

$route['Admin/set-roi']['GET'] = 'Admin/Settings/setRoi';
$route['Admin/set-roi']['POST'] = 'Admin/Settings/setRoi';



$route['Dashboard/add-beneficiary']['GET'] = 'Dashboard/secureWithdraw/addBeneficiary';
$route['Dashboard/add-beneficiary']['POST'] = 'Dashboard/secureWithdraw/addBeneficiary';
$route['Dashboard/beneficiary-list'] = 'Dashboard/secureWithdraw/beneficiaryList';
$route['Dashboard/withdraw-amount/(.+)'] = 'Dashboard/secureWithdraw/withdrawAmount/$1';
$route['Dashboard/withdraw-transaction'] = 'Dashboard/bank_transfer_summary';
$route['Dashboard/insta-stake']['GET'] = 'Dashboard/Activation/fixDeposit';
$route['Dashboard/insta-stake']['POST'] = 'Dashboard/Activation/fixDeposit';
$route['Dashboard/coin-history'] = 'Dashboard/Reports/coinHistory';
$route['Dashboard/coin-history/(:num)'] = 'Dashboard/Reports/coinHistory';
$route['Dashboard/blog'] = 'Dashboard/controllers/Dashboard';
$route['blog-details/(:num)'] = 'Site/Main/ViewBlogDetails/$1';

///Pay2all routes
$route['api-logout'] = 'Dashboard/User/logout';
$route['dashboard/get-list'] = 'Dashboard/Pay2all/rechargeList';
$route['dashboard/recharge/(.+)'] = 'Dashboard/Pay2all/recharge/$1';
$route['dashboard/callback'] = 'Dashboard/Pay2all/weekhook';
$route['dashboard/get-bill/(.+)'] = 'Dashboard/Pay2all/billVerification/$1';
$route['dashboard/get-bill']['POST'] = 'Dashboard/Pay2all/getBill';
$route['dashboard/pay-bill']['POST'] = 'Dashboard/Pay2all/payBill';
$route['dashboard/bill-validate/(:num)'] = 'Dashboard/Pay2all/validateBill/$1';


$route['Admin/roi-details'] = 'Admin/Report/roiHistory';
$route['Admin/roi-details/(.+)'] = 'Admin/Report/roiHistory';

$route['Admin/roiAction']['POST'] = 'Admin/Report/roiAction';