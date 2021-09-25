const totalEarnings = document.querySelector('#total-earnings-value');
const totalSales = document.querySelector('#total-sales-value');
const newOrdersToProcess = document.querySelector('#orders-to-process-value');

const ordersTable = document.querySelector('#new-orders-table');

newOrdersToProcess.innerText = ordersTable.rows.length - 1;
