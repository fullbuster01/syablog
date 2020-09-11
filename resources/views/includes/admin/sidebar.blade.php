            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">Syablog</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">SB</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{ request()->is('admin/dashboard') ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i>
                            <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-header">Starter</li>
                        <li class="nav-item dropdown">
                            <a href="{{ route('post.index') }}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-newspaper"></i>
                                <span>Post</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('post.index') }}">List Post</a></li>
                                <li><a class="nav-link" href="{{ route('post.create') }}">Tambah Post</a></li>
                                <li><a class="nav-link" href="{{ route('post.hapus') }}">List Post dihapus</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="{{ route('thumbnail.index') }}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-image"></i>
                                <span>Thumbnail</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('thumbnail.index') }}">List Thumbnail</a></li>
                                <li><a class="nav-link" href="{{ route('thumbnail.create') }}">Tambah Thumbnail</a></li>
                            </ul>
                        </li>
                        @role('administrator')
                        <li class="nav-item dropdown">
                            <a href="{{ route('category.index') }}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-clone"></i>
                                <span>Kategori</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('category.index') }}">List Kategori</a></li>
                                <li><a class="nav-link" href="{{ route('category.create') }}">Tambah Kategori</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="{{ route('tag.index') }}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-tags"></i>
                                <span>Tag</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('tag.index') }}">List Tag</a></li>
                                <li><a class="nav-link" href="{{ route('tag.create') }}">Tambah Tag</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="{{ route('user.index') }}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                                <span>User</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('user.index') }}">List User</a></li>
                                <li><a class="nav-link" href="{{ route('user.create') }}">Tambah User</a></li>
                            </ul>
                        </li>
                        @endrole
                        <li class="{{ request()->is('admin/profile') ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('profile') }}"><i class="fas fa-user"></i>
                            <span>Profile</span>
                            </a>
                        </li>
                    </ul>
                </aside>
            </div>
