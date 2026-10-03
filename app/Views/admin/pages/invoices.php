<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- KPI Summary Strip -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Invoices</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--text-main); font-family: 'Playfair Display', serif;"><?= esc($stats['total_invoices'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Billed transactions</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">receipt_long</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Collected Revenue</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #2e7d32; font-family: 'Playfair Display', serif;">₹<?= number_format($stats['total_revenue'] ?? 0, 2) ?></h3>
                <small class="text-muted" style="font-size: 11px;"><?= esc($stats['paid_count'] ?? 0) ?> Paid Invoices</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(46, 125, 50, 0.08); display: flex; align-items: center; justify-content: center; color: #2e7d32;">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Pending Receivables</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #A36952; font-family: 'Playfair Display', serif;">₹<?= number_format($stats['pending_payments'] ?? 0, 2) ?></h3>
                <small class="text-muted" style="font-size: 11px;"><?= esc($stats['unpaid_count'] ?? 0) ?> Awaiting settlement</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(163, 105, 82, 0.1); display: flex; align-items: center; justify-content: center; color: #A36952; border: 1px solid rgba(163, 105, 82, 0.15);">
                <span class="material-symbols-outlined">pending_actions</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Overdue Invoices</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #d32f2f; font-family: 'Playfair Display', serif;"><?= esc($stats['overdue_count'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Past payment deadline</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(211, 47, 47, 0.08); display: flex; align-items: center; justify-content: center; color: #d32f2f;">
                <span class="material-symbols-outlined">warning</span>
            </div>
        </div>
    </div>
</div>

<!-- Controls Strip -->
<div class="glass-panel p-3 mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <!-- Filter Pills -->
        <div class="d-flex flex-wrap gap-2">
            <a href="<?= base_url('admin/invoices') ?>" 
               class="btn btn-sm <?= ($statusFilter === 'all') ? 'btn-primary' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">All (<?= esc($stats['total_invoices'] ?? 0) ?>)</a>
            <a href="<?= base_url('admin/invoices?status=paid') ?>" 
               class="btn btn-sm <?= ($statusFilter === 'paid') ? 'btn-success' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">Paid (<?= esc($stats['paid_count'] ?? 0) ?>)</a>
            <a href="<?= base_url('admin/invoices?status=sent') ?>" 
               class="btn btn-sm <?= ($statusFilter === 'sent') ? 'btn-warning text-dark' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">Sent / Unpaid</a>
            <a href="<?= base_url('admin/invoices?status=partially_paid') ?>" 
               class="btn btn-sm <?= ($statusFilter === 'partially_paid') ? 'btn-info text-white' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">Partially Paid</a>
            <a href="<?= base_url('admin/invoices?status=overdue') ?>" 
               class="btn btn-sm <?= ($statusFilter === 'overdue') ? 'btn-danger' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">Overdue (<?= esc($stats['overdue_count'] ?? 0) ?>)</a>
            <a href="<?= base_url('admin/invoices?status=draft') ?>" 
               class="btn btn-sm <?= ($statusFilter === 'draft') ? 'btn-secondary text-white' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">Drafts</a>
        </div>

        <!-- Search & New Invoice -->
        <div class="d-flex align-items-center gap-2">
            <form action="<?= base_url('admin/invoices') ?>" method="get" class="d-flex align-items-center">
                <div class="position-relative">
                    <input type="text" name="search" class="form-control form-control-sm ps-4" 
                           placeholder="Search invoice #, customer..." value="<?= esc($search ?? '') ?>" style="width: 220px; border-radius: 8px;">
                    <span class="material-symbols-outlined position-absolute" 
                          style="left: 8px; top: 50%; transform: translateY(-50%); font-size: 16px; color: #888;">search</span>
                </div>
            </form>
            <button type="button" class="btn btn-sm btn-primary d-flex align-items-center gap-1" 
                    data-bs-toggle="modal" data-bs-target="#newInvoiceModal" onclick="prepareAddInvoice()"
                    style="background: var(--accent); border-color: var(--accent); border-radius: 8px;">
                <span class="material-symbols-outlined" style="font-size: 16px;">receipt</span>
                Create Manual Invoice
            </button>
        </div>
    </div>
</div>

<!-- Invoices Table -->
<div class="glass-panel p-0 overflow-hidden mb-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead style="background: rgba(89, 46, 131, 0.04); font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                <tr>
                    <th class="ps-4 py-3">Invoice Number</th>
                    <th class="py-3">Issue Date</th>
                    <th class="py-3">Client Information</th>
                    <th class="py-3">Due Date</th>
                    <th class="py-3">Total Amount</th>
                    <th class="py-3">Paid</th>
                    <th class="py-3">Balance Due</th>
                    <th class="py-3">Status</th>
                    <th class="text-end pe-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody style="font-size: 13px;">
                <?php if (!empty($invoices)): ?>
                    <?php 
                    $todayDate = date('Y-m-d');
                    foreach ($invoices as $inv): 
                        $isOverdue = (!empty($inv['due_date']) && $inv['due_date'] < $todayDate && $inv['status'] !== 'paid' && $inv['status'] !== 'cancelled');
                    ?>
                        <tr class="<?= $isOverdue ? 'table-danger bg-opacity-10' : '' ?>">
                            <td class="ps-4 fw-bold">
                                <a href="<?= base_url('admin/invoices/view/' . $inv['id']) ?>" class="text-decoration-none" style="color: var(--accent);">
                                    <?= esc($inv['invoice_number']) ?>
                                </a>
                                <?php if (!empty($inv['booking_id'])): ?>
                                    <div style="font-size: 10px; color: #888;">From Booking #<?= $inv['booking_id'] ?></div>
                                <?php endif; ?>
                            </td>
                            <td><?= date('d M Y', strtotime($inv['invoice_date'])) ?></td>
                            <td>
                                <?php if (!empty($inv['customer_id'])): ?>
                                    <a href="<?= base_url('admin/customers/' . $inv['customer_id']) ?>" class="fw-bold text-decoration-none" style="color: var(--text-main);">
                                        <?= esc($inv['customer_name']) ?>
                                    </a>
                                <?php else: ?>
                                    <span class="fw-bold" style="color: var(--text-main);"><?= esc($inv['customer_name']) ?></span>
                                <?php endif; ?>
                                <div class="text-muted" style="font-size: 11px;"><?= esc($inv['customer_phone'] ?: $inv['customer_email']) ?></div>
                            </td>
                            <td>
                                <div><?= date('d M Y', strtotime($inv['due_date'])) ?></div>
                                <?php if ($isOverdue): ?>
                                    <span class="badge bg-danger" style="font-size: 9px;">OVERDUE</span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold" style="color: var(--text-main);">
                                ₹<?= number_format((float) ($inv['total_amount'] ?? 0), 2) ?>
                            </td>
                            <td class="fw-semibold text-success">
                                ₹<?= number_format((float) ($inv['amount_paid'] ?? 0), 2) ?>
                            </td>
                            <td class="fw-bold <?= ((float) $inv['balance_due'] > 0) ? 'text-danger' : 'text-muted' ?>">
                                ₹<?= number_format((float) ($inv['balance_due'] ?? 0), 2) ?>
                            </td>
                            <td>
                                <?php 
                                    $st = $inv['status'];
                                    $badgeStyle = 'background: rgba(108, 117, 125, 0.12); color: #6c757d;';
                                    if ($st === 'paid') $badgeStyle = 'background: rgba(22, 163, 74, 0.12); color: #16a34a; border: 1px solid rgba(22, 163, 74, 0.2);';
                                    elseif ($st === 'sent') $badgeStyle = 'background: var(--color-primary-subtle); color: var(--color-primary); border: 1px solid var(--color-primary-border);';
                                    elseif ($st === 'partially_paid') $badgeStyle = 'background: var(--color-secondary-subtle); color: var(--color-secondary); border: 1px solid var(--color-secondary-border);';
                                    elseif ($st === 'overdue' || $isOverdue) $badgeStyle = 'background: #fee2e2; color: #dc2626; border: 1px solid #fecaca;';
                                    elseif ($st === 'cancelled') $badgeStyle = 'background: var(--color-dark-subtle, #f2edf1); color: var(--color-dark, #483C46); border: 1px solid #ded8dc;';
                                ?>
                                <span class="badge" style="<?= $badgeStyle ?> font-weight: 600; text-transform: capitalize; border-radius: 12px; padding: 4px 10px;">
                                    <?= ($isOverdue && $st !== 'paid') ? 'Overdue' : str_replace('_', ' ', $st) ?>
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <!-- View/Print Invoice -->
                                    <a href="<?= base_url('admin/invoices/view/' . $inv['id']) ?>" 
                                       class="btn btn-sm btn-outline-primary p-1 d-inline-flex align-items-center justify-content-center" 
                                       title="View & Print Invoice" style="width: 28px; height: 28px; border-radius: 6px;">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">visibility</span>
                                    </a>

                                    <!-- Quick Mark Paid -->
                                    <?php if ($inv['status'] !== 'paid' && $inv['status'] !== 'cancelled'): ?>
                                        <a href="<?= base_url('admin/invoices/mark-paid/' . $inv['id']) ?>" 
                                           class="btn btn-sm btn-outline-success p-1 d-inline-flex align-items-center justify-content-center" 
                                           title="Mark Fully Paid" style="width: 28px; height: 28px; border-radius: 6px;"
                                           onclick="return confirm('Confirm receipt of full payment for <?= $inv['invoice_number'] ?>?')">
                                            <span class="material-symbols-outlined" style="font-size: 16px;">paid</span>
                                        </a>
                                    <?php endif; ?>

                                    <!-- WhatsApp Send Link -->
                                    <?php if (!empty($inv['customer_phone'])): 
                                        $cleanPhone = preg_replace('/[^0-9]/', '', $inv['customer_phone']);
                                        if (strlen($cleanPhone) === 10) $cleanPhone = '91' . $cleanPhone;
                                        $waMsg = urlencode("Dear " . $inv['customer_name'] . ", your invoice " . $inv['invoice_number'] . " from Glowup Beauty Studio for ₹" . number_format($inv['total_amount'], 2) . " has been issued. Balance due: ₹" . number_format($inv['balance_due'], 2) . ". Thank you!");
                                    ?>
                                        <a href="https://wa.me/<?= $cleanPhone ?>?text=<?= $waMsg ?>" target="_blank" 
                                           class="btn btn-sm btn-outline-success p-1 d-inline-flex align-items-center justify-content-center" 
                                           title="Send on WhatsApp" style="width: 28px; height: 28px; border-radius: 6px;">
                                            <?= glowup_whatsapp_icon('', 14) ?>
                                        </a>
                                    <?php endif; ?>

                                    <!-- Delete Invoice -->
                                    <a href="<?= base_url('admin/invoices/delete/' . $inv['id']) ?>" 
                                       class="btn btn-sm btn-outline-danger p-1 d-inline-flex align-items-center justify-content-center" 
                                       title="Delete" style="width: 28px; height: 28px; border-radius: 6px;"
                                       onclick="return confirm('Permanently delete this invoice?')">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <div class="py-4">
                                <span class="material-symbols-outlined text-muted mb-2" style="font-size: 48px; opacity: 0.4;">receipt_long</span>
                                <h6 class="text-muted fw-bold">No Invoices Found</h6>
                                <p class="text-muted mb-3" style="font-size: 12px;">There are no invoices matching this view filter.</p>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#newInvoiceModal" onclick="prepareAddInvoice()">
                                    Create First Manual Invoice
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Manual Invoice Modal -->
<div class="modal fade" id="newInvoiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header text-white" style="background: var(--accent); padding: 18px 24px;">
                <h6 class="modal-title fw-bold">Create Professional Tax Invoice</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/invoices/save') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="0">
                <div class="modal-body p-4">
                    <!-- Client Selector -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Select Customer</label>
                            <select name="customer_id" id="inv_customer_id" class="form-select" onchange="syncInvCustomer(this)">
                                <option value="0">-- Or Enter Custom Client Below --</option>
                                <?php if (!empty($customers)): ?>
                                    <?php foreach ($customers as $c): ?>
                                        <option value="<?= $c['id'] ?>" data-name="<?= esc($c['name']) ?>" data-phone="<?= esc($c['phone']) ?>" data-email="<?= esc($c['email']) ?>" data-address="<?= esc($c['address'] ?? '') ?>">
                                            <?= esc($c['name']) ?> (<?= esc($c['phone']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Client Full Name *</label>
                            <input type="text" name="customer_name" id="inv_customer_name" class="form-control" required placeholder="e.g. Meera Rajput">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">Phone Number</label>
                            <input type="text" name="customer_phone" id="inv_customer_phone" class="form-control" placeholder="+91 98765 43210">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">Email Address</label>
                            <input type="email" name="customer_email" id="inv_customer_email" class="form-control" placeholder="client@example.com">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">Billing Address</label>
                            <input type="text" name="customer_address" id="inv_customer_address" class="form-control" placeholder="Jubilee Hills, Hyderabad">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Invoice Date *</label>
                            <input type="date" name="invoice_date" class="form-control" required value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Payment Due Date *</label>
                            <input type="date" name="due_date" class="form-control" required value="<?= date('Y-m-d', strtotime('+3 days')) ?>">
                        </div>
                    </div>

                    <hr class="my-3 text-muted">
                    <h6 class="fw-bold mb-3" style="font-size: 13px; color: var(--accent);">Service / Product Line Item</h6>

                    <div class="row g-3 mb-3">
                        <div class="col-md-7">
                            <label class="form-label fw-bold" style="font-size: 12px;">Treatment / Course / Package *</label>
                            <input type="text" name="service_name" id="inv_service_name" class="form-control" required placeholder="e.g. Bridal Deluxe Glow Package">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-bold" style="font-size: 12px;">Service Amount / Subtotal (₹) *</label>
                            <input type="number" step="0.01" name="subtotal" id="inv_subtotal" class="form-control" required placeholder="5000">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">Discount (₹)</label>
                            <input type="number" step="0.01" name="discount_amount" class="form-control" value="0.00">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">GST Rate (%)</label>
                            <select name="tax_rate" class="form-select">
                                <option value="18.00" selected>18% (Standard GST)</option>
                                <option value="12.00">12% GST</option>
                                <option value="5.00">5% GST</option>
                                <option value="0.00">0% (Tax Exempt)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">Payment Method</label>
                            <select name="payment_method" class="form-select">
                                <option value="UPI" selected>UPI (GPay / PhonePe / Paytm)</option>
                                <option value="Credit / Debit Card">Credit / Debit Card</option>
                                <option value="Cash">Cash</option>
                                <option value="Net Banking">Net Banking / NEFT</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold" style="font-size: 12px;">Notes / Special Instructions</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="e.g. Advance 50% deposit received. Balance due on appointment completion."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary" style="background: var(--accent); border-color: var(--accent);">Generate Tax Invoice</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function prepareAddInvoice() {
    document.getElementById('inv_customer_id').value = '0';
    document.getElementById('inv_customer_name').value = '';
    document.getElementById('inv_customer_phone').value = '';
    document.getElementById('inv_customer_email').value = '';
    document.getElementById('inv_customer_address').value = 'Jubilee Hills, Hyderabad';
    document.getElementById('inv_service_name').value = '';
    document.getElementById('inv_subtotal').value = '';
}

function syncInvCustomer(elem) {
    var opt = elem.options[elem.selectedIndex];
    if (opt && opt.value !== '0') {
        document.getElementById('inv_customer_name').value = opt.getAttribute('data-name') || '';
        document.getElementById('inv_customer_phone').value = opt.getAttribute('data-phone') || '';
        document.getElementById('inv_customer_email').value = opt.getAttribute('data-email') || '';
        document.getElementById('inv_customer_address').value = opt.getAttribute('data-address') || 'Jubilee Hills, Hyderabad';
    }
}
</script>

<?= $this->endSection() ?>
