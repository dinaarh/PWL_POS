@empty($barang)
    <div id="modal-master" class="modal-dialog modal-lg animate__animated animate__fadeIn" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Kesalahan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-danger border-left border-danger" style="border-left-width: 5px !important;">
                    <h5><i class="icon fas fa-ban mr-2"></i> Kesalahan!!!</h5>
                    <p class="mb-0">Data yang anda cari tidak ditemukan</p>
                </div>
                <a href="{{ url('/barang') }}" class="btn btn-warning btn-block">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/penjualan/'.$penjualan->penjualan_id . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg animate__animated animate__fadeInUp" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">
                        <i class="fas fa-edit mr-2"></i>Edit Data Penjualan
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="card border-primary mb-4">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0 font-weight-bold"><i class="fas fa-info-circle mr-2"></i>Informasi Utama</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user_id"><i class="fas fa-user mr-1"></i>Username</label>
                                <select name="user_id" id="user_id" class="form-control custom-select" required>
                                    <option value="">- Pilih Username -</option>
                                    @foreach ($user as $k)
                                        <option value="{{ $k->user_id }}" {{ $penjualan->user_id == $k->user_id ? 'selected' : '' }}>{{ $k->username }}</option>
                                    @endforeach
                                </select>
                                <small id="error-user_id" class="error-text form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="pembeli"><i class="fas fa-user-tag mr-1"></i>Pembeli</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                    </div>
                                    <input value="{{ $penjualan->pembeli }}" type="text" name="pembeli" id="pembeli" class="form-control" placeholder="Nama pembeli" required>
                                </div>
                                <small id="error-pembeli" class="error-text form-text text-danger"></small>
                            </div>
                            <div class="form-group mb-0">
                                <label for="penjualan_tanggal"><i class="fas fa-calendar-alt mr-1"></i>Tanggal Penjualan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input value="{{ date('Y-m-d\TH:i', strtotime($penjualan->penjualan_tanggal)) }}" type="datetime-local" name="penjualan_tanggal" id="penjualan_tanggal" class="form-control" required>
                                </div>
                                <small id="error-penjualan_tanggal" class="error-text form-text text-danger"></small>
                            </div>
                        </div>
                    </div>
 
                    <div class="card border-success">
                        <div class="card-header bg-success text-white">
                            <h6 class="mb-0 font-weight-bold"><i class="fas fa-shopping-basket mr-2"></i>Detail Penjualan</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <button type="button" class="btn btn-success btn-md" id="btn-add-item">
                                    <i class="fa fa-plus-circle mr-1"></i> Tambah Barang
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="detail-table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th><i class="fas fa-box mr-1"></i>Barang</th>
                                        <th width="150" class="text-right"><i class="fas fa-tag mr-1"></i>Harga (Rp)</th>
                                        <th width="100" class="text-center"><i class="fas fa-sort-numeric-up mr-1"></i>Jumlah</th>
                                        <th width="150" class="text-right"><i class="fas fa-calculator mr-1"></i>Subtotal (Rp)</th>
                                        <th width="50" class="text-center"><i class="fas fa-cogs mr-1"></i>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody id="detail-items">
                                    @foreach($penjualan->penjualanDetail as $detail)
                                        <tr class="detail-row">
                                            <td>
                                                <select name="barang_id[]" class="form-control barang-select" required>
                                                    <option value="">- Pilih Barang -</option>
                                                    @foreach ($barang as $b)
                                                        <option value="{{ $b->barang_id }}"
                                                                data-harga="{{ $b->harga_jual }}"
                                                            {{ $detail->barang_id == $b->barang_id ? 'selected' : '' }}>
                                                            {{ $b->barang_nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <small class="error-text form-text text-danger"></small>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="number" name="harga[]" class="form-control harga-input text-right" value="{{ $detail->harga }}" readonly>
                                                </div>
                                                <small class="error-text form-text text-danger"></small>
                                            </td>
                                            <td>
                                                <input type="number" name="jumlah[]" class="form-control jumlah-input text-center" min="1" value="{{ $detail->jumlah }}" required>
                                                <small class="error-text form-text text-danger"></small>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control subtotal-display text-right" value="{{ number_format($detail->harga * $detail->jumlah, 0, ',', '.') }}" readonly>
                                                    <input type="hidden" class="subtotal-input" value="{{ $detail->harga * $detail->jumlah }}">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger btn-sm btn-remove-item">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot class="bg-light">
                                    <tr>
                                        <th colspan="3" class="text-right">Total:</th>
                                        <th id="total-amount" class="text-right text-success font-weight-bold">0</th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">
                        <i class="fas fa-times mr-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i>Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
 
    <!-- Template detail item row  -->
    <template id="detail-row-template">
        <tr class="detail-row">
            <td>
                <select name="barang_id[]" class="form-control barang-select" required>
                    <option value="">- Pilih Barang -</option>
                    @foreach ($barang as $b)
                        <option value="{{ $b->barang_id }}" data-harga="{{ $b->harga_jual }}">{{ $b->barang_nama }}</option>
                    @endforeach
                </select>
                <small class="error-text form-text text-danger"></small>
            </td>
            <td>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" name="harga[]" class="form-control harga-input text-right" readonly>
                </div>
                <small class="error-text form-text text-danger"></small>
            </td>
            <td>
                <input type="number" name="jumlah[]" class="form-control jumlah-input text-center" min="1" value="1" required>
                <small class="error-text form-text text-danger"></small>
            </td>
            <td>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control subtotal-display text-right" readonly>
                    <input type="hidden" class="subtotal-input">
                </div>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm btn-remove-item">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    </template>
 
    <script>
        $(document).ready(function() {
 
            // Calculate init total
            calculateTotal();
 
            // Add new detail row
            $("#btn-add-item").click(function() {
                addDetailRow();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Baris baru ditambahkan',
                    showConfirmButton: false,
                    timer: 1000,
                    toast: true
                });
            });
 
            // Remove detail row
            $(document).on('click', '.btn-remove-item', function() {
                if ($('.detail-row').length > 1) {
                    $(this).closest('tr').remove();
                    calculateTotal();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'info',
                        title: 'Item dihapus',
                        showConfirmButton: false,
                        timer: 1000,
                        toast: true
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tidak dapat dihapus',
                        text: 'Minimal harus ada satu barang'
                    });
                }
            });
 
            // When barang is selected, set the price
            $(document).on('change', '.barang-select', function() {
                var row = $(this).closest('tr');
                var harga = $(this).find(':selected').data('harga') || 0;
                row.find('.harga-input').val(harga);
                updateRowTotal(row);
            });
 
            // When quantity changes, update subtotal
            $(document).on('input', '.jumlah-input', function() {
                updateRowTotal($(this).closest('tr'));
            });
 
            $("#form-edit").validate({
                rules: {
                    pembeli: { required: true, maxlength: 200 },
                    penjualan_tanggal: { required: true },
                    user_id: { required: true },
                    "barang_id[]": { required: true },
                    "jumlah[]": { required: true, min: 1 }
                },
                errorClass: "error-message",
                errorElement: "div",
                highlight: function(element) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                },
                submitHandler: function(form) {
                    // Check if at least one item exists
                    if ($('.detail-row').length === 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal',
                            text: 'Minimal harus ada satu barang'
                        });
                        return false;
                    }
 
                    // Show loading indicator
                    Swal.fire({
                        title: 'Menyimpan data...',
                        html: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
 
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                tablePenjualan.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: 'Tidak dapat menyimpan data'
                            });
                        }
                    });
                    return false;
                }
            });
 
            // Function to add a new detail row
            function addDetailRow() {
                var template = document.getElementById('detail-row-template');
                var clone = document.importNode(template.content, true);
                $('#detail-items').append(clone);
 
                // Initialize the new row (set price and subtotal)
                var newRow = $('#detail-items tr:last');
                updateRowTotal(newRow);
                
                // Apply fade-in animation to new row
                newRow.hide().addClass('animate__animated animate__fadeIn').fadeIn();
            }
 
            // Function to update a row's subtotal
            function updateRowTotal(row) {
                var harga = parseFloat(row.find('.harga-input').val()) || 0;
                var jumlah = parseInt(row.find('.jumlah-input').val()) || 0;
                var subtotal = harga * jumlah;
 
                row.find('.subtotal-input').val(subtotal);
                row.find('.subtotal-display').val(formatRupiah(subtotal));
 
                calculateTotal();
            }
 
            // Function to calculate the total amount
            function calculateTotal() {
                var total = 0;
                $('.subtotal-input').each(function() {
                    total += parseFloat($(this).val()) || 0;
                });
 
                // Animate total update
                $('#total-amount').fadeOut(100, function() {
                    $(this).text('Rp ' + formatRupiah(total)).fadeIn(100);
                });
            }
 
            // Function to format number as Rupiah
            function formatRupiah(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }
 
        });
 
    </script>
@endempty