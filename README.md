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
