<?php

putenv('APP_ENV=testing');
$_ENV['APP_ENV'] = 'testing';

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}