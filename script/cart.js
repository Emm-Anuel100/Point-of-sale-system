
//-- header backdrop blur effect starts here --//
window.addEventListener('scroll', (e) =>{
e.preventDefault();
let page_header = document.querySelector('header.page-header');

 if (scrollY > 5) {
    page_header.classList.add('active');
 } else{
   page_header.classList.remove('active');
 }
});
//-- header backdrop blur effect ends here --//




   