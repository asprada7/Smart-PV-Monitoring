function changeBg(button){
    if(button.id == "power"){
        button.style.background = '#006CFF';
        document.getElementById("volt").style.background = '#636363';
        document.getElementById("arus").style.background = '#636363';
    }
    else if(button.id == "volt"){
        button.style.background = '#00AE86';
        document.getElementById("power").style.background = '#636363';
        document.getElementById("arus").style.background = '#636363';
    }
    if(button.id == "arus"){
        button.style.background = '#FF902E';
        document.getElementById("power").style.background = '#636363';
        document.getElementById("volt").style.background = '#636363';
    }
}