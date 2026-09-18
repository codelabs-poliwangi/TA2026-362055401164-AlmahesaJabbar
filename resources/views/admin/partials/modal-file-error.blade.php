{{-- Modal Notifikasi File Tidak Sesuai (Sederhana & Minimalis) --}}
<div id="file-error-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4 transition-all duration-200">
    <!-- Backdrop Overlay -->
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity duration-200" id="file-error-backdrop"></div>
    
    <!-- Modal Dialog Card -->
    <div class="relative bg-white rounded-2xl max-w-xs sm:max-w-sm w-full p-6 text-center shadow-xl border border-slate-100 transform transition-all scale-95 opacity-0 duration-200 z-10" id="file-error-card">
        
        <!-- Icon -->
        <div class="w-12 h-12 bg-red-50 border border-red-100 rounded-full flex items-center justify-center mx-auto mb-3.5 text-red-500 shadow-sm">
            <i data-lucide="alert-circle" class="w-6 h-6 text-red-600"></i>
        </div>

        <!-- Title -->
        <h3 class="font-display font-bold text-slate-800 text-base mb-1.5" id="file-error-title">
            File Tidak Sesuai
        </h3>

        <!-- Description -->
        <p class="text-slate-500 text-xs leading-relaxed mb-5" id="file-error-message">
            Format file tidak didukung. Silakan pilih file yang sesuai.
        </p>

        <!-- Button -->
        <button type="button" id="file-error-close-btn" class="w-full py-2.5 px-4 bg-slate-900 hover:bg-slate-800 active:scale-[0.98] text-white font-semibold rounded-xl transition text-xs shadow-sm">
            Tutup
        </button>
    </div>
</div>

<script>
    // Global Minimalist File Error Modal Functions
    window.showFileErrorModal = function(options = {}) {
        const {
            title = 'File Tidak Sesuai',
            message = 'Format file tidak didukung. Silakan pilih file yang sesuai.'
        } = options;

        const modal = document.getElementById('file-error-modal');
        const card = document.getElementById('file-error-card');
        const titleEl = document.getElementById('file-error-title');
        const messageEl = document.getElementById('file-error-message');

        if (!modal || !card) return;

        if (titleEl) titleEl.textContent = title;
        if (messageEl) messageEl.textContent = message;

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        if (window.lucide) {
            lucide.createIcons();
        }

        requestAnimationFrame(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        });
    };

    window.hideFileErrorModal = function() {
        const modal = document.getElementById('file-error-modal');
        const card = document.getElementById('file-error-card');
        if (!modal || !card) return;

        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 150);
    };

    // Unified validator function for file inputs
    window.validateFile = function(file, options = {}) {
        const defaults = {
            type: 'image', // 'image' | 'document' | 'any'
            allowedExtensions: ['jpg', 'jpeg', 'png', 'webp'],
            maxSizeMB: 2,
            inputElement: null,
            onReset: null
        };

        const config = Object.assign({}, defaults, options);
        if (!file) return true;

        const fileName = file.name || '';
        const parts = fileName.split('.');
        const ext = parts.length > 1 ? parts.pop().toLowerCase() : '';

        // Security check for dangerous / double extensions
        const dangerousExtensions = ['php', 'phtml', 'phar', 'exe', 'sh', 'bat', 'cmd', 'js', 'py', 'vbs', 'scr', 'html', 'htm'];
        const hasDangerousSegment = parts.some(part => dangerousExtensions.includes(part.toLowerCase()));

        const isExtensionAllowed = config.allowedExtensions.map(e => e.toLowerCase()).includes(ext);

        // 1. Format validation failure
        if (!isExtensionAllowed || hasDangerousSegment) {
            if (config.inputElement) {
                config.inputElement.value = '';
            }
            if (typeof config.onReset === 'function') {
                config.onReset();
            }

            showFileErrorModal({
                title: 'File Tidak Sesuai',
                message: 'Format file tidak didukung. Silakan pilih file yang sesuai.'
            });

            return false;
        }

        // 2. File size validation failure
        const maxSizeBytes = config.maxSizeMB * 1024 * 1024;
        if (file.size > maxSizeBytes) {
            if (config.inputElement) {
                config.inputElement.value = '';
            }
            if (typeof config.onReset === 'function') {
                config.onReset();
            }

            showFileErrorModal({
                title: 'File Tidak Sesuai',
                message: 'Ukuran file melebihi batas maksimal yang diperbolehkan.'
            });

            return false;
        }

        return true;
    };

    // Global Helper: Simulate File Upload Progress (0% to 100%) with High-Contrast Border
    window.simulateFileUploadProgress = function(options = {}) {
        const {
            container,
            progressBox,
            progressBar,
            progressPercent,
            progressStatus,
            submitBtn,
            onComplete
        } = options;

        if (!container || !progressBox || !progressBar || !progressPercent) return;

        // 1. High contrast active border styling
        container.classList.remove('border-dashed', 'border-slate-200', 'bg-slate-50', 'border-emerald-500', 'ring-emerald-500/20');
        container.classList.add('border-solid', 'border-blue-600', 'ring-4', 'ring-blue-500/20', 'bg-blue-50/20');

        // 2. Temporarily disable submit button
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.setAttribute('data-uploading', 'true');
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
        }

        // 3. Show progress box & initialize 0%
        progressBox.classList.remove('hidden');
        progressBar.style.width = '0%';
        progressBar.classList.remove('bg-emerald-500');
        progressBar.classList.add('bg-blue-600');
        progressPercent.textContent = '0%';
        progressPercent.classList.remove('text-emerald-600');
        progressPercent.classList.add('text-blue-600');

        if (progressStatus) {
            progressStatus.innerHTML = `
                <span class="inline-flex items-center gap-1.5 text-slate-700 font-medium">
                    <svg class="w-3.5 h-3.5 animate-spin text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-opacity="0.25"></circle><path d="M12 2a10 10 0 0 1 10 10" stroke="currentColor"></path></svg>
                    Mengunggah file...
                </span>
            `;
        }

        // 4. Smooth percentage step animation
        let percent = 0;
        const intervalTime = 40;
        
        if (container._uploadInterval) {
            clearInterval(container._uploadInterval);
        }

        container._uploadInterval = setInterval(() => {
            const stepIncrement = Math.floor(Math.random() * 8) + 4;
            percent = Math.min(percent + stepIncrement, 100);

            progressBar.style.width = percent + '%';
            progressPercent.textContent = percent + '%';

            if (percent >= 100) {
                clearInterval(container._uploadInterval);
                container._uploadInterval = null;

                // 5. 100% Success state
                progressBar.classList.remove('bg-blue-600');
                progressBar.classList.add('bg-emerald-500');
                progressPercent.classList.remove('text-blue-600');
                progressPercent.classList.add('text-emerald-600');

                if (progressStatus) {
                    progressStatus.innerHTML = `
                        <span class="inline-flex items-center gap-1.5 text-emerald-700 font-bold">
                            <svg class="w-3.5 h-3.5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            File berhasil diunggah
                        </span>
                    `;
                }

                // High-contrast success border
                container.classList.remove('border-blue-600', 'ring-blue-500/20');
                container.classList.add('border-emerald-500', 'ring-4', 'ring-emerald-500/20');

                // Re-enable submit button
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.removeAttribute('data-uploading');
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
                }

                if (typeof onComplete === 'function') {
                    onComplete();
                }
            }
        }, intervalTime);
    };

    // Global Helper: Reset File Upload Progress & Border
    window.resetFileUploadProgress = function(options = {}) {
        const {
            container,
            progressBox,
            progressBar,
            progressPercent,
            progressStatus,
            submitBtn
        } = options;

        if (container) {
            if (container._uploadInterval) {
                clearInterval(container._uploadInterval);
                container._uploadInterval = null;
            }
            container.classList.remove('border-solid', 'border-blue-600', 'border-emerald-500', 'ring-4', 'ring-blue-500/20', 'ring-emerald-500/20', 'bg-blue-50/20');
            container.classList.add('border-dashed', 'border-slate-200', 'bg-slate-50');
        }

        if (progressBox) {
            progressBox.classList.add('hidden');
        }
        if (progressBar) {
            progressBar.style.width = '0%';
        }
        if (progressPercent) {
            progressPercent.textContent = '0%';
        }
        if (progressStatus) {
            progressStatus.innerHTML = 'Memproses file...';
        }
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.removeAttribute('data-uploading');
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
        }
    };

    // Modal Close Event Listeners
    document.addEventListener('DOMContentLoaded', function() {
        const closeBtn = document.getElementById('file-error-close-btn');
        const backdrop = document.getElementById('file-error-backdrop');

        if (closeBtn) {
            closeBtn.addEventListener('click', hideFileErrorModal);
        }
        if (backdrop) {
            backdrop.addEventListener('click', hideFileErrorModal);
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideFileErrorModal();
            }
        });
    });
</script>
