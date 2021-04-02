<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}"><h2>{{ __("site.blog") }}<em>.</em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ Route::is("index") ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('index') }}">{{ GetSettingTransByKey("navbar_trans_home") }}
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is("categoriesIndex") || Route::is("categoriesShow") ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('categoriesIndex') }}">{{ GetSettingTransByKey("navbar_trans_categories") }}</a>
                    </li>
                    <li class="nav-item {{ Route::is("blogsIndex") || Route::is("blogsShow") ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('blogsIndex') }}">{{ GetSettingTransByKey("navbar_trans_blogs") }}</a>
                    </li>
                    @if(App::isLocale('ar'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('lang.change', ['en']) }}"> English </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('lang.change', ['ar']) }}"> عربى </a>
                        </li>
                    @endif
                </ul>
                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @unlessrole('Normal_Role')
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{ __("site.dashboard") }}</a>
                                @endunlessrole
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('site.logout') }} </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="none"> @csrf </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"> {{ __('site.sign_in') }} </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"> {{ __('site.sign_up') }} </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="heading-page header-text">
    <section class="page-heading" style="background-image: url('/enduser/images/heading-bg.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content {{ App::isLocale('ar') ? 'text-left' : '' }}">
                        <h4>{{ $title ?? '' }}</h4>
                        <h2>{{ $sub_title ?? '' }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
