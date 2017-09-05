<aside class="bg-white bg-light-ga aside-md hidden-print box-shadow b-r hidden-print" id="nav">          
    <section class="vbox">
        <section class="w-f scrollable">
            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                
                <div class="clearfix search b-b">
                    <div class="navbar-form navbar-left hidden-xs search" role="search">
                        <div class="input-group">
                            <span class="input-group-btn icon-search">
                                <a href="#nav" data-toggle="class:nav-xs,nav-xs" class="btn bg-white btn-icon">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                            <input type="text" data-item="search" class="form-control no-border search" placeholder="Search ...">
                        </div>
                    </div>
                </div>

                <!-- nav -->                 
                <nav class="nav-primary hidden-xs">
                    <ul class="nav clearfix" data-ride="collapse">
                        {{-- <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                            Posts
                        </li> --}}

                        <li class="{{ (config('site.menu') == 'dashboard')? 'active': '' }}">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="icon-speedometer icon"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="{{ (config('site.menu') == 'posts')? 'active': '' }}">
                            <a href="#" class="auto">
                                <span class="pull-right text-muted">
                                    <i class="fa fa-angle-left text"></i>
                                    <i class="fa fa-angle-down text-active"></i>
                                </span>
                                <i class="icon-note icon">
                                </i>
                                <span>{{ __('admin::admin.posts') }}</span>
                            </a>
                            <ul class="nav text-sm">
                                <li class="{{ (config('site.submenu') == 'posts')? 'active': '' }}">
                                    <a href="{{ route('admin.posts.index') }}">
                                        <i class="fa fa-angle-right text-xs"></i>
                                        <span>{{ __('admin::admin.all-posts') }}</span>
                                    </a>
                                </li>
                                <li class="{{ (config('site.submenu') == 'posts')? 'active': '' }}">
                                    <a href="{{ route('admin.posts.create') }}">
                                        <i class="fa fa-angle-right text-xs"></i>
                                        <span>{{ __('admin::admin.add-post') }}</span>
                                    </a>
                                </li>
                                <li class="{{ (config('site.submenu') == 'category')? 'active': '' }}">
                                    <a href="{{ route('admin.categories.index') }}">
                                        <i class="fa fa-angle-right text-xs"></i>
                                        <span>{{ __('admin::admin.category') }}</span>
                                    </a>
                                </li>
                                {{-- <li class="{{ (config('site.submenu') == 'tags')? 'active': '' }}">
                                    <a href="{{ route('admin.tags.index') }}">
                                        <i class="fa fa-angle-right text-xs"></i>
                                        <span>{{ __('admin::admin.tags') }}</span>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                        <li class="{{ (config('site.menu') == 'media')? 'active': '' }}">
                            <a href="#" class="auto">
                                <span class="pull-right text-muted">
                                    <i class="fa fa-angle-left text"></i>
                                    <i class="fa fa-angle-down text-active"></i>
                                </span>
                                <i class="icon-picture icon">
                                </i>
                                <span>{{ __('admin::admin.media') }}</span>
                            </a>
                            <ul class="nav text-sm">
                                <li class="{{ (config('site.submenu') == 'library')? 'active': '' }}">
                                    <a href="{{ route('admin.media.index') }}" >
                                        <i class="fa fa-angle-right text-xs"></i>
                                        <span>{{ __('admin::admin.library') }}</span>
                                    </a>
                                </li>
                                <li class="{{ (config('site.submenu') == 'upload')? 'active': '' }}">
                                    <a href="{{ route('admin.media.create') }}">
                                        <i class="fa fa-angle-right text-xs"></i>
                                        <span>{{ __('admin::admin.add-media') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="{{ (config('site.menu') == 'pages')? 'active': '' }}">
                            <a href="#" class="auto">
                                <span class="pull-right text-muted">
                                    <i class="fa fa-angle-left text"></i>
                                    <i class="fa fa-angle-down text-active"></i>
                                </span>
                                <i class="icon-docs icon">
                                </i>
                                <span>{{ __('admin::admin.pages') }}</span>
                            </a>
                            <ul class="nav text-sm">
                                <li class="{{ (config('site.submenu') == 'pages')? 'active': '' }}">
                                    <a href="{{ route('admin.pages.index') }}">
                                        <i class="fa fa-angle-right text-xs"></i>
                                        <span>{{ __('admin::admin.all-pages') }}</span>
                                    </a>
                                </li>
                                <li class="{{ (config('site.submenu') == 'add-page')? 'active': '' }}">
                                    <a href="{{ route('admin.pages.create') }}">
                                        <i class="fa fa-angle-right text-xs"></i>
                                        <span>{{ __('admin::admin.add-page') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="{{ (config('site.menu') == 'comments')? 'active': '' }}">
                            <a href="{{ route('admin.comments.index') }}">
                                <i class="icon icon-speech text-xs"></i>
                                <span>{{ __('admin::admin.comments') }}</span>
                            </a>
                        </li>
                        
                        @include('layouts.plugins')

                        <li class="{{ (config('site.menu') == 'setting')? 'active': '' }}">
                            <a href="#" class="auto">
                                <span class="pull-right text-muted">
                                    <i class="fa fa-angle-left text"></i>
                                    <i class="fa fa-angle-down text-active"></i>
                                </span>
                                <i class="icon-settings icon">
                                </i>
                                <span>{{ __('admin::admin.settings') }}</span>
                            </a>
                            <ul class="nav text-sm">
                                <li class="{{ (config('site.submenu') == 'general')? 'active': '' }}">
                                    <a href="{{ route('admin.settings.index') }}">
                                        <i class="fa fa-angle-right text-xs"></i>
                                        <span>{{ __('admin::admin.general') }}</span>
                                    </a>
                                </li>
                                <li class="{{ (config('site.submenu') == 'theme')? 'active': '' }}">
                                    <a href="{{ route('admin.themes.index') }}">
                                        <i class="fa fa-angle-right text-xs"></i>
                                        <span>{{ __('admin::admin.theme') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="{{ (config('site.menu') == 'users')? 'active': '' }}">
                            <a href="#" class="auto">
                                <span class="pull-right text-muted">
                                    <i class="fa fa-angle-left text"></i>
                                    <i class="fa fa-angle-down text-active"></i>
                                </span>
                                <i class="icon-users icon">
                                </i>
                                <span>Users</span>
                            </a>
                            <ul class="nav text-sm">
                                <li class="{{ (config('site.submenu') == 'users')? 'active': '' }}">
                                    <a href="{{ route('admin.users.index') }}">
                                        <i class="fa fa-angle-right text-xs"></i>
                                        <span>All Users</span>
                                    </a>
                                </li>
                                <li class="{{ (config('site.submenu') == 'roles')? 'active': '' }}">
                                    <a href="{{ route('admin.roles.index') }}">
                                        <i class="fa fa-angle-right text-xs"></i>
                                        <span>Roles</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- / nav -->
                
            </div>
        </section>
        <footer class="footer bg-light hidden-xs no-padder text-center-nav-xs">
            <a href="http://www.minioncms.com"><span class="cmscode">{{ config('app.name') }}</span></a>
            <ul class="nav-collapse">
                <li class="b-t">
                    <a href="#nav" data-toggle="class:nav-xs,nav-xs" class="text-muted ">
                        <i class="fa fa-angle-left text"></i>
                        <i class="fa fa-angle-right text-active"></i>
                    </a> 
                </li>
            </ul> 
        </footer>
    </section>
</aside>