<?php ob_start(); ?>

<?php

if( !isset($_SESSION['start']) ){
    session_start();
}

include('../../include/db.php');
include('_include/functions.php');
include('_include/header_include.php');

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta name="theme-color" content="#563d7c">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Web Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <!-- toastr Alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Dropify -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />

    <style>
        * {
            font-family: 'Manrope', sans-serif;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* Custom Styling Table */
        table,
        table th,
        .table-title,
        .card-custom-title {
            font-size: 13px;
            font-weight: 500;
        }

        table tr td {
            vertical-align: middle !important;
        }

        /* Custom Styling Form Elements */
        input,
        textarea,
        .form-control-sm,
        .custom-select-sm {
            font-size: 12px !important;
        }

        select,
        option {
            font-size: 12px !important;
        }
        
        /* Custom Styling Toastr */
        #toast-container>div {
            width: 340px !important;
            opacity: 1;
        }

        #title-error {
            font-size: 12px;
        }

        /* Custom Styling Bootstrap Toggle */
        .toggle.android {
            border-radius: 0px;
        }

        .toggle.android .toggle-handle {
            border-radius: 0px;
        }

        /* Custom Styling Dropify */
        .dropify-wrapper {
            border-radius: 4.5px !important;
        }

        .dropify-wrapper .dropify-message p {
            font-size: 13px !important;
        }

        /* Custom Styling Bootstrap Card */
        .card {
            border-radius: 0;
        }

        .card-header {
            padding: 0.55rem 1.25rem !important;
        }

        .card-body label {
            font-size: 12.5px !important;
        }

        .card-body input,
        .card-body textarea,
        .card-body select {
            border-radius: 0 !important;
        }

        /* Custom Styling Sidebar */
        .sidebar-heading span {
            font-size: 12px;
        }

        .nav-link svg {
            display: inline-block;
            width: 20px;
            text-align: left;
        }

        .nav-link {
            font-size: 13px;
        }

        /* Styling Button */
        .btn-sm {
            font-size: 13px;
        }

        h1.h5 {
            font-size: 17px;
        }

        .fa-trash-alt {
            padding-left: 1.4px;
            padding-right: 1.4px;
        }

        /* Styling Custom Common Class */
        .custom-fs-12 {
            font-size: 12.5px;
        }

        .custom-mb-22 {
            margin-bottom: 22px;
        }

        .custom-py-22{
            padding-top: 22px !important;
            padding-bottom: 22px !important;
        }

        .logout-btn{
            background-color: transparent;
        }

        .logout-btn:active,
        .logout-btn:focus{
            outline: none;
            border: none;
        }

        /* Styling Personal Info Table */
        .personal-info-tbl span i{
            width: 24px;
            display: inline-block;
        }

        .personal-info-tbl tr td:first-child{
            width: 20%;
        }

        .personal-info-tbl tr td:nth-child(2) span{
            padding-left: 24px;
        }

        .personal-info-tbl tr:last-child td{
            padding-bottom: 0;
        }
        
        .widget {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        }

        /* Styling Pagination */
        .pagination{
            border-radius: 0; 
        }

        .pagination > .active > a,
        .pagination > .active > a:focus,
        .pagination > .active > a:hover,
        .pagination > .active > span:focus,
        .pagination > .active > span:hover {
            color: #FFF;
            background-color: #1C1E1F !important;
            border-color: #1C1E1F !important;
        }

        .pagination > li > a, 
        .pagination > li > span {
           color: #1C1E1F !important;
        }
        
        .page-item:first-child .page-link,
        .page-item:last-child .page-link{
            border-radius: 0;
        }

        .page-item.active .page-link {
            color: #FFF !important;
            background-color: #1C1E1F !important;
            border-color: #1C1E1F !important;
        }

        table tr th{
            font-weight: 600;
        }
    </style>

    <link href="../assets/css/dashboard.css" rel="stylesheet">
</head>
<body>