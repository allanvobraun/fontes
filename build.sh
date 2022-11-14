composer install --no-dev
echo 'composer finalzado'
yarn
echo 'instalação de modulos finalizada'
yarn run prod
echo 'build do yarn finalzado'
php artisan migrate --no-interaction
echo 'migração do banco finalizada'

sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
echo 'permissões do laravel finalizadas'
