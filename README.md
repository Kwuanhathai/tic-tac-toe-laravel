# Tic-Tac-Toe Game (Laravel)

## 📌 Project Overview

This project is a **Tic-Tac-Toe (OX) web application** developed using **Laravel**, **Blade**, and **JavaScript**.  
It demonstrates full-stack development skills, including frontend game logic, backend API handling, database persistence, and authentication-based user data management.

The application allows authenticated users to play against a bot while maintaining a **continuous score system** that persists across gameplay sessions.

---

## 🎯 Project Objectives

- Demonstrate clean separation between frontend logic and backend persistence
- Implement real-time UI updates with server-side data synchronization
- Design a scalable score management system
- Apply practical Laravel concepts in a game-based scenario

---

## 🎮 Gameplay Rules

- Player uses **X**
- Bot uses **O**
- Win → score increases
- Loss → score decreases
- Winning **3 consecutive rounds** grants a bonus score
- Draw → score remains unchanged
- After each round (win / loss / draw), the board automatically resets

---

## 🚀 Key Features

- Interactive Tic-Tac-Toe gameplay
- Bot opponent with randomized moves
- Persistent score stored in database
- Continuous score progression across sessions
- Winning streak bonus logic
- RESTful API communication between frontend and backend
- Authentication-based score tracking
- Clean UI with Tailwind CSS

---

## 🛠 Tech Stack

- **Backend:** Laravel
- **Frontend:** Blade, Vanilla JavaScript
- **Database:** MySQL
- **Authentication:** Laravel Authentication
- **Styling:** Tailwind CSS

---

## 📂 Relevant Project Structure

app/
└── Http/Controllers/GameController.php

resources/
└── views/game.blade.php

public/
└── js/game.js

---

## ⚙️ Installation & Setup

1. Clone the repository
```bash
git clone https://github.com/Kwuanhathai/tic-tac-toe-laravel.git

composer install
npm install

2. Install dependencies 
composer install
npm install

3. Environment configuration
cp .env.example .env
php artisan key:generate

4. Database migration
php artisan migrate

5. Run the application
php artisan serve

---

## 🔐 Authentication

This project uses **Google OAuth authentication** for user login.

Authentication is implemented using an external OAuth provider (e.g. Google OAuth via Laravel Socialite / Auth0).

### Required Environment Variables

To enable login, the following environment variables must be configured:

```env
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT=your_redirect_url

⚠️ Note:
OAuth credentials are not included in this repository for security reasons.
Without proper OAuth configuration, users will not be able to log in and access the game.

🧠 Authentication Flow (High-Level)
User clicks "Login with Google"
The application redirects to the OAuth provider
Upon successful authentication, the user is redirected back to the application
The user is automatically registered or logged in
The user can access the game and score system

---

🔄 Score Management Logic
Game results are determined on the client side using JavaScript
The result of each round (X or O) is sent to the backend via an API request
Laravel processes the request and updates:
Player score
Winning streak
The updated score is saved in the database
The UI reflects score changes immediately after each round

---

## 📌 Important Notes (Score Behavior)

- The score is persisted in the database and represents the player's latest total score
- Each time a player returns to the game, the score continues from the existing database value
- Scores are not reset per session
- The game UI reflects and updates the same accumulated score across multiple play sessions
- The Scoreboard page displays the stored score directly from the database

### 🏆 Winning Streak Logic

- Each win increases the player's streak count by 1
- When the player wins **3 consecutive rounds**, a bonus score is awarded
- After the bonus score is applied, the streak counter is **reset to 0**
- A new streak count then begins from the next win

This design prevents infinite streak accumulation and encourages consistent performance.

---

📄 License
This project is intended for educational and portfolio demonstration purposes.
