<!-- Problem Statement : Design and develop a responsive website with the help of any 
 code generation  AI tool to calculate Electricity bill using PHP. Condition for first 
 50 units – Rs. 3.50/unit, for next 100 units – Rs. 4.00/unit, for next 100 units – 
 Rs. 5.20/unit and for units above 250 – Rs. 6.50/unit. -->
<?php
// Initialize variables
$consumerName = "";
$consumerId = "";
$billingMonth = date("F Y");
$units = "";
$totalBill = null;
$breakdown = [];
$error = "";

// Function to calculate electricity bill according to given tariff conditions
function calculateElectricityBill($units) {
    $remaining = (float)$units;
    $total = 0.0;
    $slabs = [];

    // Slab 1: First 50 Units @ Rs. 3.50/unit
    if ($remaining > 0) {
        $slabUnits = min($remaining, 50);
        $rate = 3.50;
        $cost = $slabUnits * $rate;
        $total += $cost;
        $remaining -= $slabUnits;
        $slabs[] = [
            "title" => "First 50 Units (1 - 50)",
            "units" => $slabUnits,
            "rate" => $rate,
            "cost" => $cost
        ];
    } else {
        $slabs[] = [
            "title" => "First 50 Units (1 - 50)",
            "units" => 0,
            "rate" => 3.50,
            "cost" => 0.00
        ];
    }

    // Slab 2: Next 100 Units (51 - 150) @ Rs. 4.00/unit
    if ($remaining > 0) {
        $slabUnits = min($remaining, 100);
        $rate = 4.00;
        $cost = $slabUnits * $rate;
        $total += $cost;
        $remaining -= $slabUnits;
        $slabs[] = [
            "title" => "Next 100 Units (51 - 150)",
            "units" => $slabUnits,
            "rate" => $rate,
            "cost" => $cost
        ];
    } elseif ($units > 0) {
        $slabs[] = [
            "title" => "Next 100 Units (51 - 150)",
            "units" => 0,
            "rate" => 4.00,
            "cost" => 0.00
        ];
    }

    // Slab 3: Next 100 Units (151 - 250) @ Rs. 5.20/unit
    if ($remaining > 0) {
        $slabUnits = min($remaining, 100);
        $rate = 5.20;
        $cost = $slabUnits * $rate;
        $total += $cost;
        $remaining -= $slabUnits;
        $slabs[] = [
            "title" => "Next 100 Units (151 - 250)",
            "units" => $slabUnits,
            "rate" => $rate,
            "cost" => $cost
        ];
    } elseif ($units > 50) {
        $slabs[] = [
            "title" => "Next 100 Units (151 - 250)",
            "units" => 0,
            "rate" => 5.20,
            "cost" => 0.00
        ];
    }

    // Slab 4: Units above 250 @ Rs. 6.50/unit
    if ($remaining > 0) {
        $slabUnits = $remaining;
        $rate = 6.50;
        $cost = $slabUnits * $rate;
        $total += $cost;
        $slabs[] = [
            "title" => "Above 250 Units (> 250)",
            "units" => $slabUnits,
            "rate" => $rate,
            "cost" => $cost
        ];
    } elseif ($units > 150) {
        $slabs[] = [
            "title" => "Above 250 Units (> 250)",
            "units" => 0,
            "rate" => 6.50,
            "cost" => 0.00
        ];
    }

    return [
        "total" => $total,
        "slabs" => $slabs
    ];
}

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $consumerName = isset($_POST["consumer_name"]) ? trim($_POST["consumer_name"]) : "";
    $consumerId = isset($_POST["consumer_id"]) ? trim($_POST["consumer_id"]) : "";
    $billingMonth = isset($_POST["billing_month"]) && !empty(trim($_POST["billing_month"])) ? trim($_POST["billing_month"]) : date("F Y");
    $rawUnits = isset($_POST["units"]) ? trim($_POST["units"]) : "";

    if ($rawUnits === "") {
        $error = "Please enter the number of electricity units consumed.";
    } elseif (!is_numeric($rawUnits) || (float)$rawUnits < 0) {
        $error = "Please enter a valid positive number for units.";
    } else {
        $units = (float)$rawUnits;
        $result = calculateElectricityBill($units);
        $totalBill = $result["total"];
        $breakdown = $result["slabs"];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Calculate your electricity bill accurately with slab-wise tariff rates. Fast, responsive, and printable bill generator using PHP.">
    <title>⚡ Electricity Bill Calculator | PHP</title>

    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="app-wrapper py-4 py-md-5">
    <div class="container">
        
        <!-- Header Banner -->
        <header class="text-center mb-4 header-section">
            <div class="brand-badge mb-2">
                <span class="pulse-dot"></span> Smart Energy Utility
            </div>
            <h1 class="main-title">
                <i class="bi bi-lightning-charge-fill text-warning"></i> Electricity Bill Calculator
            </h1>
            <p class="subtitle text-light-50">
                Slab-wise transparent tariff computation & instant receipt generator
            </p>
        </header>

        <div class="row g-4 justify-content-center">
            
            <!-- Left Column: Tariff Slabs Card -->
            <div class="col-lg-4 col-md-5">
                <div class="glass-card tariff-card h-100">
                    <div class="card-header-custom">
                        <i class="bi bi-grid-1x2-fill text-primary"></i>
                        <h3>Current Tariff Slabs</h3>
                    </div>
                    <p class="text-muted small mb-3">Official billing rates applied sequentially to consumed units:</p>
                    
                    <div class="tariff-list">
                        <div class="tariff-item <?php echo ($units !== '' && $units <= 50 && $units > 0) ? 'active-slab' : ''; ?>">
                            <div class="slab-badge slab-1">Slab 1</div>
                            <div class="slab-details">
                                <span class="slab-range">First 50 Units</span>
                                <span class="slab-limit">1 – 50 units</span>
                            </div>
                            <div class="slab-rate">₹3.50 <span>/ unit</span></div>
                        </div>

                        <div class="tariff-item <?php echo ($units > 50 && $units <= 150) ? 'active-slab' : ''; ?>">
                            <div class="slab-badge slab-2">Slab 2</div>
                            <div class="slab-details">
                                <span class="slab-range">Next 100 Units</span>
                                <span class="slab-limit">51 – 150 units</span>
                            </div>
                            <div class="slab-rate">₹4.00 <span>/ unit</span></div>
                        </div>

                        <div class="tariff-item <?php echo ($units > 150 && $units <= 250) ? 'active-slab' : ''; ?>">
                            <div class="slab-badge slab-3">Slab 3</div>
                            <div class="slab-details">
                                <span class="slab-range">Next 100 Units</span>
                                <span class="slab-limit">151 – 250 units</span>
                            </div>
                            <div class="slab-rate">₹5.20 <span>/ unit</span></div>
                        </div>

                        <div class="tariff-item <?php echo ($units > 250) ? 'active-slab' : ''; ?>">
                            <div class="slab-badge slab-4">Slab 4</div>
                            <div class="slab-details">
                                <span class="slab-range">Above 250 Units</span>
                                <span class="slab-limit">251+ units</span>
                            </div>
                            <div class="slab-rate">₹6.50 <span>/ unit</span></div>
                        </div>
                    </div>

                    <div class="tariff-footer-note mt-3">
                        <i class="bi bi-info-circle-fill text-info"></i>
                        <span>Units are calculated progressively across each applicable slab.</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Calculator Form & Result Receipt -->
            <div class="col-lg-7 col-md-7">
                <div class="glass-card main-card">
                    
                    <!-- Form Section -->
                    <div class="no-print">
                        <div class="card-header-custom border-0 pb-0">
                            <i class="bi bi-calculator-fill text-primary"></i>
                            <h3>Calculate Bill</h3>
                        </div>
                        <p class="text-muted small mb-4">Enter your energy consumption in kilowatt-hours (kWh / Units):</p>

                        <?php if ($error !== ""): ?>
                            <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                                <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2 fs-5"></i>
                                <div><?php echo htmlspecialchars($error); ?></div>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="" id="billForm">
                            <!-- Optional Consumer Info (Collapsible / Clean) -->
                            <div class="row g-2 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold text-secondary">
                                        <i class="bi bi-person"></i> Consumer Name (Optional)
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-sm" 
                                           name="consumer_name" 
                                           placeholder="e.g. John Doe"
                                           value="<?php echo htmlspecialchars($consumerName); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold text-secondary">
                                        <i class="bi bi-calendar-event"></i> Billing Month
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-sm" 
                                           name="billing_month" 
                                           value="<?php echo htmlspecialchars($billingMonth); ?>">
                                </div>
                            </div>

                            <!-- Main Input: Units -->
                            <div class="mb-3">
                                <label for="unitsInput" class="form-label fw-bold text-dark d-flex justify-content-between">
                                    <span><i class="bi bi-speedometer2 text-primary"></i> Units Consumed (kWh) <span class="text-danger">*</span></span>
                                    <span class="badge bg-light text-primary border">Required</span>
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light"><i class="bi bi-lightning text-warning"></i></span>
                                    <input type="number" 
                                           id="unitsInput"
                                           name="units" 
                                           class="form-control form-control-lg fw-bold" 
                                           placeholder="e.g. 175" 
                                           step="any" 
                                           min="0"
                                           value="<?php echo ($units !== "") ? htmlspecialchars($units) : ""; ?>" 
                                           required>
                                    <span class="input-group-text bg-light text-muted">Units</span>
                                </div>
                            </div>

                            <!-- Quick Preset Buttons -->
                            <div class="preset-container mb-4">
                                <span class="preset-label small text-muted me-2">Quick Presets:</span>
                                <button type="button" class="btn btn-preset" onclick="setUnits(35)">35 Units</button>
                                <button type="button" class="btn btn-preset" onclick="setUnits(120)">120 Units</button>
                                <button type="button" class="btn btn-preset" onclick="setUnits(210)">210 Units</button>
                                <button type="button" class="btn btn-preset" onclick="setUnits(320)">320 Units</button>
                            </div>

                            <!-- Submit and Reset Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-lg flex-grow-1 submit-btn">
                                    <i class="bi bi-cpu-fill me-1"></i> Calculate Bill
                                </button>
                                <a href="index.php" class="btn btn-outline-secondary btn-lg px-3" title="Reset Form">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Bill Result / Receipt Section -->
                    <?php if ($totalBill !== null): ?>
                        <div class="receipt-section mt-4 pt-3 border-top" id="billReceipt">
                            <div class="receipt-header d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 mb-1">
                                        <i class="bi bi-check-circle-fill"></i> Calculation Generated
                                    </span>
                                    <h4 class="fw-bold mb-0 text-dark">Electricity Bill Invoice</h4>
                                </div>
                                <div class="text-end">
                                    <div class="text-muted small">Date: <?php echo date("d M Y"); ?></div>
                                    <div class="text-muted small">Month: <strong><?php echo htmlspecialchars($billingMonth); ?></strong></div>
                                </div>
                            </div>

                            <!-- Consumer Info Preview -->
                            <?php if (!empty($consumerName)): ?>
                                <div class="consumer-meta-box p-2 mb-3 bg-light rounded border d-flex justify-content-between">
                                    <div><strong>Consumer:</strong> <?php echo htmlspecialchars($consumerName); ?></div>
                                    <div><strong>Ref No:</strong> <?php echo 'EB-' . strtoupper(substr(md5($units . time()), 0, 6)); ?></div>
                                </div>
                            <?php endif; ?>

                            <!-- Slab Breakdown Table -->
                            <div class="table-responsive mb-3">
                                <table class="table table-hover align-middle border mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tariff Slab</th>
                                            <th class="text-center">Units Charged</th>
                                            <th class="text-end">Rate / Unit</th>
                                            <th class="text-end">Amount (₹)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($breakdown as $item): ?>
                                            <tr class="<?php echo ($item['units'] > 0) ? 'table-row-active' : 'text-muted opacity-75'; ?>">
                                                <td>
                                                    <strong><?php echo $item['title']; ?></strong>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge <?php echo ($item['units'] > 0) ? 'bg-primary-subtle text-primary' : 'bg-light text-muted'; ?> fw-semibold">
                                                        <?php echo number_format($item['units'], 2); ?>
                                                    </span>
                                                </td>
                                                <td class="text-end">₹<?php echo number_format($item['rate'], 2); ?></td>
                                                <td class="text-end fw-semibold">
                                                    ₹<?php echo number_format($item['cost'], 2); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot class="table-group-divider">
                                        <tr class="table-light">
                                            <th>Total Units Consumed:</th>
                                            <th class="text-center text-primary fs-6"><?php echo number_format($units, 2); ?> kWh</th>
                                            <th class="text-end">Net Payable:</th>
                                            <th class="text-end text-success fs-5 fw-bold">₹<?php echo number_format($totalBill, 2); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- Highlight Total Card -->
                            <div class="grand-total-box p-3 rounded d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <div class="text-uppercase small fw-bold text-muted">Total Amount Due</div>
                                    <div class="text-muted small">Inclusive of all progressive slab charges</div>
                                </div>
                                <div class="text-end">
                                    <div class="grand-total-amount">₹ <?php echo number_format($totalBill, 2); ?></div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2 justify-content-end no-print">
                                <button onclick="window.print()" class="btn btn-outline-primary">
                                    <i class="bi bi-printer-fill me-1"></i> Print Invoice
                                </button>
                                <button onclick="copyBillSummary()" class="btn btn-outline-secondary" id="copyBtn">
                                    <i class="bi bi-clipboard me-1"></i> Copy Summary
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>

        <!-- Footer -->
        <footer class="text-center mt-5 text-light-50 no-print">
            <p class="small mb-1">
                Electricity Bill Calculator Web App • Developed with PHP, HTML5, CSS3 & Bootstrap 5
            </p>
            <p class="x-small text-muted mb-0">
                Rate Rules: 1–50 @ ₹3.50 | 51–150 @ ₹4.00 | 151–250 @ ₹5.20 | >250 @ ₹6.50
            </p>
        </footer>

    </div>
</div>

<!-- Bootstrap 5 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Quick set units button helper
function setUnits(val) {
    const input = document.getElementById('unitsInput');
    input.value = val;
    input.focus();
}

// Copy Summary to Clipboard
function copyBillSummary() {
    const units = "<?php echo $units !== null ? $units : ''; ?>";
    const total = "<?php echo $totalBill !== null ? number_format($totalBill, 2) : ''; ?>";
    const month = "<?php echo htmlspecialchars($billingMonth); ?>";
    
    if (!units || !total) return;

    const text = `--- Electricity Bill Summary ---\nBilling Month: ${month}\nUnits Consumed: ${units} kWh\nTotal Payable: Rs. ${total}\n--------------------------------`;
    
    navigator.clipboard.writeText(text).then(() => {
        const copyBtn = document.getElementById('copyBtn');
        const originalHtml = copyBtn.innerHTML;
        copyBtn.innerHTML = '<i class="bi bi-check2"></i> Copied!';
        copyBtn.classList.remove('btn-outline-secondary');
        copyBtn.classList.add('btn-success');
        setTimeout(() => {
            copyBtn.innerHTML = originalHtml;
            copyBtn.classList.remove('btn-success');
            copyBtn.classList.add('btn-outline-secondary');
        }, 2000);
    });
}
</script>

</body>
</html>