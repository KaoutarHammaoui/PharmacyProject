<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sales Report</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fdfaf6] min-h-screen flex">
  @include('admin.sidebar')
 <div>
    
 </div>
  <main class="flex-1 flex flex-col items-center justify-center p-10">
    <div class="bg-[#fff8f0] border border-[#e7d9c4] rounded-xl shadow-xl p-8 w-full max-w-lg space-y-6">
      <h1 class="text-2xl font-bold text-[#3b3b3b]">📈 Sales Report Submission</h1>

      <p class="text-sm text-[#5a4e42]">
        Use the <span class="font-semibold">Spatie Laravel Backup</span> package for report association.
      </p>
    
      <form action="{{ route('insertsales') }}" method="POST" class="space-y-5">
        @csrf

        <div>
          <label class="block text-sm font-medium text-[#5a4e42] mb-1">Saler</label>
          <input type="text" readOnly value="{{ auth()->user()->name }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#bfa58a]" />
        </div>

        <div>
          <label class="block text-sm font-medium text-[#5a4e42] mb-1">Date</label>
          <input type="date" name="CD"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#bfa58a]" />
        </div>

        <div>
          <label class="block text-sm font-medium text-[#5a4e42] mb-1">Total</label>
          <input type="number" name="tot" step="0.01"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#bfa58a]" />
        </div>

        <div class="text-right">
          <button type="submit"
            class="bg-[#34495e] hover:bg-[#2c3e50] text-white font-semibold px-6 py-2 rounded-lg transition duration-300 shadow">
            💾 Save
          </button>
        </div>
      </form>
    </div>

      </main>
</body>
</html>
