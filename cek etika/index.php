<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Etika AI untuk Tugas</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">🤖</div>
            <div>
                <h1>Cek Etika AI untuk Tugas</h1>
                <p>Aplikasi untuk membantu siswa mengevaluasi apakah penggunaan AI dalam tugas sudah etis.</p>
            </div>
        </header>

        <form id="ethicsForm">
            <div class="main-grid">
                <div class="card">
                    <h2>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        Input Teks Tugas
                    </h2>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">Masukkan atau tempel teks tugas kamu di bawah ini:</p>
                    <textarea id="taskText" name="teks_tugas" placeholder="Ketik di sini..." maxlength="2000" required></textarea>
                    <div class="char-counter"><span id="charCount">0</span>/2000</div>
                    
                    <div class="actions">
                        <button type="button" id="clearBtn" class="btn-secondary">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                            Bersihkan
                        </button>
                        <button type="submit" class="btn-primary">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            Cek Etika
                        </button>
                    </div>
                </div>

                <div class="card">
                    <h2>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        Checklist Etika Penggunaan AI
                    </h2>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">Jawab pertanyaan berikut dengan jujur:</p>

                    <div class="checklist-item">
                        <p>1. Apakah sebagian atau seluruh teks ini dibuat oleh AI?</p>
                        <div class="radio-group">
                            <label class="radio-option"><input type="radio" name="q1" value="Ya" required> Ya</label>
                            <label class="radio-option"><input type="radio" name="q1" value="Tidak"> Tidak</label>
                        </div>
                    </div>

                    <div class="checklist-item">
                        <p>2. Apakah kamu sudah mengedit dan menyesuaikan teks agar sesuai dengan pemahamanmu?</p>
                        <div class="radio-group">
                            <label class="radio-option"><input type="radio" name="q2" value="Ya" required> Ya</label>
                            <label class="radio-option"><input type="radio" name="q2" value="Tidak"> Tidak</label>
                        </div>
                    </div>

                    <div class="checklist-item">
                        <p>3. Apakah kamu mencantumkan bahwa AI membantumu dalam tugas ini?</p>
                        <div class="radio-group">
                            <label class="radio-option"><input type="radio" name="q3" value="Ya" required> Ya</label>
                            <label class="radio-option"><input type="radio" name="q3" value="Belum"> Belum</label>
                        </div>
                    </div>

                    <div class="checklist-item">
                        <p>4. Apakah tugas ini hasil usahamu sendiri, bukan menyalin mentah dari AI?</p>
                        <div class="radio-group">
                            <label class="radio-option"><input type="radio" name="q4" value="Ya" required> Ya</label>
                            <label class="radio-option"><input type="radio" name="q4" value="Tidak"> Tidak</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div id="result" class="result-card card">
            <div id="statusBox" class="status-box">
                <div class="status-icon" id="statusIcon"></div>
                <div class="status-content">
                    <h3>Hasil Cek Etika <span id="statusBadge" class="badge"></span></h3>
                    <p id="statusMessage" style="font-weight: 700; margin-top: 0.5rem;"></p>
                </div>
            </div>
            
            <p id="detailedAnalysis"></p>

            <div id="paraphraseSection" class="tips-container" style="background: #eef2ff; border: 1px solid #e0e7ff; display: none; margin-top: 1rem;">
                <h4 style="color: var(--primary);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                    Saran Parafrase:
                </h4>
                <div id="paraphraseResult" style="font-style: italic; color: #3730a3; background: white; padding: 1rem; border-radius: 8px; margin-top: 0.5rem; border-left: 4px solid var(--primary);"></div>
                <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.5rem;">*Ini adalah saran parafrase otomatis untuk membantu Anda menulis ulang dengan gaya bahasa yang berbeda.</p>
            </div>

            <div class="tips-container">
                <h4>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v8"></path><path d="M12 14v2"></path><path d="M12 18h.01"></path><path d="M4.93 4.93l1.41 1.41"></path><path d="M17.66 17.66l1.41 1.41"></path><path d="M2 12h2"></path><path d="M20 12h2"></path><path d="M6.34 17.66l-1.41 1.41"></path><path d="M19.07 4.93l-1.41 1.41"></path></svg>
                    Tips:
                </h4>
                <ul class="tips-list">
                    <li>Selalu jujur tentang penggunaan AI</li>
                    <li>Jadikan AI sebagai alat bantu belajar, bukan jalan pintas</li>
                    <li>Kembangkan ide sendiri dari bantuan AI</li>
                    <li>Cantumkan sumber dengan benar</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
