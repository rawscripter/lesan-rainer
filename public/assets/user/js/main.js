// scroll top script
$(window).scroll(function () {
    if ($(this).scrollTop() > 20) {
        $('#scroll_up').fadeIn();
    } else {
        $('#scroll_up').fadeOut();
    }
});

$('#scroll_up').on('click', function (event) {
    event.preventDefault();
    /* Act on the event */
    $('html , body').animate({scrollTop: 0}, 500);
});

$(document).ready(function () {
    $(document).on('click', '.callArtDetailsModal', function () {
        var art = $(this).data('art');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/art/' + art + '/details',
            type: "GET",
            success: function (data) {
                $('#callBackModal').html(data.modal);
                $('.bd-example-modal-xl').modal('show');
            }
        });
    })
});
$(document).ready(function () {
    $(document).on('click', '.callInstallationDetailsModal', function () {
        var installation = $(this).data('installation');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/installation/' + installation + '/details',
            type: "GET",
            success: function (data) {
                $('#callBackModal').html(data.modal);
                $('.bd-example-modal-xl').modal('show');
            }
        });
    })
});

$(document).ready(function () {
    $(document).on('click', '.callExhibitionDetailsModal', function () {
        var exhibiton = $(this).data('exhibiton');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/exhibitions/' + exhibiton + '/details',
            type: "GET",
            success: function (data) {
                $('#callBackModal').html(data.modal);
                $('.bd-example-modal-xl').modal('show');
            }
        });
    })
});
