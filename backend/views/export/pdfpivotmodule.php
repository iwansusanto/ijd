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
                <th class="cell-peran" rowspan="2">Nama Dosen</th>
                <?php foreach ($modules as $a=>$data): ?>
                <th class="cell-peran cell-center" colspan="2"><?= $data; ?></th>
                <?php endforeach; ?>
                <th class="cell-peran right" rowspan="2">Total</th>
            </tr>
            <tr>
                <?php foreach ($modules as $a=>$data): ?>
                    <th class="cell-peran right">Honor</th>
                    <th class="cell-peran right">Transport</th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php 
                  $total = 0;
                  $grandtotal = 0;
                  $grandtotal_honor_fakultas = 0;
                  $grandtotal_transport_fakultas = 0;
            ?>
            <?php foreach ($datas as $x=>$data): ?>
                <tr>
                    <td><?= $data['nama_dosen']; ?></td>
                    <?php foreach ($modules as $a=>$res): ?>
                    <td class="padd-5 right"><?= (isset($data['datas'][$a]['sum_honor']) ? Yii::$app->formatter->asRoundedCurrency($data['datas'][$a]['sum_honor'], 'Rp.'):0); ?></td>
                    <td class="padd-5 right"><?= (isset($data['datas'][$a]['sum_transport']) ? Yii::$app->formatter->asRoundedCurrency($data['datas'][$a]['sum_transport'], 'Rp.') : 0); ?></td>
                    <?php endforeach; ?>
                    <td class="padd-5 right"><?= Yii::$app->formatter->asRoundedCurrency($data['total'], 'Rp.'); ?></td>
                </tr>   
                <?php $grandtotal += $data['total']; ?>
            <?php endforeach; ?>
            <?php 
                echo '<tr>';
                    echo '<td class="padd-5 total-row"><strong>Grand Total</strong></td>';
                    foreach ($grandTotal as $data):
                        echo '<td class="right padd-5 total-row"><strong>'.Yii::$app->formatter->asRoundedCurrency($data['grand_total_honor'], 'Rp.').'</strong></td>';
                        echo '<td class="right padd-5 total-row"><strong>'.Yii::$app->formatter->asRoundedCurrency($data['grand_total_transport'], 'Rp.').'</strong></td>';
                    endforeach;
                    echo '<td class="right padd-5 total-row"><strong>'.Yii::$app->formatter->asRoundedCurrency($grandtotal, 'Rp.').'</strong></td>';
                echo '</tr>';
            ?>                           
        </tbody>
    </table>
</div>