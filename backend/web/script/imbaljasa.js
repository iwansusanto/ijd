/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var editIndex = undefined;
var clickCell = undefined;

var imbaljasa = {
    form: function(moduletahunajaranid, editIndex){
        var id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'id'}),
            nip = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'nip'}),
            transaksi_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'transaksi_id'}),    
            dosen_fakultas_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'dosen_fakultas_id'}),
            nama_fakultas = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'nama_fakultas'}),
            nip_digantikan = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'nip_digantikan'}),
            dosen_fakultas_id_digantikan = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'dosen_fakultas_id_digantikan'}),
            nama_fakultas_digantikan = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'nama_fakultas_digantikan'}),
            module_tahun_ajaran_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'module_tahun_ajaran_id'}),
            kelas_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'kelas_id'}),
            ruangan_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'ruangan_id'}),
            tgl_kegiatan = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'tgl_kegiatan'}),
            jam_mulai = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'jam_mulai'}),
            jam_selesai = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'jam_selesai'}),
            peran_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'peran_id'}),
            jumlah_jam_rumus = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'jumlah_jam_rumus'}),
            transport = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'transport'}),
            honor = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'honor'}),
            keterangan = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'keterangan'}),
            peran_hitung_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'peran_hitung_id'});
        
        var datas = []; 
        
            datas = {
                        'id':$.trim($(id.target)[id.type]('getValue')),
                        'nip':$.trim($(nip.target)[nip.type]('getValue')),
                        'transaksi_id':$(transaksi_id.target)[transaksi_id.type]('getValue'),
                        'dosen_fakultas_id':$.trim($(dosen_fakultas_id.target)[dosen_fakultas_id.type]('getValue')),
                        'nama_fakultas':$(nama_fakultas.target)[nama_fakultas.type]('getValue'),
                        'nip_digantikan':$.trim($(nip_digantikan.target)[nip_digantikan.type]('getValue')),
                        'dosen_fakultas_id_digantikan':$.trim($(dosen_fakultas_id_digantikan.target)[dosen_fakultas_id_digantikan.type]('getValue')),
                        'nama_fakultas_digantikan':$(nama_fakultas_digantikan.target)[nama_fakultas_digantikan.type]('getValue'),
                        'module_tahun_ajaran_id':$(module_tahun_ajaran_id.target)[module_tahun_ajaran_id.type]('getValue'),
                        'kelas_id':$(kelas_id.target)[kelas_id.type]('getValue'),
                        'ruangan_id':$(ruangan_id.target)[ruangan_id.type]('getValue'),
                        'tgl_kegiatan':$(tgl_kegiatan.target)[tgl_kegiatan.type]('getValue'),
                        'jam_mulai':$(jam_mulai.target)[jam_mulai.type]('getValue'),
                        'jam_selesai':$(jam_selesai.target)[jam_selesai.type]('getValue'),
                        'peran_id':$(peran_id.target)[peran_id.type]('getValue'),
                        'jumlah_jam_rumus':$(jumlah_jam_rumus.target)[jumlah_jam_rumus.type]('getValue'),
                        'transport':$(transport.target)[transport.type]('getValue'),
                        'honor':$(honor.target)[honor.type]('getValue'),
                        'keterangan':$(keterangan.target)[keterangan.type]('getValue'),
                        'peran_hitung_id':$(peran_hitung_id.target)[peran_hitung_id.type]('getValue')};    
            
            $.ajax({
                type: "POST",
                url: _baseUrl+"/transaksi/save",
                data: { ImbalJasa: datas },
                success: function(data){
                    console.log(data);
                    $("#btn-add").prop("disabled", false);
                    $("#btn-cancel").prop("disabled", true);
                    $("#btn-save").prop("disabled", true);
                    $("#btn-delete").prop("disabled", true);
                },
                error: function(result){
                    var errors = result.responseJSON.message;
                    console.log(errors);
                    $.each(errors, function(index, value){
                        $(eval(index).target).closest('td[field="'+index+'"]').attr({
                            'title': value,
                            'data-toggle':    'tooltip',
                            'data-placement':   'top'
                        }).tooltip('show');
                    });
                }
            }); 
    },
    endEditing: function(moduleid, moduletahunajaranid){
        
//        var ed_module_id = $('#dg'+moduleid).datagrid('getEditor', {index: editIndex, field: 'module_id'});
//        $(ed_module_id.target).textbox('setValue',moduleid);
        if (editIndex == undefined){return true}
        
        if ($('#dg' + moduletahunajaranid).datagrid('validateRow', editIndex)) {
//            $('#tt').tooltip({
//                content: 'This is the tooltip message.'
//            });
            var ed_transaksi_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'transaksi_id'});
            if(ed_transaksi_id !== null){
                $(ed_transaksi_id.target).textbox('setValue', imbaljasa.urlparam('id'));
                
                // validate and save form
                imbaljasa.form(moduletahunajaranid, editIndex); 

                $('#dg' + moduletahunajaranid).datagrid('endEdit', editIndex);
                setTimeout(function(){
                    editIndex = undefined;
    //                    $('#dg'+moduletahunajaranid).datagrid('reload');
                },0);
            };

            return true;
        } else {
            return false;
        }
    },
    onClickCell: function(index, field){
        var moduleid = $('#tt').tabs('getSelected')[0].dataset.moduleid;
        var moduletahunajaranid = $('#tt').tabs('getSelected')[0].dataset.moduletahunajaranid;
        
        if (editIndex != index){
            if (imbaljasa.endEditing(moduleid, moduletahunajaranid)){
                $('#dg'+moduletahunajaranid).datagrid('selectRow', index)
                        .datagrid('beginEdit', index);
                var ed = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:index,field:field}),
                    ed_kelas_id_show = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: index, field: 'kelas_id_show'}),
                    url = _baseUrl+'/transaksi/jsonlihatkelas?module_id='+moduleid;
                
                if (ed){
                    ($(ed.target).data('textbox') ? $(ed.target).textbox('textbox') : $(ed.target)).focus();
                };    

                $(ed_kelas_id_show.target).combobox('reload',url);
                
                editIndex = index;
            } else {
                setTimeout(function(){
                    $('#dg'+moduletahunajaranid).datagrid('selectRow', editIndex);
                },0);
            }
        };
        
        $("#btn-add").prop("disabled", true);
        $("#btn-cancel").prop("disabled", false);
        $("#btn-save").prop("disabled", false);
        $("#btn-delete").prop("disabled", false);
    },
    onEndEdit: function (index, row) {
        var moduletahunajaranid = $('#tt').tabs('getSelected')[0].dataset.moduletahunajaranid;
//        var ed = $(this).datagrid('getEditor', {
//            index: index,
//            field: 'nip'
//        });
//        row.nip = $(ed.target).combobox('getText');
        $('#dg'+moduletahunajaranid).datagrid('reload');
        console.log('end to reload grid');
    },
    append: function (moduleid, moduletahunajaranid) {
        console.log('append : '+moduleid);    
        if (imbaljasa.endEditing(moduleid, moduletahunajaranid)) {
            
            var ed_module_tahun_ajaran_id,
                ed_kelas_id_show,
                ed_tgl_kegiatan,
                bulan_tahun = new Date($("#bulan_tahun").val()),
                bulan = bulan_tahun.getMonth(),
                tahun = bulan_tahun.getFullYear(),
                url = _baseUrl+'/transaksi/jsonlihatkelas?module_id='+moduleid;
            
            $('#dg'+moduletahunajaranid).datagrid('appendRow', {});
            editIndex = $('#dg'+moduletahunajaranid).datagrid('getRows').length - 1;
            $('#dg'+moduletahunajaranid).datagrid('selectRow', editIndex)
                    .datagrid('beginEdit', editIndex);
            
            ed_module_tahun_ajaran_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'module_tahun_ajaran_id'});
            ed_kelas_id_show = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'kelas_id_show'});            
            ed_tgl_kegiatan = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'tgl_kegiatan'});            
            
            $(ed_module_tahun_ajaran_id.target).textbox('setValue', moduletahunajaranid);
            $(ed_kelas_id_show.target).combobox('reload',url);
            
            $(ed_tgl_kegiatan.target).datebox().datebox('calendar').calendar({
                validator: function (date) {
                    var d1 = new Date(tahun, bulan, 1);
                    var d2 = new Date(tahun, bulan+1, 0);
                    return d1 <= date && date <= d2;
                }
            });
            $(ed_tgl_kegiatan.target).datebox('setValue', (bulan+1)+'/01/'+tahun);	// set datebox value
        }
    },
    removeit: function (moduleid, moduletahunajaranid) {
        if (editIndex == undefined) {
            return;
        }
        
                    
        var datas = [],
            id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index:editIndex, field:'id'});
    
            datas = {'id':$.trim($(id.target)[id.type]('getValue'))}; 
        
        
        $.ajax({
                type: "POST",
                url: _baseUrl+"/transaksi/delete",
                data: { ImbalJasa: datas },
                success: function(data){
                    console.log(data);
                    imbaljasa.showMessage('Sukses', data.message);
                    
                    $('#dg'+moduletahunajaranid).datagrid('cancelEdit', editIndex)
                            .datagrid('deleteRow', editIndex);
                    editIndex = undefined;
                    
                    $("#btn-add").prop("disabled", false);
                    $("#btn-cancel").prop("disabled", true);
                    $("#btn-save").prop("disabled", true);
                    $("#btn-delete").prop("disabled", true);
                },
                error: function(result){
                    var errors = result.responseJSON.message;
                    console.log(errors);
                }
            });
        
    },
    accept: function (moduleid, moduletahunajaranid) {
        if (imbaljasa.endEditing(moduleid, moduletahunajaranid)) {
            $('#dg'+moduletahunajaranid).datagrid('acceptChanges');
            $('#dg'+moduletahunajaranid).datagrid('reload');
        };
        
    },
    reject: function (moduleid, moduletahunajaranid) {        
        $('#dg'+moduletahunajaranid).datagrid('rejectChanges');
        editIndex = undefined;
    },
    jumlahJamRumus: function(jam_mulai, jam_selesai, separator, ed_jumlah_jam_rumus){
        var jumlah_jam_rumus = '';

        if (jam_selesai !== '' && jam_mulai !== '') {
            var hour_selesai = jam_selesai[0].split(separator) + jam_selesai[1].split(separator);
            var minute_selesai = jam_selesai[3].split(separator) + jam_selesai[4].split(separator);
            var hour_mulai = jam_mulai[0].split(separator) + jam_mulai[1].split(separator);
            var minute_mulai = jam_mulai[3].split(separator) + jam_mulai[4].split(separator);
            
            jam_selesai = (parseInt(hour_selesai) * 60) + parseInt(minute_selesai);
            jam_mulai = (parseInt(hour_mulai) * 60) + parseInt(minute_mulai);
            if (jam_selesai > jam_mulai) {
                jumlah_jam_rumus = jam_selesai - jam_mulai;
            }
            ;
        }
        ;

        $(ed_jumlah_jam_rumus.target).textbox('setValue', jumlah_jam_rumus / 60);
    },
    hitungimbaljasa: function(ed_peran_id, ed_module_tahun_ajaran_id, ed_peran_hitung_id, ed_jumlah_jam_rumus, ed_transport, ed_honor, peran_id){
        
        var bulan_tahun = new Date($("#bulan_tahun").val()),
            bulan = bulan_tahun.getMonth(),
            tahun = bulan_tahun.getFullYear();    
        
        var datas = {
            peran_id: peran_id,
            module_tahun_ajaran_id: $(ed_module_tahun_ajaran_id.target).textbox('getValue'),
            jumlah_jam_rumus: $(ed_jumlah_jam_rumus.target).textbox('getValue'),
            bulan: bulan+1,
            tahun: tahun
        };
        
        $.ajax({
                type: "POST",
                url: _baseUrl+"/transaksi/hitungimbaljasa",
                data: { ImbalJasa: datas },
                success: function(data){
                    var res = data.datas;
                    console.log(res);
                    $(ed_peran_hitung_id.target).textbox('setValue', res.peran_hitung_id);
                    $(ed_transport.target).textbox('setValue', res.transport);
                    $(ed_honor.target).textbox('setValue', res.honor);
                    
                },
                error: function(result){
                    var errors = result.responseJSON.message;
                    console.log(errors);
                    
                }
            });
    },
    urlparam: function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results==null){
           return null;
        }
        else{
           return decodeURI(results[1]) || 0;
        }
    },
    showMessage: function(title, content){
        $.messager.show({
            title: title,
            msg: content,
            timeout: 5000,
            showType: 'slide'
        });
    },
    addCommas: function(nStr){
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    },
    formatDecimal: function(num){
        return this.addCommas(parseInt(num));																	
    },
    exportPdf: function(moduletahunajaranid, transaksi_id, tahun_ajaran_id){
        
        $("input[name='moduletahunajaranid']").val(moduletahunajaranid);
        $("input[name='transaksi_id']").val(transaksi_id);
        $("input[name='tahunajaran_id']").val(tahun_ajaran_id);
        
        $("form#form-export-pdfijd").submit();
        
//        var datas = [];
//            datas = {'moduleid': moduleid, 'transaksi_id': transaksi_id}; 
//        
//        $.ajax({
//                type: "POST",
//                url: _baseUrl+"/export/pdfijd",
//                data: { ImbalJasa: datas },
//                success: function(data){
//                    console.log(data);
//                },
//                error: function(res){
//                    var errors = res.responseJSON.message;
//                    console.log(errors);
//                }
//            }); 
        
    },
    refreshGrid: function(moduleid, moduletahunajaranid){
        
//        imbaljasa.endEditing(moduleid, moduletahunajaranid);
//        $('#dg' + moduletahunajaranid).datagrid('endEdit', false);
        $('#dg'+moduletahunajaranid).datagrid('reload');
    }
};

var dg = {
    columnsFrozen: function(moduleid, moduletahunajaranid){
        return [[
                    {
                        field:'id',
                        title:'ID',
                        width:150,
                        hidden: true,
                        editor:{
                            type:'textbox',
                            options:{
                                readonly:true
                            }
                        }
                    },
                    {
                        field:'transaksi_id',
                        title:'Transaksi',
                        width:150,
                        hidden: true,
                        editor:{
                            type:'textbox',
                            options:{
                                readonly: true
                            }
                        }
                    },
                    {
                        field:'nip',
                        title:'NIP',
                        width:150,
                        editor:{
                            type:'textbox',
                            options:{
                                readonly:true
                            }
                        }
                    },
                    {
                        field:'dosen_fakultas_id_show',
                        title:'Nama',
                        width:200,
                        formatter: function (value, row) {
                            return row.namadosen || value;
                        },
                        editor:{
                            type:'combobox',
                            options:{
                                valueField:'id',
                                textField:'dosen',
                                method:'get',
                                url:_baseUrl+'/transaksi/dosenfakultas',
                                required:true,
                                onSelect: function(selected){
                                    var ed_nip = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'nip'});
                                    var ed_nama_fakultas = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'nama_fakultas'});
                                    var ed_dosen_fakultas_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'dosen_fakultas_id'});
                                    
                                    $(ed_nip.target).textbox('setValue', selected.nip);
                                    $(ed_nama_fakultas.target).textbox('setValue', selected.fakultas);
                                    $(ed_dosen_fakultas_id.target).textbox('setValue', selected.id);
                                }
                            }
                        }
                    },
                    {
                        field:'dosen_fakultas_id',
                        title:'Dosen Fakultas ID',
                        width:150,
                        hidden: true,
                        editor:{
                            type:'textbox',
                            options:{
                                readonly:true
                            }
                        }
                    },
                    {
                        field: 'nama_fakultas', 
                        title:'Induk Fakultas',
                        width: 100,
                        align: 'center',
                        editor: {
                            type: 'textbox',
                            options: {
                                readonly: true,
                                required: true,
                            }
                        }
                    },
                    {
                        field:'nip_digantikan',
                        title:'NIP Digantikan',
                        width:150,
                        hidden: true,
                        editor:{
                            type:'textbox',
                            options:{
                                readonly:true
                            }
                        }
                    },
                    {
                        field:'dosen_fakultas_id_digantikan_show',
                        title:'Nama Dosen Yang Digantikan',
                        width: 200,
                        editor: {
                            type: 'combobox',
                            options: {
                                valueField: 'id',
                                textField: 'dosen',
                                method: 'get',
                                url:_baseUrl+'/transaksi/dosenfakultas',
                                onSelect: function(selected){
                                    var ed_nip_digantikan = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'nip_digantikan'});
                                    var ed_nama_fakultas_digantikan = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'nama_fakultas_digantikan'});
                                    var ed_dosen_fakultas_id_digantikan = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'dosen_fakultas_id_digantikan'});
                                    
                                    $(ed_nip_digantikan.target).textbox('setValue', selected.nip);
                                    $(ed_nama_fakultas_digantikan.target).textbox('setValue', selected.fakultas);
                                    $(ed_dosen_fakultas_id_digantikan.target).textbox('setValue', selected.id);
                                }
                            }}
                    },
                    {
                        field:'dosen_fakultas_id_digantikan',
                        title:'Dosen Fakultas ID Digantikan',
                        width:150,
                        hidden: true,
                        editor:{
                            type:'textbox',
                            options:{
                                readonly:true
                            }
                        }
                    },
                    {
                        field:'nama_fakultas_digantikan',
                        title:'Fakultas Yang Digantikan',
                        width: 180,
                        align: 'center',
                        editor: {
                            type: 'textbox',
                            options: {
                                readonly: true
                            }
                        }
                    }
            ]];
    },
    columns: function(moduleid, moduletahunajaranid){
        return [[
                    {
                        field:'module_tahun_ajaran_id',
                        title:'Modul',
                        width: 180,
                        hidden: true,
                        editor: {
                            type: 'textbox',
                            options: {
                                readonly: true
                            }
                        }
                    },
                    {
                        field:'tgl_kegiatan',
                        title:'Tgl Kegiatan',
                        width:120,
                        editor: {
                            type: 'datebox',
                            options: {
                                required: true
                            }}
                    },
                    {
                        field: 'ruangan_id_show', 
                        title:'Ruang',
                        width: 120,
                        editor: {
                            type: 'combobox',
                            options: {
                                valueField: 'id',
                                textField: 'nama',
                                method: 'get',
                                url:_baseUrl+'/transaksi/jsonruang',
                                required: true,
                                onSelect: function(selected){
                                    var ed_ruangan_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'ruangan_id'});
                                    
                                    $(ed_ruangan_id.target).textbox('setValue', selected.id);
                                }
                            }}
                    },
                    {
                        field:'ruangan_id',
                        title:'Ruangan ID',
                        width:150,
                        hidden: true,
                        editor:{
                            type:'textbox',
                            options:{
                                readonly:true
                            }
                        }
                    },
                    {
                        field:'kelas_id_show',
                        title:'Nama Kelas',
                        width: 80,
                        editor: {
                            type: 'combobox',
                            options: {
                                valueField: 'kelas_id',
                                textField: 'kelas',
                                method: 'get',
                                required: true,
                                onSelect: function(selected){
                                    var ed_kelas_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'kelas_id'});
                                    
                                    $(ed_kelas_id.target).textbox('setValue', selected.kelas_id);
                                }
                            }}
                    },
                    {
                        field:'kelas_id',
                        title:'Kelas ID',
                        width:150,
                        hidden: true,
                        editor:{
                            type:'textbox',
                            options:{
                                readonly:true
                            }
                        }
                    },
                    {
                        field:'jam_mulai',
                        title:'Jam Mulai',
                        width:120,
                        editor: {
                            type: 'timespinner',
                            options: {
                                    min: '08:00',
                                    required: true,
                                    showSeconds: false,
                                    onSpinUp: function(){
                                        var ed_jumlah_jam_rumus = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'jumlah_jam_rumus'});
                                        var ed_jam_selesai = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'jam_selesai'});
                                        var jam_selesai = $(ed_jam_selesai.target).timespinner('getValue'); 
                                        var jam_mulai = $(this).timespinner('getValue'); 
                                        var separator = $(this).timespinner('options').separator;
                                        
                                        imbaljasa.jumlahJamRumus(jam_mulai, jam_selesai, separator, ed_jumlah_jam_rumus);
                                    },
                                    onSpinDown: function(){
                                        var ed_jumlah_jam_rumus = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'jumlah_jam_rumus'});
                                        var ed_jam_selesai = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'jam_selesai'});
                                        var jam_selesai = $(ed_jam_selesai.target).timespinner('getValue'); 
                                        var jam_mulai = $(this).timespinner('getValue'); 
                                        var separator = $(this).timespinner('options').separator;
                                        
                                        imbaljasa.jumlahJamRumus(jam_mulai, jam_selesai, separator, ed_jumlah_jam_rumus);
                                    }
                            }}
                    },
                    {
                        field:'jam_selesai',
                        title:'Jam Selesai',
                        width:120,
                        editor: {
                            type: 'timespinner',
                            options: {
                                    min: '08:00',
                                    required: true,
                                    showSeconds: false,
                                    onSpinUp: function(){
                                        var ed_jumlah_jam_rumus = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'jumlah_jam_rumus'});
                                        var ed_jam_mulai = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'jam_mulai'});
                                        var jam_mulai = $(ed_jam_mulai.target).timespinner('getValue'); 
                                        var jam_selesai = $(this).timespinner('getValue'); 
                                        var separator = $(this).timespinner('options').separator;
                                        
                                        imbaljasa.jumlahJamRumus(jam_mulai, jam_selesai, separator, ed_jumlah_jam_rumus);
                                    },
                                    onSpinDown: function(){
                                        var ed_jumlah_jam_rumus = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'jumlah_jam_rumus'});
                                        var ed_jam_mulai = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'jam_mulai'});
                                        var jam_mulai = $(ed_jam_mulai.target).timespinner('getValue'); 
                                        var jam_selesai = $(this).timespinner('getValue'); 
                                        var separator = $(this).timespinner('options').separator;
                                        
                                        imbaljasa.jumlahJamRumus(jam_mulai, jam_selesai, separator, ed_jumlah_jam_rumus);
                                    }
                            }}
                    },
                    {
                        field:'peran_id_show',
                        title:'Peran',
                        width:150,
                        editor: {
                            type: 'combobox',
                            options: {
                                valueField: 'peran_id',
                                textField: 'peran',
                                method: 'get',
                                url:_baseUrl+'/transaksi/jsonperan',
                                required: true,
                                onSelect: function(selected){
                                   
                                    var ed_peran_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'peran_id'}),
                                        peran_id = selected.peran_id,
                                        ed_module_tahun_ajaran_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'module_tahun_ajaran_id'}),
                                        ed_jumlah_jam_rumus = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'jumlah_jam_rumus'}),
                                        ed_transport = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'transport'}),
                                        ed_honor = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'honor'}),
                                        ed_peran_hitung_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'peran_hitung_id'}),
                                        ed_peran_id = $('#dg'+moduletahunajaranid).datagrid('getEditor', {index: editIndex, field: 'peran_id'});
                                
                                    $(ed_peran_id.target).textbox('setValue', selected.peran_id);
                                    imbaljasa.hitungimbaljasa(ed_peran_id, ed_module_tahun_ajaran_id, ed_peran_hitung_id, ed_jumlah_jam_rumus, ed_transport, ed_honor, peran_id);
                                }
                            }}
                    },
                    {
                        field:'peran_id',
                        title:'Peran ID',
                        width:150,
                        hidden: true,
                        editor:{
                            type:'textbox',
                            options:{
                                readonly:true
                            }
                        }
                    },
                    {
                        field:'jumlah_jam_rumus',
                        title:'Jumlah Jam Rumus',
                        width:150,
                        hidden: true,
                        editor: {
                            type: 'textbox',
                            options: {
                                readonly: true
                            }
                        }
                    },
                    {
                        field: 'transport',
                        title:'Transport',
                        width: 80,
                        formatter:function(value,rowData,rowIndex){
                                return imbaljasa.formatDecimal(value);
                        },
                        editor: {
                            type: 'textbox',
                            options: {
                                readonly: true
                            }
                        }
                    },
                    {
                        field: 'honor', 
                        title:'Honor Diterima',
                        width: 150,
                        formatter:function(value,rowData,rowIndex){
                                return imbaljasa.formatDecimal(value);
                        },
                        editor: {
                            type: 'textbox',
                            options: {
                                readonly: true
                            }
                        }
                    },
                    {
                        field:'keterangan',
                        title:'Keterangan',
                        width:200,
                        editor: {
                            type: 'textbox',
                            options: {
                                readonly: false
                            }
                        }
                    },
                    {
                        field:'peran_hitung_id',
                        title:'Peran Hitung Id',
                        width:150,
                        hidden: true,
                        editor:{
                            type:'textbox',
                            options:{
                                readonly:true
                            }
                        }
                    }
            ]];
    },
    init: function(moduleid, moduletahunajaranid){
        
        var transaksi_id = $("#transaksi_id").val();
        var tahun_ajaran_id = $("#tahun_ajaran_id").val();
        
        $("#dg"+moduletahunajaranid).datagrid({
            url: _baseUrl+'/transaksi/jsonimbaljasa?module_tahun_ajaran_id='+moduletahunajaranid+'&transaksi_id='+transaksi_id,
            iconCls: 'fa fa-th',
            toolbar: '#tb',
            onClickCell: imbaljasa.onClickCell,
            onEndEdit: imbaljasa.onEndEdit,
            method: 'get',
            singleSelect: true,
            showFooter: true,
            pagination: false,
            pageList: 50,
            frozenColumns: dg.columnsFrozen(moduleid, moduletahunajaranid),
            columns: dg.columns(moduleid, moduletahunajaranid),
            onLoadSuccess: function(){
                
            }
        });
        
        $("#btn-add").unbind('click');
        $("#btn-add").on('click', function(){
            imbaljasa.append(moduleid, moduletahunajaranid);
            $("#btn-add").prop("disabled", true);
            $("#btn-save").prop("disabled", false);
            $("#btn-cancel").prop("disabled", false);
            $("#btn-delete").prop("disabled", true);
        });
        
        $("#btn-save").unbind('click');
        $("#btn-save").on('click', function(){
            imbaljasa.accept(moduleid, moduletahunajaranid);
        });
        
        $("#btn-cancel").unbind('click');
        $("#btn-cancel").on('click', function(){
            imbaljasa.reject(moduleid, moduletahunajaranid);
            $("#btn-add").prop("disabled", false);
            $("#btn-cancel").prop("disabled", true);
            $("#btn-save").prop("disabled", true);
            $("#btn-delete").prop("disabled", true);
        });
        
        $("#btn-export-pdf").unbind('click');
        $("#btn-export-pdf").on('click', function(){
            imbaljasa.exportPdf(moduletahunajaranid, transaksi_id, tahun_ajaran_id);
        });
        
        $("#btn-refresh").unbind('click');
        $("#btn-refresh").on('click', function(){
            imbaljasa.refreshGrid(moduleid, moduletahunajaranid);
            $("#btn-add").prop("disabled", false);
            $("#btn-cancel").prop("disabled", true);
            $("#btn-save").prop("disabled", true);
            $("#btn-delete").prop("disabled", true);
        });
        
//        $("#btn-delete").unbind('click');
//        $("#btn-delete").on('click', function(){
////            imbaljasa.removeit(moduleid);
//            $("#btn-add").prop("disabled", false);
//            $("#btn-cancel").prop("disabled", true);
//            $("#btn-save").prop("disabled", true);
//            $("#btn-delete").prop("disabled", true);
//        });
        
        // bootstrap_confirm_delete has been use unbind click
        $("#btn-delete").bootstrap_confirm_delete({
            heading: 'Delete',
            message: 'Anda yakin akan menghapus data ini?',
            btn_ok_label:       'Ya',
            btn_cancel_label:   'Batal',
            delete_callback:    function() { imbaljasa.removeit(moduleid, moduletahunajaranid); },
            cancel_callback:    function() { 
                setTimeout(function(){
                    $("#btn-cancel").trigger("click");
                },0);
            }
        });
    }
};

var tabs = {
    init: function () {
        $('#tt').tabs({
            border: false,
            onSelect: function (title, index) {
                var selected = $(this).tabs('getSelected');
                var moduleid = selected[0].dataset.moduleid;
                var moduletahunajaranid = selected[0].dataset.moduletahunajaranid;
                
                dg.init(moduleid, moduletahunajaranid);
                $("#btn-add").prop("disabled", false);
                $("#btn-cancel").prop("disabled", true);
                $("#btn-save").prop("disabled", true);
                $("#btn-delete").prop("disabled", true);
//                console.log(moduleid);
            }
        });
    }
}

$(document).ready(function(){
    var moduleid = $('#tt').tabs('getSelected')[0].dataset.moduleid;
    var moduletahunajaranid = $('#tt').tabs('getSelected')[0].dataset.moduletahunajaranid;
    
    dg.init(moduleid, moduletahunajaranid);
    tabs.init();
});