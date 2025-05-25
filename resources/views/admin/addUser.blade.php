<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('addUser') }}" method="POST">
        @csrf 
        nom: <input type="text" name="nom">
        email: <input type="text" name="mail">
        password: <input type="password" name="pass" >
        role: <select name="role" id="">
            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="pharmacist" {{ old('role') ==='pharmacist' ? 'selected' : '' }}>Pharmacist</option>
        </select>
        <button type="submit">add</button>
    </form>
</body>
</html>