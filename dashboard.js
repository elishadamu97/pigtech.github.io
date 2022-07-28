var xhttp = new XMLHttpRequest();
xhttp.open("GET", "dashboard.php", true);
xhttp.onload = function(){
    const result = JSON.parse(this.responseText)
    var output = "";
                 for(var i=0; i<result.length; i++){     
                  output += "<tr>"+ 
                                    "<td>"+result[i].ID +"</td>"+
                                    "<td>"+result[i].name +"</td>"+
                                    "<td>"+result[i].phone_num +"</td>"+
                                    "<td>"+result[i].decoder_type +"</td>"+
                                    "<td>"+result[i].price +"</td>"+
                                    "<td>"+result[i].smartcard_num +"</td>"+
                                    "<td>"+result[i].address +"</td>"+
                                    "<td>"+result[i].month +"</td>"+
                                    "<td>"+result[i].date +"</td>"+
                            "</tr>"          
                 }  
    document.getElementById("data").innerHTML = output
}
xhttp.send()

var xhr = new XMLHttpRequest();
xhr.open("GET", "monthly1.php", true);
xhr.onload = function(){
    const display = JSON.parse(this.responseText)
    var recordprice = "";
    var recordscore = "";
                 for(var i = 0; i < display.length; i++){     
                  recordprice += display[i].price;
                  recordscore += display[i].ID;       
                 }
                 
    document.getElementById("month-total").innerHTML = recordprice
    document.getElementById("year-total").innerHTML = recordprice*12
    document.getElementById("score").innerHTML = recordscore
}
xhr.send()
$(document).ready(function(){
    $("#search").keyup(function(){
        var input = $(this).val();
        //alert(input);
        if(input != ""){
            $.ajax({
                url: "livesearch.php",
                method: "POST",
                data: {input:input},
                success: function(data){
                    $("#searchresult").html(data)
                }
            });
        }else{
            $("#searchresult").html("<h5>Search for a customer</h5>");
        } 
    });
});
