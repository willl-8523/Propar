//Afficher le diagramme

let aff_btn = document.getElementById("affichage_bouton");
let aff_div = document.getElementById("affichage_div");

//Recuperation des valeurs sur le twig et conversion pour le traitement

let opGrosse = document.getElementById("opGrosse");
opGrosse = Number(opGrosse.textContent);

let opMoyenne = document.getElementById("opMoyenne");
opMoyenne = Number(opMoyenne.textContent);

let opPetite = document.getElementById("opPetite");
opPetite = Number(opPetite.textContent);


Highcharts.chart('container', {
    colors: ['#f0f725','#e63939','#424eed'],
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
    title: {
        text: "Chiffre d' affaires"
    },
    subtitle: {
        text: "Infos confidentielles"
    },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45
        }
    },
    series: [{
        name: 'Operations',
        data: [

            ['GROSSE', opGrosse],
            ['MOYENNE', opMoyenne],
            ['PETITE', opPetite],
        ]
    }],
    credits: {
        enabled: false
    },
});

console.log(opGrosse);
console.log(opMoyenne);

console.log(opPetite);

function bouton(){
  if(getComputedStyle(aff_div).display != "none"){
    aff_div.style.display = "none";
  } else {
    aff_div.style.display = "block";
  }
};
aff_btn.onclick = bouton;