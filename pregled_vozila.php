<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Pregled vozila</title>
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
            --success: #88B49A;
            --warning: #D4A574;
            --danger: #C48B7C;
        }

        body {
            background-color: var(--bg-secondary) !important;
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
        }

        .container-fluid {
            max-width: 1400px;
            padding: 2rem;
        }

        /* Alerts */
        .alert-success {
            background-color: var(--accent-light);
            border: 1px solid var(--accent-sage);
            color: var(--text-primary);
            border-radius: 12px;
        }
        .alert-danger {
            background-color: #f4ddd4;
            border: 1px solid var(--danger);
            color: var(--text-primary);
            border-radius: 12px;
        }

        /* Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .page-header h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--accent-green);
            border: none;
            color: white;
            font-weight: 500;
            padding: 0.6rem 1.5rem;
            border-radius: 12px;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background-color: var(--accent-sage);
            transform: translateY(-2px);
        }

        /* Statistics Cards */
        .stat-card {
            background: var(--white);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid var(--accent-light);
            transition: all 0.3s;
            height: 100%;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
        .stat-card h6 {
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
        }
        .stat-card h4 {
            color: var(--text-primary);
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            font-family: 'Outfit', sans-serif;
        }
        .stat-card h2 {
            color: var(--text-primary);
            font-size: 2rem;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
        }
        .stat-card .badge {
            font-weight: 500;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
        }
        .stat-card-1 { border-left: 4px solid var(--success); }
        .stat-card-2 { border-left: 4px solid var(--accent-sage); }
        .stat-card-3 { border-left: 4px solid var(--accent-taupe); }
        .stat-card-4 { border-left: 4px solid var(--warning); }

        .badge-available {
            background-color: var(--success);
            color: white;
        }
        .badge-unavailable {
            background-color: var(--danger);
            color: white;
        }
        .badge-reserved {
            background-color: var(--warning);
            color: white;
        }

        /* Table Card */
        .card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--accent-light);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .table {
            margin: 0;
            color: var(--text-primary);
        }
        .table thead {
            background-color: var(--bg-secondary);
            border-bottom: 2px solid var(--accent-light);
        }
        .table thead th {
            padding: 1rem;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-secondary);
            border: none;
        }
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #e8ede7;
        }
        .table tbody tr:last-child td {
            border-bottom: none;
        }
        .table tbody tr {
            transition: background 0.2s;
        }
        .table tbody tr:hover {
            background-color: #fafbfa;
        }

        /* Photo Thumbnails */
        .vehicle-photo-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 12px;
            cursor: pointer;
            border: 2px solid var(--accent-light);
            transition: all 0.3s;
        }
        .vehicle-photo-thumbnail:hover {
            border-color: var(--accent-sage);
            transform: scale(1.05);
        }
        .no-photo-placeholder {
            width: 60px;
            height: 60px;
            background: var(--bg-secondary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            border: 2px solid var(--accent-light);
            cursor: pointer;
        }

        /* Action Buttons */
        .action-btns .btn {
            margin-right: 0.25rem;
            border-radius: 8px;
            padding: 0.4rem 0.7rem;
        }
        .btn-outline-primary {
            color: var(--accent-green);
            border-color: var(--accent-light);
        }
        .btn-outline-primary:hover {
            background-color: var(--accent-green);
            border-color: var(--accent-green);
            color: white;
        }
        .btn-outline-secondary {
            color: var(--text-secondary);
            border-color: var(--accent-light);
        }
        .btn-outline-secondary:hover {
            background-color: var(--accent-sage);
            border-color: var(--accent-sage);
            color: white;
        }
        .btn-outline-danger {
            color: var(--danger);
            border-color: var(--accent-light);
        }
        .btn-outline-danger:hover {
            background-color: var(--danger);
            border-color: var(--danger);
            color: white;
        }
        .btn-outline-info {
            color: var(--accent-sage);
            border-color: var(--accent-light);
        }
        .btn-outline-info:hover {
            background-color: var(--accent-sage);
            border-color: var(--accent-sage);
            color: white;
        }

        /* Filter Section */
        .filter-section {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 16px;
            border: 1px solid var(--accent-light);
            margin-bottom: 2rem;
        }
        .filter-section .form-label {
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        .filter-section .form-select,
        .filter-section .form-control {
            background: var(--bg-primary);
            border: 1px solid var(--accent-light);
            border-radius: 12px;
            padding: 0.6rem 1rem;
            color: var(--text-primary);
        }
        .filter-section .form-select:focus,
        .filter-section .form-control:focus {
            border-color: var(--accent-sage);
            box-shadow: 0 0 0 4px rgba(143, 166, 126, 0.1);
        }
        .filter-section .btn-secondary {
            background-color: var(--bg-secondary);
            border: none;
            color: var(--text-primary);
        }
        .filter-section .btn-secondary:hover {
            background-color: var(--accent-light);
        }

        /* Modal */
        .modal-content {
            background-color: var(--bg-primary);
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        .modal-header {
            border-bottom: 1px solid var(--accent-light);
            background: var(--white);
            border-radius: 20px 20px 0 0;
            padding: 1.5rem;
        }
        .modal-header .modal-title {
            color: var(--text-primary);
            font-weight: 600;
            font-size: 1.5rem;
            font-family: 'Outfit', sans-serif;
        }
        .modal-body {
            padding: 1.5rem;
        }
        .modal-body label {
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        .modal-body .form-control,
        .modal-body .form-select {
            background: var(--white);
            border: 1px solid var(--accent-light);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            color: var(--text-primary);
        }
        .modal-body .form-control:focus,
        .modal-body .form-select:focus {
            border-color: var(--accent-sage);
            box-shadow: 0 0 0 4px rgba(143, 166, 126, 0.1);
        }
        .modal-footer {
            border-top: 1px solid var(--accent-light);
            padding: 1.5rem;
            border-radius: 0 0 20px 20px;
            background: var(--white);
        }
        .modal-footer .btn-secondary {
            background: var(--bg-secondary);
            border: none;
            color: var(--text-primary);
        }
        .modal-footer .btn-secondary:hover {
            background: var(--accent-light);
        }

        /* Photo Gallery */
        .photo-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        .photo-gallery-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid var(--accent-light);
        }
        .photo-gallery-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .photo-gallery-item .delete-photo {
            position: absolute;
            top: 8px;
            right: 8px;
            background: var(--danger);
            border: none;
            color: white;
            border-radius: 8px;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .photo-gallery-item .main-photo-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            background: var(--success);
            color: white;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
        }
    </style>
</head>
<body>
<?php include("navigacija.php"); ?>
    <div class="container-fluid py-4">
        <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= htmlspecialchars($_GET['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= htmlspecialchars($_GET['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="page-header">
            <h1>Pregled vozila</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" style="background-color: #3d4a3e; border-color: #3d4a3e;color: white;" data-bs-target="#addVehicleModal">
                <i class="fas fa-plus me-2"></i> Dodaj novo vozilo
            </button>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <?php
            include("db__connection.php");
            
            $mostRentedQuery = "SELECT v.IDVozilo, v.Naziv, v.Model, 
                              COUNT(r.IDRezervacija) AS BrojRezervacija,
                              SUM(DATEDIFF(r.DatumZavrsetka, r.DatumPocetka)) AS UkupnoDana
                              FROM vozila v
                              LEFT JOIN rezervacije r ON v.IDVozilo = r.VoziloID
                              GROUP BY v.IDVozilo, v.Naziv, v.Model
                              ORDER BY BrojRezervacija DESC, UkupnoDana DESC
                              LIMIT 1";
            $mostRentedResult = mysqli_query($db, $mostRentedQuery);
            $mostRented = mysqli_fetch_assoc($mostRentedResult);
            
            $highestEarningQuery = "SELECT v.IDVozilo, v.Naziv, v.Model, 
                                   SUM(r.UkupnaCijena) AS UkupnaZarada
                                   FROM vozila v
                                   LEFT JOIN rezervacije r ON v.IDVozilo = r.VoziloID
                                   GROUP BY v.IDVozilo, v.Naziv, v.Model
                                   ORDER BY UkupnaZarada DESC
                                   LIMIT 1";
            $highestEarningResult = mysqli_query($db, $highestEarningQuery);
            $highestEarning = mysqli_fetch_assoc($highestEarningResult);
            
            $statsQuery = "SELECT 
                          SUM(DATEDIFF(r.DatumZavrsetka, r.DatumPocetka)) AS UkupnoDana,
                          SUM(r.UkupnaCijena) AS UkupnaZarada
                          FROM rezervacije r";
            $statsResult = mysqli_query($db, $statsQuery);
            $stats = mysqli_fetch_assoc($statsResult);
            
            $currentDate = date('Y-m-d');
            $rentedQuery = "SELECT COUNT(DISTINCT VoziloID) AS TrenutnoIznajmljeno
                           FROM rezervacije
                           WHERE StatusRezervacije = 'aktivna'";
            $stmt = mysqli_prepare($db, $rentedQuery);
            mysqli_stmt_execute($stmt);
            $rentedResult = mysqli_stmt_get_result($stmt);
            $rentedCount = mysqli_fetch_assoc($rentedResult);
            ?>
            
            <div class="col-md-3 mb-3">
                <div class="card stat-card stat-card-1">
                    <div class="card-body">
                        <h6>Najiznajmljivanije vozilo</h6>
                        <h4>
                            <?= $mostRented ? htmlspecialchars($mostRented['Naziv'].' '.$mostRented['Model']) : 'Nema podataka' ?>
                        </h4>
                        <div>
                             <span class="badge" style="background-color: var(--accent-green);">
                                <?= $mostRented ? $mostRented['BrojRezervacija'].' rez.' : '0 rez.' ?>
                            </span>
                            <span class="badge" style="background-color: var(--accent-sage);">
                                <?= $mostRented ? $mostRented['UkupnoDana'].' dana' : '0 dana' ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="card stat-card stat-card-2">
                    <div class="card-body">
                        <h6>Najveća zarada od vozila</h6>
                        <h4>
                            <?= $highestEarning ? htmlspecialchars($highestEarning['Naziv'].' '.$highestEarning['Model']) : 'Nema podataka' ?>
                        </h4>
                        <span class="badge badge-available">
                            <?= $highestEarning ? number_format($highestEarning['UkupnaZarada'], 2).' €' : '0.00 €' ?>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="card stat-card stat-card-3">
                    <div class="card-body">
                        <h6>Ukupno iznajmljivanja</h6>
                        <h2><?= $stats['UkupnoDana'] ?? 0 ?> dana</h2>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="card stat-card stat-card-4">
                    <div class="card-body">
                        <h6>Trenutno iznajmljeno</h6>
                        <h2><?= $rentedCount['TrenutnoIznajmljeno'] ?? 0 ?> vozila</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form method="get" action="">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                       <?php $current_status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_SPECIAL_CHARS); ?>

<select class="form-select" name="status">
    <option value="">Svi statusi</option>
    
    <option value="Dostupno" <?= $current_status === 'Dostupno' ? 'selected' : '' ?>>
        Dostupno
    </option>
    
    <option value="Nije dostupno" <?= $current_status === 'Nije dostupno' ? 'selected' : '' ?>>
        Nije dostupno
    </option>
</select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Cijena od (€)</label>
                        <input type="number" step="0.01" class="form-control" name="price_from" value="<?= $_GET['price_from'] ?? '' ?>" placeholder="0.00">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Cijena do (€)</label>
                        <input type="number" step="0.01" class="form-control" name="price_to" value="<?= $_GET['price_to'] ?? '' ?>" placeholder="999.99">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Sortiraj po</label>
                        <select class="form-select" name="sort_by">
                            <option value="">Zadano</option>
                            <option value="name_asc" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] == 'name_asc') ? 'selected' : '' ?>>Naziv A-Z</option>
                            <option value="name_desc" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] == 'name_desc') ? 'selected' : '' ?>>Naziv Z-A</option>
                            <option value="price_asc" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] == 'price_asc') ? 'selected' : '' ?>>Cijena ↑</option>
                            <option value="price_desc" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] == 'price_desc') ? 'selected' : '' ?>>Cijena ↓</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2" style="background-color: #3d4a3e; border-color: #3d4a3e;color: white;">
                            <i class="fas fa-filter me-1"></i> Filtriraj
                        </button>
                        <a href="pregled_vozila.php" class="btn btn-secondary">
                            <i class="fas fa-redo me-1"></i> 
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Add Vehicle Modal -->
        <div class="modal fade" id="addVehicleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Dodaj novo vozilo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addVehicleForm" action="dodaj_vozilo.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nazivVozila" class="form-label">Naziv vozila</label>
                                <input type="text" class="form-control" id="nazivVozila" name="nazivVozila" maxlength="25" required>
                            </div>
                            <div class="mb-3">
                                <label for="modelVozila" class="form-label">Model vozila</label>
                                <input type="text" class="form-control" id="modelVozila" name="modelVozila" maxlength="25">
                            </div>
                            <div class="mb-3">
                                <label for="cijenaVozila" class="form-label">Cijena korištenja dnevno</label>
                                <input type="number" step="0.01" class="form-control" id="cijenaVozila" name="cijenaVozila" required>
                            </div>
                            <div class="mb-3">
                                <label for="godiste" class="form-label">Godina proizvodnje</label>
                                <input type="text" class="form-control" id="godiste" name="godiste">
                            </div>
                            <div class="mb-3">
                                <label for="kilometraza" class="form-label">Prijeđenih kilometara</label>
                                <input type="number" class="form-control" id="kilometraza" name="kilometraza">
                            </div>
                            <div class="mb-3">
                                <label for="registracija" class="form-label">Registracija</label>
                                <input type="text" class="form-control" id="registracija" name="registracija">
                            </div>
                            <div class="mb-3">
                                <label for="vehicle_photo" class="form-label">Slika vozila</label>
                                <input type="file" class="form-control" id="vehicle_photo" name="vehicle_photo" accept="image/*">
                                <small class="text-muted">Podržani formati: JPG, PNG, GIF, WEBP (max 5MB)</small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                        <button type="submit" form="addVehicleForm" class="btn btn-primary">Spremi vozilo</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Photo Gallery Modal -->
        <div class="modal fade" id="photoGalleryModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Galerija slika</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="upload_photo.php" method="POST" enctype="multipart/form-data" class="mb-4">
                            <input type="hidden" id="galleryVehicleId" name="voziloID">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="file" class="form-control" name="vehicle_photo" accept="image/*" required>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="jeGlavna" id="jeGlavna">
                                        <label class="form-check-label" for="jeGlavna">Glavna slika</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">
                                <i class="fas fa-upload"></i> Dodaj sliku
                            </button>
                        </form>
                        <div id="photoGalleryContent" class="photo-gallery-grid"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vehicles Table -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Slika</th>
                                <th>ID</th>
                                <th>Naziv</th>
                                <th>Model</th>
                                <th>Cijena/dan</th>
                                <th>Godište</th>
                                <th>Kilometraža</th>
                                <th>Registracija</th>
                                <th>Status</th>
                                <th>Akcije</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $resetStatusQuery = "UPDATE vozila SET Raspolozivost = 'Dostupno'";
                            mysqli_query($db, $resetStatusQuery);

                            $unavailableQuery = "UPDATE vozila v
                                                 JOIN rezervacije r ON v.IDVozilo = r.VoziloID 
                                                 SET v.Raspolozivost = 'Nije dostupno'
                                                 WHERE r.StatusRezervacije = 'aktivna'
                                                   AND CURDATE() BETWEEN r.DatumPocetka AND r.DatumZavrsetka";
                            mysqli_query($db, $unavailableQuery);

                            $reservedQuery = "UPDATE vozila v
                                              JOIN rezervacije r ON v.IDVozilo = r.VoziloID
                                              SET v.Raspolozivost = 'Rezervirano'
                                              WHERE r.StatusRezervacije = 'aktivna'
                                                AND CURDATE() < r.DatumPocetka";
                            mysqli_query($db, $reservedQuery);

                            $query = "SELECT 
                                v.IDVozilo, v.Naziv, v.Model, v.CijenaKoristenjaDnevno, v.Raspolozivost,
                                ka.Godiste, ka.Kilometraza, ka.Registracija,
                                COUNT(r.IDRezervacija) AS BrojRezervacija,
                                SUM(DATEDIFF(r.DatumZavrsetka, r.DatumPocetka)) AS UkupnoDana,
                                SUM(r.UkupnaCijena) AS UkupnaZarada,
                                vs.PutanjaSlike AS GlavnaSlika
                            FROM vozila v
                            LEFT JOIN karakteristike_automobila ka ON v.IDVozilo = ka.VoziloID
                            LEFT JOIN rezervacije r ON v.IDVozilo = r.VoziloID
                            LEFT JOIN vozila_slike vs ON v.IDVozilo = vs.VoziloID AND vs.JeGlavna = 1";
                            
                            // Add filter conditions
                            $whereClauses = [];
                            if (!empty($_GET['status'])) {
                                $whereClauses[] = "v.Raspolozivost = '" . mysqli_real_escape_string($db, $_GET['status']) . "'";
                            }
                            if (!empty($_GET['price_from'])) {
                                $whereClauses[] = "v.CijenaKoristenjaDnevno >= " . floatval($_GET['price_from']);
                            }
                            if (!empty($_GET['price_to'])) {
                                $whereClauses[] = "v.CijenaKoristenjaDnevno <= " . floatval($_GET['price_to']);
                            }
                            
                            if (!empty($whereClauses)) {
                                $query .= " WHERE " . implode(" AND ", $whereClauses);
                            }
                            
                            $query .= " GROUP BY v.IDVozilo, v.Naziv, v.Model, v.CijenaKoristenjaDnevno, 
                                     v.Raspolozivost, ka.Godiste, ka.Kilometraza, ka.Registracija, vs.PutanjaSlike";
                            
                            // Add sorting
                            $orderBy = "v.Naziv, v.Model"; // Default sorting
                            if (!empty($_GET['sort_by'])) {
                                switch($_GET['sort_by']) {
                                    case 'name_asc':
                                        $orderBy = "v.Naziv ASC, v.Model ASC";
                                        break;
                                    case 'name_desc':
                                        $orderBy = "v.Naziv DESC, v.Model DESC";
                                        break;
                                    case 'price_asc':
                                        $orderBy = "v.CijenaKoristenjaDnevno ASC";
                                        break;
                                    case 'price_desc':
                                        $orderBy = "v.CijenaKoristenjaDnevno DESC";
                                        break;
                                }
                            }
                            
                            $query .= " ORDER BY " . $orderBy;

                            $result = mysqli_query($db, $query) or die("Greška u SQL upitu: " . mysqli_error($db));
                            
                            while ($row = mysqli_fetch_assoc($result)): 
                                $status = $row['Raspolozivost'] ?? 'Nije dostupno';
                                $statusClass = '';
                                $statusText = '';
                                
                                if ($status == 'Dostupno') {
                                    $statusClass = 'badge-available';
                                    $statusText = 'Dostupno';
                                } elseif ($status == 'Rezervirano') {
                                    $statusClass = 'badge-reserved';
                                    $statusText = 'Rezervirano';
                                } else {
                                    $statusClass = 'badge-unavailable';
                                    $statusText = 'Nije dostupno';
                                }
                            ?>
                                <tr>
                                    <td>
                                        <?php if ($row['GlavnaSlika']): ?>
                                            <img src="<?= htmlspecialchars($row['GlavnaSlika']) ?>" 
                                                 class="vehicle-photo-thumbnail" 
                                                 alt="Vehicle photo"
                                                 onclick="openPhotoGallery(<?= $row['IDVozilo'] ?>)">
                                        <?php else: ?>
                                            <div class="no-photo-placeholder" onclick="openPhotoGallery(<?= $row['IDVozilo'] ?>)">
                                                <i class="fas fa-camera"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $row['IDVozilo'] ?></td>
                                    <td>
                                        <?= htmlspecialchars($row['Naziv']) ?>
                                        <?php if ($row['BrojRezervacija'] > 0): ?>
                                            <span class="badge" style="background-color: var(--accent-green); color: white; margin-left: 0.5rem;">
                                                <?= $row['BrojRezervacija'] ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($row['Model'] ?? 'N/A') ?></td>
                                    <td><?= number_format($row['CijenaKoristenjaDnevno'], 2) ?> €</td>
                                    <td><?= htmlspecialchars($row['Godiste'] ?? 'N/A') ?></td>
                                    <td><?= isset($row['Kilometraza']) ? number_format($row['Kilometraza'], 0, ',', '.') . ' km' : 'N/A' ?></td>
                                    <td><?= htmlspecialchars($row['Registracija'] ?? 'N/A') ?></td>
                                    <td>
                                        <span class="badge <?= $statusClass ?>">
                                            <?= $statusText ?>
                                        </span>
                                    </td>
                                    <td class="action-btns">
                                        <button class="btn btn-sm btn-outline-secondary" 
                                                onclick="openPhotoGallery(<?= $row['IDVozilo'] ?>)" 
                                                title="Slike">
                                            <i class="fas fa-images"></i>
                                        </button>
                                        <a href="edit_vozilo.php?id=<?= $row['IDVozilo'] ?>" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Uredi">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="obrisi_vozilo.php?id=<?= $row['IDVozilo'] ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           title="Obriši" 
                                           onclick="return confirm('Jeste li sigurni da želite obrisati ovo vozilo?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <?php if ($row['BrojRezervacija'] > 0): ?>
                                            <button class="btn btn-sm btn-outline-info" 
                                                    title="Statistika iznajmljivanja"
                                                    data-bs-toggle="popover"
                                                    data-bs-html="true"
                                                    data-bs-content="<div><small>Ukupno dana:</small> <?= $row['UkupnoDana'] ?? 0 ?></div>
                                                                  <div><small>Ukupna zarada:</small> <?= number_format($row['UkupnaZarada'] ?? 0, 2) ?> €</div>">
                                                <i class="fas fa-chart-line"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                new bootstrap.Alert(alert).close();
            });
        }, 5000);

        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl, {
                trigger: 'hover focus'
            });
        });

        function openPhotoGallery(vehicleId) {
            document.getElementById('galleryVehicleId').value = vehicleId;
            
            fetch('get_vehicle_photos.php?id=' + vehicleId)
                .then(response => response.json())
                .then(data => {
                    const gallery = document.getElementById('photoGalleryContent');
                    gallery.innerHTML = '';
                    
                    if (data.length === 0) {
                        gallery.innerHTML = '<p class="text-muted">Nema slika za ovo vozilo</p>';
                    } else {
                        data.forEach(photo => {
                            const photoDiv = document.createElement('div');
                            photoDiv.className = 'photo-gallery-item';
                            photoDiv.innerHTML = `
                                <img src="${photo.PutanjaSlike}" alt="Vehicle photo">
                                ${photo.JeGlavna ? '<span class="main-photo-badge">Glavna</span>' : ''}
                                <button class="delete-photo" onclick="deletePhoto(${photo.IDSlika})" title="Obriši">
                                    <i class="fas fa-times"></i>
                                </button>
                            `;
                            gallery.appendChild(photoDiv);
                        });
                    }
                    
                    const modal = new bootstrap.Modal(document.getElementById('photoGalleryModal'));
                    modal.show();
                });
        }

        function deletePhoto(photoId) {
            if (confirm('Jeste li sigurni da želite obrisati ovu sliku?')) {
                window.location.href = 'delete_photo.php?id=' + photoId;
            }
        }
    </script>
</body>
</html>