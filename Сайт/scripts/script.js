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
        imageAfter.style.animation = 'none';
        slider.style.animation = 'none';
        animationInterval = clearInterval(animationInterval);
        animationInterval = setInterval(() => {
            slider.classList.remove('hidden'); 
            imageAfter.style.animation = 'move 2.7s infinite ease-in-out';
            slider.style.animation = 'pulse 0.8s infinite ease-in-out, sliderMove 2.7s infinite ease-in-out';
        }, 7000);
});
viewButton.addEventListener('click', (event) => {
        event.preventDefault();
        blurWindow.classList.add('hidden');
        content.classList.add('hidden');
        slider.classList.add('hidden'); 
        imageAfter.style.animation = 'none';
        slider.style.animation = 'none';
});
closeButton.addEventListener('click', (event) => {
        event.preventDefault();
        blurWindow.classList.remove('hidden');
        content.classList.remove('hidden');
        slider.classList.remove('hidden'); 
        imageAfter.style.animation = 'move 2.7s infinite ease-in-out';
        slider.style.animation = 'pulse 0.8s infinite ease-in-out, sliderMove 2.7s infinite ease-in-out';
});
let animationInterval = setInterval(() => {
    imageAfter.style.animation = 'move 2.7s infinite ease-in-out';
    slider.style.animation = 'pulse 0.8s infinite ease-in-out, sliderMove 2.7s infinite ease-in-out';
}, 7000);
let currentComment = 0;
let startX = 0;
let endX = 0;
const buttonPrev = document.getElementById('previous');
const buttonNext = document.getElementById('next');
let comments = document.getElementById('comments');
buttonPrev.addEventListener('click', () => changeComment(-1));
buttonNext.addEventListener('click', () => changeComment(1));
comments.addEventListener('touchstart', (event) => {
    startX = event.touches[0].clientX;
    commentsInterval = clearInterval(commentsInterval);
});
comments.addEventListener('touchmove', (event) => {
    endX = event.touches[0].clientX;
});
comments.addEventListener('touchend', () => {
    swipe();
    commentsInterval = setInterval(()=>{
        changeComment(1);
    }, 7000)
});
function swipe() {
    const threshold = 50;
    const distanceX = endX - startX;
    if (distanceX > threshold) {
        changeComment(-1);
    } else if (distanceX < -threshold) {
        changeComment(1);
    }
}
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
let commentsInterval = setInterval(()=>{
    changeComment(1);
}, 7000);