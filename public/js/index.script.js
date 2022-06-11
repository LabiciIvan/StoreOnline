window.addEventListener('load', test);

document.querySelector('.sub-navigation-bar-info').addEventListener('mouseover', makeElementVisible, {once:true});
  document.querySelector('.sub-navigation-bar-info').addEventListener('mouseleave', makeElementInvisible);

function test() {
    setTimeout(() => {
        
        let element = document.querySelector('.sub-navigation-bar-info');
           element.style.opacity = '0';
           element.style.transition = '3s';
           

      }, 1000);
}

function makeElementVisible(index) {
    let element = index.target;
        element.style.opacity = '1';
        element.style.transition = '0.3s';
    }
    
    
    function makeElementInvisible(index) {
        
        let element = index.target;
        
        element.style.opacity = '0';
        element.style.transition = '3s';
}