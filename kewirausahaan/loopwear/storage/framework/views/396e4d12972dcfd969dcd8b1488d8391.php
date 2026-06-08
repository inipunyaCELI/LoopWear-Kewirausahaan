<?php $__env->startSection('konten'); ?>
<style>
    .add-container { font-family: 'Quicksand', sans-serif; }
    .add-title { font-family: 'Fredoka One', cursive; color: #47510B; letter-spacing: 1px; }
    
    .custom-card-add { 
        border-radius: 30px; 
        border: none; 
        overflow: hidden; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
    }
    .card-header-loop { 
        background-color: #FFF24D !important;
        border-bottom: none; 
        padding: 20px; 
    }

    .form-label-loop { font-weight: 700; color: #47510B; font-size: 0.9rem; margin-bottom: 8px; }
    .form-control-loop { 
        border-radius: 15px; 
        border: 2px solid #f0f0f0; 
        padding: 12px 15px; 
        transition: 0.3s; 
    }
    .form-control-loop:focus { 
        border-color: #FFF24D; 
        box-shadow: none; 
        background-color: #fffdf0; 
    }

    .btn-save-loop { 
        background-color: #47510B !important;
        color: #FFF24D !important;
        border-radius: 15px; 
        font-weight: 800; 
        padding: 12px 30px;
        border: none; 
        transition: 0.3s; 
    }
    .btn-save-loop:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(71, 81, 11, 0.2); }

    .btn-cancel-loop { 
        background-color: #8CABFF !important;
        color: white !important; 
        border-radius: 15px; 
        font-weight: 800; 
        padding: 12px 30px;
        border: none; 
        transition: 0.3s; 
        text-decoration: none;
    }
    .btn-cancel-loop:hover { opacity: 0.9; transform: translateY(-2px); color: white; }
</style>

<div class="container py-5 add-container">
    <div class="card shadow-sm col-md-8 mx-auto custom-card-add">
        <div class="card-header-loop text-center">
            <h4 class="add-title mb-0">TAMBAH KOLEKSI BARU</h4>
        </div>
        
        <div class="card-body p-4 p-md-5">
            <form action="<?php echo e(route('barang.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-12 mb-4">
                        <label class="form-label-loop">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control form-control-loop" placeholder="Contoh: Cute Lilac Cardigan" value="<?php echo e(old('nama_barang')); ?>" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-loop">Kategori</label>
                        <select name="kategori" class="form-select form-control-loop" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="baju" <?php if(old('kategori') == 'baju'): echo 'selected'; endif; ?>>Baju</option>
                            <option value="celana" <?php if(old('kategori') == 'celana'): echo 'selected'; endif; ?>>Celana</option>
                            <option value="hijab" <?php if(old('kategori') == 'hijab'): echo 'selected'; endif; ?>>Hijab</option>
                            <option value="sepatu" <?php if(old('kategori') == 'sepatu'): echo 'selected'; endif; ?>>Sepatu</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label-loop">Warna Utama</label>
                        <select name="warna" class="form-select form-control-loop" required>
                            <option value="">-- Pilih Warna --</option>
                            <option value="black" <?php if(old('warna') == 'black'): echo 'selected'; endif; ?>>Black</option>
                            <option value="green" <?php if(old('warna') == 'green'): echo 'selected'; endif; ?>>Green</option>
                            <option value="blue" <?php if(old('warna') == 'blue'): echo 'selected'; endif; ?>>Blue</option>
                            <option value="brown" <?php if(old('warna') == 'brown'): echo 'selected'; endif; ?>>Brown</option>
                            <option value="gray" <?php if(old('warna') == 'gray'): echo 'selected'; endif; ?>>Gray</option>
                            <option value="orange" <?php if(old('warna') == 'orange'): echo 'selected'; endif; ?>>Orange</option>
                            <option value="pink" <?php if(old('warna') == 'pink'): echo 'selected'; endif; ?>>Pink</option>
                            <option value="purple" <?php if(old('warna') == 'purple'): echo 'selected'; endif; ?>>Purple</option>
                            <option value="red" <?php if(old('warna') == 'red'): echo 'selected'; endif; ?>>Red</option>
                            <option value="silver" <?php if(old('warna') == 'silver'): echo 'selected'; endif; ?>>Silver</option>
                            <option value="White" <?php if(old('warna') == 'White'): echo 'selected'; endif; ?>>White</option>
                            <option value="yellow" <?php if(old('warna') == 'yellow'): echo 'selected'; endif; ?>>Yellow</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-loop">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control form-control-loop" placeholder="0" min="0" value="<?php echo e(old('harga')); ?>" required>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label-loop">Stok Ready</label>
                        <input type="number" name="stok" class="form-control form-control-loop" min="0" value="<?php echo e(old('stok', 1)); ?>" required>
                    </div>

                    <div class="col-12 mb-5">
                        <label class="form-label-loop">Foto Produk</label>
                        <input type="file" name="gambar" class="form-control form-control-loop" accept=".jpg,.jpeg,.png" required>
                        <small class="text-muted d-block mt-2">*Format: JPG, PNG, JPEG (Maks. 2MB)</small>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <a href="<?php echo e(route('barang.index')); ?>" class="btn-cancel-loop">Batal</a>
                    <button type="submit" class="btn-save-loop">Simpan Koleksi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\OneDrive\Documents\GitHub\LoopWear-Kewirausahaan\kewirausahaan\loopwear\resources\views/admin/barang/create.blade.php ENDPATH**/ ?>