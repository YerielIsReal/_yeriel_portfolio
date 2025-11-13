// ** ===== work page ===== ** //
const galBoxes = document.querySelectorAll('.gal_box');

galBoxes.forEach(galBox => {
  // hover event
  galBox.addEventListener('mouseover', function() {
    document.querySelectorAll('.work_nm').forEach(nm => {
      nm.style.display = 'none';
    });

    const workNames = galBox.querySelectorAll('.work_nm');
    workNames.forEach(nm => {
      nm.style.display = 'flex';
    });
  });

  galBox.addEventListener('mouseleave', function() {
    const workNames = galBox.querySelectorAll('.work_nm');
    workNames.forEach(nm => {
      nm.style.display = 'none';
    });
  });
});

// modal
function modal_works(id) {
  document.body.style.overflow = 'hidden';
  const scrollTarget = document.querySelector('.modal_conts');
  if (scrollTarget) scrollTarget.scrollTop = 0;

  $_POST('works','modal_works_load.php?id='+id);

  const modalWorks = document.getElementById("modal_works");
  modalWorks.classList.add('show');
}

  const url = new URL(window.location.href);
  const params = url.searchParams;
  const param_id = url.searchParams.get('id');

  if(param_id) modal_works(param_id);

function modal_works_close() {
  const modalImg = document.getElementById("modal_img");
  modalImg.src = "";
  document.querySelector('body').style.overflowY = 'scroll';

  const modalWorks = document.getElementById("modal_works");
  modalWorks.classList.remove('show');
}

document.addEventListener('DOMContentLoaded', () => {
  cardEffect('.gal_box');
});