# Project skeleton

Project Skeleton is the Larevel template that is used for (nearly) all our projects. 

You may use our template but please notice that we offer no support whatsoever. We also don't follow 
semver for this project and won't guarantee that the code (especially the default branch) is stable.
In short: when using this, you're on your own. 

## Install 

This guide assumes you're using Vagrant Homestead. 

### Laravel app 

Download the default branch 

```bash
git clone https://github.com/CPSB/Skeleton-project
```

Install the composer dependencies 

```bash 
composer install
```

Make a copy `.env.example` and rename to `.env`

Finally make sure you have a database named `skeleton`, and run the migrations and seeds

```bash
php artisan migrate --seed
```

### Assets 

Installing project skeleton's front end dependencies requires `npm`.

```bash
npm install
```

Project skeleton uses Laravel Mix to build assets. TO build assets run: 

```bash
npm run dev
```

Available build tasks are defined in `package.json`

## Colofon

### Contributing

Generally we won't accept any PR requests to Blender. If you have discovered a bug or have an idea to improve the code, contact us first before you start coding.

### License

Project skeleton and The Laravel framework are open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)


