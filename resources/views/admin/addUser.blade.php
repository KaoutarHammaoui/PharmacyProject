<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <main class="flex">
        @include('admin.sidebar')

        <section class="flex-1 p-10">
            <div class="max-w-xl mx-auto bg-white shadow-xl rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">➕ Add New User</h2>

                <form action="{{ route('addUser') }}" method="POST" class="space-y-5">
                    @csrf 

                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="nom">Full Name</label>
                        <input type="text" name="nom" id="nom" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="mail">Email</label>
                        <input type="email" name="mail" id="mail" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="pass">Password</label>
                        <input type="password" name="pass" id="pass" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="role">Role</label>
                        <select name="role" id="role" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="pharmacist" {{ old('role') === 'pharmacist' ? 'selected' : '' }}>Pharmacist</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="bg-[#2c3e50] hover:bg-[#34495e] text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                             ✅ Add User
                        </button>     
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
