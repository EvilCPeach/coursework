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