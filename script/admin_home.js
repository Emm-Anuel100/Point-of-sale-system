
// light/dark mode toggle starts here
let theme_btn = document.querySelector('.theme_btn');
theme_btn.onclick = (e) =>{
e.preventDefault();

let page_body = document.body;
page_body.classList.toggle('light_mode');
}
// light/dark mode toggle ends here



document.addEventListener('DOMContentLoaded', () => {
   // Page nav btns vars...
   const homeSectionBtn = document.querySelector('.home');
   const addProductBtn = document.querySelector('.add_product');
   const manageProductsBtn = document.querySelector('.manage_products');
   const trackSalesBtn = document.querySelector('.track_sales');
   const manageDistributorBtn = document.querySelector('.manage_distributor');
   const notificationsBtn = document.querySelector('.notifications');
   const configBtn = document.querySelector('.config');


   // Page sections vars...
   const homeSection = document.querySelector('.section1');
   const addProduct = document.querySelector('.section2');
   const manageProducts = document.querySelector('.section3');
   const trackSales = document.querySelector('.section4');
   const manageDistributor = document.querySelector('.section5');
   const notifications = document.querySelector('.section6');
   const config = document.querySelector('.section7');
   
 
   // Default background of home icon is set to orange
   homeSectionBtn.style.background = "rgb(231, 96, 34)";
 
   // Keep track of the previously clicked button
   let previousBtn = homeSectionBtn;
 
   // Function to handle button clicks
   function handleButtonClick(clickedBtn, activeSection) {
     clickedBtn.classList.add('active');
     homeSectionBtn.style.background = "rgb(84, 92, 104)";
 
     if (previousBtn !== clickedBtn) {
       previousBtn.classList.remove('active');
       previousBtn = clickedBtn;
     }
 
     [addProductBtn, manageProductsBtn, trackSalesBtn, manageDistributorBtn, notificationsBtn, configBtn].forEach(btn => {
       if (btn !== clickedBtn) {
         btn.classList.remove('active');
       }
     });
 
     [addProduct, manageProducts, trackSales, manageDistributor, notifications, config].forEach(section => {
       section.classList.remove('active');
     });
 
     document.querySelector('.illustration').style.visibility =
       activeSection === homeSection ? 'visible' : 'hidden';
     activeSection.classList.add('active');
   }
 
   // Event listeners for button clicks
   homeSectionBtn.addEventListener('click', (e) => {
     e.preventDefault();
     handleButtonClick(homeSectionBtn, homeSection);
   });
 
   addProductBtn.addEventListener('click', (e) => {
     e.preventDefault();
     handleButtonClick(addProductBtn, addProduct);
   });
 
   manageProductsBtn.addEventListener('click', (e) => {
     e.preventDefault();
     handleButtonClick(manageProductsBtn, manageProducts);
   });
 
   trackSalesBtn.addEventListener('click', (e) => {
     e.preventDefault();
     handleButtonClick(trackSalesBtn, trackSales);
   });

   manageDistributorBtn.addEventListener('click', (e) => {
    e.preventDefault();
    handleButtonClick(manageDistributorBtn, manageDistributor);
  });

   notificationsBtn.addEventListener('click', (e) => {
    e.preventDefault();
    handleButtonClick(notificationsBtn, notifications);
  });

   configBtn.addEventListener('click', (e) => {
    e.preventDefault();
    handleButtonClick(configBtn, config);
  });
 });
 


