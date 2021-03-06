<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Jhok Resturant</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/css/plugins/common/common.min.js') }}"></script>
    <style>
        .req{color:red;font-weight:bolder;}
    </style>
    <script>
        var _token = '{{ csrf_token() }}';
    </script>
</head>
<body>
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="nav-header">
            <div class="brand-logo">
                <a href="#">
                    <b class="logo-abbr"><img src="{{ asset('assets/images/logo.png') }}" alt=""> </b>
                    <span class="logo-compact"><img src="{{ asset('assets/images/logo-compact.png') }}" alt=""></span>
                    <span class="brand-title">
                        <img src="{{ asset('assets/images/logo-text.png') }}" alt="">
                    </span>
                </a>
            </div>
        </div>
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{ asset('assets/images/logo.png') }}" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="{{ route('adminlogout') }}"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll" style="background-color: #cce3e3;">
                <ul class="metismenu" id="menu" style="background-color: #cce3e3;">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a href="{{ route('dashboard') }}" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-label">Menus</li>
                    <li  class="">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-grid menu-icon"></i> <span class="nav-text">Menus</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="{{ route('add-menu') }}" class="{{ (Request::segment(2) == 'add-menu') ? "active" : "" }}">Add New Menu</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="nav-label">Kitchen</li>
                    <li class="">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-menu menu-icon"></i> <span class="nav-text">Ingradients</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="{{ route('add-gradient') }}" class="{{ (Request::segment(2) == 'add-gradient') ? "active" : "" }}">Add New Ingradient</a>
                            </li>
                            <li><a href="{{ route('gradient-list') }}">Ingradient List</a></li>
                        </ul>
                    </li>

                    <li class="nav-label">Reports</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-menu menu-icon"></i> <span class="nav-text">Reports</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="#" class="m-call" data-href="{{ route('net-sale') }}" data-title="Net Sale Report" data-toggle="modal" data-target="#basicModal">Net Sale Report</a>
                            </li>
                            <li>
                                <a href="#" class="m-call" data-href="{{ route('profit-loss') }}" data-title="Profit Loss Report" data-toggle="modal" data-target="#basicModal">Profit/Loss Report</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-body">
            <div class="container-fluid">