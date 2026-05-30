<?php

$petaniFile = 'c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views/petani/dashboard.blade.php';
$adminFile = 'c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views/admin/dashboard.blade.php';
$konsultanFile = 'c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views/konsultan/dashboard.blade.php';

$petani = file_get_contents($petaniFile);

// 1. Get Petani CSS
$startP = strpos($petani, ':root {');
$endP = strpos($petani, '/* ── KELUHAN LIST VIEW STYLING ── */');
$cssPetani = substr($petani, $startP, $endP - $startP);

// 2. Get Petani Sidebar HTML (up to main)
$startHtmlP = strpos($petani, '<div class="sb">');
$endHtmlP = strpos($petani, '<div class="main">');
$sidebarPetani = substr($petani, $startHtmlP, $endHtmlP - $startHtmlP);

// Need to customize the sidebar for Admin
$sidebarAdmin = str_replace(
    ['<!-- MENU TAB (1-5) -->', 'data-tab="berandaBtn"', 'id="berandaBtn"', 'Beranda', 'data-tab="keluhanBtn"', 'id="keluhanBtn"', 'Keluhan', 'data-tab="tanamanBtn"', 'id="tanamanBtn"', 'Pustaka Tanaman', 'data-tab="konsultanBtn"', 'id="konsultanBtn"', 'Konsultan Ahli', 'data-tab="profilBtn"', 'id="profilBtn"', 'Profil Saya'],
    ['<!-- Admin Menu -->', 'data-tab="dashBtn"', 'id="dashBtn"', 'Dashboard', 'data-tab="kelBtn"', 'id="kelBtn"', 'Keluhan', 'data-tab="konBtn"', 'id="konBtn"', 'Konsultan', 'data-tab="usrBtn"', 'id="usrBtn"', 'Pengguna', 'data-tab="tanBtn"', 'id="tanBtn"', 'Pustaka Tanaman'],
    $sidebarPetani
);
// But wait, the exact HTML structure of the sidebar menu in Admin has different IDs and names. I will construct it using Regex or manually in PHP.
