<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les fournisseurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@include('partials.topbar')

<body class="bg-gray-100 min-h-screen flex ">

    {{-- Sidebar --}}
    @include('admin.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-[80px] flex items-center justify-center mt-5">
        <form action="{{ route('updateSup', $supplier->id) }}" method="POST"
              class="bg-white p-8  rounded-xl shadow-md w-full max-w-md space-y-6">

            @csrf 
            @method('PATCH')

            <h2 class="text-2xl font-bold text-[#2c3e50] text-center">Modifier fournisseurs</h2>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nom complet</label>
                <input type="text" name="name" value="{{ $supplier->name }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#2c3e50]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" name="email" value="{{ $supplier->email }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#2c3e50]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Tel</label>
                <input type="tel" name="tel" value="{{ $supplier->tel }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#2c3e50]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Adresse</label>
                <input type="text" name="adress" value="{{ $supplier->adress }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#2c3e50]">
            </div>

            <div class="text-center">
                <button type="submit"
                        class="bg-[#2c3e50] hover:bg-[#34495e] text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                    Enregistrer les changements 
                </button>
            </div>

        </form>
    </main>

</body>
</html>