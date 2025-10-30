/**
 * QR Scanner Handler
 * Handles QR code scanning functionality
 */

class QRScanner {
    constructor(elementId) {
        this.elementId = elementId;
        this.html5QrCode = null;
        this.isScanning = false;
    }

    /**
     * Initialize and start the QR scanner
     */
    async start() {
        if (this.isScanning) {
            console.warn('Scanner already running');
            return;
        }

        try {
            this.html5QrCode = new Html5Qrcode(this.elementId);
            
            const config = {
                fps: 10,
                qrbox: { width: 250, height: 250 },
                aspectRatio: 1.0,
                // Prefer back camera on mobile devices
                videoConstraints: {
                    facingMode: { ideal: "environment" }
                }
            };
            
            await this.html5QrCode.start(
                { facingMode: "environment" },
                config,
                this.onScanSuccess.bind(this),
                this.onScanError.bind(this)
            );
            
            this.isScanning = true;
            console.log('QR Scanner started successfully');
            
        } catch (err) {
            console.error("Error starting scanner:", err);
            this.showError('Tidak dapat mengakses kamera. Pastikan Anda memberikan izin akses kamera.');
        }
    }

    /**
     * Stop the QR scanner
     */
    async stop() {
        if (!this.html5QrCode || !this.isScanning) {
            return;
        }

        try {
            await this.html5QrCode.stop();
            this.html5QrCode.clear();
            this.isScanning = false;
            console.log('QR Scanner stopped');
        } catch (err) {
            console.error("Error stopping scanner:", err);
        }
    }

    /**
     * Handle successful QR code scan
     */
    onScanSuccess(decodedText, decodedResult) {
        console.log('QR Code detected:', decodedText);
        
        // Stop scanning immediately
        this.stop();
        
        // Show success message
        this.showSuccess('QR Code berhasil dipindai! Mengarahkan ke halaman detail...');
        
        // Validate URL before redirect
        if (this.isValidUrl(decodedText)) {
            // Redirect after short delay
            setTimeout(() => {
                window.location.href = decodedText;
            }, 1000);
        } else {
            this.showError('QR Code tidak valid atau bukan URL yang benar.');
        }
    }

    /**
     * Handle QR code scan errors (silent)
     */
    onScanError(errorMessage) {
        // Silent error handling - only log severe errors
        if (errorMessage.includes('NotFoundException') === false) {
            console.warn(`QR scan error: ${errorMessage}`);
        }
    }

    /**
     * Show success message
     */
    showSuccess(message) {
        const resultsDiv = document.getElementById('qr-reader-results');
        if (resultsDiv) {
            resultsDiv.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bx bx-check-circle"></i> ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
        }
    }

    /**
     * Show error message
     */
    showError(message) {
        const resultsDiv = document.getElementById('qr-reader-results');
        if (resultsDiv) {
            resultsDiv.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bx bx-error-circle"></i> ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
        }
    }

    /**
     * Validate if string is a valid URL
     */
    isValidUrl(string) {
        try {
            const url = new URL(string);
            return url.protocol === 'http:' || url.protocol === 'https:';
        } catch (_) {
            return false;
        }
    }

    /**
     * Clear results display
     */
    clearResults() {
        const resultsDiv = document.getElementById('qr-reader-results');
        if (resultsDiv) {
            resultsDiv.innerHTML = '';
        }
    }
}

// Initialize scanner when modal events occur
document.addEventListener('DOMContentLoaded', function() {
    const scannerModal = document.getElementById('qrScannerModal');
    
    if (scannerModal) {
        const scanner = new QRScanner('qr-reader');
        
        // Start scanner when modal is shown
        scannerModal.addEventListener('shown.bs.modal', function () {
            scanner.clearResults();
            scanner.start();
        });
        
        // Stop scanner when modal is hidden
        scannerModal.addEventListener('hidden.bs.modal', function () {
            scanner.stop();
            scanner.clearResults();
        });
    }
});