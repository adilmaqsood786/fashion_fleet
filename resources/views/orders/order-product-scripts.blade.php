@php
  $productsJson = $products->map(function ($product) {
      return [
          'id' => $product->id,
          'name' => $product->name,
          'price' => floatval($product->price),
          'stock' => $product->stock,
          'vendor_id' => $product->vendor_id,
      ];
  });
@endphp

<script>
(function () {
  const products = @json($productsJson);

  const getVendorId = () => {
    const vendorElement = document.querySelector('#vendor_id');
    return vendorElement ? parseInt(vendorElement.value, 10) : NaN;
  };

  const addButton = document.querySelector('#add-product-row');
  const rowsContainer = document.querySelector('#product-rows');
  const subtotalField = document.querySelector('#subtotal');
  const totalField = document.querySelector('#total');
  const displaySubtotal = document.querySelector('#display-subtotal');
  const deliveryFeeField = document.querySelector('#delivery_fee');
  const discountField = document.querySelector('#discount');
  const taxField = document.querySelector('#tax');

  const getProductById = (id) => products.find((product) => product.id === Number(id));

  const calculateTotals = () => {
    let subtotal = 0;

    rowsContainer.querySelectorAll('tr').forEach((row) => {
      const totalInput = row.querySelector('.line-total');
      const quantityInput = row.querySelector('.quantity');
      const priceInput = row.querySelector('.product-price');
      const price = Number(priceInput.value) || 0;
      const quantity = Number(quantityInput.value) || 0;
      const lineTotal = price * quantity;

      totalInput.value = lineTotal.toFixed(2);
      subtotal += lineTotal;
    });

    subtotalField.value = subtotal.toFixed(2);
    displaySubtotal.textContent = subtotal.toFixed(2);

    const deliveryFee = Number(deliveryFeeField.value) || 0;
    const discount = Number(discountField.value) || 0;
    const tax = Number(taxField.value) || 0;
    const total = subtotal + deliveryFee + tax - discount;

    totalField.value = total.toFixed(2);
  };

  const buildProductOptions = (selectedProductId = null) => {
    const selectedVendorId = getVendorId();
    const productList = Number.isNaN(selectedVendorId)
      ? products
      : products.filter((product) => product.vendor_id === selectedVendorId);

    return productList.map((product) => {
      const isOutOfStock = product.stock !== null && Number(product.stock) <= 0;
      return `
        <option value="${product.id}" data-price="${product.price}" data-stock="${product.stock}"
          ${selectedProductId === product.id ? 'selected' : ''}
          ${isOutOfStock ? 'disabled' : ''}>
          ${product.name} — ${product.price}${isOutOfStock ? ' (Out of stock)' : ''}
        </option>
      `;
    }).join('');
  };

  const updateRow = (row) => {
    const select = row.querySelector('.product-select');
    const priceInput = row.querySelector('.product-price');
    const stockInput = row.querySelector('.product-stock');
    const quantityInput = row.querySelector('.quantity');

    const productId = Number(select.value);
    const product = getProductById(productId);

    if (!product) {
      priceInput.value = '';
      stockInput.value = '';
      quantityInput.value = 1;
      quantityInput.removeAttribute('max');
      quantityInput.min = 1;
      calculateTotals();
      return;
    }

    const productStock = Number(product.stock);

    priceInput.value = product.price.toFixed(2);
    stockInput.value = product.stock;

    if (product.stock !== null && productStock > 0) {
      quantityInput.min = 1;
      quantityInput.max = productStock;
      if (Number(quantityInput.value) < 1) {
        quantityInput.value = 1;
      }
      if (Number(quantityInput.value) > productStock) {
        quantityInput.value = productStock;
      }
    } else if (product.stock !== null && productStock <= 0) {
      quantityInput.value = 0;
      quantityInput.min = 0;
      quantityInput.max = 0;
    }

    calculateTotals();
  };

  const removeRow = (row) => {
    row.remove();
    calculateTotals();
  };

  const productExists = (productId) => {
    let exists = false;
    rowsContainer.querySelectorAll('.product-select').forEach((select) => {
      if (Number(select.value) === Number(productId)) {
        exists = true;
      }
    });
    return exists;
  };

  const addRow = (initialData = null) => {
    const selectedVendorId = getVendorId();
    const candidateProducts = Number.isNaN(selectedVendorId)
      ? products
      : products.filter((product) => product.vendor_id === selectedVendorId);

    if (!candidateProducts.length) {
      return;
    }

    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>
        <select name="product_id[]" class="form-control form-select product-select" required>
          <option value="">Select product</option>
          ${buildProductOptions(initialData?.product_id ?? null)}
        </select>
      </td>
      <td>
        <input type="number" step="0.01" class="form-control product-price" name="product_price[]" readonly />
      </td>
      <td>
        <input type="number" class="form-control product-stock" readonly />
      </td>
      <td>
        <input type="number" min="1" value="1" class="form-control quantity" name="quantity[]" required />
      </td>
      <td>
        <input type="number" step="0.01" class="form-control line-total" readonly />
      </td>
      <td>
        <button type="button" class="btn btn-sm btn-outline-danger remove-product">Remove</button>
      </td>
    `;

    const select = tr.querySelector('.product-select');
    const quantityInput = tr.querySelector('.quantity');
    const removeButton = tr.querySelector('.remove-product');

    select.addEventListener('change', () => {
      if (!select.value) {
        updateRow(tr);
        return;
      }

      if (productExists(select.value)) {
        const otherRows = Array.from(rowsContainer.querySelectorAll('tr')).filter((row) => row !== tr);
        const duplicate = otherRows.find((row) => row.querySelector('.product-select').value === select.value);
        if (duplicate) {
          const duplicateQuantity = duplicate.querySelector('.quantity');
          duplicateQuantity.value = Number(duplicateQuantity.value) + Number(quantityInput.value || 1);
          removeRow(tr);
          updateRow(duplicate);
          return;
        }
      }

      updateRow(tr);
    });

    quantityInput.addEventListener('input', () => updateRow(tr));
    removeButton.addEventListener('click', () => removeRow(tr));

    if (initialData) {
      select.value = initialData.product_id;
      quantityInput.value = initialData.quantity;
      updateRow(tr);
    }

    rowsContainer.appendChild(tr);
    updateRow(tr);
  };

  const resetProductRows = () => {
    rowsContainer.innerHTML = '';
  };

  if (addButton) {
    addButton.addEventListener('click', () => addRow());
  }

  const vendorElement = document.querySelector('#vendor_id');
  if (vendorElement) {
    vendorElement.addEventListener('change', () => {
      resetProductRows();
    });
  }

  [deliveryFeeField, discountField, taxField].forEach((field) => {
    if (field) {
      field.addEventListener('input', calculateTotals);
    }
  });

  if (Array.isArray(window.oldOrderProducts) && window.oldOrderProducts.length) {
    window.oldOrderProducts.forEach((item) => addRow(item));
  } else {
    addRow();
  }
})();
</script>
