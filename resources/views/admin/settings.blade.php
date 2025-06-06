<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paramètres</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
  @include('admin.sidebar')

  <main class="flex-1 p-8 mt-20">
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-xl p-8 space-y-6">
      <h2 class="text-3xl font-bold text-[#2c3e50] text-center mb-12">⚙️ Paramètres</h2>

      <!-- Ligne de paramètre -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center mt-12">
        <h3 class="text-xl font-semibold text-gray-700">Modifier mon nom d'utilisateur →</h3>
        <a href="{{ route('changeusername', ['id' => Auth::user()->id]) }}"
           class="w-full md:w-auto text-center bg-[#2c3e50] hover:bg-[#34495e] text-white font-medium px-6 py-2 rounded-lg transition">
          ✏️ Modifier le nom d'utilisateur
        </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
        <h3 class="text-xl font-semibold text-gray-700">Modifier mon mot de passe →</h3>
        <a href="{{ route('changepass', ['id' => Auth::user()->id]) }}"
           class="w-full md:w-auto text-center bg-[#2c3e50] hover:bg-[#34495e] text-white font-medium px-6 py-2 rounded-lg transition">
          🔒 Modifier le mot de passe
        </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
        <h3 class="text-xl font-semibold text-gray-700">Supprimer mon compte →</h3>
        <form action="{{ route('deleteAccount', ['id' => Auth::user()->id]) }}" method="POST"
              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">
          @csrf
          @method('DELETE')
          <button type="submit"
                  class="w-full md:w-auto text-center bg-red-600 hover:bg-red-700 text-white font-medium px-16 py-2 rounded-lg transition">
            🗑️ Supprimer le compte
          </button>
        </form>
      </div>
    </div>
  </main>
</body>
</html>
