 //Hämta öppna och stängknapparna
 let openBtn = document.getElementById("open-menu");
 let closeBtn = document.getElementById("close-menu");
 //skapa eventlyssnare
 openBtn.addEventListener('click', getMenu);
 closeBtn.addEventListener('click', getMenu);

 //Få fram navigeringsmeny

 function getMenu() {
     let navEl = document.getElementById("menu-nav");

     //Hämta in css för meny
     let style = window.getComputedStyle(navEl);

     //Test om navigering är synlig eller inte, ändra display mellan none & block
     if (style.display === "none") {
         navEl.style.display = "block";
     } else {
         navEl.style.display = "none";
     }
 }
 function init() {
     window.onload = init;
 }