<style type="text/css">
  .tit{
    background: black;
    color: white;
    padding: 0.5%;
  }
  .col-om{
    background: radial-gradient(#999999a1, #9999991f);
    padding: 1%;
  }
</style>

    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
          <br/> 

          <div hidden align="left" id="back">
            <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn bg-navy"><i class="fa fa-arrow-left"></i> Kembali</button></a>
          </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          
          <form method="POST" action="<?=base_url('recording/save')?>">
          
          <div class="col-md-12 col-om">
            <div hidden class="col-md-6">
              <div class="form-group">
                <label>Nomor</label>
                <input id="nomor" type="text" name="nomor" class="form-control" value="">
              </div>
            </div>
             <div class="col-md-6">
              <div class="form-group">
                <label>Tanggal Recording</label>
                <input id="tanggal" type="date" name="tanggal" class="form-control" value="<?=date('Y-m-d')?>">
              </div>
            </div>
            <div class="col-md-6"> 
              <div class="form-group">
                <label>Populasi Ayam</label>
                <div class="input-group">
                  <input readonly id="populasi" type="number" name="populasi" class="form-control" required value="<?=@$populasi_data['barang_stok']?>">
                  <span class="input-group-addon"><?=@$populasi_data['barang_satuan']?></span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Rata-rata Bobot Ayam</label>
                <div class="input-group">
                  <input id="bobot" type="text" name="bobot" class="form-control" required>
                  <span class="input-group-addon">Kg</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" required id="keterangan" name="keterangan"></textarea>
              </div>
            </div>
          </div>

          <div class="clearfix"></div><br/>

          <!-- telur -->
          
          <div class="col-md-12 col-om telur_sub">  

            <h4 align="center" class="tit"><b>-- PANEN TELUR --</b></h4>
            
            <table class="table">
              <thead>
                <tr>
                  <th width="500">Telur</th>
                  <th width="500">Jumlah Telur</th>
                  <th width="500" hidden>Kategori</th>
                  <th width="1">
                    <button type="button" onclick="clone('telur')" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                  </th>
                </tr>
              </thead>
              <tbody id="paste_telur"></tbody>
            </table>

          </div>

          <div class="clearfix"></div><br/>

          <!-- pakan -->

          <div class="col-md-12 col-om pakan_sub">

            <h4 align="center" class="tit"><b>-- PAKAN Di BERIKAN --</b></h4>

            <table class="table">
              <thead>
                <tr>
                  <th width="500">Pakan</th>
                  <th width="500">Stok Pakan</th>
                  <th width="500">Jumlah Pakan</th>
                  <th width="500" hidden>Kategori</th>
                  <th width="1">
                    <button type="button" onclick="clone('pakan')" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                  </th>
                </tr>
              </thead>
              <tbody id="paste_pakan"></tbody>
            </table>

          </div>

          <div class="clearfix"></div><br/>

          <!-- obat -->

          <div class="col-md-12 col-om premix_sub">

            <h4 align="center" class="tit"><b>-- OBAT DI BERIKAN --</b></h4>

            <table class="table">
              <thead>
                <tr>
                  <th width="500">Obat</th>
                  <th width="500">Stok Obat</th>
                  <th width="500">Jumlah Obat</th>
                  <th width="500" hidden>Kategori</th>
                  <th width="1">
                    <button type="button" onclick="clone('obat')" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                  </th>
                </tr>
              </thead>
              <tbody id="paste_obat"></tbody>
            </table>

          </div>

          <div class="clearfix"></div><br/>

          <!-- ayam mati -->

          <div class="col-md-12 col-om mati_sub">

            <h4 align="center" class="tit"><b>-- AYAM MATI --</b></h4>

            <table class="table">
              <thead>
                <tr>
                  <th width="500">Ayam</th>
                  <th width="500">Populasi</th>
                  <th width="500">Jumlah</th>
                  <th hidden>Kategori</th>
                  <th width="1">
                    <button type="button" onclick="clone('ayam')" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                  </th>
                </tr>
              </thead>
              <tbody id="paste_ayam"></tbody>
            </table>

          </div>

          <div class="clearfix"></div><br/>

          <!-- kotoran ayam -->

          <div class="col-md-12 col-om kotoran_sub">

            <h4 align="center" class="tit"><b>-- KOTORAN AYAM --</b></h4>

            <table class="table">
              <thead>
                <tr>
                  <th width="500">Kotoran</th>
                  <th width="500">Jumlah</th>
                  <th hidden>Kategori</th>
                  <th width="1">
                    <button type="button" onclick="clone('kotoran')" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                  </th>
                </tr>
              </thead>
              <tbody id="paste_kotoran"></tbody>
            </table>

          </div>

            <div class="clearfix"></div><br/>

            <div id="submit" class="col-md-12 row">
              <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
              <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
            </div>

          </form>

        </div>

        
      </div>
      <!-- /.box -->

<!-- copy -->
<table>

  <!-- TELUR -->
  <tr id="copy_telur" hidden>
    <td>
      <select id="telur" class="form-control telur" required name="telur[]">
        <option value="" hidden>-- Pilih --</option>
        <?php foreach ($telur_data as $value): ?>
          <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
        <?php endforeach ?>
      </select>
    </td>
    <td>
      <div class="input-group">
        <input id="telur_jumlah" type="number" name="telur_jumlah[]" class="form-control telur_jumlah" required value="0" min="0">
        <span class="input-group-addon telur_satuan"></span>
      </div>
    </td>
    <td hidden>
       <input value="telur" type="text" name="telur_kategori[]" class="form-control telur_kategori">
    </td>
    <td>
      <button type="button" class="remove btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()"><i class="fa fa-minus"></i></button>
    </td>
  </tr>

  <!-- PAKAN -->
  <tr id="copy_pakan" hidden>
    <td>
      <select id="pakan" class="form-control pakan" required name="pakan[]">
        <option value="" hidden>-- Pilih --</option>
        <?php foreach ($pakan_data as $value): ?>
          <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
        <?php endforeach ?>
      </select>
    </td>
    <td>
      <div class="input-group">
        <input id="pakan_stok" readonly type="number" name="pakan_stok[]" class="form-control pakan_stok" required value="0" min="0">
        <span class="input-group-addon pakan_satuan"></span>
      </div>
    </td>
    <td>
      <div class="input-group">
        <input id="pakan_jumlah" type="number" name="pakan_jumlah[]" class="form-control pakan_jumlah" required value="0" min="0">
        <span class="input-group-addon pakan_satuan"></span>
      </div>
    </td>
    <td hidden>
      <input id="pakan_kategori" type="text" name="pakan_kategori[]" class="form-control pakan_kategori" value="pakan">
    </td>
    <td>
      <button type="button" class="remove btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()"><i class="fa fa-minus"></i></button>
    </td>
  </tr>

  <!-- OBAT -->
  <tr id="copy_obat" hidden>
    <td>
      <select id="obat" class="form-control obat" required name="obat[]">
        <option value="" hidden>-- Pilih --</option>
        <?php foreach ($obat_data as $value): ?>
          <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
        <?php endforeach ?>
      </select>
    </td>
    <td>
      <div class="input-group">
        <input id="obat_stok" readonly value="0" min="0" type="number" name="obat_stok[]" class="form-control obat_stok" required>
        <span class="input-group-addon obat_satuan"></span>
      </div>
    </td>
    <td>
      <div class="input-group">
        <input id="obat_jumlah" value="0" min="0" type="number" name="obat_jumlah[]" class="form-control obat_jumlah" required>
        <span class="input-group-addon obat_satuan"></span>
      </div>
    </td>
    <td hidden>
       <input value="obat" type="text" name="obat_kategori[]" class="form-control obat_kategori">
    </td>
    <td>
      <button type="button" class="remove btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()"><i class="fa fa-minus"></i></button>
    </td>
  </tr>

  <!-- AYAM MATI -->
  <tr id="copy_ayam" hidden>
    <td>
      <select id="ayam" class="form-control ayam" required name="ayam[]">
        <option value="" hidden>-- Pilih --</option>
        <?php foreach ($ayam_data as $value): ?>
          <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
        <?php endforeach ?>
      </select>
    </td>
    <td>
      <div class="input-group">
        <input id="ayam_stok" readonly value="0" min="0" type="number" name="ayam_stok[]" class="form-control ayam_stok" required>
        <span class="input-group-addon ayam_satuan"></span>
      </div>
    </td>
    <td>
      <div class="input-group">
        <input id="ayam_jumlah" value="0" min="0" type="number" name="ayam_jumlah[]" class="form-control ayam_jumlah" required>
        <span class="input-group-addon ayam_satuan"></span>
      </div>
    </td>
    <td hidden>
       <input value="ayam" type="text" name="ayam_kategori[]" class="form-control ayam_kategori">
    </td>
    <td>
      <button type="button" class="remove btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()"><i class="fa fa-minus"></i></button>
    </td>
  </tr>

  <!-- KOTORAN -->
  <tr id="copy_kotoran" hidden> 
    <td>
      <select id="kotoran" class="form-control kotoran" required name="kotoran[]">
        <option value="" hidden>-- Pilih --</option>
        <?php foreach ($kotoran_data as $value): ?>
          <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
        <?php endforeach ?>
      </select>
    </td>   
    <td>
      <div class="input-group">
        <input id="kotoran_jumlah" value="0" min="0" type="number" name="kotoran_jumlah[]" class="form-control kotoran_jumlah" required>
        <span class="input-group-addon kotoran_satuan"></span>
      </div>
    </td>
    <td hidden>
       <input value="kotoran" type="text" name="kotoran_kategori[]" class="form-control kotoran_kategori">
    </td>
    <td>
      <button type="button" class="remove btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()"><i class="fa fa-minus"></i></button>
    </td>
  </tr>

</table>

<script type="text/javascript">

//satuan pakan, obat
$(document).on('change', '#pakan, #obat, #telur, #kotoran, #ayam', function() {

  var id = $(this).val();
  var nama = $(this).prop('name').replace("[]", "");  
  var satuan = $(this).closest('tr').find('.'+nama+'_satuan');
  var select = $(this).closest('tr').find('.'+nama);
  var jumlah = $(this).closest('tr').find('.'+nama+'_jumlah');
  var stok = $(this).closest('tr').find('.'+nama+'_stok');
  
  if (id != '') {

    //cek exist data
    var index = $(this).closest('tr').index();
    var arr = new Array();

    $.each($('.'+nama), function(idx, val) {
      
          var val = $(this).val();

          if (index != idx)
          arr.push(val);

      });

     if ($.inArray(id, arr) != -1) {

        warning('Pilihan sudah ada');

        //reset value
        satuan.text('');
        jumlah.val(0);
        stok.val(0);
        select.val('').change();

     }else{

        //get data
        $.get('<?=base_url('recording/get_barang/')?>'+id, function(data) {
          
          var val = $.parseJSON(data);

          satuan.text(val.barang_satuan);
          stok.val(val.barang_stok);

        });

     } 

  }

}); 

//cek stok pakan dan obat
$(document).on('keyup | change', '.pakan_jumlah, .obat_jumlah', function() {

  var nama = $(this).prop('name').replace("[]", "");
  var stok = $(this).closest('tr').find('#'+nama.replace('jumlah', 'stok'));

  var jum = 0;
  $.each($('.'+nama), function(index, val) {
     
     jum += parseInt($(this).val());

  });

  if (jum > parseInt(stok.val())) {

    warning('Jumlah melebihi stok');

    //reset
    $(this).val(0);

  }

});

//copy paste
function clone(target){
  //paste
  $('#paste_'+target).prepend($('#copy_'+target).clone().removeAttr('hidden'));

  //reset value
  $('#copy_'+target).find('select').val('').change();
  $('#copy_'+target).find('input[type="number"]').val(0);
  $('#copy_'+target).find('span').text('');
} 

//otomatis
// function auto(){

//   setTimeout(function() {
//       auto();
//   }, 100);
// }

//auto();

</script>