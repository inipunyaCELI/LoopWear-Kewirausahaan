<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Resi - <?php echo e($order->order_number); ?></title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .receipt-card {
            background: #fff;
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border: 2px dashed #333;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        .section-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .info-box {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fafafa;
        }
        .info-box p {
            margin: 5px 0;
            font-size: 14px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th, .items-table td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        .items-table th {
            background-color: #eee;
        }
        .total-row {
            font-weight: bold;
            font-size: 16px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
            border-top: 1px dashed #333;
            padding-top: 15px;
        }
        @media print {
            body { background: none; padding: 0; }
            .receipt-card { border: none; box-shadow: none; margin: 0; max-width: 100%; padding: 0; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="receipt-card">
        
        <div class="header">
            <h2>LOOPWEAR OFFICIAL</h2>
            <p>Invoice / Resi Pengiriman</p>
        </div>

        <div style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 14px;">
            <div>
                <strong>Order ID:</strong> <?php echo e($order->order_number); ?>

            </div>
            <div>
                <strong>Tanggal:</strong> <?php echo e($order->created_at->format('d/m/Y H:i')); ?>

            </div>
        </div>

        <div class="info-box">
            <div class="section-title">PENGIRIM:</div>
            <p><strong>LoopWear Official</strong></p>
            <p>Banjarmasin, Indonesia</p>
            <p>HP: 0812-3456-7890</p>
        </div>

        <div class="info-box">
            <div class="section-title">PENERIMA:</div>
            <p><strong><?php echo e($order->user->name ?? 'Guest'); ?></strong></p>
            <p>Alamat: <?php echo e($order->address ?? 'Alamat tidak dicantumkan'); ?></p>
            <p>Kontak: <?php echo e($order->user->email ?? '-'); ?></p>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th style="width: 50px; text-align: center;">Qty</th>
                    <th style="text-align: right;">Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->nama_barang); ?></td>
                    <td style="text-align: center;"><?php echo e($item->qty); ?></td>
                    <td style="text-align: right;">Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr class="total-row">
                    <td colspan="2" style="text-align: right;">TOTAL BELANJA</td>
                    <td style="text-align: right;">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Status Pembayaran: <strong>LUNAS</strong></p>
            <p>Terima kasih telah berbelanja di LoopWear!</p>
            <br>
            <button onclick="window.print()" class="no-print" style="padding: 10px 20px; font-size: 16px; cursor: pointer; background: #333; color: #fff; border: none; border-radius: 5px;">Cetak Sekarang</button>
            <button onclick="window.close()" class="no-print" style="padding: 10px 20px; font-size: 16px; cursor: pointer; background: #ccc; color: #333; border: none; border-radius: 5px; margin-left: 10px;">Tutup</button>
        </div>

    </div>

</body>
</html><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>