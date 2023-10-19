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
