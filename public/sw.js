const CACHE_NAME = 'surface-media-cache-v1';
const urlsToCache = [
    '/',
    '/css/bootstrap.css',
    '/css/style.css',
    '/js/jquery.min.js',
    '/js/bootstrap.min.js',
    '/js/main.js',
    '/images/logo/logo.png'
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                return cache.addAll(urlsToCache);
            })
    );
});

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                if (response) {
                    return response;
                }
                return fetch(event.request);
            })
    );
});
