


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deine App</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Beispiel für das Einbinden von CSS, falls du ein solches hast -->
</head>
<body>
    <header>
        <!-- Hier könnte der Header deiner Anwendung stehen -->
        <nav>
            <ul>
                <li><a href="{{ route('inventories.index') }}">Startseite</a></li>
                <li><a href="#">Über uns</a></li>
                <!-- Weitere Navigationslinks -->
            </ul>
        </nav>
    </header>

    <main class="py-4">
@yield('content')
</main>

<footer>
    <!-- Hier könnte der Footer deiner Anwendung stehen -->
    <p>&copy; {{ date('Y') }}  Alle Rechte vorbehalten.</p>
</footer>

<!-- Beispiel für das Einbinden von JavaScript -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
