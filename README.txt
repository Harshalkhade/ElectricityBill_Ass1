========================================================================
⚡ ELECTRICITY BILL CALCULATOR (PHP Web Application)
========================================================================

Problem Statement:
Design and develop a responsive website with the help of any code generation
AI tool to calculate Electricity bill using PHP. 
Tariff Conditions:
- First 50 units         : Rs. 3.50 / unit
- Next 100 units (51–150): Rs. 4.00 / unit
- Next 100 units (151–250): Rs. 5.20 / unit
- Units above 250        : Rs. 6.50 / unit

------------------------------------------------------------------------
✨ FEATURES & ENHANCEMENTS
------------------------------------------------------------------------
1. Progressive Slab-wise Calculation:
   - Slices energy consumption accurately across all 4 slabs.
2. Detailed Invoice / Receipt Generation:
   - Displays itemized table of units charged, unit rate, and slab cost.
   - Highlights net payable grand total.
3. Modern Glassmorphism & Responsive UI:
   - Built with Bootstrap 5, Bootstrap Icons, Google Fonts (Inter & Outfit).
   - Fully optimized for mobile, tablet, and desktop viewports.
4. Quick Presets:
   - Instant 1-click test buttons (35, 120, 210, 320 units).
5. Print / Export to PDF:
   - Dedicated print stylesheet (@media print) for creating clean physical
     invoices or saving as PDF receipts.
6. Copy Summary:
   - Quick clipboard copy feature for sharing bill breakdown.

------------------------------------------------------------------------
📊 TARIFF SLABS & CALCULATION EXAMPLES
------------------------------------------------------------------------
Example 1: 30 Units
- Slab 1 (30 units @ Rs. 3.50) = Rs. 105.00
  Total: Rs. 105.00

Example 2: 120 Units
- Slab 1 (50 units @ Rs. 3.50) = Rs. 175.00
- Slab 2 (70 units @ Rs. 4.00) = Rs. 280.00
  Total: Rs. 455.00

Example 3: 200 Units
- Slab 1 (50 units @ Rs. 3.50)  = Rs. 175.00
- Slab 2 (100 units @ Rs. 4.00) = Rs. 400.00
- Slab 3 (50 units @ Rs. 5.20)  = Rs. 260.00
  Total: Rs. 835.00

Example 4: 300 Units
- Slab 1 (50 units @ Rs. 3.50)  = Rs. 175.00
- Slab 2 (100 units @ Rs. 4.00) = Rs. 400.00
- Slab 3 (100 units @ Rs. 5.20) = Rs. 520.00
- Slab 4 (50 units @ Rs. 6.50)  = Rs. 325.00
  Total: Rs. 1,420.00

------------------------------------------------------------------------
📁 PROJECT STRUCTURE
------------------------------------------------------------------------
ElectricityBill/
│
├── index.php           # Main application with calculation logic & UI
├── css/
│   └── style.css       # Custom styling, animations & print layout
├── images/
│   └── logo.png        # Utility logo asset
└── README.txt          # Project documentation & instructions

------------------------------------------------------------------------
🚀 HOW TO RUN THE PROJECT
------------------------------------------------------------------------
1. Make sure XAMPP is installed.
2. Place the "ElectricityBill" folder inside `C:\xampp\htdocs\`.
3. Open XAMPP Control Panel and start Apache.
4. Open your browser and navigate to:
   http://localhost/ElectricityBill/
5. Enter units consumed (e.g. 175) or click a quick preset button.
6. Click "Calculate Bill" to view the detailed invoice receipt.
========================================================================
