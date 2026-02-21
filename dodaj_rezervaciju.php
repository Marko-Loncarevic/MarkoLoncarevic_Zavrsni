<?php
include("db__connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get customer information
    $imeKorisnika = trim($_POST['imeKorisnika']);
    $prezimeKorisnika = trim($_POST['prezimeKorisnika']);
    $emailKorisnika = trim($_POST['emailKorisnika']);
    
    // Get reservation details
    $voziloID = intval($_POST['voziloID']);
    $odKada = $_POST['odKada'];
    $doKada = $_POST['doKada'];
    $ukupnaCijena = floatval($_POST['ukupnaCijena']);
    
    // Validate inputs
    if (empty($imeKorisnika) || empty($prezimeKorisnika) || empty($emailKorisnika)) {
        header("Location: pregled_rezervacija.php?error=Molimo popunite sve podatke korisnika");
        exit();
    }
    
    if (empty($voziloID) || empty($odKada) || empty($doKada)) {
        header("Location: pregled_rezervacija.php?error=Molimo popunite sve podatke rezervacije");
        exit();
    }
    
    // Validate dates
    $startDate = new DateTime($odKada);
    $endDate = new DateTime($doKada);
    if ($startDate >= $endDate) {
        header("Location: pregled_rezervacija.php?error=Datum završetka mora biti nakon datuma početka");
        exit();
    }
    
    // Start transaction
    mysqli_begin_transaction($db);
    
    try {
        // Check if user already exists by email
        $checkUserQuery = "SELECT IDKorisnici FROM korisnici WHERE KontaktKorisnika = ?";
        $stmt = mysqli_prepare($db, $checkUserQuery);
        mysqli_stmt_bind_param($stmt, "s", $emailKorisnika);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            // User exists, use existing ID
            $korisnikID = $row['IDKorisnici'];
        } else {
            // Create new user
            $insertUserQuery = "INSERT INTO korisnici (ImeKorisnika, PrezimeKorisnika, KontaktKorisnika) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($db, $insertUserQuery);
            mysqli_stmt_bind_param($stmt, "sss", $imeKorisnika, $prezimeKorisnika, $emailKorisnika);
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Greška prilikom dodavanja korisnika");
            }
            
            $korisnikID = mysqli_insert_id($db);
        }
        
        // Check if vehicle exists
        $checkVehicleQuery = "SELECT Raspolozivost FROM vozila WHERE IDVozilo = ?";
        $stmt = mysqli_prepare($db, $checkVehicleQuery);
        mysqli_stmt_bind_param($stmt, "i", $voziloID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $vehicle = mysqli_fetch_assoc($result);
        
        if (!$vehicle) {
            throw new Exception("Vozilo nije pronađeno");
        }
        
        // Only block if vehicle is permanently unavailable (manual 'Nije dostupno')
        // Check: is the vehicle marked unavailable AND has an active reservation covering today?
        // If unavailable only because of today's active reservation, we still check overlaps below.
        // If manually set to unavailable with no active reservations, block it.
        if ($vehicle['Raspolozivost'] == 'Nije dostupno') {
            $activeNowQuery = "SELECT COUNT(*) as cnt FROM rezervacije 
                               WHERE VoziloID = ? AND LOWER(StatusRezervacije) = 'aktivna'
                               AND CURDATE() BETWEEN DATE(DatumPocetka) AND DATE(DatumZavrsetka)";
            $stmt = mysqli_prepare($db, $activeNowQuery);
            mysqli_stmt_bind_param($stmt, "i", $voziloID);
            mysqli_stmt_execute($stmt);
            $activeNowResult = mysqli_stmt_get_result($stmt);
            $activeNow = mysqli_fetch_assoc($activeNowResult);
            if ($activeNow['cnt'] == 0) {
                throw new Exception("Vozilo nije dostupno za rezervaciju");
            }
        }
        
        // Check for overlapping reservations (standard interval overlap)
        $checkOverlapQuery = "SELECT COUNT(*) as count FROM rezervacije 
                             WHERE VoziloID = ? 
                             AND LOWER(StatusRezervacije) = 'aktivna'
                             AND DatumPocetka < ? AND DatumZavrsetka > ?";
        $stmt = mysqli_prepare($db, $checkOverlapQuery);
        mysqli_stmt_bind_param($stmt, "iss", $voziloID, $doKada, $odKada);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $overlap = mysqli_fetch_assoc($result);
        
        if ($overlap['count'] > 0) {
            throw new Exception("Vozilo je već rezervirano za odabrani period");
        }
        
        // Create reservation
        $datumRezervacije = date('Y-m-d H:i:s');
        $insertReservationQuery = "INSERT INTO rezervacije 
                                   (KorisnikID, VoziloID, DatumRezervacije, DatumPocetka, DatumZavrsetka, UkupnaCijena, StatusRezervacije) 
                                   VALUES (?, ?, ?, ?, ?, ?, 'Aktivna')";
        $stmt = mysqli_prepare($db, $insertReservationQuery);
        mysqli_stmt_bind_param($stmt, "iisssd", $korisnikID, $voziloID, $datumRezervacije, $odKada, $doKada, $ukupnaCijena);
        
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Greška prilikom kreiranja rezervacije");
        }
        
        // Update vehicle status
        // If reservation starts in the future → Rezervirano, if it starts now → Nije dostupno
        $newVehicleStatus = (strtotime($odKada) > time()) ? 'Rezervirano' : 'Nije dostupno';
        $updateVehicleQuery = "UPDATE vozila SET Raspolozivost = ? WHERE IDVozilo = ?";
        $stmt = mysqli_prepare($db, $updateVehicleQuery);
        mysqli_stmt_bind_param($stmt, "si", $newVehicleStatus, $voziloID);
        mysqli_stmt_execute($stmt);
        
        // Commit transaction
        mysqli_commit($db);
        
        header("Location: pregled_rezervacija.php?success=Rezervacija je uspješno kreirana!");
        exit();
        
    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($db);
        header("Location: pregled_rezervacija.php?error=" . urlencode($e->getMessage()));
        exit();
    }
    
} else {
    header("Location: pregled_rezervacija.php");
    exit();
}
?>