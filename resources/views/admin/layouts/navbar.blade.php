<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Orders Notification Bell -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                @if($navOrdersCount > 0)
                    <span class="badge badge-danger badge-counter">{{ $navOrdersCount > 99 ? '99+' : $navOrdersCount }}</span>
                @endif
            </a>

            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown" style="min-width: 320px;">
                <h6 class="dropdown-header bg-primary text-white">
                    <i class="fas fa-shopping-bag mr-1"></i> Orders &mdash; {{ $navOrdersCount }} Total
                </h6>

                @php
                    $recentOrders = \App\Models\Order::whereIn('order_status', ['pending', 'processing'])->latest()->take(5)->get();
                @endphp

                @forelse($recentOrders as $order)
                <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('admin.orders.index') }}">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-shopping-bag text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">{{ $order->created_at->diffForHumans() }}</div>
                        <span class="font-weight-bold">Order #{{ $order->order_number ?? $order->id }}</span>
                        &mdash; <span class="text-muted">{{ $order->first_name }} {{ $order->last_name }}</span>
                    </div>
                </a>
                @empty
                <div class="dropdown-item text-center text-muted py-3">No orders yet.</div>
                @endforelse

                <a class="dropdown-item text-center small text-gray-500 py-2" href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-list mr-1"></i> View All Orders
                </a>
            </div>
        </li>

        <!-- Contact Messages Envelope -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                @if($navUnreadMessages > 0)
                    <span class="badge badge-danger badge-counter">{{ $navUnreadMessages > 99 ? '99+' : $navUnreadMessages }}</span>
                @endif
            </a>

            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown" style="min-width: 320px;">
                <h6 class="dropdown-header bg-primary text-white">
                    <i class="fas fa-envelope mr-1"></i> Messages &mdash; {{ $navUnreadMessages }} Unread
                </h6>

                @php
                    $recentMessages = \App\Models\ContactMessage::where('is_read', 0)->latest()->take(5)->get();
                @endphp

                @forelse($recentMessages as $msg)
                <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('admin.contact-messages.index') }}">
                    <div class="dropdown-list-image mr-3">
                        <div class="icon-circle {{ $msg->is_read ? 'bg-secondary' : 'bg-success' }}">
                            <i class="fas fa-envelope text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">
                            {{ $msg->created_at->diffForHumans() }}
                            @if(!$msg->is_read)
                                <span class="badge badge-success ml-1">New</span>
                            @endif
                        </div>
                        <div class="font-weight-bold text-truncate" style="max-width:230px;">
                            {{ $msg->name }} &mdash; <span class="font-weight-normal text-muted">{{ Str::limit($msg->message, 50) }}</span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="dropdown-item text-center text-muted py-3">No messages yet.</div>
                @endforelse

                <a class="dropdown-item text-center small text-gray-500 py-2" href="{{ route('admin.contact-messages.index') }}">
                    <i class="fas fa-list mr-1"></i> View All Messages
                </a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                        {{ Auth::user()->name ?? '' }}
                    </span>
                <img class="img-profile rounded-circle" src="{{ asset('admin/img/undraw_profile.svg') }}">
            </a>

            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

