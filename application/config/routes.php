<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';

// setting route for admin
$route['owner123'] = 'admin/auth';

// Admin Locations
$route['admin/location/country/add'] = 'admin/location/country_add';
$route['admin/location/country/edit/(:num)'] = 'admin/location/country_edit/$1';
$route['admin/location/country/del/(:num)'] = 'admin/location/country_del/$1';
$route['admin/location/state/add'] = 'admin/location/state_add';
$route['admin/location/state/edit/(:num)'] = 'admin/location/state_edit/$1';
$route['admin/location/state/del/(:num)'] = 'admin/location/state_del/$1';
$route['admin/location/city/add'] = 'admin/location/city_add';
$route['admin/location/city/edit/(:num)'] = 'admin/location/city_edit/$1';
$route['admin/location/city/del/(:num)'] = 'admin/location/city_del/$1';

// setting route for job page
$route['jobs'] = 'jobs/index';
$route['jobs/(:num)'] = 'jobs/index/$1';

// setting route for job detail page
$route['jobs/(:num)/(:any)'] = 'jobs/job_detail/$1/$2';

// setting route for companies
$route['company/(:any)'] = 'company/detail/$1';

// setting route for jobs by category, industry & location
$route['jobs-by-category'] = 'jobs/jobs_by_category';
$route['jobs-by-industry'] = 'jobs/jobs_by_industry';
$route['jobs-by-location'] = 'jobs/jobs_by_location';

// setting blog category
$route['admin/blog/category/add'] = 'admin/blog/category_add';
$route['admin/blog/category/edit/(:num)'] = 'admin/blog/category_edit/$1';
$route['admin/blog/category/del/(:num)'] = 'admin/blog/category_del/$1';


$route['employers/dashboard'] = 'employers/account/dashboard';

// seting for contact us page
$route['contact'] = 'home/contact';

$route['p/(:any)'] = 'home/any/$1';

$route['404_override'] = 'errors/html/';
$route['translate_uri_dashes'] = FALSE;
