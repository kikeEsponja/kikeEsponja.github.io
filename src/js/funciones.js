const validarContrasAl = () => {
    let pass = document.getElementById('contras');
    let passRep = document.getElementById('contras_rep');

    if(pass.value !== passRep.value){
        let formReg = document.getElementById('form_reg');
        event.preventDefault();
        alert('los password no coinciden');
    }
}

const enlace = document.getElementById('logeo');
enlace.addEventListener('click', ()=>{
    window.location.href = './admin/logeo.php';
});

document.getElementById('filtro-html').addEventListener('click', function(){
	filtrarPerfil('html');
});
document.getElementById('filtro-css').addEventListener('click', function(){
	filtrarPerfil('css');
});
document.getElementById('filtro-js').addEventListener('click', function(){
	filtrarPerfil('javascript');
});
document.getElementById('mostrar-todo').addEventListener('click', function(){
	mostrarTodo();
});

function filtrarPerfil(perfil){
	const filas = document.querySelectorAll('.fila-alumno');
	filas.forEach(fila => {
    	if(fila.getAttribute('data-perfil') === perfil){
        	fila.style.display = '';
        }else{
        	fila.style.display = 'none';
        }
    });
}

function mostrarTodo(){
	const filas = document.querySelectorAll('.fila-alumno');
	filas.forEach(fila => {
    	fila.style.display = '';
    });
}

//-------------------------------------------------------MOSTRAR HORARIOS--------------------------
document.getElementById('fecha').addEventListener('change', function(){
    const fecha = this.value;
    const selectHora = document.getElementById('hora');

    selectHora.innerHTML = '<option value="">Selecciona una hora</option>';

    if(fecha){
        fetch(`verificar.php?fecha=${fecha}`)
        .then(response => response.json())
        .then(data => {
            if(data.length > 0){
                data.forEach(hora =>{        
                    const option = document.createElement('option');
                    option.value = hora;
                    option.textContent = hora;
                    selectHora.appendChild(option);
                });
            }else{
                const option = document.createElement('option');
                option.value = "";
                option.textContent = "No hay horarios disponibles";
                selectHora.appendChild(option);
            }
        })
        .catch(error => console.error('Error al cargar horarios:', error));
    }
});