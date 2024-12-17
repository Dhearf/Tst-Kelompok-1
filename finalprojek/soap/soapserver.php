<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'koneksi.php';

// Ambil data dari database dan hitung jarak
function getDistance($start, $end) {
    global $conn;

    // Query lokasi
    $query = "SELECT Nama_Lokasi, Koordinat_Latitude, Koordinat_Longitude FROM informasi WHERE Nama_Lokasi IN ('$start', '$end')";
    $result = $conn->query($query);

    // Periksa apakah lokasi ditemukan
    if ($result && $result->num_rows == 2) {
        // Ambil data lokasi
        $locations = [];
        while ($row = $result->fetch_assoc()) {
            $locations[$row['Nama_Lokasi']] = [
                'latitude' => $row['Latitude'],
                'longitude' => $row['Longitude']
            ];
        }

        // Koordinat
        $latitude1 = $locations[$start]['koordinat_latitude'];
        $longitude1 = $locations[$start]['koordinat_longitude'];
        $latitude2 = $locations[$end]['koordinat_latitude'];
        $longitude2 = $locations[$end]['koordinat_longitude'];

        // Haversine formula
        $earthRadius = 6371;
        $dLat = deg2rad($latitude2 - $latitude1);
        $dLon = deg2rad($longitude2 - $longitude1);
        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) *
             sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;
        //round($distance, 2)
        return [
            'start' => $start,
            'end' => $end,
            'distance' => round(51) . ' km',
            'routeDescription' => "Mulai dari $start, melewati kota malang, tumpang dan gubukklakah , menuju $end dengan jarak sekitar " . round(51) . " km."
        ];
    }

    // Jika data lokasi tidak lengkap
    $foundLocations = [];
    while ($row = $result->fetch_assoc()) {
        $foundLocations[] = $row['Nama_Lokasi'];
    }

    $missingLocations = array_diff([$start, $end], $foundLocations);

    return [
        'error' => 'Data lokasi tidak lengkap.',
        'missingLocations' => array_values($missingLocations)
    ];
}

// Handle SOAP Request
try {
    // Pastikan WSDL file sudah benar
    $server = new SoapServer("http://localhost/finalprojek/soap/lokasi.wsdl");

    // Daftarkan fungsi
    $server->addFunction("getDistance");

    // Proses request SOAP
    $server->handle();
} catch (Exception $e) {
    // Tangani error SOAP
    error_log("SOAP Error: " . $e->getMessage());
    echo "SOAP Error: " . $e->getMessage();
}
