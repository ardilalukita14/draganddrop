<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">DataTables</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">DataTables</li>
                </ol>
            </div>
            <div class="page-content fade-in-up" style="width: 100%;">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Data Table</div>
                    </div>
    <!-- <div class="box-body">
        <div class="mt-2 mb-3">
            <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat bg-purple" style="color: #fff; margin-left: 20px;"><i class="fa fa-refresh" style="color: #fff;"></i> Reload</button>
            <div class="pull-right" style="margin-right: 20px;">
                <label for="show_me">
                    <input type="checkbox" id="show_me">
                    Tampilkan saya
                </label>
            </div>
        </div>
    </div> -->
    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="level" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Level</th>
                <th>Sub Soal</th>
                <th>Soal</th>
                <th>Poin</th>
                <th>Hasil Ujian</th>
                <!-- <th>Waktu</th>
                <th>Tanggal</th> -->
                <th class="text-center">
                    <i class="fa fa-search"></i>
                </th>
            </tr>   
            <?php 
                $no = 1;
                foreach($detail as $u){ 
                    echo '
                <tr>
                    <td style="text-align: center">'.$no++.'</td>     
                    <td style="text-align: center">'.$u['nama'].'</td>
                    <td style="text-align: center">'.$u['nim'].'</td>
                    <td style="text-align: center">'.$u['levels'].'</td>
                    <td style="text-align: center">'.$u['sub_soal'].'</td>
                    <td style="text-align: justify">'.$u['studi_kasus'].'</td>
                    <td style="text-align: center">'.$u['poin'].'</td>
                    <td style="text-align: center">';
                    if ($u['poin'] == "20"){
                        echo '
                        <div class="text-center">
                        <span class="badge bg-green">Sempurna!</span>
                    </div>
                            ';
                           }else if ($u['poin'] <= "0"){
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
                           </td>
                           </tr>';?>
                           <?php } ?>
            </thead>
        <tfoot>
            <tr>
                <th>No.</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Level</th>
                <th>Sub Soal</th>
                <th>Soal</th>
                <th>Poin</th>
                <th>Hasil Ujian</th>
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