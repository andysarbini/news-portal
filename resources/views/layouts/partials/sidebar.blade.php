{{-- sidebar --}}
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" src="{{ asset('/inspinia/img/profile_small.jpg') }}" />
                     </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                     </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    {{-- menu-profile-user --}}
                     <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>                      
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            
            <li>
                <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Master</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @if (auth()->user()->hasRole('admin'))
                        <li><a href="{{ route('category.index') }}">Kategori</a></li>
                    @endif
                        <li><a href="graph_morris.html">Artikel</a></li>
                        <li><a href="graph_rickshaw.html">Gallery</a></li>
                    
                </ul>
            </li>
            
            <li>
                <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Pengaturan</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @if (auth()->user()->hasRole('admin'))
                        <li><a href="form_basic.html">Setting</a></li>
                    @endif
                        <li><a href="form_advanced.html">Profile</a></li>
                </ul>
            </li>
            
        </ul>
    </div>
</nav>