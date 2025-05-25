<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        @include('admin.sidebar')
        <main class="flex-1 p-6">
            <h1 class="text-2xl font-bold mb-4">Hey Admin!</h1>
            <p>Welcome to your dashboard.</p>
        </main>
    </div>
</body>
</html>