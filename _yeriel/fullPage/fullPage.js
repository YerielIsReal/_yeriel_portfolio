(function() {
  window.fullpage = function(wrapperSelector, options) {
    const defaultOptions = {
      sectionSelector: '.section',
      scrollingSpeed: 700
    };
    this.options = Object.assign(defaultOptions, options);
    this.wrapper = document.querySelector(wrapperSelector);
    this.sections = this.wrapper ? this.wrapper.querySelectorAll(this.options.sectionSelector) : [];
    this.totalSections = this.sections.length;
    this.currentSection = 1;
    this.isScrolling = false;
    
    document.documentElement.classList.add('fullpage-active-js'); 
    
    if (!this.wrapper || this.totalSections === 0) {
      console.error("[FULLPAGE ERROR] Wrapper ID 또는 Section 클래스를 찾을 수 없습니다.");
      return; 
    }

    this._bindScrollEvents(); 
    
    const self = this; 

    document.addEventListener('DOMContentLoaded', () => {
      self.scrollToSection(1, 0);
    });
  };

  window.fullpage.prototype._bindScrollEvents = function() {
    const handleWheel = (e) => {
        const delta = e.deltaY || e.detail; 

        if (Math.abs(delta) < 5) return; 

        e.preventDefault(); 
        
        if (this.isScrolling) return;

        if (delta > 0) {
          this.scrollToSection(this.currentSection + 1);
        } else if (delta < 0) {
          this.scrollToSection(this.currentSection - 1);
        }
    };
    
    let touchStartY = 0;
    const touchThreshold = 50;

    const handleTouchStart = (e) => {
        touchStartY = e.touches[0].clientY;
    };

    const handleTouchEnd = (e) => {
        if (this.isScrolling) return;

        const touchEndY = e.changedTouches[0].clientY;
        const deltaY = touchStartY - touchEndY;

        if (Math.abs(deltaY) < touchThreshold) return;

        if (deltaY > 0) {
            this.scrollToSection(this.currentSection + 1);
        } else if (deltaY < 0) {
            this.scrollToSection(this.currentSection - 1);
        }
    };
    
    document.addEventListener('wheel', handleWheel, { passive: false });
    document.addEventListener('mousewheel', handleWheel, { passive: false });
    document.addEventListener('DOMMouseScroll', handleWheel, { passive: false });
    
    document.addEventListener('touchstart', handleTouchStart, { passive: true });
    document.addEventListener('touchend', handleTouchEnd, { passive: false });
  };
  
  window.fullpage.prototype.scrollToSection = function(index, speed) {
    if (index < 1 || index > this.totalSections) return;
    
    this.currentSection = index;
    this.isScrolling = true;

    const offset = -(this.currentSection - 1) * 100;
    const scrollSpeed = (typeof speed === 'number') ? speed : this.options.scrollingSpeed;
    const defaultSpeed = this.options.scrollingSpeed;
    
    this.wrapper.style.transitionDuration = `${scrollSpeed}ms`;
    this.wrapper.style.transitionProperty = 'transform';
    this.wrapper.style.transitionTimingFunction = 'ease-in-out';
    
    this.wrapper.style.transform = `translateY(${offset}%)`;

    setTimeout(() => {
      this.isScrolling = false;
    }, scrollSpeed); 
    
    if (speed === 0) {
        window.requestAnimationFrame(() => {
            window.requestAnimationFrame(() => {
                this.wrapper.style.transitionDuration = `${defaultSpeed}ms`;
            });
        });
    }
  };
})();