<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['items']) && !empty($_POST['items']) && !empty($_POST['client_name'])) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Quotation - AUM AUTOMATION ENGINEERING</title>
            <style>
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    margin: 0;
                    background-color: #f5f5f5;
                    color: #333;
                }
                .container {
                    max-width: 210mm;
                    min-height: 297mm;
                    margin: 20px auto;
                    background: white;
                    padding: 30px;
                    box-shadow: 0 0 20px rgba(0,0,0,0.1);
                }
                .letterhead {
                    border-bottom: 4px solid #2c3e50;
                    padding-bottom: 20px;
                    margin-bottom: 30px;
                }
                .letterhead h1 {
                    color: #2c3e50;
                    margin: 0;
                    font-size: 32px;
                    text-transform: uppercase;
                }
                .details-container {
                    display: flex;
                    gap: 20px;
                    margin-bottom: 30px;
                }
                .details-box {
                    flex: 1;
                    padding: 20px;
                    background: #f8f9fa;
                    border-radius: 8px;
                }
                .details-title {
                    color: #2c3e50;
                    margin-bottom: 15px;
                    font-weight: 600;
                    font-size: 18px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 25px 0;
                    table-layout: fixed;
                }
                th, td {
                    padding: 12px;
                    border: 1px solid #dee2e6;
                    text-align: center;
                    word-wrap: break-word;
                }
                th {
                    background-color: #2c3e50;
                    color: white;
                    font-weight: 600;
                }
                tbody tr:nth-child(even) {
                    background-color: #f8f9fa;
                }
                .total-row {
                    font-weight: 700;
                    background-color: #e9ecef;
                }
                .footer-section {
                    margin-top: 40px;
                    padding-top: 20px;
                    border-top: 2px solid #dee2e6;
                }
                .bank-details {
                    background: #f8f9fa;
                    padding: 15px;
                    border-radius: 8px;
                    margin: 20px 0;
                }
                .terms {
                    font-size: 12px;
                    color: #6c757d;
                    line-height: 1.6;
                }
                @media print {
                    body {
                        background: none;
                        margin: 0;
                    }
                    .container {
                        box-shadow: none;
                        margin: 0;
                        padding: 20px;
                        page-break-after: always;
                    }
                    .btn-container {
                        display: none;
                    }
                }
                @media (max-width: 768px) {
                    .details-container {
                        flex-direction: column;
                    }
                    th, td {
                        padding: 8px;
                        font-size: 14px;
                    }
                }
                .page-break {
                    page-break-before: always;
                }
                tr {
                    page-break-inside: avoid;
                    break-inside: avoid;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="letterhead">
                    <h1>AUM AUTOMATION ENGINEERING</h1>
                    <p>Mayapuri Road near Raj Palace, Karnal, Haryana 132001<br>
                    📞 9466434307, 8572836307 | GSTIN: <?= htmlspecialchars($_POST['company_gst'] ?? 'N/A') ?></p>
                </div>

                <div class="details-container">
                    <div class="details-box">
                        <div class="details-title">Quotation To:</div>
                        <strong><?= htmlspecialchars($_POST['client_name']) ?></strong><br>
                        <?= htmlspecialchars($_POST['client_address']) ?><br>
                        GSTIN: <?= htmlspecialchars($_POST['client_gst']) ?><br>
                        📞 <?= htmlspecialchars($_POST['client_phone']) ?>
                    </div>
                    <div class="details-box">
                        <div class="details-title">Quotation Details:</div>
                        Date: <?= date('d/m/Y') ?><br>
                        Validity: 30 Days<br>
                        Prepared By: <?= htmlspecialchars($_POST['prepared_by'] ?? 'Sales Team') ?>
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%">Sr No</th>
                            <th style="width: 25%">Item Description</th>
                            <th style="width: 7%">Qty</th>
                            <th style="width: 12%">Unit Price (₹)</th>
                            <th style="width: 8%">GST (%)</th>
                            <th style="width: 13%">Total Excl. GST (₹)</th>
                            <th style="width: 13%">GST Amount (₹)</th>
                            <th style="width: 17%">Total Incl. GST (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grandTotal = 0;
                        $counter = 0;
                        foreach ($_POST['items'] as $index => $item) {
                            if ($counter > 0 && $counter % 20 === 0) {
                                echo '</tbody></table></div><div class="container page-break">';
                                echo '<div class="letterhead"><h1>AUM AUTOMATION ENGINEERING</h1></div>';
                                echo '<table><thead><tr>...<!-- Repeat table headers --></tr></thead><tbody>';
                            }
                            $srNo = $index + 1;
                            // ... rest of item processing ...
                            echo "<tr>...</tr>";
                            $counter++;
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="total-row">
                            <td colspan="7" style="text-align: right;">Grand Total</td>
                            <td>₹<?= number_format($grandTotal, 2) ?></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="footer-section">
                    <div class="bank-details">
                        <h3 style="margin-top:0;">Bank Details</h3>
                        <p>Account Name: AUM AUTOMATION ENGINEERING<br>
                        Account Number: XXXXXXXXXXXX<br>
                        IFSC Code: XXXXXXXX<br>
                        Bank Name: [Your Bank Name]<br>
                        Branch: [Your Branch Name]</p>
                    </div>

                    <div class="terms">
                        <h4>Terms & Conditions:</h4>
                        <ul>
                            <li>Prices mentioned are exclusive of taxes, delivery charges, and any other applicable charges</li>
                            <li>All charges will be added as per actuals</li>
                            <li>Prices subject to change based on market conditions and stock availability</li>
                            <li>Payment terms: 50% advance with PO, balance before delivery</li>
                            <li>Delivery period: 2-3 weeks after receipt of advance payment</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="btn-container">
                <button class="btn" onclick="window.print()">Download PDF</button>
            </div>
        </body>
        </html>
        <?php
        exit();
    } else {
        echo "Please fill in all required fields";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation Generator - AUM AUTOMATION ENGINEERING</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f9f9f9; }
        h1, h2 { color: #333; text-align: center; }
        .container { max-width: 1000px; margin: 0 auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .company-details, .client-details { margin-bottom: 20px; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .company-details h3, .client-details h3 { margin: 0 0 10px; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #4CAF50; color: white; }
        input[type="text"], input[type="number"] { width: 100%; padding: 5px; box-sizing: border-box; }
        button { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; }
        .add-btn { background-color: #4CAF50; color: white; }
        .delete-btn { background-color: #ff4444; color: white; }
        .submit-btn { background-color: #008CBA; color: white; }
        .total-row { font-weight: bold; background-color: #f2f2f2; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h1>AUM AUTOMATION ENGINEERING</h1>
        <div class="company-details">
            <h3>Our Details</h3>
            <p>Address: ABC, From State</p>
            <p>PIN Code: 123456</p>
            <p>Phone: 127927927</p>
        </div>

        <h2>Quotation Generator</h2>
        <form method="POST" id="quotationForm">
            <div class="client-details">
                <h3>Client Details</h3>
                <label>Company Name: <input type="text" name="client_name" required></label><br>
                <label>Address: <input type="text" name="client_address" required></label><br>
                <label>GSTIN: <input type="text" name="client_gst" required></label><br>
                <label>Phone: <input type="text" name="client_phone" required></label>
            </div>

            <table id="quotationTable">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Item Name</th>
                        <th>Qty</th>
                        <th>GST (%)</th>
                        <th>Unit Price (₹)</th>
                        <th>Total Incl. GST (₹)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="itemsBody">
                    <!-- Initial Row -->
                    <tr>
                        <td>1</td>
                        <td><input type="text" name="items[0][name]" required></td>
                        <td><input type="number" class="qty" name="items[0][qty]" value="1" min="1" required onchange="updatePrice(this.parentElement.parentElement)"></td>
                        <td><input type="number" class="gst" name="items[0][gst]" value="18" min="0" max="100" step="0.01" required onchange="updatePrice(this.parentElement.parentElement)"></td>
                        <td><input type="number" class="price" name="items[0][price]" value="0" min="0" step="0.01" required onchange="updatePrice(this.parentElement.parentElement)"></td>
                        <td class="total">0.00</td>
                        <td><button type="button" class="delete-btn" onclick="deleteRow(this)">Delete</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="add-btn" onclick="addRow()">+ Add Item</button>
            <h3>Total Amount: ₹<span id="grandTotal">0.00</span></h3>
            <button type="submit" class="submit-btn">Download CSV</button>
        </form>
    </div>

    <script>
        let rowCount = 1;

        function updatePrice(row) {
            const qty = parseFloat(row.querySelector('.qty').value) || 0;
            const price = parseFloat(row.querySelector('.price').value) || 0;
            const gst = parseFloat(row.querySelector('.gst').value) || 0;
            const totalExclGst = qty * price;
            const gstAmount = totalExclGst * (gst / 100);
            const totalInclGst = totalExclGst + gstAmount;
            row.querySelector('.total').innerText = totalInclGst.toFixed(2);
            updateTotalAmount();
        }

        function updateTotalAmount() {
            let totalAmount = 0;
            document.querySelectorAll('.total').forEach(cell => {
                totalAmount += parseFloat(cell.innerText) || 0;
            });
            document.getElementById('grandTotal').innerText = totalAmount.toFixed(2);
        }

        function addRow() {
            const tbody = document.getElementById('itemsBody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${rowCount + 1}</td>
                <td><input type="text" name="items[${rowCount}][name]" required></td>
                <td><input type="number" class="qty" name="items[${rowCount}][qty]" value="1" min="1" required onchange="updatePrice(this.parentElement.parentElement)"></td>
                <td><input type="number" class="gst" name="items[${rowCount}][gst]" value="18" min="0" max="100" step="0.01" required onchange="updatePrice(this.parentElement.parentElement)"></td>
                <td><input type="number" class="price" name="items[${rowCount}][price]" value="0" min="0" step="0.01" required onchange="updatePrice(this.parentElement.parentElement)"></td>
                <td class="total">0.00</td>
                <td><button type="button" class="delete-btn" onclick="deleteRow(this)">Delete</button></td>
            `;
            tbody.appendChild(newRow);
            rowCount++;
        }

        function deleteRow(button) {
            const tbody = document.getElementById('itemsBody');
            if (tbody.rows.length > 1) {
                button.parentElement.parentElement.remove();
                updateRowNumbers();
                updateTotalAmount();
            } else {
                alert("Cannot delete the last row.");
            }
        }

        function updateRowNumbers() {
            const rows = document.querySelectorAll('#itemsBody tr');
            rows.forEach((row, index) => {
                row.cells[0].innerText = index + 1;
            });
        }

        document.addEventListener("DOMContentLoaded", function () {
            updatePrice(document.querySelector('#itemsBody tr')); // Initial calculation
        });
    </script>
</body>
</html>