<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div>
    <table class="table-peran">
        <thead>
            <tr>
                <th class="cell-peran">Nama</th>
                <th class="cell-peran">Modul</th>
                <th class="cell-peran">Peran</th>
                <th class="cell-peran">Tgl Kegiatan</th>
                <th class="cell-peran">Nama Kelas</th>
                <th class="cell-peran">Induk Fak</th>
                <th class="cell-peran">Ruang</th>
                <th class="cell-peran">Jam Mulai</th>
                <th class="cell-peran">Jam Selesai</th>
                <th class="cell-peran">Jumlah Jam</th>
                <th class="cell-peran">Honor Diterima</th>
            </tr>
        </thead>
        <tbody>
            <?php $nama_dosen = '';
                  $nama_modul = '';
                  $nama_peran = '';
                  $tgl_kegiatan = '';
                  $nama_kelas = '';
                  $nama_fakultas = '';
                  $nama_ruang = '';
                  $grandtotal_honor_dosen = 0;
                  $grandtotal_jam_rumus_dosen = 0;
            ?>
            <?php foreach ($datas as $a=>$data): ?>
            <?php 
                  $total_honor_dosen = 0;
                  $total_jam_rumus_dosen = 0;
            ?>
                <?php foreach ($data['datas'] as $b=>$moduls): ?>
                    <?php foreach ($moduls['datas'] as $c=>$perans): ?>
                        <?php foreach ($perans['datas'] as $d=>$tgls): ?>
                            <?php foreach ($tgls['datas'] as $e=>$kelass): ?>
                                <?php foreach ($kelass['datas'] as $f=>$fakultass): ?>  
                                    <?php foreach ($fakultass['datas'] as $g=>$ruangs): ?>
                                        <?php foreach ($ruangs['datas'] as $h=>$res): ?>
                                            <tr>
                                                <td class="padd-5"><?= ($data['nama_dosen'] != $nama_dosen) ? $data['nama_dosen'] : ''; ?></td>
                                                <td class="padd-5"><?= ($moduls['nama_module'] != $nama_modul) ? $moduls['nama_module'] : ''; ?></td>
                                                <td class="padd-5"><?= ($perans['nama_peran'] != $nama_peran) ? $perans['nama_peran'] : ''; ?></td>
                                                <td class="padd-5"><?= ($tgls['tgl_kegiatan'] != $tgl_kegiatan) ? Yii::$app->is->tanggalIndonesia($tgls['tgl_kegiatan']) : ''; ?></td>
                                                <td class="padd-5"><?= ($kelass['nama_kelas'] != $nama_kelas) ? $kelass['nama_kelas'] : ''; ?></td>
                                                <td class="padd-5"><?= ($fakultass['nama_fakultas'] != $nama_fakultas) ? $fakultass['nama_fakultas'] : ''; ?></td>
                                                <td class="padd-5"><?= ($ruangs['nama_ruangan'] != $nama_ruang) ? preg_replace("/\([^)]+\)/", "", $ruangs['nama_ruangan']) : ''; ?></td>
                                                <td class="padd-5"><?= $res['jam_mulai']; ?></td>
                                                <td class="padd-5"><?= $res['jam_selesai']; ?></td>
                                                <td class="right padd-5"><?= $res['jumlah_jam_rumus']; ?></td>
                                                <td class="right padd-5"><?= Yii::$app->formatter->asRoundedCurrency($res['honor'], 'Rp.'); ?></td>
                                            </tr>
                                            
                                        <?php $nama_dosen = $data['nama_dosen'];
                                              $nama_modul = $moduls['nama_module'];
                                              $nama_peran = $perans['nama_peran'];
                                              $tgl_kegiatan = $tgls['tgl_kegiatan'];
                                              $nama_kelas = $kelass['nama_kelas'];
                                              $nama_fakultas = $fakultass['nama_fakultas'];
                                              $nama_ruang = $ruangs['nama_ruangan'];
                                              $total_honor_dosen+=$res['honor'];
                                              $total_jam_rumus_dosen+=$res['jumlah_jam_rumus'];
                                              $grandtotal_honor_dosen+=$res['honor'];
                                              $grandtotal_jam_rumus_dosen+=$res['jumlah_jam_rumus'];
                                        ?>     
                                        <?php endforeach; ?>
                                        
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php 
                echo '<tr>';
                    echo '<td colspan="9" class="padd-5 total-row"><strong>'.$data["nama_dosen"].'&nbsp;Total</strong></td>';
                    echo '<td class="right padd-5 total-row"><strong>'.$total_jam_rumus_dosen.'</strong></td>';
                    echo '<td class="right padd-5 total-row"><strong>'.Yii::$app->formatter->asRoundedCurrency($total_honor_dosen, 'Rp.').'</strong></td>';
                echo '</tr>';
            ?>                               
            <?php endforeach; ?>
            <?php 
                echo '<tr>';
                    echo '<td colspan="9" class="padd-5 total-row"><strong>Grand Total</strong></td>';
                    echo '<td class="right padd-5 total-row"><strong>'.$grandtotal_jam_rumus_dosen.'</strong></td>';
                    echo '<td class="right padd-5 total-row"><strong>'.Yii::$app->formatter->asRoundedCurrency($grandtotal_honor_dosen, 'Rp.').'</strong></td>';
                echo '</tr>';
            ?>                                   
        </tbody>
    </table>
</div>