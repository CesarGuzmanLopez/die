function abrirMediaUploader() {
    // Open the WordPress media uploader
    var customMediaUploader = wp.media({
        title: 'Seleccionar Imágenes',
        button: {
            text: 'Insertar Imágenes'
        },
        multiple: true // Allow multiple image selection
    });

    // When images are selected or uploaded
    customMediaUploader.on('select', function () {
        var attachments = customMediaUploader.state().get('selection');
        var imageUrls = [];

        attachments.each(function (attachment) {
            // Get the URL of each selected image
            imageUrls.push(attachment.attributes.url);
        });

        // Update the input field with comma-separated image URLs
        var customMediaUrlInput = document.querySelector('.custom-media-url');
        if (customMediaUrlInput) {
            customMediaUrlInput.value = imageUrls.join(', ');
        }
    });

    // Open the media uploader dialog
    customMediaUploader.open();
}
