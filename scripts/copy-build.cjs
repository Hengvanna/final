const fs = require('fs');
const path = require('path');

const source = path.join(__dirname, '..', 'public', 'build');
const dest = path.join(__dirname, '..', 'dist');

if (!fs.existsSync(source)) {
  console.error('Build output not found at public/build. Run "vite build" first.');
  process.exit(1);
}

fs.mkdirSync(dest, { recursive: true });
fs.cpSync(source, dest, { recursive: true });
console.log('Copied public/build to dist');
