@empty($penjualan)
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
                <a href="{{ url('/penjualan') }}" class="btn btn-warning btn-block">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg animate__animated animate__fadeInUp" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">
                    <i class="fas fa-shopping-cart mr-2"></i>Data Penjualan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="card mb-4 border-primary">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0 font-weight-bold">Informasi Penjualan</h6>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-hover mb-0">
                            <tr>
                                <th style="width: 30%" class="pl-3">ID</th>
                                <td class="font-weight-bold">{{ $penjualan->penjualan_id }}</td>
                            </tr>
                            <tr>
                                <th class="pl-3">Username</th>
                                <td><span class="badge badge-info">{{ $penjualan->user->username }}</span></td>
                            </tr>
                            <tr>
                                <th class="pl-3">Pembeli</th>
                                <td>{{ $penjualan->pembeli }}</td>
                            </tr>
                            <tr>
                                <th class="pl-3">Kode Penjualan</th>
                                <td><code class="bg-light px-2 py-1 rounded">{{ $penjualan->penjualan_kode }}</code></td>
                            </tr>
                            <tr>
                                <th class="pl-3">Tanggal Penjualan</th>
                                <td><i class="far fa-calendar-alt mr-1"></i> {{ $penjualan->penjualan_tanggal }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
    
                <div class="card border-success">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 font-weight-bold"><i class="fas fa-list-alt mr-2"></i>Detail Penjualan</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center">Detail ID</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th class="text-right">Harga</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $total = 0; @endphp
                                @foreach ($penjualan->penjualanDetail as $detail)
                                    @php $subtotal = $detail->harga * $detail->jumlah; $total += $subtotal; @endphp
                                    <tr>
                                        <td class="text-center">{{ $detail->detail_id }}</td>
                                        <td>{{ $detail->barang->barang_nama }}</td>
                                        <td><code>{{ $detail->barang->barang_kode }}</code></td>
                                        <td class="text-right">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                        <td class="text-center"><span class="badge badge-primary">{{ $detail->jumlah }}</span></td>
                                        <td class="text-right font-weight-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot class="bg-light">
                                <tr>
                                    <th colspan="5" class="text-right">Total:</th>
                                    <th class="text-right text-success">Rp {{ number_format($total, 0, ',', '.') }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="{{ url('penjualan') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endempty