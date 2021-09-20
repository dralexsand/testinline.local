$(document).ready(function () {

    $('body').on('click', '.get_data', function () {

        let id = $(this).attr('id');
        let url, data;

        switch (id) {
            case 'get_data_posts':
                data = {
                    mode: 'get_data_posts',
                    url: 'https://jsonplaceholder.typicode.com/posts',
                }
                url = 'api/v1/get_posts';
                getAjax(url, data);
                break;

            case 'get_data_comments':
                data = {
                    mode: 'get_data_comments',
                    url: 'https://jsonplaceholder.typicode.com/comments'
                }
                url = 'api/v1/get_comments';
                getAjax(url, data)
                break;

            case 'clear_data_db':
                data = {
                    mode: 'clear_data_db',
                }
                url = 'api/v1/clear_data_db';
                getAjax(url, data)
                break;
        }
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

    function addFlashMessage(message) {
        let block_message = '<div class="alert alert-warning alert-dismissible fade show" role="alert">\n' +
            message +
            '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
            '</div>';

        $('#flash_message').html(block_message);
    }

    function setCloseFlashMessage() {
        $('body').on('click', '#close_flash', function () {
            $('#flash_message').html('');
        });
    }

    function refreshAfterLoadData(delay = 5000) {
        setTimeout(function () {
            window.location.reload(1);
        }, delay);
    }

    function successAjax(data, response) {

        let count_items;
        let message = '';

        switch (data.mode) {
            case 'get_data_posts':
                count_items = response.count;
                message = 'Данные posts успешно загружены. ' + response.count + ' записей.';
                addFlashMessage(message);
                console.log(message);
                setCloseFlashMessage();
                refreshAfterLoadData();
                break;

            case 'get_data_comments':
                count_items = response.count;
                message = 'Данные comments успешно загружены. ' + response.count + ' комментариев.';
                addFlashMessage(message);
                console.log(message);
                setCloseFlashMessage();
                refreshAfterLoadData();
                break;

            case 'clear_data_db':
                message = 'Данные удалены';
                addFlashMessage(message);
                console.log(message);
                setCloseFlashMessage();
                refreshAfterLoadData();
                break;
        }
    }

    function errorAjax(data, response) {
        console.log('Error ajax');
    }

});
