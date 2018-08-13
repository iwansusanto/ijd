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
                <th class="cell-peran">Induk Fakultas</th>
                <th class="cell-peran">Nama</th>
                <th class="cell-peran">Modul</th>
                <th class="cell-peran">Peran</th>
                <th class="cell-peran">Tgl Kegiatan</th>
                <th class="cell-peran">Honor Diterima</th>
                <th class="cell-peran">Transport Diterima</th>
            </tr>
        </thead>
        <tbody>
            <?php $nama_fakultas = '';
                  $nama_dosen = '';
                  $nama_modul = '';
                  $nama_peran = '';
                  $tgl_kegiatan = '';
                  $grandtotal_honor_fakultas = 0;
                  $grandtotal_transport_fakultas = 0;
            ?>
            <?php foreach ($datas as $a=>$data): ?>
            <?php 
                  $total_honor_fakultas = 0;
                  $total_transport_fakultas = 0;
            ?>
                <?php foreach ($data['datas'] as $b=>$dosens): ?>
                    <?php foreach ($dosens['datas'] as $c=>$modules): ?>
                        <?php foreach ($modules['datas'] as $d=>$perans): ?>
                            <?php foreach ($perans['datas'] as $e=>$tgls): ?>
                                <?php foreach ($tgls['datas'] as $f=>$res): ?>
                                    <tr>
                                        <td class="padd-5"><?= ($data['nama_fakultas'] != $nama_fakultas) ? $data['nama_fakultas'] : ''; ?></td>
                                        <td class="padd-5"><?= ($dosens['nama_dosen'] != $nama_dosen) ? $dosens['nama_dosen'] : ''; ?></td>
                                        <td class="padd-5"><?= ($modules['nama_module'] != $nama_modul) ? $modules['nama_module'] : ''; ?></td>
                                        <td class="padd-5"><?= ($perans['nama_peran'] != $nama_peran) ? $perans['nama_peran'] : ''; ?></td>
                                        <td class="padd-5"><?= ($tgls['tgl_kegiatan'] != $tgl_kegiatan) ? Yii::$app->is->tanggalIndonesia($tgls['tgl_kegiatan'])  : ''; ?></td>
                                        <td class="right padd-5"><?= Yii::$app->formatter->asRoundedCurrency($res['honor'], 'Rp.'); ?></td>
                                        <td class="right padd-5"><?= Yii::$app->formatter->asRoundedCurrency($res['transport'], 'Rp.'); ?></td>
                                    </tr>
                                <?php $nama_fakultas = $data['nama_fakultas'];
                                      $nama_dosen = $dosens['nama_dosen'];
                                      $nama_modul = $modules['nama_module'];
                                      $nama_peran = $perans['nama_peran'];
                                      $tgl_kegiatan = $tgls['tgl_kegiatan'];
                                      
                                      $total_honor_fakultas+=$res['honor'];
                                      $total_transport_fakultas+=$res['transport'];
                                      $grandtotal_honor_fakultas+=$res['honor'];
                                      $grandtotal_transport_fakultas+=$res['transport'];
                                ?>               
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
           <?php 
                echo '<tr>';
                    echo '<td colspan="5" class="padd-5 total-row"><strong>'.$data["nama_fakultas"].'&nbsp;Total</strong></td>';
                    echo '<td class="right padd-5 total-row"><strong>'.Yii::$app->formatter->asRoundedCurrency($total_honor_fakultas, 'Rp.').'</strong></td>';
                    echo '<td class="right padd-5 total-row"><strong>'.Yii::$app->formatter->asRoundedCurrency($total_transport_fakultas, 'Rp.').'</strong></td>';
                echo '</tr>';
            ?>                            
            <?php endforeach; ?>
            <?php 
                echo '<tr>';
                    echo '<td colspan="5" class="padd-5 total-row"><strong>Grand Total</strong></td>';
                    echo '<td class="right padd-5 total-row"><strong>'.Yii::$app->formatter->asRoundedCurrency($grandtotal_honor_fakultas, 'Rp.').'</strong></td>';
                    echo '<td class="right padd-5 total-row"><strong>'.Yii::$app->formatter->asRoundedCurrency($grandtotal_transport_fakultas, 'Rp.').'</strong></td>';
                echo '</tr>';
            ?>                           
        </tbody>
    </table>
</div>