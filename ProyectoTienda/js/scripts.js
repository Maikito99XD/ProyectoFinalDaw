/*!
* Start Bootstrap - Shop Homepage v5.0.5 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2022 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

function detalleProducto(id) {
    
    window.location.href = "../../utils/classes/producto.php?id=" + id;
}

function detalleProductoIndex(id) {
    window.location.href = "/daw/ProyectoTienda/utils/classes/producto.php?id=" + id;
}

function carritoCookie(){
    window.location.href = "/daw/ProyectoTienda/utils/classes/carritoCookie.php";
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return [];
  }

function getCookieCount(name) {
    return getCookie(name).length;
}

// window.post = function(url, data) {
//     console.log("hola");
//     return fetch("../../utils/classes/producto.php", {method: "POST", headers: {'Content-Type': 'application/json'}, body: JSON.stringify(data)});
// }
  
  