const slider = document.getElementById('slider');
const imageAfter = document.getElementById('image-after');
const difference = document.getElementById('difference');
document.getElementById('personal').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('../functions/upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector('.image-before').src = data.originalUrl + '?t=' + Date.now();
            document.querySelector('.image-after').src = data.processedUrl + '?t=' + Date.now();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ошибка загрузки изображения');
    });
});
const blurWindow = document.getElementById('blurWindow');
const content = document.getElementById('content');
const header = document.getElementById('header');
const bgModal = document.getElementById('bgModal');
const modal = document.getElementById('modal');
const closeModal = document.getElementById('closeModal').addEventListener('click', function(){
    bgModal.classList.add('hidden');
    modal.classList.add('hidden');
});
const entryButton = document.getElementById('entryButton').addEventListener('click',function(){
    bgModal.classList.remove('hidden');
    modal.classList.remove('hidden');
    profileMenu.classList.add('hidden');
});
const regForm = document.getElementById('reg');
const entryForm = document.getElementById('entry');
const regModal = document.getElementById('modalReg').addEventListener('click', function(){
    regForm.classList.remove('hidden');
    entryForm.classList.add('hidden');
});
const entryModal = document.getElementById('modalEntry').addEventListener('click', function(){
    regForm.classList.add('hidden');
    entryForm.classList.remove('hidden');
});
document.addEventListener('scroll', function(){
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        header.style.backgroundColor = "#01939A";
    } else {
        header.style.backgroundColor = "#34C6CD";
    }
});
const links = document.querySelectorAll('a[href^="#"]').forEach(link =>{
    link.addEventListener('click', function(event){
        event.preventDefault();
        const targetLink = link.getAttribute('href');
        const targetElement = document.querySelector(targetLink);
        if(targetElement){
            targetElement.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
const closeButton = document.getElementById('closeButton').addEventListener('click', () => {
    blurWindow.classList.remove('hidden');
    content.classList.remove('hidden');
    slider.classList.remove('hidden'); 
    imageAfter.style.animation = 'move 2.7s infinite ease-in-out';
    slider.style.animation = 'pulse 0.8s infinite ease-in-out, sliderMove 2.7s infinite ease-in-out, pulse 0.6s infinite';
});
const viewButton = document.getElementById('view').addEventListener('click', () => {
    blurWindow.classList.add('hidden');
    content.classList.add('hidden');
    slider.classList.add('hidden'); 
    imageAfter.style.animation = 'none';
    slider.style.animation = 'none';
});
const dropdownMenu = document.getElementById('dropdownMenu');
const dropdownButton = document.getElementById('dropdown').addEventListener('click', () => {
    dropdownMenu.classList.toggle('hidden');
    profileMenu.classList.add('hidden');
});
const profileMenu = document.getElementById('profileMenu');
const profileButton = document.getElementById('profile').addEventListener('click', () => {
    profileMenu.classList.toggle('hidden');
    dropdownMenu.classList.add('hidden');
});
document.addEventListener('scroll', function() {
    profileMenu.classList.add('hidden');
    dropdownMenu.classList.add('hidden');
});
difference.addEventListener('mousemove', (event) => {
        const clientRect = difference.getBoundingClientRect();
        const clietnX = event.clientX;
        const percent = (clietnX / clientRect.width) * 100;
        slider.style.left = `${percent}%`;
        imageAfter.style.clipPath = `inset(0 ${100 - percent}% 0 0)`;
        imageAfter.style.animation = 'none';
        slider.style.animation = 'none';
        animationInterval = clearInterval(animationInterval);
        animationInterval = setInterval(() => {
            slider.classList.remove('hidden'); 
            imageAfter.style.animation = 'move 2.7s infinite ease-in-out';
            slider.style.animation = 'pulse 0.8s infinite ease-in-out, sliderMove 2.7s infinite ease-in-out, pulse 0.6s infinite';
        }, 7000);
});
let animationInterval = setInterval(() => {
    imageAfter.style.animation = 'move 2.7s infinite ease-in-out';
    slider.style.animation = 'pulse 0.8s infinite ease-in-out, sliderMove 2.7s infinite ease-in-out, pulse 0.6s infinite';
}, 7000);
let currentComment = 0;
let startX = 0;
let endX = 0;
const buttonPrev = document.getElementById('previous');
const buttonNext = document.getElementById('next');
let comments = document.getElementById('comments');
buttonPrev.addEventListener('click', () => {
    commentsInterval = clearInterval(commentsInterval);
    commentsInterval = setInterval(()=>{
        changeComment(1);
    }, 7000);
    changeComment(-1);
    buttonNext.style.animation = "none";
    buttonPrev.style.animation = "commentButton 0.5s 1 ease-in-out";
});
buttonNext.addEventListener('click', () => {
    commentsInterval = clearInterval(commentsInterval);
    commentsInterval = setInterval(()=>{
        changeComment(1);
    }, 7000);
    changeComment(1);
    buttonPrev.style.animation = "none";
    buttonNext.style.animation = "commentButton 0.5s 1 ease-in-out";
});
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
    if(buttonNext.hasAttribute('hidden')){
        buttonNext.style.animation = "none";
    }
    if(buttonPrev.hasAttribute('hidden')){
        buttonPrev.style.animation = "none";
    }
    showComment(currentComment + direction);
}
let commentsInterval = setInterval(()=>{
    changeComment(1);
}, 7000);