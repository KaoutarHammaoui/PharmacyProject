<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    {{-- Sidebar --}}
    @include('admin.sidebar')

    <main class="flex-1 p-6">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold text-[#2c3e50] mb-6">🗑️ Deleted Users</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-[#2c3e50] text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Deleted At</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-gray-700">
                        @foreach($deletedUsers as $user)
                        <tr>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->deleted_at }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('restoreUser', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded-md font-medium transition duration-200">
                                        ♻️ Restore
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($deletedUsers->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">No deleted users found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
