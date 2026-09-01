<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Crelogics</title>
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    @stack('styles')
    <style>
        /* Force all buttons to use the requested color #25A6D9 */
        .btn, .btn-primary, .btn-secondary, .btn-dark, .btn-success, .btn-info, .btn-warning, .btn-danger, button:not(.mfp-close):not(.close), input[type="submit"], input[type="button"] {
            background-color: #25A6D9 !important;
            border-color: #25A6D9 !important;
            color: #ffffff !important;
        }
        .btn:hover, .btn-primary:hover, .btn-secondary:hover, .btn-dark:hover, button:not(.mfp-close):not(.close):hover, input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #25A6D9 !important;
            border-color: #25A6D9 !important;
            color: #ffffff !important;
        }

        /* Custom Toast Notification Styles */
        .custom-toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10000;
        }
        .custom-toast {
    position: relative;
    display: flex;
    align-items: center;
    gap: 12px;
    background: #fff;
    color: #333;
    min-width: 320px;
    max-width: 420px;
    padding: 15px;
    margin-bottom: 12px;
    border-radius: 8px;
    box-shadow: 0 8px 20px rgba(0,0,0,.15);
    border-left: 5px solid #ddd;
    opacity: 0;
    transform: translateX(100%);
    transition: .35s ease;
    overflow: hidden;
}

.custom-toast.show{
    opacity:1;
    transform:translateX(0);
}

.custom-toast i{
    font-size:22px;
    flex-shrink:0;
}

.custom-toast-content{
    flex:1;
    margin:0;
    font-size:14px;
    line-height:1.5;
}

.custom-toast-close{
    cursor:pointer;
    font-size:18px;
    color:#999;
}

.custom-toast-close:hover{
    color:#333;
}

/* Success */
.custom-toast.success{
    border-left-color:#28a745;
}
.custom-toast.success i{
    color:#28a745;
}

/* Error */
.custom-toast.error{
    border-left-color:#dc3545;
}
.custom-toast.error i{
    color:#dc3545;
}

/* Warning */
.custom-toast.warning{
    border-left-color:#ffc107;
}
.custom-toast.warning i{
    color:#ffc107;
}

/* Info */
.custom-toast.info{
    border-left-color:#17a2b8;
}
.custom-toast.info i{
    color:#17a2b8;
}
        .custom-toast-content {
            flex-grow: 1;
            margin-left: 10px;
            font-size: 14px;
            font-weight: 500;
        }
        .custom-toast-close {
            cursor: pointer;
            color: #999;
            font-size: 18px;
            line-height: 1;
            margin-left: 10px;
        }
        .custom-toast-close:hover { color: #333; }

        /* Hide the native bootstrap alert-success since we are using Toasts now */
        .alert-success {
            display: none !important;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        @include('admin.layouts.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('admin.layouts.navbar')

                <div class="container-fluid">
                    @yield('content')
                </div>

            </div>

            @include('admin.layouts.footer')

        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

    @stack('scripts')

    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script>

    <div id="toast-container" class="custom-toast-container"></div>
    <script>
       function showToast(message, type) {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');

    let iconClass = 'fa-info-circle';

    switch (type) {
        case 'success':
            iconClass = 'fa-check-circle';
            break;
        case 'error':
            iconClass = 'fa-times-circle';
            break;
        case 'warning':
            iconClass = 'fa-exclamation-triangle';
            break;
        case 'info':
            iconClass = 'fa-info-circle';
            break;
    }

    toast.className = `custom-toast ${type}`;
    toast.innerHTML = `
        <i class="fas ${iconClass} fa-lg"></i>
        <div class="custom-toast-content">${message}</div>
        <span class="custom-toast-close">&times;</span>
    `;

    container.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('show');
    }, 10);

    const closeToast = () => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 400);
    };

    setTimeout(closeToast, 5000);

    toast.querySelector('.custom-toast-close').addEventListener('click', closeToast);
}

        @if(session('success'))
            showToast("{{ session('success') }}", 'success');
        @endif
        @if(session('error'))
            showToast("{{ session('error') }}", 'error');
        @endif
        @if(session('warning'))
            showToast("{{ session('warning') }}", 'warning');
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                showToast("{{ $error }}", 'error');
            @endforeach
        @endif
    </script>
</body>

</html>
