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
  var trackSalesBtn = document.querySelector('.track_sales');
  var manageDistributorBtn = document.querySelector('.manage_distributor');
  var notificationsBtn = document.querySelector('.notifications');
  var configBtn = document.querySelector('.config'); // Page sections vars...

  var homeSection = document.querySelector('.section1');
  var addProduct = document.querySelector('.section2');
  var manageProducts = document.querySelector('.section3');
  var trackSales = document.querySelector('.section4');
  var manageDistributor = document.querySelector('.section5');
  var notifications = document.querySelector('.section6');
  var config = document.querySelector('.section7'); // Default background of home icon is set to orange

  homeSectionBtn.style.background = "rgb(231, 96, 34)"; // Keep track of the previously clicked button

  var previousBtn = homeSectionBtn; // Function to handle button clicks

  function handleButtonClick(clickedBtn, activeSection) {
    clickedBtn.classList.add('active');
    homeSectionBtn.style.background = "rgb(84, 92, 104)";

    if (previousBtn !== clickedBtn) {
      previousBtn.classList.remove('active');
      previousBtn = clickedBtn;
    }

    [addProductBtn, manageProductsBtn, trackSalesBtn, manageDistributorBtn, notificationsBtn, configBtn].forEach(function (btn) {
      if (btn !== clickedBtn) {
        btn.classList.remove('active');
      }
    });
    [addProduct, manageProducts, trackSales, manageDistributor, notifications, config].forEach(function (section) {
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
  manageDistributorBtn.addEventListener('click', function (e) {
    e.preventDefault();
    handleButtonClick(manageDistributorBtn, manageDistributor);
  });
  notificationsBtn.addEventListener('click', function (e) {
    e.preventDefault();
    handleButtonClick(notificationsBtn, notifications);
  });
  configBtn.addEventListener('click', function (e) {
    e.preventDefault();
    handleButtonClick(configBtn, config);
  });
});