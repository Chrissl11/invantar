(function() {
    const itemsPerPage = document.getElementById('itemsPerPage');

    itemsPerPage.addEventListener('change', function () {
        const url = new URL(window.location);
        url.searchParams.set('itemsPerPage', this.value);

        window.location = url;
    });
})();
