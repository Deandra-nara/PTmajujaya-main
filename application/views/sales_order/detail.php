<?php 
$role = $this->session->userdata('role');
?>

<style>
    /* Print Specific Styles */
    @media print {
        /* General document reset */
        body {
            background-color: #fff !important;
            color: #000 !important;
            font-size: 12px !important;
            line-height: 1.4 !important;
            font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
        }
        
        /* Hide UI clutter aggressively */
        .no-print,
        .main-sidebar,
        .main-header,
        .content-header,
        .main-footer,
        .btn,
        .alert:not(.print-visible) {
            display: none !important;
        }
        
        /* Content layout expansions */
        .content-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
            background-color: #fff !important;
            border: none !important;
        }
        
        .container-fluid, .content {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
        }
        
        /* Force two-column layout stack to A4 full page content nicely */
        .col-lg-8, .col-md-7, .col-lg-4, .col-md-5, .col-12 {
            width: 100% !important;
            max-width: 100% !important;
            flex: 0 0 100% !important;
            float: none !important;
            padding: 0 !important;
            margin: 0 0 15px 0 !important;
        }

        /* Clean cards formatting (no shadows, normalized borders) */
        .card {
            box-shadow: none !important;
            border: 1px solid #ccc !important;
            background: transparent !important;
            margin-bottom: 20px !important;
            border-radius: 4px !important;
        }
        
        /* Do not hide card headers containing critical section labels */
        .card-header {
            display: block !important;
            background-color: #f8f9fa !important;
            border-bottom: 1px solid #ccc !important;
            padding: 8px 12px !important;
        }
        
        .card-header .card-title {
            color: #000 !important;
            font-size: 13px !important;
            font-weight: bold !important;
            margin: 0 !important;
        }
        
        .card-header i {
            color: #333 !important;
        }
        
        /* Align headers visual styling */
        .card-body {
            padding: 12px !important;
        }
        
        /* Table rendering adjustments */
        table {
            width: 100% !important;
            border-collapse: collapse !important;
            margin-bottom: 15px !important;
        }
        
        table th, table td {
            border: 1px solid #bbb !important;
            padding: 6px 8px !important;
            font-size: 11px !important;
            color: #000 !important;
        }
        
        table thead {
            background-color: #f1f3f5 !important;
        }
        
        .table-borderless td {
            border: none !important;
            padding: 3px 0 !important;
        }
        
        /* Subtotals and Totals highlight */
        .table-bordered th, .table-bordered td {
            border: 1px solid #bbb !important;
        }
        
        .text-success {
            color: #28a745 !important;
            font-weight: bold !important;
        }
        
        .text-danger {
            color: #dc3545 !important;
            font-weight: bold !important;
        }
        
        /* Badge normalization to standard text borders */
        .badge {
            border: 1px solid #888 !important;
            background: transparent !important;
            color: #000 !important;
            box-shadow: none !important;
            text-shadow: none !important;
            padding: 2px 5px !important;
            font-size: 10px !important;
            border-radius: 2px !important;
        }
        
        /* Spacing rules */
        h6.font-weight-bold {
            font-size: 12px !important;
            margin-top: 15px !important;
            margin-bottom: 8px !important;
            border-bottom: 1px solid #999 !important;
            padding-bottom: 3px !important;
            color: #000 !important;
        }
        
        /* Print Header Visibility */
        .print-header {
            display: block !important;
            width: 100% !important;
            margin-top: 0 !important;
            padding-top: 0 !important;
        }
    }
    
    /* Default web screen visibility for print header */
    .print-header {
        display: none;
    }
</style>


<div class="row">

    <div class="col-md-12">

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">
                    Detail Sales Order
                </h3>
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <tr>
                        <th width="200">No Order</th>
                        <td><?= $order->no_order ?></td>
                    </tr>

                    <tr>
                        <th>Tanggal Order</th>
                        <td><?= $order->tanggal_order ?></td>
                    </tr>

                    <tr>
                        <th>Pelanggan</th>
                        <td><?= $order->nama_pelanggan ?></td>
                    </tr>

                    <tr>
                        <th>Sales</th>
                        <td><?= $order->nama ?></td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge badge-success">
                                <?= $order->status ?>
                            </span>
                        </td>
                    </tr>

                </table>

                <hr>

                <h5>Daftar Produk</h5>

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php foreach($detail as $d): ?>

                    <tr>

                        <td><?= $d->kode_produk ?></td>

                        <td><?= $d->nama_produk ?></td>

                        <td><?= $d->qty ?></td>

                        <td>
                            Rp <?= number_format($d->harga,0,',','.') ?>
                        </td>

                        <td>
                            Rp <?= number_format($d->subtotal,0,',','.') ?>
                        </td>

                    </tr>

                    <?php endforeach; ?>

                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">
                                Total
                            </th>

                            <th>
                                Rp <?= number_format($order->total_harga,0,',','.') ?>
                            </th>
                        </tr>
                    </tfoot>

                </table>

            </div>

            <div class="card-footer">

                <a href="<?= site_url('sales_order') ?>"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </div>

        </div>

    </div>

</div>
