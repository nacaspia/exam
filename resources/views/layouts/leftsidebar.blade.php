<div class="main-sidebar">
    <div class="main-menu">
        <ul class="sidebar-menu scrollable">
            <li class="sidebar-item">
                <a href="{{ route('home') }}" class="sidebar-link">CMS</a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('school-classes.index') }}" class="sidebar-link">{{ __('content.school_classes') }}</a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('subjects.index') }}" class="sidebar-link">{{ __('content.subjects') }}</a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('questions.index') }}" class="sidebar-link">{{ __('content.questions') }}</a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('exams.index') }}" class="sidebar-link">{{ __('content.exams') }}</a>
            </li>
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">{{ __('content.cms_users') }}</a>
                <ul class="sidebar-link-group">
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('cms-users.index') }}" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-calendar"></i></span> <span class="sidebar-txt">{{ __('content.cms_users') }}</span></a>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('roles.index') }}" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-calendar"></i></span> <span class="sidebar-txt">{{ __('content.roles') }}</span></a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">{{ __('content.settings') }}</a>
                <ul class="sidebar-link-group">
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('languages.index') }}" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-calendar"></i></span> <span class="sidebar-txt">{{ __('content.languages') }}</span></a>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('settings.index') }}" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-calendar"></i></span> <span class="sidebar-txt">{{ __('content.settings') }}</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
