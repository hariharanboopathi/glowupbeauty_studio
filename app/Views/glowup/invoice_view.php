<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'Tax Invoice | Glowup') ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/Glowup_Favicon_512.png') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('assets/images/Glowup_Favicon_512.png') ?>">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts & Material Symbols (Unified Single Network Request + Non-blocking display:swap) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #592E83;
            --secondary: #A36952;
            --dark: #1A0E26;
            --text-main: #2b2b2b;
            --text-muted: #666;
            --border: #e9e4f0;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f7f5fa;
            color: var(--text-main);
            padding: 30px 15px;
        }
        .invoice-card {
            max-width: 860px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(89, 46, 131, 0.08);
            border: 1px solid var(--border);
            overflow: hidden;
        }
        .invoice-header {
            background: linear-gradient(135deg, #1A0E26 0%, #301934 100%);
            color: #fff;
            padding: 40px;
        }
        .invoice-body {
            padding: 40px;
        }
        .brand-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: #f7f2fb;
        }
        .brand-sub {
            color: #cbb4de;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.15em;
        }
        .table-invoice th {
            background: #faf8fc;
            color: var(--primary);
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 12px 16px;
            border-bottom: 2px solid var(--border);
        }
        .table-invoice td {
            padding: 14px 16px;
            font-size: 13px;
            border-bottom: 1px solid var(--border);
        }
        .amount-highlight {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary);
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .d-print-none {
                display: none !important;
            }
            .invoice-card {
                border: none;
                box-shadow: none;
                max-width: 100%;
            }
            .invoice-header {
                background: #1A0E26 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

<!-- Top Navigation Ribbon -->
<div class="d-print-none text-center mb-4">
    <div class="d-inline-flex gap-2 p-2 bg-white rounded-pill shadow-sm border">
        <a href="<?= base_url('profile') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 d-flex align-items-center gap-1">
            <span class="material-symbols-outlined" style="font-size: 16px;">arrow_back</span> Back to My Profile
        </a>
        <a href="<?= business_whatsapp_url('Hello Glowup Studio, I would like to enquire about my invoice ' . $invoice['invoice_number'] . '.') ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm text-white rounded-pill px-3 d-flex align-items-center gap-1" style="background: #25D366; border-color: #25D366;" aria-label="Enquire about this invoice on WhatsApp">
            <?= glowup_whatsapp_icon('', 16) ?> WhatsApp Help
        </a>
        <button type="button" class="btn btn-sm btn-primary rounded-pill px-4 d-flex align-items-center gap-1" style="background: var(--primary); border-color: var(--primary);" onclick="window.print()">
            <span class="material-symbols-outlined" style="font-size: 16px;">print</span> Print / Save Receipt
        </button>
    </div>
</div>

<!-- Printable Tax Invoice Document -->
<div class="invoice-card">
    <!-- Header -->
    <div class="invoice-header">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-4">
            <div>
                <div class="brand-title">GLOWUP</div>
                <div class="brand-sub">Beauty Studio &amp; Academy</div>
                <div class="mt-3 text-light opacity-75" style="font-size: 12px; line-height: 1.6;">
                    <?= nl2br(esc(business_contact()['concierge_address'] ?? '12 Madurai, Tamil Nadu, India')) ?><br>
                    GSTIN: 33AAAAA0000A1Z5 | Phone: <?= esc(business_phone()) ?><br>
                    Email: <?= esc(business_contact()['concierge_email'] ?? 'concierge@glowup.in') ?>
                </div>
            </div>
            <div class="text-sm-end">
                <span class="badge px-3 py-2 text-uppercase mb-2" style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); font-size: 12px; letter-spacing: 0.08em;">
                    Tax Invoice
                </span>
                <h4 class="fw-bold mb-1" style="font-family: 'Playfair Display', serif; color: #fff;"><?= esc($invoice['invoice_number']) ?></h4>
                <div class="text-light opacity-75" style="font-size: 12px;">
                    Date: <?= date('d F Y', strtotime($invoice['invoice_date'])) ?><br>
                    Due Date: <?= date('d F Y', strtotime($invoice['due_date'])) ?>
                </div>
                <div class="mt-2">
                    <?php 
                        $st = $invoice['status'];
                        $bClass = 'bg-warning text-dark';
                        if ($st === 'paid') $bClass = 'bg-success text-white';
                        elseif ($st === 'partially_paid') $bClass = 'bg-info text-white';
                        elseif ($st === 'overdue') $bClass = 'bg-danger text-white';
                    ?>
                    <span class="badge <?= $bClass ?> px-3 py-1" style="font-size: 11px; text-transform: uppercase;">
                        Payment Status: <?= str_replace('_', ' ', $st) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Body -->
    <div class="invoice-body">
        <!-- Billed To Details -->
        <div class="row g-4 mb-4 pb-4 border-bottom">
            <div class="col-sm-6">
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;">Billed To:</span>
                <h5 class="fw-bold mt-1 mb-1" style="color: var(--primary);"><?= esc($invoice['customer_name']) ?></h5>
                <div style="font-size: 12.5px; line-height: 1.6; color: var(--text-muted);">
                    <?php if (!empty($invoice['customer_phone'])): ?>
                        📞 <?= esc($invoice['customer_phone']) ?><br>
                    <?php endif; ?>
                    <?php if (!empty($invoice['customer_email'])): ?>
                        ✉ <?= esc($invoice['customer_email']) ?><br>
                    <?php endif; ?>
                    <?= esc($invoice['customer_address'] ?: 'Patron Guest') ?>
                </div>
            </div>
            <div class="col-sm-6 text-sm-end">
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;">Payment Details:</span>
                <div class="mt-1" style="font-size: 12.5px; line-height: 1.6; color: var(--text-muted);">
                    Mode: <strong><?= esc($invoice['payment_method'] ?: 'UPI / Bank / Card') ?></strong><br>
                    Reference Booking: <strong><?= !empty($invoice['booking_id']) ? ('#BK-' . $invoice['booking_id']) : 'Direct Treatment' ?></strong>
                </div>
            </div>
        </div>

        <!-- Line Items Table -->
        <div class="table-responsive mb-4">
            <table class="table table-invoice align-middle">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Treatment / Course Description</th>
                        <th class="text-center" style="width: 80px;">Qty</th>
                        <th class="text-end" style="width: 120px;">Unit Price</th>
                        <th class="text-end" style="width: 140px;">Total (INR)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($items) && count($items) > 0): ?>
                        <?php foreach ($items as $idx => $it): ?>
                            <tr>
                                <td class="text-muted"><?= $idx + 1 ?></td>
                                <td>
                                    <strong><?= esc($it['description']) ?></strong>
                                    <?php if (!empty($it['item_type'])): ?>
                                        <span class="badge bg-light text-muted border ms-1" style="font-size: 10px;"><?= ucfirst($it['item_type']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center"><?= (int) $it['quantity'] ?></td>
                                <td class="text-end">₹<?= number_format((float) $it['unit_price'], 2) ?></td>
                                <td class="text-end fw-bold">₹<?= number_format((float) $it['total_price'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td>1</td>
                            <td><strong><?= esc($invoice['notes'] ?: 'Bespoke Aesthetic Ritual & Care') ?></strong></td>
                            <td class="text-center">1</td>
                            <td class="text-end">₹<?= number_format((float) $invoice['subtotal'], 2) ?></td>
                            <td class="text-end fw-bold">₹<?= number_format((float) $invoice['subtotal'], 2) ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Financial Summary -->
        <div class="row g-4 align-items-center mb-4">
            <div class="col-sm-6">
                <div class="p-3 rounded" style="background: #faf8fc; border: 1px dashed var(--border); font-size: 12px;">
                    <strong class="d-block mb-1 text-primary">Settlement &amp; Verification Note:</strong>
                    Invoices are payable upon receipt. Services rendered adhere to international sanitization protocols. Retain this invoice for loyalty credits and complimentary follow-up consultations.
                </div>
            </div>
            <div class="col-sm-6">
                <div class="d-flex justify-content-between py-1 border-bottom" style="font-size: 13px;">
                    <span class="text-muted">Subtotal:</span>
                    <strong>₹<?= number_format((float) $invoice['subtotal'], 2) ?></strong>
                </div>
                <?php if ((float) $invoice['discount_amount'] > 0): ?>
                    <div class="d-flex justify-content-between py-1 border-bottom text-success" style="font-size: 13px;">
                        <span>Promotional Privilege Discount:</span>
                        <strong>- ₹<?= number_format((float) $invoice['discount_amount'], 2) ?></strong>
                    </div>
                <?php endif; ?>
                <div class="d-flex justify-content-between py-1 border-bottom" style="font-size: 13px;">
                    <span class="text-muted">GST (18% Clinical Standard):</span>
                    <strong>₹<?= number_format((float) $invoice['tax_amount'], 2) ?></strong>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom" style="font-size: 16px;">
                    <span class="fw-bold">Total Amount:</span>
                    <span class="amount-highlight fs-4">₹<?= number_format((float) $invoice['total_amount'], 2) ?></span>
                </div>
                <div class="d-flex justify-content-between py-1 text-success" style="font-size: 13px;">
                    <span>Amount Paid:</span>
                    <strong>₹<?= number_format((float) $invoice['amount_paid'], 2) ?></strong>
                </div>
                <div class="d-flex justify-content-between py-2 mt-1 rounded px-2" style="background: <?= ((float) $invoice['balance_due'] > 0) ? '#fff3f3' : '#f0fff4' ?>; font-size: 14px;">
                    <span class="fw-bold" style="color: <?= ((float) $invoice['balance_due'] > 0) ? '#d32f2f' : '#2e7d32' ?>;">Balance Due:</span>
                    <strong style="color: <?= ((float) $invoice['balance_due'] > 0) ? '#d32f2f' : '#2e7d32' ?>;">₹<?= number_format((float) $invoice['balance_due'], 2) ?></strong>
                </div>
            </div>
        </div>

        <!-- Payment Settlement History -->
        <?php if (!empty($payments) && count($payments) > 0): ?>
            <div class="mt-4 pt-3 border-top">
                <h6 class="fw-bold mb-3" style="color: var(--primary); font-size: 13px; text-transform: uppercase;">Settled Payment Receipts</h6>
                <div class="table-responsive">
                    <table class="table table-sm align-middle" style="font-size: 12px;">
                        <thead>
                            <tr class="text-muted">
                                <th>Receipt #</th>
                                <th>Date</th>
                                <th>Method</th>
                                <th>Txn Ref</th>
                                <th class="text-end">Paid Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payments as $p): ?>
                                <tr>
                                    <td><strong><?= esc($p['payment_number']) ?></strong></td>
                                    <td><?= date('d M Y', strtotime($p['payment_date'])) ?></td>
                                    <td><?= esc($p['payment_method']) ?></td>
                                    <td><code><?= esc($p['transaction_ref']) ?></code></td>
                                    <td class="text-end fw-bold text-success">₹<?= number_format((float) $p['amount'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <!-- Footer Notice -->
        <div class="text-center text-muted mt-5 pt-4 border-top" style="font-size: 11px;">
            Thank you for being a cherished patron of Glowup Beauty Studio &amp; Academy.<br>
            This is a computer-generated tax invoice and requires no physical signature.
        </div>
    </div>
</div>

</body>
</html>
