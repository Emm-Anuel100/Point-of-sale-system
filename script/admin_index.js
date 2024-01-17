
// change password input type
let input = document.querySelector('.passsword-input');
let change_type_btn = document.querySelector('.password-view');

// change type of input when btn is clicked
change_type_btn.addEventListener('click', (e)=>{
   e.preventDefault;
   // check current type in input box and change it 
   if (input.type === "password") {
      input.type = "text";
      change_type_btn.textContent = "hide";
   } else {
      input.type = "password";
      change_type_btn.textContent = "view";
   }
});



