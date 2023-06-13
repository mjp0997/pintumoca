let payments = [];

let paymentMethods = [];
let currencies = [];

document.addEventListener('DOMContentLoaded', async () => {
   // Getting payment methods
   paymentMethods = await getPaymentMethods();

   // Getting currencies
   currencies = await getCurrencies();
   
   const addPaymentBtn = document.querySelector('#add-payment-btn');

   addPaymentBtn.addEventListener('click', () => {
      const payment = { paymentId: '', currencyId: '', amount: 0 }

      payments.push(payment);

      updatePayments();
   });

   getOldPayments();
});

const getPaymentMethods = async () => {
   const metaApiLink = document.querySelector('#methods-api-link');

   const response = await axios(metaApiLink.content, {
      method: 'GET'
   });
   
   return response.data;
}

const getCurrencies = async () => {
   const metaApiLink = document.querySelector('#currencies-api-link');

   const response = await axios(metaApiLink.content, {
      method: 'GET'
   });
   
   return response.data;
}

/**
 * Función para crear una fila de método de pago
 * @param {Array} paymentMethods Array containing existing payment methods
 */
const createPaymentRow = ({ index, paymentId, currencyId, amount, paymentIdError, currencyIdError, amountError }, paymentMethods, currencies) => {
   const container = document.createElement('div');
   container.classList.add('sale-row', 'payment-row-aux');

   const row = document.createElement('div');
   row.classList.add('row');

   const firstCol = document.createElement('div');
   firstCol.classList.add('col-12', 'col-md-5');

   const paymentSelectGroup = document.createElement('div');
   paymentSelectGroup.classList.add('form-group', 'mb-md-0');

   const paymentSelectLabel = document.createElement('label');
   paymentSelectLabel.classList.add('mb-0', 'd-block', 'text-center');
   paymentSelectLabel.innerText = 'Método de pago';

   const paymentSelect = document.createElement('select');
   paymentSelect.classList.add('form-control', 'text-center');
   if (paymentIdError) {
      paymentSelect.classList.add('is-invalid');
   }
   paymentSelect.name = `payments[${index}][payment_id]`;
   paymentSelect.addEventListener('change', (e) => {
      payments = payments.map((p, i) => {
         if (i == index) {
            return {
               ...p,
               paymentId: Number(e.target.value)
            }
         }

         return p;
      });
   });

   const placeHolder = document.createElement('option');
   placeHolder.text = 'Seleccione un método de pago';
   placeHolder.disabled = true;
   placeHolder.selected = paymentId == '' ? true : false;
   paymentSelect.add(placeHolder);

   paymentMethods.forEach(method => {
      const option = document.createElement('option');
      option.text = method.name;
      option.value = method.id;
      option.selected = paymentId == method.id ? true : false;

      paymentSelect.add(option);
   });
   
   const secondCol = document.createElement('div');
   secondCol.classList.add('col-12', 'col-md-7');

   const innerRow = document.createElement('div');
   innerRow.classList.add('row');

   const innerFirstCol = document.createElement('div');
   innerFirstCol.classList.add('col');

   const currenciesSelectGroup = document.createElement('div');
   currenciesSelectGroup.classList.add('from-group', 'mb-0');

   const currenciesSelectLabel = document.createElement('label');
   currenciesSelectLabel.classList.add('mb-0', 'd-block', 'text-center');
   currenciesSelectLabel.innerText = 'Divisa';

   const currenciesSelect = document.createElement('select');
   currenciesSelect.classList.add('form-control', 'text-center');
   if (currencyIdError) {
      currenciesSelect.classList.add('is-invalid');
   }
   currenciesSelect.name = `payments[${index}][currency_id]`;
   currenciesSelect.addEventListener('change', (e) => {
      payments = payments.map((p, i) => {
         if (i == index) {
            return {
               ...p,
               currencyId: Number(e.target.value)
            }
         }

         return p;
      });
   });

   const currenciesHolder = document.createElement('option');
   currenciesHolder.text = 'Seleccione una divisa';
   currenciesHolder.disabled = true;
   currenciesHolder.selected = currencyId == '' ? true : false;
   currenciesSelect.add(currenciesHolder);

   currencies.forEach(currency => {
      const option = document.createElement('option');
      option.text = currency.name;
      option.value = currency.id;
      option.selected = currencyId == currency.id ? true : false

      currenciesSelect.add(option);
   });

   const innerSecondCol = document.createElement('div');
   innerSecondCol.classList.add('col');

   const amountInputGroup = document.createElement('div');
   amountInputGroup.classList.add('form-group', 'mb-0');

   const amountInputLabel = document.createElement('label');
   amountInputLabel.classList.add('mb-0', 'd-block', 'text-center');
   amountInputLabel.innerText = 'Monto';

   const amountInput = document.createElement('input');
   amountInput.type = 'number';
   amountInput.classList.add('form-control', 'text-center');
   if (amountError) {
      amountInput.classList.add('is-invalid');
   }
   amountInput.name = `payments[${index}][amount]`;
   amountInput.value = amount;
   amountInput.autocomplete = 'off';
   amountInput.placeholder = 'Monto';
   amountInput.addEventListener('input', debounce((e) => {
      payments = payments.map((p, i) => {
         if (i == index) {
            return {
               ...p,
               amount: Number(e.target.value)
            }
         }

         return p;
      });

      updatePayments();
   }, debounceTimer));

   const innerThirdCol = document.createElement('div');
   innerThirdCol.classList.add('col-2', 'd-flex');

   const deleteButton = document.createElement('button');
   deleteButton.type = 'button';
   deleteButton.classList.add('btn', 'btn-danger', 'btn-block', 'mt-auto');
   deleteButton.addEventListener('click', () => {
      payments = payments.filter((_, i) => i != index);

      updatePayments();
   });

   const deleteIcon = document.createElement('i');
   deleteIcon.classList.add('fas', 'fa-trash');

   currenciesSelectGroup.appendChild(currenciesSelectLabel);
   currenciesSelectGroup.appendChild(currenciesSelect);
   if (currencyIdError) {
      currenciesSelectGroup.appendChild(paymentError(currencyIdError));
   }
   innerFirstCol.appendChild(currenciesSelectGroup);

   amountInputGroup.appendChild(amountInputLabel);
   amountInputGroup.appendChild(amountInput);
   if (amountError) {
      amountInputGroup.appendChild(paymentError(amountError));
   }
   innerSecondCol.appendChild(amountInputGroup);

   deleteButton.appendChild(deleteIcon);
   innerThirdCol.appendChild(deleteButton);

   innerRow.appendChild(innerFirstCol);
   innerRow.appendChild(innerSecondCol);
   innerRow.appendChild(innerThirdCol);

   secondCol.append(innerRow);

   paymentSelectGroup.appendChild(paymentSelectLabel);
   paymentSelectGroup.appendChild(paymentSelect);
   if (paymentIdError) {
      paymentSelectGroup.appendChild(paymentError(paymentIdError));
   }
   firstCol.appendChild(paymentSelectGroup);

   row.appendChild(firstCol);
   row.appendChild(secondCol);

   container.appendChild(row);

   return container;
}

const updatePayments = () => {
   const container = document.querySelector('#payments-container');
   container.innerHTML = '';

   
   payments.forEach((p, index) => {
      const payment = {
         ...p,
         index
      }

      container.appendChild(createPaymentRow(payment, paymentMethods, currencies));
   });
}

const getOldPayments = () => {
   const oldPayments = document.querySelector('#old-payments');
   const errors = document.querySelector('#errors');

   if (!oldPayments) return;

   const paymentsData = JSON.parse(oldPayments.value);

   const mappedPayments = Object.entries(paymentsData).map(p => p[1]);

   console.log('mapped:', mappedPayments);

   payments = mappedPayments.map(el => ({
      paymentId: el.payment_id ? Number(el.payment_id) : '',
      currencyId: el.currency_id ? Number(el.currency_id) : '',
      amount: el.amount
   }));

   console.log('payments:', payments);

   if (errors) {
      const errorsValue = JSON.parse(errors.value);

      const errorEntries = Object.entries(errorsValue);

      const errorList = errorEntries[0][1].default;

      const errorListEntries = Object.entries(errorList);

      const paymentsError = errorListEntries.filter(([err]) => err.includes('payments') && err !== 'payments');

      const mappedPaymentsErrors = paymentsError.map(([key, err]) => {
         const [_, paymentIndex, field] = key.split('.');

         const keys = {
            payment_id: 'paymentId',
            currency_id: 'currencyId',
         }

         return {
            paymentIndex: Number(paymentIndex),
            field: keys[field] ? keys[field] : field,
            error: err[0]
         }
      });

      payments = payments.map((el, index) => {
         let payment = el;

         const paymentErrors = mappedPaymentsErrors.filter(err => err.paymentIndex == index);

         paymentErrors.forEach(err => {
            payment = {
               ...payment,
               [`${err.field}Error`]: err.error
            }
         });

         return payment;
      });
   }

   updatePayments();
}

const paymentError = (error) => {
   const span = document.createElement('span');
   span.classList.add('error', 'invalid-feedback');
   span.innerText = error;
   return span;
}