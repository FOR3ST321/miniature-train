$("#gender_filter").on("change", function () {

    window.location = '/home/' + $(this).val();
});