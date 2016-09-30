$(document).ready(function () {
    var maintenance = [];
    var part = [];
    var quotation_info = [];
    var id = 1;
    var list = [];

    $("#add-button").click(function () {
        
        // check, empty?
        if( $("#maintenance-list").val() == "" && $("#part-list").val() == ""){
            alert("กรุณาป้อนรายการ");
            return false;
        }
        
        // prepare append row.
        var appendRow = '<tr id=' + id + '> \
            <td style="text-align: center;">' + id + '</td> \
            <td>' + $("#maintenance-list").val() + '</td> \
            <td style="text-align: right;">' + $("#maintenance-price").val() + '</td> \
            <td>' + $("#part-list").val() + '</td> \
            <td style="text-align: right;"> ' + $("#part-price").val() + '</td>\
            <td> \
                <button id="ibtnDel"class="btn btn-danger btn-xs"> \
                    <span class="glyphicon glyphicon-remove"></span> \
                </button> \
            </td></tr>';
        $("table > tbody").append( appendRow );
        
        // Push data into object.
        if ($("#maintenance-list").val() != "") {
            maintenance.push({
                row: id,
                list: $("#maintenance-list").val(),
                price: $("#maintenance-price").val()
            });
        }
        
        if($("#part-list").val() != ""){
            part.push({
                row: id,
                list: $("#part-list").val(),
                price: $("#part-price").val()
            });
        }
        
        // clear text box value
        $("#maintenance-list").val("");
        $("#maintenance-price").val("");
        $("#part-list").val("");
        $("#part-price").val("");
        
        // calulate total
        calTotal();
        updateTableIndex();

        // Increment ID
        id++;
    });
    
    
    // Remove button cliked
    $("table#myTable").on("click", "#ibtnDel", function (event) {
        // Syntax $(selector).closest(filter) http://www.w3schools.com/jquery/traversing_closest.asp
        //$(this).closest("tr").remove();  
        
        var closestRow = $(this).closest("tr");
        
        
        // remove data object
        var removeIndex = arrayObjectIndexOf(maintenance, closestRow[0].id, "row");
        if(removeIndex != -1)
            maintenance.splice(removeIndex, 1);
        
        removeIndex = arrayObjectIndexOf(part, closestRow[0].id, "row");
        if(removeIndex != -1)
            part.splice(removeIndex, 1);

        // remove row
        closestRow.remove();

        // calulate total
        calTotal();
        updateTableIndex();
    });

    function arrayObjectIndexOf(myArray, searchTerm, property){
        for( var i = 0, len = myArray.length; i < len; i++ ){
            if(myArray[i][property] === parseInt(searchTerm)) {
                return i;
            }
        }
        return -1;
     }

     function calTotal(){
         var total_maintenance = 0;
         var total_part = 0;
        
         for(var i = 0, len = maintenance.length; i < len; i++){
             total_maintenance += parseFloat(maintenance[i].price);
         }

         for(var i = 0, len = part.length; i < len; i++){
             total_part += parseFloat(part[i].price);
         }
         
         var total = total_maintenance + total_part;
         
         // update DOM
         $("#maintenance-total").text( total_maintenance.toFixed(2) );
         $("#part-total").text( total_part.toFixed(2) );  // toFixed - number of digit
         $("#total").text( total.toFixed(2) );

     }

     function updateTableIndex(){
         var row = $("tbody > tr");
         for(var i = 0, nRow = row.size(); i < nRow; i++){
             // select first column
             var col = $(row).eq(i).find("td");

             // update text
             $(col).eq(0).text(i + 1);
         }
     }

     $("#maintenance-list").autocomplete({
         source: function( request, response ) {
             $.ajax( {
                 url: "index.php?r=description/description-list",
                 dataType: "json",
                 data: {
                     term: request.term
                 },
                 success: function( data ) {
                     list = data;
                     response( data );
                 }
             });
        },
        close: function( event, ui ){
            var selectedText = $("#maintenance-list").val();

            // find selected price
            var index = -1;
            for( var i = 0, len = list.length; i < len; i++ ){
                if(list[i]["value"] === selectedText) {
                    index = i;
                }
            }
           
            $("#maintenance-price").val( list[index].price );
        }
     });


     $("#part-list").autocomplete({
         source: function( request, response ) {
             $.ajax( {
                 url: "index.php?r=description/description-list",
                 dataType: "json",
                 data: {
                     term: request.term
                 },
                 success: function( data ) {
                     list = data;
                     response( data );
                 }
             });
        },
        close: function( event, ui ){
            var selectedText = $("#part-list").val();

            // find selected price
            var index = -1;
            for( var i = 0, len = list.length; i < len; i++ ){
                if(list[i]["value"] === selectedText) {
                    index = i;
                }
            }

            $("#part-price").val( list[index].price );
        }
     });

     $("#btn-save").on("click", function(event, ui){
         if(maintenance.length != 0 || part.length != 0){
            // get quotation info
            quotation_info.push({
                // Claim number
                claimNo: $("#quotation-claim_no").val(),
                
                // customer
                customerFullName: $("#customer-fullname").val(),

                // viecle
                vieclePlateNo: $("#viecle-plate_no").val(),
            });


            $.ajax({
                 url: "index.php?r=quotation/quotation-save",
                 type: 'json', 
                 data:{
                    quotation_info: quotation_info,
                    maintenance_list: maintenance,
                    part_list: part,

                 },
                 success: function(data){
                     console.log(data);
                 }
             });
         
             // show modal
             $("#modal-save").modal('show');
         }

     });

     $("#viecle-plate_no").autocomplete({
         source: function( request, response ) {
             $.ajax( {
                 url: "index.php?r=viecle/get-plate-id",
                 dataType: "json",
                 data: {
                     term: request.term
                 },
                 success: function( data ) {
                     list = data;
                     response( data );
                 }
             });
        },
        close: function( event, ui ){
            
        }
     });
});

