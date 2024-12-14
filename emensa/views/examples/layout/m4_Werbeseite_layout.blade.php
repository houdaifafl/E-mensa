<!DOCTYPE html>
<html lang="de">
<head>
    <title>Werbeseite</title>
    <link rel="stylesheet" href="css/styling.css">
    <meta charset="UTF-8">
</head>
<body>
<header>
    <div>
        @yield('Header')
    </div>
    <br>

    <div class="angemeldet_als">
        @yield('angemeldet_als')
    </div>
</header>

<div>
    @yield('Beg')
</div>

<div>
    @yield('Info')
</div>

<div>
    @yield('Ende')
</div>

<footer>
    @yield('fotter')
</footer>

</body>
</html>