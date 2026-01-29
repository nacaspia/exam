/* ------------------------------------------------------------------------------
 *
 *  # Summernote editor (fixed)
 *
 * ---------------------------------------------------------------------------- */

var Summernote = function() {

    // Summernote
    var _componentSummernote = function() {

        // Summernote yüklənməyibsə
        if (typeof $.fn.summernote === 'undefined') {
            console.warn('Warning - summernote.min.js is not loaded.');
            return;
        }

        // Əsas init (imtahan sistemi üçün uyğun toolbar)
        $('.summernote').summernote({
            height: 350,
            placeholder: 'Mətn yaz...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // Hündürlük verilənlər (istəsən saxla)
        $('.summernote-height').summernote({
            height: 400
        });

        // Air mode (istəsən saxla)
        $('.summernote-airmode').summernote({
            airMode: true
        });

        // Click to edit (istəsən saxla)
        $('#edit').on('click', function() {
            $('.click2edit').summernote({ focus: true });
        });

        $('#save').on('click', function() {
            var aHTML = $('.click2edit').summernote('code');
            $('.click2edit').summernote('destroy');
            console.log(aHTML);
        });
    };

    // Uniform (şəkil input stil üçün)
    var _componentUniform = function() {

        // Uniform yoxdursa error verməsin
        if (typeof $.fn.uniform === 'undefined') {
            return;
        }

        $('.note-image-input').uniform({
            fileButtonClass: 'action btn bg-warning-400'
        });
    };

    return {
        init: function() {
            _componentSummernote();
            _componentUniform();
        }
    }

}();


// Initialize
document.addEventListener('DOMContentLoaded', function() {
    Summernote.init();
});
// $(document).on('click', '.note-btn-group .dropdown-toggle', function (e) {
//     e.stopPropagation();
// });
