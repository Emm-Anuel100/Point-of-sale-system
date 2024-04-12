
// light/dark mode toggle starts here
// let theme_btn = document.querySelector('.theme_btn');
// theme_btn.onclick = (e) =>{
// e.preventDefault();

// let page_body = document.body;
// page_body.classList.toggle('light_mode');
// }
// light/dark mode toggle ends here



     // JavaScript function to show corresponding page section
     function showPage(sectionNumber) {
      // Hide all page sections
      var sections = document.getElementsByClassName('page');
      for (var i = 0; i < sections.length; i++) {
        sections[i].style.display = 'none';
      }
      
      // Show the selected page section
      document.getElementById('section' + sectionNumber).style.display = 'block';
  
      // Remove 'active' class from all buttons
      var buttons = document.querySelectorAll('.nav_bars a.nav i');
      for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('active');
      }
  
      // Add 'active' class to the clicked button
      document.getElementById('btn' + sectionNumber).classList.add('active');
    }

    
    // When help btn is clicked
     document.querySelector("#btn13").addEventListener('click', ()=>{
      // invoke TypeWriteTextEffect() function
      TypeWriteTextEffect();
     })

  

  // Typewriter effect fuction starts here
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
 // Typewriter effect fuction ends here
 


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



//##  Sales Price calculator starts here
const purchasePriceInputs = document.querySelectorAll('.purchase_price');
const salePercentInputs = document.querySelectorAll('.sale_percent');
const salesOutputs = document.querySelectorAll('.interest');

// Function to calculate interest
function calculateInterest() {
    purchasePriceInputs.forEach(function(purchasePriceInput, index) {
        const salePercentInput = salePercentInputs[index];
        const salesOutput = salesOutputs[index];

        const purchasePrice = parseFloat(purchasePriceInput.value);
        const salePercent = parseFloat(salePercentInput.value);

        // Calculate interest
        const interest = (purchasePrice * salePercent) / 100;

        // Add interest to purchase price
        const salesPrice = interest + purchasePrice;

        // Display the sales price with 2 decimal places
        salesOutput.textContent = salesPrice.toFixed(2);
    });
}

// Attach event listeners to the input fields
salePercentInputs.forEach(function(salePercentInput) {
    salePercentInput.addEventListener('input', calculateInterest);
});

purchasePriceInputs.forEach(function(purchasePriceInput) {
    purchasePriceInput.addEventListener('input', calculateInterest);
});
//## sales Price calculator ends here