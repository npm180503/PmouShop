<style>
    .active {
        font-weight: bold;
        /* Hoặc bất kỳ kiểu dáng nào bạn muốn */
        color: #ff6347
            /* Màu sắc cho mục đang được chọn */
    }
</style>
<div>
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">

            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop container">

                    <!-- Logo desktop -->
                    <a href="{{ route('fr.homepage') }}" class="logo">
                        <img src="/template/admin/dist/img/download.jpg" alt="AdminLTE Logo"
                            class="brand-image img-circle elevation-3"
                            style="opacity: .8; width: 50px; height: 120px; border-radius: 50%;">
                        <span class="brand-text"
                            style="font-family: 'Lobster', cursive; font-size: 32px; color: #ff6347; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding-left: 10px; margin-top: 5px;">PmouShop</span>
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li class="{{ request()->is('/') ? 'active' : '' }}">
                                <a href="{{ route('fr.homepage') }}">Trang chủ</a>
                            </li>


                            <li>
                                <a href="{{ route('fr.product') }}">Cửa hàng</a>
                            </li>


                            <li class="{{ request()->is('about') ? 'active' : '' }}">
                                <a href="{{ route('fr.about') }}">Giới thiệu</a>
                            </li>

                            <li class="{{ request()->is('/') ? 'active' : '' }}">
                                <a href="{{ route('fr.contact') }}">Liên hệ</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">

                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                            data-notify="2">
                            <i class="fa-regular fa-bell"></i>
                        </div>
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                            data-notify="2">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>

                        <a href="{{ route('fr.login') }}"
                            class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
                            @auth('frontend')
                                <!-- Nếu đã đăng nhập, hiển thị icon đăng xuất và thực hiện hành động đăng xuất -->
                                <form action="{{ route('fr.logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="icon-btn">
                                        <i class="fa-solid fa-right-from-bracket"></i> <!-- Icon đăng xuất -->
                                    </button>
                                </form>
                            @else
                                <!-- Nếu chưa đăng nhập, hiển thị icon tài khoản -->
                                <i class="zmdi zmdi-account"></i> <!-- Icon tài khoản -->
                            @endauth
                        </a>


                    </div>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="index.html">
                    <img src="/template/admin/dist/img/download.jpg" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3"
                        style="opacity: .8; width: 50px; height: 120px; border-radius: 50%; margin-top:10px;">
                    <span class="brand-text"
                        style="font-family: 'Lobster', cursive; font-size: 32px; color: #ff6347; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding-left: 60px;">PmouShop</span>
                </a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                    data-notify="2">
                    <i class="fa-regular fa-bell"></i>
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                    data-notify="2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="{{ route('fr.login') }}"
                class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
                @auth('frontend')
                    <!-- Nếu đã đăng nhập, hiển thị icon đăng xuất và thực hiện hành động đăng xuất -->
                    <form action="{{ route('fr.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="icon-btn">
                            <i class="fa-solid fa-right-from-bracket"></i> <!-- Icon đăng xuất -->
                        </button>
                    </form>
                @else
                    <!-- Nếu chưa đăng nhập, hiển thị icon tài khoản -->
                    <i class="zmdi zmdi-account"></i> <!-- Icon tài khoản -->
                @endauth
            </a>
            
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">

            <ul class="main-menu-m">
                <li class="active-menu">
                    <a href="{{ route('fr.homepage') }}">Trang chủ</a>
                </li>

                <li>
                    <a href="{{ route('fr.product') }}">Cửa hàng</a>
                </li>


                <li>
                    <a href="{{ route('fr.about') }}">Giới thiệu</a>
                </li>

                <li>
                    <a href="{{ route('fr.contact') }}">Liên hệ</a>
                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="/template/images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>
</div>
