(function() {
    const itemsPerPage = document.getElementById('itemsPerPage');


    itemsPerPage.addEventListener('change', function () {
        this.value;
        console.log(itemsPerPage, this);
        //window.location.href = "https://inventar-app.ddev.site/products?itemsPerPage=" + this.value;
    });



})();
