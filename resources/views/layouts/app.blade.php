<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotek POS - @yield('title')</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #2c3338;
            /* Darker, slightly blue-tinted gray */
            color: white;
        }

        .sidebar a {
            color: #a0a5aa;
            text-decoration: none;
            transition: all 0.2s;
            font-size: 0.95rem;
        }

        .sidebar a:hover,
        .sidebar a.active {
            color: white;
            background-color: #0d6efd;
            /* Bootstrap primary blue */
            border-radius: 4px;
        }

        .nav-item>span {
            color: #8bb9fe;
            /* Light blue for section headers */
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            font-weight: 500;
        }

        .main-content {
            padding: 30px;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="container-fluid g-0">
        <div class="row g-0 flex-nowrap">
            <!-- Sidebar -->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 sidebar d-flex flex-column">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-4 text-white min-vh-100">
                    <a href="/"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none border-bottom w-100">
                        <span class="fs-4 d-none d-sm-inline fw-bold"><i class="bi bi-heart-pulse"></i> Apotek
                            POS</span>
                    </a>

                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100 mt-4"
                        id="menu">
                        <!-- Master Obat -->
                        <li class="nav-item w-100 mb-3">
                            <span class="d-none d-sm-inline pb-2 d-block border-bottom mb-2"><i
                                    class="bi bi-capsule"></i> Master Obat</span>
                            <ul class="nav flex-column ms-2">
                                <li class="w-100 mb-1">
                                    <a href="{{ url('/obat/eloquent') }}"
                                        class="nav-link px-2 {{ request()->is('obat/eloquent*') ? 'active' : '' }}">
                                        <span class="d-none d-sm-inline">Eloquent ORM</span>
                                    </a>
                                </li>
                                <li class="w-100">
                                    <a href="{{ url('/obat/query-builder') }}"
                                        class="nav-link px-2 {{ request()->is('obat/query-builder*') ? 'active' : '' }}">
                                        <span class="d-none d-sm-inline">Query Builder</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Staff Management -->
                        <li class="nav-item w-100 mb-3">
                            <span class="d-none d-sm-inline pb-2 d-block border-bottom mb-2"><i
                                    class="bi bi-people"></i> Staff Management</span>
                            <ul class="nav flex-column ms-2">
                                <li class="w-100 mb-1">
                                    <a href="{{ url('/staff/eloquent') }}"
                                        class="nav-link px-2 {{ request()->is('staff/eloquent*') ? 'active' : '' }}">
                                        <span class="d-none d-sm-inline">Eloquent ORM</span>
                                    </a>
                                </li>
                                <li class="w-100">
                                    <a href="{{ url('/staff/query-builder') }}"
                                        class="nav-link px-2 {{ request()->is('staff/query-builder*') ? 'active' : '' }}">
                                        <span class="d-none d-sm-inline">Query Builder</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Supplier Management -->
                        <li class="nav-item w-100">
                            <span class="d-none d-sm-inline pb-2 d-block border-bottom mb-2"><i class="bi bi-truck"></i>
                                Supplier Management</span>
                            <ul class="nav flex-column ms-2">
                                <li class="w-100 mb-1">
                                    <a href="{{ url('/supplier/eloquent') }}"
                                        class="nav-link px-2 {{ request()->is('supplier/eloquent*') ? 'active' : '' }}">
                                        <span class="d-none d-sm-inline">Eloquent ORM</span>
                                    </a>
                                </li>
                                <li class="w-100">
                                    <a href="{{ url('/supplier/query-builder') }}"
                                        class="nav-link px-2 {{ request()->is('supplier/query-builder*') ? 'active' : '' }}">
                                        <span class="d-none d-sm-inline">Query Builder</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col py-3 main-content">
                <nav class="navbar navbar-expand-lg border-bottom mb-4 bg-white rounded shadow-sm px-3 py-2">
                    <div class="container-fluid">
                        <span class="navbar-brand h1 mb-0"><i class="bi bi-journal-text text-primary"></i>
                            @yield('title')</span>
                        <div class="ms-auto d-flex align-items-center">
                            <span class="badge bg-primary me-2">@yield('orm_type') Mode</span>
                        </div>
                    </div>
                </nav>

                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>