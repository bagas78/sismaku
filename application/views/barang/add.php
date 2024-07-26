
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         
          <form class="bg-alice" action="<?=base_url('barang/save/'.@$kategori)?>" method="POST" accept-charset="utf-8">
            
            <!--hidden-->
            <input type="hidden" name="kategori" value="<?=@$kategori_id?>" class="kategori">

            <div class="row">
              <div class="col-lg-6">

                <div class="form-group">
                  <label>Kode</label>
                  <input readonly="" type="text" name="kode" class="kode form-control" required value="<?=@$kode?>">
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="nama form-control" required>
                </div>
                <div class="form-group">
                  <label>Satuan</label>
                  <select name="satuan" class="satuan form-control" required>
                    <option value="" hidden>-- Pilih --</option>
                    <option value="kg">Kg</option>
                    <option value="ekor">Ekor</option>
                    <option value="pcs">Pcs</option>
                    <option value="tray">Tray</option>
                  </select>
                </div>

              </div>
            </div>

            <br/>

            <button type="submit" class="btn btn-success">Simpan <i class="fa fa-check"></i></button>
            <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>

          </form>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">
  //$('.satuan').val('<?=@$satuan?>').change().css('pointer-events', 'none');
</script>