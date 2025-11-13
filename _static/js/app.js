// ========================
// app.js - 완전 통합 버전
// ========================

window.onload = function() {
  initApp();
};

function initApp() {
  // ------------------------
  // 로더
  // ------------------------
  const loader = document.getElementById('loader_wrapper');
  if(loader){
    loader.classList.add('hidden');
    setTimeout(()=>loader.style.display='none',500);
  }

  // ------------------------
  // 페이지별 data-page (body)
  // ------------------------
  const page = document.body.dataset.page || 'index';

  // ------------------------
  // SVG 애니메이션
  // ------------------------
  initSVGAnimations();

  // ------------------------
  // 카드 hover
  // ------------------------
  initCards();

  // ------------------------
  // Swiper
  // ------------------------
  swiperSlide("#work_slide");

  // ------------------------
  // 페이지별 추가 제어
  // ------------------------
  switch(page){
    case 'index': initMainPage(); break;
    case 'works': initWorksPage(); break;
    case 'gallery': initGalleryPage(); break;
    default: console.log("No page-specific JS:", page);
  }
}

// ========================
// SVG
// ========================
let logosFadedIn = false;

function getCurrentSVG(){
  const svg = window.innerWidth <= 560 ? document.getElementById('mobile_svg') : document.getElementById('pc_svg');
  if(!svg){ console.warn("SVG element not found!"); return null; }
  return svg;
}

function initSVGAnimations(){
  const svg = getCurrentSVG();
  if(!svg) return;

  animateGrayLines();
  fadeInLogosAndPink();
  startMeteorEffect();
}

function animateGrayLines(){
  const svg = getCurrentSVG();
  if(!svg) return;
  const lines = svg.querySelectorAll('.gray');
  lines.forEach(line=>{
    const length = line.getTotalLength();
    if(!length) return;
    gsap.fromTo(line,{strokeDashoffset:length},{strokeDashoffset:0,duration:2,ease:"power2.inOut"});
  });
}

function fadeInLogosAndPink(){
  if(logosFadedIn) return;
  logosFadedIn = true;

  const logos = document.querySelectorAll('.main_logos');
  logos.forEach(logo=>{
    const img = new Image();
    img.src = logo.src;
    img.onload = ()=>{
      gsap.to('#svg_container .pink',{opacity:0,duration:1});
      gsap.to(logo,{opacity:1,duration:1,delay:1.5});
    };
  });
}

function startMeteorEffect(){
  const svg = getCurrentSVG();
  if(!svg) return;
  const paths = svg.querySelectorAll('.gray');
  if(!paths.length) return;

  paths.forEach(path=>{
    const length = path.getTotalLength();
    const sampleCount = 200;
    const points=[];
    for(let i=0;i<=sampleCount;i++) points.push(path.getPointAtLength((i/sampleCount)*length));

    const dot = document.createElementNS("http://www.w3.org/2000/svg","ellipse");
    dot.setAttribute("rx",6);
    dot.setAttribute("ry",6);
    dot.setAttribute("fill","white");
    dot.style.filter="blur(2px)";
    svg.appendChild(dot);

    let progress = Math.random()*sampleCount;
    gsap.to({},{
      duration:1000,
      repeat:-1,
      onUpdate:()=>{
        progress+=1;
        if(progress>=sampleCount) progress=0;
        const pt = points[Math.floor(progress)];
        dot.setAttribute("cx",pt.x);
        dot.setAttribute("cy",pt.y);
      }
    });
  });
}

// ========================
// 카드 hover
// ========================
function initCards(){
  const cards = document.querySelectorAll('.gal_box,.work_img');
  if(!cards.length) return;

  cards.forEach(card=>{
    const overlay = card.querySelector('.overlay') || createOverlay(card);
    card.addEventListener('mousemove',e=>handleCardMove(e,card,overlay));
    card.addEventListener('mouseleave',e=>handleCardLeave(e,card,overlay));
    card.addEventListener('touchmove',e=>handleCardMove(e,card,overlay));
    card.addEventListener('touchend',e=>handleCardLeave(e,card,overlay));
    card.addEventListener('touchcancel',e=>handleCardLeave(e,card,overlay));
  });
}

function createOverlay(card){
  const overlay = document.createElement('div');
  overlay.className='overlay';
  overlay.style.cssText='position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none;opacity:0.2';
  card.appendChild(overlay);
  return overlay;
}

function handleCardMove(e,card,overlay){
  const rect = card.getBoundingClientRect();
  let l = e.offsetX, t = e.offsetY;
  if(e.type.startsWith('touch')){
    const touch = e.touches[0];
    l = touch.clientX - rect.left;
    t = touch.clientY - rect.top;
  }
  const px = Math.abs(Math.floor((100/card.offsetWidth)*l)-100);
  const py = Math.abs(Math.floor((100/card.offsetHeight)*t)-100);
  const pa = (50-px)+(50-py);
  const lp = 50 + (px-50)/1.5;
  const tp = 50 + (py-50)/1.5;
  const ty = ((tp-50)/2)*-1;
  const tx = ((lp-50)/1.5)*0.5;
  const opacity = Math.min(1,(20+Math.abs(pa)*1.5)/100);
  gsap.to(overlay,{rotationX:ty,rotationY:tx,opacity:opacity,transformOrigin:"center",duration:0.3});
}

function handleCardLeave(e,card,overlay){
  gsap.to(overlay,{rotationX:0,rotationY:0,opacity:0.2,duration:0.5});
}

// ========================
// Swiper
// ========================
function swiperSlide(selector){
  if(typeof Swiper==='undefined') return;
  const el = document.querySelector(selector);
  if(!el) return;

  new Swiper(selector,{
    loop:true,
    pagination:{
      el:'.swiper-pagination',
      type:'custom',
      renderCustom:(swiper,current,total)=>{
        let html='';
        for(let i=1;i<=total;i++){
          html+=`<div class="bullet-wrapper ${i===current?'active':''}">
            <div class="bullet"></div>
            ${i<total?'<div class="line"></div><div class="line"></div><div class="line"></div>':''}
          </div>`;
        }
        return html;
      }
    },
    navigation:{nextEl:'.swiper-button-next', prevEl:'.swiper-button-prev'}
  });
}

// ========================
// 페이지별 JS
// ========================
function initMainPage(){ console.log('Main page'); }
function initWorksPage(){ console.log('Works page'); }
function initGalleryPage(){ console.log('Gallery page'); }
