composer install --no-dev
echo 'composer finalzado'
yarn
echo 'instalação de modulos finalizada'
yarn run prod
echo 'build do yarn finalzado'
php artisan migrate
echo 'migração do banco finalizada'
