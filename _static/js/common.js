// 100vh
(function() {
  function setVh() {
    const vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
  }

  setVh();

  window.addEventListener('resize', setVh);
  window.addEventListener('orientationchange', setVh);
})();

// swiper
function swiperSlide(swiperId) {
  let swiper = new Swiper(swiperId, {
    loop: true,
  pagination: {
    el: ".swiper-pagination",
    type: "custom",
    renderCustom: function(swiper, current, total) {
      let html = '';
      for (let i = 1; i <= total; i++) {
        html += `
          <div class="bullet-wrapper ${i === current ? 'active' : ''}">
            <div class="bullet"></div>
            ${i < total ? '<div class="line"></div><div class="line"></div><div class="line"></div>' : ''}
          </div>
        `;
      }
      return html;
    }
  },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
}

// card effect
function cardEffect(className) {
  const cards = document.querySelectorAll(className);

  cards.forEach(card => {
    let timeoutId;

    // 카드 overlay
    let overlay = card.querySelector(".overlay");
    if (!overlay) {
      overlay = document.createElement("div");
      overlay.className = "overlay";
      overlay.style.position = "absolute";
      overlay.style.top = 0;
      overlay.style.left = 0;
      overlay.style.width = "100%";
      overlay.style.height = "100%";
      overlay.style.pointerEvents = "none";
      overlay.style.transition = "opacity 0.3s, transform 0.3s";
      card.appendChild(overlay);
    }

    function handleMove(e) {
      e.preventDefault();
      clearTimeout(timeoutId);

      let l, t;
      const rect = card.getBoundingClientRect();
      if (e.type.startsWith("touch")) {
        const touch = e.touches[0];
        l = touch.clientX - rect.left;
        t = touch.clientY - rect.top;
      } else {
        l = e.offsetX;
        t = e.offsetY;
      }

      const h = card.offsetHeight;
      const w = card.offsetWidth;
      const px = Math.abs(Math.floor((100 / w) * l) - 100);
      const py = Math.abs(Math.floor((100 / h) * t) - 100);
      const pa = (50 - px) + (50 - py);

      const lp = 50 + (px - 50) / 1.5;
      const tp = 50 + (py - 50) / 1.5;
      const ty = ((tp - 50) / 2) * -1;
      const tx = ((lp - 50) / 1.5) * 0.5;
      const opacity = Math.min(1, (20 + Math.abs(pa) * 1.5) / 100);

      overlay.style.transform = `rotateX(${ty}deg) rotateY(${tx}deg)`;
      overlay.style.opacity = opacity;

      card.classList.remove("animated");
    }

    function handleLeave() {
      timeoutId = setTimeout(() => card.classList.add("animated"), 1000);
    }

    card.addEventListener("mousemove", handleMove);
    card.addEventListener("touchmove", handleMove);
    card.addEventListener("mouseleave", handleLeave);
    card.addEventListener("touchend", handleLeave);
    card.addEventListener("touchcancel", handleLeave);
  });
}

// scroll event
function scrollViewAnimate(sections) {
  function checkVisibleSection() {
    const windowHeight = window.innerHeight;

    sections.forEach(section => {
      if (section.classList.contains('no_screen_event')) return;
      const rect = section.getBoundingClientRect();

      if (rect.top < windowHeight * 1/2 && rect.bottom > windowHeight / 3) {
        section.classList.add('visible');
      }
    });
  }

  window.addEventListener('scroll', checkVisibleSection);
  checkVisibleSection();
}

document.addEventListener('DOMContentLoaded', () => {
  const sections = document.querySelectorAll('.section');
  scrollViewAnimate(sections);
});

window.addEventListener('load', () => {
  // hidden load_wrapper
  const loaderWrapper = document.getElementById('loader_wrapper');
  loaderWrapper.classList.add('hidden');

  setTimeout(() => {
    if (loaderWrapper) {
      loaderWrapper.style.display = 'none';
    }
  }, 500);
});

const btnMenu = document.querySelector('#btn_menu');
const mainMenu = document.querySelector('#main_menu');
const btnClose = document.querySelector('#btn_close_menu button');
const menuOverlay = document.querySelector("#menu_overlay");

btnMenu.addEventListener('click', () => {
  mainMenu.classList.remove('closing');
  mainMenu.classList.add('active');
  menuOverlay.classList.add('active');
});

menuOverlay.addEventListener('click', () => {
  mainMenu.classList.remove('active');
  menuOverlay.classList.remove('active');
  mainMenu.classList.add('closing');
});

btnClose.addEventListener('click', () => {
  mainMenu.classList.remove('active');
  menuOverlay.classList.remove('active');
  mainMenu.classList.add('closing');
});