$(document).ready(function() {
    $('#pic').click(function() {
        htmlToImage.toJpeg($('#uml')[0], { quality: 0.95 })
            .then(function (dataUrl) {
                var link = document.createElement('a');
                link.download = 'my-image-name.jpeg';
                link.href = dataUrl;
                link.click();
            });
    });
});