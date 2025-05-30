<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex">

    @include('admin.sidebar')

    <div class="p-6 w-screen"> 
        <h2 class="text-3xl font-bold mb-6">Sales Dashboard</h2>

        <!-- Sales Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-green-500 text-white p-4 rounded-xl shadow">
                <h5 class="text-sm">Today's Sales</h5>
                <h3 class="text-2xl font-semibold">{{ number_format($todaySales, 2) }}DHs</h3>
                <p class="text-sm opacity-80">{{ now()->format('F j, Y') }}</p>
            </div>

            <div class="bg-blue-400 text-white p-4 rounded-xl shadow">
                <h5 class="text-sm">Yesterday</h5>
                <h3 class="text-2xl font-semibold">{{ number_format($yesterdaySales, 2) }}DHs</h3>
                <p class="text-sm opacity-80">{{ now()->subDay()->format('F j, Y') }}</p>
            </div>

            <div class="bg-indigo-500 text-white p-4 rounded-xl shadow">
                <h5 class="text-sm">This Month</h5>
                <h3 class="text-2xl font-semibold">{{ number_format($thisMonthSales, 2) }}DHs</h3>
                <p class="text-sm opacity-80">{{ now()->format('F Y') }}</p>
            </div>

            <div class="bg-yellow-500 text-white p-4 rounded-xl shadow">
                <h5 class="text-sm">Last Month</h5>
                <h3 class="text-2xl font-semibold">{{ number_format($lastMonthSales, 2) }}DHs</h3>
                <p class="text-sm opacity-80">{{ now()->subMonth()->format('F Y') }}</p>
            </div>
        </div>

        <!-- Form and Table Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Form -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h4 class="text-xl font-semibold mb-4">Record New Sale</h4>

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('insertsales') }}" method="POST">
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

            <!-- Recent Sales Table -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h4 class="text-xl font-semibold mb-4">Recent Sales</h4>

                @if($recentSales->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left">
                            <thead>
                                <tr class="bg-gray-200 text-gray-700">
                                    <th class="py-2 px-4">Date</th>
                                    <th class="py-2 px-4">Pharmacist</th>
                                    <th class="py-2 px-4">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSales as $sale)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-2 px-4">{{ $sale->created_at ? $sale->created_at->format('M j, Y') : 'N/A' }}</td>
                                        <td class="py-2 px-4">{{ $sale->user_name }}</td>
                                        <td class="py-2 px-4">{{ number_format($sale->total, 2) }}DHs</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                {{ $recentSales->links() }}
            </div>
                @else
                    <p class="text-gray-500">No sales recorded yet.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
