<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord des ventes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex">

    @include('admin.sidebar')

    <div class="p-6 w-screen"> 
        <h2 class="text-3xl font-bold mb-6">Tableau de bord des ventes</h2>

        <!-- Cartes des statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-green-500 text-white p-4 rounded-xl shadow">
                <h5 class="text-sm">Ventes du jour</h5>
                <h3 class="text-2xl font-semibold">{{ number_format($todaySales, 2) }} DHs</h3>
                <p class="text-sm opacity-80">{{ now()->format('j F Y') }}</p>
            </div>

            <div class="bg-blue-400 text-white p-4 rounded-xl shadow">
                <h5 class="text-sm">Hier</h5>
                <h3 class="text-2xl font-semibold">{{ number_format($yesterdaySales, 2) }} DHs</h3>
                <p class="text-sm opacity-80">{{ now()->subDay()->format('j F Y') }}</p>
            </div>

            <div class="bg-indigo-500 text-white p-4 rounded-xl shadow">
                <h5 class="text-sm">Ce mois-ci</h5>
                <h3 class="text-2xl font-semibold">{{ number_format($thisMonthSales, 2) }} DHs</h3>
                <p class="text-sm opacity-80">{{ now()->format('F Y') }}</p>
            </div>

            <div class="bg-yellow-500 text-white p-4 rounded-xl shadow">
                <h5 class="text-sm">Mois précédent</h5>
                <h3 class="text-2xl font-semibold">{{ number_format($lastMonthSales, 2) }} DHs</h3>
                <p class="text-sm opacity-80">{{ now()->subMonth()->format('F Y') }}</p>
            </div>
        </div>

        <!-- Formulaire et table des ventes -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Formulaire -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h4 class="text-xl font-semibold mb-4">Enregistrer une vente</h4>

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('insertsales') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Pharmacien</label>
                        <input type="text" class="w-full p-2 rounded border border-gray-300 bg-gray-100" value="{{ auth()->user()->name }}" readonly>
                    </div>

                    <!-- Product Select Field -->
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Médicament <span class="text-red-500">*</span></label>
                        <select name="product_id" class="w-full p-2 rounded border border-gray-300 focus:border-blue-500 focus:outline-none" required>
                            <option value="">Sélectionner un médicament</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }} - Stock: {{ $product->total_quantity }}
                                    @if($product->total_quantity <= ($product->threshold ?? 10))
                                        <span class="text-red-500">(Stock faible)</span>
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Quantity Sold Field -->
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Quantité vendue <span class="text-red-500">*</span></label>
                        <input type="number" name="quantity_sold" min="1" class="w-full p-2 rounded border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="1" value="1" required>
                        @error('quantity_sold')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Montant de la vente (DHs)</label>
                        <input type="number" name="tot" step="0.01" min="0" class="w-full p-2 rounded border border-gray-300" placeholder="0.00" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Date de la vente</label>
                        <input type="date" name="CD" class="w-full p-2 rounded border border-gray-300" value="{{ now()->format('Y-m-d') }}">
                    </div>

                    <button type="submit" class="bg-[#34495e] hover:bg-[#2c3e50] text-white px-4 py-2 rounded w-full font-semibold">
                        💾 Enregistrer la vente
                    </button>
                </form>
            </div>

            <!-- Table des ventes récentes -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h4 class="text-xl font-semibold mb-4">Ventes récentes</h4>

                @if($recentSales->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left">
                            <thead>
                                <tr class="bg-gray-200 text-gray-700">
                                    <th class="py-2 px-4">Date</th>
                                    <th class="py-2 px-4">Pharmacien</th>
                                    <th class="py-2 px-4">Médicament</th>
                                    <th class="py-2 px-4">Quantité</th>
                                    <th class="py-2 px-4">Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSales as $sale)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-2 px-4">{{ $sale->created_at ? $sale->created_at->format('j M Y') : 'N/A' }}</td>
                                        <td class="py-2 px-4">{{ $sale->user_name }}</td>
                                        <td class="py-2 px-4">{{ $sale->product ? $sale->product->name : 'N/A' }}</td>
                                        <td class="py-2 px-4">{{ $sale->quantity_sold ?? 1 }}</td>
                                        <td class="py-2 px-4">{{ number_format($sale->total, 2) }} DHs</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $recentSales->links() }}
                    </div>
                @else
                    <p class="text-gray-500">Aucune vente enregistrée pour le moment.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>