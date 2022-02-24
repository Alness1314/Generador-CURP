/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//validamos si el navegador soporta service worker
if('serviceWorker' in navigator){
    console.log('Service Worker soportado')
    window.addEventListener('load',()=>{
        navigator.serviceWorker.register('./sw.js')
        .then(registration =>{
            console.log(registration)
            console.log('Service Worked registrado con exito',registration.scope)
        })
        .catch(error => console.log('Registro fallido',error))
    })
}

