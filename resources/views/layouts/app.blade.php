


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deine App</title>
{{--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>
    <header>
        <nav class="navbar navbar-expand bg-primary-subtle fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('products.index') }}">Navigation</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="{{ route('products.index') }}">Home</a>
                        <a class="nav-link" href="#">Weitere Funktion</a>
                        <a class="nav-link" href="#">Weitere Funktion</a>
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </div>
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link" href="{{ route('products.create') }}">
                            <button class="btn btn-success">
                                <i class="fas fa-plus"></i> Neues Produkt
                            </button>
                        </a>
                        <a class="nav-link" href="{{ route('inventories.index') }}">
                            <button class="btn btn-warning">
                                <i class="fas fa-table"></i> Neue Inventarliste
                            </button>
                        </a>
                        <a class="nav-link" href="{{route('categories.create')}}">
                            <button class="btn btn-warning">
                                <i class="fas fa-table"></i> Neue Kategorie
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-4">
@yield('content')
</main>

<footer>
    <p>&copy; {{ date('Y') }}  Alle Rechte vorbehalten.</p>
</footer>

    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
