document.getElementById("tipoProceso").addEventListener("change", function() {
    if (this.value === "1") {
        document.getElementById("procesoCarrera1").setAttribute('required', '');
        document.getElementById("procesoCarrera1").removeAttribute('disabled', '');
        document.getElementById("procesoCarrera1").style.display = "block";
    } else {
        document.getElementById("procesoCarrera1").removeAttribute('required', '');
        document.getElementById("procesoCarrera1").setAttribute('disabled', '');
        document.getElementById("procesoCarrera1").style.display = "none";
    }
    if (this.value === "2") {
      document.getElementById("procesoCarrera2").setAttribute('required', '');
      document.getElementById("procesoCarrera2").removeAttribute('disabled', '');
      document.getElementById("procesoCarrera2").style.display = "block";
    } else {
      document.getElementById("procesoCarrera2").removeAttribute('required', '');
      document.getElementById("procesoCarrera2").setAttribute('disabled', '');
      document.getElementById("procesoCarrera2").style.display = "none";
    }
    
    if (this.value === "3") {
      document.getElementById("procesoCarrera3").setAttribute('required', '');
      document.getElementById("procesoCarrera3").removeAttribute('disabled', '');
      document.getElementById("procesoCarrera3").style.display = "block";
    } else {
      document.getElementById("procesoCarrera3").removeAttribute('required', '');
      document.getElementById("procesoCarrera3").setAttribute('disabled', '');
      document.getElementById("procesoCarrera3").style.display = "none";
    }
    if (this.value === "4") {
      document.getElementById("procesoCarrera4").setAttribute('required', '');
      document.getElementById("procesoCarrera4").removeAttribute('disabled', '');
      document.getElementById("procesoCarrera4").style.display = "block";
    } else {
        document.getElementById("procesoCarrera4").removeAttribute('required', '');
        document.getElementById("procesoCarrera4").setAttribute('disabled', '');
        document.getElementById("procesoCarrera4").style.display = "none";
    }
    if (this.value === "5") {
        document.getElementById("procesoCarrera5").setAttribute('required', '');
        document.getElementById("procesoCarrera5").removeAttribute('disabled', '');
        document.getElementById("procesoCarrera5").style.display = "block";
    } else {
      document.getElementById("procesoCarrera5").removeAttribute('required', '');
      document.getElementById("procesoCarrera5").setAttribute('disabled', '');
      document.getElementById("procesoCarrera5").style.display = "none";
    }
  });
