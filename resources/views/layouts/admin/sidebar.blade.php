<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </li>
            <li>
                <a href="{{route('admin/index')}}" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Admins<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/admins/index')}}/0/{{PAGINATION_COUNT}}">Admins</a>
                    </li>
                    <li>
                        <a href="{{route('admin/admins/create')}}">Add Admin</a>
                    </li>
                    <!-- <li>
                        <a href="{{route('admin/admins/archives')}}/0/{{PAGINATION_COUNT}}">Archives</a>
                    </li> -->
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Users<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/users/index')}}/0/{{PAGINATION_COUNT}}">Users</a>
                    </li>
                    <li>
                        <a href="{{route('admin/users/create')}}">Add User</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Lawyers<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/lawyers/index')}}/0/{{PAGINATION_COUNT}}">Lawyers</a>
                    </li>
                    <li>
                        <a href="{{route('admin/lawyers/create')}}">Add Lawyer</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Blogs<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/blogs/index')}}/0/{{PAGINATION_COUNT}}">Blogs</a>
                    </li>
                    <li>
                        <a href="{{route('admin/blogs/create')}}">Add Blog</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Process<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/process/index')}}/0/{{PAGINATION_COUNT}}">Process</a>
                    </li>
                    <li>
                        <a href="{{route('admin/process/create')}}">Add Proces</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Countries<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/countries/index')}}/0/{{PAGINATION_COUNT}}">Countries</a>
                    </li>
                    <li>
                        <a href="{{route('admin/countries/create')}}">Add Country</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Cities<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/cities/index')}}/0/{{PAGINATION_COUNT}}">Cities</a>
                    </li>
                    <li>
                        <a href="{{route('admin/cities/create')}}">Add City</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Languages<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/languages/index')}}/0/{{PAGINATION_COUNT}}">Languages</a>
                    </li>
                    <li>
                        <a href="{{route('admin/languages/create')}}">Add Language</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Services<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/services/index')}}/0/{{PAGINATION_COUNT}}">Services</a>
                    </li>
                    <!-- <li>
                        <a href="{{route('admin/services/create')}}">Add Service</a>
                    </li> -->
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Sections<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/sections/index')}}/0/{{PAGINATION_COUNT}}">Sections</a>
                    </li>
                    <li>
                        <a href="{{route('admin/sections/create')}}">Add Section</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Subjects<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/subjects/index')}}/0/{{PAGINATION_COUNT}}">Subjects</a>
                    </li>
                    <li>
                        <a href="{{route('admin/subjects/create')}}">Add Subject</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Legal Fields<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/legalFields/index')}}/0/{{PAGINATION_COUNT}}">Legal Fields</a>
                    </li>
                    <li>
                        <a href="{{route('admin/legalFields/create')}}">Add Legal Field</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Settings<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/settings/index')}}">Settings</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Abouts<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/abouts/index')}}/0/{{PAGINATION_COUNT}}">Abouts</a>
                    </li>
                    <li>
                        <a href="{{route('admin/abouts/create')}}">Add Abouts</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Contacts<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/contacts/index')}}/0/{{PAGINATION_COUNT}}">Contacts</a>
                    </li>
                </ul>
            </li>
            <li><a href="#"></a></li><li><a href="#"></a></li><li><a href="#"></a></li><li><a href="#"></a></li>
            <li><a href="#"></a></li><li><a href="#"></a></li><li><a href="#"></a></li><li><a href="#"></a></li>
            {{-- <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Chat<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/chats/index')}}">Chat</a>
                    </li>
                    <li>
                        <a href="{{route('admin/test/index')}}">test</a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </div>
</div>
