<?php include(__DIR__ . '/include/header.php'); ?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>New Service Request</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    /* Reset */
    * {
      box-sizing: border-box;
    }
    body {
      background: url('dash.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: "Comic Sans MS", cursive, sans-serif;
      color: #e6e6e6;
      min-height: 100vh;
      position: relative;
    }
    /* Overlay */
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.65);
      z-index: -1;
    }

    .navbar {
      background: rgba(0, 0, 0, 0.6) !important; 
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    }
    .navbar .navbar-brand,
    .navbar .nav-link {
      color: #fff !important;
      font-weight: 500;
      transition: color 0.3s ease;
    }
    .navbar .nav-link:hover,
    .navbar .nav-link.active {
      color: #ffffffff !important;
    }
    /* Card */
    .card-custom {
      border: none;
      border-radius: 20px;
      padding: 2rem;
      background: rgba(28, 21, 21, 0.08);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      box-shadow: 0 8px 24px rgba(0,0,0,0.5);
      transition: transform 0.3s ease, background 0.3s ease;
    }
    .card-custom:hover {
     
      background: rgba(255, 255, 255, 0.15);
    }
    .card-custom h2 {
      text-align: center;
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 1.5rem;
      text-shadow: 0 3px 8px rgba(0,0,0,0.7);
      color: #fff;
    }
    label {
      font-weight: 600;
      color: #f5f5f5;
    }

    /* Form Inputs */
    .form-control, .form-select {
      border-radius: 12px;
      padding: 12px 15px;
      border: 1.5px solid #4fc3f7;
      background: rgba(255, 255, 255, 0.08);
      color: #fff !important; /* White text inside fields */
      transition: border-color 0.3s ease, background 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
      outline: none;
      border-color: #00acc1;
      background: rgba(255, 255, 255, 0.15);
      color: #fff !important;
    }
    textarea, input, select {
      color: #fff !important;
    }
    .form-control::placeholder,
    textarea::placeholder,
    input::placeholder {
      color: rgba(255,255,255,0.7) !important; /* Light white placeholder */
    }
    /* Dropdown options */
    select option {
      background-color: #222; /* Dark background */
      color: #fff; /* White text */
    }

    /* Button */
    .btn-submit {
      background: linear-gradient(45deg, #00c6ff, #0072ff);
      border: none;
      padding: 14px 0;
      border-radius: 30px;
      color: #fff;
      font-weight: bold;
      font-size: 18px;
      cursor: pointer;
      box-shadow: 0 6px 20px rgba(0, 172, 193, 0.4);
      transition: background 0.3s ease, transform 0.2s ease;
    }
    .btn-submit:hover {
      background: linear-gradient(45deg, #0072ff, #00c6ff);
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(0, 131, 148, 0.7);
    }
    /* Fun Comic Sans hover effect */
    .comic-font {
      font-family: "Comic Sans MS", cursive, sans-serif !important;
      transition: 0.3s;
    }
    /* Force custom dropdown arrow ▼ */
.dropdown {
  appearance: none;           /* Remove browser default arrow */
  -webkit-appearance: none;
  -moz-appearance: none;
  background-image: url("data:image/svg+xml;utf8,<svg fill='white' height='16' viewBox='0 0 24 24' width='16' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
  background-repeat: no-repeat;
  background-position: right 12px center; /* position arrow */
  background-size: 16px;
  padding-right: 2.5rem;       /* give space for arrow */
}

  </style>
</head>
<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-7 col-md-9">
        <div class="card card-custom" id="service-card">
          <h2>Request Aircon Service</h2>

          <form action ="submit_request.php" method="POST" enctype="multipart/form-data">

            <!-- Service Type -->
            <div class="mb-3">
              <label for="service-type" class="form-label">Service Type </label>
                    <select id="service-type" class="form-select dropdown" required name="service_type" onchange="calculatePrice()">
                        <option value="">Select Service Type </option>
                        <option value="Repair">Repair</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Installation">Installation</option>
                        <option value="Inspection">Inspection</option>
                    </select>
            </div>

            <!-- AC Brand -->
            <div class="mb-3">
              <label for="ac-brand" class="form-label">AC Brand</label>
                    <select id="ac_brand" class="form-select dropdown" required name="ac_brand" onchange="toggleOtherBrand(); calculatePrice()">
                         <option value="">-- Select Brand --</option>
              <option value="LG">LG</option>
              <option value="Daikin">Daikin</option>
              <option value="Samsung">Samsung</option>
              <option value="Panasonic">Panasonic</option>
              <option value="Carrier">Carrier</option>
              <option value="Midea">Midea</option>
              <option value="Hitachi">Hitachi</option>
              <option value="Fujitsu">Fujitsu</option>
              <option value="Haier">Haier</option>
              <option value="Sharp">Sharp</option>
              <option value="Others">Others</option> <!-- NEW -->
                    </select>
                    
              <div id="other-brand-container" class="mt-2" style="display:none;">
    <label for="other_brand" class="form-label">Specify Other Brand</label>
    <input type="text" id="other_brand" name="ac_brand_other" class="form-control" placeholder="Enter brand name">
  </div>

                    
            </div>

            


            <!-- AC Model -->
            <div class="mb-3">
              <label for="ac-model" class="form-label">AC Model</label>
                    <select id="ac_model" class="form-select dropdown" required name="ac_model" onchange="toggleOtherModel(); calculatePrice()">
                        <option value="">-- Select Model --</option>
              <option value="Window">Window</option>
              <option value="Split">Split</option>
              <option value="Inverter">Inverter</option>
              <option value="Cassette">Cassette</option>
              <option value="Portable">Portable</option>
              <option value="Others">Others</option> <!-- NEW -->
                    </select>
            </div>

            <div id="other-model-container" class="mt-2" style="display:none;">
              <label for="other_model" class="form-label">Specify Other Model</label>
              <input type="text" id="other_model" name="ac_model_other" class="form-control" placeholder="Enter model name">
            </div>
            <br>

            <div class="form-group">
                <label for="price" class="form-label">Estimated Price</label>
                <input id="pricedisplay" class="form-select" required name="price" readonly value="0">
              </div>
            <br>
              

            <script>
              function toggleOtherBrand() {
    const acBrand = document.getElementById("ac_brand").value;
    const otherBrandContainer = document.getElementById("other-brand-container");
    const otherBrandInput = document.getElementById("other_brand");

    if (acBrand === "Others") {
      otherBrandContainer.style.display = "block";
      otherBrandInput.required = true;
    } else {
      otherBrandContainer.style.display = "none";
      otherBrandInput.required = false;
      otherBrandInput.value = "";
    }
  }
              function toggleOtherModel() {
                const acModel = document.getElementById("ac_model").value;
                const otherModelContainer = document.getElementById("other-model-container");
                const otherModelInput = document.getElementById("other_model");

                if (acModel === "Others") {
                  otherModelContainer.style.display = "block";
                  otherModelInput.required = true; // make it required
                } else {
                  otherModelContainer.style.display = "none";
                  otherModelInput.required = false;
                  otherModelInput.value = ""; // reset value if not needed
                }
              }

                
                function calculatePrice() {
                    let service = document.getElementById("service-type").value;
                    let brand = document.getElementById("ac_brand").value;
                    let model = document.getElementById("ac_model").value;
                    let priceBox = document.getElementById("pricedisplay");

                    const prices = {
    Repair: {
      LG: { Window: 1200, Split: 1500, Inverter: 1800, Cassette: 2200, Portable: 1000 },
      Daikin: { Window: 1300, Split: 1600, Inverter: 1900, Cassette: 2300, Portable: 1100 },
      Samsung: { Window: 1250, Split: 1550, Inverter: 1850, Cassette: 2250, Portable: 1050 },
      Panasonic: { Window: 1280, Split: 1580, Inverter: 1880, Cassette: 2280, Portable: 1080 },
      Carrier: { Window: 1350, Split: 1650, Inverter: 1950, Cassette: 2350, Portable: 1150 },
      Midea: { Window: 1220, Split: 1520, Inverter: 1820, Cassette: 2220, Portable: 1020 },
      Hitachi: { Window: 1400, Split: 1700, Inverter: 2000, Cassette: 2400, Portable: 1200 },
      Fujitsu: { Window: 1380, Split: 1680, Inverter: 1980, Cassette: 2380, Portable: 1180 },
      Haier: { Window: 1180, Split: 1480, Inverter: 1780, Cassette: 2180, Portable: 980 },
      Sharp: { Window: 1240, Split: 1540, Inverter: 1840, Cassette: 2240, Portable: 1040 }
    },
    Maintenance: {
      LG: { Window: 800, Split: 1000, Inverter: 1200, Cassette: 1500, Portable: 700 },
      Daikin: { Window: 850, Split: 1100, Inverter: 1250, Cassette: 1550, Portable: 750 },
      Samsung: { Window: 820, Split: 1050, Inverter: 1230, Cassette: 1520, Portable: 720 },
      Panasonic: { Window: 840, Split: 1080, Inverter: 1260, Cassette: 1560, Portable: 740 },
      Carrier: { Window: 870, Split: 1120, Inverter: 1300, Cassette: 1600, Portable: 770 },
      Midea: { Window: 810, Split: 1020, Inverter: 1210, Cassette: 1510, Portable: 710 },
      Hitachi: { Window: 880, Split: 1150, Inverter: 1330, Cassette: 1650, Portable: 780 },
      Fujitsu: { Window: 860, Split: 1130, Inverter: 1310, Cassette: 1630, Portable: 760 },
      Haier: { Window: 790, Split: 990, Inverter: 1190, Cassette: 1490, Portable: 690 },
      Sharp: { Window: 830, Split: 1060, Inverter: 1240, Cassette: 1540, Portable: 730 }
    },
    Installation: {
      LG: { Window: 2000, Split: 2500, Inverter: 2800, Cassette: 3200, Portable: 1800 },
      Daikin: { Window: 2100, Split: 2600, Inverter: 2900, Cassette: 3300, Portable: 1900 },
      Samsung: { Window: 2050, Split: 2550, Inverter: 2850, Cassette: 3250, Portable: 1850 },
      Panasonic: { Window: 2080, Split: 2580, Inverter: 2880, Cassette: 3280, Portable: 1880 },
      Carrier: { Window: 2150, Split: 2650, Inverter: 2950, Cassette: 3350, Portable: 1950 },
      Midea: { Window: 2020, Split: 2520, Inverter: 2820, Cassette: 3220, Portable: 1820 },
      Hitachi: { Window: 2200, Split: 2700, Inverter: 3000, Cassette: 3400, Portable: 2000 },
      Fujitsu: { Window: 2180, Split: 2680, Inverter: 2980, Cassette: 3380, Portable: 1980 },
      Haier: { Window: 1980, Split: 2480, Inverter: 2780, Cassette: 3180, Portable: 1780 },
      Sharp: { Window: 2040, Split: 2540, Inverter: 2840, Cassette: 3240, Portable: 1840 }
    },
    Inspection: {
      LG: { Window: 500, Split: 600, Inverter: 700, Cassette: 800, Portable: 450 },
      Daikin: { Window: 550, Split: 650, Inverter: 750, Cassette: 850, Portable: 500 },
      Samsung: { Window: 520, Split: 620, Inverter: 720, Cassette: 820, Portable: 470 },
      Panasonic: { Window: 540, Split: 640, Inverter: 740, Cassette: 840, Portable: 490 },
      Carrier: { Window: 570, Split: 670, Inverter: 770, Cassette: 870, Portable: 520 },
      Midea: { Window: 510, Split: 610, Inverter: 710, Cassette: 810, Portable: 460 },
      Hitachi: { Window: 580, Split: 680, Inverter: 780, Cassette: 880, Portable: 530 },
      Fujitsu: { Window: 560, Split: 660, Inverter: 760, Cassette: 860, Portable: 510 },
      Haier: { Window: 490, Split: 590, Inverter: 690, Cassette: 790, Portable: 430 },
      Sharp: { Window: 530, Split: 630, Inverter: 730, Cassette: 830, Portable: 480 }
    }

                    };
                      if (brand === "Others" || model === "Others") {
    priceBox.value = "Pending Verification";
    return; // stop here
  }

  let price = 0;
  if (service && brand && model && prices[service] && prices[service][brand] && prices[service][brand][model]) {
    price = prices[service][brand][model];
  }

  priceBox.value = price;
}

            </script>

            <!-- Issue Description -->
            <div class="mb-3">
              <label for="issue" class="form-label">Describe the Issue</label>
              <textarea id="issue" name="issue_description" class="form-control" rows="4" placeholder="Please describe the problem with your aircon unit..." required></textarea>
            </div>

            <!-- Address -->
            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <input id="address" type="text" name="address" class="form-control" placeholder="e.g., Exact Address" required>
            </div>

            <!-- Location / Room -->
            <div class="mb-3">
              <label for="location" class="form-label">Location</label>
              <input id="location" type="text" name="location_room" class="form-control" placeholder="e.g., Residential, Subdivision, Dormitory">
            </div>

            <!-- Customer Notes -->
            <div class="mb-3">
              <label for="customer-notes" class="form-label">Customer Notes</label>
              <input id="customer-notes" type="text" name="customer_notes" class="form-control" placeholder="e.g., Too Hot, Making Weird Noises, Not Cooling">
            </div>

            <!-- Preferred Date -->
            <div class="mb-3">
          <label for="preferred-date" class="form-label">Preferred Service Date</label>
          <input id="preferred-date" type="datetime-local" name="preferred_date" class="form-control" required>
          <small id="date-error" class="text-danger" style="display:none;">❌ You cannot select yesterday or past dates.</small>
        </div>


            <!-- Upload Photo -->
            <div class="mb-3">
              <label for="photo" class="form-label">Upload Photos</label>
              <input id="photo" type="file" name="photo" class="form-control" accept="image/*">
              <small class="form-text text-light">Helps our technicians prepare better</small>
            </div>

            <!-- Submit -->
            <div class="d-grid">
  <button type="submit" name="submit_request" class="btn-submit">📩 Submit Service Request</button>
</div>

<script>
  const dateInput = document.getElementById("preferred-date");
  const form = document.querySelector("form");
  const errorMsg = document.getElementById("date-error");

  form.addEventListener("submit", function(e) {
    const selectedDate = new Date(dateInput.value);
    const now = new Date();

    // remove seconds and ms for cleaner comparison
    selectedDate.setSeconds(0,0);
    now.setSeconds(0,0);

    if (selectedDate < now) {
      e.preventDefault(); // stop form submission
      errorMsg.style.display = "block";
      dateInput.classList.add("is-invalid");
    } else {
      errorMsg.style.display = "none";
      dateInput.classList.remove("is-invalid");
    }
  });
</script>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
