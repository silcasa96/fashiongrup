@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 16pt">Edit Designer</h1>
        </div>
        <div class="card-body">
            <form class="g-3" method="post" action="{!! route('edit_nama_designer',$design[0]->pr_design_id) !!}" onsubmit="return confirm('Apakah data akan diubah?');" enctype="multipart/form-data">
                @csrf
                <div class="row" style="font-size: smaller">
                    <div class="col-sm-6">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-3">Brand</label>
                            <input type="text" class="form-control form-control-sm border-dark" value="{!! $design[0]->nmbrand !!}" readonly>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputPassword4" class="form-label col-sm-3">Sub Brand</label>
                            <input type="text" class="form-control form-control-sm border-dark" value="{!! $design[0]->nmgrupjenis !!}" readonly>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-3">Kode Design Grup</label>
                            <input type="text" class="form-control form-control-sm border-dark" value="{!! $design[0]->nmgrupjenis !!}" readonly>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Grup</label>
                            <input type="text" class="form-control form-control-sm border-dark" value="{!! $design[0]->jenis !!}" readonly>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputCity" class="form-label col-sm-3">Nama Design</label>
                            <input type="text" class="form-control form-control-sm border-dark" value="{!! $design[0]->nama !!}" readonly>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-3">Tema Desain</label>
                            <input type="text" class="form-control form-control-sm border-dark" value="{!! $design[0]->tema !!}" readonly>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Designer</label>
                            <select name="desainer" class="form-control select2bs4" required>
                                <option value="" selected="selected" value="">Pilih Designer</option>
                                <?php
                                foreach($designer AS $data){
                                    if($data->r_designer_id==$design[0]->r_designer_id){
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
                            <input type="text" class="form-control form-control-sm border-dark" value="{!! $design[0]->tahun !!}" readonly>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Triwulan</label>
                            <input type="text" class="form-control form-control-sm border-dark" value="{!! $design[0]->nmkwartal !!}" readonly>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Tgl Plan Approval</label>
                            <input type="text" class="form-control form-control-sm border-dark" value="{!! $design[0]->tglplanapproval !!}" readonly>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Keterangan</label>
                            <textarea type="text" class="form-control form-control-sm border-dark" rows="2" id="keterangan" name="keterangan" readonly="">{!! $design[0]->keterangan !!}</textarea>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Catatan Approval</label>
                            <textarea type="text" class="form-control form-control-sm border-dark" rows="2" id="komentar" name="komentar" readonly="">{!! $design[0]->komentar !!}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-12 d-inline-flex">
                            <label for="inputZip" class="form-label col-sm-3">Gambar</label>
                            <!--<input type="file" class="form-control form-control-sm border-dark" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">-->
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 400px; height: 250px;">
                                    @if(!empty($design[0]->foto))
                                        <img src="{!! asset('images/design/'.$design[0]->foto) !!}" alt="" class="img-responsive">
                                    @else
                                        <img data-src="holder.js/100%x100%" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary me-2"><i class="ti ti-user"></i> Edit Designer</button>
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