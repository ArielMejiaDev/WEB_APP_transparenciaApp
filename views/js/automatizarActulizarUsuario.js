  addEventListener('load',copiarPassword,false);
  function copiarPassword(){
    var password = document.getElementById('passwordEditarUsuario');
    var confirmacionPassword = document.getElementById('repPasswordEditarUsuario');
    confirmacionPassword.value = password.value;
  }
  var rol = document.getElementById('valorRol');
  console.log(rol.value);
  var radioButtons = document.getElementsByClassName('radioButton');
  for (var i = 0; i < radioButtons.length; i++) {
    //console.log("Valor de los radio: "+radioButtons[i].value);
    if (radioButtons[i].value==rol.value) {
        //console.log(radioButtons[i].getAttribute('id'));
        var id = radioButtons[i].getAttribute('id');
        var radioButtonSeleccionado = document.getElementById(id);
        radioButtonSeleccionado.checked=true;
    }
  }