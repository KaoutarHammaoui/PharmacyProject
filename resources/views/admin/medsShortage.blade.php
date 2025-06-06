<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicaments en Rupture de Stock</title>
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

        .page-actions {
            text-align: right;
            margin-bottom: 25px;
        }

        .page-actions a {
            text-decoration: none;
            background-color: rgb(55, 90, 124);
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .page-actions a:hover {
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
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #1d2939;
            color: white;
        }

        .nowrap {
            white-space: nowrap;
        }

        .alert-info {
            background-color: rgba(59, 130, 246, 0.1);
            color: #1e40af;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid rgba(59, 130, 246, 0.3);
            margin-top: 20px;
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 0.25em 0.6em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.375rem;
        }
        .badge-danger {
            color: #7f1d1d;
            background-color: #fee2e2;
        }
        .badge-warning {
            color: #7c2d12;
            background-color: #fef3c7;
        }
    </style>
</head>
<body>
@include('partials.topbar')

<div class="flex min-h-screen">
    @include('admin.sidebar')
    <main class="flex-1 p-6 mt-10">
        <div class="container">
            <h1 class="mb-4">Médicaments en Rupture de Stock</h1>

            @if($shortageProducts->isEmpty())
                <div class="alert-info">
                    <p>Aucun médicament n'est actuellement en rupture de stock.</p>
                </div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Code Bar</th>
                            <th>Avec Ordonnance</th>
                            <th>Date d'ajout</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shortageProducts as $product)
                            @php
                                $statusText = '';
                                $statusClass = '';
                                $rowClass = '';

                                if (!$product->stocks || $product->stocks->quantite == 0) {
                                    if ($product->threshold > 0 || ($product->stocks && $product->stocks->quantite == 0) ) {
                                        $statusText = 'En Rupture';
                                        $statusClass = 'badge-danger';
                                        $rowClass = 'row-outofstock';
                                    }
                                } elseif ($product->stocks->quantite > 0 && $product->stocks->quantite <= $product->threshold) {
                                    $statusText = 'Stock Bas';
                                    $statusClass = 'badge-warning';
                                    $rowClass = 'row-shortage';
                                }
                            @endphp
                            <tr class="{{ $rowClass }}">
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->codeBar }}</td>
                                <td>{{ $product->withRecepie ? 'Oui' : 'Non' }}</td>
                                <td class="nowrap">{{ $product->created_at ? $product->created_at->format('Y-m-d') : 'N/A' }}</td>
                                <td>
                                    @if(!empty($statusText))
                                        <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            
        </div>
    </main>
</div>
</body>
</html>