<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex">

    {{-- Sidebar --}}
    @include('admin.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-10 flex items-center justify-center">
        <form action="{{ route('updateUser', $user->id) }}" method="POST"
              class="bg-white p-8 rounded-xl shadow-md w-full max-w-md space-y-6">

            @csrf 
            @method('PATCH')

            <h2 class="text-2xl font-bold text-[#2c3e50] text-center">Update User</h2>

            <div>
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="fullname" value="{{ $user->name }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#2c3e50]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" name="mail" value="{{ $user->email }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#2c3e50]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="pass" value="{{ $user->password }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#2c3e50]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#2c3e50]">
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="pharmacist" {{ $user->role === 'pharmacist' ? 'selected' : '' }}>Pharmacist</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit"
                        class="bg-[#2c3e50] hover:bg-[#34495e] text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                    💾 Save Changes
                </button>
            </div>

        </form>
    </main>

</body>
</html>
