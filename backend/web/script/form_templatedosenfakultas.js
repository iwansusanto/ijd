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
            var count_row = $('.wrapper-dosen').find('.row-dosen').length;
            
            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: formData,
                success: function (data) {
                    template.clearformerror(count_row);
                    window.location.replace(data.url_redirect);
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    
                    template.clearformerror(count_row);
                    
                    $.each(errors, function(key, val){
                        $(".field-"+key).addClass('has-error');
                        $(".field-"+key).find('.help-block').html(val[0]);
                    });
                }
            });
            return false; // prevent default submit
        }).on('submit', function(e){
            e.preventDefault();
        });
    },
    clearformerror: function(count){
        for(var i = 0; i < count; i++){
            $(".field-dosenfakultas-"+i+"-fakultas_id").removeClass('has-error');
            $(".field-dosenfakultas-"+i+"-fakultas_id").find('.help-block').html("");

            $(".field-dosenfakultas-"+i+"-dosen_id").removeClass('has-error');
            $(".field-dosenfakultas-"+i+"-dosen_id").find('.help-block').html("");
        };
    }
};

$(document).ready(function(){
    template.init();
});
