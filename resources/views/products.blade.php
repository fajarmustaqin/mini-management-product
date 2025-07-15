<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Produk - Beeru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="p-5">

    <div class="container">
        <h2 class="mb-4">Manajemen Produk</h2>

        <!-- Form Tambah Produk -->
        <form id="productForm" class="mb-4">
            <input type="hidden" id="product_id">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="nama_produk" placeholder="Nama Produk" required>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="sku" placeholder="SKU" required>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" id="harga" placeholder="Harga" required>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" id="stok" placeholder="Stok" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success w-100" id="submitBtn">Simpan Produk</button>
                </div>
            </div>
        </form>

        <!-- Tabel Produk -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
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

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    const API_URL = "/api/products";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // Ambil Data Produk
    function fetchProducts() {
        $.get(API_URL, function(data) {
            let rows = '';
            data.forEach(item => {
                rows += `
                    <tr>
                        <td>${item.nama_produk}</td>
                        <td>${item.sku}</td>
                        <td>${item.harga}</td>
                        <td>${item.stok}</td>
                        <td>
                            <button class="btn btn-warning btn-sm me-2" onclick="editProduct(${item.id})">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteProduct(${item.id})">Hapus</button>
                        </td>
                    </tr>
                `;
            });
            $('#productTable').html(rows);
        });
    }

    // Tambah atau Update Produk
    $('#productForm').submit(function(e) {
        e.preventDefault();
        const id = $('#product_id').val();
        const method = id ? 'PUT' : 'POST';
        const url = id ? `${API_URL}/${id}` : API_URL;

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
                $('#productForm')[0].reset();
                $('#product_id').val('');
                $('#submitBtn').text('Simpan Produk');
                fetchProducts();
            },
            error: function(xhr) {
                alert('Gagal: ' + JSON.stringify(xhr.responseJSON.errors));
            }

        });
    });

    // Edit Produk
    function editProduct(id) {
        $.get(`${API_URL}`, function(data) {
            const produk = data.find(p => p.id === id);
            $('#product_id').val(produk.id);
            $('#nama_produk').val(produk.nama_produk);
            $('#sku').val(produk.sku);
            $('#harga').val(produk.harga);
            $('#stok').val(produk.stok);
            $('#submitBtn').text('Update Produk');
        });
    }

    // Hapus Produk
    function deleteProduct(id) {
        if (confirm('Yakin mau hapus produk ini?')) {
            $.ajax({
                url: `${API_URL}/${id}`,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: fetchProducts
            });
        }
    }

    // Load awal
    $(document).ready(fetchProducts);
</script>

</body>
</html>
