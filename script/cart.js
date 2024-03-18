
//## Function to handle form submission after delay starts here
let submitTimeout;
document.getElementById('quantity').addEventListener('input', function() {
   clearTimeout(submitTimeout); //## Clear previous timeout if exists
   submitTimeout = setTimeout(submitForm, 1000); //## Set new timeout for 1 second
});

//## Function to submit form
function submitForm() {
   //## Check if both fields have values
   const Barcode = document.getElementById('bar_code').value.trim();
   const quantity = document.getElementById('quantity').value.trim();
   
   if (Barcode !== '' && quantity !=='') {
       document.getElementById('barcode_form').submit();
   }

}
//## Function to handle form submission after delay ends here



//## code to add cashier logout btn starts here
let cashier_name = document.querySelector('div.cashier_name');
let logout_btn = document.querySelector('a.cashier_logout');

//## display btn when hovered on
cashier_name.addEventListener('mouseover', (e)=>{
 e.preventDefault();
 
 //## add logout_btn classList
 logout_btn.classList.add('active');
});


//## remove btn when mouse leaves element
cashier_name.addEventListener('mouseleave', (e)=>{
   e.preventDefault();
   
   //## remove logout_btn classList after 2min
   setTimeout(() => {
      logout_btn.classList.remove('active');
   }, 2000);
  });

//## code to add cashier logout btn ends here
