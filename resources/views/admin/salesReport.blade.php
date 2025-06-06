<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rapport des Ventes</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fdfaf6] min-h-screen flex">
  @include('admin.sidebar')

  <main class="flex-1 flex items-center justify-center p-10">
    <div class="bg-[#fff8f0] border border-[#e7d9c4] rounded-xl shadow-xl p-8 w-full max-w-xl space-y-6">
      <h1 class="text-2xl font-bold text-[#3b3b3b]">📈 Soumission d’un Rapport de Vente</h1>

      <p class="text-sm text-[#5a4e42]">
        Utilisez le package <span class="font-semibold">Spatie Laravel Backup</span> pour associer les rapports.
      </p>

      {{-- Message de succès --}}
      @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded">
          {{ session('success') }}
        </div>
      @endif

      {{-- Affichage des erreurs --}}
      @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded">
          <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('insertsales') }}" method="POST" class="space-y-5">
        @csrf

        <div>
          <label class="block text-sm font-medium text-[#5a4e42] mb-1">Vendeur</label>
          <input type="text" readOnly value="{{ auth()->user()->name }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#bfa58a]" />
        </div>

        <div>
          <label class="block text-sm font-medium text-[#5a4e42] mb-1">Date</label>
          <input type="date" name="CD" required value="{{ now()->format('Y-m-d') }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#bfa58a]" />
        </div>

        <div>
          <label class="block text-sm font-medium text-[#5a4e42] mb-1">Total (DH)</label>
          <input type="number" name="tot" step="0.01" min="0" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#bfa58a]" />
        </div>

        <div class="text-right">
          <button type="submit"
            class="bg-[#34495e] hover:bg-[#2c3e50] text-white font-semibold px-6 py-2 rounded-lg transition duration-300 shadow">
            💾 Enregistrer
          </button>
        </div>
      </form>

      <div class="pt-4 text-center">
        <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:underline">← Retour au tableau de bord</a>
      </div>
    </div>
  </main>
</body>
</html>
