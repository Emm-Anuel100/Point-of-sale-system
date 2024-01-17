"use strict";

// light/dark mode toggle starts here
var theme_btn = document.querySelector('.theme_btn');

theme_btn.onclick = function (e) {
  e.preventDefault();
  var page_body = document.body;
  page_body.classList.toggle('light_mode');
}; // light/dark mode toggle ends here


document.addEventListener('DOMContentLoaded', function () {
  // Page nav btns vars...
  var homeSectionBtn = document.querySelector('.home');
  var addProductBtn = document.querySelector('.add_product');
  var manageProductsBtn = document.querySelector('.manage_products');
  var trackSalesBtn = document.querySelector('.track_sales'); // Page sections vars...

  var homeSection = document.querySelector('.section1');
  var addProduct = document.querySelector('.section2');
  var manageProducts = document.querySelector('.section3');
  var trackSales = document.querySelector('.section4'); // Default background of home icon is set to orange

  homeSectionBtn.style.background = "rgb(231, 96, 34)"; // Keep track of the previously clicked button

  var previousBtn = homeSectionBtn; // Function to handle button clicks

  function handleButtonClick(clickedBtn, activeSection) {
    clickedBtn.classList.add('active');
    homeSectionBtn.style.background = "rgb(84, 92, 104)";

    if (previousBtn !== clickedBtn) {
      previousBtn.classList.remove('active');
      previousBtn = clickedBtn;
    }

    [addProductBtn, manageProductsBtn, trackSalesBtn].forEach(function (btn) {
      if (btn !== clickedBtn) {
        btn.classList.remove('active');
      }
    });
    [addProduct, manageProducts, trackSales].forEach(function (section) {
      section.classList.remove('active');
    });
    document.querySelector('.illustration').style.visibility = activeSection === homeSection ? 'visible' : 'hidden';
    activeSection.classList.add('active');
  } // Event listeners for button clicks


  homeSectionBtn.addEventListener('click', function (e) {
    e.preventDefault();
    handleButtonClick(homeSectionBtn, homeSection);
  });
  addProductBtn.addEventListener('click', function (e) {
    e.preventDefault();
    handleButtonClick(addProductBtn, addProduct);
  });
  manageProductsBtn.addEventListener('click', function (e) {
    e.preventDefault();
    handleButtonClick(manageProductsBtn, manageProducts);
  });
  trackSalesBtn.addEventListener('click', function (e) {
    e.preventDefault();
    handleButtonClick(trackSalesBtn, trackSales);
  });
});