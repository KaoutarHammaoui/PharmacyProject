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

    <!-- Wrap the main content in a flex container that centers content vertically -->
    <div class="flex-grow flex justify-center items-center p-6">
        <div class="bg-white p-6 rounded-xl shadow w-full max-w-md">
            <h4 class="text-xl font-semibold mb-4">Enregistrer une vente</h4>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('insertsalesp') }}" method="POST">
                @csrf
                <!-- form fields here (same as yours) -->
                <div class="mb-4">
                    <label class="block font-medium mb-1">Pharmacien</label>
                    <input type="text" class="w-full p-2 rounded border border-gray-300 bg-gray-100" value="{{ auth()->user()->name }}" readonly>
                </div>

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
    </div>

</body>

</html>
