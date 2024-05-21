<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="/dashboard">{{ auth()->user()->name }}</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="/profile" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#terms" aria-expanded="false" aria-controls="terms">
                        <i class="lni lni-protection"></i>
                        <span>Terms</span>
                    </a>
                    <ul id="terms" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="{{ route('term.index') }}" class="sidebar-link">Terms</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('term.create') }}" class="sidebar-link">Create Terms</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Category</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="{{ route('categories.show') }}" class="sidebar-link">Categories</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('categories.form') }}" class="sidebar-link">Create Category</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#Properties" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Properties</span>
                    </a>
                    <ul id="Properties" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="{{ route('property.index') }}" class="sidebar-link">Properties</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('categories.form') }}" class="sidebar-link">Create Property</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#Requests" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Requests</span>
                    </a>
                    <ul id="Requests" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="{{ route('receipts.index') }}" class="sidebar-link">Receipts</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('identify.index') }}" class="sidebar-link">Identifications</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('sale.index') }}" class="sidebar-link">Sales</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('user.index') }}" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Users</span>
                    </a>
                </li>
            </ul>
            <form action="{{ route('logout') }}" method="POST" class="sidebar-footer">
                @csrf
                <button
                    style="width: 100%;
                                padding: 10px 0;
                                color: white;
                                background-color: #0e2238;
                                border: none;"
                    class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </button>
            </form>
        </aside>
        <div class="main p-3">
            <div class="text-center">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="{{ url('js/script.js') }}"></script>
</body>

</html>
