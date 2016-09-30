function handleAjaxLink(e) {
 
    e.preventDefault();
 
    var
        $link = $(e.target),
        callUrl = $link.attr('href'),
        formId = $link.data('formId'),
        onDone = $link.data('onDone'),
        onFail = $link.data('onFail'),
        onAlways = $link.data('onAlways'),
        ajaxRequest;
 
 
    ajaxRequest = $.ajax({
        type: "post",
        dataType: 'json',
        url: callUrl,
        data: (typeof formId === "string" ? $('#' + formId).serializeArray() : null)
    });
 
    // Assign done handler
    if (typeof onDone === "string" && ajaxCallbacks.hasOwnProperty(onDone)) {
        ajaxRequest.done(ajaxCallbacks[onDone]);
    }
 
    // Assign fail handler
    if (typeof onFail === "string" && ajaxCallbacks.hasOwnProperty(onFail)) {
        ajaxRequest.fail(ajaxCallbacks[onFail]);
    }
 
    // Assign always handler
    if (typeof onAlways === "string" && ajaxCallbacks.hasOwnProperty(onAlways)) {
        ajaxRequest.always(ajaxCallbacks[onAlways]);
    }
 
}

'simpleDone': function (response) {
    // This is called by the link attribute 'data-on-done' => 'simpleDone'
    console.dir(response);
    $('#ajax_result_01').html(response.body);
}