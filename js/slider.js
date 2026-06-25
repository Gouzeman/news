// переменные и константы
const slides = document.querySelectorAll('.slide');
const dotsContainer = document.getElementById('dots');
let current = 0;
let autoplay;

//Создаём пагинацию
slides.forEach((_, i) => {
    const dot = document.createElement('div');
    dot.style.cssText = `width: ${i === 0 ? '20px' : '6px'}; height: 3px; border-radius: 2px; background: ${i === 0 ? 'white' : 'rgba(255,255,255,0.4)'}; transition: all 0.3s; cursor: pointer;`;
    dot.addEventListener('click', () => goTo(i));
    dotsContainer.appendChild(dot);
});



//перемещение между слайдами: изменение точки пагинации и содержимого слайда(старое прячется а новое теряет свойство hidden)
function goTo(index) {
    slides[current].classList.add('hidden');
    current = (index + slides.length) % slides.length;
    slides[current].classList.remove('hidden');

    dotsContainer.querySelectorAll('div').forEach((dot, i) => {
        dot.style.width = i === current ? '20px' : '6px';
        dot.style.background = i === current ? 'white' : 'rgba(255,255,255,0.4)';
    });
}

// переключение слайда (событие, которое запускается при нажатии на < ли >)
function changeSlide(dir) {
    goTo(current + dir);
}

//вызов авто прокрутки. autoplay содержить идентификатор именно этого временного интервала. нужно для остановки
function startAutoplay() {
    autoplay = setInterval(() => changeSlide(1), 4000);
}

//остановка автопрокрутки
function stopAutoplay() {
    clearInterval(autoplay);
}

//по умолчанию есть автопрокрутка
startAutoplay();

//доп свойства для слайдера для автопрокрутки
document.getElementById('slider').addEventListener('mouseenter', stopAutoplay);
document.getElementById('slider').addEventListener('mouseleave', startAutoplay);