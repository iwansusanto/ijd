/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var report = {
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
      }
};

var dg = {
    columnsFrozen: function(){
        return [[
                    {
                        field:'id',
                        title:'ID',
                        width:150,
                        hidden: true
                    },
                    {
                        field:'nip',
                        title:'NIP',
                        width:150
                    },
                    {
                        field:'nama_dosen',
                        title:'Nama',
                        width:200
                    },
                    {
                        field:'nama_fakultas',
                        title:'Induk Fakultas',
                        align: 'center',
                        width:100,
                        formatter: function (value, row) {
                            return row.namadosen || value;
                        }
                    },
                    {
                        field:'nama_dosen_digantikan',
                        title:'Nama Dosen Yang Digantikan',
                        width:190
                    },
                    {
                        field: 'nama_fakultas_digantikan', 
                        title:'Induk Fakultas Yang Digantikan',
                        width: 200
                    }
            ]];
    },
    columns: function(){
        return [[
                    {
                        field:'nama_module',
                        title:'Modul',
                        width:200
                    },
                    {
                        field:'nama_kelas',
                        title:'Nama Kelas',
                        width: 100
                    },
                    {
                        field:'nama_ruangan',
                        title:'Ruang',
                        width:100
                    },
                    {
                        field:'tgl_kegiatan',
                        title:'Tgl Kegiatan',
                        width: 120,
                        align: 'right'
                    },
                    {
                        field:'jam_mulai',
                        title:'Jam Mulai',
                        width: 80
                    },
                    {
                        field:'jam_selesai',
                        title:'Jam Selesai',
                        width:80
                    },
                    {
                        field: 'nama_peran', 
                        title:'Peran',
                        width: 180
                    },
                    {
                        field:'jumlah_jam_rumus',
                        title:'Jumlah Jam Rumus',
                        width:150
                    },
                    {
                        field: 'transport',
                        title:'Transport',
                        width: 120,
                        formatter:function(value,rowData,rowIndex){
                                return report.formatDecimal(value);
                        }
                    },
                    {
                        field: 'honor', 
                        title:'Honor Diterima',
                        width: 120,
                        formatter:function(value,rowData,rowIndex){
                                return report.formatDecimal(value);
                        }
                    },
                    {
                        field:'keterangan',
                        title:'Keterangan',
                        width:200
                    }
            ]];
    },
    init: function(){
        
        var start_date,	end_date, url_grid;	
        
        url_grid = _baseUrl+'/report/jsonreportgabung?start_date=07&end_date=07';
        
        $("#dg_report").datagrid({
            url: url_grid,
            iconCls: 'fa fa-th',
            toolbar: '#tb',
            method: 'get',
            singleSelect: true,
            showFooter: true,
            frozenColumns: dg.columnsFrozen(),
            columns: dg.columns(),
            onLoadSuccess: function(){
                
            }
        });
        
        $('#start_date').datebox({
            onSelect: function(date){
//                    alert(date.getFullYear()+":"+(date.getMonth()+1)+":"+date.getDate());
                var selected_date = date;
                var end_date = $('#end_date').datebox('calendar');
                end_date.calendar({
                        validator: function(date){
                            
                            var d1 = new Date(selected_date.getFullYear(), selected_date.getMonth(), 1);
                            var d2 = new Date(selected_date.getFullYear(), selected_date.getMonth()+1, 0);
                            return d1<=date && date<=d2;
                        }
                });
                $('#end_date').datebox('setValue', '');	
            }
        });

        $("#filter-report").unbind("click");
        $("#filter-report").on("click", function(){
            start_date = $('#start_date').datebox('getValue');
            end_date = $('#end_date').datebox('getValue');
            
            url_grid = _baseUrl+'/report/jsonreportgabung?start_date='+start_date+'&end_date='+end_date;
            
            $('#dg_report').datagrid('load', url_grid);
        });
    }
};

$(document).ready(function(){
    dg.init();
});