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
                    font-family: Arial, sans-serif;
                    margin: 20px;
                    background-color: #f9f9f9;
                }
                .container {
                    max-width: 900px;
                    margin: auto;
                    background: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
                }
                .header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .header h1 {
                    margin: 0;
                    font-size: 24px;
                    color: #333;
                }
                .details-container {
                    display: flex;
                    justify-content: space-between;
                    padding: 10px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    background-color: #f8f8f8;
                    font-size: 14px;
                }
                .details-box {
                    width: 48%;
                    font-weight: bold;
                    color: #333;
                }
                .table-title {
                    background-color: #007bff;
                    color: white;
                    padding: 8px;
                    border-radius: 4px;
                    text-align: center;
                    font-size: 16px;
                    margin-bottom: 5px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                th, td {
                    border: 1px solid #ddd;
                    padding: 10px;
                    text-align: center;
                }
                th {
                    background-color: #007bff;
                    color: white;
                }
                .total-row {
                    font-weight: bold;
                    background-color: #f2f2f2;
                }
                .btn-container {
                    text-align: center;
                    margin-top: 20px;
                }
                .btn {
                    padding: 10px 15px;
                    border: none;
                    background-color: #28a745;
                    color: white;
                    cursor: pointer;
                    font-size: 16px;
                    border-radius: 5px;
                }
                .btn:hover {
                    background-color: #218838;
                }
                @media print {
                    .btn-container {
                        display: none;
                    }
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>AUM AUTOMATION ENGINEERING</h1>
                    <p>Quotation</p>
                </div>

                <!-- Company & Client Details Side by Side -->
                <div class="details-container">
                    <div class="details-box">
                        <div class="table-title">Our Details</div>
                        AUM AUTOMATION ENGINEERING <br>
                        Address: Mayapuri Road near Raj Palace ,Karnal, Haryana | PIN Code: 132001 | Phone: 9466434307,8572836307
                    </div>

                    <div class="details-box">
                        <div class="table-title">Client Details</div>
                        <?= htmlspecialchars($_POST['client_name']) ?> <br>
                        Address: <?= htmlspecialchars($_POST['client_address']) ?> | GSTIN: <?= htmlspecialchars($_POST['client_gst']) ?> | Phone: <?= htmlspecialchars($_POST['client_phone']) ?>
                    </div>
                </div>

                <!-- Quotation Table -->
                <table>
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Item Name</th>
                            <th>Qty</th>
                            <th>Unit Price (₹)</th>
                            <th>GST (%)</th>
                            <th>Total Excl. GST (₹)</th>
                            <th>GST Amount (₹)</th>
                            <th>Total Incl. GST (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grandTotal = 0;
                        foreach ($_POST['items'] as $index => $item) {
                            $srNo = $index + 1;
                            $itemName = htmlspecialchars($item['name'] ?? 'N/A');
                            $qty = (int) ($item['qty'] ?? 0);
                            $gst = (float) ($item['gst'] ?? 18);
                            $unitPrice = (float) ($item['price'] ?? 0);

                            $totalExclGst = $qty * $unitPrice;
                            $gstAmount = $totalExclGst * ($gst / 100);
                            $totalInclGst = $totalExclGst + $gstAmount;

                            $grandTotal += $totalInclGst;

                            echo "<tr>
                                <td>$srNo</td>
                                <td>$itemName</td>
                                <td>$qty</td>
                                <td>₹" . number_format($unitPrice, 2) . "</td>
                                <td>$gst%</td>
                                <td>₹" . number_format($totalExclGst, 2) . "</td>
                                <td>₹" . number_format($gstAmount, 2) . "</td>
                                <td>₹" . number_format($totalInclGst, 2) . "</td>
                            </tr>";
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

                <div class="btn-container">
                    <button class="btn" onclick="window.print()">Download PDF</button>
                </div>
            </div>
        </body>
        </html>
        <?php
        exit();
    } else {
        echo "Please fill in all required fields (client name and at least one item).";
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