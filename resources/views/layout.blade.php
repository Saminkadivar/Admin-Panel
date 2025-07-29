<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & DataTables -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">

    <style>
       /* Default Light Mode Styles */
body {
    background-color: #f2f2f2;
    color: #212529;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Dark Mode Override */
body.dark-mode {
    background-color: #2c2c2c;
    color: #ffffff;
}

/* Header */
header {
    background-color: #ffffff;
    color: #212529;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    border-bottom: 1px solid #dee2e6;
    position: sticky;
    top: 0;
    z-index: 999;
}

body.dark-mode header {
    background-color: #222;
    color: white;
    border-bottom: 1px solid #444;
}

/* Sidebar */
.sidebar {
    width: 220px;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    background: #ffffff;
    padding-top: 20px;
    border-right: 1px solid #dee2e6;
}

body.dark-mode .sidebar {
    background-color: #222;
    color: white;
    border-right: 1px solid #444;
}

.sidebar a {
    display: block;
    color: #212529;
    padding: 12px 20px;
    text-decoration: none;
}

.sidebar a:hover {
    background: #f1f1f1;
}

body.dark-mode .sidebar a {
    color: #c5c6c7;
}

body.dark-mode .sidebar a:hover {
    background: #32344a;
    color: white;
}

/* Main Content */
.main {
    margin-left: 240px;
    padding: 20px;
}

/* Dropdown Menu */
.dropdown-menu {
    background-color: #ffffff;
    color: #212529;
}

body.dark-mode .dropdown-menu {
    background-color: #333;
    color: white;
}

body.dark-mode .dropdown-item {
    color: #cfd1d6;
}

body.dark-mode .dropdown-item:hover {
    background-color: #222; /* fixed typo from #22222 */
    color: white;
}

/* Dark/Light Mode Toggle Button */
#modeToggle {
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 5px 10px;
    font-size: 0.875rem;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
    border: 1px solid #212529;
    background-color: #f8f9fa;
    color: #212529;
}

body.dark-mode #modeToggle {
    border-color: #ccc;
    color: #fff;
    background-color: #333;
}

#modeToggle:hover {
    background-color: #212529;
    color: #fff;
}

body.dark-mode #modeToggle:hover {
    background-color: #fff;
    color: #3c3f4a;
}

/* Muted text fix in dark mode */
body.dark-mode .text-muted {
    color: #ccc !important;
}


    </style>

    @yield('styles')
</head>
<body>
<header id="mainHeader">
    <h3 class="text-center mt-2 ms-5">Admin</h3>

    <ul class="navbar-nav ms-auto flex-row">
        <li class="nav-item dropdown">
            <a class="nav-link" data-bs-toggle="dropdown" href="#" id="notificationDropdown">
                <i class="fa fa-bell"></i>
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="badge bg-danger" id="notificationCount">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end" id="notificationList">
                <li class="dropdown-item text-center">Loading...</li>
            </ul>
        </li>
        <li class="nav-item ms-3">
            <button id="modeToggle" class="btn btn-sm btn-outline-dark">
                <i class="fa fa-moon"></i> <span>Dark Mode</span>
            </button>
        </li>
    </ul>
</header>

<div class="sidebar" id="sidebar">
    <h4 class="text-center mb-4">Admin</h4>
    @if(Auth::guard('admin')->check())
        <h3 class="text-center mb-4">{{ Auth::guard('admin')->user()->name }}</h3>
    @else
        <h3 class="text-center mb-4"> Welcome, Guest</h3>
    @endif
    <a href="{{ route('admin1.dashboard') }}">Dashboard</a>
    <a href="{{ route('product.index') }}">Products</a>
    <a href="{{ route('user.index') }}">User</a>
    <a href="{{ route('product.ordin') }}">Orders</a>
    <a href="{{ route('comments.index') }}">Comments</a>
    <a href="{{ route('admin.profile') }}">Admin Profile</a>

    <form id="logout-form" method="POST" action="{{ route('admin.logout') }}" style="display: none;">
        @csrf
    </form>

    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
</div>

<div class="main">
    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const notificationList = document.getElementById('notificationList');
    const notificationCount = document.getElementById('notificationCount');

    document.getElementById('notificationDropdown').addEventListener('click', function () {
        fetch("{{ route('admin.notifications') }}")
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    notificationList.innerHTML = '<li class="dropdown-item text-muted">No notifications</li>';
                    notificationCount.style.display = 'none';
                    return;
                }

                notificationList.innerHTML = `
                    <li class="dropdown-header fw-bold">
                        Notifications
                        <button class="btn btn-sm btn-link float-end" onclick="markAllAsRead()">Mark all as read</button>
                    </li>
                `;

                data.forEach(notification => {
                    const read = notification.read_at !== null;
                    notificationList.innerHTML += `
                        <li class="dropdown-item ${read ? 'text-muted' : ''}">
                            <div class="d-flex justify-content-between">
                                <div>${notification.data.message}</div>
                                ${!read ? `<button class="btn btn-sm btn-link text-success" onclick="markAsRead('${notification.id}')">Mark read</button>` : ''}
                            </div>
                        </li>
                    `;
                });
            });
    });
});

function markAsRead(id) {
    fetch(`/admin/notifications/read/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    }).then(() => location.reload());
}

function markAllAsRead() {
    fetch(`{{ route('admin.notifications.markAllRead') }}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    }).then(() => location.reload());
}

const toggleBtn = document.getElementById('modeToggle');
const body = document.body;
const header = document.getElementById('mainHeader');
const sidebar = document.getElementById('sidebar');

if (localStorage.getItem('theme') === 'dark') {
    enableDarkMode();
}

toggleBtn.addEventListener('click', () => {
    if (body.classList.contains('dark-mode')) {
        disableDarkMode();
    } else {
        enableDarkMode();
    }
});

function enableDarkMode() {
    body.classList.add('dark-mode');
    header.classList.add('dark-mode');
    sidebar.classList.add('dark-mode');
    document.querySelectorAll('.dropdown-menu').forEach(el => el.classList.add('dark-mode'));
    document.querySelectorAll('.dropdown-item').forEach(el => el.classList.add('dark-mode'));
    localStorage.setItem('theme', 'dark');
    toggleBtn.innerHTML = '<i class="fa fa-sun"></i> <span>Light Mode</span>';
}

function disableDarkMode() {
    body.classList.remove('dark-mode');
    header.classList.remove('dark-mode');
    sidebar.classList.remove('dark-mode');
    document.querySelectorAll('.dropdown-menu').forEach(el => el.classList.remove('dark-mode'));
    document.querySelectorAll('.dropdown-item').forEach(el => el.classList.remove('dark-mode'));
    localStorage.setItem('theme', 'light');
    toggleBtn.innerHTML = '<i class="fa fa-moon"></i> <span>Dark Mode</span>';
}
 // Apply theme immediately before rendering
  const theme = localStorage.getItem('theme');
  if (theme === 'dark') {
      document.documentElement.classList.add('dark-mode');
  }
</script>

@yield('scripts')
</body>
</html>
