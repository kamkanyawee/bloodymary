function login_enter_submit(e) {
    if(e.keyCode == 13) login_req();
}
function login_req() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            window.location="store.html"
        }
    }
    xmlhttp.open("POST", "component/Account.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("function=login&username=" + document.getElementById("username_box").value + "&password=" + document.getElementById("password_box").value);
}
function logout_req() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            window.location="store.html"
        }
    }
    xmlhttp.open("POST", "component/Account.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("function=logout");
}
function check_login_status() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            disp_login_status(xmlhttp.responseText);
        }
    }
    xmlhttp.open("POST", "component/Account.php", true);
    xmlhttp.send();
}
function disp_login_status(response) {
    var answer = JSON.parse(response);
    if(answer.authen == 0) {
        //INVALID
        document.getElementById("loginbar").innerHTML =
        '<li><input id="username_box" type="text" class="inputForm" value="username" size="12"/></li>' +
        '<li><input id="password_box" type="password" class="inputForm" onkeypress="login_enter_submit(event)" value="password" size="12"/></li>' +
        '<li><button onclick="login_req()" type="button" class="submitButton">LOG IN</button></li>' +
        '<li><a href="regist.html"><button type="button" class="submitButton">REGISTER</button></a></li>';
    } else {
        //VALID
        document.getElementById("loginbar").innerHTML =
        '<li>' + answer.userinfo.FirstName + '</li>' +
        '<li><button onclick="logout_req()" type="button" class="submitButton">LOG OUT</button></li>';
        if(document.getElementById("cart") != null)
            document.getElementById("cart").innerHTML = '<a href="cart.html">Cart(' + answer.cart.length + ')</a>';
    }
}
