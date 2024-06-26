@extends('layouts.template')

@section('content')
<div class="card">
    @include('flash-message')
    <div class="card-header">
        <h1 class="card-title" style="float: left; font-size: 20pt">Penerimaan Barang Jadi dari Produksi dan Vendor</h1>
    </div>
    <form id="penjualan" class="form-horizontal" method="get">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Brand</label>
                        <div class="select2-purple">
                            <select class="select2" multiple="multiple" data-placeholder="Pilih Brand" data-dropdown-css-class="select2-purple" style="width: 100%;" name="brand[]">
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
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Sub Brand</label>
                        <div class="select2-purple">
                            <select class="select2" multiple="multiple" data-placeholder="Pilih Sub Brand" data-dropdown-css-class="select2-purple" style="width: 100%;" name="subbrand[]">
                                <?php
                                foreach ($subbrand as $brand) {
                                    if ($brand->seq == $idsubbrand) {
                                        echo '<option selected="selected" value="' . $brand->seq . '">' . $brand->kode . ' - ' . $brand->nama . '</option>';
                                    } else {
                                        echo '<option value="' . $brand->seq . '">' . $brand->kode . ' - ' . $brand->nama . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- /.form-group -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Artikel</label>
                        <select class="select2bs4" data-placeholder="Pilih Artikel" data-dropdown-css-class="select2-purple" style="width: 100%;" id="artikel" name="artikel">
                            <option value="">Pilih Artikel</option>
                            <?php
                            foreach ($artikel as $artikel) {
                                if ($artikel->artikel == $idartikel) {
                                    echo '<option selected="selected" value="' . $artikel->artikel . '">' . $artikel->artikel . '</option>';
                                } else {
                                    echo '<option value="' . $artikel->artikel . '">' . $artikel->artikel . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Gudang</label>
                        <div class="select2-purple">
                            <select class="select2" multiple="multiple" data-placeholder="Pilih Gudang" data-dropdown-css-class="select2-purple" style="width: 100%;" name="gudang[]">
                                <?php
                                foreach ($gudang as $gudang) {
                                    if ($gudang->seq == $idgudang) {
                                        echo '<option selected="selected" value="' . $gudang->seq . '">' . $gudang->nama . '</option>';
                                    } else {
                                        echo '<option value="' . $gudang->seq . '">' . $gudang->nama . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Vendor</label>
                        <select class="select2bs4" data-placeholder="Pilih Vendor" data-dropdown-css-class="select2-purple" style="width: 100%;" id="vendor" name="vendor">
                            <option value="">Pilih Vendor</option>
                            <?php
                            foreach ($vendor as $vendor) {
                                if ($vendor->seq == $idvendor) {
                                    echo '<option selected="selected" value="' . $vendor->seq . '">' . $vendor->nama . '</option>';
                                } else {
                                    echo '<option value="' . $vendor->seq . '">' . $vendor->nama . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
            </div>

            <div class="row">

            </div>

            <!-- /.card-body -->
            <div class="mt-3">
                <a href="" class="btn btn-danger btn-sm"><span class="fa fa-times"></span> Reset</a>
                <button type="submit" name="Cari" class="btn btn-primary btn-sm" value="Cari"><span class="fa fa-search"></span> Cari
                </button>
                <button type="submit" name="Cari" class="btn btn-success btn-sm" value="Excel"><span class="fa fa-file-excel"></span> Excel
                </button>
            </div>
    </form>
</div>
<div class="card-body">

    <table class="table table-bordered" id="example1" style="font-size: smaller">
        <thead>
            <tr>
                <th class="bg-gradient-gray" rowspan="2">Bulan</th>

                <th class="text-center align-top" colspan="4" >Nama Brand</th>
            </tr>
            <tr>
                <th class="align-top">Qty Masuk</th>
                <th class="align-top">Qty Retur</th>
                <th class="align-top">Qty Akhir</th>
                <th class="align-top">Nominal Akhir(Harga Jual)</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 0; ?>
            @if(!empty($data))
            <?php $no ?>
            @foreach($data as $data)
            <?php $no++ ?>
            <tr>
                <td style="padding: 5px 5px !important;">{!! $no !!}</td>
                <td style="padding: 5px 5px !important;">{!! $data->nmdesign !!}</td>
                <td style="padding: 5px 5px !important; text-align: center">
                    <a href="{!! route('edit_namadesign',$data->nmdesign_id) !!}" title="ubah"><i class="ti ti-edit" style="font-size: 16pt"></i></a>
                </td>
                <td style="padding: 5px 5px !important; text-align: center">
                    <a href="{!! route('destroy_namadesign',$data->nmdesign_id) !!}" title="hapus" onclick="return confirm('Apakah Data akan dihapus?');"><i class="ti ti-x" style="font-size: 16pt"></i></a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
</div>

@endsection

@push('script')
<script>
    $(function() {
        $("#example1").DataTable({
            "scrollX": true,
            "scrollY": true,
            "footer": true,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush