# ChatHTML

A lightning-fast, minimal single-page chat application using OpenRouter API.

## Features
- 💬 Chat with AI using OpenRouter (Gemini 2.0 Flash Lite)
- 🔄 Message context preservation
- 🆕 New chat button
- ⚡ URL-based message initiation (e.g., `chatjin.com/hello` sends "hello")
- 🎯 Minimal CSS, maximum performance

## Tech Stack
- HTML5
- Vanilla JavaScript
- Native PHP (no framework)
- OpenRouter API

## Setup

1. Clone the repository
2. Copy `config.example.php` to `config.php`
3. Add your OpenRouter API key to `config.php`
4. Run with PHP built-in server:
   ```bash
   php -S localhost:8000
   ```
5. Open `http://localhost:8000` in your browser

## Usage

### Normal Chat
- Type messages in the input field and click Send or press Enter
- Click "New Chat" to start fresh

### URL Message Feature
Navigate to `http://localhost:8000/your-message-here` to automatically start a chat with that message.

## Security

The `config.php` file containing your API key is gitignored. Never commit API keys to version control.

## License

MIT
