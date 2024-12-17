<?php
// soapserver.php

class LokasiService {
    public function getDistance($startLocation, $endLocation) {
        // Logika untuk menghitung jarak
        // Misalnya, kita hanya mengembalikan deskripsi rute dan jarak statis untuk contoh ini
        $routeDescription = "Rute dari $startLocation ke $endLocation.";
        $distance = "25 km"; // Misalnya jarak tetap

        return [
            'routeDescription' => $routeDescription,
            'distance' => $distance
        ];
    }
}

// Membuat server SOAP
$server = new SoapServer("http://localhost/finalprojek/soap/lokasi.wsdl");
$server->setClass("LokasiService");
$server->handle();
?>