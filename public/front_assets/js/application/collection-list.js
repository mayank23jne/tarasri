var productsLimit = 12;
var productsOffset = 0;
var filterItems = {};

//filterCollections()
$(document).ready(function(){

    $("body").on("click","input[name='collection']",function(){

        filterCollections();
        let collection = getSelectedCollectionValues();

        $.post(BASE_URL+"/application/get-filter-items",{
            collection:collection
        },function (data) {
            data = parseJson(data);
            if(data.success){
                var categories = data.items['categories'];
                var occations = data.items['occations'];
                var stones = data.items['stones'];


                if(categories.length > 0){
                    var categoryTag = "";
                    for(var i = 0; i < categories.length; i++){
                        categoryTag = categoryTag+'<li>\n' +
                            '                                        <label class="options-checkbox position-relative pointer">\n' +
                            '                                            <input value="'+categories[i]["id"]+'" name="category" type="checkbox">\n' +
                            '                                            <span class="custom-checkbox"></span>\n' +
                            '                                            <span>'+categories[i]["categorey_name"]+'</span>\n' +
                            '                                        </label>\n' +
                            '                                    </li>'
                    }
                    $(".category-sec").html(categoryTag);
                }
                if(occations.length > 0){
                    var occationTag = "";
                    for(var i = 0; i < occations.length; i++){
                        occationTag = occationTag+'<li>\n' +
                            '                                        <label class="options-checkbox position-relative pointer">\n' +
                            '                                            <input name="occassion" value="'+occations[i]["id"]+'"\n' +
                            '                                                   type="checkbox">\n' +
                            '                                            <span class="custom-checkbox"></span>\n' +
                            '                                            <span>'+occations[i]["occassion_name"]+'</span>\n' +
                            '                                        </label>\n' +
                            '                                    </li>'
                    }
                    $(".occation-sec").html(occationTag);
                }

                    var stoneTag = "";
                            $.each(stones, function (i, file) {
                                    stoneTag = stoneTag+'<li>\n' +
                                        '                                                            <label class="options-checkbox position-relative pointer">\n' +
                                        '                                                                <input value="'+i+'" name="stone" type="checkbox">\n' +
                                        '                                                                <span class="custom-checkbox"></span>\n' +
                                        '                                                                <span>'+file+'</span>\n' +
                                        '                                                            </label>\n' +
                                        '                                                        </li>'

                            });


                    $(".stone-sec").html(stoneTag);

            }
        })

    })
        .on("click","input[name='category']",function(){

        filterCollections();

    }).on("click","input[name='occassion']",function(){

        filterCollections();

    }).on("click","input[name='gender']",function(){

        filterCollections();

    }).on("click","input[name='stone']",function(){

        filterCollections();
    }).on("click","#btnClearall",function(){

        $('#filterCollapse .options-checkbox input').prop("checked", false);
        $("#collapseCollectionName").removeClass("show");
        filterCollections();

    }).on("click","#bG9hZE1vcmVCdG4",function(){
        var offsetElement = $("#cHJvZHVjdHNPZmZzZXQ");
        productsOffset = parseInt(offsetElement.val());
        productsOffset = productsOffset + productsLimit;
        offsetElement.val(productsOffset);

        filterCollections(true);
    })

});


function filterCollections(isAppend){

    if(isAppend == undefined){
        resetProductsOffset();
    }

    let gender = getSelectedGenderValues();
    if(gender.length){
        filterItems['gender'] = gender;
    }else{
        delete filterItems.gender;
    }

    let collection = getSelectedCollectionValues();
    if(collection.length){
        filterItems['collection'] = collection;
    }else{
        delete filterItems.collection;
    }


    let occassion = getSelectedOccassionValues();
    if(occassion.length){
        filterItems['occassion'] = occassion;
    }else{
        delete filterItems.occassion;
    }

    let stone = getSelectedStoneValues();
    if(stone.length){
        filterItems['stone'] = stone;
    }else{
        delete filterItems.stone;
    }

    let category = getSelectedCategoryValues();
    if(category.length){
        filterItems['category'] = category;
    }else{
        delete filterItems.category;
    }


    $.post(BASE_URL+"/application/collection-list-partial",{
        filterItems :filterItems,
        offset : productsOffset,
        limit : productsLimit
    },function(response){


        if(isAppend){
            $("#cHJvZHVjdHNDb3VudA").remove();
            $("#cHJvZHVjdHNMaXN0V3JhcHBlcg").append(response);

           /* if(!$.trim(response).length){
                hideLoadMoreBtn();
            }*/


        }else{

            if(!$.trim(response).length){
                showNoProductsMessage();
            }else{
                hideNoProductsMessage();
            }
            $("#cHJvZHVjdHNMaXN0V3JhcHBlcg").html(response);
        }

        if(parseInt($("#cHJvZHVjdHNDb3VudA").val()) >= 12){
            showLoadMoreBtn();
        }else{
            hideLoadMoreBtn();
        }



        $('#cHJvZHVjdHNMaXN0V3JhcHBlcg').BlocksIt({
            destroy: true
        }).BlocksIt({
            numOfCol: col,
            offsetX: 8,
            offsetY: 8,
            blockElement: '.product-block'
        });

    });



}

function hideLoadMoreBtn(){
    $("#bG9hZE1vcmVCdG4").hide();
}

function showLoadMoreBtn(){
    $("#bG9hZE1vcmVCdG4").show();
}

function resetProductsOffset(){
    productsOffset = 0;
    $("#cHJvZHVjdHNPZmZzZXQ").val(productsOffset);
}

function showNoProductsMessage(){
    $(".no-products-wrapper").show();
}

function hideNoProductsMessage(){
    $(".no-products-wrapper").hide();
}


function getSelectedGenderValues(){
    return $("input[name='gender']:checked").map(function () {
        return this.value;
    }).get();

}

function getSelectedCollectionValues(){
    return $("input[name='collection']:checked").map(function () {
        return this.value;
    }).get();

}

function getSelectedOccassionValues(){
    return $("input[name='occassion']:checked").map(function () {
        return this.value;
    }).get();

}

function getSelectedStoneValues(){
    return $("input[name='stone']:checked").map(function (){
        return this.value;
    }).get();
}

function getSelectedCategoryValues(){
    return $("input[name='category']:checked").map(function (){
        return this.value;
    }).get();
}
