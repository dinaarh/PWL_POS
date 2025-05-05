<form action="{{ url('/stok/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Stok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="form-control" required>
                        <option value="">- Pilih Supplier -</option>
                        @foreach ($supplier as $l)
                            <option value="{{ $l->supplier_id }}">{{ $l->supplier_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-supplier_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Barang</label>
                    <select name="barang_id" id="barang_id" class="form-control" required>
                        <option value="">- Pilih Barang -</option>
                        @foreach ($barang as $l)
                            <option value="{{ $l->barang_id }}">{{ $l->barang_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-barang_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>User Pengguna</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->username }}" readonly>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                    <small id="error-user_id" class="error-text form-text text-danger"></small>
                </div>                
                <div class="form-group">
                    <label>Tanggal Stok</label>
                    <input type="datetime-local" name="stok_tanggal" id="stok_tanggal" class="form-control" readonly required>
                    <small id="error-stok_tanggal" class="error-text form-text text-danger"></small>
                </div>              
                <div class="form-group">
                    <label>Jumlah Stok</label>
                    <input value="" type="text" pattern="\d*" name="stok_jumlah" id="stok_jumlah" class="form-control" required>
                    <small id="error-stok_jumlah" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        // Set tanggal stok otomatis ke sekarang
        // const now = new Date();
        // const localDatetime = now.toISOString().slice(0,16);
        // $('#stok_tanggal').val(localDatetime);
        // Deklarasikan variabel interval di scope yang lebih luas
        let dateTimeInterval;
        
        function updateDateTimeField() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            
            // Format tanggal sesuai format datetime-local: YYYY-MM-DDTHH:MM
            const localDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;
            $('#stok_tanggal').val(localDatetime);
        }
        
        // Set initial datetime
        updateDateTimeField();
        
        // Mulai interval untuk update real-time
        dateTimeInterval = setInterval(updateDateTimeField, 1000);
        
        // Pastikan interval dihentikan saat modal ditutup (perbaikan ID modal)
        $('.modal').on('hidden.bs.modal', function() {
            if (dateTimeInterval) {
                clearInterval(dateTimeInterval);
            }
        });
        
        // Untuk mode edit
        $(document).on('editMode', function() {
            $('#modal-master').addClass('edit-mode');
            $('#stok_tanggal').prop('readonly', false);
            
            // Hentikan interval update waktu saat mode edit
            if (dateTimeInterval) {
                clearInterval(dateTimeInterval);
            }
        });
        
        // Untuk mode tambah
        $(document).on('addMode', function() {
            $('#modal-master').removeClass('edit-mode');
            $('#stok_tanggal').prop('readonly', true);
            updateDateTimeField();
            
            // Mulai interval baru jika mode tambah
            if (dateTimeInterval) {
                clearInterval(dateTimeInterval);
            }
            dateTimeInterval = setInterval(updateDateTimeField, 1000);
        });

        $("#form-tambah").validate({
            rules: {
                supplier_id: { required: true, number: true },
                barang_id: { required: true, number: true },
                user_id: { required: true, number: true },
                stok_tanggal: { required: true, minlength: 3, maxlength: 20 },
                stok_jumlah: { required: true, maxlength: 8 },
            },
            submitHandler: function(form) {
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
                            dataStok.ajax.reload();
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
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>