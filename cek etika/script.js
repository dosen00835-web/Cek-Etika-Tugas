document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('ethicsForm');
    const taskText = document.getElementById('taskText');
    const charCount = document.getElementById('charCount');
    const clearBtn = document.getElementById('clearBtn');
    const resultCard = document.getElementById('result');
    const statusBox = document.getElementById('statusBox');
    const statusIcon = document.getElementById('statusIcon');
    const statusBadge = document.getElementById('statusBadge');
    const statusMessage = document.getElementById('statusMessage');
    const detailedAnalysis = document.getElementById('detailedAnalysis');
    const paraphraseSection = document.getElementById('paraphraseSection');
    const paraphraseResult = document.getElementById('paraphraseResult');

    // Simple Paraphrase Logic
    function generateParaphrase(text) {
        if (!text || text.length < 10) return text;

        const synonyms = {
            'adalah': 'merupakan',
            'mempunyai': 'memiliki',
            'sangat': 'amat',
            'banyak': 'beragam',
            'bagus': 'baik',
            'membantu': 'menolong',
            'membuat': 'menciptakan',
            'menggunakan': 'memanfaatkan',
            'penting': 'signifikan',
            'tugas': 'pekerjaan',
            'siswa': 'pelajar',
            'guru': 'pengajar',
            'mudah': 'gampang',
            'sulit': 'sukar',
            'besar': 'luas',
            'kecil': 'minim',
            'bisa': 'dapat',
            'ingin': 'hendak'
        };

        // Split text by words, handle punctuation
        let words = text.split(/(\s+)/);
        let paraphrasedWords = words.map(word => {
            let cleanWord = word.toLowerCase().replace(/[.,!?;]/g, '');
            let punctuation = word.slice(cleanWord.length);
            
            if (synonyms[cleanWord]) {
                let replacement = synonyms[cleanWord];
                // Match case
                if (word[0] === word[0].toUpperCase()) {
                    replacement = replacement.charAt(0).toUpperCase() + replacement.slice(1);
                }
                return replacement + punctuation;
            }
            return word;
        });

        // Simple sentence structure adjustment (very basic demo)
        let result = paraphrasedWords.join('');
        
        // Add a "smart" prefix/suffix variation if it looks too similar
        if (result === text) {
            result = "Secara keseluruhan, " + text.charAt(0).toLowerCase() + text.slice(1);
        }

        return result;
    }

    // Character counter
    taskText.addEventListener('input', () => {
        charCount.textContent = taskText.value.length;
    });

    // Clear form
    clearBtn.addEventListener('click', () => {
        form.reset();
        charCount.textContent = '0';
        resultCard.style.display = 'none';
    });

    // Handle form submission
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const q1 = formData.get('q1');
        const q2 = formData.get('q2');
        const q3 = formData.get('q3');
        const q4 = formData.get('q4');

        let status = 'AMAN';
        let badgeClass = 'aman';
        let icon = '✓';
        let message = 'Penggunaan AI-mu sudah tergolong ETIS dan AMAN!';
        let analysis = 'Bagus! Kamu sudah menggunakan AI dengan bijak, mengedit hasilnya, dan berusaha mengerjakan dengan usahamu sendiri. Pastikan selalu mencantumkan sumber jika menggunakan bantuan AI.';

        // Logic check
        // Rule 1: Semi-manual/Full AI but edited and honest and original effort
        if (q2 === 'Tidak' || q4 === 'Tidak' || q3 === 'Belum') {
            status = 'WASPADA';
            badgeClass = 'waspada';
            icon = '⚠';
            message = 'Penggunaan AI-mu memerlukan PERBAIKAN!';
            analysis = 'Perhatian! Kamu masih perlu menyesuaikan teks, mencantumkan sumber AI, atau memastikan ini adalah hasil pemikiranmu sendiri agar tetap etis.';
        }

        // Generate Paraphrase
        const teksTugas = formData.get('teks_tugas');
        const paraphrasedText = generateParaphrase(teksTugas);
        paraphraseResult.textContent = paraphrasedText;
        paraphraseSection.style.display = 'block';

        // Add status and message to formData for database
        formData.append('status', status);
        formData.append('pesan', analysis);
        formData.append('teks_parafrase', paraphrasedText);

        // Update UI
        statusBadge.textContent = status;
        statusBadge.className = `badge ${badgeClass}`;
        statusBox.className = `status-box ${badgeClass}`;
        statusIcon.innerHTML = icon;
        statusMessage.textContent = message;
        detailedAnalysis.textContent = analysis;
        
        resultCard.style.display = 'block';
        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });

        // Save to database
        try {
            const response = await fetch('save_cek.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            if (!data.success) {
                console.error('Database error:', data.error);
            }
        } catch (error) {
            console.error('Fetch error:', error);
        }
    });
});
