<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('/css/chattle_style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/footers/">

    <style>
        *,
        *::after,
        *::before {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .container-header {
            max-width: 1170px;
            margin: auto;
            padding: 0 15px;

        }

        /* body {
            overflow: hidden;
        } */

        .header {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border-bottom: 1px solid hsla(0, 0%, 100%, 0.2);
            z-index: 10;
        }

        .header .container-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

        }

        .header .logo img {
            vertical-align: middle;
        }

        .header .menu .head {
            display: none;
        }

        .header .menu ul {
            list-style: none;
            display: block;
            margin-top: 5px;
        }

        .header .menu>ul>li {
            display: inline-block;

        }

        .header .menu>ul>li:not(:last-child) {
            margin-right: 40px;

        }

        .header .menu .dropdown {
            position: relative;
        }

        .header .menu a {
            text-decoration: none;
            text-transform: capitalize;
            font-size: 16px;
            color: hsl(0, 0%, 0%);
            line-height: 1.5;
            display: block;
        }

        .header .menu>ul>li>a {
            padding: 24px 0;
            position: relative;

        }

        .header .menu ul li.nav-link::after,
        .header .menu ul li .nav-link::after {
            content: "";
            position: absolute;
            background-color: #4a7246;
            height: 3px;
            width: 0;
            left: 0;
            bottom: 20px;
            transition: 0.3s;
            border-radius: 20px
        }

        .header .menu ul li .nav-link:hover::after,
        .header .menu ul li.nav-link:hover::after {
            width: 100%;
        }

        .header .menu ul li .active::after,
        .header .menu ul li.active::after {
            width: 100%;
        }

        .header .menu>ul>.dropdown>a {
            padding-right: 15px;

        }



        .header .menu i {
            font-size: 10px;
            pointer-events: none;
            user-select: none;
            position: absolute;
            color: rgb(0, 0, 0);
            top: calc(50% - 5px);
        }

        .header .menu>ul>li>i {
            right: 0;
        }

        .header .menu .sub-menu {
            position: absolute;
            top: 94%;
            right: 0;
            width: 230px;
            background-color: #f8f9fa;
            box-shadow: 0 0 2px hsla(0, 0%, 0%, 0.2);
            z-index: 2;
            transform-origin: top;
            transform: scaleY(0);
            visibility: hidden;
            opacity: 0;
            padding-left: 0;

        }



        .header .menu .sub-menu::after {
            content: "";
            top: -8px;
            right: 20px;
            position: absolute;
            width: 15px;
            height: 15px;
            background: #f8f9fa;
            transform: rotate(45deg);
            z-index: 2;
            border-left: 2px solid rgba(129, 129, 129, 0.5);
            border-top: 2px solid rgba(129, 129, 129, 0.5);

        }



        /* .header .menu .sub-menu::before {
            content: "";
            top: -8px;
            right: 35px;
            position: absolute;
            width: 100%;
            height: 20px;
            background: #f00;
            transform: rotate(45deg);
        } */

        .header .menu .sub-menu-right {
            left: 100%;
            top: -5.5px;
        }

        /* .header .menu .sub-menu-right {
            left: 100%;
            top: 0
        } */

        .header .menu .sub-menu-left {
            left: auto;
            right: 100%;
            top: 0
        }

        .header .menu li:hover>.sub-menu {
            opacity: 1;
            transform: none;
            visibility: visible;
            transition: all 0.5s ease;
        }

        .header .menu .sub-menu a {
            padding: 10px 24px;
            text-transform: uppercase
        }

        .header .menu .sub-menu .dropdown>a {
            padding-right: 34px;
        }

        .header .menu .dropdown .sub-menu li {
            border-top: 1px dashed hsla(115, 24%, 30%, 0.5);
        }



        .header .menu .sub-menu .dropdown>.sub-menu::after {
            display: none;
        }





        .header .menu .sub-menu span {
            background-image: linear-gradient(hsl(0, 0%, 100%), hsl(0, 0%, 100%));
            background-size: 0 1px;
            background-repeat: no-repeat;
            background-position: 0 100%;
            transition: background-size 0.5s ease;

        }

        .header .menu .sub-menu li:hover>a {
            color: #4a7246;
        }

        .header .menu .sub-menu i {
            transform: rotate(-90deg);
            right: 24px;

        }

        .header-right {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: -10px
        }

        .header-right>* {
            margin-left: 25px
        }

        .header-right .icon-btn {
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: hsl(0, 0%, 0%);
            font-size: 16px;
            position: relative;
        }

        .header-right .icon-btn .menu-login {
            top: calc(100% + 30px);
            position: absolute;
            right: 0;
            width: 150px;
            min-height: 100px;
            background: #f8f9fa;
            box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
            display: none;
        }

        .header-right .icon-btn .active {
            display: block;
        }

        .header-right .icon-btn .menu-login::before {
            content: "";
            top: -8px;
            right: 10px;
            position: absolute;
            width: 15px;
            height: 15px;
            background: #f8f9fa;
            transform: rotate(45deg);
            border-left: 1px solid rgba(0, 0, 0, 0.14);
            border-top: 1px solid rgba(0, 0, 0, 0.24);
        }

        .header-right .open-menu-right {
            display: none;

        }

        .header-right .open-menu-btn {
            display: none;
        }

        @media(max-width:991px) {
            .header {
                padding: 12px 0;
            }

            .header .menu {
                position: fixed;
                right: 0;
                top: 0;
                width: 320px;
                height: 100%;
                background-color: #f8f9fa;
                padding: 15px 30px 30px;
                overflow-y: auto;
                z-index: 1;
                transform: translateX(100%);
            }

            .header .menu .sub-menu::after {
                display: none;
            }

            .header .menu.open {
                transform: none;
            }

            .header .menu .head {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 25px;

            }

            .header .menu .close-menu {
                height: 50px;
                width: 50px;
                position: relative;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background-color: transparent;
                cursor: pointer;

            }

            .header .menu .close-menu::before,
            .header .menu .close-menu::after {
                content: "";
                position: absolute;
                width: 80%;
                height: 2px;
                background-color: hsl(0, 0%, 100%);

            }

            .header .menu .close-menu::before {
                transform: rotate(45deg);

            }

            .header .menu .close-menu::after {
                transform: rotate(-45deg);

            }

            .header .menu>ul>li {
                display: block;

            }

            .header .menu>ul>li :not(:last-child) {
                margin-right: 0;
            }

            .header .menu li {
                border-bottom: 1px solid hsla(0, 0%, 100%, 0.25);

            }

            .header .menu li:first-child {
                border-top: 1px solid hsla(0, 0%, 100%, 0.25);

            }

            .header .menu>ul>li>a {
                padding: 12px 0;

            }

            .header .menu>ul>.dropdown>a {
                padding-right: 34px
            }

            .header .menu i {
                height: 34px;
                width: 34px;
                border: 1px solid hsla(0, 0%, 100%, 0.25);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                pointer-events: auto;
                cursor: pointer;
                top: 7px;

            }

            .header .menu .dropdown.active>i {
                background-color: hsl(0, 0%, 100%, 0.25);
                transform: rotate(180deg);
            }

            .header .menu .sub-menu {
                position: static;
                opacity: 1;
                transform: none;
                visibility: visible;
                padding: 0;
                transition: none;
                box-shadow: none;
                width: 100%;
                display: none;
            }

            .header .menu .dropdown.active>.sub-menu {
                display: block;
            }

            .header .menu .sub-menu li:last-child {
                border: none;

            }

            .header .menu .sub-menu a {
                padding: 12px 0 12px 15px;

            }

            .header .menu .sub-menu .sub-menu a {
                padding-left: 30px
            }

            .header .menu .sub-menu .sub-menu .sub-menu a {
                padding-left: 45px
            }

            .header .menu .sub-menu span {
                background-image: none;
            }

            .header .menu .sub-menu i {

                transform: none;
                right: 0;
            }

            .header-right .open-menu-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                height: 40px;
                width: 44px;
                cursor: pointer;
                position: relative;
                background-color: transparent;
                border: none;
            }

            .header-right .open-menu-btn .line {
                height: 2px;
                width: 30px;
                background-color: hsl(0, 0%, 0%);
                position: absolute;
            }

            .header-right .open-menu-btn .line-1 {
                transform: translateY(-8px)
            }

            .header-right .open-menu-btn .line-3 {
                transform: translateY(8px)
            }

            .header .menu .dropdown .sub-menu li {
                border-top: 1px dashed hsla(115, 24%, 30%, 0.5);
            }

        }
    </style>
</head>


<body class="font-sans antialiased">
    <div id="chat_box">

        @include('chat.chat')
    </div>
    <div style="position: relative , z-index:100000;">

        @include('layouts.navigation')
    </div>
    <div class="container">
        <section id='main_content'>
            @yield('content')
        </section>
    </div>
    @include('layouts.footer')




    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/sweetalert.min.js"></script>

    {{-- chatbox --}}
    <script src="/js/pusher.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.2.min.js"
        integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <script src="/js/jquery-cookie.js"></script>
    <script src="/js/chattle_customer.js"></script>
    <script src="/js/handleLogout.js"></script>

    {{-- end chat box --}}

    {{-- Duong --}}
    <script src="js/handleLogout.js"></script>
    <script src="js/handleMenu.js"></script>
    <script src="js/handleSort.js"></script>
    {{-- end Duong --}}

</body>

</html>
