@extends('layouts.template')

@section('title', 'Laporan Penyerapan Produk | Ethica')
@section('content')
<div class="card">
    @include('flash-message')
    <div class="card-header">
        <h1 class="card-title" style="float: left; font-size: 20pt">Laporan Penyerapan Produk</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
    </div>
    <form id="penjualan" class="form-horizontal" method="get" action="{!! route('lap_perbandingan_po_vendor') !!}">
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
            <div class="card-footer">
                <a href="{!! route('lap_penyerapan_produk') !!}" class="btn btn-danger btn-sm"><span class="fa fa-times"></span> Reset</a>
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
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">
                            Format 1
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-format2-tab" data-toggle="pill" href="#custom-tabs-one-format2" role="tab" aria-controls="custom-tabs-one-format2" aria-selected="false">
                            Format 2
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-penjualanperartikel-tab" data-toggle="pill" href="#custom-tabs-one-penjualanperartikel" role="tab" aria-controls="custom-tabs-one-penjualanperartikel" aria-selected="false">
                            Penjualan Per Artikel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-pembagianpusatstore-tab" data-toggle="pill" href="#custom-tabs-one-pembagianpusatstore" role="tab" aria-controls="custom-tabs-one-pembagianpusatstore" aria-selected="false">
                            Pembagian Pusat dan Store
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-serapan_sarimbit-tab" data-toggle="pill" href="#custom-tabs-one-serapan_sarimbit" role="tab" aria-controls="custom-tabs-one-serapan_sarimbit" aria-selected="false">
                            Serapan Sarimbit
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-serapan_artikel_sarimbit-tab" data-toggle="pill" href="#custom-tabs-one-serapan_artikel_sarimbit" role="tab" aria-controls="custom-tabs-one-serapan_artikel_sarimbit" aria-selected="false">
                            Serapan Artikel Sarimbit
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-serapan_per_kategori_produk-tab" data-toggle="pill" href="#custom-tabs-one-serapan_per_kategori_produk" role="tab" aria-controls="custom-tabs-one-serapan_per_kategori_produk" aria-selected="false">
                            Serapan Per Kategori Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-serapan_warna-tab" data-toggle="pill" href="#custom-tabs-one-serapan_warna" role="tab" aria-controls="custom-tabs-one-serapan_warna" aria-selected="false">
                            Serapan Per Warna
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table id="exam" class="table table-hover text-nowrap" style="font-size: x-small">
                                                <thead>



                                                    <tr>
                                                        <th>No.</th>

                                                        <th>Bulan</th>
                                                        <th>Produk Release</th>
                                                        <th>Outgoing</th>
                                                        <th>% Penyerapan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    $qty = 0;
                                                    ?>
                                                    @if(!empty($data1))
                                                    @foreach($data1 as $datas)
                                                    <?php $no++; ?>
                                                    <tr>
                                                        <td class="bg-gradient-gray">{!! $no !!}</td>
                                                        <td class="bg-gradient-gray">{!! $datas->tanggal !!}</td>
                                                        <td>{!! $datas->nomor !!}</td>
                                                        <td>{!! $datas->nmcustomer !!}</td>
                                                        <td>{!! $datas->barcode !!}</td>
                                                        <td>{!! $datas->nmproduk !!}</td>
                                                        <td>{!! $datas->nmbrand !!}</td>
                                                        <td>{!! $datas->nmsubbrand !!}</td>
                                                        <td>{!! $datas->nmwarna !!}</td>
                                                        <td>{!! $datas->nmukuran !!}</td>
                                                        <td style="text-align: right">{!! number_format($datas->qty,0) !!}</td>
                                                        <td>{!! $datas->status !!}</td>
                                                        <td>{!! $datas->nmadmin !!}</td>
                                                    </tr>
                                                    <?php
                                                    $qty += ($datas->qty);
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
                                                        <th style="text-align: right">{!! number_format($qty,0) !!}</th>
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
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="custom-tabs-one-format2" role="tabpanel" aria-labelledby="custom-tabs-one-format2-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table id="exam" class="table table-hover text-nowrap" style="font-size: x-small">
                                                <thead>



                                                    <tr>
                                                        <th>No.</th>

                                                        <th>Bulan</th>
                                                        <th>Incoming</th>
                                                        <th>Penyerapan Pusat</th>
                                                        <th>Penyerapan Store</th>
                                                        <th>Non Jual</th>
                                                        <th>Presentasi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    $qty = 0;
                                                    ?>
                                                    @if(!empty($data1))
                                                    @foreach($data1 as $datas)
                                                    <?php $no++; ?>
                                                    <tr>
                                                        <td class="bg-gradient-gray">{!! $no !!}</td>
                                                        <td class="bg-gradient-gray">{!! $datas->tanggal !!}</td>
                                                        <td>{!! $datas->nomor !!}</td>
                                                        <td>{!! $datas->nmcustomer !!}</td>
                                                        <td>{!! $datas->barcode !!}</td>
                                                        <td>{!! $datas->nmproduk !!}</td>
                                                        <td>{!! $datas->nmbrand !!}</td>
                                                        <td>{!! $datas->nmsubbrand !!}</td>
                                                        <td>{!! $datas->nmwarna !!}</td>
                                                        <td>{!! $datas->nmukuran !!}</td>
                                                        <td style="text-align: right">{!! number_format($datas->qty,0) !!}</td>
                                                        <td>{!! $datas->status !!}</td>
                                                        <td>{!! $datas->nmadmin !!}</td>
                                                    </tr>
                                                    <?php
                                                    $qty += ($datas->qty);
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
                                                        <th style="text-align: right">{!! number_format($qty,0) !!}</th>
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
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="custom-tabs-one-penjualanperartikel" role="tabpanel" aria-labelledby="custom-tabs-one-penjualanperartikel-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table id="exam" class="table table-hover text-nowrap" style="font-size: x-small">
                                                <thead>



                                                    <tr>
                                                        <th>No.</th>

                                                        <th>Nama Sarimbit</th>
                                                        <th>Barcode</th>
                                                        <th>Produk</th>
                                                        <th>Artikel</th>
                                                        <th>Tipe</th>
                                                        <th>Warna</th>
                                                        <th>Size</th>
                                                        <th>Barang Masuk dari Produksi</th>
                                                        <th>Mutasi Store</th>
                                                        <th>Stok Pusat</th>
                                                        <th>Pusat</th>
                                                        <th>Store</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Terjual Pusat</th>
                                                        <th>Persentase(%)</th>
                                                        <th>Total Terjual Storet</th>
                                                        <th>Persentase(%)</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    $qty = 0;
                                                    ?>
                                                    @if(!empty($data1))
                                                    @foreach($data1 as $datas)
                                                    <?php $no++; ?>
                                                    <tr>
                                                        <td class="bg-gradient-gray">{!! $no !!}</td>
                                                        <td class="bg-gradient-gray">{!! $datas->tanggal !!}</td>
                                                        <td>{!! $datas->nomor !!}</td>
                                                        <td>{!! $datas->nmcustomer !!}</td>
                                                        <td>{!! $datas->barcode !!}</td>
                                                        <td>{!! $datas->nmproduk !!}</td>
                                                        <td>{!! $datas->nmbrand !!}</td>
                                                        <td>{!! $datas->nmsubbrand !!}</td>
                                                        <td>{!! $datas->nmwarna !!}</td>
                                                        <td>{!! $datas->nmukuran !!}</td>
                                                        <td style="text-align: right">{!! number_format($datas->qty,0) !!}</td>
                                                        <td>{!! $datas->status !!}</td>
                                                        <td>{!! $datas->nmadmin !!}</td>
                                                    </tr>
                                                    <?php
                                                    $qty += ($datas->qty);
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
                                                        <th style="text-align: right">{!! number_format($qty,0) !!}</th>
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
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="custom-tabs-one-pembagianpusatstore" role="tabpanel" aria-labelledby="custom-tabs-one-pembagianpusatstore-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table id="exam" class="table table-hover text-nowrap" style="font-size: x-small">
                                                <thead>



                                                    <tr>
                                                        <th>No.</th>

                                                        <th>Nama Sarimbit</th>
                                                        <th>Tipe</th>
                                                        <th>Barang Masuk dari Produksi</th>
                                                        <th>Ploting Mitra</th>
                                                        <th>Persentase(%)</th>
                                                        <th>Plating Store</th>
                                                        <th>Persentase(%)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    $qty = 0;
                                                    ?>
                                                    @if(!empty($data1))
                                                    @foreach($data1 as $datas)
                                                    <?php $no++; ?>
                                                    <tr>
                                                        <td class="bg-gradient-gray">{!! $no !!}</td>
                                                        <td class="bg-gradient-gray">{!! $datas->tanggal !!}</td>
                                                        <td>{!! $datas->nomor !!}</td>
                                                        <td>{!! $datas->nmcustomer !!}</td>
                                                        <td>{!! $datas->barcode !!}</td>
                                                        <td>{!! $datas->nmproduk !!}</td>
                                                        <td>{!! $datas->nmbrand !!}</td>
                                                        <td>{!! $datas->nmsubbrand !!}</td>
                                                        <td>{!! $datas->nmwarna !!}</td>
                                                        <td>{!! $datas->nmukuran !!}</td>
                                                        <td style="text-align: right">{!! number_format($datas->qty,0) !!}</td>
                                                        <td>{!! $datas->status !!}</td>
                                                        <td>{!! $datas->nmadmin !!}</td>
                                                    </tr>
                                                    <?php
                                                    $qty += ($datas->qty);
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
                                                        <th style="text-align: right">{!! number_format($qty,0) !!}</th>
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
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="custom-tabs-one-serapan_sarimbit" role="tabpanel" aria-labelledby="custom-tabs-one-serapan_sarimbit-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table id="exam" class="table table-hover text-nowrap" style="font-size: x-small">
                                                <thead>



                                                    <tr>
                                                        <th>No.</th>

                                                        <th>Nama Sarimbit</th>
                                                        <th>Tipe</th>
                                                        <th>Barang Masuk dari Produksi</th>
                                                        <th>Ploting Mitra</th>
                                                        <th>Penyerapan Pusat</th>
                                                        <th>Presentase(%)</th>
                                                        <th>Ploting Store</th>
                                                        <th>Penyerapan Store</th>
                                                        <th>Presentase(%)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    $qty = 0;
                                                    ?>
                                                    @if(!empty($data1))
                                                    @foreach($data1 as $datas)
                                                    <?php $no++; ?>
                                                    <tr>
                                                        <td class="bg-gradient-gray">{!! $no !!}</td>
                                                        <td class="bg-gradient-gray">{!! $datas->tanggal !!}</td>
                                                        <td>{!! $datas->nomor !!}</td>
                                                        <td>{!! $datas->nmcustomer !!}</td>
                                                        <td>{!! $datas->barcode !!}</td>
                                                        <td>{!! $datas->nmproduk !!}</td>
                                                        <td>{!! $datas->nmbrand !!}</td>
                                                        <td>{!! $datas->nmsubbrand !!}</td>
                                                        <td>{!! $datas->nmwarna !!}</td>
                                                        <td>{!! $datas->nmukuran !!}</td>
                                                        <td style="text-align: right">{!! number_format($datas->qty,0) !!}</td>
                                                        <td>{!! $datas->status !!}</td>
                                                        <td>{!! $datas->nmadmin !!}</td>
                                                    </tr>
                                                    <?php
                                                    $qty += ($datas->qty);
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
                                                        <th style="text-align: right">{!! number_format($qty,0) !!}</th>
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
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="custom-tabs-one-serapan_artikel_sarimbit" role="tabpanel" aria-labelledby="custom-tabs-one-serapan_artikel_sarimbit-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table id="exam" class="table table-hover text-nowrap" style="font-size: x-small">
                                                <thead>



                                                    <tr>
                                                        <th>No.</th>

                                                        <th>Barcode</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Sarimbit</th>
                                                        <th>Artikel</th>
                                                        <th>Tipe</th>
                                                        <th>Barang Masuk dari Produksi</th>
                                                        <th>Ploting Mitra</th>
                                                        <th>Penjualan Pusat</th>
                                                        <th>Persentase(%)</th>
                                                        <th>Ploting Store</th>
                                                        <th>Penjualan Store</th>
                                                        <th>Persentase(%)</th>
                                                        <th>Seq Barang</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    $qty = 0;
                                                    ?>
                                                    @if(!empty($data1))
                                                    @foreach($data1 as $datas)
                                                    <?php $no++; ?>
                                                    <tr>
                                                        <td class="bg-gradient-gray">{!! $no !!}</td>
                                                        <td class="bg-gradient-gray">{!! $datas->tanggal !!}</td>
                                                        <td>{!! $datas->nomor !!}</td>
                                                        <td>{!! $datas->nmcustomer !!}</td>
                                                        <td>{!! $datas->barcode !!}</td>
                                                        <td>{!! $datas->nmproduk !!}</td>
                                                        <td>{!! $datas->nmbrand !!}</td>
                                                        <td>{!! $datas->nmsubbrand !!}</td>
                                                        <td>{!! $datas->nmwarna !!}</td>
                                                        <td>{!! $datas->nmukuran !!}</td>
                                                        <td style="text-align: right">{!! number_format($datas->qty,0) !!}</td>
                                                        <td>{!! $datas->status !!}</td>
                                                        <td>{!! $datas->nmadmin !!}</td>
                                                    </tr>
                                                    <?php
                                                    $qty += ($datas->qty);
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
                                                        <th style="text-align: right">{!! number_format($qty,0) !!}</th>
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
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="custom-tabs-one-serapan_per_kategori_produk" role="tabpanel" aria-labelledby="custom-tabs-one-serapan_per_kategori_produk-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table id="exam" class="table table-hover text-nowrap" style="font-size: x-small">
                                                <thead>



                                                    <tr>
                                                        <th>No.</th>

                                                        <th>Nama Type</th>
                                                        <th>Barang Masuk dari Produksi</th>
                                                        <th>Pusat</th>
                                                        <th>Store</th>
                                                        <th>Presentase(%)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    $qty = 0;
                                                    ?>
                                                    @if(!empty($data1))
                                                    @foreach($data1 as $datas)
                                                    <?php $no++; ?>
                                                    <tr>
                                                        <td class="bg-gradient-gray">{!! $no !!}</td>
                                                        <td class="bg-gradient-gray">{!! $datas->tanggal !!}</td>
                                                        <td>{!! $datas->nomor !!}</td>
                                                        <td>{!! $datas->nmcustomer !!}</td>
                                                        <td>{!! $datas->barcode !!}</td>
                                                        <td>{!! $datas->nmproduk !!}</td>
                                                        <td>{!! $datas->nmbrand !!}</td>
                                                        <td>{!! $datas->nmsubbrand !!}</td>
                                                        <td>{!! $datas->nmwarna !!}</td>
                                                        <td>{!! $datas->nmukuran !!}</td>
                                                        <td style="text-align: right">{!! number_format($datas->qty,0) !!}</td>
                                                        <td>{!! $datas->status !!}</td>
                                                        <td>{!! $datas->nmadmin !!}</td>
                                                    </tr>
                                                    <?php
                                                    $qty += ($datas->qty);
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
                                                        <th style="text-align: right">{!! number_format($qty,0) !!}</th>
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
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="custom-tabs-one-serapan_warna" role="tabpanel" aria-labelledby="custom-tabs-one-serapan_warna-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table id="exam" class="table table-hover text-nowrap" style="font-size: x-small">
                                                <thead>



                                                    <tr>
                                                        <th>No.</th>

                                                        <th>Nama Warna</th>
                                                        <th>Barang Masuk dari Produksi</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    $qty = 0;
                                                    ?>
                                                    @if(!empty($data1))
                                                    @foreach($data1 as $datas)
                                                    <?php $no++; ?>
                                                    <tr>
                                                        <td class="bg-gradient-gray">{!! $no !!}</td>
                                                        <td class="bg-gradient-gray">{!! $datas->tanggal !!}</td>
                                                        <td>{!! $datas->nomor !!}</td>
                                                        <td>{!! $datas->nmcustomer !!}</td>
                                                        <td>{!! $datas->barcode !!}</td>
                                                        <td>{!! $datas->nmproduk !!}</td>
                                                        <td>{!! $datas->nmbrand !!}</td>
                                                        <td>{!! $datas->nmsubbrand !!}</td>
                                                        <td>{!! $datas->nmwarna !!}</td>
                                                        <td>{!! $datas->nmukuran !!}</td>
                                                        <td style="text-align: right">{!! number_format($datas->qty,0) !!}</td>
                                                        <td>{!! $datas->status !!}</td>
                                                        <td>{!! $datas->nmadmin !!}</td>
                                                    </tr>
                                                    <?php
                                                    $qty += ($datas->qty);
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
                                                        <th style="text-align: right">{!! number_format($qty,0) !!}</th>
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
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
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