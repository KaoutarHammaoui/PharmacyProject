<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fdfaf6] min-h-screen flex">
  @include('admin.sidebar')
    <main class="flex-1 flex flex-col items-center justify-center p-10">
        <div class="bg-white shadow-md rounded-xl p-8 w-full max-w-md">

        
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">🔒 Change Password</h2>

    <form action="{{ route('changepassword', $user->id) }}" method="POST" class="space-y-4">
      @csrf
      @method('PATCH')

      <label class="block text-gray-700 font-medium">New Password:</label>
      <input
        type="password"
        name="pass"
        value="{{ Auth::user()->password }}"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
        required
      >

      <button
        type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition"
      >
        💾 Save
      </button>
    </form>
  </div>
  </div>
</main>
</body>
</html>
