<?php
include("db__connection.php");

// Get overall statistics - ISPRAVLJENI UPITI
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

// Top customers - ISPRAVLJENO: samo korisnici s rezervacijama
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

// Dodatni upit za rezervacije po vozilima za graf
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

// Ukupni prosječni prihod po rezervaciji
$avgRevenueQuery = "SELECT 
    COALESCE(AVG(UkupnaCijena), 0) as AvgRevenue,
    COALESCE(AVG(DATEDIFF(DatumZavrsetka, DatumPocetka)), 0) as AvgDays
FROM rezervacije";
$avgRevenueResult = mysqli_query($db, $avgRevenueQuery);
$avgRevenue = mysqli_fetch_assoc($avgRevenueResult);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Statistika - Rent-a-Car</title>
    <style>
       
        .stats-card {
            border-left: 4px solid;
            transition: all 0.3s;
            height: 100%;
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        .stats-card-1 { border-left-color: #4361ee; }
        .stats-card-2 { border-left-color: #3f37c9; }
        .stats-card-3 { border-left-color: #4cc9f0; }
        .stats-card-4 { border-left-color: #7209b7; }
        .stats-card-5 { border-left-color: #f72585; }
        
        .stats-icon {
            font-size: 3rem;
            opacity: 0.2;
            position: absolute;
            right: 20px;
            top: 20px;
        }
        
        .chart-container {
            position: relative;
            height: 400px;
            margin-bottom: 30px;
        }
        
        .chart-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 40px;
            border-radius: 0 0 20px 20px;
        }
        
        .top-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .top-list li {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.2s;
        }
        
        .top-list li:hover {
            background: #f8f9fa;
        }
        
        .top-list li:last-child {
            border-bottom: none;
        }
        
        .rank-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
        }
        
        .rank-badge.gold { background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: #333; }
        .rank-badge.silver { background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%); color: #333; }
        .rank-badge.bronze { background: linear-gradient(135deg, #cd7f32 0%, #e8b77d 100%); color: #fff; }
        
        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
        }
        
        .stat-subtext {
            font-size: 0.85rem;
            color: #6c757d;
        }
    </style>
</head>
<body class="bg-light">
<?php include("navigacija.php"); ?>

<div class="page-header">
    <div class="container">
        <h1 class="mb-0">
            <i class="fas fa-chart-line me-3"></i>
            Statistika i Izvještaji
        </h1>
        <p class="mb-0 mt-2 opacity-75">Pregled poslovanja i analiza podataka</p>
    </div>
</div>

<div class="container pb-5">
    <!-- Overview Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stats-card stats-card-1">
                <div class="card-body position-relative">
                    <i class="fas fa-car stats-icon"></i>
                    <h6 class="text-muted mb-2">Ukupno vozila</h6>
                    <div class="stat-value"><?= $stats['TotalVehicles'] ?? 0 ?></div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stats-card stats-card-2">
                <div class="card-body position-relative">
                    <i class="fas fa-users stats-icon"></i>
                    <h6 class="text-muted mb-2">Ukupno korisnika</h6>
                    <div class="stat-value"><?= $stats['TotalUsers'] ?? 0 ?></div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stats-card stats-card-3">
                <div class="card-body position-relative">
                    <i class="fas fa-calendar-check stats-icon"></i>
                    <h6 class="text-muted mb-2">Ukupno rezervacija</h6>
                    <div class="stat-value"><?= $stats['TotalReservations'] ?? 0 ?></div>
                    
                  
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stats-card stats-card-4">
                <div class="card-body position-relative">
                    <i class="fas fa-euro-sign stats-icon"></i>
                    <h6 class="text-muted mb-2">Ukupan prihod</h6>
                    <div class="stat-value"><?= isset($stats['TotalRevenue']) ? number_format($stats['TotalRevenue'], 2).' €' : '0.00 €' ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dodatne statističke kartice -->
    <div class="row mb-4">
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card stats-card stats-card-5">
                <div class="card-body position-relative">
                    <i class="fas fa-chart-pie stats-icon"></i>
                    <h6 class="text-muted mb-2">Prosječna vrijednost rezervacije</h6>
                    <div class="stat-value"><?= number_format($avgRevenue['AvgRevenue'] ?? 0, 2) ?> €</div>
                    <div class="stat-subtext">Prosjek trajanja rezervacija u danima: <?= number_format($avgRevenue['AvgDays'] ?? 0, 1) ?>  </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card stats-card stats-card-1">
                <div class="card-body position-relative">
                    <i class="fas fa-percentage stats-icon"></i>
                    <h6 class="text-muted mb-2">Zauzetost vozila</h6>
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
        </div>
        
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card stats-card stats-card-2">
                <div class="card-body position-relative">
                    <i class="fas fa-money-bill-wave stats-icon"></i>
                    <h6 class="text-muted mb-2">Prosječni dnevni prihod</h6>
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
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Monthly Revenue Chart -->
        <div class="col-lg-8 mb-4">
            <div class="chart-card">
                <h5 class="mb-4">
                    <i class="fas fa-chart-bar me-2 text-primary"></i>
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
                <h5 class="mb-4">
                    <i class="fas fa-chart-pie me-2 text-success"></i>
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
                <h5 class="mb-4">
                    <i class="fas fa-trophy me-2 text-warning"></i>
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
                                <strong class="text-success"><?= number_format($vehicle['UkupnaProdaja'] ?? 0, 2, ',', '.') ?> €</strong>
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
                <h5 class="mb-4">
                    <i class="fas fa-star me-2 text-info"></i>
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
                                <strong class="text-success"><?= number_format($customer['UkupnoPlatio'] ?? 0, 2, ',', '.') ?> €</strong>
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
                <h5 class="mb-4">
                    <i class="fas fa-chart-line me-2 text-danger"></i>
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
    
    // Ako nema podataka, kreiraj prazan graf
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
                backgroundColor: 'rgba(67, 97, 238, 0.8)',
                borderColor: 'rgba(67, 97, 238, 1)',
                borderWidth: 2,
                borderRadius: 8
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
                    'rgba(40, 167, 69, 0.8)',
                    
                    'rgba(220, 53, 69, 0.8)',
             
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
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
                backgroundColor: 'rgba(76, 201, 240, 0.8)',
                borderColor: 'rgba(76, 201, 240, 1)',
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>

</body>
</html>