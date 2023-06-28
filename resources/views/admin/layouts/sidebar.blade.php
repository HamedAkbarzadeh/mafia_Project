<aside id="sidebar" class="sidebar">
    <section class="sidebar-container">
        <section class="sidebar-wrapper">

            <a href="{{ route('customer.home') }}" class="sidebar-link">
                <i class="fas fa-home"></i>
                <span>خانه</span>
            </a>

            <a href="{{ route('user-panel.index') }}" class="sidebar-link">
                <i class="fas fa-house-user"></i>
                <span>ورود به پنل کاربری</span>
            </a>
            <section class="sidebar-part-title">رویداد ها </section>

            {{-- /// new /// --}}
            @can('read-event')
            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>مسابقات </span>
                    <i class="fas fa-angle-left angle"></i>
                </section>

                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.event.index') }}"> تمام مسابقات</a>
                    <a href="{{ route('admin.event.over') }}">مسابقات تمام شده </a>
                    <a href="{{ route('admin.event.ahead') }}">مسابقات پیش رو</a>
                </section>

            </section>
            @endcan
            @can('read-mafia')
            <a href="{{ route('admin.event.role.index') }}" class="sidebar-link">
                <i class="fas fa-user-secret"></i>
                <span> نقش های مافیا</span>
            </a>
            @endcan
            @can('read-notify')
            <a href="{{ route('admin.event.notification') }}" class="sidebar-link">
                <i class="fas fa-comment"></i>
                <span>اعلانات</span>
            </a>
            @endcan
            {{-- /// new /// --}}







            <section class="sidebar-part-title">بخش کاربران</section>

            @can(['read-permission' , 'read-role'])
            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>سطوح دسترسی</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.user.role.index') }}">مدیریت نقش ها</a>
                    <a href="{{ route('admin.user.permission.index') }}">مدیریت دسترسی</a>
                </section>
            </section>
            @endcan

            @can('read-admin')
            <a href="{{ route('admin.user.admin-user.index') }}" class="sidebar-link">
                <i class="fas fa-users"></i>
                <span>کاربران ادمین</span>
            </a>
            @endcan
            @can('read-user')
            <a href="{{ route('admin.user.customer.index') }}" class="sidebar-link">
                <i class="fas fa-users-cog"></i>
                <span>مشتریان</span>
            </a>
            @endcan





            @can(['read-SMS' , 'read-email'])
            <section class="sidebar-part-title">اطلاع رسانی</section>
            <a href="{{ route('admin.notify.email.index') }}" class="sidebar-link">
                <i class="fas fa-envelope"></i>
                <span>اعلامیه ایمیلی</span>
            </a>
            <a href="{{ route('admin.notify.sms.index') }}" class="sidebar-link">
                <i class="fas fa-envelope-open-text"></i>
                <span>اعلامیه پیامکی</span>
            </a>
            @endcan



            @can('read-setting')
            <section class="sidebar-part-title">تنظیمات</section>
            <a href="{{ route('admin.setting.index') }}" class="sidebar-link">
                <i class="fas fa-cog"></i>
                <span>تنظیمات</span>
            </a>
            @endcan

            <a href="{{ route('admin.logout') }}" class="sidebar-link">
                <i class="fas fa-user"></i>
                <span>خروج</span>
            </a>
        </section>
    </section>
</aside>
