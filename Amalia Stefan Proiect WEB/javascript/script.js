 // Variabile pentru mișcare și direcție
var movingRight = true;
var position = 0;
var moveInterval;

// Funcția pentru mișcarea butonului cu smiley
function moveSmiley() {
    var button = document.querySelector('.moving-button');
    var screenWidth = window.innerWidth;

    // Verifică dacă mișcarea este în curs de desfășurare și oprește intervalul
    if (moveInterval) {
        clearInterval(moveInterval);
        moveInterval = null; // Resetează intervalul pentru a permite reluarea mișcării
        return; // Ieși din funcție pentru a opri mișcarea
    }

    // Pornirea mișcării butonului
    moveInterval = setInterval(frame, 10);

    function frame() {
        if (position >= screenWidth - button.offsetWidth) {
          movingRight = false;
        } else if (position <= 0) {
          movingRight = true;
        }

        if (movingRight) {
          position++;
        } else {
          position--;
        }

        button.style.right = position + 'px';
    }
}