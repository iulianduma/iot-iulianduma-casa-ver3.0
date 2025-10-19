#!/bin/bash

# === CONFIGURARE ===
PROJECT="iot-iulianduma-casa-ver3.0"

# === CREARE STRUCTURĂ ===
mkdir -p $PROJECT/{docker/php,docker/nginx,src/Entity,src/Controller,src/Repository,templates/home,assets/react/components,public}
cd $PROJECT

# === FIȘIERE DE BAZĂ ===
echo "/vendor/
/node_modules/
/.env
/public/build/
/var/
/.idea/
/*.log" > .gitignore

cat <<EOF > README.md
# $PROJECT

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
=======

EOF

cat <<EOF > docker-compose.yml
version: '3.8'
services:
  php:
    build: ./docker/php
    volumes:
      - .:/var/www/html
    depends_on:
      - postgres
    networks:
      - symfony

<<<<<<< HEAD
# Setează remote-ul GitHub prin SSH
git remote add origin git@github.com:iulianduma/iot-iulianduma-casa-ver3.0.git
=======
  nginx:
    image: nginx:latest
    ports:
      - "8080:80"
    volumes:
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
      - .:/var/www/html
    depends_on:
      - php
    networks:
      - symfony

  postgres:
    image: postgres:15
    environment:
      POSTGRES_DB: iotdb
      POSTGRES_USER: iotuser
      POSTGRES_PASSWORD: secret
    ports:
      - "5432:5432"
    networks:
      - symfony

networks:
  symfony:
EOF

cat <<EOF > docker/php/Dockerfile
FROM php:8.2-fpm
RUN apt-get update && apt-get install -y \\
    git zip unzip curl libicu-dev libpq-dev libonig-dev libxml2-dev \\
    && docker-php-ext-install intl pdo pdo_pgsql mbstring
WORKDIR /var/www/html
EOF

cat <<EOF > docker/nginx/default.conf
server {
    listen 80;
    server_name localhost;
    root /var/www/html/public;

    location / {
        try_files \$uri /index.php\$is_args\$args;
    }

    location ~ \.php\$ {
        fastcgi_pass php:9000;
        fastcgi_split_path_info ^(.+\.php)(/.+)\$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        fastcgi_param HTTPS off;
    }
}
EOF

cat <<EOF > assets/react/components/SensorDashboard.jsx
import React from 'react';
export default function SensorDashboard() {
  return <div className="alert alert-info">📡 Dashboard senzori activ!</div>;
}
EOF

cat <<EOF > assets/app.js
import React from 'react';
import { createRoot } from 'react-dom/client';
import SensorDashboard from './react/components/SensorDashboard';

const el = document.getElementById('sensor-dashboard');
if (el) {
  const root = createRoot(el);
  root.render(<SensorDashboard />);
}
EOF

cat <<EOF > webpack.config.js
const Encore = require('@symfony/webpack-encore');
Encore
  .setOutputPath('public/build/')
  .setPublicPath('/build')
  .addEntry('app', './assets/app.js')
  .enableReactPreset()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction());
module.exports = Encore.getWebpackConfig();
EOF

cat <<EOF > templates/home/index.html.twig
{% extends 'base.html.twig' %}
{% block body %}
  <div id="sensor-dashboard"></div>
  {{ encore_entry_script_tags('app') }}
{% endblock %}
EOF

# === GIT ===
git init
git add .
git commit -m "Initial commit: Structură proiect IoT Symfony + Docker + React"

# === REMOTE + PUSH ===
git remote add origin https://$GH_TOKEN@github.com/$GH_USERNAME/$GH_REPO.git
>>>>>>> d22d21e (Salvez modificările locale înainte de rebase)
git branch -M main
git push -u origin main

<<<<<<< HEAD
echo "✅ Proiectul a fost creat, inițializat și urcat pe GitHub prin SSH!"
=======
echo "✅ Proiectul $PROJECT a fost creat și urcat pe GitHub!"
>>>>>>> d22d21e (Salvez modificările locale înainte de rebase)
