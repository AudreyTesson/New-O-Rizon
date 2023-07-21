# New-O-Rizon

## Install

### Symfony

symfony new new_o_rizon --version="6.3.*" --webapp

cd .\new_o_rizon\

composer require symfony/webpack-encore-bundle

composer require symfony/ux-autocomplete

npm install --force

npm run build

symfony server:start

symfony console make:controller

symfony console make:entity

symfony console ma:mi

symfony console do:mi:mi

composer require orm-fixtures --dev

symfony console make:fixtures

`composer require fakerphp/faker`

composer require --dev bluemmb/faker-picsum-photos-provider ^2.0

symfony console d:f:l

composer require symfony/security-bundle

### EasyAdmin

composer require easycorp/easyadmin-bundle

php bin/console assets:install

### API

bin/console make:command

## TailwindCSS :

### Check doc : 
https://tailwindcss.com/docs/guides/symfony

### Install TailwindCSS :

```bash	
npm install -D tailwindcss postcss postcss-loader autoprefixer
npx tailwindcss init -p
```	
### Run TailwindCSS :	
```bash	
npm run watch
```	
