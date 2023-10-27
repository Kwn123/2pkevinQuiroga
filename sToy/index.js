function sugerencia(dni) {
  if (dni === "") {
      document.getElementById("sugerencia").innerHTML = "";
      return;
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
          if (xmlhttp.readyState == 4 && this.status == 200) {
              document.getElementById("sugerencia").innerHTML = this.responseText;
          }
      };
      xmlhttp.open("GET", "/PHP/alumnoInfo.php?dni=" + dni, true);
      xmlhttp.send();
  }
}



function sugerenciaFetch(dni) {
    if (dni === "") {
      // Si es una cadena vacia retorna vacio
      document.getElementById("sugerencia").innerHTML = "";
      return;
    } else {
      fetch("/PHP/alumnoInfo.php?dni=" + dni)
        .then((response) => {
          if (!response.ok) {
            throw new Error("Error en la solicitud: " + response.status);
          }
          return response.text();
        })
        .then((data) => {
          document.getElementById("sugerencia").innerHTML = data;
        })
    }
  }
  