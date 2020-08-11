function btnCria(){
    document.getElementById("criar_evento").style.display="block";
    document.getElementById("editar_evento").style.display="none";
    document.getElementById("apagar_evento").style.display="none";
    document.getElementById("listar_evento").style.display="none";
}

function btnEdita(){
    document.getElementById("criar_evento").style.display="none";
    document.getElementById("editar_evento").style.display="block";
    document.getElementById("apagar_evento").style.display="none";
    document.getElementById("listar_evento").style.display="none";
}

function btnDeleta(){
    document.getElementById("criar_evento").style.display="none";
    document.getElementById("editar_evento").style.display="none";
    document.getElementById("apagar_evento").style.display="block";
    document.getElementById("listar_evento").style.display="none";
}

function btnLista(){
    document.getElementById("criar_evento").style.display="none";
    document.getElementById("editar_evento").style.display="none";
    document.getElementById("apagar_evento").style.display="none";
    document.getElementById("listar_evento").style.display="block";
}

function btnSelecionaL(){
    document.getElementById("criar_evento").style.display="none";
    document.getElementById("editar_evento").style.display="none";
    document.getElementById("apagar_evento").style.display="none";
    document.getElementById("listar_evento").style.display="block";
}