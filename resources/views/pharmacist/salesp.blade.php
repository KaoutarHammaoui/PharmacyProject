<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex">

    @include('pharmacist.sidebarp')

    <div class="p-6 w-screen"> 
        <h2 class="text-3xl font-bold mb-6">Sales Dashboard</h2>


        <!-- Form and Table Section -->
        <div class="flex-1 justify-center items-center ">
            <!-- Form -->
            <div class="bg-white p-6 rounded-xl shadow ">
                <h4 class="text-xl font-semibold mb-4">Record New Sale</h4>

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('insertsalesp') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Pharmacist</label>
                        <input type="text" class="w-full p-2 rounded border border-gray-300 bg-gray-100" value="{{ auth()->user()->name }}" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Sale Amount (DHs)</label>
                        <input type="number" name="tot" step="0.01" min="0" class="w-full p-2 rounded border border-gray-300" placeholder="0.00" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Sale Date</label>
                        <input type="date" name="CD" class="w-full p-2 rounded border border-gray-300" value="{{ now()->format('Y-m-d') }}">
                    </div>

                    <button type="submit" class="bg-[#34495e] hover:bg-[#2c3e50] text-white px-4 py-2 rounded w-full font-semibold">
                        <i class="fas fa-plus mr-1"></i> Record Sale
                    </button>
                </form>
            </div>

           
    </div>
</body>
</html>
