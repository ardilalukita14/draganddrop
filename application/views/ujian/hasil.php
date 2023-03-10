<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4">
                <button type="button" onclick="reload_ajax()" class="btn bg-purple btn-flat btn-sm"><i class="fa fa-refresh"></i> Reload</button>
            </div>
        </div>
    </div>
    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="mytable" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th style="text-align: center">No.</th>
                <th style="text-align: center">Nama Mahasiswa</th>
                <th style="text-align: center">NIM</th>
                <!-- <th>Level</th> -->
                <th style="text-align: center">Total Poin</th>
                <th style="text-align: center">Hasil Ujian</th>
                <th style="text-align: center">Aksi</th>
                <!-- <th>Waktu</th>
                <th>Tanggal</th> -->
                <th class="text-center">
                    <i class="fa fa-search"></i>
                </th>
            </tr>   
            <?php 
                $no = 1;
                foreach($informasi as $u){ 
                    echo '
                <tr>
                    <td style="text-align: center">'.$no++.'</td>     
                    <td style="text-align: center">'.$u['nama'].'</td>
                    <td style="text-align: center">'.$u['nim'].'</td>
                    <td style="text-align: center">'.$u['total_poin'].'</td>
                    <td style="text-align: center">';
                    if ($u['total_poin'] >= "20"){
                        echo '
                        <div class="text-center">
                        <span class="badge bg-green">Sempurna!</span>
                    </div>
                            ';
                           }else if ($u['total_poin'] <= "0"){
                        echo '
                        <div class="text-center">
                        <span class="badge bg-red">Tingkatkan!</span>
                    </div>';
                           }else{
                        echo '
                        <div class="text-center">
                        <span class="badge bg-yellow">Cukup!</span>
                    </div>';
                           }
                        echo'
                        <td>
                        <div class="text-center">
                        <a class="btn btn-xs btn-warning" href="'.base_url().'hasilujian/detailLog/'.$u['iduser'].'">
                        <i class="fa fa-search"></i>
                        </a> 
                        </div>
                        </td>
                           </tr>';
                           ?>
                           <?php } ?>
            </thead>
        <tfoot>
            <tr>
            <th style="text-align: center">No.</th>
                <th style="text-align: center">Nama Mahasiswa</th>
                <th style="text-align: center">NIM</th>
                <!-- <th>Level</th> -->
                <th style="text-align: center">total Poin</th>
                <th style="text-align: center">Hasil Ujian</th>
                <th style="text-align: center">Aksi</th>
                <!-- <th>Waktu</th>
                <th>Tanggal</th> -->
                <th class="text-center">
                    <i class="fa fa-search"></i>
                </th>
            </tr>
        </tfoot>
        </table>
    </div>
</div>
<!-- 
<script src="<?=base_url()?>assets/dist/js/app/ujian/hasil.js"></script> -->

<script>
    //   $(document).ready(function(){
        // Setup datatables
    //     $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    //   {
    //       return {
    //           "iStart": oSettings._iDisplayStart,
    //           "iEnd": oSettings.fnDisplayEnd(),
    //           "iLength": oSettings._iDisplayLength,
    //           "iTotal": oSettings.fnRecordsTotal(),
    //           "iFilteredTotal": oSettings.fnRecordsDisplay(),
    //           "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
    //           "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    //       };
    //   };
 
    //   var table = $("#mytable").dataTable({
    //       initComplete: function() {
    //           var api = this.api();
    //           $('#mytable_filter input')
    //               .off('.DT')
    //               .on('input.DT', function() {
    //                   api.search(this.value).draw();
    //           });
    //       },
    //           oLanguage: {
    //           sProcessing: "loading..."
    //       },
    //           processing: true,
    //           serverSide: true,
    //           ajax: {"url": "<?php echo base_url().'hasilujian/get_datalog_json'?>", "type": "POST"},
    //                 columns: [
    //                     {"data": "nim"},
    //                     {"data": "first_name"},
    //                     {"data": "last_name"},
    //                     {"data": "total_poin"},
    //               ],
    //             order: [[1, 'asc']],
    //       rowCallback: function(row, data, iDisplayIndex) {
    //           var info = this.fnPagingInfo();
    //           var page = info.iPage;
    //           var length = info.iLength;
    //           $('td:eq(0)', row).html();
    //       }
 
    //   });
            // end setup datatables
    // });
</script>
    