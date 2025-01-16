<div class="search-form">
    <form action="<?php the_field('floor_plan_page','option'); ?>" method="GET">
      <div class="field-wrapper">
        <select id="bedroom-count" name="search-beds[]">
          <option value="0">Bedrooms</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
      </div>
      <div class="dropdown-container">
        <select id="price" name="price">
          <option value="">Select Price</option>
        </select>
        <div class="dropdown-content">
          <div class="column-wrapper">
            <div class="input-wrapper">
              <input type="number" id="min-price" name="pricesmall" >
            </div>
            <div class="input-wrapper">
              <input type="number" id="max-price" name="pricebig" >
            </div>
          </div>
        </div>
      </div>
      
      <!-- Move-In Date Dropdown -->
      <div class="date-container">
        <select id="date-in">
          <option value="">Move-In Date</option>
        </select>
        <div class="date-content">
          <input type="date" name="dates" id="move-in-date">
        </div>
      </div>

      <button type="submit" class="btn-search">Search</button>
    </form>
  </div>

  <script>
    // Price Dropdown Behavior
    const priceDropdown = document.querySelector('.dropdown-container');
    const priceSelect = document.getElementById('price');

    priceSelect.addEventListener('click', () => {
      priceDropdown.classList.toggle('open');
    });

    // Move-In Date Dropdown Behavior
    const dateDropdown = document.querySelector('.date-container');
    const dateSelect = document.getElementById('date-in');

    dateSelect.addEventListener('click', () => {
      dateDropdown.classList.toggle('open');
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', (event) => {
      if (!priceDropdown.contains(event.target)) {
        priceDropdown.classList.remove('open');
      }
      if (!dateDropdown.contains(event.target)) {
        dateDropdown.classList.remove('open');
      }
    });

    // Ensure the calendar appears on any part of the input click
    const dateInput = document.getElementById('move-in-date');
    dateInput.addEventListener('click', () => {
      dateInput.focus(); // Ensures the calendar is triggered on any click
    });
  </script>