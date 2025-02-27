// Variables para controlar el estado de la reproducción
let reproduciendo = false;
let audio = new Audio('https://radio.gtdesarrollo.net/listen/fuentedevida-radio/radio.mp3'); // Reemplaza 'URL_DE_TU_ARCHIVO_DE_AUDIO.mp3' con la URL de tu archivo de audio

// Función para alternar entre reproducción y pausa
function toggleReproduccion() {
    const boton = document.getElementById('botonReproduccion');
    if (reproduciendo) {
        // Pausar la reproducción
        audio.pause();
    } else {
        // Iniciar la reproducción
        audio.play();
    }
    reproduciendo = !reproduciendo; // Invertir el estado de reproducción
    boton.classList.toggle('active'); // Alternar la clase 'active' para cambiar el estilo del botón
}

// Event listener para detectar cambios en la reproducción de audio y actualizar el estado del botón
audio.onended = function () {
    reproduciendo = false;
    document.getElementById('botonReproduccion').classList.remove('active');
};


window.sr = ScrollReveal();
sr.reveal('.alogo', {
    duration: 1000,
    origin: 'bottom',
    distance: '-100px'
})

window.sr = ScrollReveal();
sr.reveal('.navbar', {
    duration: 1500,
    origin: 'top',
    distance: '-100px'
})


window.sr = ScrollReveal();
sr.reveal('.titcentral', {
    duration: 1200,
    origin: 'left',
    distance: '-100px'
})

window.sr = ScrollReveal();
sr.reveal('.radtxt', {
    duration: 1200,
    origin: 'right',
    distance: '-100px'
})


window.sr = ScrollReveal();
sr.reveal('.logoprogra', {
    duration: 700,
    origin: 'bottom',
    distance: '-100px'
})

window.sr = ScrollReveal();
sr.reveal('.shadow__btn', {
    duration:1000,
    origin: 'left',
    distance: '-100px'
})

window.sr = ScrollReveal();
sr.reveal('.videomain', {
    duration: 500,
    origin: 'bottom',
    distance: '-100px'
})

window.sr = ScrollReveal();
sr.reveal('.playandpause', {
    duration: 1000,
    origin: 'top',
    distance: '-100px'
})

window.sr = ScrollReveal();
sr.reveal('.textosembed', {
    duration: 400,
    origin: 'bottom',
    distance: '-100px'
})

window.sr = ScrollReveal();
sr.reveal('.redes', {
    duration: 800,
    origin: 'right',
    distance: '-100px'
})

window.sr = ScrollReveal();
sr.reveal('.programas', {
    duration: 500,
    origin: 'top',
    distance: '-100px'
})


window.sr = ScrollReveal();
sr.reveal('.lp', {
    duration: 550,
    origin: 'bottom',
    distance: '-100px'
})

window.sr = ScrollReveal();
sr.reveal('.titprogra', {
    duration: 700,
    origin: 'bottom',
    distance: '-100px'
})

window.sr = ScrollReveal();
sr.reveal('.bgvi', {
    duration: 500,
    origin: 'right',
    distance: '-100px'
})

window.sr = ScrollReveal();
sr.reveal('.txtpubli', {
    duration: 500,
    origin: 'right',
    distance: '-100px'
})

window.sr = ScrollReveal();
sr.reveal('.capaembed', {
    duration: 500,
    origin: 'bottom',
    distance: '-100px'
})

window.sr = ScrollReveal();
sr.reveal('.form', {
    duration: 700,
    origin: 'top',
    distance: '-60px'
})

window.sr = ScrollReveal();
sr.reveal('.letrascontacto', {
    duration: 800,
    origin: 'top',
    distance: '-100px'
})





var boton = document.getElementById('playpause');
var radio = document.getElementById('radio');

// Función para alternar entre play y pausa
function alternarPlayPausa() {
    if (radio.paused) {
        radio.play();
        boton.src = "./recurso/pausa3.png";
    } else {
        radio.pause();
        boton.src = "./recurso/play3.png";
    }
}


// Evento click para el botón
boton.addEventListener('click', alternarPlayPausa);