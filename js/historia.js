//HISTORIA

function crear(elementoId){
    var elemento = document.getElementById(elementoId);
    if(elemento){
        var raya = document.createElement('hr');
        raya.style.borderTop = '4px solid yellow';
        elemento.appendChild(raya);
    }else{
        console.error('error');
    }
}
crear('cap1');
crear('cap2');
crear('cap3');
crear('cap4');
crear('cap5');
crear('cap6');
crear('cap7');
crear('cap8');
crear('cap9');
crear('cap10');
crear('cap11');
crear('cap12');
crear('cap13');