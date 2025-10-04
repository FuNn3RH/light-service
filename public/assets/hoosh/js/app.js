if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/ifekr/sw.js').then((registration) => {
        console.log('ServiceWorker registration successful with scope: ', registration.scope);
    });
}

let deferredPrompt;
const addBtn = document.querySelector('#pwa-btn');

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
