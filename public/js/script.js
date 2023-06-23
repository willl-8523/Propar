const description = document.getElementsByTagName('textarea')[0];
const ajout = document.getElementById('ajout');
const dashboardLink = document.getElementsByClassName('dashboard-link');
const error = document.getElementById('error');

if (error) {
  error.addEventListener('click', (e) => {
    let el = e.target;
  });
  
  setTimeout(() => {
    error.classList.add("mess");
  }, '3000');
}

if (ajout) {
    
    let valeurDescription = description.getAttribute('placeholder');
    
    ajout.addEventListener("click", ()=> {
        description.innerText = valeurDescription;
    });
}


for (let item of dashboardLink) {
    item.addEventListener('mouseover', (e) => {
      item.classList.add('m-dashboard');
    });

    item.addEventListener('mouseout', (e) => {
      item.classList.remove('m-dashboard');
    });
}


