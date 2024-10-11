window.addEventListener('changeViewMode',function (data) {
    $('.view-mode')
        .removeClass('view-mode-create')
        .removeClass('view-mode-edit')
        .removeClass('view-mode-list')
        // .removeClass('view-mode-monthly-productions')
        .addClass('view-mode-' + data.detail.mode);

    $('.view-mode .card-title').html(data.detail.page_title);

    let page_title = data.detail.page_title;

    if(typeof APP_NAME != 'undefined') {
        page_title = APP_NAME + ' | ' + data.detail.page_title;
    }

    $('head title').html(page_title);

    $('#datasetsTable').DataTable().draw(false)

    if(data.detail.current_page_url??null) {
        let newurl = data.detail.current_page_url;
        window.history.pushState({path:newurl}, page_title, newurl);
    }
})
