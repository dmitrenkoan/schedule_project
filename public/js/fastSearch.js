//hide fast search result
function HideFastSearchBlock(InputObject) {
    InputObject.closest('.row.service-pricing-level').find('.suggestionsBox').fadeOut(400);
}

//show fast search result for services page add/update  form
function showNewItemResult(Object) {
    $('[data-rest-number='+ Object.attr('data-row-number') +']').val(Object.attr('data-quantity'));
    $('[data-search-number='+  Object.attr('data-row-number') +']').val(Object.text());
    $('[data-unit-number='+ Object.attr('data-row-number') +']').val(Object.attr('data-unittype'));
}

function showNewServiceResult(Object) {
    Object.closest('.row.service-pricing-level').find('input[name=service_name]').val(Object.text());
    Object.closest('.components-Form-FormField___self___10VZD').find('input[name=service_duration]').val(Object.attr('data-duration'));
}

function showNewClientsResult(Object) {
    Object.closest('.row.service-pricing-level').find('input[name=client_name]').val(Object.text());
    //console.log(Object.attr('data-itemid'));
    Object.closest('.row.service-pricing-level').find('input[name=client_id]').val(Object.attr('data-itemid'));
}
// fast search inventory
/*$('body [data-input-type=fSearch]').keyup(function() {
//$('body').on('change' ,'#inputString' , function() {
    console.log($(this).attr('data-search-number'));
    var searchInput;
    searchInput = $(this);

    if(searchInput.val().length > 2) {
        $.ajax({
            type: "POST",
            url: '/fast_search',
            data: { searchRequest: searchInput.val(), searchTarget: searchInput.attr('data-select'), rowNumber: searchInput.attr('data-search-number') },
            dataType: "html",
            success: function(data) {
                searchInput.siblings('.suggestionsBox').show();
                searchInput.siblings('.suggestionsBox').children('.suggestionList').html(data);
            }
        });
    } else {
        // Hide the suggestion box.
        searchInput.siblings('.suggestionsBox').hide();

    }
});*/
function fastSearch(curObject) {
    var searchInput, staffId;
    searchInput = curObject;

    if(searchInput.val().length >= 1) {
        if (searchInput.attr('data-select') == 'inventory') {
            staffId = searchInput.closest('.components-Loader-Loader___children___1nSg3').find('select[name=staff_id]').val();
            //console.log(staffId, 111);
        }
        else {
            staffId = searchInput.attr('data-staff');
        }
        $.ajax({
            type: "POST",
            url: '/fast_search',
            data: { searchRequest: searchInput.val(), searchTarget: searchInput.attr('data-select'), rowNumber: searchInput.attr('data-search-number'), staff_id: staffId},
            dataType: "html",
            success: function(data) {
                searchInput.closest('.row.service-pricing-level').find('.suggestionsBox').show();
                searchInput.closest('.row.service-pricing-level').find('.suggestionList').html(data);
            }
        });
    } else {
        // Hide the suggestion box.
        HideFastSearchBlock(searchInput);

    }
}

function fastSearchReset(object, target) {
    object.closest(target).find('[data-input-type=fSearch]').each(function() {
       $(this).val('');
    });
}

// fast search result
/*$('body').on('click' , '.suggestionsBox .suggestionList ul li' , function() {
    var curObject = $(this);
    showNewItemResult(curObject);
    //curObject.closest('.suggestionsBox').hide();
});*/





