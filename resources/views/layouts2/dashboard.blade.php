<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
    <header class="py-2 bg-dark text-white mb-4">
        <div class="container">
            <h1 class="h3">{{ config('app.name') }}</h1>
        </div>

    </header>
    <div class="container">
        <div class="row">
            <aside class="col-md-3">
                <h4>Navigation Menu</h4>
                <nav>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item "><a href="/admin/categories/create"
                                class="nav-link {{ 'admin/categories/create' == request()->path() ? 'active' : '' }}">Dashboard</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('admin.categories.index') }}"
                                class="nav-link @if (request()->routeIs('admin.categories.index')) active @endif">Categories</a>
                        </li>
                        <li class="nav-item"><a href="" class="nav-link @if (request()->routeIs('admin.categories.products')) active @endif">Products</a>
                        </li>
                    </ul>

                </nav>
            </aside>
            <main class="col-md-9">
                <div class="mb-4">
                    <h3 class="text-primary">
                        {{ $title ?? 'Default Title' }}
                    </h3>
                </div>
                {{ $slot }}
            </main>
        </div>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
