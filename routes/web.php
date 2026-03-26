<?php
// routes/web.php

/** PUBLIC ROUTES **/
$router->get('/',              'HomeController@index');
$router->get('/program',       'ProgramController@index');
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