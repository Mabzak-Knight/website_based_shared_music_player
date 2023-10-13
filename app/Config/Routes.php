<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('music', 'MusicController::index');
$routes->get('music/input', 'MusicController::input');
$routes->post('music/save', 'MusicController::save');
$routes->get('music/play/(:num)', 'MusicController::play/$1');
$routes->get('music/search', 'MusicController::index');
$routes->get('music/send-to-streaming/(:num)', 'MusicController::sendToStreaming/$1');
$routes->get('music/streaming', 'MusicController::latestSongs');
$routes->get('music/latest-songs-json', 'MusicController::latestSongsJson');
$routes->post('music/delete-song', 'MusicController::deleteSong');