document.addEventListener('DOMContentLoaded', function () {
    fetch('read.php')
        .then(response => response.json())
        .then(data => {
            console.log(data); // Debug: Cek data yang diterima dari read.php
            if (data.length > 0) {
                // Inisialisasi peta
                var mymap = L.map('mapid').setView([data[0]['Koordinat_Latitude'], data[0]['Koordinat_Longitude']], 13);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(mymap);
                
                // Ambil parameter pencarian dari URL
                const urlParams = new URLSearchParams(window.location.search);
                const searchQuery = urlParams.get('search');
                
                let wisataData = []; // Variabel untuk menyimpan lokasi wisata
                
                // Iterasi data dari read.php
                for (var i = 0; i < data.length; i++) {
                    // Filter jika kata kunci 'wisata' ada di parameter pencarian
                    if (searchQuery && searchQuery.toLowerCase() === 'wisata') {
                        if (data[i]['Kategori'] && data[i]['Kategori'].toLowerCase() === 'wisata') {
                            wisataData.push(data[i]); // Simpan lokasi wisata
                        }
                    } else {
                        // Tampilkan semua data jika tidak ada filter
                        addMarker(mymap, data[i]);
                    }
                }
                
                // Tampilkan hanya data wisata jika ada keyword 'wisata'
                if (searchQuery && searchQuery.toLowerCase() === 'wisata' && wisataData.length > 0) {
                    wisataData.forEach(item => addMarker(mymap, item));
                    
                    // Tambahkan daftar wisata di bawah peta
                    displayWisataList(wisataData);
                } else if (searchQuery && searchQuery.toLowerCase() === 'wisata') {
                    alert('Tidak ada lokasi wisata yang ditemukan.');
                }
            }
        })
        .catch(error => console.error('Error fetching data:', error));
    
    // Fungsi untuk menambahkan marker ke peta
    function addMarker(map, locationData) {
        var marker = L.marker([locationData['Koordinat_Latitude'], locationData['Koordinat_Longitude']]).addTo(map);
        marker.bindPopup(
            "<b>Latitude:</b> " + locationData['Koordinat_Latitude'] +
            "<br><b>Longitude:</b> " + locationData['Koordinat_Longitude'] +
            "<br><b>Nama Lokasi:</b> " + locationData['Nama_Lokasi'] +
            "<br><b>Deskripsi:</b> " + locationData['Deskripsi_Lokasi'] +
            "<br><b>Rating:</b> " + locationData['Rating'] +
            "<br><b>Kategori:</b> " + locationData['Kategori'] +
            "<br><b>Waktu Buka:</b> " + locationData['Waktu_Buka'] +
            "<br><b>Kontak:</b> " + locationData['Kontak_Lokasi'] +
            "<br><b>Status:</b> " + locationData['status']
        );
    }
});