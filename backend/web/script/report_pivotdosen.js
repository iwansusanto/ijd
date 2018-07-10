/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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
    columns: function(){
        return [[
                    {field: 'transport',op:'sum'},
                    {field: 'honor',op:'sum'}
            ]];
    },
    load: function(url_grid){
        
        $("#dg_report").pivotgrid({
            url:url_grid,
            method:'get',
            showFooter: true,    
            pivot:{
                rows:['nama_dosen','nama_module','nama_peran','nama_ruangan','nama_kelas'],
                columns:['tgl_kegiatan'],
                values:[
                        {field:'honor',op:'sum', 'title': 'Honor', formatter: function (value, row) {
                            return report.formatDecimal(value);
                        }},
                        {field:'transport',op:'sum', 'title': 'Transport', formatter: function (value, row) {
                            return report.formatDecimal(value);
                        }}
                    ]
            },
            forzenColumnTitle:'<span style="font-weight:bold">Pivot Grid</span>',
            valuePrecision:0,
            valueStyler:function(value,row,index){
                if (/Total_honor$/.test(this.field) && value>0){
                    return 'background:#D8FFD8';
                }
            },
            onLoadSuccess: function (row, data) {
                for (i = 0; i < $('#dg_report').treegrid('getData').length; i++) {
                    $('#dg_report').treegrid('collapseAll', i);
                };
//                console.log($('#dg_report').pivotgrid('getData'));
//                $('#dg_report').pivotgrid('reloadFooter', [
//                    {name: 'Total', honor: '10.000'}
//                ]);
            },
            onExpand: function (row){
//                console.log(row.children);
                for (i = 0; i < row.children.length; i++) {
                    var total_honor = Object.keys(row.children[i]._rows).reduce(function(sum, key){
                        var total = 0;
                        if(row.children[i]._rows[key].id != 'nip'){
                            total = sum + parseInt(row.children[i]._rows[key].honor);
                        };
                        return total;
                    }, 0);
                    
                    var total_transport = Object.keys(row.children[i]._rows).reduce(function(sum, key){
                        var total = 0;
                        if(row.children[i]._rows[key].id != 'nip'){
                            total = sum + parseInt(row.children[i]._rows[key].transport);
                        };
                        return total;
                    }, 0);
                    
                    $('#dg_report').treegrid('update',{
                            id: row.children[i]._id_field,
                            row: {
                                    name: 'honor',
                                    Total_honor: total_honor,
                                    Total_transport: total_transport
                            }
                        });
                };
            }
        });
    },
    init: function(){
        
        var start_date,	end_date, url_grid;	
        
        url_grid = _baseUrl+'/report/jsonreportpivotdosen';
        
        dg.load(url_grid);
        
        $('#start_date').datebox({
            onSelect: function(date){
//                    alert(date.getFullYear()+":"+(date.getMonth()+1)+":"+date.getDate());
                var selected_date = date;
                var end_date = $('#end_date').datebox('calendar');
                end_date.calendar({
                        validator: function(date){
                            
                            var d1 = new Date(selected_date.getFullYear(), selected_date.getMonth(), selected_date.getDate());
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
            
            url_grid = _baseUrl+'/report/jsonreportpivotdosen?start_date='+start_date+'&end_date='+end_date;
            
            dg.load(url_grid);
        });
    }
};

$(document).ready(function(){
    dg.init();
});