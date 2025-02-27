window.sr = ScrollReveal();
sr.reveal('.cuadricula', {
    duration: 4000,
    origin: 'left',
    distance: '400px'
});

sr.reveal('.contenedor', {
    duration: 3000,
    origin: 'bottom',
    distance: '-100px'
});

sr.reveal('.mitad1-heading', {
    duration: 3000,
    origin: 'bottom',
    distance: '100px'
});

sr.reveal('.boton-play', {
    duration: 3000,
    origin: 'bottom',
    distance: '100px'
});

sr.reveal('.fotoradio', {
    duration: 3000,
    origin: 'left',
    distance: '100px'
});

sr.reveal('.fb-page', {
    duration: 3000,
    origin: 'left',
    distance: '100px'
});

sr.reveal('.logo-fdv', {
    duration: 5000,
    origin: 'left',
    distance: '100px'
});

sr.reveal('.app', {
    duration: 6000,
    origin: 'right',
    distance: '100px'
});

sr.reveal('.img-fdv', {
    duration: 3000,
    origin: 'left',
    distance: '100px'
});

sr.reveal('.texto-logos', {
    duration: 5000,
    origin: 'bottom',
    distance: '100px'
});

sr.reveal('.img-patrocinios', {
    duration: 5000,
    origin: 'right',
    distance: '100px'
});

sr.reveal('.formulario', {
    duration: 4000,
    origin: 'top',
    distance: '100px'
});

sr.reveal('.redes-sociales', {
    duration: 6000,
    origin: 'bottom',
    distance: '100px'
});


const typeWriter = document.getElementById('typewriter-text');
const text = 'Nuestros Programas Especiales';

typeWriter.innerHTML = text;
typeWriter.style.setProperty('--characters', text.length);


function mostrarBoton() {
    document.getElementById('pause1').style.display = 'block';
    document.getElementById('play1').style.display = 'none';
}

function ocultarBoton() {
    document.getElementById('pause1').style.display = 'none';
    document.getElementById('play1').style.display = 'block';
}


