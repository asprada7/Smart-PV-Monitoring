function changeBg(button){
    if(button.id == "power"){
         button.style.background = '#006CFF';
         document.getElementById("volt").style.background = '#636363';
         
         document.getElementById("linegrafik").style.display = "block";
         document.getElementById("linegrafik2").style.display = "none";
         

    }
    else if(button.id == "volt"){
         button.style.background = '#00AE86';
         document.getElementById("power").style.background = '#636363';
         
         document.getElementById("linegrafik").style.display = "none";
         document.getElementById("linegrafik2").style.display = "block";
         
    }
    
}
