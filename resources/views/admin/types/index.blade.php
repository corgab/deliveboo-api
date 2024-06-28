<!DOCTYPE html>
<html>

<head>
    <title>Type</title>
</head>

<body>
    @foreach ($types as $type)
        <h1>{{ $type->name }}</h1>
    @endforeach
</body>

</html>