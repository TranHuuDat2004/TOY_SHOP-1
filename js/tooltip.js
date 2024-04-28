const tooltips1 = document.querySelectorAll('.all-tooltips1 .tooltip1');
const fullDiv1 = document.querySelector('section');
const container1 = document.querySelector('.container1');

function contentPosition() {
    tooltips1.forEach((tooltip1) => {
      const pin1 = tooltip1.querySelector('.pin1');
      const content1 = tooltip1.querySelector('.tooltip-content1');
      const arrow1 = tooltip1.querySelector('.arrow1');
      content1.style.left = pin1.offsetLeft - content1.offsetwidth/2 + 'px'; // Thêm 'px' ở cuối
      content1.style.top = pin1.offsetTop + 'px'; // Thêm 'px' ở cuối
    })
}