<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Panel</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="{{ route('panel.slider.index') }}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Slider </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="{{ route('panel.category.index') }}" >
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Kategori</span>
            </a>
        <li class="nav-item">
            <a class="nav-link"  href="{{ route('panel.about.index') }}" >
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Hakkımızda  </span>
            </a>

        </li>
        <li class="nav-item">
            <a class="nav-link"  href="{{ route('panel.contact.index') }}">
                <i class="icon-mail menu-icon"></i>
                <span class="menu-title">Gelen Kutusu</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="{{ route('panel.setting.index') }}">
                <i class="icon-contract menu-icon"></i>
                <span class="menu-title">Site Ayarları</span>
            </a>
        </li>




        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="icon-grid-2 menu-icon"></i>
                <span class="menu-title">Tables</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="icon-contract menu-icon"></i>
                <span class="menu-title">Icons</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                <i class="icon-ban menu-icon"></i>
                <span class="menu-title">Error pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Documention</span>
            </a>
        </li>

    </ul>
</nav>
