// ポップアップ動作
const elements = document.getElementsByClassName('element');
const overlay = document.querySelector('#overlay');
const modal = document.querySelector('#modal')
const hidden = document.querySelector('#hidden')

for (let i = 0; i < elements.length; i++) {
  elements[i].addEventListener('click', function() {
    hidden.innerHTML = this.innerHTML;
    overlay.style.display = 'flex';
  });
}

overlay.addEventListener('click', (e) => {
  if (e.target === overlay) {
    overlay.style.display = 'none';
  }
});
