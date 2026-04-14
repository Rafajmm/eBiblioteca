//calcular fechas para comentarios, tablón, etc
function calcularTiempoRelativo(fechaDB){
    const fecha=new Date(fechaDB.replace(/-/g,"/"));
    const ahora=new Date();
    
    const diferenciaSegundos=Math.floor(ahora-fecha)/1000;
    if(diferenciaSegundos < 60){
        return "hace unos segundos";
    }

    const diferenciaMinutos=Math.floor(diferenciaSegundos/60);
    if(diferenciaMinutos < 60){
        return `hace ${diferenciaMinutos} ${diferenciaMinutos === 1 ? 'minuto' : 'minutos'}`;
    }

    const diferenciaHoras=Math.floor(diferenciaMinutos/60);
    if(diferenciaHoras < 24){
        return `hace ${diferenciaHoras} ${diferenciaHoras === 1 ? 'hora' : 'horas'}`;
    }

    const diferenciaDias=Math.floor(diferenciaHoras/24);
    if(diferenciaDias < 7){
        return `hace ${diferenciaDias} ${diferenciaDias === 1 ? 'día' : 'días'}`;
    }

    const opciones={year:'numeric', month:'long', day:'numeric'};
    return fecha.toLocaleDateString('es-ES', opciones);    
}
function actualizarFechas(){
    const elementosFecha=document.querySelectorAll('.fecha');
    elementosFecha.forEach(elemento => {
        const fechaBD=elemento.getAttribute('data-fecha');
        if(fechaBD){
            elemento.textContent=calcularTiempoRelativo(fechaBD);
        }
    });
}
document.addEventListener('DOMContentLoaded', ()=>{
    actualizarFechas();
    setInterval(actualizarFechas, 60000);
});

//


