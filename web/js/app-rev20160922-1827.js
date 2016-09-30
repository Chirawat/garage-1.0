$(document).ready(function(){
    var maintenance = [];
    var part = [];
    id = 1;
    
    var obj = [];
        
    // add button click event
    $("#add-button").click(function(){
        //obj.push({list: $("#maintenance-list").val() , price: $("#maintenance-price").val()});
        //part.push({list: $("#part-list").val() , price: $("#part-price").val()});
        //$("<tr><td>" + id +  "</td><td></td><td></td><td></td><td></td><td></td></tr>").insertAfter("table > tbody > tr:first");
        
        // push data
        obj.push({
            service : {
                id : id, description : "ค่าถอดประกอบ", price : 200
            },
            part: {
                id : id, part_list : "Bult", price : 100
            }
        });
        
        $( "table > tr:last" ).remove();
        
        var updated_row = "";
        
        // Update table based on current data
        for(i = 0 ; i < obj.length ; i++){
            updated_row = updated_row.concat( "<tr id='detail-row'><td>" + i +  "</td><td></td><td></td><td></td><td></td><td></td></tr>");            
        }
      });
});