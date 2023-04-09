<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{ asset('backend') }}/assets/img/admin-avatar.png" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong"> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </div><small>Administrator</small></div>
        </div>
        <ul class="side-menu metismenu">
            @permission('app.dashboard')  {{-- j login korbe se dashboard button er access pabe na. --}}
                <li>
                    <a class="active" href="{{ route('app.dashboard') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                        <span class="nav-label">Dashboard</span>
                    </a>
                </li>
            @endpermission

            <li class="heading">FEATURES</li>

            {{-- <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Basic UI</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="colors.html">Colors</a>
                    </li>
                    <li>
                        <a href="">User</a>
                    </li>
                    <li>
                        <a href="panels.html">Panels</a>
                    </li>
                    <li>
                        <a href="buttons.html">Buttons</a>
                    </li>
                    <li>
                        <a href="tabs.html">Tabs</a>
                    </li>
                    <li>
                        <a href="alerts_tooltips.html">Alerts &amp; Tooltips</a>
                    </li>
                    <li>
                        <a href="badges_progress.html">Badges &amp; Progress</a>
                    </li>
                    <li>
                        <a href="lists.html">List</a>
                    </li>
                    <li>
                        <a href="cards.html">Card</a>
                    </li>
                </ul>
            </li> --}}

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                    <span class="nav-label">Forms</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    @permission('app.roles.index')
                        <li>
                            <a href="{{ route('app.roles.index') }}">Role</a>
                        </li>
                    @endpermission

                    @permission('app.users.index')
                        <li>
                            <a href="{{ route('app.users.index') }}"> User </a>
                        </li>
                    @endpermission

                    <li>
                        <a href="form_masks.html">Form input masks</a>
                    </li>
                    <li>
                        <a href="form_validation.html">Form Validation</a>
                    </li>
                    <li>
                        <a href="text_editors.html">Text Editors</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
