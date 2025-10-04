<?php
namespace App\Http\Controllers\PowerSchedule;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ServiceWorkerController extends Controller {
    public function index() {
        header("Content-Type: application/javascript");
        // Base path (document root)
        $basePath = $_SERVER['DOCUMENT_ROOT'];

        // List of files to cache (relative URLs)
        $urls = [
            '/assets/power-schedules/css/style.css',
            '/assets/power-schedules/css/bootstrap.min.css',
            '/assets/power-schedules/js/app.js',
            '/assets/power-schedules/js/script.js',
            '/assets/power-schedules/fonts/Dana-Bold.woff2',
            '/assets/power-schedules/fonts/Dana-Regular.woff2',
            '/assets/power-schedules/img/web-icon.webp',
            '/assets/power-schedules/img/web-icon.png',
            '/assets/power-schedules/manifest.json',
        ];

        $versionTime = 0;
        // Add ?v=filemtime for versioning
        $versionedUrls = array_map(function ($url) use ($basePath, &$versionTime) {
            $realPath = $basePath . parse_url($url, PHP_URL_PATH);
            if (file_exists($realPath)) {

                $mtime = filemtime($realPath);

                if ($mtime > $versionTime) {
                    $versionTime = $mtime;
                }

                return $url . '?v=' . $mtime;
            }
            return $url;
        }, $urls);

        array_push($versionedUrls, '/power-schedules/');

        // Convert to JS array string
        $jsArray = "[\n    '" . implode("',\n    '", $versionedUrls) . "'\n]";

        $cacheVersion = 'v' . $versionTime;

        $icon = asset('/assets/power-schedules/img/web-icon.png');

        $script = <<<JS
const CACHE_NAME = 'power-schedules-cache-{$cacheVersion}';
const urlsToCache = {$jsArray};

self.addEventListener('install', event => {
    // self.skipWaiting();
    // event.waitUntil(
    //     caches.open(CACHE_NAME).then(cache => {
    //         return cache.addAll(urlsToCache);
    //     })
    // );
});

self.addEventListener('activate', event => {
    clients.claim();
    event.waitUntil(
        caches.keys().then(keys => {
            return Promise.all(
                keys.filter(key => key !== CACHE_NAME)
                    .map(key => caches.delete(key))
            );
        })
    );
});

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request, { ignoreSearch: false }).then(response => {
            return response || fetch(event.request);
        })
    );
});

// 🔥 Push Event: show notification
self.addEventListener('push', event => {
    let data = {};
    let body = '';
    if (event.data) {
        data = event.data.json();

        const now = new Date();

        if (data.expire) {
            const expireTime = new Date(data.expire);
            if (expireTime < now) {
                return;
            }
        }

        const [hours, minutes] = (data.time).split(":").map(Number);
        const givenTime = new Date();
        givenTime.setHours(hours, minutes, 0, 0);

        let diffMs = givenTime - now;
        let diffMinutes = Math.floor(diffMs / 60000);

        body = "حواست هست؟  " + data.name + " تا " + diffMinutes + " دقیقه دیگه برقش میره!";
    }

    const title = data.title || "Power Alert";
    const options = {
        body: body || "Electricity schedule updated",
        icon: "{$icon}",
        badge: "{$icon}",
        data: data.url || "{route('power-schedules.index')}"
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

// 🔥 Notification click: open link if provided
self.addEventListener('notificationclick', event => {
    event.notification.close();
    if (event.notification.data) {
        event.waitUntil(
            clients.openWindow(event.notification.data)
        );
    }
});
JS;
        return Response::make($script, 200, [
            'Content-Type' => 'application/javascript',
        ]);
    }

}
