let view = document.getElementById('view');
let prevLink = $('#prevLink');
let nextLink = $('#nextLink');
let stats = $('#stats');

let pagination = {
    total   : '',
    current : '' 
};

let data = {
    page: 1,
    viewType: 'grid',
    sortType: 'desc',
    brands: [],
    colors: []
};

$('#nextPage').on('click', function(){

    if(data.page + 1 <= pagination.total){
        data.page += 1;
        call()
    }

});

$('#prevPage').on('click', function(){

    if(data.page - 1 >= 1) {
        data.page = data.page - 1;
        call()
    }

});

$('input[name="viewType"]').on('click', function(){
    data.viewType = $(this).val();
    call()
})

$('select[name="sortType"]').on('change', function(){
    data.sortType = $(this).val();
    call()
})

$('input[name="brands[]"]').on('change', function(){
    let value = $(this).val();
    let index = data.brands.indexOf(value);

    index !== -1 ? data.brands.splice(index, 1) : data.brands.push(value);
    call()
})

$('input[name="colors[]"]').on('change', function(){
    let value = $(this).val();
    let index = data.colors.indexOf(value);

    index !== -1 ? data.colors.splice(index, 1) : data.colors.push(value);
    call()
})

function gridView(product) {
    return `
    <div class="col-lg-4 col-md-6">
        <div class="product-card">
            <div class="card-head">
                <p class="category"><a href="${ product.category.url }"> ${ product.category[lang('name')] }</a></p>
                <h4><a href="${ product.url }">${ product[lang('name')] }</a></h4>
                ${product.status? `<span class="tag bg-${ product.handled_status[1] }">${ product.handled_status[0] }</span>` : ''}
            </div>
            <div class="image">
                <img class="img-fluid" src="${baseData.url}/storage/${ product.first_image.url }" alt="${ product[lang('name')] }"
                    title="${ product[lang('name')] }">
            </div>
            <div class="info d-flex justify-content-between">
                <p class="price">
                    <span>${money(product.price)} <span>${ baseData.currency }</span></span>
                    ${product.discount? `<del>${ money(product.sell_price) }</del>` : '' }
                </p>
                <div class="d-flex align-self-center">
                    <a href="javascript:void(0)" data-id="${ product.id }" title="${ addToCart }" class="addToCartBtn cart">
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                </div>
            </div>
            <div class="stars">
                ${product.product_rate.join(' ')}
            </div>
        </div>
    </div>
    `
}

function listView(product) {
    return `
    <div class="col-12">
        <div class="product-card horizontal">
            <div class="row">
                <div class="col-sm-4 col-lg-4">
                <div class="image">
                    <img class="img-fluid" src="${baseData.url}/storage/${ product.first_image.url }" alt="${ product[lang('name')] }"
                        title="${ product[lang('name')] }">
                </div>
                </div>
                <div class="col-sm-8 col-lg-8">
                    <div class="card-head">
                        <p class="category"><a href="${ product.category.url }"> ${ product.category[lang('name')] }</a></p>
                        <h4><a href="${ product.url }">${ product[lang('name')] }</a></h4>
                        ${product.status? `<span class="tag bg-${ product.handled_status[1] }">${ product.handled_status[0] }</span>` : ''}
                    </div>
                    <div class="info">
                        <p class="price">
                            <span>${money(product.price)} <span>${ baseData.currency }</span></span>
                            ${product.discount? `<del>${ money(product.sell_price) }</del>` : '' }
                        </p>
                    </div>
                    <div class="stars">
                        ${product.product_rate.join(' ')}
                    </div>
                    <div class="mt-2">
                        <a href="javascript:void(0)" data-id="${ product.id }" title="${ addToCart }" class="addToCartBtn btn btn-primary cart">
                            <i class="fa fa-shopping-cart"></i>
                            <span>${ addToCart }</span>
                        </a>
                    </div>
                </div>                                 
            </div>
        </div>
    </div>
    `
}

function bindProducts(viewType, data) {
    view.innerHTML  = '';
    if(viewType === 'grid'){
        data.forEach(product => {
            view.innerHTML  +=  gridView(product);
        })
    } else {
        data.forEach(product => {
            view.innerHTML  +=  listView(product);
        })
    }
}

function updatePagination() {
    prevLink.attr('href', pagination.prevPage);
    nextLink.attr('href', pagination.nextPage);
    stats.text( pagination.current + '/' + pagination.total)
}

function call(){
    let url = category ? `${baseData.url}/api/shop/${category}` : `${baseData.url}/api/shop`  

    $.ajax({
        url: url,
        method: 'GET',
        data: data,
        success: (res) => {
            bindProducts(data.viewType, res.data)

            pagination.total = res.last_page
            pagination.current = res.current_page
            
            updatePagination();
        } 
    })
}

call()