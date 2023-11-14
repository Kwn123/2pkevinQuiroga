<?php
class Alerta
{
  public static function presente($nombre, $apellido)
  {
    echo "<script>const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })</script>";

    echo "<script>Toast.fire({
            icon: 'success',
            title: '$nombre $apellido sToy!'
          })</script>";
  }
  public static function presenteTarde($nombre, $apellido)
  {
    echo "<script>const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })</script>";

    echo "<script>Toast.fire({
            icon: 'success',
            title: '$nombre $apellido tarde!'
          })</script>";
  }
  public static function horaIncorrecta(){
    echo "<script>Swal.fire({
      position: 'mid',
      icon: 'error',
      title: 'Fuera de horario',
      showConfirmButton: false,
      timer: 1500
    })</script>";
  }

  public static function alumnoEliminado()
  {
    echo "<script>Swal.fire({
            position: 'mid',
            icon: 'success',
            title: 'Alumno eliminado',
            showConfirmButton: false,
            timer: 1500
          })</script>";
  }
  public static function alumnoEditado()
  {
    echo "<script>Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Alumno modificado',
        showConfirmButton: false,
        timer: 1500
      })</script>";
  }
}
