import { Html5Qrcode } from "html5-qrcode";

let html5QrCode = null;
let isScanning = false;

const readerId = "reader";
const startScanBtn = document.getElementById("startScanBtn");
const stopScanBtn = document.getElementById("stopScanBtn");
const cameraStatus = document.getElementById("cameraStatus");
const resultBox = document.getElementById("resultBox");
const manualForm = document.getElementById("manualForm");
const manualCode = document.getElementById("manualCode");

function showResult(type, message, data = null) {
    let alertClass = "alert bg-[#111126] border border-white/10 text-white";

    if (type === "success") {
        alertClass = "alert alert-success text-white";
    }

    if (type === "error") {
        alertClass = "alert alert-error text-white";
    }

    let detailHtml = "";

    if (data) {
        detailHtml = `
            <div class="mt-3 text-sm space-y-1">
                <p><strong>Kode:</strong> ${data.kode ?? "-"}</p>
                <p><strong>Event:</strong> ${data.event ?? "-"}</p>
                <p><strong>Tanggal:</strong> ${data.tanggal ?? "-"}</p>
                <p><strong>Lokasi:</strong> ${data.lokasi ?? "-"}</p>
                <p><strong>Pemilik:</strong> ${data.pemilik ?? "-"}</p>
                <p><strong>Status:</strong> ${data.status_tiket ?? "-"}</p>
            </div>
        `;
    }

    resultBox.className = alertClass;
    resultBox.innerHTML = `
        <div>
            <span>${message}</span>
            ${detailHtml}
        </div>
    `;
}

async function validateTicket(kodeUnik) {
    if (!kodeUnik) {
        showResult("error", "Kode tiket tidak boleh kosong.");
        return;
    }

    try {
        showResult("info", "Sedang memvalidasi tiket...");

        const response = await fetch(window.scanTicketUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": window.csrfToken,
                "Accept": "application/json",
            },
            body: JSON.stringify({
                kode_unik: kodeUnik,
            }),
        });

        const data = await response.json();

        if (data.status === "success") {
            showResult("success", data.message, data);
        } else {
            showResult("error", data.message, data);
        }
    } catch (error) {
        showResult("error", "Terjadi kesalahan saat validasi tiket.");
        console.error(error);
    }
}

async function startScanner() {
    if (isScanning) return;

    html5QrCode = new Html5Qrcode(readerId);

    try {
        await html5QrCode.start(
            { facingMode: "environment" },
            {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250,
                },
            },
            async (decodedText) => {
                if (!decodedText) return;

                await stopScanner();

                showResult("info", "QR Code berhasil dibaca. Memproses validasi...");
                await validateTicket(decodedText);
            },
            () => {
                // error kecil saat kamera membaca frame diabaikan
            }
        );

        isScanning = true;
        startScanBtn.disabled = true;
        stopScanBtn.disabled = false;
        cameraStatus.innerText = "Kamera aktif. Arahkan ke QR Code tiket.";
    } catch (error) {
        cameraStatus.innerText = "Kamera gagal dibuka. Pastikan izin kamera sudah diberikan.";
        showResult("error", "Kamera gagal dibuka. Coba cek izin kamera browser.");
        console.error(error);
    }
}

async function stopScanner() {
    if (!html5QrCode || !isScanning) return;

    try {
        await html5QrCode.stop();
        await html5QrCode.clear();

        isScanning = false;
        startScanBtn.disabled = false;
        stopScanBtn.disabled = true;
        cameraStatus.innerText = "Kamera berhenti.";
    } catch (error) {
        console.error(error);
    }
}

startScanBtn?.addEventListener("click", startScanner);
stopScanBtn?.addEventListener("click", stopScanner);

manualForm?.addEventListener("submit", async function (e) {
    e.preventDefault();

    const kodeUnik = manualCode.value.trim();

    await validateTicket(kodeUnik);

    manualCode.value = "";
});