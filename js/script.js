/*===== SHOW NAVBAR  =====*/ 
const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId),
    bodypd = document.getElementById(bodyId),
    headerpd = document.getElementById(headerId)

    // Validate that all variables exist
    if(toggle && nav && bodypd && headerpd){
        toggle.addEventListener('click', ()=>{
            // show navbar
            nav.classList.toggle('show')
            // change icon
            toggle.classList.toggle('bx-x')
            // add padding to body
            bodypd.classList.toggle('body-pd')
            // add padding to header
            headerpd.classList.toggle('body-pd')
        })
    }
}
showNavbar('header-toggle','nav-bar','body-pd','header')


/*===== LINK ACTIVE  =====*/ 
const linkColor = document.querySelectorAll('.nav__link')

function colorLink(){
    if(linkColor){
        linkColor.forEach(l=> l.classList.remove('active'))
        this.classList.add('active')
    }
}
linkColor.forEach(l=> l.addEventListener('click', colorLink))

let valueDisplays = document.querySelectorAll(".num");
let interval = 1000;
valueDisplays.forEach((valueDisplays) => {
   let startValue = 0;
   let endValue = parseInt(valueDisplays.getAttribute("data-val"));
   let duration = Math.floor(interval / endValue);
   let counter = setInterval(function (){
      startValue += 1;
      valueDisplays.textContent = startValue;
      if(startValue == endValue){
         clearInterval(counter);
      }
   }, duration)
});

/*============== faqs ==============*/
let toggles = document.getElementsByClassName('toggle');
let contentDiv = document.getElementsByClassName('content');
let icons = document.getElementsByClassName('icon');

for (let i = 0; i < toggles.length; i++) {
  toggles[i].addEventListener('click', () => {
    let isOpen = contentDiv[i].style.height === contentDiv[i].scrollHeight + "px";
    // Toggle the clicked FAQ
    if (!isOpen) {
      contentDiv[i].style.height = contentDiv[i].scrollHeight + "px";
      toggles[i].style.color = "#0A2472";
      icons[i].classList.replace('bx-chevron-down', 'bx-chevron-up');
    } else {
      contentDiv[i].style.height = "0px";
      toggles[i].style.color = "#000000";
      icons[i].classList.replace('bx-chevron-up', 'bx-chevron-down');
    }
    // Close other FAQs
    for (let j = 0; j < contentDiv.length; j++) {
      if (j !== i) {
        contentDiv[j].style.height = "0px";
        toggles[j].style.color = "#000000";
        icons[j].classList.replace('bx-chevron-up', 'bx-chevron-down');
      }
    }
  });
}

contentDiv[0].style.height = contentDiv[0].scrollHeight + "px";
toggles[0].style.color = "#0A2472";
icons[0].classList.replace('bx-chevron-down', 'bx-chevron-up');
function adjustAboutHeight() {
  let faqs = document.querySelector('.faqs'); 
  let aboutSection = document.querySelector('.abt'); 
  let faqsHeight = faqs.scrollHeight; // Menghitung tinggi asli termasuk konten tersembunyi
  let activeFaqs = faqs.querySelectorAll('.faq-item.active'); // Ambil semua FAQ yang terbuka

  // Jika tidak ada yang terbuka, gunakan tinggi minimum
  if (activeFaqs.length === 0) {
    aboutSection.style.height = (faqsHeight * 0.7) + "px"; // 50% dari tinggi default
  } else {
    aboutSection.style.height = (faqsHeight * 0.8) + "px"; // 80% jika ada yang terbuka
  }
}

// Tambahkan event listener jika FAQ diklik
document.querySelectorAll('.faq-item').forEach(item => {
  item.addEventListener('click', () => {
    item.classList.toggle('active'); // Tandai apakah terbuka
    adjustAboutHeight();
  });
});

