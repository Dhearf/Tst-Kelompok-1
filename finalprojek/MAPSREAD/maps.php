<!DOCTYPE html>
<html>
<head>
    <title>POI Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body> 
<div class="container mt-4">
    <div class="input-group mb-3">
        <form id="searchForm" class="d-flex w-100">
            <input type="text" required name="search" class="form-control" placeholder="Cari lokasi atau POI..." aria-label="Cari lokasi atau POI" aria-describedby="button-addon2" id="messageInput">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" id="poiSearchButton">Cari</button>
            </div>
        </form>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div id="mapid" style="height: 600px;"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2>Data Lokasi</h2>
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Rating</th>
                        <th>Waktu Buka</th>
                        <th>Kontak</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data akan dimuat melalui AJAX -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#searchForm').on('submit', function(e) {
        e.preventDefault(); 
        let searchQuery = $('#messageInput').val();

        $.getJSON('read.php', { search: searchQuery }, function(data) {
            let tableBody = '';
            if (data.length > 0) {
                data.forEach(item => {
                    tableBody += `<tr>
                        <td>${item.id}</td>
                        <td>${item.Nama_Lokasi}</td>
                        <td>${item.Deskripsi_Lokasi}</td>
                        <td>${item.Kategori}</td>
                        <td>${item.Rating}</td>
                        <td>${item.Waktu_Buka}</td>
                        <td>${item.Kontak_Lokasi}</td>
                    </tr>`;
                });
            } else {
                tableBody = `<tr><td colspan="7" class="text-center">Tidak ada data ditemukan.</td></tr>`;
            }
            $('#dataTable tbody').html(tableBody); // Tampilkan data di tabel
        }).fail(function() {
            $('#dataTable tbody').html('<tr><td colspan="7" class="text-center">Gagal mengambil data dari server.</td></tr>');
        });
    });
});
</script>
    <script src="script.js"></script>
</body>
</html>
