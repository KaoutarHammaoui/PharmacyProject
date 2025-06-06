<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Ajouter un nouveau Médicament</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@include('partials.topbar')

<body class="bg-gray-100 font-sans">
    <main class="flex">
        @include('pharmacist.sidebarp')

        <section class="flex-1 p-10">
            <div class="max-w-xl mx-auto bg-white shadow-xl rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                    Ajouter un nouveau Médicament
                </h2>

                <form action="{{ route('addMedp.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="name">Nom</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="codeBar">Code Bar</label>
                        <input
                            type="text"
                            name="codeBar"
                            id="codeBar"
                            required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                    <label class="block text-gray-700 font-medium mb-1" for="withRecepie">Avec Ordonnance</label>

                    <div class="flex items-center space-x-6">
                        <div class="flex items-center space-x-2">
                            <input
                                type="radio"
                                name="withRecepie"
                                id="withRecepie_yes"
                                value="1"
                                class="w-5 h-5"
                            />
                            <label class="text-gray-700 font-medium" for="withRecepie_yes">Oui</label>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <input
                                type="radio"
                                name="withRecepie"
                                id="withRecepie_no"
                                value="0"
                                class="w-5 h-5"
                            />
                            <label class="text-gray-700 font-medium" for="withRecepie_no">Non</label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="threshold">Seuil</label>
                        <input
                            type="number"
                            name="threshold"
                            id="threshold"
                            min="0"
                            required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="description">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            maxlength="3000"
                            rows="5"
                            placeholder="Entrez la description du médicament (max 3000 caractères)"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        ></textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="quantite">Quantité en stock</label>
                        <input
                            type="number"
                            name="quantite"
                            id="quantite"
                            min="0"
                            required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="date_expiration">Date d'expiration</label>
                        <input
                            type="date"
                            name="date_expiration"
                            id="date_expiration"
                            required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>

                    <div>
                    <select
                        name="equivalents[]"
                        id="equivalents"
                        multiple
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>

                    </div>

                    <div class="text-center">
                        <button
                            type="submit"
                            class="bg-[#2c3e50] hover:bg-[#34495e] text-white font-semibold px-6 py-2 rounded-lg transition duration-300"
                        >
                            Ajouter Médicament
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>