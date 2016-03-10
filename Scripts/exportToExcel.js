var reportname;
$(document).ready(function(e) {
    $(".exporttoexcel").click(function(e) {
        $('#mytable').css('border','1px solid c5c5c5');
        $('th').css('border','1px solid c5c5c5');
        $('td').css('border','1px solid c5c5c5');
        //creating a temporary HTML link element (they support setting file names)
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_div = document.getElementById('mytable');
        var table_html = table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        //setting the file name
        a.download = reportname+'.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        ('th').css('border','0');
        $('td').css('border','0');
        e.preventDefault();
    });
});