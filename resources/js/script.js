let testo = "L'annuncio è a portata di click!", output = "";

let i = 0, speed = 150;

let prova = setInterval(scrivi, speed);

function scrivi() {
    
    if (i == testo.length) 
        clearInterval(prova);

    output += testo.charAt(i);

    if (document.getElementById("testo")) {
        document.getElementById("testo").innerHTML = output;
    }
    
    i++;
}

scrivi();