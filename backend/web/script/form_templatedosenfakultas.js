/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var template = {
    init: function(){
        this.delete();
        this.adddosen();
        this.formsubmit();
    },
    delete: function(){
        $('.btn-delete').unbind('click');
        $('.btn-delete').on('click', function(){
            $(this).closest('.row-dosen').remove();
        });
    },
    adddosen: function(){
        $('.add-dosen').on('click', function(){
            var count_row = $('.wrapper-dosen').find('.row-dosen:last').data('count');
            var btn = $(this);
                    
            $.ajax({
                type: 'POST',
                url: _baseUrl+"/dosenfakultas/adddosenrow",
                dataType: 'html',
                beforeSend: function(){
                    btn.button('loading');
                    $('.btn-save').prop('disabled', true);
                },
                data: {count: count_row+1},
                success: function(data){
                    $('.wrapper-dosen').append(data);
                    btn.button('reset');
                    $('.btn-save').prop('disabled', false);
                    template.delete();
                },
                error: function(data){
                    btn.button('reset');
                    $('.btn-save').prop('disabled', false);
                }
            });
        });
    },
    formsubmit: function(){
        
        $('#form-dosenfakultas').on('beforeSubmit', function(e) {
            var form = $(this);
            var formData = form.serialize();
            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: formData,
                success: function (data) {
                    alert('Test');
                },
                error: function () {
                    alert("Something went wrong");
                }
            });
        }).on('submit', function(e){
            e.preventDefault();
        });
    }
};

$(document).ready(function(){
    template.init();
});
