<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Rent a car</title>
    <style>
        /* ===== MODERN PASTEL PALETTE ===== 
           #E8EDE7  (soft cream/beige background)
           #C8D5B9  (pastel sage green)
           #8FA67E  (muted olive green)
           #68896B  (soft forest green)
           #A0937D  (warm taupe/brown)
           #6B7B6E  (soft gray-green)
           #F5F7F4  (off-white)
        */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #C8D5B9;
            font-family: 'Inter', sans-serif;
            color: #3d4a3e;
            line-height: 1.6;
        }

        

        /* Alerts with soft colors */
        .alert-success {
            background-color: #C8D5B9;
            border: 1px solid #8FA67E;
            color: #3d4a3e;
            border-radius: 12px;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .alert-danger {
            background-color: #f4ddd4;
            border: 1px solid #d4a49a;
            color: #5a3d38;
            border-radius: 12px;
        }

        .container {
            max-width: 1400px;
            padding: 3rem 2rem;
        }

        /* Clean header design */
        .page-header {
            margin-bottom: 4rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #C8D5B9;
        }
        .page-header h1 {
            font-size: 3rem;
            font-weight: 400;
            color: #3d4a3e;
            letter-spacing: -0.5px;
            font-family: 'Outfit', sans-serif;
            margin-bottom: 0.5rem;
        }
        .page-header p {
            color: #6B7B6E;
            font-weight: 400;
            font-size: 1.1rem;
            margin: 0;
        }

        /* Grid layout */
        .vehicle-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 2.5rem;
            margin-top: 2rem;
        }

        /* Modern card design */
        .vehicle-card {
            background-color: #F5F7F4;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e0e5de;
            display: flex;
            flex-direction: column;
        }
        .vehicle-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.12);
        }

        /* Image wrapper - clean and minimal */
        .card-image-wrapper {
            height: 240px;
            position: relative;
            background: #ffffff;
            overflow: hidden;
        }
        .vehicle-card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .vehicle-card:hover .vehicle-card-image {
            transform: scale(1.05);
        }

        .no-image-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #C8D5B9, #8FA67E);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 4rem;
        }

        /* Minimal status badge */
        .status-badge-card {
            position: absolute;
            top: 16px;
            right: 16px;
            padding: 8px 18px;
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-radius: 20px;
            backdrop-filter: blur(8px);
            z-index: 5;
            text-transform: uppercase;
            font-family: 'Outfit', sans-serif;
        }
        .status-available {
            background: rgba(200, 213, 185, 0.95);
            color: #3d4a3e;
        }
        .status-unavailable {
            background: rgba(160, 147, 125, 0.95);
            color: #ffffff;
        }

        .vehicle-card-body {
            padding: 2rem 1.8rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .vehicle-title {
            font-size: 1.5rem;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 0.5rem;
            color: #3d4a3e;
            font-family: 'Outfit', sans-serif;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
        }
        .vehicle-title span {
            font-size: 0.85rem;
            background-color: #E8EDE7;
            padding: 4px 12px;
            border-radius: 12px;
            color: #6B7B6E;
            font-weight: 500;
            white-space: nowrap;
        }

        /* Clean spec list */
        .spec-list {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }
        .spec-list li {
            font-size: 0.9rem;
            color: #3d4a3e;
            background: #ffffff;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            border: 1px solid #e0e5de;
        }
        .spec-list li strong {
            color: #6B7B6E;
            font-weight: 600;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 4px;
        }
        .spec-list li span {
            font-weight: 600;
            color: #3d4a3e;
            font-size: 1rem;
        }

        /* Modern price tag */
        .price-tag {
            font-size: 2rem;
            font-weight: 600;
            color: #68896B;
            line-height: 1;
            margin: 1rem 0 1.5rem 0;
            font-family: 'Outfit', sans-serif;
        }
        .price-tag small {
            font-size: 1rem;
            font-weight: 400;
            color: #6B7B6E;
            margin-left: 0.3rem;
        }

        /* Clean button design */
        .btn-reserve {
            width: 100%;
            background: #68896B;
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 1rem;
            border-radius: 12px;
            font-size: 1rem;
            letter-spacing: 0.3px;
            transition: all 0.25s;
            margin-top: auto;
            font-family: 'Outfit', sans-serif;
        }
        .btn-reserve:hover:not(:disabled) {
            background: #8FA67E;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(104, 137, 107, 0.3);
        }
        .btn-reserve:disabled {
            background: #A0937D;
            color: #ffffff;
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Modal - clean and modern */
        .modal-content {
            background-color: #F5F7F4;
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        .modal-header {
            border-bottom: 1px solid #e0e5de;
            background: #ffffff;
            border-radius: 24px 24px 0 0;
            padding: 2rem;
        }
        .modal-header .modal-title {
            color: #3d4a3e;
            font-weight: 600;
            font-size: 1.75rem;
            font-family: 'Outfit', sans-serif;
        }
        .modal-header .btn-close {
            background-color: #E8EDE7;
            border-radius: 50%;
            opacity: 1;
        }
        .modal-body {
            padding: 2rem;
        }
        .modal-body label {
            color: #3d4a3e;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
        }
        .modal-body .form-control, .modal-body .form-select {
            background: #ffffff;
            border: 1px solid #e0e5de;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            color: #3d4a3e;
            font-weight: 500;
            transition: 0.2s;
        }
        .modal-body .form-control:focus, .modal-body .form-select:focus {
            border-color: #8FA67E;
            box-shadow: 0 0 0 4px rgba(143, 166, 126, 0.1);
            outline: none;
        }
        .modal-footer {
            border-top: 1px solid #e0e5de;
            padding: 1.5rem 2rem;
            border-radius: 0 0 24px 24px;
            background: #ffffff;
        }
        .modal-footer .btn {
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border: none;
            font-family: 'Outfit', sans-serif;
        }
        .modal-footer .btn-secondary {
            background: #E8EDE7;
            color: #3d4a3e;
        }
        .modal-footer .btn-secondary:hover {
            background: #C8D5B9;
        }
        .modal-footer .btn-primary {
            background: #68896B;
            color: #ffffff;
        }
        .modal-footer .btn-primary:hover {
            background: #8FA67E;
        }

        @media (max-width: 700px) {
            .page-header h1 { font-size: 2.2rem; }
            .vehicle-grid { 
                gap: 1.5rem;
                grid-template-columns: 1fr;
            }
            .container {
                padding: 2rem 1.5rem;
            }
        }
        
    </style>
</head>
<body>

<!-- navigacija (vaš include) -->
<?php include("navigacija.php"); ?>
    <div class="container-fluid py-4">
        <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= htmlspecialchars($_GET['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

<?php
if (isset($_GET['success'])) {
    echo '<div class="alert alert-success text-center mx-3 mt-3"><i class="fa-regular fa-circle-check me-2"></i>Vozilo je uspješno dodano!</div>';
}
if (isset($_GET['deleted'])) {
    echo '<div class="alert alert-success text-center mx-3 mt-3"><i class="fa-regular fa-circle-check me-2"></i>Vozilo je uspješno obrisano!</div>';
}
if (isset($_GET['error'])) {
    echo '<div class="alert alert-danger text-center mx-3 mt-3"><i class="fa-regular fa-circle-exclamation me-2"></i>' . htmlspecialchars($_GET['error']) . '</div>';
}
?>

<div class="container">
    <div class="page-header">
       
    </div>

    <!-- grid kartica -->
    <div class="vehicle-grid">
        <?php
        // VAŠ ORIGINALNI KOD – potpuno nepromijenjen, uključujući upit i while petlju
        include("db__connection.php");

        $query = "SELECT 
            v.IDVozilo, v.Naziv, v.Model, v.CijenaKoristenjaDnevno, v.Raspolozivost,
            ka.Godiste, ka.Kilometraza, ka.Registracija,
            vs.PutanjaSlike,
            CASE WHEN EXISTS (
                SELECT 1 FROM rezervacije r 
                WHERE r.VoziloID = v.IDVozilo 
                AND (
                    (r.DatumPocetka <= NOW() AND r.DatumZavrsetka >= NOW()) OR
                    (r.DatumPocetka >= NOW())
                )
            ) THEN 1 ELSE 0 END AS ImaAktivnuRezervaciju
        FROM vozila v
        JOIN karakteristike_automobila ka ON v.IDVozilo = ka.VoziloID
        LEFT JOIN vozila_slike vs ON v.IDVozilo = vs.VoziloID AND vs.JeGlavna = 1";

        $result = mysqli_query($db, $query) or die("Greška u SQL upitu: " . mysqli_error($db));

        while ($row = mysqli_fetch_array($result)) {
            $isAvailable = $row["Raspolozivost"] && !$row["ImaAktivnuRezervaciju"];
            $statusText = $isAvailable ? 'Dostupno' : 'Nedostupno';
            $statusClass = $isAvailable ? 'status-available' : 'status-unavailable';
            
            echo '
            <div class="vehicle-card" data-id="' . $row["IDVozilo"] . '" 
                 data-name="' . htmlspecialchars($row["Naziv"] . ' ' . $row["Model"]) . '" 
                 data-price="' . $row["CijenaKoristenjaDnevno"] . '"
                 data-available="' . ($isAvailable ? '1' : '0') . '">
                
                <div class="card-image-wrapper">
                    <div class="status-badge-card ' . $statusClass . '">' . $statusText . '</div>';
                    
            if ($row["PutanjaSlike"]) {
                echo '<img src="' . htmlspecialchars($row["PutanjaSlike"]) . '" class="vehicle-card-image" alt="' . htmlspecialchars($row["Naziv"]) . '">';
            } else {
                echo '<div class="no-image-placeholder">
                        <i class="fas fa-car"></i>
                      </div>';
            }
            
            echo '</div>'; // kraj omota slike

            echo '<div class="vehicle-card-body">
                    <div class="vehicle-title">
                        <span style="flex: 1;">' . htmlspecialchars($row["Naziv"] . ' ' . $row["Model"]) . '</span>
                        <span>#' . $row["IDVozilo"] . '</span>
                    </div>';
                    
            echo '<ul class="spec-list">
                    <li><strong>Godište</strong> <span>' . htmlspecialchars($row["Godiste"]) . '</span></li>
                    <li><strong>Kilometraža</strong> <span>' . number_format($row["Kilometraza"], 0, ',', '.') . ' km</span></li>
                    <li><strong>Registracija</strong> <span>' . htmlspecialchars($row["Registracija"]) . '</span></li>
                    <li><strong>Tip</strong> <span>Limuzina</span></li>
                </ul>';

            echo '<div class="price-tag">
                    €' . number_format($row["CijenaKoristenjaDnevno"], 2) . ' <small>/dan</small>
                  </div>';

            echo '<button class="btn-reserve" ' . (!$isAvailable ? 'disabled' : '') . '>
                    <i class="fas fa-calendar-check me-2"></i> Rezerviraj vozilo
                  </button>
                </div> <!-- end card-body -->
            </div>';
        }
        ?>
    </div>
</div>

<!-- Reservation Modal -->
<div class="modal fade" id="addReservationModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-calendar-alt me-2" style="color: #8FA67E;"></i>Nova rezervacija</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="addReservationForm" action="dodaj_rezervaciju.php" method="POST">
      <div class="modal-body">
          <input type="hidden" id="selectedVehicleId" name="voziloID">
          
          <!-- Customer Information -->
          <div class="mb-3">
            <label for="imeKorisnika" class="form-label">Ime <span style="color: #C48B7C;">*</span></label>
            <input type="text" class="form-control" id="imeKorisnika" name="imeKorisnika" maxlength="25" required placeholder="Unesite ime">
          </div>
          <div class="mb-3">
            <label for="prezimeKorisnika" class="form-label">Prezime <span style="color: #C48B7C;">*</span></label>
            <input type="text" class="form-control" id="prezimeKorisnika" name="prezimeKorisnika" maxlength="25" required placeholder="Unesite prezime">
          </div>
          <div class="mb-3">
            <label for="emailKorisnika" class="form-label">Email <span style="color: #C48B7C;">*</span></label>
            <input type="email" class="form-control" id="emailKorisnika" name="emailKorisnika" maxlength="100" required placeholder="primjer@email.com">
            <small class="text-muted">Koristit ćemo email za vašu rezervaciju</small>
          </div>
          
          <hr style="margin: 1.5rem 0; border-color: #C8D5B9;">
          
          <!-- Reservation Details -->
          <div class="mb-3">
            <label for="cijenaKoristenjaDnevno" class="form-label">Cijena (€/dan)</label>
            <input type="text" class="form-control" id="cijenaKoristenjaDnevno" name="cijenaKoristenjaDnevno" readonly>
          </div>
          <div class="mb-3">
            <label for="odKada" class="form-label">Od kada</label>
            <input type="datetime-local" class="form-control" id="odKada" name="odKada" required>
          </div>
          <div class="mb-3">
            <label for="doKada" class="form-label">Do kada</label>
            <input type="datetime-local" class="form-control" id="doKada" name="doKada" required>
          </div>
          <div class="mb-3">
            <label for="ukupnaCijena" class="form-label">Ukupna cijena (€)</label>
            <input type="text" class="form-control" id="ukupnaCijena" name="ukupnaCijena" readonly>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
        <button type="submit" class="btn btn-primary">Spremi rezervaciju</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".btn-reserve").forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.stopPropagation();
            const card = this.closest(".vehicle-card");
            const isAvailable = card.getAttribute("data-available") === "1";
            
            if (!isAvailable) {
                alert("Vozilo trenutno nije dostupno za rezervaciju.");
                return;
            }
            
            const vehicleId = card.getAttribute("data-id");
            const vehiclePrice = card.getAttribute("data-price");
            
            document.getElementById("selectedVehicleId").value = vehicleId;
            document.getElementById("cijenaKoristenjaDnevno").value = vehiclePrice;
            
            const reservationModal = new bootstrap.Modal(document.getElementById("addReservationModal"));
            reservationModal.show();
        });
    });

    document.getElementById('addReservationForm').addEventListener('submit', function(e) {
        const odKada = new Date(document.getElementById('odKada').value);
        const doKada = new Date(document.getElementById('doKada').value);
        
        if (odKada >= doKada) {
            alert('Datum završetka mora biti nakon datuma početka!');
            e.preventDefault();
            return;
        }
    });
});

function izracunajUkupnuCijenu() {
    const cijenaPoDanu = parseFloat(document.getElementById("cijenaKoristenjaDnevno").value);
    const odKada = new Date(document.getElementById("odKada").value);
    const doKada = new Date(document.getElementById("doKada").value);
    
    if (!isNaN(cijenaPoDanu) && odKada && doKada && doKada > odKada) {
        const razlikaUDanima = Math.ceil((doKada - odKada) / (1000 * 60 * 60 * 24));
        const ukupnaCijena = cijenaPoDanu * razlikaUDanima;
        document.getElementById("ukupnaCijena").value = ukupnaCijena.toFixed(2);
    } else {
        document.getElementById("ukupnaCijena").value = '';
    }
}

document.getElementById("odKada").addEventListener("change", izracunajUkupnuCijenu);
document.getElementById("doKada").addEventListener("change", izracunajUkupnuCijenu);
</script>

</body>
</html>