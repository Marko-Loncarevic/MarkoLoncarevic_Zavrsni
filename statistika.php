<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Statistika </title>
    <style>
        /* ===== MODERN PASTEL PALETTE ===== */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');

        :root {
            --bg-primary: #F5F7F4;
            --bg-secondary: #E8EDE7;
            --text-primary: #3d4a3e;
            --text-secondary: #6B7B6E;
            --accent-green: #68896B;
            --accent-sage: #8FA67E;
            --accent-light: #C8D5B9;
            --accent-taupe: #A0937D;
            --white: #ffffff;
            --accent-1: #88B49A;
            --accent-2: #A0C5A8;
            --accent-3: #B8A596;
            --accent-4: #D4A574;
            --accent-5: #C48B7C;
        }

        body {
            background-color: var(--bg-secondary);
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--accent-green) 0%, var(--accent-sage) 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 3rem;
            border-radius: 0 0 24px 24px;
        }
        .page-header h1 {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            margin: 0;
        }
        .page-header p {
            opacity: 0.9;
            margin: 0.5rem 0 0 0;
        }

        .container {
            max-width: 1400px;
        }

        /* Statistics Cards */
        .stats-card {
            background: var(--white);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid var(--accent-light);
            transition: all 0.3s;
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
        .stats-card h6 {
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
        }
        .stat-value {
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-primary);
            font-family: 'Outfit', sans-serif;
        }
        .stat-subtext {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-top: 0.5rem;
        }
        .stats-icon {
            font-size: 3rem;
            opacity: 0.1;
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
            color: var(--text-primary);
        }
        .stats-card-1 { border-left: 4px solid var(--accent-1); }
        .stats-card-2 { border-left: 4px solid var(--accent-2); }
        .stats-card-3 { border-left: 4px solid var(--accent-3); }
        .stats-card-4 { border-left: 4px solid var(--accent-4); }
        .stats-card-5 { border-left: 4px solid var(--accent-5); }

        /* Chart Cards */
        .chart-card {
            background: var(--white);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            margin-bottom: 2rem;
            border: 1px solid var(--accent-light);
        }
        .chart-card h5 {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
        }
        .chart-container {
            position: relative;
            height: 400px;
        }

        /* Top Lists */
        .top-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .top-list li {
            padding: 1.25rem;
            border-bottom: 1px solid var(--accent-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.2s;
        }
        .top-list li:hover {
            background: var(--bg-secondary);
            border-radius: 12px;
        }
        .top-list li:last-child {
            border-bottom: none;
        }
        .rank-badge {
            background: var(--accent-sage);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 1rem;
            font-family: 'Outfit', sans-serif;
        }
        .rank-badge.gold { 
            background: linear-gradient(135deg, #D4A574 0%, #E8B77D 100%); 
            color: white;
        }
        .rank-badge.silver { 
            background: linear-gradient(135deg, #A0937D 0%, #B8A596 100%); 
            color: white;
        }
        .rank-badge.bronze { 
            background: linear-gradient(135deg, #8FA67E 0%, #A0C5A8 100%); 
            color: white;
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 2rem 0;
            }
            .stat-value {
                font-size: 1.5rem;
            }
        }
         .navbar {
            background-color: #F5F7F4 !important;
            border-bottom: 1px solid #C8D5B9;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            padding: 1rem 2rem;
        }
        .navbar .navbar-brand, .navbar .nav-link {
            color: #3d4a3e !important;
            font-weight: 500;
            letter-spacing: 0.3px;
            font-family: 'Outfit', sans-serif;
        }
        .navbar .nav-link:hover {
            color: #68896B !important;
        }
    </style>
</head>
<body>
<?php include("navigacija.php"); ?>

<?php
include("db__connection.php");

// Get overall statistics
$statsQuery = "SELECT 
    (SELECT COUNT(*) FROM vozila) as TotalVehicles,
    (SELECT COUNT(*) FROM korisnici) as TotalUsers,
    (SELECT COUNT(*) FROM rezervacije) as TotalReservations,
    (SELECT SUM(UkupnaCijena) FROM rezervacije) as TotalRevenue,
    (SELECT SUM(DATEDIFF(DatumZavrsetka, DatumPocetka)) FROM rezervacije) as TotalDays";
    
$statsResult = mysqli_query($db, $statsQuery);
$stats = mysqli_fetch_assoc($statsResult);

// Monthly revenue data for chart
$monthlyQuery = "SELECT 
    DATE_FORMAT(DatumPocetka, '%Y-%m') as Mjesec,
    COALESCE(SUM(UkupnaCijena), 0) as Prihod,
    COUNT(*) as BrojRezervacija
FROM rezervacije
WHERE DatumPocetka >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
GROUP BY DATE_FORMAT(DatumPocetka, '%Y-%m')
ORDER BY Mjesec";

$monthlyResult = mysqli_query($db, $monthlyQuery);
$monthlyData = [];
while ($row = mysqli_fetch_assoc($monthlyResult)) {
    $monthlyData[] = $row;
}

// Top vehicles by revenue
$topVehiclesQuery = "SELECT 
    v.IDVozilo,
    v.Naziv, 
    v.Model,
    COUNT(r.IDRezervacija) as BrojRezervacija,
    COALESCE(SUM(r.UkupnaCijena), 0) as UkupnaProdaja,
    COALESCE(SUM(DATEDIFF(r.DatumZavrsetka, r.DatumPocetka)), 0) as UkupnoDana
FROM vozila v
LEFT JOIN rezervacije r ON v.IDVozilo = r.VoziloID
GROUP BY v.IDVozilo, v.Naziv, v.Model
ORDER BY UkupnaProdaja DESC
LIMIT 5";

$topVehiclesResult = mysqli_query($db, $topVehiclesQuery);
$topVehicles = [];
while ($row = mysqli_fetch_assoc($topVehiclesResult)) {
    $topVehicles[] = $row;
}

// Top customers
$topCustomersQuery = "SELECT 
    k.IDKorisnici,
    k.ImeKorisnika, 
    k.PrezimeKorisnika,
    COUNT(r.IDRezervacija) as BrojRezervacija,
    COALESCE(SUM(r.UkupnaCijena), 0) as UkupnoPlatio
FROM korisnici k
INNER JOIN rezervacije r ON k.IDKorisnici = r.KorisnikID
GROUP BY k.IDKorisnici, k.ImeKorisnika, k.PrezimeKorisnika
ORDER BY UkupnoPlatio DESC
LIMIT 5";

$topCustomersResult = mysqli_query($db, $topCustomersQuery);
$topCustomers = [];
while ($row = mysqli_fetch_assoc($topCustomersResult)) {
    $topCustomers[] = $row;
}

// Vehicle status distribution
$statusQuery = "SELECT 
    CASE 
        WHEN Raspolozivost = 'Dostupno' THEN 'Dostupno'
        WHEN Raspolozivost = 'Rezervirano' THEN 'Rezervirano'
        WHEN Raspolozivost = 'Nije dostupno' THEN 'Nije dostupno'
        ELSE 'Rezervirano'
    END as Status,
    COUNT(*) as Broj
FROM vozila
GROUP BY 
    CASE 
        WHEN Raspolozivost = 'Dostupno' THEN 'Dostupno'
        WHEN Raspolozivost = 'Rezervirano' THEN 'Rezervirano'
        WHEN Raspolozivost = 'Nije dostupno' THEN 'Nije dostupno'
        ELSE 'Ostalo'
    END";

$statusResult = mysqli_query($db, $statusQuery);
$statusData = [];
while ($row = mysqli_fetch_assoc($statusResult)) {
    $statusData[] = $row;
}

// Reservations by vehicle
$reservationsByVehicleQuery = "SELECT 
    CONCAT(v.Naziv, ' ', v.Model) as NazivVozila,
    COUNT(r.IDRezervacija) as BrojRezervacija,
    COALESCE(SUM(r.UkupnaCijena), 0) as UkupnaProdaja
FROM vozila v
LEFT JOIN rezervacije r ON v.IDVozilo = r.VoziloID
GROUP BY v.IDVozilo, v.Naziv, v.Model
ORDER BY BrojRezervacija DESC
LIMIT 10";

$reservationsByVehicleResult = mysqli_query($db, $reservationsByVehicleQuery);
$reservationsByVehicle = [];
while ($row = mysqli_fetch_assoc($reservationsByVehicleResult)) {
    $reservationsByVehicle[] = $row;
}

// Average revenue
$avgRevenueQuery = "SELECT 
    COALESCE(AVG(UkupnaCijena), 0) as AvgRevenue,
    COALESCE(AVG(DATEDIFF(DatumZavrsetka, DatumPocetka)), 0) as AvgDays
FROM rezervacije";
$avgRevenueResult = mysqli_query($db, $avgRevenueQuery);
$avgRevenue = mysqli_fetch_assoc($avgRevenueResult);
?>

<div class="page-header">
    <div class="container">
        <h1>
            <i class="fas fa-chart-line me-3"></i>
            Statistika i Izvještaji
        </h1>
        <p>Pregled poslovanja i analiza podataka</p>
    </div>
</div>

<div class="container pb-5">
    <!-- Overview Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stats-card stats-card-1">
                <i class="fas fa-car stats-icon"></i>
                <h6>Ukupno vozila</h6>
                <div class="stat-value"><?= $stats['TotalVehicles'] ?? 0 ?></div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stats-card stats-card-2">
                <i class="fas fa-users stats-icon"></i>
                <h6>Ukupno korisnika</h6>
                <div class="stat-value"><?= $stats['TotalUsers'] ?? 0 ?></div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stats-card stats-card-3">
                <i class="fas fa-calendar-check stats-icon"></i>
                <h6>Ukupno rezervacija</h6>
                <div class="stat-value"><?= $stats['TotalReservations'] ?? 0 ?></div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stats-card stats-card-4">
                <i class="fas fa-euro-sign stats-icon"></i>
                <h6>Ukupan prihod</h6>
                <div class="stat-value"><?= isset($stats['TotalRevenue']) ? number_format($stats['TotalRevenue'], 2).' €' : '0.00 €' ?></div>
            </div>
        </div>
    </div>

    <!-- Additional Statistics -->
    <div class="row mb-4">
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="stats-card stats-card-5">
                <i class="fas fa-chart-pie stats-icon"></i>
                <h6>Prosječna vrijednost rezervacije</h6>
                <div class="stat-value"><?= number_format($avgRevenue['AvgRevenue'] ?? 0, 2) ?> €</div>
                <div class="stat-subtext">Prosjek trajanja: <?= number_format($avgRevenue['AvgDays'] ?? 0, 1) ?> dana</div>
            </div>
        </div>
        
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="stats-card stats-card-1">
                <i class="fas fa-percentage stats-icon"></i>
                <h6>Zauzetost vozila</h6>
                <?php
                $totalVehicles = $stats['TotalVehicles'] ?? 1;
                $reservedVehicles = 0;
                foreach ($statusData as $status) {
                    if ($status['Status'] == 'Rezervirano') {
                        $reservedVehicles = $status['Broj'];
                    }
                }
                $occupancyRate = ($totalVehicles > 0) ? ($reservedVehicles / $totalVehicles * 100) : 0;
                ?>
                <div class="stat-value"><?= number_format($occupancyRate, 1) ?>%</div>
                <div class="stat-subtext"><?= $reservedVehicles ?> od <?= $totalVehicles ?> vozila</div>
            </div>
        </div>
        
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="stats-card stats-card-2">
                <i class="fas fa-money-bill-wave stats-icon"></i>
                <h6>Prosječni dnevni prihod</h6>
                <?php
                $totalRevenue = $stats['TotalRevenue'] ?? 0;
                $totalDays = $stats['TotalDays'] ?? 1;
                $avgDailyRevenue = ($totalDays > 0) ? ($totalRevenue / $totalDays) : 0;
                ?>
                <div class="stat-value"><?= number_format($avgDailyRevenue, 2) ?> €</div>
                <div class="stat-subtext">po danu iznajmljivanja</div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Monthly Revenue Chart -->
        <div class="col-lg-8 mb-4">
            <div class="chart-card">
                <h5>
                    <i class="fas fa-chart-bar me-2" style="color: var(--accent-green);"></i>
                    Mjesečni prihod (Zadnjih 12 mjeseci)
                </h5>
                <div class="chart-container">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Vehicle Status Chart -->
        <div class="col-lg-4 mb-4">
            <div class="chart-card">
                <h5>
                    <i class="fas fa-chart-pie me-2" style="color: var(--accent-sage);"></i>
                    Status vozila
                </h5>
                <div class="chart-container" style="height: 300px;">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Lists Row -->
    <div class="row">
        <!-- Top Vehicles -->
        <div class="col-lg-6 mb-4">
            <div class="chart-card">
                <h5>
                    <i class="fas fa-trophy me-2" style="color: var(--accent-4);"></i>
                    Top 5 vozila po prihodu
                </h5>
                <ul class="top-list">
                    <?php 
                    $rank = 1;
                    foreach ($topVehicles as $vehicle): 
                        $badgeClass = '';
                        if ($rank == 1) $badgeClass = 'gold';
                        elseif ($rank == 2) $badgeClass = 'silver';
                        elseif ($rank == 3) $badgeClass = 'bronze';
                    ?>
                        <li>
                            <div class="d-flex align-items-center">
                                <span class="rank-badge <?= $badgeClass ?>"><?= $rank ?></span>
                                <div>
                                    <strong><?= htmlspecialchars($vehicle['Naziv'] . ' ' . $vehicle['Model']) ?></strong>
                                    <br>
                                    <small class="text-muted">
                                        <?= $vehicle['BrojRezervacija'] ?> rez. • 
                                        <?= $vehicle['UkupnoDana'] ?> dana
                                    </small>
                                </div>
                            </div>
                            <div class="text-end">
                                <strong style="color: var(--accent-green);"><?= number_format($vehicle['UkupnaProdaja'] ?? 0, 2, ',', '.') ?> €</strong>
                            </div>
                        </li>
                    <?php 
                    $rank++;
                    endforeach; 
                    ?>
                </ul>
            </div>
        </div>

        <!-- Top Customers -->
        <div class="col-lg-6 mb-4">
            <div class="chart-card">
                <h5>
                    <i class="fas fa-star me-2" style="color: var(--accent-sage);"></i>
                    Top 5 korisnika
                </h5>
                <ul class="top-list">
                    <?php 
                    $rank = 1;
                    foreach ($topCustomers as $customer): 
                        $badgeClass = '';
                        if ($rank == 1) $badgeClass = 'gold';
                        elseif ($rank == 2) $badgeClass = 'silver';
                        elseif ($rank == 3) $badgeClass = 'bronze';
                    ?>
                        <li>
                            <div class="d-flex align-items-center">
                                <span class="rank-badge <?= $badgeClass ?>"><?= $rank ?></span>
                                <div>
                                    <strong><?= htmlspecialchars($customer['ImeKorisnika'] . ' ' . $customer['PrezimeKorisnika']) ?></strong>
                                    <br>
                                    <small class="text-muted"><?= $customer['BrojRezervacija'] ?> rezervacija</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <strong style="color: var(--accent-green);"><?= number_format($customer['UkupnoPlatio'] ?? 0, 2, ',', '.') ?> €</strong>
                            </div>
                        </li>
                    <?php 
                    $rank++;
                    endforeach; 
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Reservations by Vehicle Chart -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="chart-card">
                <h5>
                    <i class="fas fa-chart-line me-2" style="color: var(--accent-taupe);"></i>
                    Top 10 vozila po broju rezervacija
                </h5>
                <div class="chart-container">
                    <canvas id="vehicleReservationsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Monthly Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const monthlyData = <?= json_encode($monthlyData) ?>;
    
    if (monthlyData.length === 0) {
        monthlyData.push({Mjesec: new Date().toISOString().slice(0,7), Prihod: 0, BrojRezervacija: 0});
    }
    
    new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: monthlyData.map(d => {
                const date = new Date(d.Mjesec + '-01');
                return date.toLocaleDateString('hr-HR', { month: 'short', year: 'numeric' });
            }),
            datasets: [{
                label: 'Prihod (€)',
                data: monthlyData.map(d => parseFloat(d.Prihod || 0)),
                backgroundColor: 'rgba(104, 137, 107, 0.8)',
                borderColor: 'rgba(104, 137, 107, 1)',
                borderWidth: 2,
                borderRadius: 12
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(61, 74, 62, 0.95)',
                    padding: 12,
                    borderRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return 'Prihod: ' + context.parsed.y.toLocaleString('hr-HR', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + ' €';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('hr-HR', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + ' €';
                        }
                    },
                    grid: {
                        color: 'rgba(200, 213, 185, 0.3)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Vehicle Status Pie Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusData = <?= json_encode($statusData) ?>;
    
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: statusData.map(d => d.Status),
            datasets: [{
                data: statusData.map(d => d.Broj),
                backgroundColor: [
                    'rgba(136, 180, 154, 0.8)',
                    'rgba(212, 165, 116, 0.8)',
                    'rgba(196, 139, 124, 0.8)'
                ],
                borderWidth: 3,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 13,
                            family: "'Inter', sans-serif"
                        }
                    }
                }
            }
        }
    });

    // Vehicle Reservations Chart
    const vehicleResCtx = document.getElementById('vehicleReservationsChart').getContext('2d');
    const reservationsByVehicle = <?= json_encode($reservationsByVehicle) ?>;
    
    new Chart(vehicleResCtx, {
        type: 'bar',
        data: {
            labels: reservationsByVehicle.map(v => v.NazivVozila),
            datasets: [{
                label: 'Broj rezervacija',
                data: reservationsByVehicle.map(v => parseInt(v.BrojRezervacija)),
                backgroundColor: 'rgba(143, 166, 126, 0.8)',
                borderColor: 'rgba(143, 166, 126, 1)',
                borderWidth: 2,
                borderRadius: 12
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(61, 74, 62, 0.95)',
                    padding: 12,
                    borderRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    },
                    grid: {
                        color: 'rgba(200, 213, 185, 0.3)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>

</body>
</html>