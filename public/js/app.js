$('.event-link.btn-plus').on('click' , function () {
    $('#newService').fadeIn();
    return false;
});

$('body').on('click', '#modal_window .close, #modal_window .components-Button-Button___btn-default___3bmdJ, #modal_window .components-Modal-Modal___close-button___2MA_D' , function () {
    $('#modal_window').fadeOut();
});
$('body').on('click', '#update_modal .close, #update_modal .components-Button-Button___btn-default___3bmdJ, #update_modal .components-Modal-Modal___close-button___2MA_D' , function () {
    $('#update_modal').html('');
    $('#update_modal').fadeOut();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'header': 'ajax call',
    }
});

$('[data-action=open-modal]').on('click' , function() {
    $('#modal_window').fadeIn();
});



// add new item ajax
$('[data-type=submit]').on('click' , function () {
    //alert();
    var url;
    var request = {};
    var name;
    url = $(this).attr('data-target');
    $('#modal_window input, #modal_window select').each(function () {
        if($(this).prop('type') == 'radio') {
            if($(this).prop('checked') === true) {
                name = $(this).attr('name');
                request[name] = $(this).val();
            }
        }
        else {
            name = $(this).attr('name');
            request[name] = $(this).val();
        }
    });
    $('#modal_window textarea').each(function () {
        name = $(this).attr('name');
        request[name] = $(this).val();
    });
    //console.log(request);
    $.ajax({
        type: "POST",
        url: url,
        data: request,
        dataType: "html",
        success: function(html) {
            $('[data-type=insert-target]').append(html);
            $('#modal_window').fadeOut();
        }
    });
    return false;
});

//show item update form

$('body').on('click' , '[data-type=update]' , function () {
   var url;

   url = $(this).attr('data-link');
    $.ajax({
        type: "POST",
        url: url,
        dataType: "html",
        success: function(html) {
            $('#update_modal').html(html);
            $('#update_modal').fadeIn();
        }
    });
});

//update item ajax
$('body').on('click' , '[data-type=update_submit]', function () {
    var url;
    var request = {};
    var name;
    var target;
    var action;
    url = $(this).attr('data-target');
    target = '#' + $(this).attr('data-insert');
    action = $(this).attr('data-action');
    $('#update_modal input, #update_modal select').each(function () {
        //console.log($(this).prop('checked'));
        if($(this).prop('type') == 'radio') {
            if($(this).prop('checked') === true) {
                name = $(this).attr('name');
                request[name] = $(this).val();
            }
        }
        else {
            name = $(this).attr('name');
            request[name] = $(this).val();
        }

    });
    $('#update_modal textarea').each(function () {
        name = $(this).attr('name');
        request[name] = $(this).val();
    });
    if(action == 'addCalendarEvent') {
        $.ajax({
            type: "POST",
            url: url,
            data: request,
            dataType: "json",
            success: function(result) {
                //console.log(result);
                var newEvent = new Object();

                newEvent.title = result['title'];
                newEvent.start = result['start'];
                newEvent.end = result['end'];
                newEvent.backgroundColor = result['backgroundColor'];
                newEvent.advHTML = result['advHTML'];
                newEvent.allDay = false;
                $('#calendar').fullCalendar( 'renderEvent', newEvent );
                $('#update_modal').fadeOut();
            }
        });
    }
    else if(action == "сalendarEventCancel") {
        $.ajax({
            type: "POST",
            url: url,
            data: request,
            dataType: "json",
            success: function(result) {

                setTimeout(function () {
                    $('#calendar').fullCalendar('removeEvents', Number(result.id));
                    $('#calendar').fullCalendar( 'refetchEvents');
                    $('#update_modal').fadeOut();
                }, 400);
            }
        });
    }
    else if(action == "сalendarEventConfirm") {
        $.ajax({
            type: "POST",
            url: url,
            data: request,
            dataType: "json",
            success: function(result) {

                setTimeout(function () {
                    $('#calendar').fullCalendar( 'removeEventSource', Number(result.id));
                    $('#calendar').fullCalendar( 'renderEvent', result, true );
                    $('#calendar').fullCalendar( 'refetchEvents');
                    $('#update_modal').fadeOut();
                }, 400);

            }
        });
    }
    else {
        $.ajax({
            type: "POST",
            url: url,
            data: request,
            dataType: "html",
            success: function(html) {
                $(target).html(html);
                $('#update_modal').fadeOut();
            }
        });
    }


    return false;
});

// add new inventory to service add/update form

$('body').on('click' , '.components-Input-Input___self___2cl9W .components-Input-Input___container___2dCSs .add-more-inventory', function() {

    var newItemHtml;
    var itemNumber = Number($(this).attr('data-inventory-count'));
    var targetBlock = $(this).attr('data-target-block');
    $(this).attr('data-inventory-count', itemNumber + 1);
    newItemHtml = '<div class="row service-pricing-level" data-inventory-number="'+ itemNumber +'">'
        +'<div class="col-sm-3 col-xs-4 col-sm-4">'
            +'<label class="components-Form-FormField___label___1NQ5t" for="price">Название</label>'
            +'<div class="components-Input-Input___self___2cl9W">'
                +'<div class="components-Input-Input___container___2dCSs">'
                    +'<input type="text" data-input-type="fSearch" data-search-number="'+ itemNumber +'" name="data_inventory['+ itemNumber +'][inventory_name]" class="components-Input-Input___input___1fuFB" onkeyup="fastSearch($(this))" onBlur="HideFastSearchBlock($(this))" data-select="inventory" placeholder="Начните ввод" value="">'
                +'</div>'
            +'</div>'
        +'</div>'
        +'<div class="suggestionsBox"  style="display: none;">'
            +'<div class="suggestionList" >'
            +'</div>'
        +'</div>'
        +'<div class="col-sm-2 col-xs-3 col-sm-3">'
            +'<label class="components-Form-FormField___label___1NQ5t" for="price">Количество</label>'
            +'<div class="components-Input-Input___self___2cl9W">'
                +'<div class="components-Input-Input___container___2dCSs">'
                    +'<input type="number" name="data_inventory['+ itemNumber +'][inventory_quantity]" class="components-Input-Input___input___1fuFB" placeholder="" value="">'
                +'</div>'
            +'</div>'
        +'</div>'
        +'<div class="col-sm-2 col-xs-2 col-sm-3">'
            +'<label class="components-Form-FormField___label___1NQ5t" for="price">Ед. измерения</label>'
            +'<div class="components-Input-Input___self___2cl9W">'
                +'<div class="components-Input-Input___container___2dCSs">'
                    +'<input type="text" data-unit-number="'+ itemNumber +'" disabled="disabled" class="components-Input-Input___input___1fuFB" placeholder="" value="">'
                +'</div>'
            +'</div>'
        +'</div>'
        +'<div class="col-sm-2 col-xs-3 col-sm-2">'
            +'<label class="components-Form-FormField___label___1NQ5t" for="price">Удалить</label>'
            +'<div class="components-Input-Input___self___2cl9W">'
                +'<div class="components-Input-Input___container___2dCSs delete_item">'
                    +'<a class="del-item" data-row-number="'+ itemNumber +'">'
                        +'<img src="/images/delete-item.png" alt="delete-item">'
                    +'</a>'
                +'</div>'
            +'</div>'
        +'</div>'
    +'</div>';
    $(targetBlock).append(newItemHtml);
});

$('body').on('click' , 'a.del-item', function () {
   $('[data-inventory-number='+ $(this).attr('data-row-number') +']').remove();
});

// delete item

$('body').on('click', '[data-type=delete]', function () {
   if(confirm("Вы уверены что хотите удалить элемент "+ $('#update_modal [name=name]').val() +"?")){
       var url = $(this).attr('data-target');
       var target = '#' + $(this).attr('data-insert');
       $.ajax({
           type: "POST",
           url: url,
           dataType: "html",
           success: function(result) {
               console.log(result);
               if(result['success'] == 'Y') {
                   $(target).remove();
                   $('#update_modal').fadeOut();
               }
           }
       });
   }
   else {
       return false
   }
});

// client type changer in the service form
$('body').on('change', '#select_client' , function() {
    //console.log($(this).val(), $(this).prop('checked'));
    var status = $(this).prop('checked');
    if(status === true) {
        $('#new_client').hide();
        $('#new_client input').val('');
        $('#choose_client').fadeIn();
    }
    else {
        $('#choose_client').hide();
        $('#choose_client input').val('');
        $('#new_client').fadeIn();
    }
});

$('body').on('change', '#add_discount_event' , function() {
    //console.log($(this).val(), $(this).prop('checked'));
    var status = $(this).prop('checked');
    if(status === true) {
        $('#add_discount').fadeIn();
    }
    else {
        $('#add_discount').fadeOut();
        $('#add_discount input:not([name=service_cost])').val('');
        $('#add_discount textarea').val('');
    }
});



