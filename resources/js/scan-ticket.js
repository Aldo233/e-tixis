import { Html5Qrcode } from "html5-qrcode";

const resultBox = document.getElementById("resultBox");
const manualForm = document.getElementById("manualForm");
const manualCode = document.getElementById("manualCode");

const startScanBtn = document.getElementById("startScanBtn");
const stopScanBtn = document.getElementById("stopScanBtn");
const cameraStatus = document.getElementById("cameraStatus");

const html5QrCode = new Html5Qrcode("reader");

let isScanning = false;
let lastScanned = null;
let scanLocked = false;

function showResult(type, message, code = null) {
    resultBox.className = "alert";

    if (type === "success") {
        resultBox.classList.add("alert-success");
    } else {
        resultBox.classList.add("alert-error");
    }

    resultBox.innerHTML = `
        <div>
            <div class="font-bold">${message}</div>
            ${code ? `<div class="text-sm mt-1">Kode: ${code}</div>` : ""}
        </div>
    `;
}

async function validateTicket(code) {
    try {
        const response = await fetch(window.scanTicketUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": window.csrfToken,
                "Accept": "application/json"
            },
            body: JSON.stringify({
                kode_unik: code
            })
        });

        const data = await response.json();

        showResult(data.status, data.message, data.kode ?? code);

    } catch (error) {
        showResult("error", "Terjadi kesalahan saat validasi tiket.");
    }
}

async function startScanner() {
    try {
        cameraStatus.innerText = "Meminta izin kamera...";

        const cameras = await Html5Qrcode.getCameras();

        if (!cameras || cameras.length === 0) {
            cameraStatus.innerText = "Kamera tidak ditemukan.";
            showResult("error", "Kamera tidak ditemukan di perangkat ini.");
            return;
        }

        const cameraId = cameras[0].id;

        await html5QrCode.start(
            cameraId,
            {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            (decodedText) => {
                if (scanLocked || decodedText === lastScanned) {
                    return;
                }

                lastScanned = decodedText;
                scanLocked = true;

                validateTicket(decodedText);

                setTimeout(() => {
                    scanLocked = false;
                }, 3000);
            },
            () => {
                // error scan kecil diabaikan supaya tidak spam
            }
        );

        isScanning = true;
        startScanBtn.disabled = true;
        stopScanBtn.disabled = false;
        cameraStatus.innerText = "Kamera aktif. Arahkan ke QR Code tiket.";

    } catch (error) {
        cameraStatus.innerText = "Gagal mengakses kamera.";
        showResult("error", "Gagal mengakses kamera. Pastikan izin kamera di browser sudah diaktifkan.");
    }
}

async function stopScanner() {
    if (!isScanning) {
        return;
    }

    try {
        await html5QrCode.stop();

        isScanning = false;
        startScanBtn.disabled = false;
        stopScanBtn.disabled = true;
        cameraStatus.innerText = "Kamera dihentikan.";

    } catch (error) {
        showResult("error", "Gagal menghentikan kamera.");
    }
}

startScanBtn.addEventListener("click", startScanner);
stopScanBtn.addEventListener("click", stopScanner);

manualForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const code = manualCode.value.trim();

    if (!code) {
        showResult("error", "Kode tiket wajib diisi.");
        return;
    }

    validateTicket(code);
});