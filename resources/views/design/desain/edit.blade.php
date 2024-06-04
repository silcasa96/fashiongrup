@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 16pt">Edit Desain</h1>
        </div>
        <div class="card-body">
            <form class="g-3" method="post" action="{!! route('update_design',$designs[0]->pr_design_id) !!}" onsubmit="return confirm('Apakah data akan diubah?');" enctype="multipart/form-data">
                @csrf
                <div class="row" style="font-size: smaller">
                    <div class="col-sm-6">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-3">Brand</label>
                            <select name="brand" class="form-control select2bs4" required id="brand">
                                <option value="" selected="selected" value="">Pilih Brand</option>
                                <?php
                                foreach($brand AS $data){
                                    if($data->r_brand_id==$designs[0]->r_brand_id){
                                        echo '<option selected="selected" value="'.$data->r_brand_id.'">'.$data->nmbrand.'</option>';
                                    }
                                    else{
                                        echo '<option value="'.$data->r_brand_id.'">'.$data->nmbrand.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            @error('brand')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputPassword4" class="form-label col-sm-3">Sub Brand</label>
                            <select name="subbrand" class="form-control select2bs4" required onchange="cari_kode();" id="subbrand">
                                <option value="" selected="selected" value="">Pilih Sub Brand</option>
                                <?php
                                foreach($subbrand AS $data){
                                    if($data->r_grupjenis_id==$designs[0]->r_grupjenis){
                                        echo '<option selected="selected" value="'.$data->r_grupjenis_id.'">'.$data->kdgrupjenis.' - '.$data->nmgrupjenis.'</option>';
                                    }
                                    else{
                                        echo '<option value="'.$data->r_grupjenis_id.'">'.$data->kdgrupjenis.' - '.$data->nmgrupjenis.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            @error('subbrand')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-3">Kode Design Grup</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="kodesub" placeholder="" name="kodesub" value="{!! $designs[0]->kode !!}">
                            <input type="text" class="form-control form-control-sm border-dark" id="blnthn" placeholder="" name="blnthn" value="{!! $designs[0]->kdblnthn !!}">
                            <input type="text" class="form-control form-control-sm border-dark" id="nourut" placeholder="" name="nourut" value="{!! $designs[0]->nourut !!}">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Grup</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="grup" name="grup" value="{!! $designs[0]->jenis !!}">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputCity" class="form-label col-sm-3">Nama Design</label>
                            <select name="nama_desain" class="form-control select2bs4" required>
                                <option value="" selected="selected" value="">Pilih Nama Design</option>
                                <?php
                                foreach($design AS $data){
                                    if($data->nmdesign_id==$designs[0]->nmdesign){
                                        echo '<option selected="selected" value="'.$data->nmdesign_id.'">'.$data->nmdesign.'</option>';
                                    }
                                    else{
                                        echo '<option value="'.$data->nmdesign_id.'">'.$data->nmdesign.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            @error('nama_desain')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-3">Tema Desain</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="tema_desain" name="tema_desain" value="{!! $designs[0]->tema !!}">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Designer</label>
                            <select name="desainer" class="form-control select2bs4" required>
                                <option value="" selected="selected" value="">Pilih Designer</option>
                                <?php
                                foreach($designer AS $data){
                                    if($data->r_designer_id==$designs[0]->r_designer_id){
                                        echo '<option selected="selected" value="'.$data->r_designer_id.'">'.$data->nmdesigner.'</option>';
                                    }
                                    else{
                                        echo '<option value="'.$data->r_designer_id.'">'.$data->nmdesigner.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            @error('desainer')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Tahun</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="tahun" name="tahun" value="{!! $designs[0]->tahun !!}">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Triwulan</label>
                            <select name="kwartal" class="form-control select2bs4" required>
                                <option value="" selected="selected" value="">Pilih Triwulan</option>
                                <?php
                                foreach($kwartal AS $data){
                                    if($data->r_kwartal_id==$designs[0]->r_kwartal_id){
                                        echo '<option selected="selected" value="'.$data->r_kwartal_id.'">'.$data->kwartal.'</option>';
                                    }
                                    else{
                                        echo '<option value="'.$data->r_kwartal_id.'">'.$data->kwartal.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            @error('kwartal')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Tgl Plan Approval</label>
                            <input type="date" class="form-control form-control-sm border-dark" id="tgl_plan_appr" name="tgl_plan_appr" value="{!! $designs[0]->tglplanapproval !!}">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Keterangan</label>
                            <textarea type="text" class="form-control form-control-sm border-dark" rows="2" id="keterangan" name="keterangan">{!! $designs[0]->keterangan !!}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-12 d-inline-flex">
                            <label for="inputZip" class="form-label col-sm-3">Upload Gambar</label>
                            <!--<input type="file" class="form-control form-control-sm border-dark" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">-->
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 400px; height: 250px;">
                                    @if(!empty($designs[0]->foto))
                                        <img src="{!! asset('images/design/'.$designs[0]->foto) !!}" alt="" class="img-responsive">
                                    @else
                                        <img data-src="holder.js/100%x100%" alt="">
                                    @endif
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-info btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="foto" required></span>
                                    <!--<input type="submit" class="btn btn-primary" name="submit" value="Upload">-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary me-2"><i class="ti ti-edit"></i> Ubah</button>
                    <a href="{{ route('design') }}" type="submit" class="btn btn-secondary"><i class="ti ti-corner-up-left-double"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
    function cari_kode(){
        var subbrand = document.getElementById('subbrand').value;
        //alert(subbrand)
        $.ajax({
            type: 'get',
            //data: {'id': id},
            url: 'cari_kode/'+subbrand,
            dataType: 'json',
            success: function(data){
                kodesub = (data.kodesub);
                blnthn = (data.blnthn);
                nourut = data.nourut;
                grup = data.grup;
                $("#kodesub").val(kodesub);
                //alert()
                $("#blnthn").val(blnthn);
                $('#nourut').val(nourut);
                $('#grup').val(grup);
            },
            error: function(data){
                $('#message').text('Error!');
                $('.dvLoading').hide();
            }
        });
    }
</script>