<div class="main-sidebar">
    <div class="main-menu">
        <ul class="sidebar-menu scrollable">
            @if(cms_user()->hasPermission('home-page'))
            <li class="sidebar-item">
                <a href="{{ route('home') }}" class="sidebar-link">CMS</a>
            </li>
            @endif
            @if(cms_user()->hasPermission('school-classes-index'))
            <li class="sidebar-item">
                <a href="{{ route('school-classes.index') }}" class="sidebar-link">{{ __('content.school_classes') }}</a>
            </li>
            @endif
            @if(cms_user()->hasPermission('subjects-index'))
            <li class="sidebar-item">
                <a href="{{ route('subjects.index') }}" class="sidebar-link">{{ __('content.subjects') }}</a>
            </li>
            @endif
            @if(cms_user()->hasPermission('questions-index'))
            <li class="sidebar-item">
                <a href="{{ route('questions.index') }}" class="sidebar-link">{{ __('content.questions') }}</a>
            </li>
            @endif
            @if(cms_user()->hasPermission('exams-index'))
            <li class="sidebar-item">
                <a href="{{ route('exams.index') }}" class="sidebar-link">{{ __('content.exams') }}</a>
            </li>
            @endif
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">{{ __('content.user_abouts') }}</a>
                <ul class="sidebar-link-group">
                    @if(cms_user()->hasPermission('users-index'))
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('users.index') }}" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-calendar"></i></span> <span class="sidebar-txt">{{ __('content.users') }}</span></a>
                    </li>
                    @endif
                </ul>
            </li>
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">{{ __('content.cms_users') }}</a>
                <ul class="sidebar-link-group">
                    @if(cms_user()->hasPermission('cms-user-index'))
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('cms-users.index') }}" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-calendar"></i></span> <span class="sidebar-txt">{{ __('content.cms_users') }}</span></a>
                    </li>
                    @endif
                    @if(cms_user()->hasPermission('role-index'))
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('roles.index') }}" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-calendar"></i></span> <span class="sidebar-txt">{{ __('content.roles') }}</span></a>
                    </li>
                    @endif
                </ul>
            </li>
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">{{ __('content.settings') }}</a>
                <ul class="sidebar-link-group">
                    @if(cms_user()->hasPermission('languages-index'))
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('languages.index') }}" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-calendar"></i></span> <span class="sidebar-txt">{{ __('content.languages') }}</span></a>
                    </li>
                    @endif
                    @if(cms_user()->hasPermission('settings-index'))
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('settings.index') }}" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-calendar"></i></span> <span class="sidebar-txt">{{ __('content.settings') }}</span></a>
                    </li>
                    @endif
                </ul>
            </li>
        </ul>
    </div>
</div>
