
$(function () {
    $('body').on('submit','#compare_date_form form',function (e) {
        e.preventDefault();
        let form = $(this);
        let input = form.find('textarea');
        if (input.val().length === 0){
            showAlert('Заполните поле с датой',false);
            return false;
        }
        form[0].submit();
    });

    $('body').on('click','.ajax_send_date',function () {
        let input = $('#compare_date_form textarea');
        if (input.val().length === 0){
            showAlert('Заполните поле с датой',false);
            return false;
        }
        $.ajax({
            type:'POST',
            url:'/compare-ajax',
            dataType:'json',
            data:{date:input.val()},
            success:function (data) {
                showAlert(data.message,data.status)
                if (data.status)
                    $('#compare_date_form #result').replaceWith('<div id="result"> <span>Результат:&nbsp;'+data.result+'&nbsp;дня</span></div>')
            }
        })

    });
})
/**
 *
 * @param text
 * @param status available values => ['true','false'];
 */
function showAlert(text, status = true) {
    let alert_class = 'success';
    if (!status)
        alert_class = 'danger';
    let html = '<div id="alert" class="alert alert-' + alert_class + '"><button type="button" class="close" data-dismiss="alert">&times;</button>'
        + text + '</div>';
    $('#alert').replaceWith(html);
    $('#alert').fadeIn();
    let height = $('#alert').outerHeight();
    clearTimeout();
    setTimeout(function () {
        $('#alert').animate({
            'top': -height
        }, 700);
    }, 2500);
}
