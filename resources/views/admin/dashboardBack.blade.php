<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Succès</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    @include('admin.sidebar')

    <main class="flex-1 flex items-center justify-center p-6">
        <div class="bg-white p-10 rounded-xl shadow-lg text-center space-y-6 max-w-md w-full">
            <h1 class="text-3xl font-bold text-[#34495e]">✔️ Opération réussie !</h1>
            <p class="text-gray-700 text-lg">Votre opération a été effectuée avec succès. ☑</p>

            <div>
                <p class="text-sm text-gray-500 mb-3">Souhaitez-vous retourner au tableau de bord ?</p>
                <a href="{{ route('dashboard') }}"
                   class="inline-block bg-blue-800 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold transition duration-300">
                    ⬅ Retour
                </a>
            </div>
        </div>
    </main>
</body>
</html>
