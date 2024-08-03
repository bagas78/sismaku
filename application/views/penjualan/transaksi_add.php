
    <!-- Main content --> 
    <section class="content">

      <!-- Default box --> 
      <div class="box"> 
        <div class="box-header with-border">

          <div hidden align="left" class="back">
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
          
          <form action="<?=base_url('penjualan/transaksi_save');?>" method="post">
              
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nomor</label>
                  <input type="text" required readonly="" name="nomor" class="nomor form-control" value="<?=@$nomor?>">
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea name="keterangan" class="keterangan form-control"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Jatuh Tempo</label>
                  <input type="date" required name="jatuh tempo" class="jatuh_tempo form-control" value="<?=date('Y-m-d')?>">
                </div>
              </div>

              <div class="col-md-12">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th width="250">Barang</th>
                      <th width="150">Harga</th>
                      <th width="150">Qty</th>
                      <th width="150">Diskon (%)</th>
                      <th width="150">Stok</th>
                      <th width="150">Subtotal</th>
                      <th width="1"><button type="button" onclick="clone()" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>
                  <tbody id="paste">
                    <tr id="copy">
                      <td>
                        <select required name="barang[]" class="barang form-control">
                          <option value="" hidden>-- Barang --</option>
                          <?php foreach ($barang_data as $val): ?>
                            <option value="<?=$val['barang_id']?>"><?=$val['barang_nama']?></option>
                          <?php endforeach ?>
                          <?php foreach ($afkir_data as $af): ?>
                            <option value="<?=$af['barang_id']?>"><?=$af['barang_nama']?></option>
                          <?php endforeach ?>
                        </select>
                      </td>
                      <td>
                        <input type="number" name="harga[]" class="harga form-control" required min="1" value="0" step="0.01">
                      </td>
                      <td>
                        <div class="input-group">
                          <input type="number" name="qty[]" class="qty form-control" required min="1" value="0" step="0.01">
                          <span class="satuan input-group-addon"></span>
                        </div>
                      </td>
                      <td>
                        <input type="number" name="diskon[]" class="diskon form-control" required min="0" value="0" step="0.01">
                      </td>
                      <td>
                        <div class="input-group">
                          <input readonly="" type="text" name="stok[]" class="stok form-control" required min="1" value="0">
                          <span class="satuan input-group-addon"></span>
                        </div>
                      </td>
                      <td>
                        <input type="text" name="subtotal[]" class="subtotal form-control" required min="1" value="0" readonly="">
                      </td>
                      <td>
                        <button type="button" class="remove btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()"><i class="fa fa-minus"></i></button>
                      </td>
                    </tr>
                    
                    <tr>
                      <td colspan="4"></td>
                      <td align="right">Qty Akhir</td>
                      <td><input id="qty" readonly="" type="text" name="qty_akhir" class="form-control" value="0" min="0"></td>
                    </tr>

                    <tr>
                      <td colspan="4"></td>
                      <td align="right">PPN</td>
                      <td>
                        <div class="input-group">
                          <input id="ppn"  type="text" name="ppn" class="form-control" required min="0" value="0">
                          <span class="input-group-addon">%</span>
                        </div>
                      </td>
                    </tr>                    

                    <tr>
                      <td colspan="4"></td>
                      <td align="right">Total Akhir</td>
                      <td><input id="total" readonly="" type="text" name="total" class="form-control" value="0" min="0"></td>
                    </tr>

                    <tr class="save">
                      <td colspan="6" align="right">
                        <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
                        <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>

            </div>

          </form>          

        </div>
      </div>
      <!-- /.box -->

<script type="text/javascript">

  //copy paste
  function clone(){
    //paste
    $('#paste').prepend($('#copy').clone());

    //reset value
    $('#copy').find('select').val('').change();
    $('#copy').find('input').val(0);
  }

  $(document).on('change', '.barang', function() {

    //get stok
    var barang = $(this).val();
    var stok = $(this).closest('tr').find('.stok');
    var satuan = $(this).closest('tr').find('.satuan');

    $.get('<?=base_url('penjualan/get_stok/')?>'+barang, function(data) {
        
        arr = $.parseJSON(data); 

        number_format(stok.val(arr['stok']));
        satuan.text(arr['satuan']);

    });

    //push array
    var id = $(this).val();
    var index = $(this).closest('tr').index();
    var arr = new Array(); 

    //cek array exist
    if (id != null) {

        $.each($('.barang'), function(idx, val) {
      
            var val = $(this).val();

            if (index != idx)
            arr.push(val);

        });

        if ('<?=@$view?>' != 1) {

            if ($.inArray(id, arr) != -1) {

              warning('Barang sudah ada');

              //reset value
              $(this).closest('tr').find('select').val('').change();
              $(this).closest('tr').find('input').val(0);
            }

        }
    }

  });

  $(document).on('change', '.qty', function() {
    var qty = parseInt($(this).val());
    var stok = parseInt($(this).closest('tr').find('.stok').val().replace(/,/g, ''));

    if (qty > stok) {
      $(this).val(0);
      warning('Stok kurang dari Qty');
    }

  });

  function auto(){

    //subtotal
    var harga = 0;
    var qty = 0;
    var total = 0;
    $.each($('.harga'), function(index, val) {

      var h = parseInt($(this).val().replaceAll('.', ''));
      var q = parseInt($(this).closest('tr').find('.qty').val().replaceAll('.', ''));
      var d = parseInt($(this).closest('tr').find('.diskon').val().replaceAll('.', ''));
      var s = parseInt($(this).closest('tr').find('.subtotal').val().replace(/,/g, ''));

      harga += h;
      qty += q;
      total += s;

      //subtotal
      var sub = (h * q) - ((h * q) * d / 100);
      $(this).closest('tr').find('.subtotal').val(number_format(sub));

    });

    //qty akhir
    $('#qty').val(qty);

    //ppn
    var ppn = Number($('#ppn').val()) * Number(total) / 100;
    var final = Number(ppn) + Number(total); 

    //total akhir
    $('#total').val(number_format(final));

    //border none
    $('td').css('border-top', 'none');

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
