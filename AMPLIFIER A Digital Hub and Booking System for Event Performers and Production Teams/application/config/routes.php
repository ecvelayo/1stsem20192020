<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// need to change
$route['default_controller'] = 'clients/profile';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['users']                                 = 'welcome/search_results';
$route['users/(:num)']                          = 'welcome/search_results/$1';
$route['events']                                = 'welcome/search_results_events';
$route['events_page']                           = 'welcome/search_results_events';
$route['events_page/(:num)']                    = 'welcome/search_results_events/$1';
$route['profile/(:num)']                        = 'welcome/profile/$1';
$route['services']                              = 'welcome/search_results_package';
$route['services/(:num)']                       = 'welcome/search_results_package/$1';
$route['history']                               = 'welcome/search_results_history';
$route['history/(:num)']                        = 'welcome/search_results_history/$1';
$route['reports']                               = 'welcome/search_results_report';
$route['reports/(:num)']                        = 'welcome/search_results_report/$1';
$route['search_results_history']                = 'welcome/search_results_history';
$route['search_results_package']                = 'welcome/search_results_package/';
$route['search_results_report']                 = 'welcome/search_results_report';
$route['notifications']                         = 'welcome/notifications';
$route['delete_user/(:num)']                    = 'welcome/delete_user/$1  ';
$route['eventview/(:num)']                      = 'welcome/eventview/$1';
$route['addevents/(:num)']                      = 'welcome/form_validation_event/$1';
$route['delete_report/(:num)']                  = 'welcome/delete_report/$1';
$route['delete_event/(:num)']                   = 'welcome/delete_event/$1';
$route['delete_package/(:num)']                 = 'welcome/delete_package/$1';
$route['add_offense/(:num)']                    = 'welcome/offense_count/$1';
$route['transaction/(:num)']                    = 'welcome/transaction/$1';

$route['block_page']                            = 'welcome/block_page';
$route['changeoff']                             = 'welcome/changeoff';
$route['logout']                                = 'welcome/logout';
$route['recover/(:num)']                        = 'welcome/recover/$1';
$route['a_chat']                                = 'admin/chat';
$route['booking_attempt_admin/(:num)']          = 'welcome/booking_attempt/$1';
$route['a_chat/(:num)']                         = 'admin/chat_message/$1';
$route['a_chat_send_search_message/(:num)']     = 'admin/send_search_message/$1';
$route['a_chat_compose/(:num)']                 = 'admin/chat_compose/$1'; 


//
$route['profile']                       = 'clients/profile';
$route['profile_password_edit_page']    = 'clients/profile_password_edit_page';
$route['profile_password_update']       = 'clients/profile_password_update';
$route['profile_info']                  = 'clients/profile_info';
$route['profile_edit']                  = 'clients/profile_edit_page';
$route['profile_edit_info']             = 'clients/profile_edit_info';
$route['c_gallery/(:num)']              = 'clients/gallery/$1';
$route['history_client']                = 'clients/history';
$route['history_client/(:num)']         = 'clients/history_info/$1';
$route['rate_event/(:num)']             = 'clients/rate_event/$1';
$route['rating_attempt/(:num)']         = 'clients/rate_attempt/$1'; 
$route['report_event/(:num)']             = 'clients/report_event/$1';
$route['report_attempt/(:num)']         = 'clients/report_attempt/$1'; 
$route['booking']                       = 'clients/booking';
$route['booking_book_event/(:num)']     = 'clients/booking_book_event/$1';
$route['booking_attempt/(:num)']        = 'clients/booking_attempt/$1';
$route['c_events']                      = 'clients/events';
// $route['c_event_add']                   = 'clients/event_add';
$route['c_event_add_attempt']           = 'clients/event_add_attempt';
$route['c_notifications']               = 'clients/notifications';
$route['events/(:num)']                 = 'clients/event_info/$1';
$route['print_event/(:num)']            = 'clients/print_pdf/$1';
$route['c_delete_event/(:num)']         = 'clients/delete_event';
$route['calendar_info/(:num)/(:num)/(:num)']      = 'clients/calendar_info/$1/$1/$1';
// $route['package']                       = 'clients/package';
// $route['c_created_events']              = 'clients/event_created';
$route['register']                      = 'clients/register';
$route['c_search']                      = 'clients/search';
$route['register_attempt']              = 'clients/register_user';
$route['login']                         = 'clients/login';
$route['login_attempt']                 = 'clients/login_attempt';
$route['logout_user']                   = 'clients/logout';
$route['performer_profile_info/(:num)'] = 'clients/performer_profile_info/$1';
$route['c_performer_gallery/(:num)']    = 'clients/performer_gallery/$1';
$route['rating/(:num)']                        = 'clients/rating/$1';
$route['add_rating/(:num)']                    = 'clients/add_rating/$1';
// $route['clients/calendar']              = 'clients/calendar';
// $route['clients/calendar(:num)(:num)']              = 'clients/calendar';

$route['c_chat']                        = 'clients/chat';
$route['c_chat/(:num)']                 = 'clients/chat_message/$1';
$route['c_chat_send_search_message/(:num)']    = 'clients/send_search_message/$1';
$route['c_chat_compose/(:num)']         = 'clients/chat_compose/$1'; 

// 
$route['p_register']                    = 'performers/register';
$route['p_register_attempt']            = 'performers/register_attempt';
// $route['p_profile']                     = 'performers/profile';
$route['p_notifications']               = 'performers/notifications';
$route['p_bookings']                    = 'performers/bookings';
$route['p_event_info/(:num)']           = 'performers/event_info/$1';
$route['p_approve_event/(:num)']         = 'performers/event_status_approve/$1';
$route['p_decline_event/(:num)']        = 'performers/event_status_decline/$1';
$route['p_pricing']                     = 'performers/pricing';
$route['p_pricing_validate']            = 'performers/pricing_validate';
$route['p_package']                     = 'performers/package';
$route['p_package_edit_page/(:num)']    = 'performers/package_edit_page/$1'; 
$route['p_package_delete/(:num)']       = 'performers/p_package_delete/$1';
$route['p_package_update/(:num)']              = 'performers/package_update/$1';
$route['p_package_info_page/(:num)']    = 'performers/package_info_page/$1';
$route['p_gallery']                     = 'performers/gallery';
$route['p_chat']                        = 'performers/chat';
$route['p_chat/(:num)']                 = 'performers/chat_message/$1';
$route['p_chat_send_search_message/(:num)']    = 'performers/send_search_message/$1';
$route['p_chat_compose/(:num)']         = 'performers/chat_compose/$1'; 
$route['p_report_event/(:num)']             = 'performers/report_event/$1';
$route['p_report_attempt/(:num)']         = 'performers/report_attempt/$1'; 
$route['p_rate_event/(:num)']             = 'performers/rate_event/$1';
$route['p_rating_attempt/(:num)']         = 'performers/rate_attempt/$1'; 

$route['notifications/index']                 =  'notifications/index';
$route['p_paid/(:num)']                   = 'performers/paid_event/$1';


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





