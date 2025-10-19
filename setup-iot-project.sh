#!/bin/bash

# Nume proiect
PROJECT="iot-iulianduma-casa-ver3.0"

# Creează folderul proiectului
mkdir $PROJECT && cd $PROJECT

# Inițializează Git
git init

# Creează fișierul .gitignore
cat <<EOF > .gitignore
/vendor/
/node_modules/
/.env
/public/build/
/var/
/.idea/
/*.log
EOF

# Creează fișierul README.md
cat <<EOF > README.md
# iot-iulianduma-casa-ver3.0

Aplicație IoT containerizată cu Symfony + PostgreSQL + React, integrată cu plăci Arduino D1 WiFi.

## Funcționalități
- Salvare date senzori: temperatură, umiditate, presiune, gaz, lumină, prezență
- Control relee și interpretare buton multi-click
- Dashboard React cu grafic și control
- Export CSV/JSON
- Autentificare simplă
- Endpointuri REST pentru Arduino

## Lansare rapidă

\`\`\`bash
docker compose up -d --build
docker exec -it php bash
composer install
php bin/console doctrine:migrations:migrate
npm install
npm run dev
\`\`\`

## Arduino
Plăcile trimit date JSON către \`/api/senzori\` și pot primi comenzi prin \`/api/relee/{deviceId}\`.
EOF

# Adaugă fișierele în Git
git add .
git commit -m "Initial commit: proiect IoT Symfony + Docker + React"

# Setează remote-ul GitHub prin SSH
git remote add origin git@github.com:iulianduma/iot-iulianduma-casa-ver3.0.git
git branch -M main

# Push către GitHub
git push -u origin main

echo "✅ Proiectul a fost creat, inițializat și urcat pe GitHub prin SSH!"
