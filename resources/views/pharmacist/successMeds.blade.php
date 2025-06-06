<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@include('partials.topbar')

<body class="bg-gray-100 min-h-screen flex">

    
@include('pharmacist.sidebarp')

    <main class="flex-1 flex items-center justify-center p-6">
        <div class="bg-white p-10 rounded-xl shadow-lg text-center space-y-6 max-w-md w-full">
            <h1 class="text-3xl font-bold text-[#34495e]"> Succès ! ✅</h1>
            <p class="text-gray-700 text-lg">Votre action a été menée à bien.</p>

            <div>
                <p class="text-sm text-gray-500 mb-3">Souhaitez-vous revenir au panneau des medicaments?</p>
                <a href="{{ route('medsInfosp') }}"
                   class="inline-block bg-green-900 hover:bg-lime-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-300">
                   Revenir en arrière
                </a>
            </div>
        </div>
    </main>
</body>
</html>