// Функция для записи объекта в куки
console.log('cart.js загружен!');
function setCookie(name = "cart", value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
    document.cookie = `${name}=${JSON.stringify(value)};expires=${expires.toUTCString()};path=/`;
}

// Функция для чтения объекта из куки
function getCookie(name = "cart") {
    const nameEQ = `${name}=`;
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) {
            return JSON.parse(c.substring(nameEQ.length, c.length));
        }
    }
    return null;
}

// Функция для обновления количества товара в корзине
function updateCartQuantity(itemId, quantityChange) {
    let cart = getCookie('cart');
    if (!cart) {
        cart = { items: {} }; // Инициализируем корзину, если она пуста
    }

    // Проверяем,  что quantityChange не отрицательное
    if (quantityChange < 0 && !cart.items[itemId]) {
        return; // Если quantityChange отрицательное и товара нет в корзине,  ничего не делаем
    }

    if (cart.items[itemId]) {
        cart.items[itemId] = parseInt(cart.items[itemId], 10) + parseInt(quantityChange, 10); // Преобразуем в число перед сложением
        if (cart.items[itemId] <= 0) {
            delete cart.items[itemId]; // Удаляем товар, если количество стало 0 или меньше
        }
    } else {
        cart.items[itemId] = quantityChange; // Добавляем товар, если его нет в корзине
    }

    setCookie('cart', cart, 7); // Сохраняем обновленную корзину в куки
}

function getCartTotalQuantity() {
    console.log("считаем корзину");
    let cart = getCookie('cart');
    if (!cart) {
        return 0; // Корзина пуста
    }
    let totalQuantity = 0;
    for (const itemId in cart.items) {
        totalQuantity += parseInt(cart.items[itemId]);
    }
    return totalQuantity;
}

function updateCartCountHeader() {
    const cartCountElement = document.getElementById('cart-count-header');
    cartCountElement.textContent = getCartTotalQuantity();

}



//Выполнение методов при нажании на кнопки активносей корзины и обновление счетчика в корзине
window.addEventListener('DOMContentLoaded', function() {
    updateCartCountHeader(); // Обновляем счетчик при загрузке страницы


    //"71" это id корзины почему-то как поменять стпросить обязателько, или вносим все страницы в файл с константами?
    if (cartScriptData.currentPageID === "71") {
        console.log('qwe');
        const cartCountElement = document.getElementById('cart-count-main');
        cartCountElement.textContent = getCartTotalQuantity();
        document.getElementById('show-cart-main').addEventListener('click', function() {
            renderCartItems();
        });

    }


    if (cartScriptData.currentPageID !== "71") {
        document.getElementById('add-product').addEventListener('click', function () {
            updateCartQuantity(this.dataset.id, this.dataset.productCount, 1);
            updateCartCountHeader();
        });

        document.getElementById('delete-product').addEventListener('click', function () {
            updateCartQuantity(this.dataset.id, this.dataset.productCount, -1);
            updateCartCountHeader();
        });

        document.getElementById('delete-cart').addEventListener('click', function () {
            deleteCartCookie();
            updateCartCountHeader();
        });
    }



});


function deleteCartCookie(name = "cart") {
    setCookie(name, "", {
        'max-age': -1
    })
}



// Функция для отображения товаров в корзине (fetch)
function renderCartItems() {
    const cartItemsElement = document.getElementById('cart-items').querySelector('ul');
    cartItemsElement.innerHTML = ''; //  Очищаем список товаров

    const cartItems = getCookie('cart');
    if (!cartItems) {
        cartItemsElement.innerHTML = '<li>Ваша корзина пуста.</li>';
        return;
    }
    // console.log(cartItems);

    //  fetch-запрос для получения информации о товарах
    fetch('/wp-json/api/get-cart-items', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ cartItems: cartItems }) //  Данные о корзине
    })
        .then(response => response.json()) //  Преобразуем ответ в JSON
        .then(response => {
             // Обработка успешного ответа
            response.forEach(item => {
                const listItem = document.createElement('li');
                listItem.innerHTML = `
        <span>${item.name}</span>
        <span>Количество: ${item.quantity}</span>
        <span>Цена: ${item.price}</span>
      `;
                cartItemsElement.appendChild(listItem);
            });
        })
        .catch(error => {
            //  Обработка ошибки
            console.error(error);
        });
}

