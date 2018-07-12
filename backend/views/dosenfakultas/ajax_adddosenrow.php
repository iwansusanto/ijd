<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo '<div class="row row-dosen" id="cd-'.$count.'" data-count="'.$count.'">';

    echo '<div class="col-md-4">';

        echo '<div class="form-group field-dosenfakultas-'.$count.'-dosen_id required">';

            echo \yii\helpers\Html::label('Dosen', 'DosenFakultas['.$count.'][dosen_id]', []);

            echo \kartik\select2\Select2::widget([
                                    'name' => 'DosenFakultas['.$count.'][dosen_id]',
                                    'data' => yii\helpers\ArrayHelper::map($dosen, 'id', 'nama'),
                                    'options' => [
                                        'placeholder' => 'Select Dosen',
                                        'id'    =>  'dosenfakultas-'.$count.'-dosen_id'
                                        ],
                                    'pluginOptions' =>  [
                                        'allowClear' => true
                                    ]
                                ]);
            
            echo '<div class="help-block"></div>';
        echo '</div>'; // end form-group

    echo '</div>'; // end col-md-4
    
    echo '<div class="col-md-4">';
        
        echo '<div class="form-group field-dosenfakultas-'.$count.'-fakultas_id required">';

            echo \yii\helpers\Html::label('Fakultas', 'DosenFakultas['.$count.'][fakultas_id]', []);

            echo \kartik\select2\Select2::widget([
                                    'name' => 'DosenFakultas['.$count.'][fakultas_id]',
                                    'data' => yii\helpers\ArrayHelper::map($fakultas, 'id', 'nama'),
                                    'options' => [
                                        'placeholder' => 'Select Fakultas',
                                        'id'    =>  'dosenfakultas-'.$count.'-fakultas_id'
                                        ],
                                    'pluginOptions' =>  [
                                        'allowClear' => true
                                    ]
                                ]);

            echo '<div class="help-block"></div>';
        echo '</div>'; // end form-group
        
    echo '</div>'; // end col-md-4
    
    echo '<div class="col-md-4">';
    
        echo \yii\helpers\Html::button('Delete', [
                    'class' =>  'btn btn-danger btn-delete',
                    'style' =>  'margin: 25px; 0px; 0px; 30px;'
            ]);
        
    echo '</div>'; // end col-md-4

echo '</div>'; // end row-dosen