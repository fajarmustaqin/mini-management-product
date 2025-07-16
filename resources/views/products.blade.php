<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mini Manajemen Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --beeru: #74b0f8;
        }

        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar {
            background-color: var(--beeru);
        }

        .navbar-brand, .nav-link, .navbar-text {
            color: #fff !important;
            font-weight: bold;
        }

        .btn-primary {
            background-color: var(--beeru);
            border-color: var(--beeru);
        }

        .btn-primary:hover {
            background-color: #5d99e6;
            border-color: #5d99e6;
        }

        .table thead {
            background-color: var(--beeru);
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Mini Manajemen Produk</a>
            <span class="navbar-text ms-auto">by Fajar Mustaqin</span>
        </div>
    </nav>

    <!-- Konten -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Kelola Produk</h2>
            <button class="btn btn-primary" onclick="openModal()">Tambah Produk</button>
        </div>

        <!-- Tabel Produk -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>SKU</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    <!-- Data akan diisi lewat JS -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="productForm" class="modal-content">
                <input type="hidden" id="product_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" required>
                    </div>
                    <div class="mb-2">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="sku" required>
                    </div>
                    <div class="mb-2">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="harga" required>
                    </div>
                    <div class="mb-2">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.6.0/dist/autoNumeric.min.js"></script>
    <script>
        const API_URL = "/api/products";
        const modal = new bootstrap.Modal(document.getElementById('productModal'));

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Terapkan format Rupiah
        const hargaAuto = new AutoNumeric('#harga', {
            digitGroupSeparator: '.',
            decimalCharacter: ',',
            decimalPlaces: 0,
            currencySymbol: '',
            unformatOnSubmit: true
        });


        function showNotification(message, status = 'success') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: status,
                title: message,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#fff',
                color: '#000'
            });
        }



        function fetchProducts() {
            $.get(API_URL, function(res) {
                let rows = '';
                let no = 1;
                res.data.forEach(item => {
                    rows += `
                        <tr>
                            <td>${no++}</td>
                            <td>${item.nama_produk}</td>
                            <td>${item.sku}</td>
                            <td>${parseInt(item.harga).toLocaleString('id-ID')}</td>
                            <td>${item.stok}</td>
                            <td>
                                <button class="btn btn-warning btn-sm me-2 tx" onclick="editProduct(${item.id})"><span class="material-icons text-white"S>edit</span></button>
                                <button class="btn btn-danger btn-sm" onclick="deleteProduct(${item.id})"><span class="material-icons">delete</span></button>
                            </td>
                        </tr>
                    `;
                });
                $('#productTable').html(rows);
            });
        }

        function openModal() {
            $('#productForm')[0].reset();
            $('#product_id').val('');
            $('#productModalLabel').text('Tambah Produk');
            $('#submitBtn').text('Simpan Produk');
            modal.show();
        }

        $('#productForm').submit(function(e) {
            e.preventDefault();
            const id = $('#product_id').val();
            const method = id ? 'PUT' : 'POST';
            const url = id ? `${API_URL}/${id}` : API_URL;
            const message = method === 'POST' ? 'Produk berhasil ditambahkan!' : 'Produk berhasil diperbarui!';

            $.ajax({
                url: url,
                type: method,
                data: {
                    nama_produk: $('#nama_produk').val(),
                    sku: $('#sku').val(),
                    harga: $('#harga').val(),
                    stok: $('#stok').val(),
                    _method: method,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    modal.hide();
                    fetchProducts();
                    showNotification(message);
                },
                error: function(xhr) {
                    showNotification('Gagal ' + JSON.stringify(xhr.responseJSON.errors) ,'error');
                }
            });
        });

        function editProduct(id) {
            $.get(`${API_URL}`, function(res) {
                const produk = res.data.find(p => p.id === id);
                $('#product_id').val(produk.id);
                $('#nama_produk').val(produk.nama_produk);
                $('#sku').val(produk.sku);
                $('#harga').val(produk.harga);
                $('#stok').val(produk.stok);
                $('#productModalLabel').text('Edit Produk');
                $('#submitBtn').text('Update Produk');
                modal.show();
            });
        }

        function deleteProduct(id) {
            Swal.fire({
                title: 'Yakin mau hapus?',
                text: "Data produk akan hilang permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#74b0f8', // Warna Beeru
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${API_URL}/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function () {
                            fetchProducts();

                            showNotification('produk berhasil dihapus!');
                        }
                    });
                }
            });
        }


        $(document).ready(fetchProducts);
    </script>

</body>
</html>
x