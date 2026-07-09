<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', '\App\Controllers\Website\HomeController::index');
$routes->get('about', '\App\Controllers\Website\HomeController::about');
$routes->get('services', '\App\Controllers\Website\HomeController::services');
$routes->get('projects', '\App\Controllers\Website\HomeController::projects');
$routes->get('career', '\App\Controllers\Website\HomeController::career');
$routes->get('contact', '\App\Controllers\Website\HomeController::contact');
$routes->get('blog', '\App\Controllers\Website\HomeController::blog');
$routes->get('portfolio', '\App\Controllers\Website\HomeController::portfolio');
$routes->get('journey', '\App\Controllers\Website\HomeController::journey'); 
$routes->get('nrisupport', '\App\Controllers\Website\HomeController::nrisupport');
$routes->get('process', '\App\Controllers\Website\HomeController::process');

$routes->get('booking/slots', '\App\Controllers\Website\BookingController::getBookedSlots');
$routes->post('booking/send', '\App\Controllers\Website\BookingController::send');
$routes->post('contact/send', '\App\Controllers\Website\ContactController::contactSubmit');
$routes->post('career/send', '\App\Controllers\Website\ContactController::careerSubmit');
$routes->post('nrisupport/send', '\App\Controllers\Website\ContactController::nriSubmit');
$routes->post('home/send', '\App\Controllers\Website\ContactController::homeSubmit');
$routes->post('brochure/download', '\App\Controllers\Website\ContactController::brochureDownload');
$routes->post('api/chat', '\App\Controllers\FortuneOneAI\AiChatController::sendMessage');
$routes->post('api/leads', '\App\Controllers\FortuneOneAI\LeadController::submit');


// API Routes for External Integrations
$routes->group('api/v1', function($routes) {
    $routes->post('external-lead', '\App\Controllers\Api\WebToLeadController::submit');
    $routes->options('external-lead', '\App\Controllers\Api\WebToLeadController::options'); // For CORS preflight
});
// API Routes for External Integrations
$routes->group('api/v1', function($routes) {
    $routes->post('external-lead', '\App\Controllers\Api\WebToLeadController::submit');
    $routes->options('external-lead', '\App\Controllers\Api\WebToLeadController::options'); // For CORS preflight
    
    // --- ADD THESE TWO LINES FOR APPOINTMENTS ---
    $routes->post('external-appointment', '\App\Controllers\Api\WebToAppointmentController::submit');
    $routes->options('external-appointment', '\App\Controllers\Api\WebToAppointmentController::options');
    // --------------------------------------------
});


// Blog Post Routes
$routes->get('blog/smart-homes', '\App\Controllers\Website\HomeController::blogPost1');
$routes->get('blog/sustainable-building', '\App\Controllers\Website\HomeController::blogPost2');
$routes->get('blog/virtual-reality', '\App\Controllers\Website\HomeController::blogPost3');

// CRM Routes Group
$routes->group('', ['namespace' => '\App\Controllers\FortuneOneCRM'], function($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('login', 'AdminController::index');
    $routes->post('login', 'AdminController::loginPost');
    $routes->get('logout', 'AdminController::logout');
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('analytics', 'AdminController::analytics');
    $routes->get('api/analytics-data', 'AdminController::getAnalyticsData');
    $routes->get('leads', 'AdminController::leads');
    $routes->get('leads/details/(:num)', 'AdminController::leadDetails/$1');
    $routes->get('appointments', 'AdminController::appointments');
    $routes->get('appointments/details/(:num)', 'AdminController::appointmentDetails/$1');
    $routes->post('appointments/update', 'AdminController::updateAppointment');
    $routes->get('users', 'AdminController::users');
    $routes->get('users/details/(:num)', 'AdminController::userDetails/$1');
    $routes->post('users/create', 'AdminController::createUser');
    $routes->post('users/update', 'AdminController::updateUser');
    $routes->post('users/update_permissions', 'AdminController::updateUserPermissions');
    $routes->get('careers', 'AdminController::careerApplications');
    $routes->get('careers/details/(:num)', 'AdminController::applicationDetails/$1');
    $routes->post('careers/update', 'AdminController::updateApplication');
    $routes->get('enquiries', 'AdminController::enquiries');
    $routes->get('enquiries/details/(:num)', 'AdminController::enquiryDetails/$1');
    $routes->post('enquiries/update', 'AdminController::updateEnquiry');
    $routes->get('settings', 'AdminController::settings');
    $routes->post('settings/update-profile', 'AdminController::updateProfile');
    $routes->post('settings/update-password', 'AdminController::updatePassword');
    $routes->get('activity-logs', 'AdminController::activityLogs');
    $routes->post('notifications/mark-read', 'AdminController::markNotificationsRead');
    $routes->get('forgot-password', 'AdminController::forgotPassword');
    $routes->post('forgot-password', 'AdminController::forgotPasswordPost');
    $routes->get('reset-password', 'AdminController::resetPassword');
    $routes->post('reset-password', 'AdminController::resetPasswordPost');
});

// Admin Route Redirects
$routes->get('admin', '\App\Controllers\FortuneOneCRM\AdminController::index');
$routes->post('admin', '\App\Controllers\FortuneOneCRM\AdminController::loginPost');
$routes->addRedirect('admin/dashboard', 'dashboard');
$routes->addRedirect('admin/analytics', 'analytics');
$routes->addRedirect('admin/leads', 'leads');
$routes->addRedirect('admin/leads/details/(:num)', 'leads/details/$1');
$routes->addRedirect('admin/leaddetails', 'leads');
$routes->addRedirect('admin/appointments', 'appointments');
$routes->addRedirect('admin/appointments/details/(:num)', 'appointments/details/$1');
$routes->addRedirect('admin/users', 'users');
$routes->addRedirect('admin/users/details/(:num)', 'users/details/$1');
$routes->addRedirect('admin/careers', 'careers');
$routes->addRedirect('admin/careers/details/(:num)', 'careers/details/$1');
$routes->addRedirect('admin/enquiries', 'enquiries');
$routes->addRedirect('admin/enquiries/details/(:num)', 'enquiries/details/$1');
$routes->addRedirect('admin/forgot-password', 'forgot-password');
$routes->addRedirect('admin/reset-password', 'reset-password');
