</div>
</div>

<!-- ./wrapper -->
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script> 
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>adminLTE/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url() ?>adminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url() ?>adminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url() ?>adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>adminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url() ?>adminLTE/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes --> 
<script src="<?php echo base_url() ?>adminLTE/dist/js/demo.js"></script>

<!-- ChartJS -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/chart/Chart.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>adminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- FLOT CHARTS -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/Flot/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/Flot/jquery.flot.pie.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/Flot/jquery.flot.categories.js"></script>
<!-- Page script -->

<!-- Select2 -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>

<script src="<?php echo base_url() ?>adminLTE/bower_components/ckeditor/ckeditor.js"></script>

<!--button datatable-->
<script type="text/javascript" src="<?php echo base_url() ?>adminLTE/bower_components/button/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>adminLTE/bower_components/button/jszip.min.js"></script>

<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>adminLTE/bower_components/button/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>adminLTE/bower_components/button/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>adminLTE/bower_components/button/buttons.print.min.js"></script>

<script>

  //alert
  <?php if(@$this->session->flashdata('success')): ?>
  swal("Sukses", "<?php echo $this->session->flashdata('success');?>", "success");
  $('.swal-footer').remove();
  <?php endif ?>

  <?php if(@$this->session->flashdata('gagal')): ?>
  swal("Gagal", "<?php echo $this->session->flashdata('gagal'); ?>", "warning");
  $('.swal-footer').remove();
  <?php endif ?>



  $(function () {
     //Select2
    $('.select2').select2()
  });
  
  
//data table
  $(function () {

    //data table
    $('#example1').DataTable({
        'autoWidth'   : true,
        'paging'      : false,
        'responsive'  : true,
        'scrollX'     : true,
    })
    $('#example2').DataTable({
      dom: 'Blfrtip',
       lengthMenu: [[10, 25, 50,100,200,300,400], [10, 25, 50,100,200,300,400]],
       buttons: [
           'copy', 'excel', 'pdf', 'print'
       ],
       'lengthChange': false,
       'autoWidth'   : false,
       'scrollX'     : true,
       'ordering'    : false,
    })
  })

//Date range picker
$('#reservation').daterangepicker();


function showTime() {
    var a_p = "";
    var today = new Date();
    var curr_hour = today.getHours();
    var curr_minute = today.getMinutes();
    var curr_second = today.getSeconds();
    
    if (curr_hour == 0) {
        curr_hour = 24;
    }
    if (curr_hour > 24) {
        curr_hour = curr_hour - 24;
    }
    curr_hour = checkTime(curr_hour);
    curr_minute = checkTime(curr_minute);
    curr_second = checkTime(curr_second);
 document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute;
    }

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
setInterval(showTime, 500);

//warning
function warning(text){
    swal("Gagal", text, "warning");
    $('.swal-footer').remove();
}

//delete
function del(url){
  swal({
    title: "Apa kamu yakin?",
    text: "Hapus data ini ?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {

      $(location).attr('href',url);
      
    }
  });
}

//logout
function logout(url){
  swal({
    title: "Yakin akan keluar",
    text: "dari aplikasi ?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {

      $(location).attr('href',url);
      
    }
  });
}

//active menu
$(document).ready(function() {
    var url = window.location; 
    var element = $('ul.sidebar-menu a').filter(function() {
    return this.href == url || url.href.indexOf(this.href) == 0; }).parent().addClass('active');
    if (element.is('li')) { 
         element.addClass('active').parent().parent('li').addClass('active')
     }
});


//loader
// $(document).on("click", "a" , function() {
//     var href = $(this).attr('href');

//     if (href) {

//         if (href != '#') {

//             $('#loader').css('display', '');
//         }
//     }

// });

// $(document).on("click", ":submit" , function() {
      
//     $('#loader').css('display', '');
// });

//Date range picker
$('#reservation').daterangepicker();
$("#reservation").val('-- Tanggal --');

function refresh(){
    location.reload();
}

</script>

</body>
</html>


