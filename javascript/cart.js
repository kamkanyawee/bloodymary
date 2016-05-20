function add_to_cart(flightid) {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function() {
        //
    }
    xmlhttp.open("POST", "component/CartInterface.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("function=add&flightid=" + flightid);
}
function remove_from_cart(flightid) {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function() {
        load_lineitem()
    }
    xmlhttp.open("POST", "component/CartInterface.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("function=remove&flightid=" + flightid);
}
function load_lineitem() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            set_lineitem(xmlhttp.responseText);
    }
    xmlhttp.open("POST", "component/CartInterface.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}
function set_lineitem(response) {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var answer = JSON.parse(xmlhttp.responseText);

            var cart = JSON.parse(response);
            var cards = "";
            var w = (window.innerWidth > 750) ? window.innerWidth : 750;
            for(i = 0; i < cart.lineitem.length; i++){
                cards += "<div class='card' style='width:" + (w - 40) + "px;height:100px'><div style='padding:0px;color:#333;float:left'>" + cart.lineitem[i].item.Airline + "<br/>";
                cards += "From : " + cart.lineitem[i].item.Source + "<br/>";
                cards += "To : " + cart.lineitem[i].item.Destination + "<br/>";
        		cards += "Fare : " + cart.lineitem[i].item.Fare + " THB<br/>";
                cards += "Qty : " + cart.lineitem[i].qty + "</div>";
                cards += '<div><button onclick="remove_from_cart(' + cart.lineitem[i].item.FlightID + ')" type="button" class="removeButton" style="float:right">Remove<br/>1 Ticket</button></div></div>';
                cards += "</div>";
            }
            document.getElementById("lineitem").innerHTML = cards;
            document.getElementById("totalfare").innerHTML = '<li style="color:#fff" id="totalfare"><strong>' + cart.totalfare + ' THB</strong></li>'
        }
    }
    xmlhttp.open("POST", "component/AccountInterface.php", true);
    xmlhttp.send();
}
