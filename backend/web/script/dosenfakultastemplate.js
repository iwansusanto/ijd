/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var dosenfakultastemplate = {
    init: function(){
        this.clickLanjut();
    },
    clickLanjut: function(){
        $("#btn-lanjut").on('click', function(){
            
            var semester_id, tahun_ajaran_id;
            var datas = [];
            
            semester_id = $("select[name='semester_id']").select2("data")[0].id;
            tahun_ajaran_id = $("select[name='tahun_ajaran_id']").select2("data")[0].id;
            datas = {
                'semester_id': semester_id,
                'tahun_ajaran_id': tahun_ajaran_id};
           
            if(semester_id.length > 0 && tahun_ajaran_id.length > 0 ){
               
                $.ajax({
                        type    : "POST",
                        url     : _baseUrl+"sessiontemplate",
                        data    : datas,
                        success : function(data){
                            console.log(data);
                            window.location.replace(data.url_redirect);
                        },
                        error   : function(data){
                            console.log(data);
                        }
                    });
            } else {
                if(semester_id.length == '0'){
                    alert('Semester template tidak boleh kosong');
                } else if(tahun_ajaran_id.length == '0'){
                    alert('Tahun Ajaran template tidak boleh kosong');
                } else {
                    alert('Tahun Ajaran dan Semester template tidak boleh kosong');
                }
                
            }
        });
    }
};

$(document).ready(function(){
    dosenfakultastemplate.init();
});