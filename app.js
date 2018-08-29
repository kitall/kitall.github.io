window.addEventListener('load', function (e) {
    if ('serviceWorker' in navigator) {
        try {
            navigator.serviceWorker.register('sw.js');
        } catch (error) {
            console.log("SOMETHING WENT WRONG!\n" + error);
        }

    }
});