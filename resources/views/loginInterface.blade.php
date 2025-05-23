<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if($errors->any())
       @foreach($errors->all() as $error)
           <div style="color: red;">{{$error}}</div>
        @endforeach
    @endif       
    <form action="{{ route('login') }}" method="POST">
        @csrf
        email: <input type="text" name='email' value="{{ old('email') }}"> <br>
        password: <input type="password" name='password' value=''> <br>
        <button type="submit">Log in</button>
    </form>
</body>
</html>