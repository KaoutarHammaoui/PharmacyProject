<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Pharmacien</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Segoe UI', sans-serif;
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
        }

        .main-content-area {
            margin: 10px auto;
            width: 95%;
            max-width: 1100px;
        }

        .dashboard-title {
            text-align: left;
            color: #1f2937;
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 25px;
            padding: 10px;
        }

        .top-card-grid-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 35px;
        }
        .top-card-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            width: 100%;
            max-width: 650px;
        }

        .dashboard-card {
            background: #ffffff;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: transform 0.2s ease-out, box-shadow 0.2s ease-out;
            border-width: 1px;
            border-style: solid;
        }
        .card-border-stock    { border-color: #007bff; }
        .card-border-shortage { border-color: #dc3545; }

        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 15px 15px 10px 15px;
            text-align: center;
            flex-grow: 1;
        }

        .card-icon-top {
            font-size: 30px;
            margin-bottom: 10px;
        }
        .card-icon-stock    { color: #007bff; }
        .card-icon-shortage { color: #dc3545; }

        .card-value-main {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            line-height: 1.1;
            margin-bottom: 2px;
        }

        .card-title-text {
            font-size: 14px;
            color: #6b7280;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .card-footer-action {
            color: white;
            padding: 10px 12px;
            text-align: center;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
            display: block;
            transition: filter 0.2s ease-in-out;
        }
        .card-footer-action:hover {
            filter: brightness(90%);
        }
        .card-footer-action .arrow-icon {
            margin-left: 6px;
            font-style: normal;
        }
        .footer-stock    { background-color: #007bff; }
        .footer-shortage { background-color: #dc3545; }

        .stats-grid-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 35px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); 
            width: 100%;
            max-width: 312px; 

        }
        .stat-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(5px);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1), 0 3px 6px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.2s ease-out, box-shadow 0.2s ease-out;
        }
        .stat-card:hover {
            transform: translateY(-3px);
             box-shadow: 0 8px 20px rgba(0,0,0,0.12), 0 5px 10px rgba(0,0,0,0.1);
        }

        .stat-card-title {
            font-size: 15px;
            color: #6b7280;
            margin-bottom: 6px;
            font-weight: 500;
        }
        .stat-card-value {
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
        }
        .stat-card i.stat-icon {
            font-size: 18px;
            color: #4b5563;
            margin-bottom: 8px;
        }

    </style>
</head>
<body>
@include('partials.topbar')

<div class="flex min-h-screen">
    @include('pharmacist.sidebarp') 

    <main class="flex-1 p-4 mt-5">
        <div class="main-content-area">
            <h1 class="dashboard-title">Tableau de Bord Pharmacien</h1>

            <div class="top-card-grid-wrapper">
                <div class="top-card-grid">
                    <div class="dashboard-card card-border-stock">
                        <div class="card-body">
                            <div class="card-icon-top card-icon-stock"><i class="fas fa-boxes"></i></div>
                            <p class="card-value-main">{{ number_format($totalStockQuantity, 0, ',', ' ') }}</p>
                            <h2 class="card-title-text">Stock Total (Unités)</h2>
                        </div>
                        <a href="{{ route('medsInfosp') }}" class="card-footer-action footer-stock"> {{-- Assuming pharmacist named routes --}}
                            Visiter l'Inventaire <span class="arrow-icon">»</span>
                        </a>
                    </div>

                    <div class="dashboard-card card-border-shortage">
                        <div class="card-body">
                            <div class="card-icon-top card-icon-shortage"><i class="fas fa-exclamation-triangle"></i></div>
                            <p class="card-value-main">{{ $shortageProductsCount }}</p>
                            <h2 class="card-title-text">Médicaments en Rupture</h2>
                        </div>
                        <a href="{{ route('medsShortagep') }}" class="card-footer-action footer-shortage"> {{-- Assuming pharmacist named routes --}}
                            Voir Ruptures <span class="arrow-icon">»</span>
                        </a>
                    </div>

                </div>
            </div>


        </div>
    </main>
</div>
</body>
</html>