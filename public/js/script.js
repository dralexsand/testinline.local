$(document).ready(function () {
    console.log('jquery init');

    $('body').on('click', '.get_data', function () {

        let id = $(this).attr('id');
        let url, data;

        switch (id) {
            case 'get_data_posts':
                data = {
                    mode: 'get_data_posts',
                    url: 'https://jsonplaceholder.typicode.com/posts',
                }
                url = 'api/v1/ajax/get_posts';
                getAjax(url, data);
                break;

            case 'get_data_comments':
                data = {
                    mode: 'get_data_comments',
                    url: 'https://jsonplaceholder.typicode.com/comments'
                }
                url = 'api/v1/ajax/get_comments';
                getAjax(url, data)
                break;

            case 'clear_data_db':
                data = {
                    mode: 'clear_data_db',
                }
                url = 'api/v1/ajax/clear_data_db';
                getAjax(url, data)
                break;
        }
        console.log(url);
    });

    function getAjax(url, data = null) {

        $.ajaxSetup({
            headers:
                {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $.ajax({
            type: "POST",
            url,
            data,
            success: function (response) {
                successAjax(data, response);
            },
            error: function (response) {
                errorAjax(data, response);
            },
        });
    }

    function addFlashMessage1(message) {
        let block_message = '<strong>' + message + '</strong>\n' +
            '            <button id="close_flash" type="button" class="close" data-dismiss="alert">\n' +
            '                ×\n' +
            '            </button>';

        //$('#flash_message').addClass('alert-warning');
        $('#flash_message').html(block_message);
    }

    function addFlashMessage(message) {
        let block_message = '<div class="alert alert-warning alert-dismissible fade show" role="alert">\n' +
            message +
            '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
            '</div>';

        //$('#flash_message').addClass('alert-warning');
        $('#flash_message').html(block_message);
    }

    function setCloseFlashMessage() {
        $('body').on('click', '#close_flash', function () {
            $('#flash_message').html('');
            //$('#flash_message').removeClass('alert-warning');
        });
    }

    function refreshAfterLoadData(delay = 5000) {
        setTimeout(function () {
            window.location.reload(1);
        }, delay);
    }

    function successAjax(data, response) {
        console.log('Success ajax');
        console.log(response);

        let mode = data.mode;
        let count_items;

        switch (data.mode) {
            case 'get_data_posts':
                count_items = response.count;
                addFlashMessage('Данные posts успешно загружены. ' + response.count + ' записей.');
                setCloseFlashMessage();
                refreshAfterLoadData();
                break;

            case 'get_data_comments':
                count_items = response.count;
                addFlashMessage('Данные comments успешно загружены. ' + response.count + ' комментариев.');
                setCloseFlashMessage();
                refreshAfterLoadData();
                break;

            case 'clear_data_db':
                addFlashMessage('Данные удалены');
                setCloseFlashMessage();
                refreshAfterLoadData();
                break;

            case 'search_text':
                break;
        }
    }

    function errorAjax(data, response) {
        console.log('Error ajax');
    }


    $('body').on('click', '#close_flash', function () {
        $('#flash_message').html('');
    });

    $('body').on('click', '#btn_search', function () {
        console.log('btn_search clicked');
    });

    $('body').on('keyup change', '#text_search', function () {
        let text_search = $(this).val();
        if (text_search.length > 2) {
            console.log('Text search: ' + text_search);
            let data = {
                mode: 'search_text',
                text: text_search,
            }
            let url = 'api/v1/ajax/search_text';
            getAjax(url, data)
        }
    });


});
