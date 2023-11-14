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

//---------------------------------------------------------------------------------------------------

function sugerenciaPresente(valor) {
  if (valor === "") {
    document.getElementById("sugerencia").innerHTML = "";
    return;
  } else {
    if (isNaN(valor)) {
      fetch("../Funciones/funciones.php?nombrePresente=" + valor)
        .then((respuesta) => {
          return respuesta.text();
        })
        .then((data) => {
          document.getElementById("sugerencia").innerHTML = data;
        });
    } else {
      fetch("../Funciones/funciones.php?dniPresente=" + valor)
        .then((respuesta) => {
          return respuesta.text();
        })
        .then((data) => {
          document.getElementById("sugerencia").innerHTML = data;
        });
    }
  }
}

function alertaAsistencia(id) {
  Swal.fire({
    title: "Desea eliminar asistencia?",
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: "No",
    denyButtonText: `Eliminar`,
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "../Asistencia/asistenciaLista.php";
    } else if (result.isDenied) {
      window.location = "../Funciones/funciones.php?eliminar=true&id=" + id;
    }
  });
}
function alertaEliminar(dni) {
  Swal.fire({
    title: "Desea eliminar el alumno?",
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: "No",
    denyButtonText: `Eliminarlo`,
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "../ABM/lista.php";
    } else if (result.isDenied) {
      window.location = "../Funciones/funciones.php?eliminar=true&dni=" + dni;
    }
  });
}

function alertaPresente() {
  console.log("hola");
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  
  Toast.fire({
    icon: 'success',
    title: 'Signed in successfully'
  })
}
/*
la cosa que usa santi

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Signed in successfully'
})
*/