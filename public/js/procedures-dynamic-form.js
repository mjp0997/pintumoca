let products = [];

let cart = [];

document.addEventListener('DOMContentLoaded', async () => {
   const office = document.querySelector('#from_office_id');
   
   const productsContainer = document.querySelector('#products-container');

   if (office.value != '') {
      await insertProducts(office.value);
   }

   if (office.tagName === 'SELECT') {
      office.addEventListener('change', async (e) => {
         const cartContainer = document.querySelector('#cart-container');
         cartContainer.innerHTML = '';

         const officeId = e.target.value;
         
         await insertProducts(officeId);
      });
   }

   getOldCart();

   // Filtering
   const filterForm = document.querySelector('#filter-form');

   const filter = filterForm.querySelector('#filter');
   const clear = filterForm.querySelector('#filter-clear');

   filterForm.addEventListener('submit', (e) => {
      e.preventDefault();

      productsContainer.innerHTML = '';

      const filtered = products.filter(p => p.name.toLocaleLowerCase().includes(filter.value.trim().toLocaleLowerCase()) || p.code.toLocaleLowerCase().includes(filter.value.trim().toLocaleLowerCase()));

      filtered.forEach(product => productsContainer.appendChild(createProductRow(product)));
   });

   clear.addEventListener('click', () => {
      filter.value = '';
      products.forEach(product => productsContainer.appendChild(createProductRow(product)));
   })
});

/**
 * Function to get all products from an office
 * @param {string|number} officeId Id of the seller office
 * @returns {Promise<Array<any>>}
 */
const getProducts = async (officeId) => {
   const metaApiLink = document.querySelector('#products-api-link');

   const response = await axios(`${metaApiLink.content}?office_id=${officeId}`, {
      method: 'GET'
   });
   
   return response.data;
}

/**
 * Function to create a product option row to be inserted in modal
 * @param {Array} paymentMethods Array containing existing payment methods
 */
const createProductRow = (product) => {
   const tr = document.createElement('tr');

   const nameTd = document.createElement('td');
   nameTd.classList.add('align-middle');
   nameTd.innerText = product.name;

   const codeTd = document.createElement('td');
   codeTd.classList.add('align-middle');
   codeTd.innerText = product.code;

   const btnTd = document.createElement('td');

   const btn = document.createElement('button');
   btn.classList.add('btn', 'btn-primary');
   btn.addEventListener('click', () => {
      if (!cart.find(p => p.id == product.id)) {
         cart.push({
            ...product,
            price: 0,
            quantity: 1
         });
         updateCart();
      }
   });

   const icon = document.createElement('i');
   icon.classList.add('fas', 'fa-plus');

   btn.appendChild(icon);

   btnTd.appendChild(btn);

   tr.appendChild(nameTd);
   tr.appendChild(codeTd);
   tr.appendChild(btnTd);

   return tr;
}

const insertProducts =  async (officeId) => {
   const productsContainer = document.querySelector('#products-container');
   
   products = await getProducts(officeId);

   productsContainer.innerHTML = '';

   products.forEach(product => productsContainer.appendChild(createProductRow(product)));
}

/**
 * Function to create cart row to be inserted in cart
 * @param {number} id product id
 * @param {string} name product name
 * @param {string} code product code
 * @param {number} stock product current stock in office
 */
const createCartRow = (id, name, code, stock, quantity, quantityError) => {
   const container = document.createElement('div');
   container.classList.add('sale-row');

   const row = document.createElement('div');
   row.classList.add('row');

   const firstCol = document.createElement('div');
   firstCol.classList.add('col-12', 'col-md-5');

   const infoContainer = document.createElement('div');
   infoContainer.classList.add('w-100', 'h-100', 'd-flex', 'flex-column', 'justify-content-center');

   const nameSpan = document.createElement('span');
   nameSpan.classList.add('d-block');

   const nameAnchor = document.createElement('a');
   nameAnchor.href = '#';

   const nameBold = document.createElement('b');
   nameBold.innerText = name;

   const codeSmall = document.createElement('small');
   codeSmall.classList.add('d-block');
   codeSmall.innerText = code;

   const stockSmall = document.createElement('small');
   stockSmall.classList.add('d-block', 'mb-3', 'mb-md-0', 'text-right', 'text-md-left');
   stockSmall.innerHTML = `Stock: <b>${stock}</b>`;

   const idInput = document.createElement('input');
   idInput.type = 'hidden';
   idInput.name = `products[${id}][product_id]`;
   idInput.value = id;

   const secondCol = document.createElement('div');
   secondCol.classList.add('col-12', 'col-md-7');

   const innerRow = document.createElement('div');
   innerRow.classList.add('row', 'h-100');

   const innerSecondCol = document.createElement('div');
   innerSecondCol.classList.add('col-6', 'col-md');

   const quantityContainer = document.createElement('div');
   quantityContainer.classList.add('h-100', 'd-flex', 'align-items-center', 'justify-content-center');

   const quantityInputGroup = document.createElement('div');
   quantityInputGroup.classList.add('form-group', 'mb-0');

   const quantityInputLabel = document.createElement('label');
   quantityInputLabel.classList.add('mb-0', 'd-block', 'text-center');
   quantityInputLabel.innerText = 'Cantidad';

   const quantityInput = document.createElement('input');
   quantityInput.type = 'number';
   quantityInput.classList.add('form-control', 'text-center');
   if (quantityError) {
      quantityInput.classList.add('is-invalid');
   }
   quantityInput.name = `products[${id}][quantity]`;
   quantityInput.value = quantity;
   quantityInput.autocomplete = 'off';
   quantityInput.placeholder = 'Cantidad';
   quantityInput.addEventListener('input', (e) => {
      cart = cart.map(p => {
         if (p.id == id) {
            return {
               ...p,
               quantity: Number(e.target.value)
            }
         }

         return p;
      });

      updateCart();
   });

   const innerFourthCol = document.createElement('div');
   innerFourthCol.classList.add('col-6', 'col-md-2', 'd-flex', 'mt-3', 'mt-md-0');

   const deleteButton = document.createElement('button');
   deleteButton.type = 'button';
   deleteButton.classList.add('btn', 'btn-danger', 'btn-block', 'my-md-auto');
   deleteButton.addEventListener('click', () => {
      cart = cart.filter(p => p.id != id);

      updateCart();
   });

   const deleteIcon = document.createElement('i');
   deleteIcon.classList.add('fas', 'fa-trash');

   deleteButton.appendChild(deleteIcon);
   innerFourthCol.appendChild(deleteButton);

   quantityInputGroup.appendChild(quantityInputLabel);
   quantityInputGroup.appendChild(quantityInput);
   if (quantityError) {
      quantityInputGroup.appendChild(productsError(quantityError));
   }
   quantityContainer.appendChild(quantityInputGroup);
   innerSecondCol.appendChild(quantityContainer);

   innerRow.appendChild(innerSecondCol);
   innerRow.appendChild(innerFourthCol);
   secondCol.appendChild(innerRow);

   nameAnchor.appendChild(nameBold);
   nameSpan.appendChild(nameAnchor);
   infoContainer.appendChild(nameSpan);
   infoContainer.appendChild(codeSmall);
   infoContainer.appendChild(stockSmall);
   infoContainer.appendChild(idInput);
   firstCol.appendChild(infoContainer);

   row.appendChild(firstCol);
   row.appendChild(secondCol);

   container.appendChild(row);

   return container;
}

const updateCart = () => {
   const cartContainer = document.querySelector('#cart-container');
   cartContainer.innerHTML = '';

   cart.forEach(p => cartContainer.appendChild(createCartRow(p.id, p.name, p.code, p.stocks[0].stock, p.quantity, p.quantityError)));
}

const getOldCart = () => {
   const oldCart = document.querySelector('#old-products');
   const errors = document.querySelector('#errors');

   if (!oldCart) return;

   const cartData = JSON.parse(oldCart.value);

   const mappedCart = Object.entries(cartData).map(p => p[1]);

   cart = mappedCart.map(el => {
      const product = products.find(pr => pr.id === Number(el.product_id));

      return {
         ...product,
         price: Number(el.price),
         quantity: Number(el.quantity)
      }
   });

   if (errors) {
      const errorsValue = JSON.parse(errors.value);

      const errorEntries = Object.entries(errorsValue);

      const errorList = errorEntries[0][1].default;

      const errorListEntries = Object.entries(errorList);

      const cartErrors = errorListEntries.filter(([err]) => err.includes('products') && err !== 'products');

      const mappedCartErrors = cartErrors.map(([key, err]) => {
         const [_, productId, field] = key.split('.');

         return {
            productId: Number(productId),
            field,
            error: err[0]
         }
      });

      cart = cart.map(el => {
         let cartProduct = el;

         const productErrors = mappedCartErrors.filter(err => err.productId == el.id);

         productErrors.forEach(err => {
            cartProduct = {
               ...cartProduct,
               [`${err.field}Error`]: err.error
            }
         });

         return cartProduct;
      });
   }

   updateCart();
}

const productsError = (error) => {
   const span = document.createElement('span');
   span.classList.add('error', 'invalid-feedback');
   span.innerText = error;
   return span;
}