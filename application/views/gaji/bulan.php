<style type="text/css">
    .title{
        background: black;
        color: white;
        padding: 1%;
    }
</style>

    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

        <div align="left"><br/></div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

         <form method="POST" action="">
            <div class="col-md-3 row">
               <input type="month" name="bulan" class="form-control" required value="<?=@$bulan_?>">
            </div>
            <div class="col-md-1">
                 <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </form>

        <div class="clearfix"></div><hr/>

        <h4 align="center" class="title"><b><?= $v = date_format(date_create(date($bulan_)) ,'M Y'); ?></b></h4>
          
          <table id="example" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Nama</th>
              <th>Upah Total</th>
              <th>Upah Lunas</th>
              <th>Upah Sisa</th>
              <th width="30">Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

        </div>

        
      </div>
      <!-- /.box -->

<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: lavender;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">PEMBAYARAN GAJI KARYAWAN</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="box-body" style="padding: 10px;">
            <div class="form-group">
              <label>Tanggal Pelunasan</label>
              <input required="" type="date" name="tanggal" class="form-control" value="<?=date('Y-m-d')?>">
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea required="" type="text" name="keterangan" class="form-control"></textarea>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit <i class="fa fa-check"></i></button>
             <button type="reset" class="btn btn-danger">Reset <i class="fa fa-times"></i></button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script type="text/javascript">
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#example').DataTable({ 

            "responsive"  : true,
            "scrollX"     : true,
            "processing"  : true, 
            "serverSide"  : true,
            "order"       :[],  
            
            "ajax": {
                "url": "<?= base_url('gaji/get_data/'.$bulan_); ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "nama"},
                        { "data": "total",
                        "render": 
                        function( data ) {
                            return "<span> Rp. "+number_format(data)+"</span>";
                          }
                        },
                        { "data": "lunas",
                        "render": 
                        function( data ) {
                            return "<span> Rp. "+number_format(data)+"</span>";
                          }
                        },
                        { "data": "sisa",
                        "render": 
                        function( data ) {
                            return "<span class='sisa'> Rp. "+number_format(data)+"</span>";
                          }
                        },
                        { "data": "id",
                        "render": 
                        function( data ) {
                            return "<button onclick=bayar('"+data+"') class='btn btn-xs btn-success'>Bayar <i class='fa fa-check-square-o'></i></button>";
                          }
                        }
                        
                    ],
        });

    });

function filter(){
    var gudang = $('#kandang').val();

    var table = $('#example').DataTable();
    table.search(gudang).draw();
}

function bayar(id){

    $('.modal').modal('toggle');
    $('form').attr('action', '<?=base_url('gaji/bayar/')?>'+id);
}
</script>