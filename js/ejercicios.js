//--------------------VARIABLES--------------------------------------------

    var muestraUno = "HOLA MUNDO";

    let muestra_dos = 155;

    let texto1 = document.getElementById("variable1");
    texto1.innerHTML = muestraUno;

    let texto2 = document.getElementById("variable2");
    texto2.textContent = muestra_dos;

//--------------------UNA SUMA--------------------------------------------
    var boton = document.getElementById("boton");
    var resultado = document.getElementById("resultado");

    boton.addEventListener("click", function(){
        var num1 = document.getElementById("num1").value;
        var num2 = document.getElementById("num2").value;
    
        var a = parseInt(num1);
        var b = parseInt(num2);
        var result = a + b;

        resultado.innerHTML = result;
    });

//--------------------SON IGUALES--------------------------------------------

    var botonIf = document.getElementById("boton-if");
    var resultadoIf = document.getElementById("resultado-if");

    botonIf.addEventListener("click", function(){
        var num1If = document.getElementById("num-if1").value;
        var num2If = document.getElementById("num-if2").value;
    
        var aIf = parseInt(num1If);
        var bIf = parseInt(num2If);
        if(aIf == bIf){
            resultadoIf.innerHTML = true;
        }else{
            resultadoIf.innerHTML = false;
        }
    });

//-------------------NOMBRE Y APELLIDO---------------------------------------------

    var botonNom = document.getElementById("boton-nom");
    var resultadoNom = document.getElementById("resultado-nom");

    botonNom.addEventListener("click", function(){
        var nombre = document.getElementById("nombre").value;
        var apellido = document.getElementById("apellido").value;
    
        var aNom = nombre;
        var bNom = apellido;
        resultadoNom.innerHTML = "hola, "+bNom+" "+aNom;
    });

//-------------------MULTIPLICACIÓN---------------------------------------------

    var botonMult = document.getElementById("boton-multip");
    var resultadoMult = document.getElementById("resultado-multip");

    botonMult.addEventListener("click", function(){
        var numMult1 = document.getElementById("multip1").value;
        var numMult2 = document.getElementById("multip2").value;
    
        var aMult = parseInt(numMult1);
        var bMult = parseInt(numMult2);
        var resultMult = aMult * bMult;

        resultadoMult.innerHTML = resultMult;
    });

//--------------------COMPARACIÓN--------------------------------------------

    var botonPar = document.getElementById("boton-par");
    var resultadoPar = document.getElementById("resultado-par");

    botonPar.addEventListener("click", function(){
        var numPar1 = document.getElementById("num-par1").value;
    
        var aPar = parseInt(numPar1);
        if(aPar % 2 == 0){
            resultadoPar.innerHTML = "es par";
        }else{
            resultadoPar.innerHTML = "no es par";
        }
    });

//--------------------TIENEN LA MISMA LONGITUD------------------------------------

    var botonTexto = document.getElementById("boton-texto");
    var resultadoTexto = document.getElementById("resultado-texto");

    botonTexto.addEventListener("click", function(){
        var texto1 = document.getElementById("texto1").value;
        var texto2 = document.getElementById("texto2").value;
    
        var aTexto = texto1;
        var bTexto = texto2;
        if(aTexto.length == bTexto.length){
            resultadoTexto.innerHTML = "Son iguales";
        }else{
            resultadoTexto.innerHTML = "No son iguales";
        }
    });

//--------------------POSITIVOS Y NEGATIVOS-------------------------------------------

    var botonPosi = document.getElementById("boton-posi");
    var resultadoPosi = document.getElementById("resultado-posi");

    botonPosi.addEventListener("click", function(){
        var numPosi = document.getElementById("posi").value;

        var aPosi = numPosi;
        if(aPosi > 0){
            resultadoPosi.innerHTML = "es positivo";
        }else if(aPosi == 0 ){
            resultadoPosi.innerHTML = "es CERO!!";
        }else{
	    resultadoPosi.innerHTML = "es negativo";
        }
    });

//--------------------------DIA DE LA SEMANA--------------------------------------
var botonDia = document.getElementById("boton-dia");

botonDia.addEventListener("click", function(){
    var dia = document.getElementById("dia").value;

switch(dia){
    case "lunes":
    alert("A trabajar");
    break;

    case "martes":
    alert("toma café y a trabajar");
    break;

    case "miercoles":
    alert("No te canses, vamos!");
    break;

    case "jueves":
    alert("Hoy pega una película");
    break;

    case "viernes":
    alert("Casi terminamos, vamos!!");
    break;

    case "sabado":
    alert("A descansar!!");
    break;

    case "domingo":
    alert("A misa y a dormir temprano!");
    break;

    default:
    alert("Dónde vives tú??");
    break;
}

});
//------------------------FIBBONACCI----------------------------------------
var botonFibbo = document.getElementById("boton-fibbo");
var resultadoFibbo = document.getElementById("resultado-fibbo");

botonFibbo.addEventListener("click", function(){
    var a=0;
    var b=1;
    var c=0;
    var resultadoFibonacci = "";

    for(let i=0; i < 10; i++){
        c = a + b;
        a = b;
        b = c;
        resultadoFibonacci += a + " "; 				// explica +=
    }
    resultadoFibbo.innerHTML = resultadoFibonacci;
});

//--------------------------TREN DE DATOS--------------------------------------
var botonTren = document.getElementById("boton-tren");
var resultadoTren = document.getElementById("resultado-tren");
var inputTren = document.getElementById("input-tren");

var tren = ["guitarra", "bajo", "batería"];
var trenP = document.getElementById("tren");
resultadoTren.innerHTML = tren.join(", "); 			//explica join

botonTren.addEventListener("click", function(){
    var nuevo = inputTren.value;
    tren.push(nuevo);
    resultadoTren.innerHTML = tren.join(", ");
    inputTren.value = ""; //para limpiar el input
});

//-----------------------UNA PERSONA-----------------------------------------
var botonPers = document.getElementById("boton-pers");
var resultadoPers = document.getElementById("resultado-pers");
var inputPers = document.getElementById("input-pers");

var persona = {
    nombre: "juan",
    edad: 31,
    localidad: "argentina"
};

resultadoPers.innerHTML = Object.values(persona).join(", ");

botonPers.addEventListener("click", function(){
    var nuevoPers = inputPers.value;
    persona[nuevoPers] = nuevoPers;
    resultadoPers.innerHTML = Object.values(persona).join(", ");
    inputPers.value = "";
});

//------------------------PRECIOS DE GUITARRAS----------------------------------------
var botonGuitar = document.getElementById("boton-guitar");
var resultadoGuitar = document.getElementById("resultado-guitar");
var inputGuitar = document.getElementById("input-guitar");

var guitarra = new Map;
    guitarra.set("acustica", "100");
    guitarra.set("electrica", "300");
    guitarra.set("electro-acustica", "200");

    for(let tipo of guitarra.entries()){
        resultadoGuitar.innerHTML += tipo + "/ ";
    }

botonGuitar.addEventListener("click", function(){
    var nuevoInst = inputGuitar.value;

    if(nuevoInst.trim() !== ""){
        guitarra.set(nuevoInst, "");
        resultadoGuitar.innerHTML = "";
        for(let tipo of guitarra.entries()){
            resultadoGuitar.innerHTML += tipo + "/ ";
        }
        inputGuitar.value = "";
    }
});
//----------------------------------------------------------------