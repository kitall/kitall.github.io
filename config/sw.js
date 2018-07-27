const arqs = [
    'index.html',
    'app.js',
    'sw.js'
];

self.addEventListener('install', async function (e)
{
    var cached2 = await caches.open('kitall-static');
    cached2.addAll(arqs);
});

self.addEventListener('fetch', event =>
{
    event.respondWith(checkCache(event.request));
});

async function checkCache(req)
{
    const cachedResponse = await caches.match(req);
    return fetch(req) || cachedResponse;
}