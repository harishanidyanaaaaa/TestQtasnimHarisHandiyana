<!DOCTYPE html>
<html lang="en">
<head>
 
    <title>Transaksi - Index</title>
    
    <link rel="stylesheet" href="{{ url('') }}/dist/assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="{{ url('') }}/dist/assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="{{ url('') }}/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{ url('') }}/dist/assets/css/app.css">
   
</head>
<body>
    <div id="app">
        @include('Layout.side')


        <div id="main">
           @include('Layout.head')
            
<div class="main-content container-fluid">
    
    <section class="section">
        
        <div class="row mb-4">
            <div class="col-md-12">
       
                
<div
    class="table-responsive"
>
<form action="{{ route('Transaksi-Index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari" name="search" value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
</form>
    <table
        class="table table-striped table-hover table-borderless align-middle"
    > @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                  
              @endif
        <thead class="table-light">
            <caption>
                Data Transaksi
            </caption>
            <!-- Button trigger modal -->
            <button
                type="button"
                class="btn btn-primary btn-md"
                data-bs-toggle="modal"
                data-bs-target="#modalId"
            >
                Tambah Data
            </button>
            
            <!-- Modal -->
            <div
                class="modal fade"
                id="modalId"
                tabindex="-1"
                role="dialog"
                aria-labelledby="modalTitleId"
                aria-hidden="true"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Tambah Data
                            </h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <form action="{{ route('Transaksi-Store') }}" role="form" method="POST">
                           @csrf
<div class="modal-body">
                          

             <div class="form-group mb-3">
                                    <select class="form-control selectpicker" name="nama_barang" onchange="updateFields(this)">
        @foreach ($barang as $b)
            <option value="{{ $b->nama_barang }}" data-stok="{{ $b->stok }}" data-jenis="{{ $b->jenis_barang }}">{{ $b->nama_barang }}</option>
        @endforeach
    </select>
                                </div>
                                 <div class="form-group mb-3">
                                  
                                    <input type="number" class="form-control"  placeholder="stok" name="stok" readonly>
                                </div>
                                <div class="form-group mb-3">

                                  <input type="number" class="form-control" id="inputData" placeholder="Jumlah Terjual" name="jumlah_terjual">
                                </div>
                               
                                 <div class="form-group mb-3">
                                  
                                    <input type="date" class="form-control" id="inputData" placeholder="stok" name="tanggal_transaksi">
                                </div>
                                 <div class="form-group mb-3">
                                   <input type="text" class="form-control"  placeholder="jenis barang" name="jenis_barang" readonly>
                                    
                                </div>
                                <div class="modal-footer">
        
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        
                            
                        </div>
                        </form>
                        
                        
                    </div>
                </div>
            </div>
            
            <script>
                var modalId = document.getElementById('modalId');
            
                modalId.addEventListener('show.bs.modal', function (event) {
                      // Button that triggered the modal
                      let button = event.relatedTarget;
                      // Extract info from data-bs-* attributes
                      let recipient = button.getAttribute('data-bs-whatever');
            
                    // Use above variables to manipulate the DOM
                });
            </script>
            
            <tr>
                <th>No</th>
             <th>
                <a href="{{ route('Transaksi-Index', ['sort' => 'nama_barang']) }}">Nama Barang</a>
            </th>
                <th>Stok</th>
                <th>Jumlah Transaksi</th>
                <th>
                <a href="{{ route('Transaksi-Index', ['sort' => 'tanggal_transaksi']) }}">Tanggal Transaksi</a>
            </th>
                <th>Jenis Barang</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody class="table-group-divider">
 
  
  <!-- Optional: Place to the bottom of scripts -->
  <script>
    const myModal = new bootstrap.Modal(
        document.getElementById("modalId"),
        options,
    );
  </script>
  
            @foreach ($transaksi as $t )
                <tr  class="table-primary">
                       <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->nama_barang }}</td>
                    <td>{{ $t->stok }}</td>
                    <td>{{ $t->jumlah_terjual }}</td>
                    <td>{{ $t->tanggal_transaksi }}</td>
                    <td>{{ $t->jenis_barang }}</td>
                    <td>
                      
     <a href="{{ route('Transaksi-Delete', $t->id) }}"class="btn btn-danger delete-btn"
       onclick="event.preventDefault();
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    document.getElementById('delete-form-{{$t->id}}').submit();
                }">
        Hapus
    </a>
  <button type="button" class="btn btn-info" 
        data-bs-toggle="modal" 
        data-bs-target="#updateModal" 
        data-id="{{ $t->id }}"
        data-namabarang="{{ $t->nama_barang }}"
        data-stok="{{ $t->stok }}"
        data-jumlahterjual="{{ $t->jumlah_terjual }}"
        data-tanggaltransaksi="{{ $t->tanggal_transaksi }}"
        data-jenisbarang="{{ $t->jenis_barang }}">
        Update
    </button>
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Data Transaksi</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form untuk update data -->
            <form id="updateForm" action="{{ route('Transaksi-Update', $t->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="updateNamaBarang">Nama Barang</label>
                        <input type="text" class="form-control" id="updateNamaBarang" name="nama_barang" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="updateStok">Stok</label>
                        <input type="number" class="form-control" id="updateStok" name="stok" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="updateJumlahTerjual">Jumlah Terjual</label>
                        <input type="number" class="form-control" id="updateJumlahTerjual" name="jumlah_terjual">
                    </div>
                    <div class="form-group mb-3">
                        <label for="updateTanggalTransaksi">Tanggal Transaksi</label>
                        <input type="date" class="form-control" id="updateTanggalTransaksi" name="tanggal_transaksi">
                    </div>
                    <div class="form-group mb-3">
                        <label for="updateJenisBarang">Jenis Barang</label>
                        <input type="text" class="form-control" id="updateJenisBarang" name="jenis_barang" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var updateModal = document.getElementById('updateModal');
        updateModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;

            var id = button.getAttribute('data-id');
            var namaBarang = button.getAttribute('data-namabarang');
            var stok = button.getAttribute('data-stok');
            var jumlahTerjual = button.getAttribute('data-jumlahterjual');
            var tanggalTransaksi = button.getAttribute('data-tanggaltransaksi');
            var jenisBarang = button.getAttribute('data-jenisbarang');
            

            var modalForm = updateModal.querySelector('#updateForm');
            modalForm.action = '/transaksi/' + id; 
            
            var inputNamaBarang = updateModal.querySelector('#updateNamaBarang');
            var inputStok = updateModal.querySelector('#updateStok');
            var inputJumlahTerjual = updateModal.querySelector('#updateJumlahTerjual');
            var inputTanggalTransaksi = updateModal.querySelector('#updateTanggalTransaksi');
            var inputJenisBarang = updateModal.querySelector('#updateJenisBarang');
            
            inputNamaBarang.value = namaBarang;
            inputStok.value = stok;
            inputJumlahTerjual.value = jumlahTerjual;
            inputTanggalTransaksi.value = tanggalTransaksi;
            inputJenisBarang.value = jenisBarang;
        });
    });
</script>
    <form id="delete-form-{{$t->id}}" action="{{ route('Transaksi-Delete', $t->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
                    </td>
                </tr>

                @endforeach
                
          
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
</div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    function updateFields(select) {
        var selectedOption = select.options[select.selectedIndex];
        var stokInput = document.querySelector('input[name="stok"]');
        var jenisInput = document.querySelector('input[name="jenis_barang"]');
        
        stokInput.value = selectedOption.getAttribute('data-stok');
        jenisInput.value = selectedOption.getAttribute('data-jenis');
    }
</script>
            </div>
            <div class="col-md-4">
                
               
            </div>
        </div>
    </section>
</div>

         @include('Layout.footer')
        </div>
    </div>
    <script src="{{ url('') }}/dist/assets/js/feather-icons/feather.min.js"></script>
    <script src="{{ url('') }}/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ url('') }}/dist/assets/js/app.js"></script>
    
    <script src="{{ url('') }}/dist/assets/vendors/chartjs/Chart.min.js"></script>
    <script src="{{ url('') }}/dist/assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="{{ url('') }}/dist/assets/js/pages/dashboard.js"></script>

    <script src="{{ url('') }}/dist/assets/js/main.js"></script>
</body>
</html>
