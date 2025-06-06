<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un nouveau Fournisseur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@include('partials.topbar')

<body class="bg-gray-100 font-sans">
    <main class="flex">
        @include('admin.sidebar')

        <section class="flex-1 p-10">
            <div class="max-w-xl mx-auto bg-white shadow-xl rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center"> Ajouter un nouveau Fournisseur</h2>

                <form action="{{ route('addSup') }}" method="POST" class="space-y-5">
                    @csrf 

                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="name">Nom complet</label>
                        <input type="text" name="name" id="nom" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="email" >Email</label>
                        <input type="email" name="email" id="mail" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="tel">Telephone</label>
                        <input type="tel" name="tel" id="pass" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="adress">Adresse</label>
                        <input type="text" name="adress" id="nom" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="bg-[#2c3e50] hover:bg-[#34495e] text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                             Ajouter Fournisseur
                        </button>     
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>