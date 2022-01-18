$('#search').on('keyup', function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var url = '/search'
    var data = $('#search').val()
    var method = 'post'
    if (data.length < 3) {
        $('#parent-search_box').addClass('d-none')
        return false;
    }
    $.ajax({
        type: method,
        url: url,
        data: { search: data },
        success: function(result) {
            if (result.length > 0) {
                $('#parent-search_box').removeClass('d-none')
            } else {
                $('#parent-search_box').addClass('d-none')
            }
            var html = ''
            for (let i = 0; i < result.length; i++) {
                html += `<a href="/product-detail/${result[i].id}"><div id="child-result"><img src="${result[i].image}"></img><p id="p-result">${result[i].title}</p></div></a>`
            }
            $('#parent-search_box').html(html)
            console.log(result)
        }
    });
})
$(document).on('click', function(event) {
    if (event.target.id == 'parent-search_box' || event.target.id == 'search' || event.target.id == 'category' || event.target.id == 'p-result') {} else {
        $('#parent-search_box').addClass('d-none')
    }
});
$('#searchProducer').on('keyup', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var url = '/searchProducer'
    var data = $('#searchProducer').val()
    var method = 'post'
    if (data.length < 3) {
        $('#parent-producer_search_box').addClass('d-none')
        return false;
    }
    $.ajax({
        type: method,
        url: url,
        data: { search: data },
        success: function(result) {
            console.log(result.length)
            if (result.length > 0) {
                $('#parent-producer_search_box').removeClass('d-none')
            } else {
                $('#parent-producer_search_box').addClass('d-none')
            }
            var html = ''
            for (let i = 0; i < result.length; i++) {
                html += `<div onclick="fillInput('${result[i].id}','${result[i].title}')" class="producer-child-result" ><img src="${result[i].image}"></img><p id="p-result">${result[i].title}</p></div>`
            }
            $('#parent-producer_search_box').html(html)
            console.log(result)
        }
    });
})
$(document).on('click', function(event) {
    if (event.target.id == 'parent-producer_search_box' || event.target.id == 'search' || event.target.id == 'category' || event.target.id == 'p-result') {} else {
        $('#parent-producer_search_box').addClass('d-none')
    }
});

function fillInput(id, title) {
    $('#searchProducer').val(title)
    $('#parent-producer_search_box').addClass('d-none')
}