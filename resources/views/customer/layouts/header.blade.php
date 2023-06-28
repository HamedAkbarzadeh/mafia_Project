<!-- Start of Header============================================= -->
<header>
    <div id="main-menu" class="main-menu-container tbg navbar-fixed-top">
        <div  class="main-menu">
            <div class="container">
                <div class="row">
                    <div class="navbar navbar-default" role="navigation">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <i class="ti-menu"></i>
                                </button><!-- /.navbar-toggle collapsed -->
                                <a class="navbar-brand text-uppercase" href="#"><img src="{{ asset($logoURL) }}" alt="logo"></a>
                            </div><!-- /.navbar-header -->
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <nav class="collapse navbar-collapse navbar-left" id="bs-example-navbar-collapse-1">
                                <ul id="main-nav" class="nav navbar-nav">
                                    <li><a href="#rules">قوانین بازی</a></li>
                                    @guest
                                    <li>
                                        <a href="{{ route('login') }}">
                                        <i class=" m-2"></i> ورود </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('register') }}">
                                        <i class=" m-2"></i>ثبت نام</a>
                                    </li>
                                    @endguest
                                    @auth
                                    <li>
                                        <a href="{{ route('login') }}">
                                        <i class="fa fa-user m-2"></i> ورود به پنل کاربری </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('auth.customer.logout') }}">
                                        <i class=" m-2"></i>خروج </a>
                                    </li>
                                    @endauth
                                </ul><!-- /#main-nav -->
                            </nav><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </div><!-- /.navbar navbar-default -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.full-main-menu -->
    </div><!-- #main-menu -->
    <!-- Main Menu end -->
</header> <!-- .cd-auto-hide-header -->
<!-- End of Header ============================================= -->
