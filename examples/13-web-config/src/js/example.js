(function () {
    let time = document.getElementById('time');

    setInterval(function () {
        time.className = (time.className === 'hidden' ? '' : 'hidden');
    }, 300);
})();