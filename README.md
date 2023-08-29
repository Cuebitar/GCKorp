#REMINDER
Remember to npm install before start development to ensure all dependencies are installed

Frontend Environment (Vue):
Folder: src
run: npm run dev

Backend Environment(Laravel & passport):
run: composer install
configure your .env files
run: php artisan migrate --path=/database/migrations/2023_07_30_172822_create_reject_reasons_table.php;  
run: php artisan migrate
run: php artisan passport:install 
If receive file_put_contents(/secret-keys/oauth/oauth-public.key): Failed to open stream: No such file or directory error:
1. 
run: php artisan serve

Framework used:
Vue, PrimeVue, PrimeFlex

VS Plugin Recommand:
es6-string-html
html css support
JavaScript (ES6) code snippets
JavaScript and TypeScript Nightly
PrimeFlex 3 Snippets
TypeScript Vue Plugin (Volar)
Vue 3 Snippets
Valor
Vetur