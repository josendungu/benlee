
var menuActive = false;
var isCurrentContentMain = true; 



function displayCategory(category_id, page) {

    var data = {"id": category_id, "page": page};

    jQuery.ajax({
        url:"category.php",
        method:"post",
        data:data,
        success: function(e) {
            var contentContainer = $('.content_container');
            contentContainer.empty();
            contentContainer.append(e);
            closeMenu();
        },
        error: function(){
            alert-error("wrong");
        }
    })
    
}

function displayProductModal(product_id){


    //Need it to take me to the next page.
    var data = {"product_id":product_id};
    jQuery.ajax({
        url:"product-details.php",
        method:"post",
        data:data,
        success: function(e) {
            $('.modal-product').empty();
            $('.modal-product').append(e);
            $('#productModal').modal('show');
        },
        error: function(){

            var errorDom = `
            <div class="alert alert-danger" role="alert">
            There was an error processing your request. Please try again later.
            </div>
            `;
            $('.modal-product').empty();
            $('.modal-product').append(errorDom);
            
        }
    });
        
}


function decrease(product_id){
    var cartItems = JSON.parse(localStorage.getItem('cartItems'));
    var totalCart = parseInt(localStorage.getItem('totalPrice')); 
    var productTotalNumbers = parseInt(localStorage.getItem('cartNumbers'));

    var quantity = cartItems[product_id].in_cart;

    if(quantity == 1){
        removeItemFromCart(product_id);
    } else {
        cartItems[product_id].in_cart -= 1;

        var product_price = cartItems[product_id].product_price;
        var product_offer = cartItems[product_id].product_offer;

        var cartPrice = 0;

        if(product_offer == 0){
            cartPrice = product_price;
        } else {
            cartPrice = product_offer;
        }

        localStorage.setItem('cartItems', to_string(cartItems));
        localStorage.setItem('totalPrice', totalCart - parseInt(cartPrice));
        localStorage.setItem('cartNumbers', productTotalNumbers - 1);

        loadCartProducts();
    }

    

}


function openOrder(order_id){
    window.location.href = "/benlee/order-view.php?order_id="+order_id;
}

function markOrder(order_id){
    var data = {"order_id": order_id}
    jQuery.ajax({
        url:"order-complete.php",
        method:"post",
        data:data,
        success: function(data) {

            if(data == 'success'){
                displayOrders();
                displayMessage(false, "Order was succesfully marked as complete");
            } else {
                displayMessage(true, "An error occured while marking the order as complete. Please try again later.");
            }
            
            
        }
    });

}

function to_string(json_object){
    return JSON.stringify(json_object);
}


function deleteProduct(product_id){

    let answer = confirm("Are you sure you want to delete the product?");

    if(answer){
        var data = {"product_id": product_id}
        jQuery.ajax({
        url:"delete-product.php",
        method:"post",
        data:data,
        success: function(data) {

            if(data == 'success'){
                displayProducts(1);
                displayMessage(false, "Product was succesfully deleted");
            } else {
                displayMessage(true, "An error occured while deleting the product. Please try again later.");
            }
            
            
        }
    });
    }
    
}

function increase(product_id){
    var cartItems = JSON.parse(localStorage.getItem('cartItems'));
    var totalCart = parseInt(localStorage.getItem('totalPrice')); 
    var productTotalNumbers = parseInt(localStorage.getItem('cartNumbers')); 

    var product_price = cartItems[product_id].product_price;
    var product_offer = cartItems[product_id].product_offer;

    var cartPrice = 0;

    if(product_offer == 0){
        cartPrice = product_price;
    } else {
        cartPrice = product_offer;
    }
    
    cartItems[product_id].in_cart += 1;
    localStorage.setItem('cartItems', to_string(cartItems));
    localStorage.setItem('totalPrice', (totalCart + parseInt(cartPrice)));
    localStorage.setItem('cartNumbers', productTotalNumbers + 1);

    loadCartProducts();

}

function removeItemFromCart(product_id){
    var cartItems = JSON.parse(localStorage.getItem('cartItems'));
    var totalCart = parseInt(localStorage.getItem('totalPrice')); 
    var productTotalNumbers = parseInt(localStorage.getItem('cartNumbers')); 

    var product_price = cartItems[product_id].product_price;
    var product_offer = cartItems[product_id].product_offer;

    var cartPrice = 0;

    if(product_offer == 0){
        cartPrice = product_price;
    } else {
        cartPrice = product_offer;
    }
    
    delete cartItems[product_id];

    var length = Object.keys(cartItems).length;
    if(length == 0){
        localStorage.removeItem('cartItems', to_string(cartItems));
        localStorage.removeItem('totalPrice', totalCart - parseInt(cartPrice));
        localStorage.removeItem('cartNumbers', productTotalNumbers - 1);

    }else{
        localStorage.setItem('cartItems', to_string(cartItems));
        localStorage.setItem('totalPrice', totalCart - parseInt(cartPrice));
        localStorage.setItem('cartNumbers', productTotalNumbers - 1);
    }

    loadCartProducts();

}




function loadCartProducts(){

    var cartItems = JSON.parse(localStorage.getItem('cartItems'));
    var totalCart = parseInt(localStorage.getItem('totalPrice'));

    var cartProduct = document.querySelector(".cart-table-body");

    if (cartProduct){

        
        cartProduct.innerHTML = '';
        if(cartItems != null){
    
            Object.values(cartItems).map(item => {
                var price = 0;
                if(item.product_offer != 0){
                    price = item.product_offer;
                } else {
                    price = item.product_price;
                }

                cartProduct.innerHTML += `
                <tr>
                    <td scope="row" data-label="">
                        <div class="section-element center-this">
                            <i class="fa fa-times" aria-hidden="true" onclick="removeItemFromCart(${item.product_id})"></i>
                        </div>
                    </td>
                    <td data-label="">
                        <div class="section-element center-this">
                            <img class="cart-image rounded" src="${item.product_picture}" alt="product_image"></div>
                        
                    </td>
                    <td data-label="Name">
                        <div class="section-element">
                            <div class="cart-product-name">${item.product_name}</div>
                        </div>
                    </td>
                    <td data-label="Unit Price">${price}</td>
                    <td data-label="Quantity">
                        <div class="quantity">
                            <i onclick="decrease(${item.product_id})" class="fas fa-chevron-circle-left decrease"></i>
                        <span>${item.in_cart}</span>
                            <i onclick="increase(${item.product_id})" class="fas fa-chevron-circle-right increase"></i>
                        </div>
                    </td>
                    <td data-label="Subtotal">
                    ${item.in_cart * price}
                    </td>
                </tr>
                `
    
    
               
    
            });
    
            cartProduct.innerHTML += `
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <td>Ksh ${totalCart}</td>
            </tr>`        
                
        } else {
            cartProduct.innerHTML += `
            <tr>
            <td colspan="6" class="cart-empty">
                <div class="alert alert-warning cart-alert" role="alert">
                You have not added any items to your cart! <a href="/benlee">Back to Shopping</a>
                </div> 
            </td>
            
            </tr> `
        }
        
    }    

}

function addTop(product_id){
    var data = {"product_id":product_id, "action": 0};
    jQuery.ajax({
        url:"top-rated.php",
        method:"post",
        data:data,
        success: function(data) {

            if(data == 'success'){
                displayTr(1);
                displayMessage(false, "Product was succesfully added to the list");
            } else {
                displayMessage(true, "An error occured while processing the request. Please try again later");
            }
            
            
        }
    });
}

function addBest(product_id){
    var data = {"product_id":product_id, "action": 0};
    jQuery.ajax({
        url:"best-selling.php",
        method:"post",
        data:data,
        success: function(data) {

            if(data == 'success'){
                displayBs(1);
                displayMessage(false, "Product was succesfully added to the list");
            } else {
                displayMessage(true, "An error occured while processing our request. Please try again later");
            }
            
            
        }
    });
}

function removeTop(product_id){
    var data = {"product_id":product_id, "action": 1};
    jQuery.ajax({
        url:"top-rated.php",
        method:"post",
        data:data,
        success: function(data) {

            if(data == 'success'){
                displayTr(1);
                displayMessage(false, "Product was succesfully removed from the list");
            } else {
                displayMessage(true, "An error occured while processing our request. Please try again later");
            }
            
        }
    });
}

function removeBest(product_id){
    var data = {"product_id":product_id, "action": 1};
    jQuery.ajax({
        url:"best-selling.php",
        method:"post",
        data:data,
        success: function(data) {

            if(data == 'success'){
                displayBs(1);
                displayMessage(false, "Product was succesfully removed from the list");
            } else {
                displayMessage(true, "An error occured while processing our request. Please try again later");
            }

            
            
            
        }
    });
}

function displayMessage(error, message){

    var messageDom = document.querySelector(".message");
    messageDom.innerHTML = "";

    if(error){
        //display error
        messageDom.innerHTML = `
        <div class="alert alert-danger" role="alert">
            ${message}
        </div>
        `;
        $('html,body').scrollTop(0);
       
    } else {
        //display success
        messageDom.innerHTML = `
        <div class="alert alert-success" role="alert">
            ${message}
        </div>`;
        $('html,body').scrollTop(0);
    }
}

function displayBs(page){

    var data = {"page":page};
    jQuery.ajax({
        url:"bs-fetch.php",
        method:"post",
        data:data,
        success: function(data) {

            var bsTable = document.querySelector("#table-body-bs");

            bsTable.innerHTML = '';
            bsTable.innerHTML = data;
            
            
        }
    });
}

function displayTr(page){

    var data = {"page":page};
    jQuery.ajax({
        url:"tr-fetch.php",
        method:"post",
        data:data,
        success: function(data) {

            var trTable = document.querySelector("#table-body-tr");

            trTable.innerHTML = '';
            trTable.innerHTML = data;   
            
        }
    });
}

function displayProducts(page){

    var data = {"page":page};
    jQuery.ajax({
        url:"products-fetch.php",
        method:"post",
        data:data,
        success: function(data) {


            var productsTable = document.querySelector("#table-body-products");

            productsTable.innerHTML = data;  
            
        }
    });
}


function editProduct(product_id){

    var data = {"product_id":product_id};
        jQuery.ajax({
            url:"edit-product.php",
            method:"post",
            data:data,
            success: function(e) {
                $('.product-edit-content').html(e);
                $('#editProductModal').modal('show');
            },
            error: function(){
              alert-error("wrong");
            }
        })

}


function displayAdminCategory(){

    jQuery.ajax({
        url:"admin-category.php",
        method:"post",
        data:{},
        success: function(data) {

            var categoryTable = document.querySelector("#table-body-category");
            categoryTable.innerHTML = data;  
            
        }
    });

}


function editCategory(category_id){

    var data = {"category_id":category_id};
        jQuery.ajax({
            url:"edit-category.php",
            method:"post",
            data:data,
            success: function(e) {
                $('.category-edit-content').html(e);
                $('#editCategoryModal').modal('show');
            },
            error: function(){
              alert-error("wrong");
            }
        })
    
}



function displayOrders(fetch){
    jQuery.ajax({
        url:"order-fetch.php",
        method:"post",
        data:{"fetch": fetch},
        success: function(data) {
            var orderTable = document.querySelector("#table-body-order");

            orderTable.innerHTML = data;  
            
        }
    });
}


function addToCart(product_id){

    var url = getUrl("product-details.php");

    var data = {"product_id":product_id, "return_data":true};
    jQuery.ajax({
        url: url,
        method:"post",
        data:data,
        success: function(e) {
            var product = JSON.parse(e);
           
            var total_products = localStorage.getItem('cartNumbers');
            total_products = parseInt(total_products);

            if(total_products){
                localStorage.setItem('cartNumbers', total_products + 1);
                $(".checkout_items").text(total_products + 1);
            } else {
                localStorage.setItem('cartNumbers', 1);
                $(".checkout_items").text(1);
            }

            var cartItems = JSON.parse(localStorage.getItem('cartItems'));

            
            if(cartItems != null){
                
                if(cartItems[product.product_id] == undefined){  
                    cartItems = {
                        ...cartItems,
                        [product.product_id]: product
                    }
                } 
                
                (cartItems[product.product_id]).in_cart += 1;
                
            } else {
                product.in_cart = 1;
                var cartItems = {
                    [product.product_id]: product,
                }                    
            }

            localStorage.setItem('cartItems', to_string(cartItems));

            
            if(product.product_offer != 0){
                updateTotalCost(parseInt(product.product_offer));
            } else {
                updateTotalCost(parseInt(product.product_price));
            }
            

        },
        error: function(){
          alert-error("wrong");
        }
    })
}


function updateTotalCost(product_price){

    var totalCost = localStorage.getItem('totalPrice');

    if(totalCost != null){
        totalCost = parseInt(totalCost);
        localStorage.setItem('totalPrice', totalCost + product_price)
    } else {
        localStorage.setItem('totalPrice', product_price)

    }
    
}

function closeMenu() {

    var menu = $('.hamburger_menu');
    var fsOverlay = $('.fs_menu_overlay');

    if (menu.hasClass('active')) {
        menu.removeClass('active');
        fsOverlay.css('pointer-events', "none");
        menuActive = false;
    } else {
        console.log("yee");
    }
    
}

function getUrl(page){
    var back = "../"
    if (isCurrentContentMain){
        return page
    } else {
        return back.concat(page)
    }
}



jQuery(document).ready(function ($) {
    // 1. vars and Inits
  
    var hamburger = $('.hamburger_container');
    var menu = $('.hamburger_menu');
    var hamburgerClose = $('.hamburger_close');
    var fsOverlay = $('.fs_menu_overlay');
    var contentContainer = $('.content_container');
    var cartProduct = document.querySelector(".cart-products");
    var cartContainer = document.querySelector(".cart_container");
    var footerLatest = document.querySelector("#latest");
    var bestSellling = document.querySelector("#best-selling");
    var topRated = document.querySelector("#top-rated");
    var adminContent = document.querySelector(".admin-content");
    var isMainContent = document.querySelector(".content_container");


    if(isMainContent == null){
        isCurrentContentMain = false;
    } else {
        isCurrentContentMain = true;
    }

    var uploading = false;

    initMenu();

    if (isMainContent) {
        displayMainContent();
    }
    
    onLoadCartNumbers();
    fetchTotal();
    initSlider();
    initNavbarControl();
    
    loadBestSelling();//footer
    loadLatest();//footer
    loadTopRated();//footer
    to_string();

    if(cartContainer){
        loadCartProducts();
    }
    

    if(adminContent){

        displayProducts(1);
        displayTr(1);
        displayBs(1);
        displayAdminCategory();
        displayOrders(0);

    }

    function loadLatest(){

        var url = getUrl("footer-content.php");

        if(footerLatest){
            jQuery.ajax({
                url: url,
                method:"post",
                data:{"content": "latest", "main_page": isCurrentContentMain},
                success: function(e) {
                    footerLatest.innerHTML = e;
    
                },
                error: function(){
                  alert-error("wrong");
                }
            })
        }
        
    }


    function initNavbarControl(){
        window.addEventListener('scroll', () => {
            var lastScrollTop = 10;
           
            var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            var headCont = document.querySelector(".header-grid-container");
            var bannerPop = document.querySelector(".banner-popup");
            var bannerNormal = document.querySelector(".banner-normal")

            if(headCont){
                if(scrollTop > lastScrollTop){

                    headCont.style.display = "none";
                    bannerPop.style.display = "block";
                    bannerNormal.style.display = "none";
                } else {
                    headCont.style.display = "grid";
                    bannerPop.style.display = "none";
                    bannerPop.style.backgroundColor = "#ffffff";
                    bannerNormal.style.display = "block";

    
                }
            }

            

           
        });
    }

    function loadBestSelling(){


        var url = getUrl("footer-content.php");
        if(bestSellling){
            jQuery.ajax({
                url:url,
                method:"post",
                data:{"content": "best-selling","main_page": isCurrentContentMain},
                success: function(e) {
                    bestSellling.innerHTML = '';
                    bestSellling.innerHTML = e;
                },
                error: function(){
                  alert-error("wrong");
                }
            })
        }
    }

    function loadTopRated(){

        var url = getUrl("footer-content.php");

        if(topRated){
            jQuery.ajax({
                url: url,
                method:"post",
                data:{"content": "top-rated", "main_page": isCurrentContentMain},
                success: function(e) {
                    topRated.innerHTML = '';
                    topRated.innerHTML = e;
                },
                error: function(){
                  alert-error("wrong");
                }
            })
        }
    }

    function fetchTotal(){
        var total_products = localStorage.getItem('cartNumbers');
        $(".checkout_items").text(total_products);
    }

    function onLoadCartNumbers(){
        var total_products = localStorage.getItem('cartNumbers');
        total_products = parseInt(total_products);

        if(total_products){
            $(".checkout_items").text(total_products);
        }
    }

    function initMenu() {
        if (hamburger.length) {
            hamburger.on('click', function() {
                if (!menuActive) {
                    openMenu();
                }
            });
        }
        if (fsOverlay.length) {
            fsOverlay.on('click', function() 
            {
                if (menuActive) 
                {
                    closeMenu();
                }
            });
        }
        if (hamburgerClose.length) {
            hamburgerClose.on('click', function() {
                if (menuActive) {
                    closeMenu();
                }
            });
        }
        if ($('.menu_item'), length) {
            var items = document.getElementsByClassName('menu_item');
            var i;

            for (i = 0; i < items.length; i++) 
            {
                if (items[i].classList.contains("has-children")) 
                {
                    items[i].onclick = function () 
                    {
                        this.classList.toggle("active");
                        var panel = this.children[1];
                        if (panel.style.maxHeight) {
                            panel.style.maxHeight = null;
                        }
                        else {
                            panel.style.maxHeight = panel.scrollHeight + "px";
                        }
                    }
                }
            }
        }
    }

    function openMenu() {
        menu.addClass('active');
        fsOverlay.css('pointer-events', "auto");
        menuActive = true;
    }

    function displayMainContent() {
        jQuery.ajax({
            url:"main_content.php",
            method:"post",
            data:{},
            success: function(e) {
                contentContainer.empty();
                contentContainer.append(e);
            },
            error: function(){
              alert-error("wrong");
            }
        })
    }


    
    $("#admin-products").on('submit', (function(e){

        e.preventDefault();

        $.ajax({
            url: "admin-search.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            complete: function(response){
                data = response.responseText;
                var productsTable = document.querySelector("#table-body-products");
                
                productsTable.innerHTML = '';
                productsTable.innerHTML = data;
            }
        });

    }));

    $("#admin-best-selling").on('submit', (function(e){

        e.preventDefault();

        $.ajax({
            url: "admin-bs-search.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            complete: function(response){
                data = response.responseText;
                var bestSellingTable = document.querySelector("#table-body-bs");

                
                bestSellingTable.innerHTML = '';
                bestSellingTable.innerHTML = data;
            }
        });

    }));

    $("#admin-top-rated").on('submit', (function(e){

        e.preventDefault();

        $.ajax({
            url: "admin-tr-search.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            complete: function(response){
                data = response.responseText;
                var topRatedTable = document.querySelector("#table-body-tr");
                
                topRatedTable.innerHTML = '';
                topRatedTable.innerHTML = data;
            }
        });

    }));

    $("#search-products").on('submit',(function(e) {

        e.preventDefault();

        $.ajax({
            url: "search-products.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            complete: function(response){
                data = response.responseText;
                
                contentContainer.empty();
                contentContainer.append(data);
            }
        });
    }));



    $(".content_container").on('click', ".add_link" ,(function(e){
        var product_id = $(this).attr('id');
        addToCart(product_id);


    }));


    $(".product-list-widget").on('click', ".product-elements" ,(function(e){

        var product_id = $(this).attr('id');

        displayProductModal(product_id);

    }));


    $("#search-products-ham").on('submit',(function(e){
    
        e.preventDefault();

        $.ajax({
            url: "search-products.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            complete: function(response){
                data = response.responseText;
                closeMenu();
                
                contentContainer.empty();
                contentContainer.append(data);
            }
        });
        
    }));



    $(".modal").on('submit',"#form-edit-category", (function(e) {

        e.preventDefault();
        $("#alert-success-category-edit").addClass("hide");
        $("#alert-error-category-edit").addClass("hide");

        var formData = new FormData(this);

        var category_name = formData.get('category_name') 
        var category_id = $(".upload-btn").attr('id');

        var data = {
            "category_name": category_name,
            "category_id": category_id,
        }

        $.ajax({
            url: "edit-category-exe.php",
            type: "POST",
            data: data,
            complete: function(response){
                data = response.responseText;
                if (data == 'successful') {
                    $("#alert-success-category-edit").text("Successfully updated the category.");
                    $("#alert-success-category-edit").removeClass("hide").fadeIn();
                } else {
                    $("#alert-error-category-edit").text("There was an error updating the category. Please try again later");
                    $("#alert-error-category-edit").removeClass("hide").fadeIn();
                }
            }
        });


    }));


    $(".modal").on('submit',"#form-edit-product", (function(e) {
        e.preventDefault();

        $("#alert-success-edit").addClass("hide");
        $("#alert-error-edit").addClass("hide");

        var formData = new FormData(this);
    
        var product_name = formData.get("product_name");
        var product_category = formData.get("product_category");
        var product_description = formData.get("product_description");
        var product_price = formData.get("product_price");
        var product_offer = formData.get("product_offer_price");
        var product_id = $(".upload-btn").attr('id');

        var data = {
            "product_name": product_name,
            "product_category": product_category,
            "product_description": product_description,
            "product_price": product_price,
            "product_offer": product_offer,
            "product_id": product_id
        }

            $.ajax({
                url: "edit-product-exe.php",
                type: "POST",
                data: data,
                complete: function(response){
                    data = response.responseText;
                    if(data =='invalid'){
                        $("#alert-error-edit").text("The selected photo is not compatible");
                        $("#alert-error-edit").removeClass("hide").fadeIn();
                    } 
                    if (data == 'error adding') {
                        $("#alert-error-edit").text("There was an error uploading the data. Please try again!");
                        $("#alert-error-edit").removeClass("hide").fadeIn();
                    } 
                    if (data == 'pic error') {
                        $("#alert-error-edit").text("There was an error uploading the picture. Please try again!");
                        $("#alert-error-edit").removeClass("hide").fadeIn();
                    } 
                    if (data == 'values not available') {
                        $("#alert-error-edit").text("There was an error capturing the data. Please try again!");
                        $("#alert-error-edit").removeClass("hide").fadeIn();
                    } 
                    if (data == 'successful') {
                        $("#alert-success-edit").text("Successfully updated the product.");
                        $("#alert-success-edit").removeClass("hide").fadeIn();
                    }
                }
            });
    }));


    $("#form-complete-order").on('submit', (function(e){
        e.preventDefault();
        var productsString = '';

        var cartItems = JSON.parse(localStorage.getItem('cartItems'));
        var totalCart = parseInt(localStorage.getItem('totalPrice'));
        var productsString = '';

        if(cartItems != null){
            Object.values(cartItems).map(item => {
                if(item.product_offer != 0){
                    productsString += `${item.product_id}:${item.in_cart}:${item.product_offer};`;

                } else {
                    productsString += `${item.product_id}:${item.in_cart}:${item.product_price};`;
                }
            });
    
            var formData = new FormData(this);
    
            var firstName = formData.get("fname");
            var lastName = formData.get("lname");
            var companyName = formData.get("cname");
            var phoneNumber = formData.get("phone");
            var email = formData.get("email");
            var address = formData.get("shipping");
    
            var data = {
                "products": productsString, 
                "total": totalCart,
                "lastname": lastName,
                "firstname": firstName,
                "companyname": companyName,
                "phonenumber": phoneNumber,
                "email": email,
                "address": address
            }
    
            $.ajax({
                url:"add-order.php",
                method:"post",
                data: data,
                success: function(e) {
                    if(e =='successful'){
                        $("#cart-success").text("You have successfully completed your order. We will contact you soon.");
                        $("#cart-success").removeClass("hide").fadeIn();
                        $("#form-complete-order")[0].reset(); 
    
                        localStorage.removeItem('cartItems');
                        localStorage.removeItem('totalPrice');
                        localStorage.removeItem('cartNumbers');
                        loadCartProducts();
                    } else {
                        $("#cart-error").text("There has been an error completing your order. Please try again later.");
                        $("#cart-error").removeClass("hide").fadeIn();
                    }
                },
                error: function(){
                  alert-error("wrong");
                }
            });

        } else {
            $("#cart-error").text("Please add products to your cart");
            $("#cart-error").removeClass("hide").fadeIn();
        }

        

    }));


    $("#form-add-category").on('submit',(function(e) {
        e.preventDefault();
    
        $("#alert-success").addClass("hide");
        $("#alert-error").addClass("hide");


        $.ajax({
            url: "add-category.php",
            type: "POST",
            data: add_data,
            contentType: false,
            cache: false,
            processData:false,
            complete: function(response){
                data = response.responseText;
                if (data == 'successful') {
                    $("#alert-success-category").text("Successfully added the category.");
                    $("#alert-success-category").removeClass("hide").fadeIn();
                    $("#form-add-category")[0].reset();
                    displayCategory();
                } else {
                    $("#alert-error-category").text("There was an error adding product. Try again later");
                    $("#alert-error-category").removeClass("hide").fadeIn();
                }
            }
        });
    
    }));


    $("#form-add-product").on('submit',(function(e) {

        $("#alert-success").addClass("hide");
        $("#alert-error").addClass("hide");


        if (uploading == false) {
            uploading = true;
            e.preventDefault();
            $.ajax({
                url: "add-product.php",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                complete: function(response){
                    data = response.responseText;
                    if(data =='invalid'){
                        uploading = false;
                        $("#alert-error").text("The selected photo is not compatible");
                        $("#alert-error").removeClass("hide").fadeIn();
                    } 
                    if (data == 'error adding') {
                        uploading = false;
                        $("#alert-error").text("There was an error uploading the data. Please try again!");
                        $("#alert-error").removeClass("hide").fadeIn();
                    } 
                    if (data == 'pic error') {
                        uploading = false;
                        $("#alert-error").text("There was an error uploading the picture. Please try again!");
                        $("#alert-error").removeClass("hide").fadeIn();
                    } 
                    if (data == 'values not available') {
                        uploading = false;
                        $("#alert-error").text("There was an error capturing the data. Please try again!");
                        $("#alert-error").removeClass("hide").fadeIn();
                    } 
                    if (data == 'successful') {
                        uploading = false;
                        $("#alert-success").text("successfully added the product.");
                        $("#alert-success").removeClass("hide").fadeIn();
                        $("#form-add-product")[0].reset(); 
                    }
                }
            });
        }
        
    }));

    // 6.  Init Slider
    function initSlider() {
        if ($('.product_slider').length) {
            var slider1 = $('.product_slider');

            slider1.owlCarousel({
                loop: false,
                dots: false,
                nav: false,
                responsive:
                {
                    0: { items: 1 },
                    480: { items: 2 },
                    768: { items: 3 },
                    991: { items: 4 },
                    1280: { items: 5 },
                    1440: { items: 5 },
                }

            });
            if ($('.product_slider_nav_left').length) {
                $('.product_slider_nav_left').on('click', function () {
                    slider1.trigger('prev.owl.carousel');
                })
            }
            if ($('.product_slider_nav_right').length) {
                $('.product_slider_nav_right').on('click', function () {
                    slider1.trigger('next.owl.carousel');
                })
            }
        }
    }




    function initSlider() {
        if ($('.product_slider').length) {
            var slider1 = $('.product_slider');

            slider1.owlCarousel({
                loop: false,
                dots: false,
                nav: false,
                responsive:
                {
                    0: { items: 1 },
                    480: { items: 2 },
                    768: { items: 3 },
                    991: { items: 4 },
                    1280: { items: 5 },
                    1440: { items: 5 },
                }

            });
            if ($('.product_slider_nav_left').length) {
                $('.product_slider_nav_left').on('click', function () {
                    slider1.trigger('prev.owl.carousel');
                })
            }
            if ($('.product_slider_nav_right').length) {
                $('.product_slider_nav_right').on('click', function () {
                    slider1.trigger('next.owl.carousel');
                })
            }
        }
    }

})