// main section 1
let logosFadedIn = false;

function getCurrentSVG() {
  return window.innerWidth <= 560 ? document.getElementById('mobile_svg') : document.getElementById('pc_svg');
}

function fadeInLogosAndPink() {
  if (logosFadedIn) return;
  logosFadedIn = true;

  const mainLogos = document.querySelectorAll('.main_logos');
  mainLogos.forEach(mainLogo => {
    const img = new Image();
    img.src = mainLogo.src;
    img.onload = () => {
      setTimeout(() => {
        document.querySelectorAll('#svg_container .pink').forEach(el => {
          el.style.transition = "opacity 1s";
          el.style.opacity = 0;
        });
        mainLogo.style.opacity = 1;
        startMeteorEffect();
      }, 1500);
    };
  });
}

function startMeteorEffect() {
  const svg = getCurrentSVG();
  const paths = svg.querySelectorAll(".gray");
  const meteors = [];
  let lastTime = performance.now();

  paths.forEach(path => {
    const length = path.getTotalLength();
    const sampleCount = 200;
    const points = [];
    for (let i = 0; i <= sampleCount; i++) {
      points.push(path.getPointAtLength((i / sampleCount) * length));
    }

    const dot = document.createElementNS("http://www.w3.org/2000/svg", "ellipse");
    dot.setAttribute("rx", 6);
    dot.setAttribute("ry", 6);
    dot.setAttribute("fill", "white");
    dot.setAttribute("opacity", 1);
    dot.style.filter = "blur(2px)";
    path.parentNode.appendChild(dot);

    meteors.push({
      dot,
      points,
      progress: Math.random() * sampleCount,
      speed: Math.random() * 1.5 + 0.5
    });
  });

  function loop(now) {
    const delta = (now - lastTime) / 16.6667;
    lastTime = now;

    meteors.forEach(m => {
      m.progress += m.speed * delta;
      if (m.progress >= m.points.length) m.progress = 0;
      const point = m.points[Math.floor(m.progress)];
      m.dot.setAttribute("cx", point.x);
      m.dot.setAttribute("cy", point.y);
    });

    requestAnimationFrame(loop);
  }

  requestAnimationFrame(loop);
}


function animateGrayLines() {
  const svg = getCurrentSVG();
  const grayLines = svg.querySelectorAll('.gray');

  grayLines.forEach(line => {
    line.style.transition = 'none';
    line.style.strokeDasharray = line.getTotalLength();
    line.style.strokeDashoffset = line.getTotalLength();

    line.classList.remove('gray-animate');
    void line.offsetWidth;
    line.classList.add('gray-animate');
  });
}

document.addEventListener('DOMContentLoaded', () => {
  // section 1 load
  animateGrayLines();
  fadeInLogosAndPink();

  // section 2 load
  swiperSlide("#work_slide");
  cardEffect('.work_img');
});

// function resize
window.addEventListener('resize', () => {
  document.querySelectorAll('svg ellipse').forEach(e => e.remove());
  animateGrayLines();
  startMeteorEffect();
});