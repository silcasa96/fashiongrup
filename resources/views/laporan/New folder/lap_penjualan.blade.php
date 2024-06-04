@extends('layouts.template')

@section('title', 'Laporan Penjualan | Ethica')
@section('content')
<div class="card">
    @include('flash-message')
    <div class="card-header">
        <h1 class="card-title" style="float: left; font-size: 20pt">Laporan Penjualan</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
    </div>
    <form id="penjualan" class="form-horizontal" method="get" action="{!! route('cari_penjualan') !!}">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Customer</label>
                        <select class="select2bs4" data-placeholder="Pilih Customer" data-dropdown-css-class="select2-purple" style="width: 100%;" id="customer" name="customer">
                            <option value="">Pilih Customer</option>
                            <?php
                            foreach ($customer as $customer) {
                                if ($customer->seq == $idcus) {
                                    echo '<option selected="selected" value="' . $customer->seq . '">' . $customer->kode . ' - ' . $customer->nama . '</option>';
                                } else {
                                    echo '<option value="' . $customer->seq . '">' . $customer->kode . ' - ' . $customer->nama . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Brand</label>
                        <div class="select2-purple">
                            <select class="select2" multiple="multiple" data-placeholder="Pilih Brand" data-dropdown-css-class="select2-purple" style="width: 100%;" id="brand" name="brand">
                                <?php
                                foreach ($brand as $brand) {
                                    if ($brand->seq == $idbrand) {
                                        echo '<option selected="selected" value="' . $brand->seq . '">' . $brand->kode . ' - ' . $brand->nama . '</option>';
                                    } else {
                                        echo '<option value="' . $brand->seq . '">' . $brand->kode . ' - ' . $brand->nama . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Gudang</label>
                        <div class="select2-purple">
                            <select class="select2" multiple="multiple" data-placeholder="Pilih Gudang" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                <?php
                                foreach ($gudang as $gudang) {
                                    if ($gudang->seq == $idgudang) {
                                        echo '<option selected="selected" value="' . $gudang->seq . '">' . $gudang->kode . ' - ' . $gudang->nama . '</option>';
                                    } else {
                                        echo '<option value="' . $gudang->seq . '">' . $gudang->kode . ' - ' . $gudang->nama . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tipe Penjualan</label>
                        <div class="select2-purple">
                            <select class="select2bs4" multiple="multiple" data-placeholder="Pilih Tipe Penjualan" data-dropdown-css-class="select2-purple" style="width: 100%;" id="tipepenjualan" name="tipepenjualan">
                                <option value="">Pilih Tipe Penjualan</option>
                                <option value="0">Semua</option>
                                <option value="1">Offline</option>
                                <option value="2">Online</option>
                                <option value="3">Bazar</option>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </div>
                <!-- /.row -->
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Admin</label>
                        <select class="select2bs4" data-placeholder="Pilih Admin" data-dropdown-css-class="select2-purple" style="width: 100%;" id="admin" name="admin">
                            <option value="">Pilih Admin</option>
                            <?php
                            foreach ($admin as $admin) {
                                if ($admin->seq == $idadmin) {
                                    echo '<option selected="selected" value="' . $admin->seq . '">' . $admin->kode . ' - ' . $admin->nama . '</option>';
                                } else {
                                    echo '<option value="' . $admin->seq . '">' . $admin->kode . ' - ' . $admin->nama . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Sales</label>
                        <select class="select2bs4" data-placeholder="Pilih Sales" data-dropdown-css-class="select2-purple" style="width: 100%;" id="sales" name="sales">
                            <option value="">Pilih Sales</option>
                            <?php
                            foreach ($sales as $sales) {
                                if ($sales->seq == $idsales) {
                                    echo '<option selected="selected" value="' . $sales->seq . '">' . $sales->kode . ' - ' . $sales->nama . '</option>';
                                } else {
                                    echo '<option value="' . $sales->seq . '">' . $sales->kode . ' - ' . $sales->nama . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Type Produk</label>
                        <div class="select2-purple">
                            <select class="select2bs4" data-placeholder="Tipe Produk" data-dropdown-css-class="select2-purple" style="width: 100%;" id="tipeproduk" name="tipeproduk">
                                <option value="">Pilih Tipe Produk</option>
                                <?php
                                foreach ($tipeproduk as $tipeproduk) {
                                    if ($tipeproduk->type_produk == $idtipeproduk) {
                                        echo '<option selected="selected" value="' . $tipeproduk->type_produk . '">' . $tipeproduk->type_produk . '</option>';
                                    } else {
                                        echo '<option value="' . $tipeproduk->type_produk . '">' . $tipeproduk->type_produk . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="col-md-2">
                    <!-- Date and time -->

                    <div class="form-group">
                        <label>Tanggal Awal</label>
                        <div class="input-group">
                            <input type="date" class="form-control tglawal input-group-sm" id="tglawal" name="tglawal" placeholder="Tanggal Awal" required value="{!! $tglawal !!}">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <div class="input-group">
                            <input type="date" class="form-control tglakhir input-group-sm" id="tglakhir" name="tglakhir" placeholder="Tanggal Akhir" required value="{!! $tglakhir !!}">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>

            <div class="row">

            </div>

            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{!! route('lap_penjualan') !!}" class="btn btn-danger btn-sm"><span class="fa fa-times"></span> Reset</a>
                <button type="submit" name="Cari" class="btn btn-primary btn-sm" value="Cari"><span class="fa fa-search"></span> Cari
                </button>
                <button type="submit" name="Cari" class="btn btn-success btn-sm" value="Excel"><span class="fa fa-file-excel"></span> Excel
                </button>
            </div>
  </form>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                                <h3 class="card-title">Laporan Penjualan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table id="exam" class="table table-hover text-nowrap" style="font-size: x-small">
                                    <thead>
                                        <tr>
                                            <th class="bg-gradient-gray">No.</th>
                                            <th class="bg-gradient-gray">Customer</th>
                                            <th>Tanggal</th>
                                            <th>No. Transaksi</th>
                                            <th>No. SO</th>
                                            <th>Brand</th>
                                            <th>Kode</th>
                                            <th>Nama Artikel</th>
                                            <th>Jenis</th>
                                            <th>Admin</th>
                                            <th>Sales</th>
                                            <th>Jumlah</th>
                                            <th>Sub Total</th>
                                            <th>Diskon</th>
                                            <th>Diskon Global</th>
                                            <th>Total</th>
                                            <th>Ongkir</th>
                                            <th>Keterangan</th>
                                            <th>Alamat Kirim</th>
                                            <th>User Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        $subtotal = 0;
                                        $diskon = 0;
                                        $diskon_global = 0;
                                        $total = 0;
                                        $qty = 0;
                                        $tongkir = 0;
                                        $ongkir = 0;
                                        $nomor = '';
                                        ?>
                                        @if(!empty($penjualan))
                                        @foreach($penjualan as $penjualans)
                                        <?php $no++; ?>
                                        <tr>
                                            <td class="bg-gradient-gray">{!! $no !!}</td>
                                            <td class="bg-gradient-gray">{!! $penjualans->nmcustomer !!}</td>
                                            <td>{!! $penjualans->tanggal !!}</td>
                                            <td>{!! $penjualans->nomor !!}</td>
                                            <td>{!! $penjualans->nosj !!}</td>
                                            <td>{!! $penjualans->nmbrand !!}</td>
                                            <td>{!! $penjualans->barcode !!}</td>
                                            <td>{!! $penjualans->nmartikel !!}</td>
                                            <td>{!! $penjualans->jenis !!}</td>
                                            <td>{!! $penjualans->nmadmin !!}</td>
                                            <td>{!! $penjualans->nmsales !!}</td>
                                            <td style="text-align: right">{!! number_format($penjualans->qty,0) !!}</td>
                                            <td style="text-align: right">{!! number_format($penjualans->subtotal,0) !!}</td>
                                            <td style="text-align: right">{!! number_format($penjualans->diskon,0) !!}</td>
                                            <td style="text-align: right">{!! number_format($penjualans->diskon_global,0) !!}</td>
                                            <td style="text-align: right">{!! number_format($penjualans->total,0) !!}</td>
                                            <?php
                                            //
                                            if ($nomor == $penjualans->nomor) {
                                                $ongkir = 0;
                                            } else {
                                                $nomor = $penjualans->nomor;
                                                $ongkir = $penjualans->ongkos_kirim;
                                            }
                                            ?>
                                            <td style="text-align: right">{!! number_format($ongkir,0) !!}</td>
                                            <td>{!! $penjualans->keterangan !!}</td>
                                            <td>{!! $penjualans->alamat_kirim !!}</td>
                                            <td>{!! $penjualans->user_id !!}</td>
                                        </tr>
                                        <?php
                                        $qty += ($penjualans->qty);
                                        $subtotal += ($penjualans->subtotal);
                                        $diskon += ($penjualans->diskon);
                                        $diskon_global += ($penjualans->diskon_global);
                                        $total += ($penjualans->total);
                                        $tongkir += ($ongkir);
                                        ?>
                                        @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Total :</th>
                                            <th style="text-align: right">{!! number_format($qty,2) !!}</th>
                                            <th style="text-align: right">{!! number_format($subtotal,2) !!}</th>
                                            <th style="text-align: right">{!! number_format($diskon,2) !!}</th>
                                            <th style="text-align: right">{!! number_format($diskon_global,2) !!}</th>
                                            <th style="text-align: right">{!! number_format($total,2) !!}</th>
                                            <th style="text-align: right">{!! number_format($tongkir,2) !!}</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
</div>
<!-- /.container-fluid -->
@endsection

@push('script')

<script type="text/javascript">
    $(function() {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        new DataTable('#tablefreeze', {
            fixedColumns: {
                left: 2
            },
            paging: false,
            scrollCollapse: true,
            scrollX: true,
            scrollY: 300,
        });
    });
</script>

<script>
    function load() {
        var table = $('#example_res').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            "bDestroy": true,
            "scrollX": true,
            "scrollY": true,
            "searching": true,
            "ordering": true,
            "paging": true,
            "lengthChange": true,
            "columnDefs": [{
                    width: 300,
                    targets: 1
                },
                {
                    width: 100,
                    targets: 2
                },
                {
                    width: 100,
                    targets: 3
                },
                {
                    width: 100,
                    targets: 4
                },
                {
                    width: 100,
                    targets: 5
                },
                {
                    width: 100,
                    targets: 6
                },
                {
                    width: 200,
                    targets: 7
                },
                {
                    width: 100,
                    targets: 8
                },
                {
                    width: 100,
                    targets: 9
                },
                {
                    width: 100,
                    targets: 10
                },
                {
                    width: 100,
                    targets: 11
                },
                {
                    width: 100,
                    targets: 12
                },
                {
                    width: 100,
                    targets: 13
                },
                {
                    width: 100,
                    targets: 14
                },
                {
                    width: 100,
                    targets: 15
                },
                {
                    width: 100,
                    targets: 16
                },
                {
                    width: 100,
                    targets: 17
                },
                {
                    width: 100,
                    targets: 18
                },
                {
                    width: 100,
                    targets: 19
                },
                {
                    width: 100,
                    targets: 20
                },
            ],
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
</script>
@endpush