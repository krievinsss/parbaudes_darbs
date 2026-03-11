# Nodarbinātības pakalpojumu sistēma (Laravel Test Task)

Šī ir Laravel 10+ aplikācija klientu un pakalpojumu pieprasījumu pārvaldībai.

Sistēma ļauj:

* pārvaldīt klientus
* pārvaldīt pakalpojumu pieprasījumus (darba sludinājumus)
* publicēt vakances publiskajā lapā
* izmantot REST API

Projekts izstrādāts kā **PHP programmētāja testa uzdevums**, izmantojot Laravel labās prakses.

---

# Funkcionalitāte

## Autentifikācija

Autentifikācija realizēta ar **Laravel Breeze**.

Lietotāji var:

* pieslēgties sistēmai
* izmantot "Remember me"
* atiestatīt paroli

---

# Lietotāju lomas

Sistēmā ir divas galvenās lomas.

## Administrators (Admin)

Administrators var:

* redzēt visus klientus
* izveidot jaunus klientus
* rediģēt klientus
* dzēst klientus
* redzēt visus pakalpojuma pieprasījumus
* rediģēt visus pieprasījumus
* dzēst pieprasījumus

Administrators darbojas kā sistēmas pārvaldnieks.

---

## Klienta lietotājs (Customer)

Klienta lietotājs var:

* redzēt tikai **sava uzņēmuma pieprasījumus**
* pievienot jaunus pieprasījumus
* rediģēt savus pieprasījumus
* dzēst savus pieprasījumus

Piekļuves kontrole realizēta ar **Laravel Policies**, kas nodrošina drošu autorizāciju.

---

# Publiskā lapa

Neautorizēti lietotāji var:

* apskatīt vakances
* meklēt vakances
* apskatīt pilnu darba sludinājumu

Publiski tiek rādīti tikai pieprasījumi ar statusu:

* `approved`
* `completed`

Tas imitē darba portāla funkcionalitāti līdzīgi kā valsts nodarbinātības aģentūras sistēmās.

---

# API

Sistēmā ir izveidots REST API.

## Pieejamie endpointi

### GET /api/customers

Atgriež klientu sarakstu.

### GET /api/customers/{id}/orders

Atgriež konkrētā klienta pakalpojumu pieprasījumus.

### POST /api/orders

Izveido jaunu pakalpojuma pieprasījumu.

API atbildes tiek formatētas ar **Laravel JSON Resources**.

---

# Izmantotās tehnoloģijas

Projekts izstrādāts izmantojot:

* Laravel 10
* PHP 8+
* MySQL
* Tailwind CSS
* Laravel Breeze
* Eloquent ORM
* Policies autorizācijai
* Form Requests validācijai
* JSON Resources API atbildēm

---

# Projekta arhitektūra

Projektā izmantota **Laravel MVC arhitektūra**.

## Controllers

* CustomerController
* OrderController
* API Controllers

## Models

* User
* Customer
* Order

## Relācijas

Customer hasMany Orders
User belongsTo Customer
Order belongsTo Customer
Order belongsTo User

---

# Drošība

Sistēmā izmantotas Laravel drošības funkcijas:

* CSRF aizsardzība
* Form Request validācija
* Policies autorizācija
* Mass assignment aizsardzība
* Blade XSS escaping
* Eloquent query builder SQL injection aizsardzība

---

# Instalācija

## 1. Klonēt projektu

git clone <repository-url>
cd project

---

## 2. Instalēt pakotnes

composer install
npm install

---

## 3. Environment konfigurācija

cp .env.example .env

Konfigurējiet datubāzi `.env` failā.

---

## 4. Migrācijas

php artisan migrate

---

## 5. Seeder

php artisan db:seed

Seeder izveido:

* administratora kontu
* klientus
* darba sludinājumus

---

## 6. Frontend build

Attīstības režīms:

npm run dev

Production build:

npm run build

---

## 7. Palaist serveri

php artisan serve

Sistēma būs pieejama:

http://127.0.0.1:8000

---

# Demo konti

## Administrators

email: [admin@example.com](mailto:admin@example.com)
password: password

---

## Klientu lietotāji

Seeder izveido vairākus klientu kontus.

Visiem kontiem:

password: password

---

# Testa dati

Seeder automātiski izveido:

* 10+ klientus
* 100+ darba sludinājumus
* test lietotājus

Tas ļauj ātri testēt sistēmu.

---

# UI

Interfeiss izstrādāts ar **Tailwind CSS**.

Funkcionalitāte:

* moderns admin panelis
* responsive dizains
* mobile navigācija
* sidebar desktop režīmā
* kartīšu dizains mobilajām ierīcēm

---

# Nākotnes uzlabojumi

Iespējamie uzlabojumi:

* automatizēti testi
* API autentifikācija ar Sanctum
* Docker konfigurācija
* uzlabota vakances meklēšana
* statistikas dashboard

---

# Autors

Laravel test task risinājums.
