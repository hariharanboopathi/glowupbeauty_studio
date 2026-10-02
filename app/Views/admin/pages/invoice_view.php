<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- Action & Status Ribbon -->
<div class="glass-panel p-3 mb-4 d-print-none">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url('admin/invoices') ?>" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
                <span class="material-symbols-outlined" style="font-size: 16px;">arrow_back</span>
                Back to Invoices
            </a>
            <div>
                <span class="text-muted" style="font-size: 12px;">Invoice Status:</span>
                <?php 
                    $st = $invoice['status'];
                    $badgeStyle = 'background: rgba(108, 117, 125, 0.12); color: #6c757d;';
                    if ($st === 'paid') $badgeStyle = 'background: rgba(46, 125, 50, 0.12); color: #2e7d32;';
                    elseif ($st === 'sent') $badgeStyle = 'background: rgba(2, 136, 209, 0.12); color: #0288d1;';
                    elseif ($st === 'partially_paid') $badgeStyle = 'background: rgba(245, 124, 0, 0.12); color: #f57c00;';
                    elseif ($st === 'overdue') $badgeStyle = 'background: rgba(211, 47, 47, 0.12); color: #d32f2f;';
                    elseif ($st === 'cancelled') $badgeStyle = 'background: rgba(0, 0, 0, 0.12); color: #333;';
                ?>
                <span class="badge ms-1" style="<?= $badgeStyle ?> font-weight: 700; text-transform: uppercase; border-radius: 8px; padding: 4px 10px;">
                    <?= str_replace('_', ' ', $st) ?>
                </span>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <!-- Record Payment Button -->
            <?php if ($invoice['status'] !== 'paid' && $invoice['status'] !== 'cancelled'): ?>
                <button type="button" class="btn btn-sm btn-success d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#recordPaymentModal">
                    <span class="material-symbols-outlined" style="font-size: 16px;">add_card</span>
                    Record Payment
                </button>

                <a href="<?= base_url('admin/invoices/mark-paid/' . $invoice['id']) ?>" class="btn btn-sm btn-outline-success d-flex align-items-center gap-1"
                   onclick="return confirm('Mark this invoice 100% paid?')">
                    <span class="material-symbols-outlined" style="font-size: 16px;">check_circle</span>
                    Mark 100% Paid
                </a>
            <?php endif; ?>

            <!-- WhatsApp Share -->
            <?php if (!empty($invoice['customer_phone'])): 
                $cleanPhone = preg_replace('/[^0-9]/', '', $invoice['customer_phone']);
                if (strlen($cleanPhone) === 10) $cleanPhone = '91' . $cleanPhone;
                $waText = urlencode("Dear " . $invoice['customer_name'] . ", here is your official Tax Invoice #" . $invoice['invoice_number'] . " from Glowup Beauty Studio & Academy for ₹" . number_format($invoice['total_amount'], 2) . ". Current balance due: ₹" . number_format($invoice['balance_due'], 2) . ". Thank you for your visit!");
            ?>
                <a href="https://wa.me/<?= $cleanPhone ?>?text=<?= $waText ?>" target="_blank" class="btn btn-sm btn-outline-success d-flex align-items-center gap-1">
                    <i class="fab fa-whatsapp"></i>
                    Send WhatsApp
                </a>
            <?php endif; ?>

            <!-- Print / PDF -->
            <button type="button" class="btn btn-sm btn-primary d-flex align-items-center gap-1" onclick="window.print()" style="background: var(--accent); border-color: var(--accent);">
                <span class="material-symbols-outlined" style="font-size: 16px;">print</span>
                Print / Save PDF
            </button>

            <!-- Cancel Invoice -->
            <?php if ($invoice['status'] !== 'cancelled'): ?>
                <a href="<?= base_url('admin/invoices/cancel/' . $invoice['id']) ?>" class="btn btn-sm btn-outline-secondary" onclick="return confirm('Cancel this invoice?')">
                    Cancel Invoice
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Luxury Printable Tax Invoice Sheet -->
<div class="card border-0 shadow-sm mx-auto mb-5" style="max-width: 860px; border-radius: 16px; background: #ffffff; padding: 48px; position: relative; overflow: hidden;">
    <!-- Top Decorative Accent -->
    <div style="position: absolute; top: 0; left: 0; right: 0; height: 6px; background: linear-gradient(90deg, #592E83 0%, #A36952 100%);"></div>

    <!-- Header Section -->
    <div class="row align-items-start mb-4 pb-4 border-bottom">
        <div class="col-sm-7">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span style="font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700; color: #592E83; letter-spacing: -0.02em;">GLOWUP</span>
                <span class="badge" style="background: #A36952; color: #fff; font-size: 10px; letter-spacing: 0.1em; text-transform: uppercase;">Studio & Academy</span>
            </div>
            <p class="text-muted mb-0" style="font-size: 12.5px; line-height: 1.6;">
                <strong>Glowup Luxury Beauty Studio Private Limited</strong><br>
                Road No. 36, Jubilee Hills, Hyderabad, Telangana 500033<br>
                <strong>GSTIN:</strong> 36AAACG1234F1Z8 | <strong>CIN:</strong> U74999TG2024PTC123456<br>
                <strong>Tel:</strong> +91 91234 56789 | <strong>Email:</strong> concierge@glowup.in
            </p>
        </div>
        <div class="col-sm-5 text-sm-end mt-3 mt-sm-0">
            <h2 class="fw-bold mb-1" style="font-family: 'Playfair Display', serif; color: var(--text-main); font-size: 24px;">TAX INVOICE</h2>
            <div class="fw-bold fs-6" style="color: #592E83;"><?= esc($invoice['invoice_number']) ?></div>
            <div class="text-muted mt-2" style="font-size: 12px;">
                <div><strong>Invoice Date:</strong> <?= date('d F Y', strtotime($invoice['invoice_date'])) ?></div>
                <div><strong>Due Date:</strong> <?= date('d F Y', strtotime($invoice['due_date'])) ?></div>
                <?php if (!empty($invoice['booking_id'])): ?>
                    <div><strong>Booking Ref:</strong> #BK-<?= esc($invoice['booking_id']) ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bill To / Customer Details Section -->
    <div class="row mb-4 pb-2">
        <div class="col-sm-6">
            <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Billed To:</span>
            <h5 class="fw-bold mt-1 mb-1" style="color: var(--text-main);">
                <?php if (!empty($invoice['customer_id'])): ?>
                    <a href="<?= base_url('admin/customers/' . $invoice['customer_id']) ?>" class="text-decoration-none text-dark d-print-none">
                        <?= esc($invoice['customer_name']) ?>
                    </a>
                    <span class="d-none d-print-inline"><?= esc($invoice['customer_name']) ?></span>
                <?php else: ?>
                    <?= esc($invoice['customer_name']) ?>
                <?php endif; ?>
            </h5>
            <div class="text-muted" style="font-size: 12.5px; line-height: 1.5;">
                <?php if (!empty($invoice['customer_phone'])): ?>
                    <div><strong>Phone:</strong> <?= esc($invoice['customer_phone']) ?></div>
                <?php endif; ?>
                <?php if (!empty($invoice['customer_email'])): ?>
                    <div><strong>Email:</strong> <?= esc($invoice['customer_email']) ?></div>
                <?php endif; ?>
                <?php if (!empty($invoice['customer_address'])): ?>
                    <div><strong>Address:</strong> <?= esc($invoice['customer_address']) ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
            <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Payment Status:</span>
            <div class="mt-1">
                <?php if ($invoice['status'] === 'paid'): ?>
                    <span class="badge bg-success fs-6 px-3 py-2" style="border-radius: 8px;">PAID IN FULL</span>
                <?php elseif ($invoice['status'] === 'partially_paid'): ?>
                    <span class="badge bg-warning text-dark fs-6 px-3 py-2" style="border-radius: 8px;">PARTIALLY PAID</span>
                <?php else: ?>
                    <span class="badge bg-danger fs-6 px-3 py-2" style="border-radius: 8px;">PAYMENT DUE</span>
                <?php endif; ?>
            </div>
            <div class="text-muted mt-2" style="font-size: 12px;">
                <strong>Payment Terms:</strong> Immediate / Due on Receipt<br>
                <strong>Method:</strong> <?= esc($invoice['payment_method'] ?: 'UPI / Card') ?>
            </div>
        </div>
    </div>

    <!-- Line Items Table -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered align-middle">
            <thead style="background: rgba(89, 46, 131, 0.04); font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;">
                <tr>
                    <th class="py-2" style="width: 50px;">#</th>
                    <th class="py-2">Service / Item Description</th>
                    <th class="text-center py-2" style="width: 80px;">Qty</th>
                    <th class="text-end py-2" style="width: 130px;">Unit Price (₹)</th>
                    <th class="text-end py-2" style="width: 140px;">Amount (₹)</th>
                </tr>
            </thead>
            <tbody style="font-size: 13px;">
                <?php if (!empty($invoice['items'])): ?>
                    <?php foreach ($invoice['items'] as $idx => $item): ?>
                        <tr>
                            <td class="text-center text-muted"><?= $idx + 1 ?></td>
                            <td>
                                <div class="fw-bold" style="color: var(--text-main);"><?= esc($item['item_name']) ?></div>
                                <?php if (!empty($item['description'])): ?>
                                    <small class="text-muted"><?= esc($item['description']) ?></small>
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?= esc($item['quantity']) ?></td>
                            <td class="text-end">₹<?= number_format((float) $item['unit_price'], 2) ?></td>
                            <td class="text-end fw-bold">₹<?= number_format((float) $item['total_price'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td class="text-center text-muted">1</td>
                        <td>
                            <div class="fw-bold">Bespoke Beauty Care & Styling Service</div>
                            <small class="text-muted">Standard salon treatment & styling session</small>
                        </td>
                        <td class="text-center">1</td>
                        <td class="text-end">₹<?= number_format((float) $invoice['subtotal'], 2) ?></td>
                        <td class="text-end fw-bold">₹<?= number_format((float) $invoice['subtotal'], 2) ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Calculations Section -->
    <div class="row justify-content-end mb-4">
        <div class="col-sm-6">
            <div class="p-3 bg-light rounded-3" style="font-size: 13px;">
                <div class="d-flex justify-content-between py-1">
                    <span class="text-muted">Subtotal:</span>
                    <strong>₹<?= number_format((float) ($invoice['subtotal'] ?? 0), 2) ?></strong>
                </div>
                <?php if ((float) ($invoice['discount_amount'] ?? 0) > 0): ?>
                    <div class="d-flex justify-content-between py-1 text-danger">
                        <span>Discount:</span>
                        <span>- ₹<?= number_format((float) $invoice['discount_amount'], 2) ?></span>
                    </div>
                <?php endif; ?>
                <div class="d-flex justify-content-between py-1">
                    <span class="text-muted">GST / Tax (<?= esc($invoice['tax_rate']) ?>%):</span>
                    <strong>₹<?= number_format((float) ($invoice['tax_amount'] ?? 0), 2) ?></strong>
                </div>
                <hr class="my-2">
                <div class="d-flex justify-content-between py-1" style="font-size: 16px;">
                    <strong style="color: #592E83;">Total Amount:</strong>
                    <strong style="color: #592E83;">₹<?= number_format((float) ($invoice['total_amount'] ?? 0), 2) ?></strong>
                </div>
                <div class="d-flex justify-content-between py-1 text-success">
                    <span>Amount Paid:</span>
                    <strong class="text-success">₹<?= number_format((float) ($invoice['amount_paid'] ?? 0), 2) ?></strong>
                </div>
                <div class="d-flex justify-content-between py-1 border-top mt-1" style="font-size: 15px;">
                    <span class="fw-bold <?= ((float) $invoice['balance_due'] > 0) ? 'text-danger' : 'text-muted' ?>">Balance Due:</span>
                    <strong class="<?= ((float) $invoice['balance_due'] > 0) ? 'text-danger' : 'text-muted' ?>">₹<?= number_format((float) ($invoice['balance_due'] ?? 0), 2) ?></strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Records Log -->
    <?php if (!empty($invoice['payments'])): ?>
        <div class="mb-4">
            <h6 class="fw-bold mb-2" style="font-size: 13px; color: var(--accent);">Recorded Payments & Settlements</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered align-middle" style="font-size: 12px;">
                    <thead class="table-light">
                        <tr>
                            <th>Receipt #</th>
                            <th>Date</th>
                            <th>Payment Method</th>
                            <th>Transaction Ref</th>
                            <th class="text-end">Amount Paid</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($invoice['payments'] as $p): ?>
                            <tr>
                                <td class="fw-bold"><?= esc($p['payment_number']) ?></td>
                                <td><?= date('d M Y', strtotime($p['payment_date'])) ?></td>
                                <td><?= esc($p['payment_method']) ?></td>
                                <td><code><?= esc($p['transaction_ref']) ?></code></td>
                                <td class="text-end fw-bold text-success">₹<?= number_format((float) $p['amount'], 2) ?></td>
                                <td><span class="badge bg-success">Received</span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <!-- Bank Details & Terms Footer -->
    <div class="row pt-3 border-top mt-4" style="font-size: 11.5px; color: #777;">
        <div class="col-sm-7">
            <h6 class="fw-bold text-dark mb-1" style="font-size: 12px;">Bank & UPI Settlement Details</h6>
            <p class="mb-2">
                <strong>Bank Name:</strong> HDFC Bank Ltd, Jubilee Hills Branch<br>
                <strong>Account Name:</strong> Glowup Beauty Studio Pvt Ltd<br>
                <strong>Account No:</strong> 50200088991234 | <strong>IFSC:</strong> HDFC0001234<br>
                <strong>UPI VPA:</strong> <code>glowup@hdfcbank</code>
            </p>
            <p class="mb-0 text-muted fst-italic">
                <?= esc($invoice['terms'] ?: 'Invoices are payable upon receipt. Services rendered are non-refundable. Thank you for your business!') ?>
            </p>
        </div>
        <div class="col-sm-5 text-sm-end mt-3 mt-sm-0 d-flex flex-column justify-content-between">
            <div>
                <span class="fw-bold text-dark">Authorized Signatory</span>
                <div class="mt-4" style="font-family: 'Playfair Display', serif; font-style: italic; font-size: 18px; color: #592E83;">
                    Elena Vance
                </div>
                <div style="border-top: 1px dashed #ccc; width: 140px; margin-left: auto; margin-top: 4px;"></div>
                <small class="text-muted">Finance & Studio Director</small>
            </div>
        </div>
    </div>
</div>

<!-- Record Payment Modal -->
<div class="modal fade" id="recordPaymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header text-white" style="background: #2e7d32; padding: 18px 24px;">
                <h6 class="modal-title fw-bold">Record Payment for <?= esc($invoice['invoice_number']) ?></h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/invoices/record-payment/' . $invoice['id']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="alert alert-info py-2" style="font-size: 12.5px;">
                        Total Invoice: <strong>₹<?= number_format((float) $invoice['total_amount'], 2) ?></strong> | 
                        Current Balance Due: <strong class="text-danger">₹<?= number_format((float) $invoice['balance_due'], 2) ?></strong>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12px;">Payment Amount Received (₹) *</label>
                        <input type="number" step="0.01" name="amount" class="form-control" required value="<?= (float) $invoice['balance_due'] ?>" max="<?= (float) $invoice['balance_due'] ?>">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Payment Method *</label>
                            <select name="payment_method" class="form-select" required>
                                <option value="UPI">UPI (GPay / PhonePe / Paytm)</option>
                                <option value="Credit / Debit Card">Credit / Debit Card</option>
                                <option value="Cash">Cash</option>
                                <option value="Net Banking">Net Banking / NEFT</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Payment Date *</label>
                            <input type="date" name="payment_date" class="form-control" required value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12px;">Transaction Reference / UTR Number</label>
                        <input type="text" name="transaction_ref" class="form-control" placeholder="e.g. UPI-20260930-88992">
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold" style="font-size: 12px;">Payment Notes</label>
                        <input type="text" name="notes" class="form-control" placeholder="e.g. Full settlement via Google Pay">
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success">Credit Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    .card, .card * {
        visibility: visible;
    }
    .card {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        max-width: 100% !important;
        box-shadow: none !important;
        padding: 20px !important;
    }
    .d-print-none {
        display: none !important;
    }
}
</style>

<?= $this->endSection() ?>
