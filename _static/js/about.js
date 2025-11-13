// top text animate
function aboutTopAnimate() {
	const animateArea = document.querySelectorAll("#about_right .name span");
	if (!animateArea.length) return;

	let num = 0;

	animateArea.forEach((el, index) => {
		el.classList.toggle('in', index === 0);
		el.classList.toggle('out', index !== 0);
	});

	setInterval(() => {
		const current = animateArea[num];

		const nextNum = (num + 1) % animateArea.length;
		const next = animateArea[nextNum];

		if (current && next) {
			current.classList.remove('in');
			current.classList.add('out');

			next.classList.remove('out');
			next.classList.add('in');

			num = nextNum;
		}
	}, 2000);
}


window.addEventListener('DOMContentLoaded', () => {
	// top text animate
	aboutTopAnimate();
  swiperSlide("#career_slide");
});