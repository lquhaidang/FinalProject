console.log("Hello World");
let score = document.querySelector(".score");
let value = parseInt(score.innerHTML);
let left = document.querySelector('.left-side');
let right = document.querySelector('.right-side');

if (value > 0) {
if (value <= 50) {
    right.style.transform = 'rotate(' + percentageToDegrees(value) + 'deg)';
} else {
    right.style.transform = 'rotate(180deg)';
    left.style.transform = 'rotate(' + percentageToDegrees(value - 50) + 'deg)';
}
}
    
function percentageToDegrees(percentage) {
  return Math.round(percentage / 100 * 360);
}