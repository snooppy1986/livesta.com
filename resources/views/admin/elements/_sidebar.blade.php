<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.main')}}" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <?php $user = \Illuminate\Support\Facades\Auth::guard('web')->user() ?>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset($user->avatar_url)}}" class="img-circle elevation-2" alt="User Image" style="background: white; opacity: 0.8;">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{$user->name}} {{$user->surname}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{--<div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>--}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-spa"></i>
                        <p>
                            Товары
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('product.index')}}" class="nav-link">
                                <i class="far fa-list-alt nav-icon"></i>
                                <p>Список товаров</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('product.create')}}" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Добавить товары</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('product.import')}}" class="nav-link">
                                <i class="fas fa-file-import nav-icon"></i>
                                <p>Импорт товаров</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-stream"></i>
                        <p>
                            Категории
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('category.index')}}" class="nav-link">
                                <i class="far fa-list-alt nav-icon"></i>
                                <p>Список категорий</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('category.create')}}" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Добавить категорию</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('category.import')}}" class="nav-link">
                                <i class="fas fa-file-import nav-icon"></i>
                                <p>Импорт категорий</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Пользователи
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-list-alt nav-icon"></i>
                                <p>Список пользователей</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Добавить пользователя</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-cogs nav-icon" aria-hidden="true"></i>
                        <p>
                            Настройки сайта
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('option.main-slider')}}" class="nav-link">
                                <i class="far fa-list-alt nav-icon"></i>
                                <p>Основной слайдер</p>
                            </a>
                        </li>

                        {{--seo info--}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-tags nav-icon" aria-hidden="true"></i>
                                <p>
                                    SEO магазину
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('seo.page')}}" class="nav-link">
                                        <i class="fa fa-book-open nav-icon"></i>
                                        <p>SEO головної сторінки</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Добавить пользователя</p>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
