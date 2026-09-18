{{-- Modal Cropper Gambar Minimalis --}}
<style>
    #image-cropper-modal .cropper-container {
        direction: ltr;
        touch-action: none;
    }
    #image-cropper-modal .cropper-modal {
        opacity: 0.75;
        background-color: #0f172a;
    }
    #image-cropper-modal .cropper-view-box {
        outline: 2px solid #2563eb;
        border-radius: 6px;
    }
    #image-cropper-modal .cropper-line,
    #image-cropper-modal .cropper-point {
        display: none !important;
    }
</style>

<div id="image-cropper-modal" class="fixed inset-0 z-[99999] hidden items-center justify-center p-4 transition-all duration-300">
    <!-- Backdrop Overlay -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity duration-300" id="cropper-backdrop"></div>
    
    <!-- Minimalist Modal Card -->
    <div class="relative bg-white rounded-2xl max-w-lg w-full p-5 sm:p-6 shadow-xl border border-slate-100 transform transition-all scale-95 opacity-0 duration-200 z-10 flex flex-col max-h-[90vh]" id="cropper-card">
        
        <!-- Header Minimalis -->
        <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
            <h3 class="font-display font-bold text-slate-800 text-sm sm:text-base" id="cropper-modal-title">
                Sesuaikan Foto
            </h3>
            <button type="button" id="cropper-close-btn" aria-label="Tutup jendela pemotong foto" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 flex items-center justify-center transition">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- Cropper Viewport Area -->
        <div class="relative bg-slate-950 rounded-xl overflow-hidden flex-1 min-h-[260px] max-h-[46vh] flex items-center justify-center select-none">
            <img id="cropper-image-target" class="max-w-full max-h-full block" alt="Gambar untuk di-crop">
        </div>

        <!-- Footer Minimalis -->
        <div class="flex items-center justify-between pt-4 mt-2">
            <!-- Zoom Sederhana -->
            <div class="flex items-center gap-1 bg-slate-100 p-1 rounded-lg">
                <button type="button" id="cropper-zoom-out" title="Perkecil" aria-label="Perkecil foto" class="w-7 h-7 rounded-md bg-white text-slate-600 hover:text-slate-900 flex items-center justify-center shadow-xs transition">
                    <i data-lucide="minus" class="w-3.5 h-3.5"></i>
                </button>
                <button type="button" id="cropper-zoom-in" title="Perbesar" aria-label="Perbesar foto" class="w-7 h-7 rounded-md bg-white text-slate-600 hover:text-slate-900 flex items-center justify-center shadow-xs transition">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                </button>
                <button type="button" id="cropper-reset" title="Pusatkan" aria-label="Posisikan foto kembali ke tengah" class="w-7 h-7 rounded-md bg-white text-slate-600 hover:text-slate-900 flex items-center justify-center shadow-xs transition">
                    <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                </button>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center gap-2">
                <button type="button" id="cropper-cancel-btn" class="px-4 py-2 text-xs font-bold text-slate-500 hover:text-slate-700 rounded-lg hover:bg-slate-100 transition">
                    Batal
                </button>
                <button type="button" id="cropper-apply-btn" class="px-5 py-2 bg-primary hover:bg-blue-800 text-white font-bold rounded-lg text-xs transition shadow-sm flex items-center gap-1.5">
                    <i data-lucide="check" class="w-3.5 h-3.5"></i>
                    Gunakan Foto
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let activeCropperInstance = null;
    let cropperCurrentOptions = {};

    window.openImageCropper = function(options = {}) {
        const {
            file,
            aspectRatio = 16 / 9,
            outputWidth = 1280,
            outputHeight = 720,
            title = 'Sesuaikan Foto',
            onCropped = null,
            onCancel = null
        } = options;

        if (!file) return;

        cropperCurrentOptions = {
            file,
            aspectRatio,
            outputWidth,
            outputHeight,
            onCropped,
            onCancel
        };

        const modal = document.getElementById('image-cropper-modal');
        const card = document.getElementById('cropper-card');
        const titleEl = document.getElementById('cropper-modal-title');
        const imageTarget = document.getElementById('cropper-image-target');

        if (!modal || !card || !imageTarget) return;

        if (titleEl) titleEl.textContent = title;

        const reader = new FileReader();
        reader.onload = function(e) {
            imageTarget.src = e.target.result;

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            if (window.lucide) {
                lucide.createIcons();
            }

            requestAnimationFrame(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');

                if (activeCropperInstance) {
                    activeCropperInstance.destroy();
                }

                if (typeof Cropper !== 'undefined') {
                    activeCropperInstance = new Cropper(imageTarget, {
                        aspectRatio: aspectRatio,
                        viewMode: 0,
                        dragMode: 'move',
                        initialAspectRatio: aspectRatio,
                        autoCropArea: 0.9,
                        restore: false,
                        guides: true,
                        center: true,
                        highlight: false,
                        cropBoxMovable: true,
                        cropBoxResizable: false,
                        toggleDragModeOnDblclick: false,
                        responsive: true,
                        zoomOnTouch: true,
                        zoomOnWheel: true,
                        wheelZoomRatio: 0.1
                    });
                }
            });
        };
        reader.readAsDataURL(file);
    };

    window.closeImageCropper = function() {
        const modal = document.getElementById('image-cropper-modal');
        const card = document.getElementById('cropper-card');
        if (!modal || !card) return;

        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');

            if (activeCropperInstance) {
                activeCropperInstance.destroy();
                activeCropperInstance = null;
            }
        }, 150);
    };

    document.addEventListener('DOMContentLoaded', function() {
        const closeBtn = document.getElementById('cropper-close-btn');
        const cancelBtn = document.getElementById('cropper-cancel-btn');
        const applyBtn = document.getElementById('cropper-apply-btn');

        document.getElementById('cropper-zoom-in')?.addEventListener('click', () => activeCropperInstance?.zoom(0.15));
        document.getElementById('cropper-zoom-out')?.addEventListener('click', () => activeCropperInstance?.zoom(-0.15));
        document.getElementById('cropper-reset')?.addEventListener('click', () => activeCropperInstance?.reset());

        const handleCancel = function() {
            closeImageCropper();
            if (typeof cropperCurrentOptions.onCancel === 'function') {
                cropperCurrentOptions.onCancel();
            }
        };

        if (closeBtn) closeBtn.addEventListener('click', handleCancel);
        if (cancelBtn) cancelBtn.addEventListener('click', handleCancel);

        if (applyBtn) {
            applyBtn.addEventListener('click', function() {
                if (!activeCropperInstance) return;

                const targetWidth = cropperCurrentOptions.outputWidth || 1280;
                const targetHeight = cropperCurrentOptions.outputHeight || 720;

                const canvas = activeCropperInstance.getCroppedCanvas({
                    width: targetWidth,
                    height: targetHeight,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                    fillColor: '#ffffff'
                });

                if (canvas) {
                    canvas.toBlob(function(blob) {
                        const croppedDataUrl = canvas.toDataURL('image/jpeg', 0.92);
                        const originalName = cropperCurrentOptions.file?.name || "image.jpg";
                        const cleanName = originalName.replace(/\.[^/.]+$/, "") + ".jpg";
                        
                        const croppedFile = new File([blob], cleanName, {
                            type: 'image/jpeg',
                            lastModified: Date.now()
                        });

                        const onCroppedCallback = cropperCurrentOptions.onCropped;
                        closeImageCropper();

                        if (typeof onCroppedCallback === 'function') {
                            onCroppedCallback(croppedFile, croppedDataUrl);
                        }
                    }, 'image/jpeg', 0.92);
                }
            });
        }
    });
</script>
