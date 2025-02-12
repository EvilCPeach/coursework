const slider = document.querySelector('.slider');
const imageAfter = document.querySelector('.image-after');
const difference = document.querySelector('.difference');
difference.addEventListener('mousemove', (e) => {
        const clientRect = difference.getBoundingClientRect();
        const clietnX = e.clientX;
        const percent = (clietnX / clientRect.width) * 100;
        slider.style.left = `${percent}%`;
        imageAfter.style.clipPath = `inset(0 ${100 - percent}% 0 0)`;
});