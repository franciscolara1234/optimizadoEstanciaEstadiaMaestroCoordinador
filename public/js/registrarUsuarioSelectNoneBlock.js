
document.getElementById("IdTipoUsu").addEventListener("change", function() {
if (this.value === "3") {
    // document.getElementById("procesoCarrera1").setAttribute('required', '');
    // document.getElementById("procesoCarrera1").removeAttribute('disabled', '');
    // document.getElementById("procesoCarrera1").style.display = "block";


    document.getElementById("tipoGrado").setAttribute('required', '');
  document.getElementById("tipoGrado").removeAttribute('disabled', '');
  document.getElementById("tipoGrado").style.display = "block";
  document.getElementById("gradoAcademico").style.display = "block";
} else {
    // document.getElementById("tipoGrado").removeAttribute('required', '');
    // document.getElementById("tipoGrado").setAttribute('disabled', '');
    // document.getElementById("tipoGrado").style.display = "none";
    document.getElementById("tipoGrado").removeAttribute('required', '');
    document.getElementById("tipoGrado").setAttribute('disabled', '');
    document.getElementById("tipoGrado").style.display = "none";
    document.getElementById("gradoAcademico").style.display = "none";

}
if (this.value === "4") {
//   document.getElementById("procesoCarrera2").setAttribute('required', '');
//   document.getElementById("procesoCarrera2").removeAttribute('disabled', '');
//   document.getElementById("procesoCarrera2").style.display = "block";


document.getElementById("tipoGrado").setAttribute('required', '');
  document.getElementById("tipoGrado").removeAttribute('disabled', '');
  document.getElementById("tipoGrado").style.display = "block";
  document.getElementById("gradoAcademico").style.display = "block";
} 
// else {
// //   document.getElementById("tipoGrado").removeAttribute('required', '');
// //   document.getElementById("tipoGrado").setAttribute('disabled', '');
// //   document.getElementById("tipoGrado").style.display = "none";
// document.getElementById("tipoGrado").removeAttribute('required', '');
// document.getElementById("tipoGrado").setAttribute('disabled', '');
// document.getElementById("tipoGrado").style.display = "none";
// document.getElementById("gradoAcademico").style.display = "none";

// }

// if (this.value === "3") {
//   document.getElementById("tipoGrado").setAttribute('required', '');
//   document.getElementById("tipoGrado").removeAttribute('disabled', '');
//   document.getElementById("tipoGrado").style.display = "block";
// } else {
// //   document.getElementById("procesoCarrera3").removeAttribute('required', '');
// //   document.getElementById("procesoCarrera3").setAttribute('disabled', '');
// //   document.getElementById("procesoCarrera3").style.display = "none";
// }
// if (this.value === "4") {
//   document.getElementById("tipoGrado").setAttribute('required', '');
//   document.getElementById("tipoGrado").removeAttribute('disabled', '');
//   document.getElementById("tipoGrado").style.display = "block";
// } else {
//     // document.getElementById("procesoCarrera4").removeAttribute('required', '');
//     // document.getElementById("procesoCarrera4").setAttribute('disabled', '');
//     // document.getElementById("procesoCarrera4").style.display = "none";
// }
});

