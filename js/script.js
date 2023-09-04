navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}

function loader(){
   document.querySelector('.loader').style.display = 'none';
}

function fadeOut(){
   setInterval(loader, 2000);
}

window.onload = fadeOut;

document.querySelectorAll('input[type="number"]').forEach(numberInput => {
   numberInput.oninput = () =>{
      if(numberInput.value.length > numberInput.maxLength) numberInput.value = numberInput.value.slice(0, numberInput.maxLength);
   };
});

// Assuming you have a function to remove the message element
function removeMessage(element) {
   element.parentElement.removeChild(element);
 }
 
 // After displaying the message, add the following code to remove it after a certain time
 var messageElement = document.querySelector('.message');
 setTimeout(function() {
   messageElement.classList.add('fadeOut');
   setTimeout(function() {
     removeMessage(messageElement);
   }, 3000); // Wait for the animation duration before removing the element
 }, 5000); // Adjust the time (in milliseconds) before the message starts to fade out
 