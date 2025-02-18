const slider = document.getElementById('slider');
const imageAfter = document.getElementById('image-after');
const difference = document.getElementById('difference');
const viewButton = document.getElementById('view');
const blurWindow = document.getElementById('blurWindow');
const content = document.getElementById('content');
const closeButton = document.getElementById('close');
difference.addEventListener('mousemove', (e) => {
        const clientRect = difference.getBoundingClientRect();
        const clietnX = e.clientX;
        const percent = (clietnX / clientRect.width) * 100;
        slider.style.left = `${percent}%`;
        imageAfter.style.clipPath = `inset(0 ${100 - percent}% 0 0)`;
});
viewButton.addEventListener('click', (event) => {
        event.preventDefault();
        blurWindow.classList.add('hidden');
        content.classList.add('hidden');
});
closeButton.addEventListener('click', (event) => {
        event.preventDefault();
        blurWindow.classList.remove('hidden');
        content.classList.remove('hidden');
});
let currentComment = 0;
const buttonPrev = document.getElementById('previous');
const buttonNext = document.getElementById('next');
let comments = document.getElementById('comments');
// comments.addEventListener('touchmove', () => {
//     comments.style.transform = 'translateX(-100%)';
// })
// comments.addEventListener('touchend', () => {
//     comments.style.transform = 'translateX(-100%)';
// })
buttonPrev.addEventListener('click', () => changeComment(-1));
buttonNext.addEventListener('click', () => changeComment(1));
function showComment(index) {
    const slides = document.querySelectorAll('.comment');
    if (index >= slides.length) {
        currentComment = 0;
    } else if (index < 0) {
        currentComment = slides.length - 1;
    } else {
        currentComment = index;
    }
    if(currentComment == 0){
        buttonPrev.setAttribute('hidden', true);
    }
    else{
        buttonPrev.removeAttribute('hidden');
    }
    if(currentComment == 2){
        buttonNext.setAttribute('hidden', true);
    }
    else{
        buttonNext.removeAttribute('hidden');
    }
    let offset = -currentComment * 100;
    comments.style.transform = `translateX(${offset}%)`;
}

function changeComment(direction) {
    showComment(currentComment + direction);
}
setInterval(()=>{
    changeComment(1);
}, 7000);