
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
   const manageCashierBtn = document.querySelector('.manage_cashier');
   const manageUDOBtn = document.querySelector('.manage_udo');
   const accountBtn = document.querySelector('.account');
   const joterBtn = document.querySelector('.joter');
   const helpBtn = document.querySelector('.help');

   // Page sections vars...
   const homeSection = document.querySelector('.section1');
   const addProduct = document.querySelector('.section2');
   const manageProducts = document.querySelector('.section3');
   const trackSales = document.querySelector('.section4');
   const manageDistributor = document.querySelector('.section5');
   const notifications = document.querySelector('.section6');
   const config = document.querySelector('.section7');
   const manageCashier = document.querySelector('.section8');
   const manageUDO = document.querySelector('.section9');
   const account = document.querySelector('.section10');
   const joter = document.querySelector('.section11');
   const help = document.querySelector('.section12');
 


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
 
     [addProductBtn, manageProductsBtn, trackSalesBtn, manageDistributorBtn, notificationsBtn, configBtn, manageCashierBtn, manageUDOBtn, accountBtn, joterBtn, helpBtn].forEach(btn => {
       if (btn !== clickedBtn) {
         btn.classList.remove('active');
       }
     });
 
     [addProduct, manageProducts, trackSales, manageDistributor, notifications, config, manageCashier, manageUDO, account, joter, help].forEach(section => {
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

  manageCashierBtn.addEventListener('click', (e) => {
    e.preventDefault();
    handleButtonClick(manageCashierBtn, manageCashier);
  });

  manageUDOBtn.addEventListener('click', (e) => {
    e.preventDefault();
    handleButtonClick(manageUDOBtn, manageUDO);
  });

  accountBtn.addEventListener('click', (e) => {
    e.preventDefault();
    handleButtonClick(accountBtn, account);
  });

  joterBtn.addEventListener('click', (e) => {
    e.preventDefault();
    handleButtonClick(joterBtn, joter);
  });

  helpBtn.addEventListener('click', (e) => {
    e.preventDefault();
    handleButtonClick(helpBtn, help);

    // invoke typewrite function
    TypeWriteTextEffect();
  });
 });
 


 // Function to create and append a note element
function appendNote(noteText, index) {
  var noteContainer = document.createElement("div");
  noteContainer.className = "noteContainer";
  
  var noteElement = document.createElement("span");
  noteElement.className = "note";
  noteElement.innerText = noteText;
  
  var deleteButton = document.createElement("button");
  deleteButton.className = "deleteButton";
  deleteButton.innerText = "Delete";
  deleteButton.onclick = function() {
      if (confirm("Are you sure you want to delete this note?")) {
          removeNote(index);
          renderNotes();
      }
  };
  
  noteContainer.appendChild(noteElement);
  noteContainer.appendChild(deleteButton);
  document.getElementById("savedNotes").appendChild(noteContainer);
}

// Function to render all saved notes
function renderNotes() {
  var savedNotes = JSON.parse(localStorage.getItem("adminNotes")) || [];
  document.getElementById("savedNotes").innerHTML = "";
  savedNotes.forEach(function(note, index) {
      appendNote(note, index);
  });
}

// Function to save a note to localStorage
function saveNote() {
  var note = document.getElementById("noteInput").value;
  if (note.trim() !== "") {
      var savedNotes = JSON.parse(localStorage.getItem("adminNotes")) || [];
      savedNotes.push(note);
      localStorage.setItem("adminNotes", JSON.stringify(savedNotes));
      renderNotes();
      console.log("Note saved successfully!");
   } else {
      alert("Please write a note before saving.");
  }
}

// Function to remove a note from localStorage
function removeNote(index) {
  var savedNotes = JSON.parse(localStorage.getItem("adminNotes")) || [];
  savedNotes.splice(index, 1);
  localStorage.setItem("adminNotes", JSON.stringify(savedNotes));
}

// Check if there are previously saved notes and render them
document.addEventListener("DOMContentLoaded", function() {
  renderNotes();
});

// Event listener for the Save Note button
document.getElementById("saveButton").addEventListener("click", saveNote);



function TypeWriteTextEffect(){
 // Text to be written with typewriter effect
 const text = 'Developed by Beter Concept Coperate Services Abuja, need help? contact us today at <a href="https://www.beterconcept.com" target="_blank">beterconcept.com</a>';

 // Initialize Typed.js
 const options = {
  strings: [text],
  typeSpeed: 40,
  showCursor: false,
 };

 const typed = new Typed('#text-container', options);
}