<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des medicaments</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            font-family: 'Segoe UI', sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: url('/images/pharma-bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            margin: 50px auto;
            width: 90%;
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        .container h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 30px;
            font-weight: 800;
        }

        .add-user {
            text-align: right;
            margin-bottom: 45px;
        }

        .add-user a {
            text-decoration: none;
            background-color: rgb(55, 90, 124);
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .add-user a:hover {
            background-color: rgb(41, 66, 92);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            table-layout: auto;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #1d2939;
            color: white;
        }

        td a {
            background-color: rgb(55, 90, 124);
            color: white;
            border-radius: 5px;
            padding: 6px 12px;
            text-decoration: none;
            transition: background 0.2s;
        }

        td a:hover {
            background-color: #2563eb;
        }

        td button {
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.2s;
        }

        td button:hover {
            background-color: #dc2626;
        }

        /* Prevent text wrap for date and action buttons */
        .nowrap {
            white-space: nowrap;
        }


    </style>
</head>
<body>
@include('partials.topbar')

<div class="flex min-h-screen">
    @include('pharmacist.sidebarp')
    <main class="flex-1 p-6 mt-10">
        <div class="container">
            <h1>Liste des medicaments</h1>

            <div class="add-user">
                <a href="{{ route('addMedp.show') }}"> Ajouter Medicament + </a>
            </div>

            <table>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Code Bar</th>
                    <th>Avec Ordannance </th>
                    <th>Date d'ajout</th>
                    <th colspan="3">Actions</th>
                </tr>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->codeBar }}</td>
                    <td>{{ $product->withRecepie ? 'Oui' : 'Non' }}</td>
                    <td class="nowrap">{{ $product->created_at ? $product->created_at->format('Y-m-d') : 'No date' }}</td>
                    <td class="nowrap" style="display: flex; gap: 10px; align-items: center;">
                        <a href="{{ route('editMedp', $product->id) }}" class="bg-green-800 hover:bg-green-800">Modifier</a>
                        <form action="{{ route('deleteMedp', $product->id) }}" method="POST" style="margin: 0;">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="db">supprimer</button>
                        </form>
                        <a href="{{ route('medInfosp', $product->id) }}" class="bg-[#375A7C] hover:bg-[#29425C]">Voir les détails </a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </main>
</div>
</body>
</html>