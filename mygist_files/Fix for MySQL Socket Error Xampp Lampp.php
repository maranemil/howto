<?php
///////////////////////////////////////////////////////////////
//
// Fix for MySQL Socket Error Xampp Lampp phpMyAdmin
//
///////////////////////////////////////////////////////////////

// The server is not responding (or the local MySQL server's socket is not correctly configured)

// Change:
$cfg['Servers'][$i]['host'] = 'localhost'; 

//to
$cfg['Servers'][$i]['host'] = '127.0.0.1';