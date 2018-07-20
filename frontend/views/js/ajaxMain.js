var meses = document.getElementsByClassName("mes");
    var conexionCategorias;
    for (let index = 0; index < meses.length; index++) {
        meses[index].addEventListener('click',enviarNumeralAñoMes,false);
        
    }
    function enviarNumeralAñoMes(e)
    {
        e.preventDefault();
		var idNumeral = e.target.getAttribute('idNumeral');
        var year = e.target.getAttribute('year');
        var mes = e.target.getAttribute('mes');
        //alert('click en el numeral con id: '+idNumeral+' del año: '+year+' en el mes de: '+mes);
        datos = new FormData();
        datos.append('idNumeral',idNumeral);
        datos.append('year',year);
        datos.append('mes',mes);
        conexionCategorias = new XMLHttpRequest();
        conexionCategorias.onreadystatechange = respEnviarNumeralAñoMes;
        conexionCategorias.open('POST','views/modules/ajaxModule.php',true);
        conexionCategorias.send(datos);
    }
    function respEnviarNumeralAñoMes()
    {
        if (conexionCategorias.readyState==4)
        {
            if (conexionCategorias.status==200)
            {
                console.log(conexionCategorias.responseText);
                var links = document.getElementById('agregarLinks');
                categorias = document.getElementById('categorias');
                categorias.style.display="block";
                links.innerHTML = conexionCategorias.responseText; 
            }    
        }
    }