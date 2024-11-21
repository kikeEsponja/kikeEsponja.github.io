function goBack(){
    window.history.back();
}

// TECNOLOGÍAS
const tech = document.getElementById('tech');

const tecnologias = ['Bootstrap', 'CSS', 'HTML', 'javaScript', 'PHP', 'SQL'];

function azar(){
    return tecnologias[Math.floor(Math.random() * tecnologias.length)];
}

function actualizarTecnologias(){
    tech.classList.add('animacion-cambio');
    //tech.style.opacity = 0;
    tech.style.border = '3px solid green';
    tech.style.borderRadius = '8px'; 

    setTimeout(function(){
        tech.innerHTML = azar();
        //tech.style.opacity = 1;
        tech.classList.remove('animacion-cambio');
    },
    500
    );
}

actualizarTecnologias();

setInterval(actualizarTecnologias, 3000);

// CURSOS
const cursos = document.getElementById('cursos');

const cursosPorHacer = ['Back-end', 'Cyber Seguridad', 'Mobile Apps', 'React', 'Web-Socket', 'JAVA', 'Python', 'MongoDb'];

function azarCursos(){
    return cursosPorHacer[Math.floor(Math.random() * cursosPorHacer.length)];
}

function actualizarCursos(){
    cursos.classList.add('animacion-cambio');
    //cursos.style.opacity = 0;
    cursos.style.border = '3px solid red';
    cursos.style.borderRadius = '8px';

    setTimeout(function(){
        cursos.innerHTML = azarCursos();
        //cursos.style.opacity = 1;
        cursos.classList.remove('animacion-cambio');
    },
    500
    );
}

actualizarCursos();

setInterval(actualizarCursos, 3000);

var frases = document.getElementById('frases');

const arreglo = ['"The art of victory comes from defeats", Simón Bolivar.',
'"If you think you can, then you can. If you hink you cannot, then you can not. In both cases, you are right.", Henry Ford.',
'"Worse than failling is not trying to do anything.", Franklin D. Roosvelt.', 
'"It is madness to hate all roses because one of them hurt you, and to give up all your dreams because one of them did not come true.", El principito',
'"There is no tailwind for those who do not know where to go.", Séneca'];

function aleatoria(){
    return arreglo[Math.floor(Math.random() * arreglo.length)];
}

function actualizarFrase(){
    frases.style.opacity = 0;
    setTimeout(function(){
        frases.innerHTML = aleatoria();
        frases.style.opacity = 1;
    }, 
    500
    );
}
actualizarFrase();
setInterval(actualizarFrase, 5000);