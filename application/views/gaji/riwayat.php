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
          
          <table id="example" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Nama</th>
              <th>Nominal</th>
              <th>Tanggal</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

          <hr>

          <table class="table table-bordered">
            <tr style="background: aliceblue;">
                <td><b>BULAN</b></td>
                <td><b><?= date_format(date_create(date($bulan_)) ,'M Y'); ?></b></td>
            </tr>
            <tr style="background: cornsilk;">
                <td><b>TOTAL</b></td>
                <td><b id="total"></b></td>
            </tr>
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
                "url": "<?= base_url('gaji/riwayat_get_data/'.$bulan_); ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "karyawan_nama"},
                        { "data": "gaji_nominal",
                        "render": 
                        function( data ) {
                            return "Rp. <span class='nominal'>"+number_format(data)+"</span>";
                          }
                        },
                        { "data": "gaji_tanggal",
                        "render": 
                        function( data ) {
                            if (data == null) {var t = '-';}else{var t = moment(data).format("DD/MM/YYYY");}
                            return "<span class='pelunasan'>"+t+"</span>";
                          }
                        },
                        
                    ],
        });

    });

function filter(){
    var gudang = $('#kandang').val();

    var table = $('#example').DataTable();
    table.search(gudang).draw();
}

//total
$(document).ready(function () {
    
    var t = $('#example').DataTable();

    t.on( 'draw', function () {
        
        var sum = 0;
        $.each($('.nominal'), function(index, val) {
            
            var val = parseInt($(this).text().replace(',',''));
            sum += val;
        });

        $('#total').text('Rp. '+number_format(sum));

    });
})

</script>