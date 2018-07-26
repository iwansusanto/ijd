<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mpdf->SetHeader('Kartik Header'); // call methods or set any properties
$mpdf->WriteHtml('<div>Ce3k</div>'); // call mpdf write html
echo $mpdf->Output('filename', 'I'); // call the mpdf api output as needed