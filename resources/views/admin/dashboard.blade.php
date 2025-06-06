<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin</title>
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
            background: url('/images/pharma-bg.jpg') no-repeat center center fixed;
            background-size: cover;
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
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            width: 100%;
            max-width: 800px; 
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
        .card-border-revenue  { border-color: #ffc107; }

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
        .card-icon-revenue  { color: #ffc107; }


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
        .footer-revenue  { background-color: #ffc107; color: #212529; }
        .footer-revenue:hover { filter: brightness(90%); }

        .stats-grid-wrapper { 
            display: flex;
            justify-content: center; 
            margin-top: 35px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); 
            gap: 25px; 
            width: 100%;
            max-width: 800px; 
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
    @include('admin.sidebar')

    <main class="flex-1 p-4 mt-5">
        <div class="main-content-area">
            <h1 class="dashboard-title">Tableau de Bord</h1>

            <div class="top-card-grid-wrapper">
                <div class="top-card-grid">
                    <div class="dashboard-card card-border-stock">
                        <div class="card-body">
                            <div class="card-icon-top card-icon-stock"><i class="fas fa-boxes"></i></div>
                            <p class="card-value-main">{{ number_format($totalStockQuantity, 0, ',', ' ') }}</p>
                            <h2 class="card-title-text">Stock Total (Unités)</h2>
                        </div>
                        <a href="{{ route('medsInfos') }}" class="card-footer-action footer-stock">
                            Visiter l'Inventaire <span class="arrow-icon">»</span>
                        </a>
                    </div>

                    <div class="dashboard-card card-border-shortage">
                        <div class="card-body">
                            <div class="card-icon-top card-icon-shortage"><i class="fas fa-exclamation-triangle"></i></div>
                            <p class="card-value-main">{{ $shortageProductsCount }}</p>
                            <h2 class="card-title-text">Médicaments en Rupture</h2>
                        </div>
                        <a href="{{ route('medsShortage') }}" class="card-footer-action footer-shortage">
                            Voir Ruptures <span class="arrow-icon">»</span>
                        </a>
                    </div>

                    <div class="dashboard-card card-border-revenue">
                        <div class="card-body">
                            <div class="card-icon-top card-icon-revenue"><i class="fas fa-dollar-sign"></i></div>
                            <p class="card-value-main">{{ number_format($totalRevenue, 2, ',', ' ') }} <span style="font-size:0.6em; color:#6b7280;">DH</span></p>
                            <h2 class="card-title-text">Revenus Totaux </h2>
                        </div>
                        <a href="{{ route('reports') }}" class="card-footer-action footer-revenue">
                            Rapports Ventes <span class="arrow-icon">»</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="stats-grid-wrapper">
                <div class="stats-grid">
                    <div class="stat-card">
                        <i class="fas fa-users stat-icon"></i>
                        <h3 class="stat-card-title">Total Utilisateurs</h3>
                        <p class="stat-card-value">{{ $totalUsers }}</p>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-user-shield stat-icon"></i>
                        <h3 class="stat-card-title">Administrateurs</h3>
                        <p class="stat-card-value">{{ $totalAdmins }}</p>
                    </div>
                    <div class="stat-card">
                         <i class="fas fa-user-md stat-icon"></i>
                        <h3 class="stat-card-title">Pharmaciens</h3>
                        <p class="stat-card-value">{{ $totalPharmacists }}</p>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-truck stat-icon"></i>
                        <h3 class="stat-card-title">Fournisseurs</h3>
                        <p class="stat-card-value">{{ $totalSuppliers }}</p>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
</body>
</html>