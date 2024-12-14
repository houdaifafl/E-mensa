<html>
<head>
    <meta charset="UTF-8">
    <title>
        Namen und interne Preise von Gerichten
    </title>
</head>
<body>
<ul>
    @if(!empty($data))
        @foreach($data as $meal)
            <li>{{$meal['name']}}
                {{number_format($meal['preisintern'],2)}}&euro;
            </li>
        @endforeach
    @else Es sind keine Gerichte vorhanden
    @endif
</ul>

</body>
</html>