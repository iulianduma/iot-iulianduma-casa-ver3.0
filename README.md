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

```bash
docker compose up -d --build
docker exec -it php bash
composer install
php bin/console doctrine:migrations:migrate
npm install
npm run dev
```

## Arduino
Plăcile trimit date JSON către `/api/senzori` și pot primi comenzi prin `/api/relee/{deviceId}`.

# IoT Symfony API

Acest proiect este o aplicație backend construită cu Symfony 7, care colectează date de la senzori și controlează relee într-un sistem IoT. Include o arhitectură Docker, o bază de date PostgreSQL, autentificare JWT și un API REST complet.

## 🔧 Tehnologii folosite

- Symfony 7.3
- Docker & Docker Compose
- PostgreSQL 16
- LexikJWTAuthenticationBundle (autentificare JWT)
- NelmioCorsBundle (CORS pentru frontend)
- Doctrine ORM
- PHPUnit (testare)
- REST API (JSON)

## 📦 Structură API

### SensorData (`/api/sensor`)
- `GET /api/sensor` – listare date
- `POST /api/sensor` – creare înregistrare
- `GET /api/sensor/{id}` – afișare înregistrare
- `PUT /api/sensor/{id}` – actualizare
- `DELETE /api/sensor/{id}` – ștergere

### Relay (`/api/relay`)
- `GET /api/relay` – listare relee
- `POST /api/relay` – creare releu
- `PUT /api/relay/{id}` – modificare stare
- `DELETE /api/relay/{id}` – ștergere

## 🚀 Instalare și rulare

```bash
git clone https://github.com/<user>/iot-symfony-api.git
cd iot-symfony-api
composer install
docker-compose up -d
php bin/console doctrine:migrations:migrate


>>>>>>> e4cd063 (Initial commit: proiect IoT Symfony + Docker + React)

