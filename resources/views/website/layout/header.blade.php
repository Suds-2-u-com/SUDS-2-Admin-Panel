<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token() }}">
    <title>Home | Suds-2-U</title>

    <!-- BOOTSTRAP CSS START -->
    <link rel="stylesheet" type="text/css" href="{{url('public/website/css/bootstrap.min.css')}}">
    <!-- SWIPER SLIDER CSS START -->
    <link rel="stylesheet" type="text/css" href="{{url('public/website/css/swiper-bundle.min.css')}}">
    <!-- STYLE CSS START -->
    <link rel="stylesheet" type="text/css" href="{{url('public/website/css/style.css')}}">
    <!-- FONT AWESOME CSS LINK -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/css/all.css" />
    <!-- FAVICON IMAGE LINK -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('public/imgpsh_fullsize_anim.png')}}" />
    <link href="{{url('public/admin/assets/css/sweetalert.min.css')}}" rel="stylesheet">
    <style>
    #button {
        display: block;
        margin: 20px auto;
        padding: 10px 30px;
        background-color: #eee;
        border: solid #ccc 1px;
        cursor: pointer;
    }

    #overlay {
        position: fixed;
        top: 0;
        z-index: 100;
        width: 100%;
        height: 100%;
        display: none;
        background: rgba(0, 0, 0, 0.6);
    }

    .cv-spinner {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px #ddd solid;
        border-top: 4px #2e93e6 solid;
        border-radius: 50%;
        animation: sp-anime 0.8s infinite linear;
    }

    @keyframes sp-anime {
        100% {
            transform: rotate(360deg);
        }
    }

    .is-hide {
        display: none;
    }

    @media screen and (min-width: 1200px) {
        nav.navbar ul.navbar-nav {
            margin-left: auto !important;
            max-width: 1000px !important;
        }
    }
    </style>
</head>


<body>
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    <!-- HEADER SECTION START -->
    <header class="container-fluid px-0">
        <!-- NAVBAR START -->
        <nav class="navbar navbar-expand-xl fixed-top">
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{url('public/website/images/logo/logo-2.svg')}}" class="img-fluid mx-auto logo-2">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav justify-content-between py-3 py-lg-0 w-100 ml-xl-4">
                    <li class="nav-item mx-1">
                        <a class="nav-link px-2 {{ Request::is('/') ? 'active' : '' }}" href="{{url('/')}}">Home</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link px-2 {{ Request::is('Get-An-App') ? 'active' : '' }}"
                            href="{{url('Get-An-App')}}">Get The App</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link px-2 {{ Request::is('Order-On-Site') ? 'active' : '' }}"
                            href="{{url('Order-On-Site')}}">Order On Site</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link px-2 {{ Request::is('Cities') ? 'active' : '' }}"
                            href="{{url('Cities')}}">WHERE WE WASH</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link px-2 {{ Request::is('Faq') ? 'active' : '' }}" href="{{url('Faq')}}">FAQ</a>
                    </li>

                    <!-- <li class="nav-item mx-1">
                        <a class="nav-link px-2 {{ Request::is('Press') ? 'active' : '' }}"
                            href="{{url('Press')}}">Press</a>
                    </li> -->
                    <li class="nav-item mx-1">
                        <a class="nav-link px-2 {{ Request::is('Business-Fleet') ? 'active' : '' }}"
                            href="{{url('Business-Fleet')}}">Bussiness / Fleet</a>
                    </li>
                    <li class="nav-item mx-2 d-flex justify-content-end align-items-center mt-3 mt-lg-0">
                        <a href="{{url('become-a-washer')}}" class="btn customBtn">Become A Detailer</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- NAVBAR END -->