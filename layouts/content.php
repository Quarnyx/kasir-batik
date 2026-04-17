<?php
switch ($page = $_GET['page'] ?? 'dashboard') {
    case 'dashboard':
        include 'pages/dashboard.php';
        break;
    case 'produk':
        include 'pages/produk/index.php';
        break;
    case 'produk-form':
        include 'pages/produk/form.php';
        break;
    case 'produk-proses':
        include 'pages/produk/proses.php';
        break;
    case 'produk-variasi':
        include 'pages/produk/variasi-produk.php';
        break;
    case 'pemasok':
        include 'pages/pemasok/index.php';
        break;
    case 'pembelian':
        include 'pages/pembelian/index.php';
        break;
    default:
        include 'pages/dashboard.php';
        break;
}