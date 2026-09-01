<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Crelogics<sup>&copy;</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Content Management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse"
            data-target="#collapseContent" aria-expanded="true"
            aria-controls="collapseContent">
            <i class="fas fa-fw fa-photo-video"></i>
            <span>Content Management</span>
        </a>

        <div id="collapseContent"
            class="collapse {{ request()->routeIs('admin.sliders.*', 'admin.services.*', 'admin.banners.*', 'admin.printing-technologies.*', 'admin.industries.*', 'admin.clients.*', 'admin.testimonials.*') ? 'show' : '' }}"
            aria-labelledby="headingContent"
            data-parent="#accordionSidebar">

            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}"
                    href="{{ route('admin.sliders.index') }}">
                    <i class="fas fa-fw fa-images mr-1"></i> Sliders
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
                    href="{{ route('admin.services.index') }}">
                    <i class="fas fa-fw fa-concierge-bell mr-1"></i> Services
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}"
                    href="{{ route('admin.banners.index') }}">
                    <i class="fas fa-fw fa-ad mr-1"></i> Banners
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.printing-technologies.*') ? 'active' : '' }}"
                    href="{{ route('admin.printing-technologies.index') }}">
                    <i class="fas fa-fw fa-print mr-1"></i> Printing Tech
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.industries.*') ? 'active' : '' }}"
                    href="{{ route('admin.industries.index') }}">
                    <i class="fas fa-fw fa-building mr-1"></i> Industries
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}"
                    href="{{ route('admin.clients.index') }}">
                    <i class="fas fa-fw fa-handshake mr-1"></i> Our Clients
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}"
                    href="{{ route('admin.testimonials.index') }}">
                    <i class="fas fa-fw fa-star mr-1"></i> Testimonials
                </a>

            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Shop Management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse"
            data-target="#collapseShop" aria-expanded="true"
            aria-controls="collapseShop">
            <i class="fas fa-fw fa-store"></i>
            <span>Shop Management</span>
        </a>

        <div id="collapseShop"
            class="collapse {{ request()->routeIs('admin.categories.*', 'admin.subcategories.*', 'admin.products.*', 'admin.blank-products.*', 'admin.blank-categories.*', 'admin.blank-subcategories.*') ? 'show' : '' }}"
            aria-labelledby="headingShop"
            data-parent="#accordionSidebar">

            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                    href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-fw fa-list mr-1"></i> Categories
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.subcategories.*') ? 'active' : '' }}"
                    href="{{ route('admin.subcategories.index') }}">
                    <i class="fas fa-fw fa-layer-group mr-1"></i> Subcategories
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                    href="{{ route('admin.products.index') }}">
                    <i class="fas fa-fw fa-box mr-1"></i> Products
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.blank-products.*') ? 'active' : '' }}"
                    href="{{ route('admin.blank-products.index') }}">
                    <i class="fas fa-fw fa-tshirt mr-1"></i> Blank Products
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.blank-categories.*') ? 'active' : '' }}"
                    href="{{ route('admin.blank-categories.index') }}">
                    <i class="fas fa-fw fa-tags mr-1"></i> Blank Categories
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.blank-subcategories.*') ? 'active' : '' }}"
                    href="{{ route('admin.blank-subcategories.index') }}">
                    <i class="fas fa-fw fa-tags mr-1"></i> Blank Subcategories
                </a>

            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Books Management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse"
            data-target="#collapseBooks" aria-expanded="true"
            aria-controls="collapseBooks">
            <i class="fas fa-fw fa-book-open"></i>
            <span>Books Management</span>
        </a>

        <div id="collapseBooks"
            class="collapse {{ request()->routeIs('admin.book-categories.*', 'admin.authors.*', 'admin.publishers.*', 'admin.books.*') ? 'show' : '' }}"
            aria-labelledby="headingBooks"
            data-parent="#accordionSidebar">

            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item {{ request()->routeIs('admin.book-categories.*') ? 'active' : '' }}"
                    href="{{ route('admin.book-categories.index') }}">
                    <i class="fas fa-fw fa-book mr-1"></i> Book Categories
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.authors.*') ? 'active' : '' }}"
                    href="{{ route('admin.authors.index') }}">
                    <i class="fas fa-fw fa-user-edit mr-1"></i> Authors
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.publishers.*') ? 'active' : '' }}"
                    href="{{ route('admin.publishers.index') }}">
                    <i class="fas fa-fw fa-building mr-1"></i> Publishers
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.books.*') ? 'active' : '' }}"
                    href="{{ route('admin.books.index') }}">
                    <i class="fas fa-fw fa-book-open mr-1"></i> Books
                </a>

            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Portfolio, Orders, Carts (kept as standalone links) -->
    <li class="nav-item {{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.portfolios.index') }}">
            <i class="fas fa-fw fa-images"></i>
            <span>Portfolio</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.orders.index') }}">
            <i class="fas fa-fw fa-shopping-bag"></i>
            <span>Orders</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.carts.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.carts.index') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Carts</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Pages & Contacts -->
    <div class="sidebar-heading">
        Pages & Contacts
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse"
            data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Pages & Contacts</span>
        </a>

        <div id="collapsePages"
            class="collapse {{ request()->routeIs('admin.contact-settings.*', 'admin.faqs.*', 'admin.contact-messages.*', 'admin.sales-visits.*', 'admin.inquiries.*') ? 'show' : '' }}"
            aria-labelledby="headingPages"
            data-parent="#accordionSidebar">

            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item {{ request()->routeIs('admin.contact-settings.*') ? 'active' : '' }}"
                    href="{{ route('admin.contact-settings.index') }}">
                    Contact Settings
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}"
                    href="{{ route('admin.faqs.index') }}">
                    FAQs
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}"
                    href="{{ route('admin.contact-messages.index') }}">
                    Messages
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.sales-visits.*') ? 'active' : '' }}"
                    href="{{ route('admin.sales-visits.index') }}">
                    Sales Visit Requests
                </a>

                <a class="collapse-item {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}"
                    href="{{ route('admin.inquiries.index') }}">
                    Popup Inquiries
                </a>

            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- User Management -->
    <div class="sidebar-heading">
        User Management
    </div>

    <li class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.settings.index') }}">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Settings</span>
        </a>
    </li>

  

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Footer (Custom Branding) -->
    <div class="sidebar-card d-none d-lg-flex text-center">
        <a href="{{ route('home') }}" class="logo mb-2" target="_blank">
            @if(config('app.logo'))
                <img src="{{ asset('storage/' . config('app.logo')) }}" width="111" height="44" alt="{{ config('app.name') }}">
            @else
                <img src="{{ asset('assets/images/logo.png') }}" width="111" height="44" alt="{{ config('app.name') }}">
            @endif
        </a>

        <p class="text-center mb-2">
            <strong>Crelogics</strong><br>
            Digital Solutions & Innovation
        </p>

        <a class="btn btn-primary btn-sm" href="{{ route('home') }}" target="_blank">
            Visit Website
        </a>
    </div>
</ul>