/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var editIndex = undefined;

var imbaljasa = {
    endEditing: function(moduleid){
        if (editIndex == undefined){return true}
        
        if ($('#dg' + moduleid).datagrid('validateRow', editIndex)) {
//            $('#dg' + moduleid).datagrid('endEdit', editIndex);
//            editIndex = undefined;
            return true;
        } else {
            return false;
        }
    },
    onClickCell: function(index, field){
        if (editIndex != index){
                if (imbaljasa.endEditing(moduleid)){
                    $('#dg'+moduleid).datagrid('selectRow', index)
                            .datagrid('beginEdit', index);
                    var ed = $('#dg'+moduleid).datagrid('getEditor', {index:index,field:field});
                    if (ed){
                        ($(ed.target).data('textbox') ? $(ed.target).textbox('textbox') : $(ed.target)).focus();
                    }
                    editIndex = index;
                } else {
                    setTimeout(function(){
                        $('#dg'+moduleid).datagrid('selectRow', editIndex);
                    },0);
                }
            }
    },
    onEndEdit: function (index, row) {
//        console.log('end edit');
        var ed = $(this).datagrid('getEditor', {
            index: index,
            field: 'nama_dosen'
        });
        row.namadosen = $(ed.target).combobox('getText');
        $(this).datagrid('reload');
        console.log('end to reload grid');
    },
    append: function (moduleid) {
        if (imbaljasa.endEditing(moduleid)) {
            $('#dg'+moduleid).datagrid('appendRow', {});
            editIndex = $('#dg'+moduleid).datagrid('getRows').length - 1;
            $('#dg'+moduleid).datagrid('selectRow', editIndex)
                    .datagrid('beginEdit', editIndex);
        }
    },
    removeit: function (moduleid) {
        if (editIndex == undefined) {
            return
        }
        $('#dg'+moduleid).datagrid('cancelEdit', editIndex)
                .datagrid('deleteRow', editIndex);
        editIndex = undefined;
    },
    accept: function (moduleid) {
        if (imbaljasa.endEditing(moduleid)) {
            //event if user click simpan button
            $('#dg'+moduleid).datagrid('acceptChanges');
            var items = $('#dg'+moduleid).datagrid('getRows');
            
            $.ajax({
                type: "POST",
                url: _baseUrl+"/transaksi/save",
                data: JSON.stringify({ ImbalJasa: items }),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data){
                    $('#dg' + moduleid).datagrid('endEdit', editIndex);
                    editIndex = undefined;
//                    $('#dg'+moduleid).datagrid('acceptChanges');
                    console.log(data);
                },
                failure: function(errMsg) {
                    console.log('Error Here');
                    console.log(errMsg);
                }
            });
            
        };
        
        
        
    },
    reject: function (moduleid) {
        $('#dg'+moduleid).datagrid('rejectChanges');
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
    }
}

var dg = {
    columnsFrozen: function(moduleid){
        return [[
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
                        field:'nama_dosen',
                        title:'Nama',
                        width:200,
                        formatter: function (value, row) {
                            return row.namadosen || value;
                        },
                        editor:{
                            type:'combobox',
                            options:{
                                valueField:'dosen_id',
                                textField:'dosen',
                                method:'get',
                                url:_baseUrl+'/transaksi/dosenfakultas',
                                required:false,
                                onSelect: function(selected){
                                    var ed_nip = $('#dg'+moduleid).datagrid('getEditor', {index: editIndex, field: 'nip'});
                                    var ed_nama_fakultas = $('#dg'+moduleid).datagrid('getEditor', {index: editIndex, field: 'nama_fakultas'});
                                    
                                    $(ed_nip.target).textbox('setValue', selected.nip);
                                    $(ed_nama_fakultas.target).textbox('setValue', selected.fakultas);
                                }
                            }
                        }
                    },
                    {
                        field: 'nama_fakultas', 
                        title:'Induk Fakultas',
                        width: 100,
                        editor: {
                            type: 'textbox',
                            options: {
                                readonly: true
                            }
                        }
                    },
                    {
                        field:'nama_dosen_digantikan',
                        title:'Nama Dosen Yang Digantikan',
                        width: 200,
                        editor: {
                            type: 'combobox',
                            options: {
                                valueField: 'dosen_id',
                                textField: 'dosen',
                                method: 'get',
                                url:_baseUrl+'/transaksi/dosenfakultas',
                                required: false,
                                onSelect: function(selected){
                                    var ed_nama_fakultas_digantikan = $('#dg'+moduleid).datagrid('getEditor', {index: editIndex, field: 'nama_fakultas_digantikan'});
                                    
                                    $(ed_nama_fakultas_digantikan.target).textbox('setValue', selected.fakultas);
                                }
                            }}
                    },
                    {
                        field:'nama_fakultas_digantikan',
                        title:'Fakultas Yang Digantikan',
                        width: 180,
                        editor: {
                            type: 'textbox',
                            options: {
                                readonly: true
                            }
                        }
                    }
            ]];
    },
    columns: function(moduleid){
        return [[
                    {
                        field: 'nama_module', 
                        title:'Modul',
                        width: 200,
                        editor: {
                            type: 'combobox',
                            options: {
                                valueField: 'module_id',
                                textField: 'module',
                                method: 'get',
                                url:_baseUrl+'/transaksi/jsonmodule',
                                required: false,
                                onSelect: function(selected){
                                    var ed_nama_kelas = $('#dg'+moduleid).datagrid('getEditor', {index: editIndex, field: 'nama_kelas'});
                                    var url = _baseUrl+'/transaksi/jsonlihatkelas?module_id='+selected.module_id;
                                    
                                    $(ed_nama_kelas.target).combobox('reload',url);
                                }
                            }}
                    },
                    {
                        field:'nama_kelas',
                        title:'Nama Kelas',
                        width: 80,
                        editor: {
                            type: 'combobox',
                            options: {
                                valueField: 'kelas_id',
                                textField: 'kelas',
                                method: 'get',
                                required: false
                            }}
                    },
                    {
                        field: 'nama_ruangan', 
                        title:'Ruang',
                        width: 120,
                        editor: {
                            type: 'combobox',
                            options: {
                                valueField: 'id',
                                textField: 'nama',
                                method: 'get',
                                url:_baseUrl+'/transaksi/jsonruang',
                                required: false
                            }}
                    },
                    {
                        field:'tgl_kegiatan',
                        title:'Tgl Kegiatan',
                        width:120,
                        editor: {
                            type: 'datebox',
                            options: {
                                required: false
                            }}
                    },
                    {
                        field:'jam_mulai',
                        title:'Jam Mulai',
                        width:120,
                        editor: {
                            type: 'timespinner',
                            options: {
                                    min: '08:00',
                                    required: false,
                                    showSeconds: false,
                                    onSpinUp: function(){
                                        var ed_jumlah_jam_rumus = $('#dg'+moduleid).datagrid('getEditor', {index: editIndex, field: 'jumlah_jam_rumus'});
                                        var ed_jam_selesai = $('#dg'+moduleid).datagrid('getEditor', {index: editIndex, field: 'jam_selesai'});
                                        var jam_selesai = $(ed_jam_selesai.target).timespinner('getValue'); 
                                        var jam_mulai = $(this).timespinner('getValue'); 
                                        var separator = $(this).timespinner('options').separator;
                                        
                                        imbaljasa.jumlahJamRumus(jam_mulai, jam_selesai, separator, ed_jumlah_jam_rumus);
                                    },
                                    onSpinDown: function(){
                                        var ed_jumlah_jam_rumus = $('#dg'+moduleid).datagrid('getEditor', {index: editIndex, field: 'jumlah_jam_rumus'});
                                        var ed_jam_selesai = $('#dg'+moduleid).datagrid('getEditor', {index: editIndex, field: 'jam_selesai'});
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
                                    required: false,
                                    showSeconds: false,
                                    onSpinUp: function(){
                                        var ed_jumlah_jam_rumus = $('#dg'+moduleid).datagrid('getEditor', {index: editIndex, field: 'jumlah_jam_rumus'});
                                        var ed_jam_mulai = $('#dg'+moduleid).datagrid('getEditor', {index: editIndex, field: 'jam_mulai'});
                                        var jam_mulai = $(ed_jam_mulai.target).timespinner('getValue'); 
                                        var jam_selesai = $(this).timespinner('getValue'); 
                                        var separator = $(this).timespinner('options').separator;
                                        
                                        imbaljasa.jumlahJamRumus(jam_mulai, jam_selesai, separator, ed_jumlah_jam_rumus);
                                    },
                                    onSpinDown: function(){
                                        var ed_jumlah_jam_rumus = $('#dg'+moduleid).datagrid('getEditor', {index: editIndex, field: 'jumlah_jam_rumus'});
                                        var ed_jam_mulai = $('#dg'+moduleid).datagrid('getEditor', {index: editIndex, field: 'jam_mulai'});
                                        var jam_mulai = $(ed_jam_mulai.target).timespinner('getValue'); 
                                        var jam_selesai = $(this).timespinner('getValue'); 
                                        var separator = $(this).timespinner('options').separator;
                                        
                                        imbaljasa.jumlahJamRumus(jam_mulai, jam_selesai, separator, ed_jumlah_jam_rumus);
                                    }
                            }}
                    },
                    {
                        field:'nama_peran',
                        title:'Peran',
                        width:150,
                        editor: {
                            type: 'combobox',
                            options: {
                                valueField: 'id',
                                textField: 'nama',
                                method: 'get',
                                url:_baseUrl+'/transaksi/jsonperan',
                                required: false
                            }}
                    },
                    {
                        field:'jumlah_jam_rumus',
                        title:'Jumlah Jam Rumus',
                        width:150,
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
                    }
            ]];
    },
    init: function(moduleid){
        $("#dg"+moduleid).datagrid({
            url: _baseUrl+'/transaksi/jsonimbaljasa',
            iconCls: 'fa fa-th',
            toolbar: '#tb',
            onClickCell: imbaljasa.onClickCell,
            onEndEdit: imbaljasa.onEndEdit,
            method: 'get',
            singleSelect: true,
            frozenColumns: dg.columnsFrozen(moduleid),
            columns: dg.columns(moduleid)
        });
        
        $("#btn-add").on('click', function(){
            imbaljasa.append(moduleid);
        });
        $("#btn-save").on('click', function(){
            imbaljasa.accept(moduleid);
        });
        $("#btn-cancel").on('click', function(){
            imbaljasa.reject(moduleid);
        });
        $("#btn-delete").on('click', function(){
            imbaljasa.removeit(moduleid);
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
                console.log(moduleid);
            }
        });
    }
}

$(document).ready(function(){
    var moduleid = $('#tt').tabs('getSelected')[0].dataset.moduleid;
    
    dg.init(moduleid);
    tabs.init();
});