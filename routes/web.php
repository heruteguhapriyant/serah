<?php
// routes/web.php

/** PUBLIC ROUTES **/
$router->get('/',              'HomeController@index');
$router->get('/program',       'ProgramController@index');
$router->get('/program/{id}',          'ProgramController@detail');
$router->get('/rekap',         'RekapController@index');

/** ADMIN AUTH **/
$router->get('/admin/login',   'AuthController@showLogin');
$router->post('/admin/login',  'AuthController@login');
$router->get('/admin/logout',  'AuthController@logout');

/** ADMIN - DASHBOARD **/
$router->get('/admin',         'AdminHomeController@index');

/** ADMIN - PROGRAM **/
$router->get('/admin/program',          'AdminProgramController@index');
$router->get('/admin/program/create',   'AdminProgramController@create');
$router->post('/admin/program/store',   'AdminProgramController@store');
$router->get('/admin/program/edit/{id}','AdminProgramController@edit');
$router->post('/admin/program/update/{id}','AdminProgramController@update');
$router->post('/admin/program/delete/{id}','AdminProgramController@delete');

/** ADMIN - REKAP KEGIATAN **/
$router->get('/admin/rekap',             'AdminRekapController@index');
$router->get('/admin/rekap/create',      'AdminRekapController@create');
$router->post('/admin/rekap/store',      'AdminRekapController@store');
$router->get('/admin/rekap/edit/{id}',   'AdminRekapController@edit');
$router->post('/admin/rekap/update/{id}','AdminRekapController@update');
$router->post('/admin/rekap/delete/{id}','AdminRekapController@delete');

/** ADMIN - PROFILE **/
$router->get('/admin/profile',         'AdminProfileController@index');
$router->post('/admin/profile/update', 'AdminProfileController@update');

// ADMIN MEDIA PARTNER
$router->get('/admin/mediapartner',              'AdminMediaPartnerController@index');
$router->get('/admin/mediapartner/create',       'AdminMediaPartnerController@create');
$router->post('/admin/mediapartner/store',       'AdminMediaPartnerController@store');
$router->get('/admin/mediapartner/edit/{id}',    'AdminMediaPartnerController@edit');
$router->post('/admin/mediapartner/update/{id}', 'AdminMediaPartnerController@update');
$router->post('/admin/mediapartner/delete/{id}', 'AdminMediaPartnerController@delete');

// ADMIN HERO SLIDER
$router->get('/admin/heroslider',              'AdminHeroSliderController@index');
$router->get('/admin/heroslider/create',       'AdminHeroSliderController@create');
$router->post('/admin/heroslider/store',       'AdminHeroSliderController@store');
$router->get('/admin/heroslider/edit/{id}',    'AdminHeroSliderController@edit');
$router->post('/admin/heroslider/update/{id}', 'AdminHeroSliderController@update');
$router->post('/admin/heroslider/delete/{id}', 'AdminHeroSliderController@delete');