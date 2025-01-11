<aside id="sidebar" class="sidebar break-point-sm has-bg-image">
    <div class="sidebar-layout">
        <div class="sidebar-header">
            <div class="pro-sidebar-logo">
                <a href="{{route('front/index')}}">
                    <img src="{{asset('front/assets/img/logo.png')}}" alt="">
                </a>
            </div>
        </div>
        <div class="sidebar-content">
            <nav class="menu open-current-submenu">
                <ul>
                    {{-- <li class="menu-item sub-menu">
                        <a href="#">
                            <span class="menu-icon">
                                <img src="{{asset('front/assets/icons/1.svg')}}" alt="">
                            </span>
                            <span class="menu-title">قضايا</span>
                        </a>
                        <div class="sub-menu-list">
                            <ul>
                                <li class="menu-item">
                                    <a href="#">
                                        <span class="menu-icon">
                                            <img src="{{asset('front/assets/icons/7.svg')}}" alt="">
                                        </span>
                                        <span class="menu-title">طلبات عروض اسعار</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">
                                        <span class="menu-icon">
                                            <img src="{{asset('front/assets/icons/2.svg')}}" alt="">
                                        </span>
                                        <span class="menu-title">دردشات</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">
                                        <span class="menu-icon">
                                            <img src="{{asset('front/assets/icons/3.svg')}}" alt="">
                                        </span>
                                        <span class="menu-title">الاسئلة</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">
                                        <span class="menu-icon">
                                            <img src="{{asset('front/assets/icons/4.svg')}}" alt="">
                                        </span>
                                        <span class="menu-title">مكالمات</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">
                                        <span class="menu-icon">
                                            <img src="{{asset('front/assets/icons/5.svg')}}" alt="">
                                        </span>
                                        <span class="menu-title">الارشيف</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                    <li class="menu-item sub-menu">
                        <a href="#">
                            <span class="menu-icon">
                                <img src="{{asset('front/assets/icons/6.svg')}}" alt="">
                            </span>
                            <span class="menu-title">الطلبات</span>
                        </a>
                        <div class="sub-menu-list">
                            <ul>
                                @foreach($data['services'] as $service) 
                                    <li class="menu-item">
                                        <a href="{{route('dashboard/service', $service['id'])}}">
                                            <span class="menu-icon">
                                                <img src="{{asset($service['icon'])}}" alt="">
                                            </span>
                                            <span class="menu-title">{{$service['name']}}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('dashboard/home')}}">
                            <span class="menu-icon">
                                <img src="{{asset('front/assets/icons/blog.svg')}}" alt="">
                            </span>
                            <span class="menu-title">الرئيسيه</span>
                        </a>
                    </li>

                    @if(auth()->guard('lawyer')->check()) 
                        <li class="menu-item">
                            <a href="{{route('dashboard/blogs')}}">
                                <span class="menu-icon">
                                    <img src="{{asset('front/assets/icons/blog.svg')}}" alt="">
                                </span>
                                <span class="menu-title">مدونة قانونية</span>
                            </a>
                        </li>
                    @endif

                    <li class="menu-item">
                        <a href="{{route('dashboard/settings/get')}}">
                            <span class="menu-icon">
                                <img src="{{asset('front/assets/icons/settings.svg')}}" alt="">
                            </span>
                            <span class="menu-title">الاعدادات</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('dashboard/logout')}}">
                            <span class="menu-icon">
                                <img src="{{asset('front/assets/icons/logout.svg')}}" alt="">
                            </span>
                            <span class="menu-title">تسجيل خروج</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>
<div id="overlay" class="overlay"></div>