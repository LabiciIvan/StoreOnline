// window.addEventListener('load', animateIcon);

setInterval(animateIcon, 400);


function animateIcon() {

    let icon = document.querySelector('.fa-solid.fa-angles-right');


    if (icon.style.color == '') {
        icon.style.color = 'yellow';
 
        icon.style.transiton = '1s';
    } else {
        icon.style.color = '';
        icon.style.transiton = '1s';
    }
}
