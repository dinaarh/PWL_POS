@extends('layouts.template') 

@section('content') 
    <div class="card card-outline card-primary"> 
        <div class="card-header"> 
            <h3 class="card-title">{{ $page->title }}</h3> 
            <div class="card-tools"> 
                <button onclick="modalAction('{{ url('/user/import') }}')" class="btn btn-sm btn-info mt-1">Import User</button>
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}">Tambah</a> 
                <button onclick="modalAction('{{ url('user/create_ajax')}}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
            </div> 
        </div> 
        <div class="card-body"> 

            <!-- untuk Filter data -->
            <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-sm row text-sm mb-0">
                            <label for="filter_date" class="col-md-1 col-form-label">Filter</label>
                            <div class="col-md-3">
                                <select name="filter_level" class="form-control form-control-sm filter_level">
                                    <option value="">- Semua -</option>
                                    @foreach($level as $l)
                                    <option value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Level User</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-striped table-hover table-sm" id="table_user"> 
                <thead> 
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Level Pengguna</th>
                        <th>Aksi</th>
                    </tr> 
                </thead> 
                <tbody></tbody>
            </table> 
        </div> 
    </div> 
    <div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>
@endsection 

@push('js') 
  <script>
    function modalAction(url = '') { 
       $('#myModal').load(url, function() { 
         $('#myModal').modal('show'); 
       });
     } 
     
    var dataUser;
    $(document).ready(function() { 
        dataUser = $('#table_user').DataTable({ 
            // serverSide: true, jika ingin menggunakan server side processing 
            processing: true,
            serverSide: true,      
            ajax: { 
                "url": "{{ url('user/list') }}",
                "dataType": "json", 
                "type": "POST", 
                "data": function (d) {
                    d.filter_level = $('.filter_level').val();
                }
            }, 
            columns: [ 
                { 
                    // nomor urut dari laravel datatable addIndexColumn() 
                    data: "DT_RowIndex",             
                    className: "text-center", 
                    width: "5%",
                    orderable: false, 
                    searchable: false     
                },
                { 
                    data: "username",                
                    className: "", 
                    width: "10%",
                    // orderable: true, jika ingin kolom ini bisa diurutkan  
                    orderable: true,     
                    // searchable: true, jika ingin kolom ini bisa dicari 
                    searchable: true     
                },
                { 
                    data: "nama",                
                    className: "", 
                    width: "37%",
                    orderable: true,     
                    searchable: true      
                },
                { 
                    // mengambil data level hasil dari ORM berelasi 
                    data: "level.level_nama",                
                    className: "", 
                    width: "14%",
                    orderable: false,     
                    searchable: false     
                },
                { 
                    data: "aksi",                
                    className: "", 
                    width: "14%",
                    orderable: false,     
                    searchable: false     
                } 
            ] 
        }); 

        $('#table-user_filter input').unbind().bind().on('keyup', function(e) {
             if (e.keyCode == 13) {
                 dataUser.search(this.value).draw();
             }
        });

        $('.filter_level').change(function() {
            dataUser.draw();
        });
    }); 
  </script> 
@endpush