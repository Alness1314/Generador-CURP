/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
const PRECACHE = 'generador_curp-v1';
const RUNTIME = 'runtime';

const URLS_A_CACHE = [
];

self.addEventListener('install', e => {
    console.log('Evento: SW Instalando...', e);
    e.waitUntil(
            caches.open(PRECACHE)
            .then(cache => {
                console.log('Cache abierto, Archivos en cache')
                return cache.addAll(URLS_A_CACHE)
            })
            .then(self.skipWaiting())
            .catch(error => console.log('Fallo registro de cache', error))
            )
})



self.addEventListener('activate', e => {
    console.log('Evento: SW Activando...', e)

    const cacheActual = [PRECACHE, RUNTIME];

    e.waitUntil(
            caches.keys()
            .then(cacheNames => {
                return cacheNames.filter(cacheName => {
                    return !cacheActual.includes(cacheName)
                });
            })
            .then(cachesToDelete => {
                return Promise.all(cachesToDelete.map(cacheToDelete => {
                    return caches.delete(cacheToDelete);
                }));
            })
            .then(() => {
                self.clients.claim()
            })
            .then(() => {
                console.log('El cache esta limpio y actualizado')
            })
            );
});


self.addEventListener('fetch', e => {
    console.log('Evento: SW recuperando', e)
    var queryurl = e.request.url.split("?");
    var phpulr = e.request.url.split(".php");

    var reloadAll = (queryurl.length > 0 || phpulr.length > 0);
    if (e.request.url.startsWith() && e.request.method == "POST" && !reloadAll) {
        e.respondWith(
                caches.match(event.request).then(function (cachedResponse) {
            if (cachedResponse) {
                return cachedResponse;
            }
            return caches.open(RUNTIME).then(function (cache) {
                return fetch(event.request).then(function (response) {
                    return cache.put(event.request, response.clone()).then(function () {
                        return response;
                    });
                });
            });
        })
                );
    }

});

