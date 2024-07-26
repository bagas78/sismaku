<style type="text/css">
  .box-style{
    background: white;
    color: #999;
    border-width: 5px;
    border-style: solid;
    border-color: whitesmoke;
  }
  .box-style:hover{
    background: lightgrey;
  }
  .tit{
    max-width: fit-content;
    background: black; 
    padding: 0.5%;
    color: white;
  }
</style>
 
    <!-- Main content --> 
    <section class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4">
          <!-- small box -->
         <a href="<?=base_url('barang/telur')?>">
          <div class="small-box box-style" style="padding: 8px;">
            <div class="inner">
              <h3 style="font-size: 28px;"><?=number_format(@$telur_)?></h3>
 
              <p>Total Telur</p>
            </div>
            <div class="icon" style="top: -20px;">
              <img width="80" height="80" src="<?=base_url('assets/gambar/telur.png')?>">
            </div>
          </div>
        </a>
        </div> 
        <!-- ./col -->

        <div class="col-lg-4">
          <!-- small box -->
          <a href="<?=base_url('barang/pakan')?>">
            <div class="small-box box-style" style="padding: 8px;">
              <div class="inner">
                <h3 style="font-size: 28px;"><?=number_format(@$pakan_)?></h3>

                <p>Total Pakan</p>
              </div>
              <div class="icon" style="top: -20px">
                <img width="80" height="80" src="<?=base_url('assets/gambar/pakan.png')?>">
              </div>
            </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-4">
          <!-- small box -->
          <a href="<?=base_url('barang/obat')?>">
            <div class="small-box box-style" style="padding: 8px;">
              <div class="inner">
                <h3 style="font-size: 28px;"><?=number_format(@$obat_)?></h3>

                <p>Total Obat</p>
              </div>
              <div class="icon" style="top: -20px;">
                <img width="80" height="80" src="<?=base_url('assets/gambar/obat.png')?>">
              </div>
            </div>
          </div>
        </a>
        <!-- ./col -->
      </div>

      <div class="box">
        <div class="box-header with-border">

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      
          <h4 class="tit"><?=strtoupper('PEFORMA KARYAWAN '.date('M Y'))?></h4>

          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="100">Peringkat</th>
                <th>Nama</th>
                <th>Masuk</th>
                <th>Tidak Masuk</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($peforma as $value): ?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$value['nama']?></td>
                  <td><?=$value['masuk']?></td>
                  <td><?=$value['tidak']?></td>
                </tr>
              <?php $no++; ?>
              <?php endforeach ?>
            </tbody>
          </table>

        </div>
        <!-- /.box-body -->
      </div>