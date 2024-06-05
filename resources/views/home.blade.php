@extends('layouts.template')

@section('content')
<div class="d-flex justify-content-center">
    <h2>Salsa Jaring Persada</h2>
</div>
<div class="d-flex justify-content-center">
    <h3>Selamat Datang Di Aplikasi ERP || ES-iOS</h3>
</div>
<style>
    .inner {
        padding: 20px;
        text-align: center;
    }
</style>
<div class="row">

    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="card bg-info">
            <div class="inner">
                <h5 class="mb-1">PENJUALAN AGEN</h5>
                <h6 class="mb-1">{!! number_format($agen[0]->qty,0) !!} pcs</h6>
                <h6 class="mb-1">{!! 'Rp. '. number_format($agen[0]->total,2) !!}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="card bg-success">
            <div class="inner">
                <h5 class="mb-1">PENJUALAN RETAIL</h5>
                <h6 class="mb-1">{!! number_format($retail[0]->qty,0) !!} pcs</h6>
                <h6 class="mb-1">{!! 'Rp. '. number_format($retail[0]->total,2) !!}</h6>

            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="card bg-warning">
            <div class="inner">
                <h5 class="mb-1">BARANG DATANG/HARI</h5>
                <h6 class="mb-1">{!! number_format($barang_masuk[0]->qty,0) !!} pcs</h6>
                <h6 class="mb-1">{!! 'Rp. '. number_format($barang_masuk[0]->total,2) !!}</h6>

            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <!-- ./col -->
</div>

<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 360px;
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-title {
       
        font-weight: bold;
        font-size: 1em;

    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>
<figure class=" row">
    <div class="col-md-4">
        <div class="card  d-none">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Date and time -->

                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <div class="input-group">
                                <input type="date" class="form-control tglawal input-group-sm" id="tglawal_harian_pusat" placeholder="Tanggal Awal" required value='{!! date("Y-m-"); !!}01'>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <div class="input-group">
                                <input type="date" class="form-control tglakhir input-group-sm" id="tglakhir_harian_pusat" placeholder="Tanggal Akhir" required value="{!! date('Y-m-d') !!}">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
            <div class="card-footer">

                <button type="button" name="Cari" onclick="show('_harian_pusat')" class="btn btn-primary btn-sm" value="Cari"><span class="fa fa-search"></span> Cari
                </button>

            </div>
        </div>
        <div id="container_harian_pusat"></div>
    </div>
    <div class="col-md-4">
        <div class="card  d-none">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Date and time -->

                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <div class="input-group">
                                <input type="date" class="form-control tglawal input-group-sm" id="tglawal_harian_mofas" placeholder="Tanggal Awal" required value='{!! date("Y-m-"); !!}01'>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <div class="input-group">
                                <input type="date" class="form-control tglakhir input-group-sm" id="tglakhir_harian_mofas" placeholder="Tanggal Akhir" required value="{!! date('Y-m-d') !!}">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
            <div class="card-footer">

                <button type="button" name="Cari" onclick="show('_harian_mofas')" class="btn btn-primary btn-sm" value="Cari"><span class="fa fa-search"></span> Cari
                </button>

            </div>
        </div>
        <div id="container_harian_mofas"></div>
    </div>

    <div class="col-md-4">
        <div class="card  d-none">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Date and time -->

                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <div class="input-group">
                                <input type="date" class="form-control tglawal input-group-sm" id="tglawal_own_store" placeholder="Tanggal Awal" required value='{!! date("Y-m-"); !!}01'>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <div class="input-group">
                                <input type="date" class="form-control tglakhir input-group-sm" id="tglakhir_own_store" placeholder="Tanggal Akhir" required value="{!! date('Y-m-d') !!}">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
            <div class="card-footer">

                <button type="button" name="Cari" onclick="show('_own_store')" class="btn btn-primary btn-sm" value="Cari"><span class="fa fa-search"></span> Cari
                </button>

            </div>
        </div>
        <div id="container_own_store"></div>
    </div>
</figure>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-info text-black">
                Penjualan Agen tertinggi
            </div>
            <div class="card-body">
                <table class="table table-stripped">
                    <?php foreach ($today as $today) { ?>
                        <tr>
                            <td><?= $today->nmcustomer; ?></td>
                            <td>Rp.<?= number_format($today->total, 0); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success text-black">
                Penyerapan Produk
            </div>
            <div class="card-body">
                <table class="table table-stripped">
                    <?php foreach ($penyerapan as $today) { ?>
                        <tr>
                            <td><?= $today->artikel; ?></td>
                            <td> <?= number_format($today->penyerapan_pusat, 2); ?>%</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-warning text-black">
                Goal Comparision
            </div>
            <div class="card-body">
                <table class="table table-stripped">

                    <tr>
                        <td>Sales Order Acc</td>
                        <td>Rp.<?= number_format($sales[0]->total_acc, 2); ?></td>
                    </tr>
                    <tr>
                        <td>Sales OrderBelum Acc</td>
                        <td>Rp.<?= number_format($sales[0]->total_blm_acc, 2); ?></td>
                    </tr>
                    <tr>
                        <td>Delivery Order</td>
                        <td>Rp.<?= number_format($sales[0]->total_do, 2); ?></td>
                    </tr>

                </table>
            </div>
        </div>
    </div>

    @endsection

    @push('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        show('_harian_pusat');
        show('_harian_mofas');
        show('_own_store');

        function visitorData(data, x_axis, id_show, total) {

            if (id_show == '_harian_pusat') {
                text_title = "Penjualan Harian Pusat";
            }
            if (id_show == '_harian_mofas') {
                text_title = "Penjualan Harian Mofas";
            }
            if (id_show == '_own_store') {
                text_title = "Penjualan Own Store";
            }
            Highcharts.chart('container' + id_show, {
                chart: {
                    zooming: {
                        type: 'xy'
                    }
                },
                title: {
                    text: text_title,
                    align: 'center'
                },
                subtitle: {
                    text: total,
                    align: 'center'
                },
                xAxis: [{
                    categories: x_axis,
                    crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    title: {
                        text: 'Total Penjualan',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    }
                }],
                tooltip: {
                    shared: true
                },
                legend: {
                    align: 'left',
                    x: 80,
                    verticalAlign: 'top',
                    y: 60,
                    floating: true,
                    backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || // theme
                        'rgba(255,255,255,0.25)'
                },
                series: data
            });

            // Highcharts.chart('container' + id_show, {

            //     title: {
            //         text: text_title,
            //         align: 'center'
            //     },

            //     // subtitle: {
            //     //     text: 'By Job Category. Source: <a href="https://irecusa.org/programs/solar-jobs-census/" target="_blank">IREC</a>.',
            //     //     align: 'left'
            //     // },

            //     yAxis: [{ // Primary yAxis
            //         labels: {
            //             format: '{value} pcs',
            //             style: {
            //                 color: Highcharts.getOptions().colors[2]
            //             }
            //         },
            //         title: {
            //             text: 'Qty',
            //             style: {
            //                 color: Highcharts.getOptions().colors[2]
            //             }
            //         },
            //         opposite: true

            //     }, { // Secondary yAxis
            //         gridLineWidth: 0,
            //         title: {
            //             text: 'Total Penjualan',
            //             style: {
            //                 color: Highcharts.getOptions().colors[0]
            //             }
            //         },
            //         labels: {
            //             format: 'Rp. {value}',
            //             style: {
            //                 color: Highcharts.getOptions().colors[0]
            //             }
            //         }

            //     }, ],

            //     xAxis: {
            //         categories: x_axis,
            //     },

            //     legend: {
            //         layout: 'vertical',
            //         align: 'right',
            //         verticalAlign: 'middle'
            //     },



            //     series: data,

            //     responsive: {
            //         rules: [{
            //             condition: {
            //                 maxWidth: 500
            //             },
            //             chartOptions: {
            //                 legend: {
            //                     layout: 'horizontal',
            //                     align: 'center',
            //                     verticalAlign: 'bottom'
            //                 }
            //             }
            //         }]
            //     }

            // });
        }

        function show(id_show) {
            $.ajax({
                url: '{{url("graph_laporan")}}' + id_show,
                type: 'GET',
                data: {
                    tgl_awal: $('#tglawal' + id_show).val(),
                    tgl_akhir: $('#tglakhir' + id_show).val(),
                },
                dataType: "json",
                success: function(data) {
                    series = data.y_axis;
                    x_axis = data.x_axis;
                    total = data.total;
                    visitorData(series, x_axis, id_show, total);
                }
            });
        }
    </script>

    @endpush