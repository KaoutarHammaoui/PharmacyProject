<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@include('partials.topbar')

<body class="bg-gray-50 ">
    <div class="flex">
    @include('pharmacist.sidebarp')
        
        <div class="flex-1 p-6 mt-[50px]">
            <div class="max-w-4xl mx-auto space-y-4">
                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Medicament</h2>
                    </div>
                    
                    <div class="grid grid-cols-4 gap-8">
                        <div>
                            <div class="text-2xl font-bold text-gray-800">{{ $product->id }}</div>
                            <div class="text-sm text-gray-500">Id</div>
                        </div>

                        <div>
                            <div class="text-2xl font-bold text-gray-800">{{ $product->name }}</div>
                            <div class="text-sm text-gray-500">Nom</div>
                        </div>
                        
                        <div>
                            <div class="text-2xl font-bold text-gray-800">{{ $product->codeBar }}</div>
                            <div class="text-sm text-gray-500">Code Bar</div>
                        </div>
                        
                        <div>
                            <div class="text-2xl font-bold text-gray-800">{{ $product->withRecepie == 1 ? 'Oui' : 'Non' }}</div>
                            <div class="text-sm text-gray-500">Avec Ordonnace</div>
                        </div>
                        
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Stock</h2>
                    </div>
                    
                    <div class="grid grid-cols-4 gap-8">
                        <div>
                            <div class="text-2xl font-bold text-gray-800">{{ $product->stocks->quantite ?? 'N/A' }}</div>
                            <div class="text-sm text-gray-500">Stock Actuel</div>
                        </div>
                        
                        <div>
                            <div class="text-2xl font-bold text-gray-800">{{ $product->threshold }}</div>
                            <div class="text-sm text-gray-500">Stock minimal</div>
                        </div>
                        
                        <div>
                            <div class="text-2xl font-bold text-gray-800">{{ $product->stocks->date_expiration ?? 'N/A' }}</div>
                            <div class="text-sm text-gray-500">Date d'expiration</div>
                        </div>
                        
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Description</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $product->description }}
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Medicaments Equivalents</h3>
                    <div class="text-gray-600 leading-relaxed">
                        @if($product->equivalents && $product->equivalents->count() > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach($product->equivalents as $equivalent)
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $equivalent->name }}</span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Aucun médicament équivalent répertorié pour ce produit.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>