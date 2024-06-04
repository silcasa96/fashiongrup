@extends('layouts.template')

@section('title', 'Laporan Rekap Sarimbit | Ethica')
@section('content')
<div class="card">
    @include('flash-message')
    <div class="card-header">
        <h1 class="card-title" style="float: left; font-size: 20pt">Laporan Rekap Sarimbit</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
    </div>
    <form id="penjualan" class="form-horizontal" method="get" action="{!! route('cari_rekap_sarimbit') !!}">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama Sarimbit</label>
                        <div class="select2-purple">
                            <select class="select2bs4" data-placeholder="Pilih Sarimbit" data-dropdown-css-class="select2-purple" name="sarimbit" style="width: 100%;">
                                <option value="">Pilih Sarimbit</option>
                                <?php
                                foreach ($sarimbit as $sarimbit) {
                                    if ($sarimbit->nama == $idsarimbit) {
                                        echo '<option selected="selected" value="' . $sarimbit->nama . '">' . $sarimbit->nama . '</option>';
                                    } else {
                                        echo '<option value="' . $sarimbit->nama . '">' . $sarimbit->nama . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Keagenan</label>
                        <div class="select2-purple">
                            <select class="select2" multiple="multiple" data-placeholder="Pilih Keagenan" data-dropdown-css-class="select2-purple" style="width: 100%;" name="keagenan[]">
                                <?php
                                foreach ($keagenan as $keagenan) {
                                    if ($keagenan->seq == $idkeagenan) {
                                        echo '<option selected="selected" value="' . $keagenan->seq . '">' . $keagenan->nama . '</option>';
                                    } else {
                                        echo '<option value="' . $keagenan->seq . '">' . $keagenan->nama . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Gudang</label>
                        <div class="select2-purple">
                            <select class="select2" multiple="multiple" data-placeholder="Pilih Gudang" data-dropdown-css-class="select2-purple" style="width: 100%;" name="gudang[]">
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
                <!-- /.row -->
            </div>

            <div class="row">

            </div>

            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{!! route('lap_rekap_sarimbit') !!}" class="btn btn-danger btn-sm"><span class="fa fa-times"></span> Reset</a>
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
                                <h3 class="card-title">Laporan Rekap Sarimbit</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table id="exam" class="table table-hover text-nowrap" style="font-size: x-small">
                                    <thead>
                                        <tr>
                                            <th class="bg-gradient-gray">No.</th>
                                            <th class="bg-gradient-gray">Nama Sarimbit</th>
                                            <th>Barcode</th>
                                            <th>Barang</th>
                                            <th>Sub Brand</th>
                                            <th>Artikel</th>
                                            <th>Warna</th>
                                            <th>Ukuran</th>
                                            <th>Tgl Release</th>
                                            <th>Stok</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        $total = 0;
                                        ?>
                                        @if(!empty($rekap_sarimbit))
                                        @foreach($rekap_sarimbit as $rekap_sarimbits)
                                        <?php $no++; ?>
                                        <tr>
                                            <th class="bg-gradient-gray">{!! $no !!}</td>
                                            <th class="bg-gradient-gray">{!! $rekap_sarimbits->nmsarimbit !!}</td>
                                            <td>{!! $rekap_sarimbits->barcode !!}</td>
                                            <td>{!! $rekap_sarimbits->nmproduk !!}</td>
                                            <td>{!! $rekap_sarimbits->nmsubbrand !!}</td>
                                            <td>{!! $rekap_sarimbits->artikel !!}</td>
                                            <td>{!! $rekap_sarimbits->nmwarna !!}</td>
                                            <td>{!! $rekap_sarimbits->nmukuran !!}</td>
                                            <td>{!! date('d-m-Y',strtotime($rekap_sarimbits->tgl_release)) !!}</td>
                                            <td style="text-align: right">{!! number_format($rekap_sarimbits->stok,0) !!}</td>
                                            <td>{!! $rekap_sarimbits->keterangan !!}</td>
                                        </tr>
                                        <?php
                                        $total += ($rekap_sarimbits->stok);
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
                                            <th>Total :</th>
                                            <th style="text-align: right">{!! number_format($total,0) !!}</th>
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