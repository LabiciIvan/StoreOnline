document.querySelectorAll('#toIncrease').forEach(increase => {increase.addEventListener('mouseover', colorTextPrevious)});
document.querySelectorAll('#toDecrease').forEach(increase => {increase.addEventListener('mouseover', colorTextNext)});

document.querySelectorAll('#toIncrease').forEach(increase => {increase.addEventListener('mouseleave', colorTextPrevious)});
document.querySelectorAll('#toDecrease').forEach(increase => {increase.addEventListener('mouseleave', colorTextNext)});

function colorTextPrevious(index) {
    let element = index.target.parentNode;

    let quantity = element.previousElementSibling;
    if (quantity.style.color != '') {
        quantity.style.color = "";
    } else {
        quantity.style.transition = "0.4s";
        quantity.style.color = "rgb(255, 238, 0)";
    }
}

function colorTextNext(index) {
    let element = index.target.parentNode;

    let quantity = element.nextElementSibling;
        
    if (quantity.style.color != '') {
        quantity.style.color = "";
    } else {
        quantity.style.transition = "0.4s";
        quantity.style.color = "rgb(255, 238, 0)";
    }
}