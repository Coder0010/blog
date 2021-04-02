rm -rfv node_modules/ public/adminpanel/*.css public/adminpanel/.js public/enduser/*.css public/enduser/.js bootstrap/cache/*.tmp bootstrap/cache/*.php &&
npm install && npm update && npm audit fix --force
