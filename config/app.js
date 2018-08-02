window.addEventListener('load', function(e)
{
    if('serviceWorker' in navigator)
    {
        try {
            navigator.serviceWorker.register('sw.js');
            console.log('sw ok');
        } catch (error) {
            console.log('sw fail');
        }
        
    }
});