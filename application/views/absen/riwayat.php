<style type="text/css">
    .title{
        background: darkred;
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
             <div class="col-md-3">
               <input type="date" name="tanggal" class="form-control" required value="<?=$tanggal_?>">
            </div>
            <div class="col-md-1 row">
                 <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </form>

        <div class="clearfix"></div><hr>

        <h4 align="center" class="title">RIWAYAT ABSENSI <b><?=date('d/m/Y')?></b></h4>
          
          <table id="example" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Nama</th>
              <th>Jam</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

        </div>

        
      </div>
      <!-- /.box -->

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
                "url": "<?= base_url('absen/riwayat_get_data/'.$tanggal_); ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "karyawan_nama"},
                        { "data": "absen_jam",
                        "render": 
                        function( data ) {
                            if (data != null) {var a = data;}else{var a = '-';}
                            return "<span>"+a+"</span>";
                          }
                        },
                        { "data": "absen_status",
                        "render": 
                        function( data ) {
                            if (data == null) {var s = '-';}
                            if (data == 'masuk') {var s = '<span class="bg-success">'+data+'</span>';} 
                            if(data == 'tidak'){var s = '<span class="bg-danger">'+data+' masuk</span>';}
                            return "<span>"+s+"</span>";
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
</script>