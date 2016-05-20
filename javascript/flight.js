function load_cards() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            set_cards(xmlhttp.responseText);
    }
    xmlhttp.open("POST", "component/TicketInterface.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}
function set_cards(response) {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var answer = JSON.parse(xmlhttp.responseText);

            var flightlist = JSON.parse(response);
            var cards = "";
            var w = (window.innerWidth > 750) ? window.innerWidth : 750;
            for(i = 0; i < flightlist.length; i++){
                cards += "<div class='card' style='width:" + (w - 320) + "px;height:100px'><div style='padding:0px;color:#333;float:left'>" + flightlist[i].Airline + "<br/>";
                cards += "From : " + flightlist[i].Source + "<br/>";
                cards += "To : " + flightlist[i].Destination + "<br/>";
        		cards += flightlist[i].Fare + " THB</div>";
                if(answer.authen == 1)
                    cards += '<div><button onclick="add_to_cart(' + flightlist[i].FlightID + ')" type="button" class="addButton" style="float:right">ADD</button></div></div>';
                else
                    cards += '<div><button type="button" class="lockButton" style="float:right">LOGIN<br/>FIRST</button></div></div>';
            }
            document.getElementById("deck").innerHTML = cards;
        }
    }
    xmlhttp.open("POST", "component/AccountInterface.php", true);
    xmlhttp.send();
}
