const publicVapidKey = 'BCyyTIno3rAKtcTrEvUSrD3op5VkAj8UH4_k2ozhy7YaIsgl0n0SP2NF6A0uFKq2_4nLuJu0ZZxPYWnd4hWZC9U';

async function registerServiceWorker() {
    window.sw = await navigator.serviceWorker.register(swUrl)
        .then(res => {
            console.log('Service Worker registered');
            return res;
        });


}

// Utility to convert base64 to UInt8Array
function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');
    const rawData = atob(base64);
    return Uint8Array.from([...rawData].map(char => char.charCodeAt(0)));
}

registerServiceWorker();

let deferredPrompt;
const addBtn = document.querySelector('.add-button');

window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;

    addBtn.addEventListener('click', () => {
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
                console.log('Accepted');
            } else {
                console.log('Declined');
            }
            deferredPrompt = null;
        });
    });
});


