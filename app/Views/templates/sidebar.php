<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/dashboard" class="app-brand-link">

            <span class="app-brand-text demo menu-text fw-normal ms-2">SABAR</span>
        </a>

        <a href="jascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Menu &amp;
                Utama</span></li>
        <!-- Dashboard -->
        <li class="menu-item <?= (uri_string() == 'dashboard') ? 'active' : '' ?>">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-item <?= (uri_string() == 'kelola-user') ? 'active' : '' ?>">
            <a href="/kelola-user" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="Analytics">Kelola User</div>
            </a>
        </li>

        <li class="menu-item <?= (uri_string() == 'kelola-kategori') ? 'active' : '' ?>">
            <a href="/kelola-kategori" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Analytics">Kelola Kategori</div>
            </a>
        </li>

        <li class="menu-item <?= (uri_string() == 'kelola-lokasi') ? 'active' : '' ?>">
            <a href="/kelola-lokasi" class="menu-link">
                <i class="menu-icon tf-icons bx bx-map"></i>
                <div data-i18n="Analytics">Kelola Lokasi</div>
            </a>
        </li>


        <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Menu</span></li>
        <!-- Dashboard -->
        <li class="menu-item <?= (uri_string() == 'kelola-barang') ? 'active' : '' ?>">
            <a href="/kelola-barang" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Analytics">Data Barang</div>
            </a>
        </li>

    </ul>

</aside>
<!-- / Menu -->