# 🚀 Backend API — Laravel 12 + Sanctum

API backend desenvolvida em **Laravel 12**, utilizando **Docker**, **PostgreSQL** e **Laravel Sanctum** para autenticação baseada em tokens.

Este repositório **já contém o Laravel versionado**, seguindo práticas modernas e profissionais.

---

## 🧱 Stack

- Laravel 12
- PHP 8.2 (PHP-FPM)
- PostgreSQL 15
- Nginx
- Docker / Docker Compose
- Laravel Sanctum

---

## 🏗 Arquitetura

- API stateless
- Controllers enxutos
- Service Layer
- Form Requests para validação
- Autenticação via Bearer Token
- Tokens com expiração e abilities
- Middleware configurado no padrão Laravel 12

---

## ⚙️ Como subir o projeto (clone)

### 🟢 Criar o arquivo `.env`

Windows (PowerShell):
```powershell
copy backend\.env.example backend\.env
```

Linux / macOS:
```bash
cp backend/.env.example backend/.env
```

---

### 🟢 Configurar o `.env`

Edite `backend/.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=expert_appdb
DB_USERNAME=LEVIappuser
DB_PASSWORD=secret
```

---

### 🐳 Subir os containers

```bash
docker compose up -d --build
```

---

### 📦 Instalar dependências

```bash
docker compose exec app composer install
```

---

### 🔑 Gerar chave da aplicação

```bash
docker compose exec app php artisan key:generate
```

---

### 🗄 Migrar o banco

```bash
docker compose exec app php artisan migrate
```

---

## 🔐 Autenticação (Sanctum)

- `POST /api/register` ➜ Registrar usuário
- `POST /api/login` ➜ Login
- `GET /api/me` ➜ Usuário autenticado
- `POST /api/logout` ➜ Logout

### Headers obrigatórios (rotas protegidas)
```
Accept: application/json
Authorization: Bearer {TOKEN}
```

---

## ✅ Status

- Autenticação completa e testada
- Pronto para integração com frontend
- Estrutura preparada para produção
- 100% alinhado com Laravel 12

---

## 📌 Observações importantes

- ❌ Não usar `composer create-project`
- ✅ Sempre usar `composer install`
- 📦 `composer.lock` deve ser respeitado
