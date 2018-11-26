
function especificacion()
{
    var e = document.getElementById("tipo").value;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            document.getElementById("especificacion").innerHTML = this.responseText;
        }
    };

    switch (e)
    {
        case "1":
            xhttp.open("GET", "programador?profesion="+e, true);
            break;
        case "2":
            xhttp.open("GET", "disenador?profesion="+e, true);
            break;
    }
    xhttp.send();
}


function calcular_promedio()
{
    var id_empresa = document.getElementById("id_empresa").value;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            document.getElementById("promedio").innerHTML = this.responseText;
        }
    };

    xhttp.open("GET", "empresas/calcular_promedio?id_empresa="+id_empresa, true);
    xhttp.send();
}