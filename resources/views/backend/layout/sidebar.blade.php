    <aside id="layout-menu" class="layout-menu menu-vertical menu" style="background-color:azure">
        <div class="app-brand demo ">
        <a href="index.html" class="app-brand-link">
            <img src="{{ asset('public/frontend/assets/img/logo_alertf.png') }}" alt="logo">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
            <i class="icon-base ti tabler-x d-block d-xl-none"></i>
        </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" style="font-weight:bold">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-smart-home"></i>
                <div data-i18n="Tableau de bord">Tableau de bord</div>
            </a>
        </li>

        @php
            $parametreActive = request()->routeIs('parametre.*');
        @endphp

        <li class="menu-item {{ $parametreActive ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-settings"></i>
                <div data-i18n="Paramètres" style="font-weight:bold">Paramètres</div>
                {{-- <div class="badge text-bg-danger rounded-pill ms-auto">5</div> --}}
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('parametre.type_client') ? 'active' : '' }}">
                    <a href="{{ route('parametre.type_client') }}" class="menu-link">
                    <div data-i18n="Type de clients">Type de clients</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('parametre.categorie') ? 'active' : '' }}">
                    <a href="{{ route('parametre.categorie') }}" class="menu-link">
                    <div data-i18n="Catégorie de produits">Catégorie de produits</div>
                    </a>
                </li>
            
            </ul>
        </li>
        <li class="menu-item {{ request()->routeIs('prod.produit') ? 'active' : '' }}" style="font-weight:bold">
            <a href="{{ route('prod.produit') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-components"></i>
                <div data-i18n="Produits">Produits</div>
            </a>
        </li>
        <li class="menu-item" style="font-weight:bold">
            <a href="{{ route('prod.produit') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-file-dollar"></i>
                <div data-i18n="Paiements">Paiements</div>
            </a>
        </li>
        <li class="menu-item" style="font-weight:bold">
            <a href="{{ route('prod.temoignage') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-forms"></i>
                <div data-i18n="Témoignages">Témoignages</div>
            </a>
        </li>
        <li class="menu-item" style="font-weight:bold">
            <a href="{{ route('prod.produit') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-layout-navbar"></i>
                <div data-i18n="Ressources">Ressources</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon icon-base ti tabler-users"></i>
            <div data-i18n="Users" style="font-weight:bold">Users</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item">
                <a href="app-user-list.html" class="menu-link">
                <div data-i18n="List">List</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="View">View</div>
                </a>
                <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-user-view-account.html" class="menu-link">
                    <div data-i18n="Account">Account</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-user-view-security.html" class="menu-link">
                    <div data-i18n="Security">Security</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-user-view-billing.html" class="menu-link">
                    <div data-i18n="Billing & Plans">Billing & Plans</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-user-view-notifications.html" class="menu-link">
                    <div data-i18n="Notifications">Notifications</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-user-view-connections.html" class="menu-link">
                    <div data-i18n="Connections">Connections</div>
                    </a>
                </li>
                </ul>
            </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon icon-base ti tabler-settings"></i>
            <div data-i18n="Roles & Permissions" style="font-weight:bold">Roles & Permissions</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item">
                <a href="app-access-roles.html" class="menu-link">
                <div data-i18n="Roles">Roles</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="app-access-permission.html" class="menu-link">
                <div data-i18n="Permission">Permission</div>
                </a>
            </li>
            </ul>
        </li>

    </aside>

    <div class="menu-mobile-toggler d-xl-none rounded-1">
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
        <i class="ti tabler-menu icon-base"></i>
        <i class="ti tabler-chevron-right icon-base"></i>
        </a>
    </div>