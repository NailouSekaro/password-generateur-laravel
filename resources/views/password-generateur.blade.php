<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de Mot de Passe Sécurisé</title>
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #fca311;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --bg: #f8f9fa;
            --text: #212529;
            --card-bg: #ffffff;
            --shadow: rgba(0, 0, 0, 0.1);
        }

        .dark-mode {
            --bg: #121212;
            --text: #f8f9fa;
            --card-bg: #1e1e1e;
            --shadow: rgba(0, 0, 0, 0.4);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: background-color 0.3s, color 0.3s;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1rem;
            line-height: 1.6;
        }

        header {
            text-align: center;
            margin-bottom: 2rem;
            width: 100%;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }

        .container {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 8px 24px var(--shadow);
            padding: 2rem;
            width: 100%;
            max-width: 500px;
            margin-bottom: 2rem;
        }

        .password-display {
            position: relative;
            background-color: rgba(67, 97, 238, 0.1);
            border: 2px solid var(--primary);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
            font-weight: 600;
            word-break: break-all;
            text-align: center;
            min-height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-display.empty:before {
            content: "Votre mot de passe apparaîtra ici";
            color: var(--gray);
            font-weight: normal;
        }

        .strength-meter {
            height: 8px;
            width: 100%;
            background-color: #e9ecef;
            border-radius: 4px;
            margin: 0.5rem 0 1.5rem;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            border-radius: 4px;
            transition: width 0.3s, background-color 0.3s;
        }

        .strength-labels {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            color: var(--gray);
        }

        .settings {
            margin-bottom: 1.5rem;
        }

        .setting {
            margin-bottom: 1rem;
        }

        .setting label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .length-slider {
            width: 100%;
            height: 8px;
            -webkit-appearance: none;
            appearance: none;
            background: #e9ecef;
            outline: none;
            border-radius: 4px;
        }

        .length-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--primary);
            cursor: pointer;
        }

        .length-value {
            text-align: center;
            font-weight: 600;
            font-size: 1.2rem;
            color: var(--primary);
        }

        .checkboxes {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }

        @media (max-width: 480px) {
            .checkboxes {
                grid-template-columns: 1fr;
            }
        }

        .checkbox-container {
            display: flex;
            align-items: center;
        }

        .checkbox-container input {
            margin-right: 0.5rem;
        }

        .buttons {
            display: flex;
            gap: 1rem;
        }

        button {
            flex: 1;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-generate {
            background-color: var(--primary);
            color: white;
        }

        .btn-generate:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
        }

        .btn-copy {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-copy:hover {
            background-color: rgba(67, 97, 238, 0.1);
        }

        .btn-copy.copied {
            background-color: var(--success);
            color: white;
            border-color: var(--success);
        }

        .history {
            width: 100%;
            max-width: 500px;
        }

        .history h2 {
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .history-list {
            list-style: none;
            max-height: 200px;
            overflow-y: auto;
        }

        .history-item {
            background-color: var(--card-bg);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px var(--shadow);
        }

        .history-item button {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }

        .theme-toggle {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text);
            font-size: 1.5rem;
        }

        footer {
            margin-top: auto;
            padding: 1rem;
            text-align: center;
            color: var(--gray);
            font-size: 0.9rem;
        }

        @keyframes generateAnimation {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .generating {
            animation: generateAnimation 0.3s ease;
        }
    </style>
</head>
<body>
    <button class="theme-toggle" id="themeToggle">🌙</button>

    <header>
        <h1>Générateur de Mot de Passe</h1>
        <p>Créez des mots de passe sécurisés en un clic</p>
    </header>

    <div class="container">
        <div class="password-display empty" id="passwordDisplay"></div>

        <div class="strength-meter">
            <div class="strength-fill" id="strengthFill"></div>
        </div>

        <div class="strength-labels">
            <span>Faible</span>
            <span>Moyen</span>
            <span>Fort</span>
            <span>Très fort</span>
        </div>

        <div class="settings">
            <div class="setting">
                <label for="lengthSlider">Longueur: <span class="length-value" id="lengthValue">12</span> caractères</label>
                <input type="range" id="lengthSlider" class="length-slider" min="4" max="32" value="12">
            </div>

            <div class="checkboxes">
                <div class="checkbox-container">
                    <input type="checkbox" id="uppercaseCheckbox" checked>
                    <label for="uppercaseCheckbox">Majuscules (A-Z)</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="lowercaseCheckbox" checked>
                    <label for="lowercaseCheckbox">Minuscules (a-z)</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="numbersCheckbox" checked>
                    <label for="numbersCheckbox">Chiffres (0-9)</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="symbolsCheckbox">
                    <label for="symbolsCheckbox">Symboles (!@#$...)</label>
                </div>
            </div>
        </div>

        <div class="buttons">
            <button class="btn-generate" id="generateBtn">
                <span>Générer</span>
            </button>
            <button class="btn-copy" id="copyBtn">
                <span>Copier</span>
            </button>
        </div>
    </div>

    <div class="history">
        <h2>Historique</h2>
        <ul class="history-list" id="historyList"></ul>
    </div>

    <footer>
        <p>Générateur de mot de passe sécurisé - © 2025</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Éléments du DOM
            const themeToggle = document.getElementById('themeToggle');
            const lengthSlider = document.getElementById('lengthSlider');
            const lengthValue = document.getElementById('lengthValue');
            const uppercaseCheckbox = document.getElementById('uppercaseCheckbox');
            const lowercaseCheckbox = document.getElementById('lowercaseCheckbox');
            const numbersCheckbox = document.getElementById('numbersCheckbox');
            const symbolsCheckbox = document.getElementById('symbolsCheckbox');
            const generateBtn = document.getElementById('generateBtn');
            const copyBtn = document.getElementById('copyBtn');
            const passwordDisplay = document.getElementById('passwordDisplay');
            const strengthFill = document.getElementById('strengthFill');
            const historyList = document.getElementById('historyList');

            // Caractères possibles
            const uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const lowercase = 'abcdefghijklmnopqrstuvwxyz';
            const numbers = '0123456789';
            const symbols = '!@#$%^&*()_+-=[]{}|;:,.<>?';

            // Historique des mots de passe
            let passwordHistory = JSON.parse(localStorage.getItem('passwordHistory')) || [];

            // Charger l'historique
            updateHistoryDisplay();

            // Thème sombre/clair
            themeToggle.addEventListener('click', () => {
                document.body.classList.toggle('dark-mode');
                themeToggle.textContent = document.body.classList.contains('dark-mode') ? '☀️' : '🌙';
            });

            // Mise à jour de l'affichage de la longueur
            lengthSlider.addEventListener('input', () => {
                lengthValue.textContent = lengthSlider.value;
            });

            // Génération du mot de passe
            generateBtn.addEventListener('click', generatePassword);

            // Copie dans le presse-papier
            copyBtn.addEventListener('click', copyToClipboard);

            // Fonction de génération de mot de passe
            function generatePassword() {
                let charset = '';
                let password = '';

                // Construction du jeu de caractères en fonction des options
                if (uppercaseCheckbox.checked) charset += uppercase;
                if (lowercaseCheckbox.checked) charset += lowercase;
                if (numbersCheckbox.checked) charset += numbers;
                if (symbolsCheckbox.checked) charset += symbols;

                // Vérification qu'au moins une option est sélectionnée
                if (charset.length === 0) {
                    alert('Veuillez sélectionner au moins un type de caractères.');
                    return;
                }

                // Génération du mot de passe
                const length = parseInt(lengthSlider.value);
                for (let i = 0; i < length; i++) {
                    const randomIndex = Math.floor(Math.random() * charset.length);
                    password += charset[randomIndex];
                }

                // Affichage du mot de passe
                passwordDisplay.textContent = password;
                passwordDisplay.classList.remove('empty');

                // Animation
                passwordDisplay.classList.add('generating');
                setTimeout(() => {
                    passwordDisplay.classList.remove('generating');
                }, 300);

                // Calcul et affichage de la force
                updatePasswordStrength(password);

                // Ajout à l'historique
                addToHistory(password);
            }

            // Calcul de la force du mot de passe
            function updatePasswordStrength(password) {
                let strength = 0;

                // Longueur
                if (password.length >= 8) strength += 1;
                if (password.length >= 12) strength += 1;

                // Diversité des caractères
                const hasUpper = /[A-Z]/.test(password);
                const hasLower = /[a-z]/.test(password);
                const hasNumber = /[0-9]/.test(password);
                const hasSymbol = /[^A-Za-z0-9]/.test(password);

                if (hasUpper) strength += 1;
                if (hasLower) strength += 1;
                if (hasNumber) strength += 1;
                if (hasSymbol) strength += 2; // Les symboles ajoutent plus de sécurité

                // Normalisation entre 0 et 100%
                const maxStrength = 7; // 2 (longueur) + 1+1+1+2 (diversité) = 7
                const strengthPercent = (strength / maxStrength) * 100;

                // Mise à jour de la barre de force
                strengthFill.style.width = `${strengthPercent}%`;

                // Couleur en fonction de la force
                if (strengthPercent < 25) {
                    strengthFill.style.backgroundColor = '#dc3545'; // Rouge
                } else if (strengthPercent < 50) {
                    strengthFill.style.backgroundColor = '#fd7e14'; // Orange
                } else if (strengthPercent < 75) {
                    strengthFill.style.backgroundColor = '#ffc107'; // Jaune
                } else {
                    strengthFill.style.backgroundColor = '#198754'; // Vert
                }
            }

            // Copie dans le presse-papier
            function copyToClipboard() {
                if (passwordDisplay.classList.contains('empty')) return;

                const password = passwordDisplay.textContent;
                navigator.clipboard.writeText(password).then(() => {
                    // Feedback visuel
                    copyBtn.classList.add('copied');
                    copyBtn.innerHTML = '<span>Copié!</span>';

                    setTimeout(() => {
                        copyBtn.classList.remove('copied');
                        copyBtn.innerHTML = '<span>Copier</span>';
                    }, 2000);
                }).catch(err => {
                    console.error('Erreur lors de la copie: ', err);
                    alert('Impossible de copier le mot de passe');
                });
            }

            // Ajout à l'historique
            function addToHistory(password) {
                // Ajouter au début du tableau
                passwordHistory.unshift({
                    password: password,
                    timestamp: new Date().toLocaleString('fr-FR')
                });

                // Garder seulement les 5 derniers
                if (passwordHistory.length > 5) {
                    passwordHistory.pop();
                }

                // Sauvegarder dans le localStorage
                localStorage.setItem('passwordHistory', JSON.stringify(passwordHistory));

                // Mettre à jour l'affichage
                updateHistoryDisplay();
            }

            // Mise à jour de l'affichage de l'historique
            function updateHistoryDisplay() {
                historyList.innerHTML = '';

                if (passwordHistory.length === 0) {
                    historyList.innerHTML = '<li class="history-item">Aucun mot de passe généré récemment</li>';
                    return;
                }

                passwordHistory.forEach(item => {
                    const li = document.createElement('li');
                    li.className = 'history-item';

                    const passwordSpan = document.createElement('span');
                    passwordSpan.textContent = item.password;

                    const timeSpan = document.createElement('span');
                    timeSpan.textContent = item.timestamp;
                    timeSpan.style.fontSize = '0.8rem';
                    timeSpan.style.color = 'var(--gray)';

                    const button = document.createElement('button');
                    button.className = 'btn-copy';
                    button.innerHTML = 'Copier';
                    button.addEventListener('click', () => {
                        navigator.clipboard.writeText(item.password);
                        button.innerHTML = 'Copié!';
                        setTimeout(() => {
                            button.innerHTML = 'Copier';
                        }, 2000);
                    });

                    li.appendChild(passwordSpan);
                    li.appendChild(timeSpan);
                    li.appendChild(button);

                    historyList.appendChild(li);
                });
            }

            // Générer un mot de passe au chargement de la page
            generatePassword();
        });
    </script>
</body>
</html>
