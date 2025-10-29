<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/dashboard" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="/assets/img/favicon/sabar.png" alt="Logo" width="160">
            </span>

        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Menu &amp;
                Utama</span></li>
        <!-- Dashboard -->
        <li class="menu-item                                                                                                                                                                          <?php echo(uri_string() == 'dashboard') ? 'active' : '' ?>">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-item                                                                                                                                                                         <?php echo(uri_string() == 'kelola-user') ? 'active' : '' ?>">
            <a href="/kelola-user" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="Analytics">Kelola User</div>
            </a>
        </li>

        <li class="menu-item                                                                                                                                                                          <?php echo(uri_string() == 'kelola-kategori') ? 'active' : '' ?>">
            <a href="/kelola-kategori" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Analytics">Kelola Kategori</div>
            </a>
        </li>

        <li class="menu-item                                                                                                                                                                          <?php echo(uri_string() == 'kelola-lokasi') ? 'active' : '' ?>">
            <a href="/kelola-lokasi" class="menu-link">
                <i class="menu-icon tf-icons bx bx-map"></i>
                <div data-i18n="Analytics">Kelola Lokasi</div>
            </a>
        </li>


        <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Menu</span></li>
        <!-- Dashboard -->
        <li class="menu-item                                                                                                                 <?php echo(uri_string() == 'kelola-barang') ? 'active' : '' ?>">
            <a href="/kelola-barang" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Analytics">Data Barang</div>
            </a>
        </li>
        <li class="menu-item<?php echo(uri_string() == 'master-aset' || uri_string() == 'master-aset/inaktif') ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Analytics">Master Aset</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item                                                                                                                                                                                                                         <?php echo(uri_string() == 'master-aset') ? 'active' : ''; ?>">
                    <a href="/aset-aktif" class="menu-link">
                        <div data-i18n="Master Aset Aktif">Data Aset Aktif</div>
                    </a>
                </li>
                <li class="menu-item                                                                                                                                                                                                                         <?php echo(uri_string() == 'master-aset/inaktif') ? 'active' : ''; ?>">
                    <a href="/aset-inaktif" class="menu-link">
                        <div data-i18n="Master Aset Inaktif">Data Aset Inaktif</div>
                    </a>
                </li>
            </ul>
        </li>

    </ul>

</aside>
<!-- / Menu -->