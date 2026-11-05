const CACHE_NAME = 'acetvet-v9';

// Only cache static assets - never cache dynamic pages
const STATIC_ASSETS = [
    '/manifest.json',
    '/browserconfig.xml',
    '/images/logo-acetvet-new.png',
    '/images/logo-acetvet.png',
    '/images/hero-slide1.png',
    '/images/hero-slide2.png',
    '/images/hero-slide3-final.png'
];

// Install event - cache only static assets
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('Opened cache for static assets');
                return cache.addAll(STATIC_ASSETS);
            })
    );
});

// Activate event - clean up old caches
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME) {
                        console.log('Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// Fetch event - cache only static assets, bypass everything else
self.addEventListener('fetch', event => {
    const url = new URL(event.request.url);

    // Check if this is a static asset we want to cache
    const isStaticAsset = STATIC_ASSETS.some(asset => url.pathname === asset);
    const isImageRequest = url.pathname.match(/\.(png|jpg|jpeg|gif|webp|svg|ico)$/i);
    const isFontRequest = url.pathname.match(/\.(woff|woff2|ttf|otf|eot)$/i);
    const isCssRequest = url.pathname.match(/\.css$/i);
    const isJsRequest = url.pathname.match(/\.js$/i);

    // Only cache static assets, fonts, images, CSS, and JS
    if (isStaticAsset || isImageRequest || isFontRequest || isCssRequest || isJsRequest) {
        event.respondWith(
            caches.match(event.request)
                .then(response => {
                    if (response) {
                        return response;
                    }

                    return fetch(event.request).then(response => {
                        // Only cache successful responses
                        if (!response || response.status !== 200 || response.type !== 'basic') {
                            return response;
                        }

                        const responseToCache = response.clone();
                        caches.open(CACHE_NAME)
                            .then(cache => {
                                cache.put(event.request, responseToCache);
                            });

                        return response;
                    });
                })
        );
    } else {
        // For all other requests (HTML, dynamic pages), always fetch from network
        event.respondWith(fetch(event.request));
    }
});
